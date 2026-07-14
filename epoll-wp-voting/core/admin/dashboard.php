<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$tab = 'overview';
// phpcs:disable WordPress.Security.NonceVerification.Recommended -- Read-only admin tab navigation.
if(isset($_GET['tab'])){
    $tab = sanitize_key( wp_unslash( $_GET['tab'] ) );
}
// phpcs:enable WordPress.Security.NonceVerification.Recommended
?>
<div class="wrap">
    <h1><?php esc_attr_e('Dashboard','epoll-wp-voting');?></h1>

    <div class="wp-filter">
        <ul class="filter-links">
            <li class="epoll_templates-overview">
                <a href="?page=epoll_dashboard&tab=overview"<?php if($tab == 'overview') echo esc_attr(' class=current','epoll-wp-voting');?>>
                    <?php esc_attr_e('Overview','epoll-wp-voting');?>    
                </a>
            </li>
            <li class="epoll_templates-reports">
                <a href="?page=epoll_dashboard&tab=reports"<?php if($tab == 'reports' || $tab == 'view_report') echo esc_attr(' class=current','epoll-wp-voting');?>>
                    <?php esc_attr_e('Reports','epoll-wp-voting');?>
                </a>
            </li>
            <li class="epoll_templates-reports">
                <a href="<?php echo esc_url( admin_url( 'admin.php?page=epoll_upgrade' ) ); ?>">
                    <?php esc_attr_e('Upgrade to Pro','epoll-wp-voting');?>
                </a>
            </li>
            <li class="epoll_templates-reports">
            <a href="<?php echo esc_url('https://infotheme.net/documentation/epoll-3-1-pro/getting-started/changelog/','epoll-wp-voting');?>" target="_blank">
                    <?php esc_attr_e('What\'s New','epoll-wp-voting');?>
                </a>
            </li>
            <li class="epoll_templates-reports">
            <a href="<?php echo esc_url('https://tickets.infotheme.net/','epoll-wp-voting');?>" target="_blank">
                    <?php esc_attr_e('Create Ticket','epoll-wp-voting');?>
                </a>
            </li>
            <li class="epoll_templates-reports">
            <a href="<?php echo esc_url('https://forum.infotheme.net/','epoll-wp-voting');?>" target="_blank">
                    <?php esc_attr_e('Ask A Question','epoll-wp-voting');?>
                </a>
            </li>
        </ul>
        <a href="<?php echo esc_url( admin_url( 'admin.php?page=epoll_upgrade' ) ); ?>" class="button-primary button-small right" style="margin-top:10px;" role="button"><span class="upload"><?php esc_attr_e('Upgrade to Pro','epoll-wp-voting');?></span></a>
  
    </div>
    <div class="it_epoll_admin_extensions">

        <?php if($tab == 'overview'){
                include_once('dashboard/overview.php');
            }else if($tab == 'reports'){
                include_once('dashboard/reports.php');
            }else if($tab == 'view_report'){
                do_action('it_epoll_results_view_detailed_reports');
            }?> 
    </div>
</div>