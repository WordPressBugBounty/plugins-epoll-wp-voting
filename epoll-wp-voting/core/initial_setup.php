<?php 
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals -- Legacy dashboard callback names retained for backward compatibility.
/***************
 * Author: Rahul Negi
 * Team: InfoTheme
 * Date: 30-6-2022
 * Desc: Addon Loader , Loading as per requirement or request
 * Happy Coding.....
 **************/

if ( ! function_exists('it_epoll_admin_menus') ){

    add_action( 'admin_menu' , 'it_epoll_admin_menus' );

    /**
     * Generate sub menu page for settings
     *
     * @uses rushhour_projects_options_display()
     */
    function it_epoll_admin_menus()
    {

		add_menu_page(
			__('Epoll Dashboard', 'epoll-wp-voting'),
			__('ePoll', 'epoll-wp-voting'),
			'administrator',
			'epoll_dashboard',
			'show_it_epoll_dashboard',
			plugins_url( 'assets/imgs/epoll_logo.svg', dirname(__FILE__)),
			5
		);

		add_submenu_page('epoll_dashboard', 
		__('Epoll Dashboard', 'epoll-wp-voting'),
		__('Dashboard', 'epoll-wp-voting'),
		'manage_options', 
		'epoll_dashboard',
		null,
		0);

		add_submenu_page('epoll_dashboard', 
		__('Epoll Templates', 'epoll-wp-voting'),
		__('Templates', 'epoll-wp-voting'),
		'manage_options', 
		'epoll_templates',
		'show_it_epoll_dashboard_template',
		4);

		add_submenu_page('epoll_dashboard', 
		__('Epoll AddOns', 'epoll-wp-voting'),
		__('Add-ons', 'epoll-wp-voting'),
		'manage_options', 
		'epoll_addons',
		'show_it_epoll_dashboard_addons',
		5);
		add_submenu_page('epoll_dashboard', 
		__('Epoll Options', 'epoll-wp-voting'),
		__('Options', 'epoll-wp-voting'),
		'manage_options',
		'epoll_options',
		'show_it_epoll_dashboard_options',
		6);
		add_action( 'admin_init', 'it_epoll_options_settings' );

    
		add_submenu_page('epoll_dashboard', 
		__('Epoll How to Guide', 'epoll-wp-voting'),
		__('How To Guide', 'epoll-wp-voting'),
		'manage_options', 
		'epoll_docs',
		'show_it_epoll_dashboard_guide',
		7);
		add_submenu_page('epoll_dashboard', 
		__('FAQs', 'epoll-wp-voting'),
		__('Support & Faqs', 'epoll-wp-voting'),
		'manage_options', 
		'epoll_faq',
		'show_it_epoll_dashboard_faq',
		8);

		add_submenu_page('epoll_dashboard',
		__('Upgrade to Pro', 'epoll-wp-voting'),
		__('Upgrade to Pro', 'epoll-wp-voting'),
		'manage_options',
		'epoll_upgrade',
		'show_it_epoll_dashboard_upgrade',
		99);
		
    }
}

if(!function_exists('show_it_epoll_dashboard_template')){
	function show_it_epoll_dashboard_template(){
		include_once('admin/themes.php');
	}
}


if(!function_exists('show_it_epoll_dashboard_guide')){
	function show_it_epoll_dashboard_guide(){
		include_once('admin/guide.php');
	}
}

if(!function_exists('show_it_epoll_dashboard_faq')){
	function show_it_epoll_dashboard_faq(){
		include_once('admin/faq.php');
	}
}

if(!function_exists('show_it_epoll_dashboard_upgrade')){
	function show_it_epoll_dashboard_upgrade(){
		include_once('admin/upgrade.php');
	}
}



if(!function_exists('show_it_epoll_dashboard_options')){
	function show_it_epoll_dashboard_options(){
	
		include_once('admin/options.php');
	}
}



if(!function_exists('show_it_epoll_dashboard_addons')){
	function show_it_epoll_dashboard_addons(){
		include_once('admin/addons.php');
	}
}


if(!function_exists('show_it_epoll_dashboard')){

    function show_it_epoll_dashboard(){
        include_once('admin/dashboard.php');
    }
}


if(!function_exists('it_epoll_options_settings')){
	function it_epoll_options_settings(){
		include_once('admin/option_save.php');
		do_action('it_epoll_options_save_extra_settings');
	} 
}



if (!function_exists('it_epoll_poll_create_voting_post_type') ) {
	function it_epoll_poll_create_voting_post_type() {
	
		$labels = array(
			'name'                => _x( 'Voting Contests', 'Post Type General Name', 'epoll-wp-voting' ),
			'singular_name'       => _x( 'Voting Contest', 'Post Type Singular Name', 'epoll-wp-voting' ),
			'menu_name'           => __( 'Voting Contests', 'epoll-wp-voting' ),
			'name_admin_bar'      => __( 'Voting Contest', 'epoll-wp-voting' ),
			'parent_item_colon'   => __( 'Parent Contest:', 'epoll-wp-voting' ),
			'all_items'           => __( 'Voting', 'epoll-wp-voting' ),
			'add_new_item'        => __( 'Create Contest', 'epoll-wp-voting' ),
			'add_new'             => __( 'Create Contest', 'epoll-wp-voting' ),
			'new_item'            => __( 'New Contest', 'epoll-wp-voting' ),
			'edit_item'           => __( 'Edit Contest', 'epoll-wp-voting' ),
			'update_item'         => __( 'Update Contest', 'epoll-wp-voting' ),
			'view_item'           => __( 'View Contest', 'epoll-wp-voting' ),
			'search_items'        => __( 'Search Contests', 'epoll-wp-voting' ),
			'not_found'           => __( 'Not found', 'epoll-wp-voting' ),
			'not_found_in_trash'  => __( 'Not found in Trash', 'epoll-wp-voting' ),
		);
		$args = array(
			'label'               => __( 'Voting Contest', 'epoll-wp-voting' ),
			'description'         => __( 'Voting Contest Description', 'epoll-wp-voting' ),
			'labels'              => $labels,
			'supports'            => array( 'title','thumbnail','revisions','comments'),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        =>'epoll_dashboard',
			'menu_icon'			  => 'dashicons-chart-pie',
			'show_in_admin_bar'   => true,
			'show_in_nav_menus'   => true,
			'can_export'          => true,
			'has_archive'         => true,
			'menu_position'		  => 2,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'rewrite' 			  => array('slug' => 'contest'),
			'capability_type'     => 'page',
		);
		register_post_type( 'it_epoll_poll', $args );
		flush_rewrite_rules(true);
	}
	
	// Hook into the 'init' action
	add_action( 'init', 'it_epoll_poll_create_voting_post_type', 2 );
}
	

if (!function_exists('it_epoll_poll_create_poll_post_type') ) {
function it_epoll_poll_create_poll_post_type() {

	$labels = array(
		'name'                => _x( 'Polls', 'Post Type General Name', 'epoll-wp-voting' ),
		'singular_name'       => _x( 'Poll', 'Post Type Singular Name', 'epoll-wp-voting' ),
		'menu_name'           => __( 'Polls', 'epoll-wp-voting' ),
		'name_admin_bar'      => __( 'Poll', 'epoll-wp-voting' ),
		'parent_item_colon'   => __( 'Parent Poll:', 'epoll-wp-voting' ),
		'all_items'           => __( 'Poll', 'epoll-wp-voting' ),
		'add_new_item'        => __( 'Create Poll', 'epoll-wp-voting' ),
		'add_new'             => __( 'Create Poll', 'epoll-wp-voting' ),
		'new_item'            => __( 'New Poll', 'epoll-wp-voting' ),
		'edit_item'           => __( 'Edit Poll', 'epoll-wp-voting' ),
		'update_item'         => __( 'Update Poll', 'epoll-wp-voting' ),
		'view_item'           => __( 'View Poll', 'epoll-wp-voting' ),
		'search_items'        => __( 'Search Polls', 'epoll-wp-voting' ),
		'not_found'           => __( 'Not found', 'epoll-wp-voting' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'epoll-wp-voting' ),
	);
	$args = array(
		'label'               => __( 'Poll', 'epoll-wp-voting' ),
		'description'         => __( 'Poll Description', 'epoll-wp-voting' ),
		'labels'              => $labels,
		'supports'            => array( 'title','thumbnail','revisions','comments'),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        =>'epoll_dashboard',
		'menu_icon'			  => 'dashicons-chart-pie',
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => true,
		'menu_position'		  => 2,		
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'rewrite' 			  => array('slug' => 'poll'),
		'capability_type'     => 'page',
	);
	register_post_type( 'it_epoll_opinion', $args );
	flush_rewrite_rules(true);
}

// Hook into the 'init' action
add_action( 'init', 'it_epoll_poll_create_poll_post_type', 3 );
}
// phpcs:enable WordPress.NamingConventions.PrefixAllGlobals