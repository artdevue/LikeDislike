<?php
/**
 * Add snippets to build
 * 
 * @package likedislike
 * @subpackage build
 */
$snippets = array();
$properties = include $sources['build'].'properties/properties.likedislike.php';

$snippets[0]= $modx->newObject('modSnippet');
$snippets[0]->fromArray(array(
    'id' => 0,
    'name' => 'LikeDislike',
    'description' => 'Snippet for LikeDislike is a flexible MODX voting expansion.',
    'snippet' => getSnippetContent($sources['elements'].'snippets/snippet.likedislike.php'),
),'',true,true);
$snippets[0]->setProperties($properties[0]);

$snippets[1]= $modx->newObject('modSnippet');
$snippets[1]->fromArray(array(
    'id' => 0,
    'name' => 'likeCssjs',
    'description' => 'Snippet for LikeDislike to connect the js and css files.',
    'snippet' => getSnippetContent($sources['elements'].'snippets/snippet.likecssjs.php'),
),'',true,true);
$snippets[1]->setProperties($properties[1]);

unset($properties);
return $snippets;