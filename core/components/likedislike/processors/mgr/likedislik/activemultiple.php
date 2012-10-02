<?php
/**
 * @package likedislik
 * @subpackage processors 
 */

/* get obj */
if (empty($scriptProperties['like'])) return $modx->error->failure($modx->lexicon('likedislike.likedislik_err_data'));

$ordersIds = explode(',',$scriptProperties['like']);
if(isset($scriptProperties['mode'])){
	
	foreach ($ordersIds as $item) {
		$itsel = $modx->getObject('LikedislikeItems',$item);		
		if ($itsel == null) continue;
		$name = $itsel->get('name');
		if($scriptProperties['mode'] == 'deleteitem'){
			/* delete */
			if ($itsel->remove() === false) {
				return $modx->error->failure('error');
			}
                        /* delete votes */
                        $votes = $modx->newQuery('LikedislikeVotes');
                        $votes->where(array('item_id' => $item));
                        $votes->prepare();
                        $votes->stmt->execute();
                        $vote = $votes->stmt->fetchAll(PDO::FETCH_ASSOC);
                        
                        foreach ($vote as $vot) {
                            if ($vot == null) continue;
                            $remobj = $modx->getObject('LikedislikeVotes',$vot['LikedislikeVotes_id']);
                            if($remobj->remove() == false){
                                return $modx->error->failure('error');
                            }
                        }
                }else{		
			/* publish and  unpublish */
			$actItem = $scriptProperties['mode'] == 'publishitem' ? 0 : 1;
			$itsel->set('closed',$actItem);
			if ($itsel->save() === false) {
				return $modx->error->failure('error');
			}
		}
		
		// Splitting the name of the array to find the category and the key
		$nameArray = explode('::',$name);
		$keyitem = md5('likedislike::'.$name);
			
		// Remove the cache file
		if(!$modx->cacheManager->delete($keyitem,array(xPDO::OPT_CACHE_KEY => 'likedislike/itemslike/'.$nameArray[0].'/'.$nameArray[1])))
			$modx->log(modX::LOG_LEVEL_ERROR, "LikeDislike -> Failed to clear the cache for the object with id ".$name);
	}
}

return $modx->error->success('',$itsel);