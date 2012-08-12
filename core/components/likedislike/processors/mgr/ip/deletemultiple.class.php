<?php
/**
 * @package likedislik
 * @subpackage processors
 */
class likeDislikDeleteMultipleProcessor extends modObjectProcessor {
    public $classKey = 'LikedislikeIpBlock';
    public $objectType = 'likedislike.likedislik';
    public $languageTopics = array('likedislike:default');

    public function process() {
        $ids = $this->getProperty('ids',null);
        if (empty($ids)) {
            return $this->failure($this->modx->lexicon('likedislike.likedislik_err_ns_multiple'));
        }
        $ids = is_array($ids) ? $ids : explode(',',$ids);

        foreach ($ids as $id) {
            if (empty($id)) continue;
            $remobj = $this->modx->getObject('LikedislikeIpBlock',array('id' => $id));
            $remobj->remove();
        }
        // Rewrite the cache file IP blockens
        likeDislike::clear_ip_blocked();
        
        return $this->success();
    }
}
return 'likeDislikDeleteMultipleProcessor';
