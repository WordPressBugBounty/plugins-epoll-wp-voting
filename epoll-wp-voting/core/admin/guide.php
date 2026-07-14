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
    <h1><?php esc_attr_e('Tutorials','epoll-wp-voting');?></h1>
    <div class="it_epoll_admin_extensions">
        <div class="it_epoll_admin_box">
        <div class="wp-filter">
        <ul class="filter-links">
            <li class="epoll_templates-overview">
                <a href="?page=epoll_docs&tab=general"<?php if($tab=='general') echo esc_attr(' class=current','epoll-wp-voting');?>>
                    <?php esc_attr_e('General','epoll-wp-voting');?>    
                </a>
            </li>
            <li class="epoll_templates-overview">
                <a href="?page=epoll_docs&tab=voting"<?php if($tab=='voting') echo esc_attr(' class=current','epoll-wp-voting');?>>
                    <?php esc_attr_e('Voting','epoll-wp-voting');?>    
                </a>
            </li>
            <li class="epoll_templates-overview">
                <a href="?page=epoll_docs&tab=poll"<?php if($tab=='poll') echo esc_attr(' class=current','epoll-wp-voting');?>>
                    <?php esc_attr_e('Poll','epoll-wp-voting');?>    
                </a>
            </li>
            <li class="epoll_templates-overview">
                <a href="?page=epoll_docs&tab=troubleshooting"<?php if($tab=='troubleshooting') echo esc_attr(' class=current','epoll-wp-voting');?>>
                    <?php esc_attr_e('Troubleshooting','epoll-wp-voting');?>    
                </a>
            </li>
        </ul>
</div>
        <div class="it_epoll_admin_box_content">
            <div class="it_epoll_admin_box_item">
             <?php get_it_epoll_store_docs($tab);?>
              
            </div>
        </div>
        </div>
    </div>
</div>