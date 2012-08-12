<?php
/**
 * @package likedislike
 * @subpackage processors
 */
class likeDislikCreateProcessor extends modObjectCreateProcessor {
    public $classKey = 'LikedislikeIpBlock';
    public $languageTopics = array('likedislike:default');
    public $objectType = 'likedislike.likedislik';    

    public function beforeSave() {
        $ip = $this->getProperty('ip');

        if (empty($ip)) {
            $this->addFieldError('ip',$this->modx->lexicon('likedislike.likedislik_err_ip_name'));
        } else if ($this->doesAlreadyExist(array('ip' => $ip))) {
            $this->addFieldError('ip',$this->modx->lexicon('likedislike.likedislik_err_ae'));
        } else if (! ereg("^[0-9\.*]{3,15}$",$ip)) {
            $this->addFieldError('ip',$this->modx->lexicon('likedislike.likedislik_err_ap_adress'));
        }
        $this->object->set('date',time());        
        return parent::beforeSave(); 
    }
    
    public function cleanup() {
        // Rewrite the cache file IP blockens
        likeDislike::clear_ip_blocked();
    }
}
return 'likeDislikCreateProcessor';