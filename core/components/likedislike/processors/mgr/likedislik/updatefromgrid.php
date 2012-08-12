<?php
/**
 * @package likedislik
 * @subpackage processors
 */
/* parse JSON */
if (empty($scriptProperties['data'])) return $modx->error->failure($this->modx->lexicon('likedislike.likedislik_err_data'));
$_DATA = $modx->fromJSON($scriptProperties['data']);
if (!is_array($_DATA)) return $modx->error->failure($this->modx->lexicon('likedislike.likedislik_err_nf'));

/* get obj */
if (empty($_DATA['id'])) return $modx->error->failure($modx->lexicon('likedislike.likedislik_err_ns'));
$like = $modx->getObject('LikedislikeItems',$_DATA['id']);
if (empty($like)) return $modx->error->failure($modx->lexicon('likedislike.likedislik_err_nf'));

$like->fromArray($_DATA);

/* save */
if ($like->save() == false) {
    return $modx->error->failure($modx->lexicon('likedislike.likedislik_err_save'));
}


return $modx->error->success('',$like);