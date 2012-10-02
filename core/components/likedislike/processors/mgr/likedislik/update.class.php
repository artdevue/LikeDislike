<?php
/**
 * @package likedislik
 * @subpackage processors
 */
class likeDislikUpdateProcessor extends modObjectUpdateProcessor {
    public $classKey = 'LikedislikeItems';
    public $languageTopics = array('likedislike:default');
    public $objectType = 'likedislike.likedislik';

    /**
     * @param xPDOObject|R $object
     * @return array
     */
    public function prepareRow(xPDOObject $object) {
    	$likeArray = parent::prepareRow($object);
    	$name = $likeArray['name'];

    	 // Splitting the name of the array to find the category and the key
    	$nameArray = explode('::',$name);
    	$keyitem = md5('likedislike::'.$name);

    	// Remove the cache file
    	if(!$this->modx->cacheManager->delete($keyitem,array(xPDO::OPT_CACHE_KEY => 'likedislike/itemslike/'.$nameArray[0].'/'.$nameArray[1])))
    		$this->modx->log(modX::LOG_LEVEL_ERROR, "LikeDislike -> Failed to clear the cache for the object with id ".$name);
    }
}
return 'likeDislikUpdateProcessor';