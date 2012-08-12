<?php
/**
 * @package likedislik
 * @subpackage processors 
 */

if (empty($scriptProperties['id'])) return $modx->error->failure($modx->lexicon('likedislike.likedislik_err_data'));
$id = $scriptProperties['id'];
/* get obj */
$likeitem = $modx->getObject('LikedislikeItems',$id);
if (empty($likeitem)) return $modx->error->failure($modx->lexicon('likedislike.likedislik_err_nf'));
$name = $likeitem->get('name');
if($likeitem->remove() == false){
    return $modx->error->failure('error');
}

$votes = $modx->newQuery('LikedislikeVotes');
$votes->where(array('item_id' => $id));
$votes->prepare();
$votes->stmt->execute();
$vote = $votes->stmt->fetchAll(PDO::FETCH_ASSOC);
 
foreach ($vote as $vot) {
    if ($vot == null) continue;
    $remobj = $modx->getObject('LikedislikeVotes',$vot['LikedislikeVotes_id']);
    if($remobj->remove() == false){
        return $modx->error->failure('error');
    }
}
    
// Splitting the name of the array to find the category and the key
$nameArray = explode('::',$name);
$keyitem = md5('likedislike::'.$name);

// Remove the cache file
if($modx->cacheManager->refresh(array('likedislike' => array('itemslike' => array($nameArray[0] =>array($nameArray[1] => array($keyitem.'.cache.php')))))))
    $modx->log(modX::LOG_LEVEL_ERROR, "LikeDislike -> Failed to clear the cache for the object with id ".$name);

return $modx->error->success('',$likeitem);