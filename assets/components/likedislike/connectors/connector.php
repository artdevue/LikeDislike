<?php
if ($_REQUEST['action'] == 'web/like') {
    @session_cache_limiter('public');
    define('MODX_REQP',false); //disable checking the user rights for our connector
}
require_once dirname(dirname(dirname(dirname(dirname(__FILE__))))).'/config.core.php';
require_once MODX_CORE_PATH.'config/'.MODX_CONFIG_KEY.'.inc.php';
require_once MODX_CONNECTORS_PATH.'index.php'; //connector files

$requestCorePath = $modx->getOption('likedislike.core_path',null,$modx->getOption('core_path').'components/likedislike/');

/* This unit generates a variable HTTP_MODAUTH (different for different versions of MODX),
 * which can be verified in further inquiry. Put simply go around the security settings MODX,
 * because we have a public connector.
 * */
if ($_REQUEST['action'] == 'web/like') {
    $version = $modx->getVersionData();
    if (version_compare($version['full_version'],'2.2.2-pl') >= 0) {
        if ($modx->user->hasSessionContext($modx->context->get('key'))) {
            $_SERVER['HTTP_MODAUTH'] = $_SESSION["modx.{$modx->context->get('key')}.user.token"];
        } else {
            $_SESSION["modx.{$modx->context->get('key')}.user.token"] = 0;
            $_SERVER['HTTP_MODAUTH'] = 0;
        }
    } else {
        $_SERVER['HTTP_MODAUTH'] = $modx->site_id;
    }
    $_REQUEST['HTTP_MODAUTH'] = $_SERVER['HTTP_MODAUTH'];
}

/* initiate the request. */
$path = $requestCorePath.'processors/';
$modx->request->handleRequest(array(
    'processors_path' => $path,
    'location' => '',
));