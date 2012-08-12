<?php
/**
 * @package likedislike
 * @subpackage controllers
 */
class likeDislikeHomeManagerController extends likeDislikeManagerController {
    public function process(array $scriptProperties = array()) {

    }
    public function getPageTitle() { return $this->modx->lexicon('likedislike'); }
    public function loadCustomCssJs() {
        $this->addJavascript($this->likedislike->config['jsUrl'].'mgr/widgets/ipblock.grid.js');
        $this->addJavascript($this->likedislike->config['jsUrl'].'mgr/widgets/likedislike.grid.js');
        $this->addJavascript($this->likedislike->config['jsUrl'].'mgr/widgets/home.panel.js');
        $this->addLastJavascript($this->likedislike->config['jsUrl'].'mgr/sections/index.js');
    }
    public function getTemplateFile() { return $this->likedislike->config['templatesPath'].'home.tpl'; }
}