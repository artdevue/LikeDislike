<?php
/**
 * Properties for the LikeDislike snippet.
 *
 * @package likedislike
 * @subpackage build
 */
$properties = array();

$properties[0] = array(
    array(
		'name' => 'round',
		'value' => '0',
		'type' => 'textfield',
		'desc' => 'prop_likedislike.round',
		'lexicon' => 'likedislike:properties',
		'options' => '',
	),
                       );
$properties[1] = array(
    array(
		'name' => 'jsConnect',
		'value' => 0,
		'type' => 'combo-boolean',
		'desc' => 'prop_likedislike.js_connect_desc',
		'lexicon' => 'likedislike:properties',
		'options' => '',
	),
                       );

return $properties;