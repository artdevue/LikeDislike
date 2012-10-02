<?php
/**
 * @package likeDislike
 */
$eventName = $modx->event->name;
switch($eventName) {
    case 'OnSiteRefresh':
        if($modx->cacheManager->refresh(array('/likedislike'=> array())))
            $modx->log(modX::LOG_LEVEL_INFO,'LikeDislike clear cache. '.$modx->lexicon('refresh_success'));
        break;
    case 'OnlikeDislikeSave':
        $likedislike = $modx->getService('likedislike','likeDislike',$modx->getOption('likedislike.core_path',null,$modx->getOption('core_path').'components/likedislike/').'model/likedislike/',$scriptProperties);
        if (!($likedislike instanceof likeDislike)) return ' no conect likeDislike';

        $params = $modx->event->params;
        $idRes = $params['resRat'];
        $setObj = $params[$params['outputRat']];
        switch (intval($params['typeRat'])) {
            case 1:
                $tv = $modx->getObject('modTemplateVar',array('name'=>$params['tvRat']));
                if($tv){
                    $idtv = $tv->id;
                    $tvs = $modx->getObject('modTemplateVarResource',array('tmplvarid'=>$idtv, 'contentid'=>$idRes));
                    if($tvs) {
                        $tvs->set('value',$setObj);
                        $tvs->save();
                    }else{
                        $tv = $modx->newObject('modTemplateVarResource');
                        $tv->set('tmplvarid',$idtv);
                        $tv->set('contentid',$idRes);
                        $tv->set('value',$setObj);
                        $tv->save();
                    }
                }
                break;
            case 2:
                $doc = $modx->getObject('modResource',$idRes);
                if($doc){
                    if($params['column'] == 'properties'){
                        $setObjRes = array();
                        $selObj = array('votes_up','votes_down','votes_total','votes_balance','votes_pct_up','votes_pct_down');
                        foreach($selObj as $s){
                            $setObjRes[$s] = $params[$s];
                        }
                        if($doc->properties != null){
                            $datJson = $doc->get('properties');
                            $setObj = json_encode(array_merge ($datJson, $setObjRes));
                        }else{
                            $setObj = json_encode($setObjRes);
                        }
                    }
                    $doc->set($params['column'], $setObj);
                    if(!$doc->save()){
                        if ($likedislike->options('debug'))
                            $modx->log(modX::LOG_LEVEL_ERROR, "LikeDislike :: Can not write a score for a resource with id ".$idRes);
                    }
                }
                break;
        }
        break;
}