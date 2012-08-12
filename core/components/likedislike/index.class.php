<?php
/**
 * @package likedislike
 * @subpackage controllers
 */
require_once dirname(__FILE__) . '/model/likedislike/likedislike.class.php';
abstract class likeDislikeManagerController extends modExtraManagerController {
    /** @var likeDislike $likedislike */
    public $likedislike;
    public function initialize() {
        $this->likedislike = new likeDislike($this->modx);

        $this->addCss($this->likedislike->config['cssUrl'].'mgr.css');
        $this->addJavascript($this->likedislike->config['jsUrl'].'mgr/likedislike.js');
        $this->addHtml('<script type="text/javascript">
        Ext.onReady(function() {
            likeDislike.config = '.$this->modx->toJSON($this->likedislike->config).';
        });
        </script>');
        return parent::initialize();
    }
    public function getLanguageTopics() {
        return array('likedislike:default');
    }
    public function checkPermissions() { return true;}
}
/**
 * @package likedislike
 * @subpackage controllers
 */
class IndexManagerController extends likeDislikeManagerController {
    public static function getDefaultController() { return 'home'; }
}