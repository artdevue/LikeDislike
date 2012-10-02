<?php
/**
 * Created by JetBrains PhpStorm.
 * User: AtrDevue
 * Date: 01.10.12
 * Time: 05:05
 * To change this template use File | Settings | File Templates.
 */
/**
 * Add LikeDislike events for plugins to build
 *
 * @package likedislike
 * @subpackage build
 */
$events = array();

$events[0]= $modx->newObject('modEvent');
$events[0]->fromArray(array (
    'name' => 'OnlikeDislikeSave',
    'service' => 6,
    'groupname' => 'LikeDislike',
), '', true, true);
return $events;