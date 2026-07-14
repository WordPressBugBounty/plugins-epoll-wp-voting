<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// phpcs:disable WordPress.Security.NonceVerification.Recommended -- Read-only admin report filters; values are sanitized below.
	if(!isset($_REQUEST['id']) && !isset($_REQUEST['option'])){
        $it_epoll_latest_cpt = get_posts(
            array('post_type'=>array('it_epoll_poll','it_epoll_opinion'),'numberposts'=>1));
        $it_epoll_report_pid = $it_epoll_latest_cpt[0]->ID;
		
		$it_epoll_poll_option_id = array();
		$it_epoll_poll_option_id = get_post_meta( $it_epoll_report_pid, 'it_epoll_poll_option_id', true );
		if($it_epoll_poll_option_id){
			$it_epoll_report_option = $it_epoll_poll_option_id[0];
		}else{
			$it_epoll_report_option = 0;
		}
		
		$it_epoll_option_names = array();
		$it_epoll_option_names = get_post_meta( $it_epoll_report_pid, 'it_epoll_poll_option', true );
    }else{
        $it_epoll_report_pid = absint( wp_unslash( $_REQUEST['id'] ) );
        $it_epoll_report_option = sanitize_text_field( wp_unslash( $_REQUEST['option'] ) );

		$it_epoll_poll_option_id = array();
		$it_epoll_poll_option_id = get_post_meta( $it_epoll_report_pid, 'it_epoll_poll_option_id', true );

		$it_epoll_option_names = array();
		$it_epoll_option_names = get_post_meta( $it_epoll_report_pid, 'it_epoll_poll_option', true );
    }
// phpcs:enable WordPress.Security.NonceVerification.Recommended
?>

<table class="wp-list-table widefat wp-filter wp-filter_reports_epoll_dash">
	<thead>
		<tr>
			<th>
			<a href="<?php echo esc_url(admin_url('admin.php?page=epoll_dashboard&tab=reports&id='.$it_epoll_report_pid),'epoll-wp-voting');?>"><i class="dashicons dashicons-arrow-left-alt"></i> Go Back</a>
			</th>
			<th>
            <form name="it_epoll_form_select_poll" action="<?php echo esc_url(admin_url('admin.php?page=epoll_dashboard&tab=reports'),'epoll-wp-voting');?>" method="post">
                <select name="id" onChange="this.form.submit()">
                    <option><?php esc_attr_e('Choose A Candidate / Option','epoll-wp-voting');?></option>
					<?php if($it_epoll_poll_option_id){
						$it_epoll_option_index = 0;
						foreach($it_epoll_poll_option_id as $it_epoll_loop_option_id){?>
							<option value="<?php echo esc_attr($it_epoll_loop_option_id,'epoll-wp-voting');?>" <?php if($it_epoll_report_option == $it_epoll_loop_option_id) echo esc_attr(' selected','epoll-wp-voting');?>><?php echo esc_attr($it_epoll_option_names[$it_epoll_option_index],'epoll-wp-voting');?></option>
						<?php
							$it_epoll_option_index++;
						}
					}?>
                </select>
        </form>
            </th>
			<th>
				<form class="dash-date-filter" action="<?php echo esc_url(admin_url('admin.php?page=epoll_dashboard&tab=reports'),'epoll-wp-voting');?>" method="post">
                        <span><?php esc_attr_e('From','epoll-wp-voting');?></span>
                        <input type="date" class="widefat" name="from" value="" placeholder="<?php esc_attr_e('Choose A Date','epoll-wp-voting');?>"/>
                        <span><?php esc_attr_e('To','epoll-wp-voting');?></span>
                        <input type="hidden" name="id" value="<?php echo esc_attr($it_epoll_report_pid,'epoll-wp-voting');?>" required/>
                        <input type="date" class="widefat" name="to"  value="" placeholder="<?php esc_attr_e('Choose A Date','epoll-wp-voting');?>"/>
                       <div class="dash-date_btn_group">
                        <button type="submit" name="clear" class="button button-secondary"><?php esc_attr_e('Clear','epoll-wp-voting');?></button>
                        <button type="submit" name="submit" class="button button-primary"><?php esc_attr_e('Apply','epoll-wp-voting');?></button>
                    </div>
                </form>
			</th>
		</tr>
	</thead>
</table>

<div class="it_epoll_system_upgrade_pro">
	<div class="it_epoll_system_upgrade_pro_dotted_line"></div>
	<div class="dashicons dashicons-unlock it_epoll_system_upgrade_pro_icon"></div>
	<a href="<?php echo esc_url( admin_url( 'admin.php?page=epoll_upgrade' ) ); ?>" class="it_edb_submit it_epoll_system_upgrade_pro_btn"><?php esc_attr_e('Upgrade to Pro for all Features','epoll-wp-voting');?></a>
</div>
<table class="wp-table widefat fixed striped posts it_epoll_sys_show_voter_table">
	<thead>
		<tr>
			<th>
				<?php esc_attr_e('Voter Name','epoll-wp-voting');?>
			</th>
			<th>
				<?php esc_attr_e('Contact Details','epoll-wp-voting');?>
			</th>
			<th>
				<?php esc_attr_e('Status','epoll-wp-voting');?>			
			</th>
			<th>
				<?php esc_attr_e('Action','epoll-wp-voting');?>	
			</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>
				John test
			</td>
			<td>
				<table class="wp-table it_epoll_sys_show_voter">
					<tr>
						<th>Email :</th>
						<th>test@test.com</th>
					</tr>
					<tr style="display: none;">
						<th>Phone</th>
						<th>0123456789</th>
					</tr>
					<tr style="display: none;">
						<th>Address</th>
						<th>Test House, Road, City, USA.</th>
					</tr>
					<tr style="display: none;">
						<th>Gender</th>
						<th>Male</th>
					</tr>
					<tr style="display: none;">
						<th>Date Of Birth</th>
						<th>04/04/1995</th>
					</tr>
				</table>
			</td>
			<th>
				Verified Voter
			</td>
			<td>
				<button type="button" class="button button-secondary it_epoll_sys_show_voter_btn">Delete</button>
			</td>
		</tr>
		<tr class="it_epoll_system_upgrade_pro_blur">
			<td>
				Ziyan test
			</td>
			<td>
				<table class="wp-table it_epoll_sys_show_voter">
					<tr>
						<th>Email :</th>
						<th>testziyan@test.com</th>
					</tr>
					<tr style="display: none;">
						<th>Phone</th>
						<th>0123456789</th>
					</tr>
					<tr style="display: none;">
						<th>Address</th>
						<th>Test House, Road, City, USA.</th>
					</tr>
					<tr style="display: none;">
						<th>Gender</th>
						<th>Male</th>
					</tr>
					<tr style="display: none;">
						<th>Date Of Birth</th>
						<th>04/04/1995</th>
					</tr>
				</table>
			</td>
			<th>
				Unverified Voter
			</td>
			<td>
				<button type="button" class="button button-secondary it_epoll_sys_show_voter_btn">Delete</button>
			</td>
		</tr>
		<tr class="it_epoll_system_upgrade_pro_blur">
			<td>
				Ziyan test
			</td>
			<td>
				<table class="wp-table it_epoll_sys_show_voter">
					<tr>
						<th>Email :</th>
						<th>testziyan@test.com</th>
					</tr>
					<tr style="display: none;">
						<th>Phone</th>
						<th>0123456789</th>
					</tr>
					<tr style="display: none;">
						<th>Address</th>
						<th>Test House, Road, City, USA.</th>
					</tr>
					<tr style="display: none;">
						<th>Gender</th>
						<th>Male</th>
					</tr>
					<tr style="display: none;">
						<th>Date Of Birth</th>
						<th>04/04/1995</th>
					</tr>
				</table>
			</td>
			<th>
				Unverified Voter
			</td>
			<td>
				<button type="button" class="button button-secondary it_epoll_sys_show_voter_btn">Delete</button>
			</td>
		</tr>
		<tr class="it_epoll_system_upgrade_pro_blur">
			<td>
				Ziyan test
			</td>
			<td>
				<table class="wp-table it_epoll_sys_show_voter">
					<tr>
						<th>Email :</th>
						<th>testziyan@test.com</th>
					</tr>
					<tr style="display: none;">
						<th>Phone</th>
						<th>0123456789</th>
					</tr>
					<tr style="display: none;">
						<th>Address</th>
						<th>Test House, Road, City, USA.</th>
					</tr>
					<tr style="display: none;">
						<th>Gender</th>
						<th>Male</th>
					</tr>
					<tr style="display: none;">
						<th>Date Of Birth</th>
						<th>04/04/1995</th>
					</tr>
				</table>
			</td>
			<th>
				Unverified Voter
			</td>
			<td>
				<button type="button" class="button button-secondary it_epoll_sys_show_voter_btn">Delete</button>
			</td>
		</tr>
		<tr class="it_epoll_system_upgrade_pro_blur">
			<td>
				Ziyan test
			</td>
			<td>
				<table class="wp-table it_epoll_sys_show_voter">
					<tr>
						<th>Email :</th>
						<th>testziyan@test.com</th>
					</tr>
					<tr style="display: none;">
						<th>Phone</th>
						<th>0123456789</th>
					</tr>
					<tr style="display: none;">
						<th>Address</th>
						<th>Test House, Road, City, USA.</th>
					</tr>
					<tr style="display: none;">
						<th>Gender</th>
						<th>Male</th>
					</tr>
					<tr style="display: none;">
						<th>Date Of Birth</th>
						<th>04/04/1995</th>
					</tr>
				</table>
			</td>
			<th>
				Unverified Voter
			</td>
			<td>
				<button type="button" class="button button-secondary it_epoll_sys_show_voter_btn">Delete</button>
			</td>
		</tr>
	</tbody>
	<tfoot>
		<tr>
			<td colspan="4">
				<form class="dash-date-filter" action="<?php echo esc_url(admin_url('admin.php?page=epoll_dashboard&tab=reports'),'epoll-wp-voting');?>" method="post">
					<input type="hidden" name="id" value="<?php echo esc_attr($it_epoll_report_pid,'epoll-wp-voting');?>" required/>
					<span><?php esc_attr_e('Export Result As','epoll-wp-voting');?></span>
				<div class="dash-date_btn_group">
						<a href="<?php echo esc_url( admin_url( 'admin.php?page=epoll_upgrade' ) ); ?>" name="html_export" class="button button-secondary"><?php esc_attr_e('HTML','epoll-wp-voting');?> <span class="it_epolladmin_pro_badge"> <?php esc_attr_e('Pro','epoll-wp-voting');?> </span></a>
						<a href="<?php echo esc_url( admin_url( 'admin.php?page=epoll_upgrade' ) ); ?>" name="csv_export" class="button button-secondary"><?php esc_attr_e('Excel','epoll-wp-voting');?> <span class="it_epolladmin_pro_badge"> <?php esc_attr_e('Pro','epoll-wp-voting');?> </span></a>
						<a href="<?php echo esc_url( admin_url( 'admin.php?page=epoll_upgrade' ) ); ?>"  name="pdf_export" class="button button-secondary"><?php esc_attr_e('PDF','epoll-wp-voting');?> <span class="it_epolladmin_pro_badge"> <?php esc_attr_e('Pro','epoll-wp-voting');?> </span></a>
						<a href="<?php echo esc_url( admin_url( 'admin.php?page=epoll_upgrade' ) ); ?>" name="json_export" class="button button-secondary"><?php esc_attr_e('JSON','epoll-wp-voting');?> <span class="it_epolladmin_pro_badge"> <?php esc_attr_e('Pro','epoll-wp-voting');?> </span></a>
					</div>
				</form>
			</td>
		</tr>
	</tfoot>
</table>