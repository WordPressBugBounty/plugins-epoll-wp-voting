<?php 
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$it_epoll_string_args = array(
    'type' => 'string', 
    'sanitize_callback' => 'sanitize_text_field',
    'default' => NULL,
    );

$it_epoll_int_args = array(
    'type' => 'integer', 
    'sanitize_callback' => 'sanitize_text_field',
    'default' => NULL,
    );

//General Settings Options
register_setting( 'it_epoll_opt_settings', 'it_epoll_settings_show_frontend_branding', $it_epoll_int_args);
register_setting( 'it_epoll_opt_settings', 'it_epoll_settings_hcaptcha_voting', $it_epoll_int_args);
register_setting( 'it_epoll_opt_settings', 'it_epoll_settings_hcaptcha_key', $it_epoll_string_args);
register_setting( 'it_epoll_opt_settings', 'it_epoll_settings_hcaptcha_salt', $it_epoll_string_args);
register_setting( 'it_epoll_opt_settings', 'it_epoll_settings_enable_comments', $it_epoll_int_args);



//Social Sharing Options
register_setting( 'it_epoll_opt_settings', 'it_epoll_settings_voting_social_sharing', $it_epoll_int_args);
register_setting( 'it_epoll_opt_settings', 'it_epoll_settings_poll_social_sharing', $it_epoll_int_args);
register_setting( 'it_epoll_opt_settings', 'it_epoll_settings_social_option_facebook', $it_epoll_int_args);
register_setting( 'it_epoll_opt_settings', 'it_epoll_settings_social_option_twitter', $it_epoll_int_args);
register_setting( 'it_epoll_opt_settings', 'it_epoll_settings_social_option_whatsapp', $it_epoll_int_args);

//Advanced Options
register_setting( 'it_epoll_opt_settings', 'it_epoll_settings_hide_voting_result', $it_epoll_int_args);
register_setting( 'it_epoll_opt_settings', 'it_epoll_settings_hide_poll_result', $it_epoll_int_args);
