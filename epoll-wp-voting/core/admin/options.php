<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>
<div class="wrap">
<form method="post" action="options.php" id="it_epoll_options_fields">
    <h1 class="epoll_admin_options-header">
        <?php esc_attr_e('Options','epoll-wp-voting');?>
        <button type="submit" class="page-title-action button button-primary right" role="submit"><span class="upload"><?php esc_attr_e('Save Changes','epoll-wp-voting');?></span></button>
        <a href="<?php echo esc_url( admin_url( 'admin.php?page=epoll_upgrade' ) ); ?>" class="button right" style="margin:0 25px;position:relative;bottom:3px;" role="button"><span class="upload"><?php esc_attr_e('Upgrade to Pro','epoll-wp-voting');?></span></a>
   </h1>
    <?php
         settings_fields( 'it_epoll_opt_settings' );
         do_settings_sections( 'it_epoll_opt_settings' );
         ?>
        <div class="epoll_admin_options-container">
            <div class="epoll_admin_options-tabs">
                <ul class="epoll_admin_options-tabs-container">
                    <li>
                        <a href="#general" class="epoll_admin_option-item current">
                        <i class="dashicons dashicons-admin-settings"></i> <?php esc_attr_e('General','epoll-wp-voting');?>
                        </a>
                    </li>
                    <li>
                        <a href="#sharing" class="epoll_admin_option-item">
                        <i class="dashicons dashicons-share"></i> <?php esc_attr_e('Sharing','epoll-wp-voting');?>
                        </a>
                    </li>
                    <li>
                        <a href="#advanced" class="epoll_admin_option-item">
                        <i class="dashicons dashicons-admin-generic"></i> <?php esc_attr_e('Advanced','epoll-wp-voting');?>
                        </a>
                    </li>
                    <li>
                        <a href="#pro" class="epoll_admin_option-item it_epoll-pro-tab-link">
                        <i class="dashicons dashicons-lock"></i> <?php esc_attr_e('Pro Features','epoll-wp-voting');?> <span class="it_epolladmin_pro_badge"><?php esc_attr_e('Pro','epoll-wp-voting');?></span>
                        </a>
                    </li>
                    <li>
                        <a href="#translate" class="epoll_admin_option-item">
                        <i class="dashicons dashicons-admin-site"></i> <?php esc_attr_e('Localize / Translation','epoll-wp-voting');?>
                        </a>
                    </li>
                    <?php do_action('it_epoll_options_extra_tabs_title');?>
                </ul>
            </div>
            <div class="epoll_admin_options_tab-content">
                <div class="epoll_admin_options-tabs-content current" id="general">
                    <table class="widefat no-border-table">
                        <tbody>
                          
                            <tr>
                                <td>   
                                    <label>
                                        <input class="it_epoll_has_oncheck_div" type="checkbox" name="it_epoll_settings_hcaptcha_voting" value="1"<?php if(get_option('it_epoll_settings_hcaptcha_voting')) echo esc_attr(' checked','epoll-wp-voting');?>/> <?php esc_attr_e('Enable hCaptch on Voting','epoll-wp-voting');?>
                                    </label>
                                    <div class="it_epoll_oncheck_div <?php if(get_option('it_epoll_settings_hcaptcha_voting')) echo esc_attr(' it_epoll_oncheck_div_show','epoll-wp-voting');?>">
                                        <label><?php esc_attr_e('hCaptcha Key','epoll-wp-voting');?></label>
                                        <input type="text" class="widefat" name="it_epoll_settings_hcaptcha_key" value="<?php echo esc_attr(get_option('it_epoll_settings_hcaptcha_key'),'epoll-wp-voting');?>"/>
                                        <hr>
                                        <label><?php esc_attr_e('hCaptcha Security Salt','epoll-wp-voting');?></label>
                                        <input type="text" class="widefat" name="it_epoll_settings_hcaptcha_salt" value="<?php echo esc_attr(get_option('it_epoll_settings_hcaptcha_salt'),'epoll-wp-voting');?>"/>
                                    
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>   
                                    <label>
                                        <input type="checkbox" name="it_epoll_settings_enable_comments"  value="1" <?php if(get_option('it_epoll_settings_enable_comments') == 1) echo esc_attr(' checked','epoll-wp-voting');?>/> <?php esc_attr_e('Enable Comments on Vote','epoll-wp-voting');?>
                                    </label>
                                </td>
                            </tr>

                            <tr>
                                <td>   
                                    <label>
                                        <input type="checkbox" name="it_epoll_settings_show_frontend_branding" value="1"<?php if(get_option('it_epoll_settings_show_frontend_branding')) echo esc_attr(' checked','epoll-wp-voting');?>/> <?php esc_attr_e('Show poll footer branding link on the frontend (opt-in)','epoll-wp-voting');?>
                                    </label>
                                </td>
                            </tr>

                         
                          
                        </tbody>
                    </table>
                    <?php do_action('it_epoll_options_general_fields');?>
                </div>
                <div class="epoll_admin_options-tabs-content" id="sharing">
                <table class="widefat no-border-table">
                        <tbody>
                            <tr>
                                <td>
                                    <label>
                                        <input type="checkbox" name="it_epoll_settings_voting_social_sharing" value="1"<?php if(get_option('it_epoll_settings_voting_social_sharing')) echo esc_attr(' checked','epoll-wp-voting');?>/> <?php esc_attr_e('Enable Social Sharing on Voting','epoll-wp-voting');?>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>
                                        <input type="checkbox" name="it_epoll_settings_poll_social_sharing" value="1"<?php if(get_option('it_epoll_settings_poll_social_sharing')) echo esc_attr(' checked','epoll-wp-voting');?>/> <?php esc_attr_e('Enable Social Sharing on Poll','epoll-wp-voting');?>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>
                                        <input type="checkbox" name="it_epoll_settings_social_option_facebook" value="1"<?php if(get_option('it_epoll_settings_social_option_facebook')) echo esc_attr(' checked','epoll-wp-voting');?>/> <?php esc_attr_e('Facebook','epoll-wp-voting');?>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>
                                        <input type="checkbox" name="it_epoll_settings_social_option_twitter"  value="1"<?php if(get_option('it_epoll_settings_social_option_twitter')) echo esc_attr(' checked','epoll-wp-voting');?>/> <?php esc_attr_e('Twitter','epoll-wp-voting');?>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>
                                        <input type="checkbox" name="it_epoll_settings_social_option_whatsapp" value="1"<?php if(get_option('it_epoll_settings_social_option_whatsapp')) echo esc_attr(' checked','epoll-wp-voting');?>/> <?php esc_attr_e('WhatsApp','epoll-wp-voting');?>
                                    </label>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <?php do_action('it_epoll_options_sharing_fields');?>
                </div>
                <div class="epoll_admin_options-tabs-content" id="advanced">
                    <table class="widefat no-border-table">
                        <tbody>
                            <tr>
                                <td>   
                                    <label>
                                        <input type="checkbox" name="it_epoll_settings_hide_voting_result" value="1"<?php if(get_option('it_epoll_settings_hide_voting_result')) echo esc_attr(' checked','epoll-wp-voting');?>/> <?php esc_attr_e('Hide All Voting Results','epoll-wp-voting');?>
                                    </label>
                                </td>
                            </tr> 
                            <tr>
                                <td>  
                                    <label>
                                        <input type="checkbox" name="it_epoll_settings_hide_poll_result" value="1"<?php if(get_option('it_epoll_settings_hide_poll_result')) echo esc_attr(' checked','epoll-wp-voting');?>/> <?php esc_attr_e('Hide All Poll Results','epoll-wp-voting');?>
                                    </label> 
                                </td>
                            </tr> 
                        </tbody>
                    </table>   
                    <?php do_action('it_epoll_options_advanced_fields');?>
                </div>
                <div class="epoll_admin_options-tabs-content" id="pro">
                    <?php include __DIR__ . '/partials/options-pro-features.php'; ?>
                </div>
                <div class="epoll_admin_options-tabs-content" id="translate">
                   
                    <?php do_action('it_epoll_options_translate_fields');?>
                </div>
                <?php do_action('it_epoll_options_extra_tabs_content');?>
            </div>
        </div>
    </form>
    <p class="epoll_admin_options-footer"><?php echo esc_attr('ePoll Version '.IT_EPOLL_VERSION,'epoll-wp-voting');?></p>
</div>
<script type="text/javascript">
    jQuery.noConflict();
    jQuery(document).ready(function($) {

        var tabsUi = jQuery('.epoll_admin_options-tabs');
      
        tabsUi.find('> ul li a').click(function() {
            var hash = jQuery(this).attr('href');
            
            jQuery('.epoll_admin_options-tabs ul li').each(function(){
                jQuery(this).find('a').removeClass('current');
            });
            jQuery(this).addClass('current');
        });
        jQuery(window).bind('hashchange', function() {
            if (location.hash !== '') {
                var tabNum = location.hash;

                jQuery('.epoll_admin_options_tab-content .epoll_admin_options-tabs-content').each(function(){
                    jQuery(this).removeClass('current');
                });

                jQuery('.epoll_admin_options_tab-content '+tabNum).addClass('current');
                itEpollOptionsToggleProModal();
            } else {
                jQuery('.epoll_admin_options_tab-content #general').addClass('current');
            }
        });

        function itEpollOptionsToggleProModal() {
            var $panel = jQuery('#pro.it_epoll-pro-features-panel, #pro .it_epoll-pro-features-panel');
            var $modal = jQuery('#it_epoll_pro_upgrade_modal');
            var $overlay = jQuery('.it_epoll-pro-features-overlay');

            if (location.hash === '#pro') {
                $overlay.addClass('is-visible');
                $modal.removeClass('is-hidden');
            }
        }

        jQuery('.it_epoll-pro-tab-link').on('click', function() {
            setTimeout(itEpollOptionsToggleProModal, 0);
        });

        jQuery('.it_epoll-pro-features-overlay').on('click', function(e) {
            if (jQuery(e.target).is('.it_epoll-pro-features-overlay')) {
                jQuery('#it_epoll_pro_upgrade_modal').removeClass('is-hidden');
            }
        });

        jQuery('#it_epoll_pro_upgrade_modal').on('click', function(e) {
            e.stopPropagation();
        });

        jQuery('.it_epoll-pro-modal-close').on('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            jQuery('#it_epoll_pro_upgrade_modal').addClass('is-hidden');
        });

        jQuery(document).on('keyup', function(e) {
            if (e.key === 'Escape') {
                jQuery('#it_epoll_pro_upgrade_modal').addClass('is-hidden');
            }
        });

        if (location.hash === '#notifications') {
            location.hash = '#pro';
        }

        if (location.hash === '#pro') {
            jQuery('.epoll_admin_options_tab-content .epoll_admin_options-tabs-content').removeClass('current');
            jQuery('#pro').addClass('current');
            jQuery('.epoll_admin_options-tabs-container a').removeClass('current');
            jQuery('.epoll_admin_options-tabs-container a[href="#pro"]').addClass('current');
            itEpollOptionsToggleProModal();
        }
    });

    jQuery('.epoll_admin_options_tab-content .epoll_admin_options-tabs-content').each(function(){
        jQuery(this).find('.it_epoll_has_oncheck_div').on('change',function(){
            //alert("dsdsd");
           // console.log(jQuery(this).parent().parent().find('.it_epoll_oncheck_div'));
            if(jQuery(this).is(":checked")){
                jQuery(this).parent().parent().find('.it_epoll_oncheck_div').addClass('it_epoll_oncheck_div_show');
            }else{
                jQuery(this).parent().parent().find('.it_epoll_oncheck_div').removeClass('it_epoll_oncheck_div_show');
            }
           
        });
    });
    </script>