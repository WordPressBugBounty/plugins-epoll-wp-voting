<?php 
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/***************
 * Author: Rahul Negi
 * Team: InfoTheme
 * Date: 30-6-2022
 * Desc: Custom Post Type Single Page Template , Loading as per requirement or request
 * Happy Coding.....
 **************/

if(!function_exists('it_epoll_load_theme')){
    
    function it_epoll_load_theme(){
        $active_themes = array('default','default-1');

        if(get_option('it_epoll_active_theme')){
            $active_themes = get_option('it_epoll_active_theme');
        }
        array_map('it_epoll_connect_themes',$active_themes);
    }

}

if(!function_exists('it_epoll_connect_themes')){
    function it_epoll_connect_themes($theme){

        $theme_path = it_epoll_resolve_theme_path( $theme );
        $theme_file = $theme_path ? $theme_path . 'template.php' : '';
        if ( $theme_file && file_exists( $theme_file ) ) {
            include_once( $theme_file );
        } else {
			$default_path = it_epoll_resolve_theme_path( 'default' );
			$theme_file   = $default_path ? $default_path . 'template.php' : IT_EPOLL_DIR_PATH . 'frontend/templates/default/template.php';
			include_once( $theme_file );
		}
    }
}

if(!function_exists('it_epoll_activated_themes_data')){
	function it_epoll_activated_themes_data(){

	}

}


it_epoll_load_theme(); // Calling Load Theme;

if(!function_exists('it_epoll_get_poll_template')){
	
	add_filter( 'single_template', 'it_epoll_get_poll_template' );
    
	function it_epoll_get_poll_template($single_template) {
		global $post;
        $active_theme = 'default';
		$active_theme = get_post_meta($post->ID,'it_epoll_poll_theme',true);
		
		if ($post->post_type == 'it_epoll_poll') {
			$theme_base = it_epoll_resolve_theme_path( $active_theme );
			$single_template_file = $theme_base ? $theme_base . 'cpt/it_epoll_poll.php' : '';
				
			if ( $single_template_file && is_file( $single_template_file ) ) {
				$single_template = $single_template_file;
			} else {
				$default_base = it_epoll_resolve_theme_path( 'default' );
				$single_template = $default_base ? $default_base . 'cpt/it_epoll_poll.php' : IT_EPOLL_DIR_PATH . 'frontend/templates/default/cpt/it_epoll_poll.php';
			}
		}//Template to load poll

		if ($post->post_type == 'it_epoll_opinion') {
			$theme_base = it_epoll_resolve_theme_path( $active_theme );
			$single_template_file = $theme_base ? $theme_base . 'cpt/it_epoll_opinion.php' : '';
				
			if ( $single_template_file && is_file( $single_template_file ) ) {
				$single_template = $single_template_file;
			} else {
				$default_base = it_epoll_resolve_theme_path( 'default' );
				$single_template = $default_base ? $default_base . 'cpt/it_epoll_opinion.php' : IT_EPOLL_DIR_PATH . 'frontend/templates/default/cpt/it_epoll_opinion.php';
			}
		}//Template to load voting
		
		return $single_template;
	}
}
