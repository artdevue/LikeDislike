<?php
/**
 * @package likedislik
 * @subpackage processors
 */
class likeDislikRemoveProcessor extends modObjectRemoveProcessor {
    public $classKey = 'LikedislikeIpBlock';
    public $languageTopics = array('likedislike:default');
    public $objectType = 'likedislike.likedislik';
    
    public function cleanup() {
        // Rewrite the cache file IP blockens
        likeDislike::clear_ip_blocked();
    }
}
return 'likeDislikRemoveProcessor';