<?php
/**
 * @package likedislik
 * @subpackage processors
 */
class likeDislikUpdateProcessor extends modObjectUpdateProcessor {
    public $classKey = 'LikedislikeItems';
    public $languageTopics = array('likedislike:default');
    public $objectType = 'likedislike.likedislik';
}
return 'likeDislikUpdateProcessor';