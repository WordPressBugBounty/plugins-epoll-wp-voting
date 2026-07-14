<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'it_epoll_should_show_frontend_branding' ) ) {
	function it_epoll_should_show_frontend_branding() {
		return (bool) get_option( 'it_epoll_settings_show_frontend_branding' );
	}
}

if ( ! function_exists( 'it_epoll_set_vote_tracking_cookie' ) ) {
	function it_epoll_set_vote_tracking_cookie( $cookie_key, $cookie_value ) {
		if ( headers_sent() ) {
			return;
		}
		setcookie(
			$cookie_key,
			$cookie_value,
			time() + ( DAY_IN_SECONDS * 30 ),
			COOKIEPATH ? COOKIEPATH : '/',
			COOKIE_DOMAIN,
			is_ssl(),
			true
		);
		$_COOKIE[ $cookie_key ] = $cookie_value;
	}
}

//Set Voting Session with Key and Value Pair
if(!function_exists('it_epoll_generate_unique_vote_session')){
	function it_epoll_generate_unique_vote_session($session_key,$poll_id=''){
		$poll_restriction = get_post_meta($poll_id,'it_epoll_poll_voting_restriction',true);
		if($poll_restriction){
			it_epoll_set_vote_tracking_cookie( $session_key, uniqid( 'epoll_', true ) );
		}
	}
}


//Initialize Voting Session
if(!function_exists('it_epoll_unset_unique_vote_session')){
	function it_epoll_unset_unique_vote_session($session_key){
		if ( headers_sent() ) {
			return;
		}
		unset( $_COOKIE[ $session_key ] );
		setcookie( $session_key, '', time() - DAY_IN_SECONDS, COOKIEPATH ? COOKIEPATH : '/', COOKIE_DOMAIN, is_ssl(), true );
	}
}

// Vote tracking uses HTTP cookies only (no PHP sessions on frontend).
if(!function_exists('it_epoll_init_unique_vote_session')){
	function it_epoll_init_unique_vote_session(){
		return;
	}
}



//Get Voting Session
if(!function_exists('it_epoll_get_unique_vote_session')){
	function it_epoll_get_unique_vote_session($session_key){
		if(isset($_COOKIE[$session_key])){
			return sanitize_text_field( wp_unslash( $_COOKIE[$session_key] ) );
		}
		return '';
	}
}


if(!function_exists('it_epoll_check_for_unique_voting')){

	function it_epoll_check_for_unique_voting($poll_id,$option_id){
		if(get_post_meta($poll_id,'it_epoll_poll_status',true) == 'end'){
			return true;
		}
		do_action('it_epoll_check_for_unique_voting_add_rules', array('poll_id'=>$poll_id,'option_id'=>$option_id));
		return apply_filters( 'it_epoll_check_for_unique_voting_callback', false, array('poll_id'=>$poll_id,'option_id'=>$option_id));
	}
}

//update and confirm data to results table
if(!function_exists('it_epoll_updateIPBasedData')){
    function it_epoll_updateIPBasedData($args){
        do_action('it_epoll_update_voter_available_data',$args);
		return apply_filters('it_epoll_update_voter_available_data_callback',false);
    }
}

//adding data to results table
if(!function_exists('it_epoll_saveIPBasedData')){
    function it_epoll_saveIPBasedData($args){
         do_action('it_epoll_save_voter_available_data',$args);
		return apply_filters('it_epoll_save_voter_available_data_callback',false);
    }
}

//adding check vooting uniquenesss option
if(!function_exists('it_epoll_check_for_unique_vote_default_addon_rule')){
	add_action('it_epoll_check_for_unique_voting_add_rules','it_epoll_check_for_unique_vote_default_addon_rule');
	function it_epoll_check_for_unique_vote_default_addon_rule($args){
		$poll_id = $args['poll_id'];
		$option_id = $args['option_id'];
		
		if(get_post_meta($poll_id,'it_epoll_poll_multichoice',true)){
			
			if(it_epoll_get_unique_vote_session('it_epoll_session_'.$option_id)){
				remove_filter('it_epoll_check_for_unique_voting_callback','__return_true');
				add_filter('it_epoll_check_for_unique_voting_callback','__return_true');
            }else{
				remove_filter('it_epoll_check_for_unique_voting_callback','__return_false');
                add_filter('it_epoll_check_for_unique_voting_callback','__return_false');
			}
		}else{
			if(it_epoll_get_unique_vote_session('it_epoll_session_'.$poll_id)){
				remove_filter('it_epoll_check_for_unique_voting_callback','__return_true');
				add_filter('it_epoll_check_for_unique_voting_callback','__return_true');
			}else{
				if(it_epoll_get_unique_vote_session('it_epoll_session')){
					remove_filter('it_epoll_check_for_unique_voting_callback','__return_true');
					add_filter('it_epoll_check_for_unique_voting_callback','__return_true');
				}else{
					remove_filter('it_epoll_check_for_unique_voting_callback','__return_false');
					add_filter('it_epoll_check_for_unique_voting_callback','__return_false');
				}
			}
		}
	}
	
}


//Set poll End cron
if(!function_exists('it_epoll_add_cront_event_to_update_poll_end_status')){

	add_filter( 'it_epoll_poll_schedule_cron_event', 'it_epoll_add_cront_event_to_update_poll_end_status' );

	function it_epoll_add_cront_event_to_update_poll_end_status( $post_id ) {
	$args = array( $post_id );
	$hook = 'it_epoll_poll_update_cron_end_event';
	$timestamp_after_hour = get_post_meta($post_id,'it_epoll_vote_end_date_time',true);
	$scheduled_timestamp = wp_next_scheduled( $hook, $args );
	
	if( $scheduled_timestamp == false && $timestamp_after_hour) {
		wp_schedule_single_event( strtotime($timestamp_after_hour), $hook, $args );
	}
  
	}
}

if(!function_exists('it_epoll_process_event_status_end_update')){

	add_action( 'it_epoll_poll_update_cron_end_event', 'it_epoll_process_event_status_end_update' );
	function it_epoll_process_event_status_end_update( $post_id ) {
	  update_post_meta($post_id,'it_epoll_poll_status','end');
	}
}

//Set poll Start cron
if(!function_exists('it_epoll_add_cront_event_to_update_poll_status')){

	add_filter( 'it_epoll_poll_schedule_cron_event', 'it_epoll_add_cront_event_to_update_poll_status' );

	function it_epoll_add_cront_event_to_update_poll_status( $post_id ) {
	$args = array( $post_id );
	$hook = 'it_epoll_poll_update_cron_start_event';
	$timestamp_after_hour = get_post_meta($post_id,'it_epoll_vote_start_date_time',true);
	$scheduled_timestamp = wp_next_scheduled( $hook, $args );
		
		if( $scheduled_timestamp == false && $timestamp_after_hour && $timestamp_after_hour != gmdate('Y-m-d')) {
			update_post_meta($post_id,'it_epoll_poll_status','upcoming');
			wp_schedule_single_event( strtotime($timestamp_after_hour), $hook, $args );
		}
	}
}

if(!function_exists('it_epoll_process_event_status_update')){

	add_action( 'it_epoll_poll_update_cron_start_event', 'it_epoll_process_event_status_update' );
	function it_epoll_process_event_status_update( $post_id ) {
		update_post_meta($post_id,'it_epoll_poll_status','live');
	}
}

if(!function_exists('it_epoll_get_branding_sharer_text')){
	function it_epoll_get_branding_sharer_text(){
		if ( ! it_epoll_should_show_frontend_branding() ) {
			return '';
		}
		return __( ' Via WP Poll & Voting Contest Maker https://wordpress.org/plugins/epoll-wp-voting/', 'epoll-wp-voting' );
	}
}

if(!function_exists('it_epoll_get_branding_text')){
	function it_epoll_get_branding_text(){
		if ( ! it_epoll_should_show_frontend_branding() ) {
			return '';
		}
		return __( 'Via WP Poll & Voting Contest Maker', 'epoll-wp-voting' );
	}
}
