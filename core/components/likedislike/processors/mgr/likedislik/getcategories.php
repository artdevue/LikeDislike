<?php
/**
 * @package likedislike
 * @subpackage processors
 */
$isLimit = !empty($_REQUEST['limit']);
$start = $modx->getOption('start',$_REQUEST,0);
$limit = $modx->getOption('limit',$_REQUEST,10);
$sort = $modx->getOption('sort',$_REQUEST,'category');
$dir = $modx->getOption('dir',$_REQUEST,'ASC');
$query = $modx->getOption('query', $_REQUEST, 0);
$mode = $modx->getOption('mode', $_REQUEST, 'category');
$query = $modx->getOption('query',$scriptProperties,'');

/* build query */
$c = $modx->newQuery('LikedislikeItems');

$c->select(array(
	'LikedislikeItems.category'
        ,'LikedislikeItems.id'
));
$c->groupby('LikedislikeItems.category');

$c->sortby($sort,$dir);
if ($isLimit) $c->limit($limit,$start);
$categories = $modx->getCollection('LikedislikeItems', $c);
$count = count($categories);
/* iterate */
$list = array();
foreach ($categories as $vids) {
    $list[] = $vids->toArray();
}
array_unshift($list, array('id'=>0, 'category'=>$modx->lexicon('likedislike.all_category')));
return $this->outputArray($list,$count);