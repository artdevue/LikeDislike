<?php
/**
 * LikeDislike
 *
 * @author     Valentin Rasulov <info@artdevue.com>
 * @link       http://like.artdevue.com/
 * @copyright  Copyright 2009-2012
 */
 
$js = '<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>';
$js_connect = (boolean) $jsConnect ? $js : '';
$like_url = $modx->config['assets_url'].'components/likedislike/';

$modx->regClientCSS($modx->config['assets_url'].'components/likedislike/css/styles.css');
$modx->regClientHTMLBlock($js_connect.'<script type="text/javascript">var url_assets = "'.$like_url.'"; var likedislike_ctx = "'.$modx->context->get('key').'";</script><script src="'.$like_url.'js/web/likedislike.js"></script>');
return '';
