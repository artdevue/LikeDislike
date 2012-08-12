<?php
/**
 * @package likedislike
 */

class likeDislike {
    /**
     * Constructs the likeDislike object
     *
     * @param modX &$modx A reference to the modX object
     * @param array $config An array of configuration options
     */
    function __construct(modX &$modx,array $config = array()) {
        $this->modx =& $modx;

        $basePath = $this->modx->getOption('likedislike.core_path',$config,$this->modx->getOption('core_path').'components/likedislike/');
        $assetsUrl = $this->modx->getOption('likedislike.assets_url',$config,$this->modx->getOption('assets_url').'components/likedislike/');        
        $this->config = array_merge(array(
            'basePath' => $basePath,
            'corePath' => $basePath,
            'modelPath' => $basePath.'model/',
            'processorsPath' => $basePath.'processors/',
            'templatesPath' => $basePath.'templates/',
            'chunksPath' => $basePath.'elements/chunks/',
            'jsUrl' => $assetsUrl.'js/',
            'cssUrl' => $assetsUrl.'css/',
            'assetsUrl' => $assetsUrl,
            'connectorUrl' => $assetsUrl.'connector.php',            
        ),$config);
        
        $this->modx->addPackage('likedislike',$this->config['modelPath']);
        $this->modx->lexicon->load('likedislike:default');
    }
    
    /**
    * Returns an array of options.
    *
    * @return  array
    */
    public function options ($opt){
        $configlike = array(
            // Also initialize all options (for all templates) with a default value
            'options' => array(
                'align'       => 'center',
                'question'    => $this->modx->lexicon('likedislike.question'),
                'color_up'    => '#ccc',
                'color_down'  => '#ccc',
            ),
            /**
             ** (string) The default LikeDislike template to use. If you don't choose a template
             ** * when creating a LikeDislike item, this template will be used.
             ** * * All available templates can be found in the templates directory. $modx->getOption('ace.theme', null, 'textmate')
             ** * * */
            'default_template' => $this->modx->getOption('likedislike.default_template',$config,'mini_thumbs'),
            /**
             ** (array) List of the default formats to use for each template. Each format string
             ** * defines which values to output and how. Six variables are available (wrapped in braces):
             ** * * - {UP} for the number of up votes
             ** * * * - {DOWN} for the number of down votes
             ** * * * * - {PCT_UP} for the percentage of votes that is up
             ** * * * * * - {PCT_DOWN} for the percentage of votes that is down
             ** * * * * * * - {TOTAL} for the total number of votes (up + down)
             ** * * * * * * * - {BALANCE} for the vote balance (up - down)
             ** * * * * * * * * See the online documentation for a more extensive explanation.
             ** * * * * * * * * */
            'default_formats' => array(
                    'buttons'            => '{UP} '.$this->modx->lexicon('likedislike.out_of').' {TOTAL} '.$this->modx->lexicon('likedislike.people_like_this'),
                    'mini_poll'          => '{PCT_UP}% || {PCT_DOWN}%',
                    'mini_likedislik'    => '{BALANCE}',
                    'likedislik_up'      => '{UP}',
                    'likedislik_up_down' => '{+UP} || {-DOWN}',
                    'up_down'            => '{BALANCE}',
            ),
            /**
            * (boolean) Enable or disable a cookie check when a user votes. If a cookie is found
            * that contains the current item ID, the user won't be able to vote for it again.
            * Note: disabling this check will turn off any likeDislike cookies to be sent.
            */
            'cookie_check' => $this->modx->getOption('likedislike.cookieCheck',$config,TRUE), // TRUE or FALSE
            
           /**
            * (string) The name of the likeDislike cookie.
            */
           'cookie_name' => $this->modx->getOption('likedislike.cookieName',$config,'likedislike'),
           
           /**
            * (integer) The lifetime of the cookie. In other words, the number of seconds
            * since the last vote before the cookie expires and gets deleted.
            * If set to 0, the cookie will expire when the browser closes.
            */
           'cookie_lifetime' => $this->modx->getOption('likedislike.cookieLifetime',$config,(3600 * 24 * 365)), // 1 year
           
           /**
            * (string) The path on the server in which the cookie will be available on.
            * If set to '/', the cookie will be available within the entire domain.
            * See: http://php.net/manual/function.setcookie.php
            * Most of the time, you can just leave this as is.
            */
           'cookie_path' => $this->modx->getOption('likedislike.cookiePath',$config,'/'),
           
           /**
            * (string) The domain that the cookie is available on. You can make the cookie
            * available across subdomains if you need to. Example: '.yoursite.com'
            * See: http://php.net/manual/function.setcookie.php
            * Most of the time, you can just leave this as is.
            */
           'cookie_domain' => $this->modx->getOption('likedislike.cookieDomain',$config,''),
           
           /**
            * (boolean) Enable or disable an IP check when a user votes. If a previous vote
            * for the item is found with the same IP, the user won't be able to vote for it again.
            * Note: disabling this check will stop IP addresses from being stored upon vote.
            */
           'ip_check' => (boolean)$this->modx->getOption('likedislike.ipCheck',$config,FALSE), // TRUE or FALSE
           
           /**
            * (integer) The lifetime of an IP address. A user with the same IP address can vote
            * for an item after this number of seconds has past since the last vote from the IP.
            * If set to 0, IP addresses will not expire.
            */
           'ip_lifetime' => $this->modx->getOption('likedislike.ipLifetime',$config,0),
                      
           /**
            * (boolean) Enable or disable a user ID check when a user votes. This will prevent
            * registered users to cast multiple votes, regardless of the cookie and IP check settings.
            * Note: this check does not prevent guests from voting. Set user_login_required to TRUE if you want to do so.
            * Note: in order for this check to work, you need to supply a user_id_callback.
            */
           'user_id_check' => (boolean)$this->modx->getOption('likedislike.userIdCheck',$config,FALSE), // TRUE or FALSE
           
           /**
            * (boolean) If set to TRUE, users will have to be logged in in order to vote.
            * Guests won't be able to vote.
            */
           'user_login_required' => (boolean)$this->modx->getOption('likedislike.userLoginRequired',$config,FALSE), // TRUE or FALSE
           
           /**
            * (boolean) Enable or disable debug mode. You should only enable this if
            * something is going wrong with your likeDislike installation.
            * Enabling debug mode will show errors.
            */
           'debug' => $this->modx->getOption('debug',$config,FALSE), // TRUE or FALSE
        );
        return isset($opt) ? $configlike[$opt] : null;
    }

    /**
     * Initializes the class into the proper context
     *
     * @access public
     * @param string $ctx
     */
    public function initialize($ctx = 'web') {
        switch ($ctx) {
            case 'mgr':
                if (!$this->modx->loadClass('likedislikeControllerRequest',$this->config['modelPath'].'likedislike/request/',true,true)) {
                    return 'Could not load controller request handler.';
                }
                $this->request = new likedislikeControllerRequest($this);
                return $this->request->handleRequest();
            break;
        }
        return true;
    }
        
    /**
    * Returns TRUE if the current request in an ajax request, FALSE otherwise.
    *
    * @return  boolean
    */
    public function is_ajax(){
        return (isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest');
    }

    /**
    * Retrieves the IP address for the current user.
    *
    * @return  mixed  valid IP string, or NULL if not found
    */
    public function get_ip(){
        // Cache
        static $ip = FALSE;
        
        // This code only needs to be executed once per request
        if ($ip !== FALSE)
        return $ip;
    
        // Loop over $_SERVER keys that can contain the IP address
        foreach (array('REMOTE_ADDR', 'HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR') as $key){
            // Return the first valid IP we find
            if (isset($_SERVER[$key]) AND preg_match('~^(?:\d{1,3}+\.){3}\d{1,3}+$~D', $_SERVER[$key]))
            return $ip = $_SERVER[$key];
        }
        // No valid IP found
        return $ip = NULL;
    }
    
    /**
    * Checks whether an IP number is blocked
    *
    * @return  boolean  TRUE if blocked, FALSE if not
    */
    public function ip_blocked($ip){
        // (array) List of IP numbers that are blocked. This means they cannot vote for any items.
        // Note: you can set wildcards by using the * symbol.
        $inCache = FALSE;
        $cache = $this->modx->getCacheManager();
        // check the cache if the cache is not empty, then return the result from the cache
        if($cache){
            // Creates a key, unique key will be created depending on the parameters passed to the function.
            $keyipblock = md5('likedislike::ip_blockeded');
            if($blocked_ips = $this->modx->cacheManager->get($keyipblock,array(xPDO::OPT_CACHE_KEY => 'likedislike/ipblocked'))){
                $inCache = TRUE;
            }else{
                $inCache = FALSE;
            }
        }
        if(!$inCache) {
            $this->modx->cacheManager->set('test4',$color);
            $qip = $this->modx->newQuery('LikedislikeIpBlock');
            $qip->select(array('LikedislikeIpBlock.id', 'LikedislikeIpBlock.ip'));
            $qip->prepare();
            $qip->stmt->execute();
            $res = $qip->stmt->fetchAll(PDO::FETCH_ASSOC);
            $blocked_ips = array();
            foreach ($res as $v) {
                $blocked_ips[] = $v['ip'];
            }
            if ($cache && !$inCache ){
                $this->modx->cacheManager->set($keyipblock,$blocked_ips,0,array(xPDO::OPT_CACHE_KEY => 'likedislike/ipblocked'));
            }
        }
        
        // Avoid useless work
        if (empty($blocked_ips) OR ((string) $ip) === '')
            return FALSE;
        
        // Check all blocked IPs
        foreach ($blocked_ips as $blocked_ip){
            // Prepare regex, taking wildcards into account
            $regex = preg_quote((string) $blocked_ip, '~');
            $regex = str_replace('\\*', '.*', $blocked_ip);
            
            // Does the IP match a blocked one?
            if (preg_match('~^'.$regex.'$~D', (string) $ip))
            return TRUE;
        }
        
        return FALSE;
    }
    
    /**
    * Clear IP blocked
    *
    * @return  boolean  TRUE if clear, FALSE if not 
    */
    public function clear_ip_blocked(){
        if($this->modx->cacheManager->refresh(array('likedislike/ipblocked'=> array()))){
            if(!self::ip_blocked())
                return TRUE;
        }
        return FALSE;
    }
    
    /**
    * Return clean cookie contents.
    * Invalid cookies will be deleted automatically.
    *
    * @return  string
    */
    public function get(){
        // The cookie has already been loaded
        if (self::$cookie !== NULL)
            return self::$cookie;
        
        // If no cookie exists, we're out of here
        if ( ! isset($_COOKIE[$this->options('cookie_name')]))
            return self::$cookie = '';
        
        // Make sure our cookie value is a string
        self::$cookie = (string) $_COOKIE[$this->options('cookie_name')];
        
        // The cookie should should only contain ids separated by dots
        if ( ! preg_match('~^(?:\d+\.)*+\d+$~D', self::$cookie)){
            // Delete invalid cookie
            self::delete();
        }
        
        // Return the cookie string
        return self::$cookie;
    }
    
    /**
    * Looks for a single item id in the cookie.
    *
    * @param   integer  item id
    * @return  boolean  id found or not?
    */
    public function find_id($id){
        // Look for the given id in a cookie enclosed by dots
        return (strpos('.'.self::get().'.', '.'.$id.'.') !== FALSE);
    }
    
    /**
    * Adds a single item id to the cookie.
    *
    * @param   integer  item id
    * @return  boolean  was setcookie() successful or not?
    */
    public function add_id($id){
        // Don't add double ids
	if (self::find_id($id))
            return TRUE;
        
        // Add the id to the cookie string.
        // The trim is needed for when adding the first id.
        $cookie = ltrim(self::get().'.'.$id, '.');
        
        // A cookie lifetime of 0 will keep the cookie until the session ends
        $expire = ( ! $this->options('cookie_lifetime')) ? 0 : time() + (int) $this->options('cookie_lifetime');
        
        // If any output has been sent, setcookie() will fail.
        // If we're not in debug mode, we'll fail silently.
        if (headers_sent() AND ! $this->options('debug'))
            return FALSE;
        
        // Should return TRUE; does not necessarily mean the user accepted the cookie, though
        return setcookie($this->options('cookie_name'), $cookie, $expire, $this->options('cookie_path'), $this->options('cookie_domain'));
    }

    /**
    * Deletes the cookie completely.
    *
    * @return  boolean  was setcookie() successful or not?
    */
    public function delete(){
        // Delete cookie contents
        $cookie = '';
        unset($_COOKIE[$this->options('cookie_name')]);
        
        // If any output has been sent, setcookie() will fail.
        // If we're not in debug mode, we'll fail silently.
        if (headers_sent() AND ! $this->options('debug'))
            return FALSE;
        
        // Setting a cookie with a value of FALSE will try to delete it
        return setcookie($this->options('cookie_name'), FALSE, time() - 86400, $this->options('cookie_path'), $this->options('cookie_domain'));
    }
    
    /**
    * Generates nicely formatted results for each result area.
    *
    * @param   string  format string
    * @return  object  LikeDislike_Item
    */
    public function format_item ($format = null, $item, $round = 0){
        $format = (string) $format;
        if ($format === NULL)
            return $item;
        
        
        $resArray = array("{UP}","{+UP}","{DOWN}","{-DOWN}","{PCT_UP}","{+PCT_UP}","{PCT_DOWN}","{-PCT_DOWN}","{TOTAL}","{BALANCE}");
        $repArray = array($item['votes_up'],
                      $item['votes_up'] == 0 ? $item['votes_up'] : '+'.$item['votes_up'],
                      $item['votes_down'],
                      $item['votes_down'] == 0 ? $item['votes_down'] : '-'.$item['votes_down'],
                      round($item['votes_pct_up'],$round),
                      $item['votes_pct_up'] > 0 ? '+'.round($item['votes_pct_up'],$round) : round($item['votes_pct_up'],$round),
                      round($item['votes_pct_down'],$round),
                      $item['votes_pct_down'] > 0 ? '-'.round($item['votes_pct_down'],$round) : round($item['votes_pct_down'],$round),
                      $item['votes_total'],
                      $item['votes_balance'] > 0 ? '+'.$item['votes_balance'] : $item['votes_balance']
                      );
        $item['result'] = str_replace($resArray,$repArray,$format);
        // Split into different result areas separated by "||"
        $item['result']  = preg_split('/\s*\|\|\s*/', $item['result'] );
        return $item;
    }
    
    /**
    * Calculates the vote results based on the current votes_up and votes_down values.
    *
    * @return  void
    */
    public function calculate_votes($votes_up,$votes_down){
        $calvotes = array();
        $calvotes['votes_total']    = $votes_up + $votes_down;
        $calvotes['votes_balance']  = $votes_up - $votes_down;
        
        // Note: division by zero must be prevented
        $calvotes['votes_pct_up']   = ($calvotes['votes_total'] === 0) ? 0 : $votes_up / $calvotes['votes_total'] * 100;
        $calvotes['votes_pct_down'] = ($calvotes['votes_total'] === 0) ? 0 : $votes_down / $calvotes['votes_total'] * 100;
        
        return $calvotes;
    }
    
    /**
    * The object of voting from a database or cache.
    * @return  array
    */
    public function like_object ($name){
        // Are we loading by id or by name?
        $key = (is_int($name)) ? 'id' : 'name';
        
        // Check the object in the cache, if it exists, then the flag $inCache true
        $cache = $this->modx->getCacheManager();
        if($cache && $key == 'name'){
            $keyitemmd = md5('likedislike::'.$name);
            $nameArray = explode('::',$name);
            $item = $this->modx->cacheManager->get($keyitemmd,array(xPDO::OPT_CACHE_KEY => 'likedislike/itemslike/'.$nameArray[0].'/'.$nameArray[1]));
            if($item){
                return $item;
            }
        }
        
        // Load the item
        //As if the flag $inCache false, then get the object from the database
        
        $sth = $this->modx->getObject('LikedislikeItems',array($key => $name));
        if(!$sth && !$this->is_ajax()){
            $sth = $this->create($name);
        }
        
        $item = $sth->toArray();
        $this->modx->cacheManager->set($keyitemmd,$item,0,array(
            xPDO::OPT_CACHE_KEY => 'likedislike/itemslike/'.$nameArray[0].'/'.$nameArray[1],
        ));
        
        return $item;
    }
    
    /**
    * The result given exit criteria.
    * @return  void
    */
    public function load_item($name){              
        $item = $this->like_object($name);
        // The result is an array
        // Merge result and a calculator
        //$item = $sth->toArray();
        $item = array_merge ($item, $this->calculate_votes($item['votes_up'],$item['votes_down']));
        
        // Initial default value
        $item['user_voted'] = FALSE;
        
        // Check cookie for a vote
        if ($this->options('cookie_check') AND $this->find_id_cookie($item['id'])){
            $item['user_voted'] = TRUE;
        }
        
        // Check for a previous vote by IP
        if ( ! $item['user_voted'] AND $this->options('ip_check') AND $ip = $this->get_ip()){
            // Because of the ip_lifetime config setting, it's possible multiple records contain the same IP.
            // We only load the most recent one to check the lifetime later on.
            $sth = $this->modx->getObject('LikedislikeVotes',array('item_id' => $item['id'], 'ip' => $ip));
            // A record with the IP was found
            if ($date = (int) $sth->date){
                if ( ! $this->options('ip_lifetime') OR $date > time() - $this->options('ip_lifetime')){
                    // If the IP lifetime is unlimited or the vote date
                    // still falls within the lifetime, mark the item as voted on.
                    $item['user_voted'] = TRUE;
                }
            }
        }
        
        // Check for a previous vote by user id
        if ( ! $item['user_voted'] AND $this->options('user_id_check') AND $user_id = $this->modx->user->get('id')){
            $sth = $this->modx->getObject('LikedislikeVotes',array('item_id' => $item['id'], 'user_id' => $user_id));
            $item['user_voted'] = (bool) $sth;
        }
                        
        return $item;
        
    }
    
    /**
    * Creates a new LikeDislike item.
    *
    * @param   string  item name
    * @return  mixed   LikeDislike_Item object if the item could be created, FALSE otherwise
    */
    public function create($name){
        // The name of the array to retrieve the name of the category, it is easier sorting in admin panel
        $cat = explode('::',$name);
        // Attempt to create a new item
        $item = $this->modx->newObject('LikedislikeItems');
        $item->set('name',$name);
        $item->set('category',$cat[0]);
        $item->set('date',time());
        $item->set('closed',FALSE);
        $item->set('votes_up',0);
        $item->set('votes_down',0);
        if(!$item->save()){
            return FALSE;
        }
        return $item;
    }
    
    /**
    * Delete Cache - LikeDislike item.
    *
    * @param   string  item name
    * @return  boolean 
    */
    public function del_likecache($name){
        // Splitting the name of the array to find the category and the key
        $nameArray = explode('::',$name);
        $keyitem = md5('likedislike::'.$name);
        
        // Remove the cache file
        if($this->modx->cacheManager->refresh(array('likedislike' => array('itemslike' => array($nameArray[0] =>array($nameArray[1] => array($keyitem.'.cache.php')))))))
            $this->modx->log(modX::LOG_LEVEL_ERROR, "LikeDislike -> Failed to clear the cache for the object with name ".$name);
        
        return true;
    }
    
    /**
    * Return clean cookie contents.
    * Invalid cookies will be deleted automatically.
    *
    * @return  string
    */
    public function get_cookie(){
        // If no cookie exists, we're out of here
        if ( ! isset($_COOKIE[$this->options('cookie_name')]))
            return '';
        
        // Make sure our cookie value is a string
        $cookie = (string) $_COOKIE[$this->options('cookie_name')];
        
        // The cookie should should only contain ids separated by dots
        if ( ! preg_match('~^(?:\d+\.)*+\d+$~D', $cookie)){
            // Delete invalid cookie
            $this->delete_cookie();
        }
        
        // Return the cookie string
        return $cookie;
    }
    
    /**
    * Looks for a single item id in the cookie.
    *
    * @param   integer  item id
    * @return  boolean  id found or not?
    */
    public function find_id_cookie($id){
        // Look for the given id in a cookie enclosed by dots
        return (strpos('.'.$this->get_cookie().'.', '.'.$id.'.') !== FALSE);
    }
    
    /**
    * Adds a single item id to the cookie.
    *
    * @param   integer  item id
    * @return  boolean  was setcookie() successful or not?
    */
    public function add_id_cookie($id){
        // Don't add double ids
        if ($this->find_id_cookie($id))
            return TRUE;
        
        // Add the id to the cookie string.
        // The trim is needed for when adding the first id.
        $cookie = ltrim($this->get_cookie().'.'.$id, '.');
        
        // A cookie lifetime of 0 will keep the cookie until the session ends
        $expire = ( ! $this->options('cookie_lifetime')) ? 0 : time() + (int) $this->options('cookie_lifetime');
        
        // If any output has been sent, setcookie() will fail.
        // If we're not in debug mode, we'll fail silently.
        if (headers_sent() AND ! $this->options('debug'))
            $modx->log(modX::LOG_LEVEL_ERROR, "I can not set the cookie");
            
        // Should return TRUE; does not necessarily mean the user accepted the cookie, though
        return setcookie($this->options('cookie_name'), $cookie, $expire, $this->options('cookie_path'), $this->options('cookie_domain'));
    }
    
    /**
    * Deletes the cookie completely.
    *
    * @return  boolean  was setcookie() successful or not?
    */
    public function delete_cookie(){
	// Delete cookie contents
        $cookie = '';
        unset($_COOKIE[$this->options('cookie_name')]);
        
        // If any output has been sent, setcookie() will fail.
        // If we're not in debug mode, we'll fail silently.
        if (headers_sent() AND ! $this->options('debug'))
            return FALSE;
        
        // Setting a cookie with a value of FALSE will try to delete it
        return setcookie($this->options('cookie_name'), FALSE, time() - 86400, $this->options('cookie_path'), $this->options('cookie_domain'));
    }

    /**
     * Gets a Chunk and caches it; also falls back to file-based templates
     * for easier debugging.
     *
     * @access public
     * @param string $name The name of the Chunk
     * @param array $properties The properties for the Chunk
     * @return string The processed content of the Chunk
     */
    public function getChunk($name,$properties = array()) {
        $chunk = null;
        if (!isset($this->chunks[$name])) {
            $chunk = $this->_getTplChunk($name);
            if (empty($chunk)) {
                $chunk = $this->modx->getObject('modChunk',array('name' => $name));
                if ($chunk == false) return false;
            }
            $this->chunks[$name] = $chunk->getContent();
        } else {
            $o = $this->chunks[$name];
            $chunk = $this->modx->newObject('modChunk');
            $chunk->setContent($o);
        }
        $chunk->setCacheable(false);
        return $chunk->process($properties);
    }
    /**
     * Returns a modChunk object from a template file.
     *
     * @access private
     * @param string $name The name of the Chunk. Will parse to name.$postfix
     * @param string $postfix The default postfix to search for chunks at.
     * @return modChunk/boolean Returns the modChunk object if found, otherwise
     * false.
     */
    private function _getTplChunk($name,$postfix = '.chunk.tpl') {
        $chunk = false;
        $f = $this->config['chunksPath'].strtolower($name).$postfix;
        if (file_exists($f)) {
            $o = file_get_contents($f);
            $chunk = $this->modx->newObject('modChunk');
            $chunk->set('name',$name);
            $chunk->setContent($o);
        }
        return $chunk;
    } 
}
