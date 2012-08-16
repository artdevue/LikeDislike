<?php
/**
 * LikeDislike
 *
 * @author     Valentin Rasulov <info@artdevue.com>
 * @link       http://like.artdevue.com/
 * @copyright  Copyright 2009-2012
 */
$likedislike = $modx->getService('likedislike','likeDislike',$modx->getOption('likedislike.core_path',null,$modx->getOption('core_path').'components/likedislike/').'model/likedislike/',$scriptProperties);
if (!($likedislike instanceof likeDislike)) return ' no conect likeDislike';

/* setup default properties */
$options = $likedislike->options('options');
$form = $likedislike->options('default_formats');
$tpl = $modx->getOption('tpl',$scriptProperties,$modx->getOption('likedislike.defaultTemplate'));
$likeId = $modx->getOption('likeId',$scriptProperties,$modx->resource->get('id'));
$format = htmlspecialchars($modx->getOption('format',$scriptProperties,$form[$tpl]));
$category = $modx->getOption('category',$scriptProperties,$modx->resource->get('class_key'));
$name = $modx->getOption('name',$scriptProperties,$modx->resource->get('pagetitle'));
$question = $modx->getOption('question',$scriptProperties, $modx->lexicon('likedislike.question'));
$round = $modx->getOption('round',$scriptProperties,0);
$align = $modx->getOption('align',$scriptProperties,$options['align']);

/* load the object if the object or create a new */
$rez = $likedislike->load_item($category.'::'.$likeId.'::'.$name);

$rez['color_up'] = $modx->getOption('color_up',$scriptProperties, $options['color_up']);
$rez['color_down'] = $modx->getOption('color_down',$scriptProperties, $options['color_down']);
$rez['tpl'] = $tpl;
$rez['up'] = $modx->getOption('up',$scriptProperties, $modx->lexicon('likedislike.up'));
$rez['down'] = $modx->getOption('down',$scriptProperties, $modx->lexicon('likedislike.down'));

$out = '';
$closed = false;

/* merge the resulting object, and our data are recalculated */
$item = array_merge ($rez, $likedislike->calculate_votes($item['votes_up'],$item['votes_down']));

/* check and adjust the elements */
$rez['class'] = $rez['closed'] != 0 ? ' closed' : '';
$rez['class'] .= $rez['user_voted'] ? ' user_voted' : '';
$rez['round'] = (int)$round;
if($rez['closed'] != 0 || $rez['user_voted']){
    $rez['class'] .= ' disabled';
    $rez['question'] = '';
    $rez['disabled'] = 'disabled="disabled"';
}else{
    $rez['question'] = $question;
}
$rez['class'] .= ' '.$align;
$rez['format'] = $format;

/* obtain the correct output format according to our pattern */
$resArray = $likedislike->format_item ($format, $rez, $round);

/* output parameters to retrieve the item */
$rez['result_up'] = $resArray['result'][0];
$rez['result_down'] = isset($resArray['result'][1]) ? $resArray['result'][1] : '';

/* know the length of the output and demand, if we establish the desired class  */
$rez['squeeze'] = '';
if($tpl == 'likedislik_up_down'){
    $rez['squeeze'] = max(strlen($rez['result_up']), strlen($rez['result_down'])) > 5 ? ' squeeze' : '';
}
if($tpl == 'likedislik_up'){
    $rez['squeeze'] = strlen($rez['result_up']) > 4 ? ' squeeze' : '';    
}
if($tpl == 'up_down'){
    $rez['squeeze'] = strlen($rez['result_up']) > 3 ? ' squeeze' : '';    
}

/* add the prefix "like." to our array  */
$rez = array_combine(array_map(create_function('$k', 'return "like.".$k;'), array_keys($rez)), array_values($rez));

/* Processes and returns the output from an HTML chunk by name template.  */
$out = $likedislike->getChunk($tpl,$rez);

return $out;