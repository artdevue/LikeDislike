<?php
/**
 * likeDislike Connector
 *
 * @package likedislike
 */
require_once dirname(dirname(dirname(dirname(__FILE__)))).'/config.core.php';
require_once MODX_CORE_PATH.'config/'.MODX_CONFIG_KEY.'.inc.php';
require_once MODX_CONNECTORS_PATH.'index.php';

$corePath = $modx->getOption('likedislike.core_path',null,$modx->getOption('core_path').'components/likedislike/');
require_once $corePath.'model/likedislike/likedislike.class.php';
$modx->likedislike = new likeDislike($modx);

$modx->lexicon->load('likedislike:default');

/* handle request */
$path = $modx->getOption('processorsPath',$modx->likedislike->config,$corePath.'processors/');
$modx->request->handleRequest(array(
    'processors_path' => $path,
    'location' => '',
));