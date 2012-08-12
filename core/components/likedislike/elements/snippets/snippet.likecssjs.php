<?php
/**
 * LikeDislike
 *
 * @author     Valentin Rasulov <info@artdevue.com>
 * @link       http://like.artdevue.com/
 * @copyright  Copyright 2009-2012
 */
 
$js = '<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>';
$js_connect = (boolean)$jsConnect ? $js : '';

$modx->regClientCSS($modx->config['assets_url'].'components/likedislike/css/styles.css');
$modx->regClientHTMLBlock($js_connect.'<script src="'.$modx->config['assets_url'].'components/likedislike/js/web/init.js.php"></script>');
return '';