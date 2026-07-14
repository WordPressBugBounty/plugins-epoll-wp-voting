<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$it_epoll_upgrade_url = admin_url( 'admin.php?page=epoll_upgrade' );
$it_epoll_pro_store_url = 'https://infotheme.net/item/epoll-pro/';
?>
<div class="it_epoll-pro-features-panel">
	<div class="it_epoll-pro-features-content" aria-hidden="true">
		<p class="description it_epoll-pro-features-intro">
			<?php esc_html_e( 'Preview of Pro-only settings. Upgrade to ePoll Pro to configure and use these features on your site.', 'epoll-wp-voting' ); ?>
		</p>

		<table class="widefat border-table it_epoll-pro-feature-group">
			<thead>
				<tr>
					<th><?php esc_html_e( 'Voting Security', 'epoll-wp-voting' ); ?> <span class="it_epolladmin_pro_badge"><?php esc_html_e( 'Pro', 'epoll-wp-voting' ); ?></span></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>
						<label>
							<input type="checkbox" disabled />
							<?php esc_html_e( 'Enable IP Based Voting', 'epoll-wp-voting' ); ?>
						</label>
					</td>
				</tr>
				<tr>
					<td>
						<label>
							<input type="checkbox" disabled />
							<?php esc_html_e( 'Enable OTP Based Voting', 'epoll-wp-voting' ); ?>
						</label>
					</td>
				</tr>
				<tr>
					<td>
						<label><?php esc_html_e( 'Enable Social Login', 'epoll-wp-voting' ); ?></label>
						<select class="widefat" disabled>
							<option><?php esc_html_e( 'No', 'epoll-wp-voting' ); ?></option>
							<option><?php esc_html_e( 'Yes', 'epoll-wp-voting' ); ?></option>
						</select>
					</td>
				</tr>
				<tr>
					<td>
						<label><?php esc_html_e( 'Enable Voter Login', 'epoll-wp-voting' ); ?></label>
						<select class="widefat" disabled>
							<option><?php esc_html_e( 'No', 'epoll-wp-voting' ); ?></option>
							<option><?php esc_html_e( 'Yes', 'epoll-wp-voting' ); ?></option>
						</select>
					</td>
				</tr>
			</tbody>
		</table>

		<table class="widefat border-table it_epoll-pro-feature-group">
			<thead>
				<tr>
					<th><?php esc_html_e( 'Voter Data & Sharing', 'epoll-wp-voting' ); ?> <span class="it_epolladmin_pro_badge"><?php esc_html_e( 'Pro', 'epoll-wp-voting' ); ?></span></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>
						<label>
							<input type="checkbox" disabled />
							<?php esc_html_e( 'Collect Email on Vote Submission', 'epoll-wp-voting' ); ?>
						</label>
					</td>
				</tr>
				<tr>
					<td>
						<label><?php esc_html_e( 'Extended social sharing networks (Social Sharing Pro add-on)', 'epoll-wp-voting' ); ?></label>
					</td>
				</tr>
			</tbody>
		</table>

		<table class="widefat border-table it_epoll-pro-feature-group">
			<thead>
				<tr>
					<th><?php esc_html_e( 'Vote Submission / Thank You Email', 'epoll-wp-voting' ); ?> <span class="it_epolladmin_pro_badge"><?php esc_html_e( 'Pro', 'epoll-wp-voting' ); ?></span></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>
						<label><?php esc_html_e( 'Email Subject', 'epoll-wp-voting' ); ?></label>
						<input type="text" class="widefat" disabled />
					</td>
				</tr>
				<tr>
					<td>
						<label><?php esc_html_e( 'Email Content', 'epoll-wp-voting' ); ?></label>
						<textarea class="widefat" rows="4" disabled></textarea>
					</td>
				</tr>
			</tbody>
		</table>

		<table class="widefat border-table it_epoll-pro-feature-group">
			<thead>
				<tr>
					<th><?php esc_html_e( 'OTP Based Voting Email', 'epoll-wp-voting' ); ?> <span class="it_epolladmin_pro_badge"><?php esc_html_e( 'Pro', 'epoll-wp-voting' ); ?></span></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>
						<label><?php esc_html_e( 'OTP Email Subject', 'epoll-wp-voting' ); ?></label>
						<input type="text" class="widefat" disabled />
					</td>
				</tr>
				<tr>
					<td>
						<label><?php esc_html_e( 'OTP Email Content', 'epoll-wp-voting' ); ?></label>
						<textarea class="widefat" rows="4" disabled></textarea>
					</td>
				</tr>
			</tbody>
		</table>

		<table class="widefat border-table it_epoll-pro-feature-group">
			<thead>
				<tr>
					<th><?php esc_html_e( 'OTP / WhatsApp SMS', 'epoll-wp-voting' ); ?> <span class="it_epolladmin_pro_badge"><?php esc_html_e( 'Pro', 'epoll-wp-voting' ); ?></span></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>
						<label><?php esc_html_e( 'OTP SMS Text', 'epoll-wp-voting' ); ?></label>
						<textarea class="widefat" rows="3" disabled></textarea>
					</td>
				</tr>
			</tbody>
		</table>

		<?php do_action( 'it_epoll_options_pro_fields' ); ?>
	</div>

	<div class="it_epoll-pro-features-overlay" role="presentation">
		<div
			class="it_epoll-pro-upgrade-modal"
			id="it_epoll_pro_upgrade_modal"
			role="dialog"
			aria-modal="true"
			aria-labelledby="it_epoll_pro_upgrade_modal_title"
		>
			<button type="button" class="it_epoll-pro-modal-close dashicons dashicons-no-alt" aria-label="<?php esc_attr_e( 'Close', 'epoll-wp-voting' ); ?>"></button>
			<span class="dashicons dashicons-lock it_epoll-pro-modal-icon" aria-hidden="true"></span>
			<h2 id="it_epoll_pro_upgrade_modal_title">
				<?php esc_html_e( 'Upgrade to Pro', 'epoll-wp-voting' ); ?>
				<span class="it_epolladmin_pro_badge"><?php esc_html_e( 'Pro', 'epoll-wp-voting' ); ?></span>
			</h2>
			<p><?php esc_html_e( 'Unlock advanced voting security, voter data collection, email & SMS notifications, extended social sharing, and premium exports.', 'epoll-wp-voting' ); ?></p>
			<ul class="it_epoll-pro-modal-features">
				<li><?php esc_html_e( 'IP & OTP based voting', 'epoll-wp-voting' ); ?></li>
				<li><?php esc_html_e( 'Social & voter login', 'epoll-wp-voting' ); ?></li>
				<li><?php esc_html_e( 'Email collection & thank-you emails', 'epoll-wp-voting' ); ?></li>
				<li><?php esc_html_e( 'OTP email & SMS / WhatsApp messages', 'epoll-wp-voting' ); ?></li>
				<li><?php esc_html_e( 'Advanced reports & exports', 'epoll-wp-voting' ); ?></li>
			</ul>
			<p class="it_epoll-pro-modal-actions">
				<a class="button button-primary button-hero" href="<?php echo esc_url( $it_epoll_upgrade_url ); ?>">
					<?php esc_html_e( 'View Plans & Features', 'epoll-wp-voting' ); ?>
				</a>
				<a class="button button-secondary" href="<?php echo esc_url( $it_epoll_pro_store_url ); ?>" target="_blank" rel="noopener noreferrer">
					<?php esc_html_e( 'Get ePoll Pro', 'epoll-wp-voting' ); ?>
				</a>
			</p>
		</div>
	</div>
</div>
