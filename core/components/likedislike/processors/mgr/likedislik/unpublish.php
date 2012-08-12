<?php
/**
 * @package likedislik
 * @subpackage processors 
 */
if (empty($scriptProperties['id']) AND empty($scriptProperties['act'])) return $modx->error->failure($modx->lexicon('likedislike.likedislik_err_data'));

 /* get obj */
$like = $modx->getObject('LikedislikeItems',$scriptProperties['id']);
 if (empty($like)) return $modx->error->failure($modx->lexicon('likedislike.likedislik_err_nf'));
 $name = $like->get('name');
 $actItem = $scriptProperties['mode'] == 'unpub' ? 1 : 0;
 $like->set('closed',$actItem);
 /* save */
if ($like->save() == false) {
    return $modx->error->failure($modx->lexicon('likedislike.likedislik_err_save'));
}

 // Splitting the name of the array to find the category and the key
$nameArray = explode('::',$name);
$keyitem = md5('likedislike::'.$name);

// Remove the cache file
if($modx->cacheManager->refresh(array('likedislike' => array('itemslike' => array($nameArray[0] =>array($nameArray[1] => array($keyitem.'.cache.php')))))))
    $modx->log(modX::LOG_LEVEL_ERROR, "LikeDislike -> Failed to clear the cache for the object with id ".$name);

return $modx->error->success('',$album); 