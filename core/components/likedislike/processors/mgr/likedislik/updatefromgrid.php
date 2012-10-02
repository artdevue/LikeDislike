<?php
/**
 * @package likedislik
 * @subpackage processors
 */
/* parse JSON */
if (empty($scriptProperties['data'])) return $modx->error->failure($this->modx->lexicon('likedislike.likedislik_err_data'));
$_DATA = $modx->fromJSON($scriptProperties['data']);
if (!is_array($_DATA)) return $modx->error->failure($this->modx->lexicon('likedislike.likedislik_err_nf'));

/* get obj */
if (empty($_DATA['id'])) return $modx->error->failure($modx->lexicon('likedislike.likedislik_err_ns'));
$like = $modx->getObject('LikedislikeItems',$_DATA['id']);
if (empty($like)) return $modx->error->failure($modx->lexicon('likedislike.likedislik_err_nf'));

$like->fromArray($_DATA);

/* save */
if ($like->save() == false) {
    return $modx->error->failure($modx->lexicon('likedislike.likedislik_err_save'));
}

 // Splitting the name of the array to find the category and the key
$name = $like->get('name');
$nameArray = explode('::',$name);
$keyitem = md5('likedislike::'.$name);

// Remove the cache file
if(!$modx->cacheManager->delete($keyitem,array(xPDO::OPT_CACHE_KEY => 'likedislike/itemslike/'.$nameArray[0].'/'.$nameArray[1])))
    $modx->log(modX::LOG_LEVEL_ERROR, "LikeDislike -> Failed to clear the cache for the object with id ".$name);


return $modx->error->success('',$like);