<?php
/**
 * Package in plugins
 *
 * @package LikeDislike
 * @subpackage build
 */
$plugins = array();

/* create the plugin object */
$plugins[0] = $modx->newObject('modPlugin');
$plugins[0]->set('id',1);
$plugins[0]->set('name','likeDislikePlugin');
$plugins[0]->set('description','Clears all the cache files associated with LikeDislike');
$plugins[0]->set('plugincode', getSnippetContent($sources['plugins'] . 'plugin.likedislike.php'));
$plugins[0]->set('category',0);

$events = array();

$events[0]= $modx->newObject('modPluginEvent');
$events[0]->fromArray(array(
	'event' => 'OnSiteRefresh',
	'priority' => 0,
	'propertyset' => 0,
),'',true,true);

$events[1]= $modx->newObject('modPluginEvent');
$events[1]->fromArray(array(
    'event' => 'OnlikeDislikeSave',
    'priority' => 0,
    'propertyset' => 0,
),'',true,true);

if (is_array($events) && !empty($events)) {
	$plugins[0]->addMany($events);
	$modx->log(xPDO::LOG_LEVEL_INFO,'Packaged in '.count($events).' plugin events for LikeDislike.'); flush();
} else {
	$modx->log(xPDO::LOG_LEVEL_ERROR,'Could not find plugin events for LikeDislike!');
}
unset($events);

return $plugins;
