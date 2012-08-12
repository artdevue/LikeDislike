<?php
// The function returns the URL domain, the use of subdomains and site_url in several contexts, does not display the value with www or without
function curPageURL() {
    $pageURL = 'http';
    if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
    $pageURL .= "://";
    if ($_SERVER["SERVER_PORT"] != "80") {
        $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"];
    } else {
        $pageURL .= $_SERVER["SERVER_NAME"];
    }
    return $pageURL;
}

// Сonnect
define('MODX_API_MODE', true);
require str_replace($_SERVER["REQUEST_URI"],'',(__FILE__)).'/index.php';

// Enable error handling
$modx->getService('error','error.modError');
$modx->setLogLevel(modX::LOG_LEVEL_INFO);
$modx->setLogTarget(XPDO_CLI_MODE ? 'ECHO' : 'HTML');

$likedislike = $modx->getService('likedislike','likeDislike',$modx->getOption('likedislike.core_path',null,$modx->getOption('core_path').'components/likedislike/').'model/likedislike/');
if (!($likedislike instanceof likeDislike)) return ' no conect likeDislike';

// accept the option likedislike.assets_url
//$assetsUrl = str_replace('js/web/init.js.php','',curPageURL().$_SERVER["REQUEST_URI"]);
$assetsUrl = $likedislike->config['assetsUrl'];

// Send the correct HTTP Content-Type header
header('Content-Type: text/javascript; charset=utf-8');

// Set the parameters for the data chunk in the
$param = array(
    'like.url' => curPageURL().$assetsUrl,
    'like.invalid_id' => $modx->lexicon('likedislike.likedislik_err_invalid_id'),
    'like.closed' => $modx->lexicon('likedislike.likedislik_err_closed'),
    'like.ip_blocked' => $modx->lexicon('likedislike.likedislik_err_ip_blocked'),
    'like.login_required' => $modx->lexicon('likedislike.likedislik_err_login_required')
               );
// Process a chunk and output
echo $likedislike->getChunk('init_js',$param);

return '';