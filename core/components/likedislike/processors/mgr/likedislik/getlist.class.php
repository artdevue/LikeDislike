<?php
/**
 * Get a list of likeDislike
 *
 * @package likedislike
 * @subpackage processors
 */
class likeDislikGetListProcessor extends modObjectGetListProcessor {
    public $classKey = 'LikedislikeItems';
    public $languageTopics = array('likedislike:default');
    public $defaultSortField = 'date';
    public $defaultSortDirection = 'DESC';
    public $objectType = 'likedislike.likedislik';

    public function prepareQueryBeforeCount(xPDOQuery $c) {
        $query = $this->getProperty('query');
        if (!empty($query)) {
            $c->where(array(
                'name:LIKE' => '%'.$query.'%',
                'OR:category:LIKE' => '%'.$query.'%',
            ));
        }
        // filter category
        $category = $this->getProperty('category');
        if($category != $this->modx->lexicon('likedislike.all_category')){
            if (!empty($category)) {
            $c->where(array(
                'category' => $category,
            ));
            }
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
            $resourceArray['publishedon_date'] = strftime('%d %b',$resourceArray['date']);
            $resourceArray['publishedon_year'] = strftime('%Y',$resourceArray['date']).' '.$this->modx->lexicon('year');            
            
            $resourceArray['actions'] = array();
            $resourceArray['actions'][] = array(
                'className' => 'delete',
                'text' => $this->modx->lexicon('delete'),
            );
            if ($resourceArray['closed'] == 0) {
            $resourceArray['actions'][] = array(
                'className' => 'unpublish',
                'text' => $this->modx->lexicon('unpublish'),
            );
            } else {
            $resourceArray['actions'][] = array(
                'className' => 'publish orange',
                'text' => $this->modx->lexicon('publish'),
            );
            }
        }
        
        if (!empty($resourceArray['name'])) {
            $nameArray = explode('::',$resourceArray['name']);
            $resourceArray['pag_name'] = $nameArray[2];
            $resourceArray['pag_num'] = $nameArray[1];
        }
        
        
        return $resourceArray;
    }
}
return 'likeDislikGetListProcessor';