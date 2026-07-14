<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="wrap">
    <h1><?php esc_attr_e('Templates','epoll-wp-voting');?></h1>
    <p class="description"><?php esc_attr_e('Installed poll and contest templates bundled with ePoll.','epoll-wp-voting');?></p>
    <div class="it_epoll_admin_extensions">
        <?php get_it_epoll_local_themes(); ?>
    </div>
</div>
