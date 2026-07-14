<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
// phpcs:disable WordPress.Security.NonceVerification.Recommended -- Read-only admin report filter; value is sanitized below.
	if(!isset($_REQUEST['id'])){
        $it_epoll_latest_cpt = get_posts(
            array('post_type'=>array('it_epoll_poll','it_epoll_opinion'),'numberposts'=>1));
        $it_epoll_report_pid = $it_epoll_latest_cpt[0]->ID;
    }else{
        $it_epoll_report_pid = absint( wp_unslash( $_REQUEST['id'] ) );
    }
// phpcs:enable WordPress.Security.NonceVerification.Recommended
?>

<table class="wp-list-table widefat wp-filter wp-filter_reports_epoll_dash">
	<thead>
		<tr>
			<th>
            <form name="it_epoll_form_select_poll" action="<?php echo esc_url(admin_url('admin.php?page=epoll_dashboard&tab=reports'),'epoll-wp-voting');?>" method="post">
                <select name="id" onChange="this.form.submit()">
                    <option><?php esc_attr_e('Choose A Poll / Contest','epoll-wp-voting');?></option>
                    <optgroup label="<?php esc_attr_e('Voting Contest','epoll-wp-voting');?>">
                    <?php
            // WP_Query arguments
            $it_epoll_backend_query_args = array(
                'post_type'              => array( 'it_epoll_poll' ),
                'post_status'            => array( 'publish' ),
                'nopaging'               => false,
                'paged'                  => '0',
                'posts_per_page'         => '10',
                'order'                  => 'DESC',
            );

            // The Query
            $it_epoll_backend_query = new WP_Query( $it_epoll_backend_query_args );

            // The Loop
            if ( $it_epoll_backend_query->have_posts() ) {
                while ( $it_epoll_backend_query->have_posts() ) {
                    $it_epoll_backend_query->the_post();?>
                    <option value="<?php the_id();?>"<?php if(get_the_id() == $it_epoll_report_pid) echo esc_attr(' selected','epoll-wp-voting');?>><?php the_title();?></option>
                    <?php }
            }
            
            // Restore original Post Data
            wp_reset_postdata();
            ?>
            </optgroup>
            <optgroup label="<?php esc_attr_e('Poll','epoll-wp-voting');?>">
                    <?php
            // WP_Query arguments
            $it_epoll_backend_query_args = array(
                'post_type'              => array( 'it_epoll_opinion' ),
                'post_status'            => array( 'publish' ),
                'nopaging'               => false,
                'paged'                  => '0',
                'posts_per_page'         => '10',
                'order'                  => 'DESC',
            );

            // The Query
            $it_epoll_backend_query = new WP_Query( $it_epoll_backend_query_args );

            // The Loop
            if ( $it_epoll_backend_query->have_posts() ) {
                while ( $it_epoll_backend_query->have_posts() ) {
                    $it_epoll_backend_query->the_post();?>
                    <option value="<?php the_id();?>"<?php if(get_the_id() == $it_epoll_report_pid) echo esc_attr(' selected','epoll-wp-voting');?>><?php the_title();?></option>
                    <?php }
            }
            
            // Restore original Post Data
            wp_reset_postdata();
            ?>
            </optgroup>
                </select>
        </form>
            </th>
			<th>
				<form class="dash-date-filter dash-date-filter_min-width" action="<?php echo esc_url(admin_url('admin.php?page=epoll_dashboard&tab=reports'),'epoll-wp-voting');?>" method="post">
                        <input type="hidden" name="id" value="<?php echo esc_attr($it_epoll_report_pid,'epoll-wp-voting');?>" required/>
						<span><?php esc_attr_e('Export Result As','epoll-wp-voting');?> </span>
                       <div class="dash-date_btn_group">
                        <button type="submit" name="html_export" class="button button-primary">HTML </button>
                        <a href="<?php echo esc_url( admin_url( 'admin.php?page=epoll_upgrade' ) ); ?>" name="csv_export" class="button button-secondary">Excel <span class="it_epolladmin_pro_badge"> Pro </span></a>
						<a href="<?php echo esc_url( admin_url( 'admin.php?page=epoll_upgrade' ) ); ?>"  name="pdf_export" class="button button-secondary">PDF <span class="it_epolladmin_pro_badge"> Pro </span></a>
						<a href="<?php echo esc_url( admin_url( 'admin.php?page=epoll_upgrade' ) ); ?>" name="json_export" class="button button-secondary">JSON <span class="it_epolladmin_pro_badge"> Pro </span></a>
                    
                    </div>
                </form>
			</th>
		</tr>
	</thead>
</table>
<table class="wp-list-table widefat it_epoll_dash_table dahsboard_report_table">
	<thead>
		
		<?php 
	
		$it_epoll_poll_vote_total_count = (int)get_post_meta($it_epoll_report_pid, 'it_epoll_vote_total_count',true);
		$it_epoll_option_names = array();
		$it_epoll_option_names = get_post_meta( $it_epoll_report_pid, 'it_epoll_poll_option', true );
		$it_epoll_poll_option_id = array();
		$it_epoll_poll_option_id = get_post_meta( $it_epoll_report_pid, 'it_epoll_poll_option_id', true );


		$it_epoll_option_index = 0;
		$it_epoll_winner_ar = array();
		if($it_epoll_option_names){?>
		
            </thead>
            <tbody class="it_epoll_dash_row">
            <tr class="table_head" id="table_head">
				<td class="flex_1">
					<?php esc_attr_e('Canidate / Option Name','epoll-wp-voting');?>
				</td>
				<td class="min_width_flex">
                    <?php esc_attr_e('Total Votes','epoll-wp-voting');?>
				</td>
				<td class="min_width_flex">
                    <?php esc_attr_e('Votes in (x/x)','epoll-wp-voting');?>
				</td>
				<td class="min_width_flex">
                    <?php esc_attr_e('Live Result','epoll-wp-voting');?>
				</td>
				<td>
					<?php esc_attr_e('Entries','epoll-wp-voting');?>
				</td>
			</tr>
			<?php
			foreach($it_epoll_option_names as $it_epoll_option_name):
			$it_epoll_poll_vote_count = (int)get_post_meta($it_epoll_report_pid, 'it_epoll_vote_count_'.(float)$it_epoll_poll_option_id[$it_epoll_option_index],true);
					
				 array_push($it_epoll_winner_ar,$it_epoll_poll_vote_count);
				 $it_epoll_option_index++; endforeach;
				 if (count(array_keys($it_epoll_winner_ar, max($it_epoll_winner_ar))) > 1){
					$it_epoll_winner = sizeof($it_epoll_winner_ar)+1;
				 }else{
					$it_epoll_winner = array_keys($it_epoll_winner_ar, max($it_epoll_winner_ar));
					$it_epoll_winner = $it_epoll_winner[0];
				 }

                 
				$it_epoll_row_index = 0;
		foreach($it_epoll_option_names as $it_epoll_option_name):
			$it_epoll_option_id = $it_epoll_poll_option_id[$it_epoll_row_index];
			$it_epoll_poll_vote_count = (int)get_post_meta($it_epoll_report_pid, 'it_epoll_vote_count_'.(float)$it_epoll_option_id,true);
			$it_epoll_poll_vote_percentage = "$it_epoll_poll_vote_count/$it_epoll_poll_vote_total_count";		
			?>
                    <tr id="dv_<?php echo esc_attr($it_epoll_poll_vote_count,'epoll-wp-voting');?>">
                        <td class="flex_1">
                            <?php echo esc_attr($it_epoll_option_names[$it_epoll_row_index],'epoll-wp-voting');?>
                        </td>
                        <td class="it_epoll_dash_row_count min_width_flex">
                            <?php echo esc_attr($it_epoll_poll_vote_count,'epoll-wp-voting');?>
                        </td>
                        <td class="min_width_flex">
                            <?php echo esc_attr($it_epoll_poll_vote_percentage,'epoll-wp-voting');?>
                        </td>
                        <td class="min_width_flex">
                            <?php if($it_epoll_row_index == $it_epoll_winner){?>
                                <?php if(get_post_meta($it_epoll_report_pid,'it_epoll_poll_status',true) != 'live'){?>
                                    <span class="it_epoll_winner_result_badge"><?php esc_attr_e('Winner','epoll-wp-voting');?></span>
                                <?php }else{?>	
                                <span class="it_epoll_winner_result_badge"><?php esc_attr_e('Winning','epoll-wp-voting');?></span> <sup class="it_epoll_winner_result_badge_text"><?php esc_attr_e('Now','epoll-wp-voting');?></sup>
                                <?php }}elseif(get_post_meta($it_epoll_report_pid,'it_epoll_poll_status',true) != 'live'){?>
                                    <span class="it_epoll_leading_result_badge"><?php esc_attr_e('Participated','epoll-wp-voting');?></span>
                                <?php }else{?>
                                <span class="it_epoll_leading_result_badge"><?php esc_attr_e('Leading','epoll-wp-voting');?></span> <sup class="it_epoll_winner_result_badge_text"><?php esc_attr_e('Now','epoll-wp-voting');?></sup>
                            <?php  } ?>
                                
                        </td>
                        <td>
                            <a href="<?php echo esc_url(admin_url('admin.php?page=epoll_dashboard&tab=view_report&id='.$it_epoll_report_pid.'&option='.$it_epoll_option_id),'epoll-wp-voting');?>"><span class="dashicons dashicons-external"></span></a>		
                        </td>
                    </tr>
		<?php $it_epoll_row_index++; endforeach;?>
                    </tbody>
        <script type="text/javascript">
                var main = document.querySelector('.it_epoll_dash_table .it_epoll_dash_row');

                [].map.call( main.children, Object ).sort( function ( a, b ) {
                    if(b.id != 'table_head'){
                        return +b.id.match( /\d+/ ) - +a.id.match( /\d+/ );
                    }
                    
                }).forEach( function ( elem,index ) {
                    main.appendChild( elem );
                   
                });
            </script>
        <?php
			}else{?>
				<tr>
						<td style="flex:1">
							<h2><?php esc_attr_e('OOPS! it seems you didn\'t created any options for this poll!','epoll-wp-voting');?></h2>
						</td>
					</tr>
					<tr>
						<td style="flex:1">
							<a href="<?php echo esc_url( admin_url( 'post.php?post=' . absint( $it_epoll_report_pid ) . '&action=edit' ) ); ?>" class="button button-secondary"><i class="dashicons dashicons-chart-pie"></i> <?php esc_attr_e('Edit This Poll','epoll-wp-voting');?></a>
						</td>
					</tr>
					<tr>
						<td style="flex:1">
							
						</td>
					</tr>
			<?php }
		?>
</table>