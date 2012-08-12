<?php
/**
 * @package likedislik
 * @subpackage processors 
 */
class likeDislikRemoveProcessor extends modObjectRemoveProcessor {
    public $classKey = 'LikedislikeItems';
    public $languageTopics = array('likedislike:default');
    public $objectType = 'likedislike.likedislik';
}
return 'likeDislikRemoveProcessor';