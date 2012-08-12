<?php
/**
 * @package likedislik
 * @subpackage processors
 */
class likeDislikUpdateProcessor extends modObjectUpdateProcessor {
    public $classKey = 'LikedislikeIpBlock';
    public $languageTopics = array('likedislike:default');
    public $objectType = 'likedislike.likedislik';
}
return 'likeDislikUpdateProcessor';