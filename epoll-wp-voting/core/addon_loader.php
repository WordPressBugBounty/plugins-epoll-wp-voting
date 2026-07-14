<?php 
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/***************
 * Author: Rahul Negi
 * Team: InfoTheme
 * Date: 30-6-2022
 * Desc: Addon Loader , Loading as per requirement or request
 * Happy Coding.....
 **************/
if(!function_exists('it_epoll_load_addon')){
    
    function it_epoll_load_addon(){
        $active_addons = array('default','default-1');

        if(get_option('it_epoll_active_addon')){
            $active_addons = get_option('it_epoll_active_addon');
        }
        array_map('it_epoll_connect_addons',$active_addons);
    }

}

if(!function_exists('it_epoll_connect_addons')){
    function it_epoll_connect_addons($addon){
        $addon_path = it_epoll_resolve_addon_path( $addon );
        $addon_file = $addon_path ? $addon_path . 'addon.php' : '';
        if ( $addon_file && is_file( $addon_file ) ) {
            include_once( $addon_file );
        }
    }
}

if(!function_exists('it_epoll_run_activator_script_addon')){
    function it_epoll_run_activator_script_addon($addon){
        $addon_path = it_epoll_resolve_addon_path( $addon );
        $addon_file = $addon_path ? $addon_path . 'activate.php' : '';
        
        if ( $addon_file && is_file( $addon_file ) ) {
            include_once( $addon_file );
            do_action('it_epoll_activate_intial_script'); 
       
        }
    }
}


if(!function_exists('it_epoll_run_deactivator_script_addon')){
    function it_epoll_run_deactivator_script_addon($addon){
        $addon_path = it_epoll_resolve_addon_path( $addon );
        $addon_file = $addon_path ? $addon_path . 'deactivate.php' : '';
        if ( $addon_file && is_file( $addon_file ) ) {
            include_once( $addon_file );
            do_action('it_epoll_deactivate_intial_script'); 
        }
    }
}

it_epoll_load_addon(); // Calling Load Addon;
