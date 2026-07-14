<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>
<table class="wp-table widefat dahsboard_report_table">
<tbody>
    <tr class="table_head">
        <td class="flex_1"><?php esc_attr_e('Contest / Poll Name','epoll-wp-voting');?></td>
        <td class="min_width_flex"><?php esc_attr_e('Status','epoll-wp-voting');?></td>
        <td class="min_width_flex"><?php esc_attr_e('Total Votes','epoll-wp-voting');?></td>
        <td class="min_width_flex"><?php esc_attr_e('Total Candidates','epoll-wp-voting');?></td>
        <td><?php esc_attr_e('Result','epoll-wp-voting');?></td>
    </tr>
    <?php
            // WP_Query arguments
            $it_epoll_backend_query_args = array(
                'post_type'              => array( 'it_epoll_poll','it_epoll_opinion' ),
                'post_status'            => array( 'publish' ),
                'nopaging'               => false,
                'paged'                  => '0',
                'posts_per_page'         => '20',
                'order'                  => 'DESC',
            );

            // The Query
            $it_epoll_backend_query = new WP_Query( $it_epoll_backend_query_args );

            // The Loop
            $it_epoll_row_index = 1;
            if ( $it_epoll_backend_query->have_posts() ) {
                while ( $it_epoll_backend_query->have_posts() ) {
                    $it_epoll_backend_query->the_post();?>
                    
                        <tr>
                        
                        <td class="flex_1 dahsboard_report_h4_col">
                            <h4 class="dahsboard_report_h4">
                           
                                <a href="<?php echo esc_url(get_edit_post_link(get_the_id(),'epoll-wp-voting'));?>" target="_blank">
                                    <?php the_title();?>
                                </a>
                                <?php 
                            if(get_post_type(get_the_id()) == 'it_epoll_poll'){?>
                                <span class="it_epolladmin_pro_badge it_epolladmin_pro_badge_blue"><?php esc_attr_e('Voting Contest','epoll-wp-voting');?></span>
                           <?php }else{?>
                            <span class="it_epolladmin_pro_badge it_epolladmin_pro_badge_blue"><?php esc_attr_e('Poll','epoll-wp-voting');?></span>
                           <?php }?>
                            </h4>
                        </td>
                        <td class="min_width_flex">
                            <?php $it_epoll_poll_status = get_post_meta(get_the_id(),'it_epoll_poll_status',true);
                            if($it_epoll_poll_status == 'live'){?>   
                            <span class="it_epolladmin_pro_badge"><?php echo esc_attr($it_epoll_poll_status,'epoll-wp-voting');?></span>                         
                            <?php }else{?>
                                <span class="it_epolladmin_pro_badge it_epolladmin_pro_badge_blue_only"><?php echo esc_attr($it_epoll_poll_status,'epoll-wp-voting');?></span>
                            <?php }?>
                            
                        </td>
                        <td class="min_width_flex">
                            <?php 
                            if(get_post_meta(get_the_id(),'it_epoll_vote_total_count',true))  echo esc_attr(get_post_meta(get_the_id(),'it_epoll_vote_total_count',true).' Votes','epoll-wp-voting'); else esc_attr_e('0 Votes','epoll-wp-voting');;?>
                        </td>
                        <td class="min_width_flex">
                            <?php 
                                if(get_post_meta(get_the_id(),'it_epoll_poll_option',true)){

                                        echo esc_attr(sizeof(get_post_meta(get_the_id(),'it_epoll_poll_option',true)),'epoll-wp-voting');	
                                    }else{
                                        echo 0;
                                    }
                            ?>
                        </td>
                        <td>
                            <a href="<?php echo esc_url(admin_url('admin.php?page=epoll_dashboard&tab=reports&id='.get_the_id()),'epoll-wp-voting');?>"><span class="dashicons dashicons-external"></span></a>
                        </td>
                    </tr>
            <?php $it_epoll_row_index++;	}
            } else {?>
                <tr>
                    <td colspan="6" style="text-align: center;">
                        <h2><?php esc_attr_e('OOPS! You have no poll created yet!','epoll-wp-voting');?></h2>
                    </td>
                </tr>
                <tr>
                    <td colspan="6" style="text-align: center;">
                        <a href="<?php echo esc_url(admin_url('post-new.php?post_type=it_epoll_poll'),'epoll-wp-voting');?>" class="button button-secondary"><i class="dashicons dashicons-chart-pie"></i> <?php esc_attr_e('Create New Poll','epoll-wp-voting');?></a>
                    </td>
                </tr>
                <tr>
                    <td colspan="6" style="text-align: center;">
                        
                    </td>
                </tr>
            <?php }

            // Restore original Post Data
            wp_reset_postdata();
            ?>
</tbody>
</table>