<?php
/**
 * Default English Lexicon Entries for likeDislike
 *
 * @package likedislike
 * @subpackage lexicon
 * lang en
 */
$_lang['likedislik'] = 'LikeDislik';
$_lang['likedislike'] = 'LikeDislike';
$_lang['likedislike.home'] = 'Home';
$_lang['likedislike.ip_block'] = 'IP blocking';
$_lang['likedislike.desc'] = 'Manage your to vote for anything you want on your website.';
$_lang['likedislike.description'] = 'Description';
$_lang['likedislike.likedislik_err_ae'] = 'A likedislik with that name already exists.';
$_lang['likedislike.likedislik_err_nf'] = 'This here not found.';
$_lang['likedislike.likedislik_err_ns'] = 'This here not specified.';
$_lang['likedislike.likedislik_err_ns_multiple'] = 'Not a single selected.';
$_lang['likedislike.likedislik_err_ns_name'] = 'Please specify a name for the likedislik.';
$_lang['likedislike.likedislik_err_ip_name'] = 'Please specify an IP address for the here.';
$_lang['likedislike.likedislik_err_remove'] = 'An error occurred while trying to remove the likedislik.';
$_lang['likedislike.likedislik_err_save'] = 'An error occurred while trying to save the likedislik.';
$_lang['likedislike.likedislik_err_data'] = 'Invalid data.';
$_lang['likedislike.likedislik_err_ip_blocked'] = 'You have already voted on this item.';
$_lang['likedislike.likedislik_err_invalid_id'] = 'The item you voted on no longer exists.';
$_lang['likedislike.likedislik_err_closed'] = 'Voting has been closed for this item.';
$_lang['likedislike.likedislik_err_login_required'] = 'You need to login in order to vote.';
$_lang['likedislike.likedislik_create'] = 'Create New likeDislik';
$_lang['likedislike.ip_create'] = 'Add New IP adress';
$_lang['likedislike.likedislik_remove'] = 'Remove likeDislik';
$_lang['likedislike.likedislik_remove_ip'] = 'Remove IP adress';
$_lang['likedislike.likedislik_remove_ips'] = 'Remove selected IP adress';
$_lang['likedislike.likedislik_remove_confirm'] = 'Are you sure you want to remove this likedislik?';
$_lang['likedislike.likedislik_remove_ip_confirm'] = 'Are you sure you want to remove this IP address?';
$_lang['likedislike.likedislik_remove_ips_confirm'] = 'Are you sure you want to remove selected IP address?';
$_lang['likedislike.likedislik_update'] = 'Update likeDislik';
$_lang['likedislike.downloads'] = 'Downloads';
$_lang['likedislike.location'] = 'Location';
$_lang['likedislike.category_select'] = 'Select category';
$_lang['likedislike.all_category'] = 'All Categories';
$_lang['likedislike.management'] = 'likeDislike Management';
$_lang['likedislike.management_desc'] = 'Manage your to vote for anything you want on your website. You can edit them by voting "Up" and "Down" double-clicking on the appropriate cell.<br/>From below the date of publication, indication of the <strong>category</strong> (by default - class key resource) and a "/" - <strong>likeId</strong> (default - id of the resource)'; 
$_lang['likedislike.management_ip_desc'] = 'Manage your IP blocking here. List of IP numbers that are blocked. This means they cannot vote for any items.<br/>* Note: you can set wildcards by using the * symbol. --- Example: block all IPs that start with "123.123.123."';
$_lang['likedislike.likedislik_err_ap_adress'] = 'An incorrect IP address';
$_lang['likedislike.name'] = 'Name';
$_lang['likedislike.date'] = 'Date';
$_lang['likedislike.search...'] = 'Search...';
$_lang['likedislike.ip_adress'] = 'IP address';
$_lang['likedislike.ip_block_create'] = 'Add IP';
$_lang['likedislike.loading'] = '<div class="centered empty-msg">Loading..</div>';
$_lang['likedislike.items_empty_msg'] = '<h4>No records matched your search criteria</h4><p>Or you have not created any LikeDislike or no one opened a resource containing LikeDislike</p>';
$_lang['likedislike.items_empty_ip_msg'] = '<h4>No records matched your search criteria</h4><p>Or you have not added a new IP address, press the green button "Add IP"</p>';

$_lang['setting_likedislike.defaultTemplate'] = 'Default template';
$_lang['setting_likedislike.defaultTemplate_desc'] = 'The default formats to use for each template.<br/>See the online <a href="http://like.artdevue.com">documentation</a> for a more extensive explanation.';
$_lang['setting_likedislike.cookieCheck'] = 'Cookie check';
$_lang['setting_likedislike.cookieCheck_desc'] = 'Enable or disable a cookie check when a user votes. If a cookie is found that contains the current item ID, the user won\'t be able to vote for it again.<br /> Note: disabling this check will turn off any likeDislike cookies to be sent.<br/>// Yes or No  ';
$_lang['setting_likedislike.cookieName'] = 'Cookie name';
$_lang['setting_likedislike.cookieName_desc'] = 'The name of the likeDislike cookie.';
$_lang['setting_likedislike.cookieLifetime'] = 'Lifetime of the cookie';
$_lang['setting_likedislike.cookieLifetime_desc'] = 'The lifetime of the cookie. In other words, the number of seconds since the last vote before the cookie expires and gets deleted.<br/>If set to 0, the cookie will expire when the browser closes.<br/>example:3600 * 24 * 365 // 1 year';
$_lang['setting_likedislike.cookiePath'] = 'Cookie patch';
$_lang['setting_likedislike.cookiePath_desc'] = 'The path on the server in which the cookie will be available on.<br/>If set to \'/\', the cookie will be available within the entire domain.<br/>See: <a target="_blank" href="http://php.net/manual/function.setcookie.php">http://php.net/manual/function.setcookie.php</a>';
$_lang['setting_likedislike.cookieDomain'] = 'Cookie domain';
$_lang['setting_likedislike.cookieDomain_desc'] = 'The domain that the cookie is available on. You can make the cookie available across subdomains if you need to. Example: ".yoursite.com"<br/>See: <a target="_blank" href="http://php.net/manual/function.setcookie.php">http://php.net/manual/function.setcookie.php</a>';
$_lang['setting_likedislike.ipCheck'] = 'IP check';
$_lang['setting_likedislike.ipCheck_desc'] = 'Enable or disable an IP check when a user votes. If a previous vote for the item is found with the same IP, the user won\'t be able to vote for it again.<br/>Note: disabling this check will stop IP addresses from being stored upon vote.';
$_lang['setting_likedislike.ipLifetime'] = 'IP lifetime';
$_lang['setting_likedislike.ipLifetime_desc'] = 'The lifetime of an IP address. A user with the same IP address can vote for an item after this number of seconds has past since the last vote from the IP.<br/>If set to 0, IP addresses will not expire.';
$_lang['setting_likedislike.userIdCheck'] = 'User id check';
$_lang['setting_likedislike.userIdCheck_desc'] = 'Enable or disable a user ID check when a user votes. This will prevent registered users to cast multiple votes, regardless of the cookie and IP check settings.<br/>Note: this check does not prevent guests from voting. Set user_login_required to TRUE if you want to do so.';
$_lang['setting_likedislike.userLoginRequired'] = 'User login required';
$_lang['setting_likedislike.userLoginRequired_desc'] = 'If set to YES, users will have to be logged in in order to vote.<br/>Guests won\'t be able to vote.';

$_lang['likedislike.like_selected_publish'] = 'Publish selected';
$_lang['likedislike.like_selected_unpublish'] = 'Unpublish selected';
$_lang['likedislike.like_selected_delete'] = 'Remove selected';
$_lang['likedislike.like'] = 'like';
$_lang['likedislike.voting_closed'] = 'voting<br/>is closed';
$_lang['likedislike.thanks_vote'] = 'thanks<br/>for your vote';
$_lang['likedislike.question'] = 'And you?';
$_lang['likedislike.out_of'] = 'out of';
$_lang['likedislike.people_like_this'] = 'people like this.';
$_lang['likedislike.like_err_ns_multiple'] = 'Please select at least one LikeDislike. ';
$_lang['likedislike.year'] = 'year';
$_lang['likedislike.open'] = 'Open';
$_lang['likedislike.category'] = 'Category';
$_lang['likedislike.date_pub'] = 'Date publication';
$_lang['likedislike.up'] = 'Yes';
$_lang['likedislike.down'] = 'No';
$_lang['likedislike.total'] = 'Total';
$_lang['likedislike.balance'] = 'Balance';