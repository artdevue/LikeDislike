<?php
/**
 * LikeDislike
 */

//ini_set('display_errors', 1);
//error_reporting(E_ALL);

$likedislike = $modx->getService('likedislike','likeDislike',$modx->getOption('likedislike.core_path',null,$modx->getOption('core_path').'components/likedislike/').'model/likedislike/',$scriptProperties);
if (!($likedislike instanceof likeDislike)) return ' no conect likeDislike';

$modx->lexicon->load($modx->getOption('cultureKey').':likedislike:default');

// Only respond to requests for Ajax
if(! $likedislike->is_ajax())
    return json_encode(array('error' => 'ajax_error'));

/** Check, asking us to return the settings?
 * We are trying to translate in response to warnings and errors.
 * So, do not share anything dangerous.
 * */

if (isset($_POST['likedislike_setting'])){
    // Send the item back in JSON format
    header('Content-Type: application/json; charset=utf-8');
    
    // Create an array to return the settings
    $set_likeset = array();
    // Fill the array
    $set_likeset['invalid_id'] = $modx->lexicon('likedislike.likedislik_err_invalid_id');
    $set_likeset['closed'] = $modx->lexicon('likedislike.likedislik_err_closed');
    $set_likeset['ip_blocked'] = $modx->lexicon('likedislike.likedislik_err_ip_blocked');
    $set_likeset['invalid_id'] = $modx->lexicon('likedislike.likedislik_err_login_required');
    // If we have the array is empty, then return error
    if(count($set_likeset) < 0)
        return json_encode(array('error' => 'error'));
    // All is well, return the settings
    return json_encode(array('setting' => $set_likeset));
}

// Immediately get out of here if no valid vote was cast.
// All required POST keys must be present.
if ( ! isset($_POST['likedislike_id']) OR ! isset($_POST['likedislike_vote']) OR ! isset($_POST['likedislike_format']))
    return FALSE;

// Has somebody been messing with the form?
// Well, we won't let them mess with us!
if ( ! preg_match('/^[0-9]++$/D', (string) $_POST['likedislike_id']) OR ! is_string($format = $_POST['likedislike_format']))
    return FALSE;

// Clean form input
$id   = (int) $_POST['likedislike_id'];
$vote = (int) $_POST['likedislike_vote'];
$ctx = (string) $_POST['likedislike_ctx'];
$round = $_POST['likedislike_round'] ? (int) $_POST['likedislike_round'] : 0;

/// Is the current user blocked by IP?
if ($likedislike->ip_blocked($likedislike->get_ip())){
    $error = array('error'=>'ip_blocked', 'lang_error'=>$modx->lexicon('likedislike.likedislik_err_ip_blocked'));
}

// Attempt to load the relevant LikrDislike item.
// If the item doesn't exist, the id is invalid.
elseif ( ! $item = $likedislike->load_item((int)$_POST['likedislike_id'])){
    $error = array('error'=>'invalid_id', 'lang_error'=>$modx->lexicon('likedislike.likedislik_err_invalid_id'));
}

// Voting on the item has been closed
elseif ($item['closed']){
    $error = array('error'=>'closed', 'lang_error'=>$modx->lexicon('likedislike.likedislik_err_closed'));
}

// The user has already voted on this item
elseif ($item['user_voted']){
    $error = array('error'=>'already_voted', 'lang_error'=>$modx->lexicon('likedislike.likedislik_err_ip_blocked'));
}

// You have to be logged in to vote
elseif ($likedislike->options('user_login_required') AND !$this->modx->user->isAuthenticated($ctx)){
    $error = array('error'=>'login_required', 'lang_error'=>$modx->lexicon('likedislike.likedislik_err_login_required'));
}

// All checks passed, yay!
if (empty($error)){
    // Update the vote count in the items table, and recalculate the vote results
    
    // Vote value must be either 0 or 1
    $vote = min(1, max(0, (int) $vote));
    
    if ($vote){
        // Add an "up" vote
        $item['votes_up']++;
        $sql = 'votes_up';
    }else{
        // Add a "down" vote
        $item['votes_down']++;
        $sql = 'votes_down';
    }
    
    // Recalculate the vote results, no need to reload the item from database
    $item = array_merge ($item, $likedislike->calculate_votes($item['votes_up'],$item['votes_down']));
    
    // Update the item record
    $sth = $modx->getObject('LikedislikeItems',array('id' => $item['id']));
    $sth->set($sql,$item[$sql]);
    
    if(!$sth->save()) {
        if ($likedislike->options('debug')) $modx->log(modX::LOG_LEVEL_ERROR, "I can not create an entry for obgect LikedislikeItems - item ".$item['id']);
    }else{
        // If there is a value in the POST variable likedislike_tv, then add the score for the specified property type. Parameters separated by a comma
        $datRating = htmlspecialchars(trim($_POST['likedislike_rating']));
        $itemsEvents = $item;
        if(strlen($datRating) > 5){
            $arrayDatRating = explode(',',trim($datRating));
            $checkRating = array('type','tv','output','res','column');
            foreach ($arrayDatRating as $adr){
                $dr = explode('=',$adr);
                if (in_array($dr[0], $checkRating)) {
                    $arrayDR[$dr[0]] = trim($dr[1]);
                }
            }
            $checkOut = array('votes_up','votes_down','votes_total','votes_balance','votes_pct_up','votes_pct_down');
            $checkColumn = array('properties','longtitle','description','introtext');
            $itemsEvents['tvRat'] = isset($arrayDR['tv']) ? $arrayDR['tv'] : 'likeDislike';
            $itemsEvents['outputRat'] = (isset($arrayDR['output']) AND in_array($arrayDR['output'], $checkOut)) ? $arrayDR['output'] : 'votes_balance';
            $itemsEvents['typeRat'] = (isset($arrayDR['type']) AND $arrayDR['type'] == 2) ? 2 : 1;
            $itemsEvents['resRat'] = intval($arrayDR['res']);
            $itemsEvents['column'] = (isset($arrayDR['column']) AND in_array($arrayDR['column'], $checkColumn)) ? $arrayDR['column'] : 'description';
        }

        // Transfer data to the system event OnlikeDislikeSave
        $modx->invokeEvent('OnlikeDislikeSave', $itemsEvents);
    }
    
    // The current user has just cast a vote
    $item['user_voted'] = TRUE;
    
    // Add the item id to a cookie
    if ($likedislike->options('cookie_check')){
        $likedislike->add_id_cookie($item['id']);
    }
    
    // Combine the storage of the IP and user id into one query for optimization
    $ip = ($likedislike->options('ip_check')) ? $likedislike->get_ip() : NULL;
    $user_id = ($likedislike->options('user_id_check')) ? $this->modx->user->get('id') : NULL;
    
    if ($ip OR $user_id){
        $sth = $modx->newObject('LikedislikeVotes');
        $sth->set('item_id',$item['id']);
        $sth->set('ip',$ip);
        $sth->set('user_id',$user_id);
        $sth->set('value',$vote);
        $sth->set('date',time());
        if(!$sth->save()){
            if ($likedislike->options('debug')) $modx->log(modX::LOG_LEVEL_ERROR, "I can not create an entry for object LikedislikeVotes - user_id ".$user_id);
        }        
    }
}

// Send the item back in JSON format
header('Content-Type: application/json; charset=utf-8');

if ( ! empty($error)){
    // Send back the error
    return json_encode(array('error' => $error));
}else{    
    // Format the result using the same format the item was created with
    $item = array_merge ($item, $likedislike->format_item($format, $item, $round)); 
    
    // Remove the cache file
    $likedislike->del_likecache($item['name']);
    
    // Create a cache file, so as not to create a resource for downloading. In this way we won the hundredths of seconds :)
    $likedislike->like_object($item['name']);
    
    
    // Send back the updated item.
    // Note: all the public properties of $item will be included.    
    return json_encode(array('item' => $item));
}

// A new vote has been cast successfully
return empty($error);
