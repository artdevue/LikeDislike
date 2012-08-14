<?php
/**
 * Loads system settings into build
 *
 * @package LikeDislike
 * @subpackage build
 */
$settings = array();
$settings[0]= $modx->newObject('modSystemSetting');

$settings[0]= $modx->newObject('modSystemSetting');
$settings[0]->fromArray(array(
    'key' => 'likedislike.cookieCheck',
    'value' => 1,
    'xtype' => 'combo-boolean',
    'namespace' => 'likedislike',
    'area' => 'cookie',
),'',true,true);

$settings[1]= $modx->newObject('modSystemSetting');
$settings[1]->fromArray(array(
    'key' => 'likedislike.cookieDomain',
    'value' => '',
    'xtype' => 'textfield',
    'namespace' => 'likedislike',
    'area' => 'cookie',
),'',true,true);

$settings[2]= $modx->newObject('modSystemSetting');
$settings[2]->fromArray(array(
    'key' => 'likedislike.cookieLifetime',
    'value' => '3600 * 24 * 365',
    'xtype' => 'textfield',
    'namespace' => 'likedislike',
    'area' => 'cookie',
),'',true,true);

$settings[3]= $modx->newObject('modSystemSetting');
$settings[3]->fromArray(array(
    'key' => 'likedislike.cookieName',
    'value' => 'likedislike',
    'xtype' => 'textfield',
    'namespace' => 'likedislike',
    'area' => 'cookie',
),'',true,true);

$settings[4]= $modx->newObject('modSystemSetting');
$settings[4]->fromArray(array(
    'key' => 'likedislike.cookiePath',
    'value' => '/',
    'xtype' => 'textfield',
    'namespace' => 'likedislike',
    'area' => 'cookie',
),'',true,true);

$settings[5]= $modx->newObject('modSystemSetting');
$settings[5]->fromArray(array(
    'key' => 'likedislike.ipCheck',
    'value' => 0,
    'xtype' => 'combo-boolean',
    'namespace' => 'likedislike',
    'area' => 'ip',
),'',true,true);

$settings[6]= $modx->newObject('modSystemSetting');
$settings[6]->fromArray(array(
    'key' => 'likedislike.ipLifetime',
    'value' => '0',
    'xtype' => 'textfield',
    'namespace' => 'likedislike',
    'area' => 'ip',
),'',true,true);

$settings[7]= $modx->newObject('modSystemSetting');
$settings[7]->fromArray(array(
    'key' => 'likedislike.defaultTemplate',
    'value' => 'mini_likedislik',
    'xtype' => 'textfield',
    'namespace' => 'likedislike',
    'area' => 'templates',
),'',true,true);

$settings[8]= $modx->newObject('modSystemSetting');
$settings[8]->fromArray(array(
    'key' => 'likedislike.userIdCheck',
    'value' => 0,
    'xtype' => 'combo-boolean',
    'namespace' => 'likedislike',
    'area' => 'user',
),'',true,true);

$settings[9]= $modx->newObject('modSystemSetting');
$settings[9]->fromArray(array(
    'key' => 'likedislike.userLoginRequired',
    'value' => 0,
    'xtype' => 'combo-boolean',
    'namespace' => 'likedislike',
    'area' => 'user',
),'',true,true);

return $settings; 