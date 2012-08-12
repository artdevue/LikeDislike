<?php
/**
 * Get a list of likeDislike
 *
 * @package likedislike
 * @subpackage processors
 */
class likeDislikIpGetListProcessor extends modObjectGetListProcessor {
    public $classKey = 'LikedislikeIpBlock';
    public $languageTopics = array('likedislike:default');
    public $defaultSortField = 'date';
    public $defaultSortDirection = 'DESC';
    public $objectType = 'likedislike.likedislik';

    public function prepareQueryBeforeCount(xPDOQuery $c) {
        $query = $this->getProperty('query');
        if (!empty($query)) {
            $c->where(array(
                'ip:LIKE' => '%'.$query.'%',
            ));
        }
        return $c;
    }
    
    /**
     * @param xPDOObject|R $object
     * @return array
     */
    public function prepareRow(xPDOObject $object) {
        $resourceArray = parent::prepareRow($object);

        if (!empty($resourceArray['date'])) {
            $resourceArray['publishedon_date'] = strftime('%e %b %Y',$resourceArray['date']);           
            $resourceArray['publishedon_time'] = strftime('%H:%I %p',$resourceArray['date']);
            $resourceArray['actions'] = array();
            $resourceArray['actions'][] = array(
                'text' => $this->modx->lexicon('delete'),
            );
        }
        
        
        return $resourceArray;
    }
}
return 'likeDislikIpGetListProcessor';