<?php
/*
Plugin Name: ePoll – Contest Poll Survey & Voting
Plugin URI: https://infotheme.net/epoll-pro/
Description: ePoll is an advanced voting poll system and online contest system designed to integrate voting, polls, surveys, and election quizzes into your posts and pages via shortcode.
Author: Poll Maker & Voting Team (InfoTheme)
Author URI: https://www.infotheme.net
Version: 3.9
Tags: poll, contest, voting, survey, election, polling, vote, shortcode
Text Domain: epoll-wp-voting
Requires at least: 5.0
Requires PHP: 7.4
Domain Path: /languages
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/*###############################################################
    EPOLL 3.1 Lite (A Complete Event/Contest/Voting System)
##############################################################*/
/*********Plugin Initialization*/
require_once( ABSPATH . 'wp-admin/includes/plugin.php' );


/**ACTIVATOR*/
register_activation_hook(__FILE__, 'it_epoll_activate');

//E Poll Activation
if(!function_exists('it_epoll_activate')){
	function it_epoll_activate(){}
}else{
	$plugin = dirname(__FILE__) . '/it-epoll.php';
	deactivate_plugins($plugin);
	wp_die(esc_html('<div class="plugins">
				<h2>Epoll 3.4 Plugin Activation Error!</h2>
				<p style="background: #ffef80;padding: 10px 15px;border: 1px solid #ffc680;">We Found that you are using Our Plugin\'s Another Version, Please Deactivate That Version & than try to re-activate it. 
				Don\'t worry free plugins data will be automatically migrate into this version. 
				Thanks!</p>
			</div>','epoll-wp-voting'),'Plugin Activation Error',array('response'=>200,'back_link'=>TRUE));
}

/**ACTIVATOR*/
register_activation_hook(__FILE__, 'it_epoll_deactivate');

//E Poll Deactivation
if(!function_exists('it_epoll_deactivate')){
	function it_epoll_deactivate(){}
}


/********Constants *********/
define( 'IT_EPOLL_DIR_PATH', plugin_dir_path( __FILE__ ) ); // Root Plugin Directory Define
define( 'IT_EPOLL_DIR_URL', plugin_dir_url( __FILE__ ) ); // Root Plugin URI Define
define( 'IT_EPOLL_VERSION', '3.9'); // Root Plugin Version
define( 'IT_EPOLL_EXTENSION_STORE_URL', esc_url('https://store.infotheme.net/epoll/plugins/','epoll-wp-voting') ); // Root Plugin Directory Define
define( 'IT_EPOLL_THEME_STORE_URL', esc_url('https://store.infotheme.net/epoll/themes/','epoll-wp-voting') ); // Root Plugin Directory Define
define( 'IT_EPOLL_DOC_STORE_URL', esc_url('https://store.infotheme.net/epoll/doc/','epoll-wp-voting') ); // Root Plugin Directory Define
define( 'IT_EPOLL_THUMBNAIL_CDN_URL', esc_url('https://store.infotheme.net/epoll/thumbnail/','epoll-wp-voting') ); // Root Plugin Directory Define
define( 'IT_EPOLL_DOWNLOAD_URL', esc_url('https://store.infotheme.net/epoll/download/','epoll-wp-voting') ); // Root Plugin Directory Define

include_once('core/initial_setup.php');	
include_once('core/extras.php');		
include_once('backend/metaboxes.php');
include_once('core/enque_scripts.php');	
include_once('core/addon_loader.php');
include_once('core/template_loader.php');
include_once('core/shortcode_loader.php');
include_once('core/admin/admin_ajax.php');
?>