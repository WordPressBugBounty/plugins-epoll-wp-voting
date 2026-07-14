<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="wrap">
    <h1><?php esc_attr_e('Add-ons','epoll-wp-voting');?></h1>
    <p class="description"><?php esc_attr_e('Installed add-ons bundled with ePoll.','epoll-wp-voting');?></p>
    <div class="it_epoll_admin_extensions">
        <?php get_it_epoll_local_addons(); ?>
    </div>
</div>
