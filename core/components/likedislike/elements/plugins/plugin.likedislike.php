<?php
/**
 * @package likeDislike
 */
if ($modx->event->name == 'OnSiteRefresh'){
    if($modx->cacheManager->refresh(array('/likedislike'=> array())))
        $modx->log(modX::LOG_LEVEL_INFO,'LikeDislike clear cache. '.$modx->lexicon('refresh_success'));
}