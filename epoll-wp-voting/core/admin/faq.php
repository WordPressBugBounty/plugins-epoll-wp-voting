<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$tab = 'general';
// phpcs:disable WordPress.Security.NonceVerification.Recommended -- Read-only admin tab navigation.
if(isset($_GET['tab'])){
    $tab = sanitize_key( wp_unslash( $_GET['tab'] ) );
}
// phpcs:enable WordPress.Security.NonceVerification.Recommended
?>
<div class="wrap">
    <h1><?php esc_attr_e('Frequently Asked Questions','epoll-wp-voting');?></h1>
    <div class="it_epoll_admin_extensions">
        <div class="it_epoll_admin_box">
        <div class="wp-filter">
        <ul class="filter-links">
            <li class="epoll_templates-overview">
                <a href="?page=epoll_faq&tab=general"<?php if($tab == 'general') echo esc_attr(' class=current','epoll-wp-voting');?>>
                    <?php esc_attr_e('General','epoll-wp-voting');?>    
                </a>
            </li>
           
        </ul>
        <a target="_blank" href="<?php echo esc_url('https://wordpress.org/support/plugin/epoll-wp-voting/','epoll-wp-voting');?>" type="button" class="button-primary button-small button-orange right" style="margin-top:12px;" role="button"><span class="upload"><?php esc_attr_e('Create Support Ticket','epoll-wp-voting');?></span></a>
        <a target="_blank" href="<?php echo esc_url('https://forum.infotheme.net/','epoll-wp-voting');?>" type="button" class="button-primary button-small right" style="margin-top:12px;     margin-right: 12px;" role="button"><span class="upload"><?php esc_attr_e('Ask Another Question?','epoll-wp-voting');?></span></a>
</div>
        <div class="it_epoll_admin_box_content">
            <div class="it_epoll_admin_box_item">
                <?php get_it_epoll_store_docs('forum');?>
            </div>
        </div>
        </div>
    </div>
</div>