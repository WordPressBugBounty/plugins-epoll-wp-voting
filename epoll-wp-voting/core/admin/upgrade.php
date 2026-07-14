<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$it_epoll_pro_url = 'https://infotheme.net/item/epoll-pro/';

$it_epoll_pro_highlights = array(
	array(
		'icon'  => 'dashicons-shield',
		'title' => __( 'Advanced voting security', 'epoll-wp-voting' ),
		'desc'  => __( 'IP restrictions, OTP verification, social login, and voter login to protect every poll.', 'epoll-wp-voting' ),
	),
	array(
		'icon'  => 'dashicons-email-alt',
		'title' => __( 'Email & SMS notifications', 'epoll-wp-voting' ),
		'desc'  => __( 'Send thank-you emails, OTP messages, and SMS/WhatsApp voting confirmations automatically.', 'epoll-wp-voting' ),
	),
	array(
		'icon'  => 'dashicons-chart-bar',
		'title' => __( 'Advanced reports & exports', 'epoll-wp-voting' ),
		'desc'  => __( 'Detailed voter reports with export to HTML, Excel, PDF, and JSON.', 'epoll-wp-voting' ),
	),
	array(
		'icon'  => 'dashicons-id',
		'title' => __( 'Voter data collection', 'epoll-wp-voting' ),
		'desc'  => __( 'Collect email addresses and custom voter details when users submit votes.', 'epoll-wp-voting' ),
	),
	array(
		'icon'  => 'dashicons-share',
		'title' => __( 'Extended social sharing', 'epoll-wp-voting' ),
		'desc'  => __( 'Additional social networks and sharing add-ons for polls and contests.', 'epoll-wp-voting' ),
	),
	array(
		'icon'  => 'dashicons-admin-appearance',
		'title' => __( 'Premium templates & add-ons', 'epoll-wp-voting' ),
		'desc'  => __( 'Extra frontend layouts, integrations, and customization options.', 'epoll-wp-voting' ),
	),
);

$it_epoll_comparison_rows = array(
	array( 'group' => __( 'Poll & Contest Builder', 'epoll-wp-voting' ) ),
	array( 'name' => __( 'Unlimited polls & voting contests', 'epoll-wp-voting' ), 'free' => true, 'pro' => true ),
	array( 'name' => __( 'Poll options & contest candidates', 'epoll-wp-voting' ), 'free' => true, 'pro' => true ),
	array( 'name' => __( 'Images & videos on options', 'epoll-wp-voting' ), 'free' => true, 'pro' => true ),
	array( 'name' => __( 'Multiple choice / multivote', 'epoll-wp-voting' ), 'free' => true, 'pro' => true ),
	array( 'name' => __( 'Schedule poll start & end dates', 'epoll-wp-voting' ), 'free' => true, 'pro' => true ),
	array( 'name' => __( 'Upcoming poll status', 'epoll-wp-voting' ), 'free' => true, 'pro' => true ),
	array( 'name' => __( 'Color scheme customization', 'epoll-wp-voting' ), 'free' => true, 'pro' => true ),
	array( 'name' => __( 'Voting access codes (private polls)', 'epoll-wp-voting' ), 'free' => true, 'pro' => true ),
	array( 'name' => __( 'Manual vote count editing', 'epoll-wp-voting' ), 'free' => true, 'pro' => true ),
	array( 'name' => __( 'Comments on vote submission', 'epoll-wp-voting' ), 'free' => true, 'pro' => true ),

	array( 'group' => __( 'Display & Embed', 'epoll-wp-voting' ) ),
	array( 'name' => __( 'Shortcode embed', 'epoll-wp-voting' ), 'free' => true, 'pro' => true ),
	array( 'name' => __( 'Gutenberg block', 'epoll-wp-voting' ), 'free' => true, 'pro' => true ),
	array( 'name' => __( 'List & grid views', 'epoll-wp-voting' ), 'free' => true, 'pro' => true ),
	array( 'name' => __( 'Result visibility controls', 'epoll-wp-voting' ), 'free' => true, 'pro' => true ),
	array( 'name' => __( 'Show results after vote ends', 'epoll-wp-voting' ), 'free' => true, 'pro' => true ),
	array( 'name' => __( 'Bundled frontend templates', 'epoll-wp-voting' ), 'free' => true, 'pro' => true ),
	array( 'name' => __( 'Premium templates & add-ons', 'epoll-wp-voting' ), 'free' => false, 'pro' => true, 'highlight' => true ),

	array( 'group' => __( 'Voting Security', 'epoll-wp-voting' ) ),
	array( 'name' => __( 'Cookie & browser session limits', 'epoll-wp-voting' ), 'free' => true, 'pro' => true ),
	array( 'name' => __( 'hCaptcha bot protection', 'epoll-wp-voting' ), 'free' => true, 'pro' => true ),
	array( 'name' => __( 'IP-based voting restrictions', 'epoll-wp-voting' ), 'free' => false, 'pro' => true, 'highlight' => true ),
	array( 'name' => __( 'OTP-based voting', 'epoll-wp-voting' ), 'free' => false, 'pro' => true, 'highlight' => true ),
	array( 'name' => __( 'Social login for voters', 'epoll-wp-voting' ), 'free' => false, 'pro' => true, 'highlight' => true ),
	array( 'name' => __( 'Voter login accounts', 'epoll-wp-voting' ), 'free' => false, 'pro' => true, 'highlight' => true ),

	array( 'group' => __( 'Reports & Data', 'epoll-wp-voting' ) ),
	array( 'name' => __( 'View voting results in admin', 'epoll-wp-voting' ), 'free' => true, 'pro' => true ),
	array( 'name' => __( 'Collect email on vote submission', 'epoll-wp-voting' ), 'free' => false, 'pro' => true, 'highlight' => true ),
	array( 'name' => __( 'Detailed voter reports', 'epoll-wp-voting' ), 'free' => false, 'pro' => true, 'highlight' => true ),
	array( 'name' => __( 'Export reports (HTML, Excel, PDF, JSON)', 'epoll-wp-voting' ), 'free' => false, 'pro' => true, 'highlight' => true ),

	array( 'group' => __( 'Notifications & Sharing', 'epoll-wp-voting' ) ),
	array( 'name' => __( 'Facebook, Twitter & WhatsApp sharing', 'epoll-wp-voting' ), 'free' => true, 'pro' => true ),
	array( 'name' => __( 'Extended social sharing networks', 'epoll-wp-voting' ), 'free' => false, 'pro' => true, 'highlight' => true ),
	array( 'name' => __( 'Thank-you & OTP email notifications', 'epoll-wp-voting' ), 'free' => false, 'pro' => true, 'highlight' => true ),
	array( 'name' => __( 'SMS / WhatsApp OTP messages', 'epoll-wp-voting' ), 'free' => false, 'pro' => true, 'highlight' => true ),

	array( 'group' => __( 'Support', 'epoll-wp-voting' ) ),
	array( 'name' => __( 'Community support & documentation', 'epoll-wp-voting' ), 'free' => true, 'pro' => true ),
	array( 'name' => __( 'Priority support & updates', 'epoll-wp-voting' ), 'free' => false, 'pro' => true, 'highlight' => true ),
);
?>
<div class="wrap it_epoll-upgrade-wrap">
	<h1><?php esc_html_e( 'Plans & Features', 'epoll-wp-voting' ); ?></h1>
	<p class="description">
		<?php esc_html_e( 'ePoll on WordPress.org is free and fully functional. ePoll Pro is a separate product with additional features hosted outside the WordPress.org directory.', 'epoll-wp-voting' ); ?>
	</p>

	<div class="it_epoll-plan-cards">
		<div class="it_epoll-plan-card">
			<h2><?php esc_html_e( 'Free', 'epoll-wp-voting' ); ?></h2>
			<p class="it_epoll-plan-price"><?php esc_html_e( '$0', 'epoll-wp-voting' ); ?></p>
			<p><?php esc_html_e( 'Full poll & contest builder, scheduling, multivote, color themes, hCaptcha, shortcodes, and bundled templates.', 'epoll-wp-voting' ); ?></p>
			<ul class="it_epoll-plan-includes">
				<li><?php esc_html_e( 'Unlimited polls & contests', 'epoll-wp-voting' ); ?></li>
				<li><?php esc_html_e( 'Schedule start & end dates', 'epoll-wp-voting' ); ?></li>
				<li><?php esc_html_e( 'Basic results & social sharing', 'epoll-wp-voting' ); ?></li>
			</ul>
		</div>
		<div class="it_epoll-plan-card it_epoll-plan-card-pro">
			<h2>
				<?php esc_html_e( 'Pro', 'epoll-wp-voting' ); ?>
				<span class="it_epolladmin_pro_badge"><?php esc_html_e( 'Pro', 'epoll-wp-voting' ); ?></span>
			</h2>
			<p class="it_epoll-plan-price"><?php esc_html_e( 'ePoll Pro', 'epoll-wp-voting' ); ?></p>
			<p><?php esc_html_e( 'Requires the free ePoll plugin plus ePoll Pro from InfoTheme.', 'epoll-wp-voting' ); ?></p>
			<ul class="it_epoll-plan-includes">
				<li><?php esc_html_e( 'Advanced security & OTP voting', 'epoll-wp-voting' ); ?></li>
				<li><?php esc_html_e( 'Email, SMS & voter data collection', 'epoll-wp-voting' ); ?></li>
				<li><?php esc_html_e( 'Premium exports, templates & support', 'epoll-wp-voting' ); ?></li>
			</ul>
			<p>
				<a class="button button-primary button-hero" href="<?php echo esc_url( $it_epoll_pro_url ); ?>" target="_blank" rel="noopener noreferrer">
					<?php esc_html_e( 'Get ePoll Pro', 'epoll-wp-voting' ); ?>
				</a>
			</p>
		</div>
	</div>

	<h2><?php esc_html_e( 'Pro highlights', 'epoll-wp-voting' ); ?></h2>
	<p class="description"><?php esc_html_e( 'Key features unlocked with ePoll Pro.', 'epoll-wp-voting' ); ?></p>
	<div class="it_epoll-highlight-grid">
		<?php foreach ( $it_epoll_pro_highlights as $it_epoll_highlight ) : ?>
			<div class="it_epoll-highlight-card">
				<span class="dashicons <?php echo esc_attr( $it_epoll_highlight['icon'] ); ?> it_epoll-highlight-icon" aria-hidden="true"></span>
				<h3>
					<?php echo esc_html( $it_epoll_highlight['title'] ); ?>
					<span class="it_epolladmin_pro_badge"><?php esc_html_e( 'Pro', 'epoll-wp-voting' ); ?></span>
				</h3>
				<p><?php echo esc_html( $it_epoll_highlight['desc'] ); ?></p>
			</div>
		<?php endforeach; ?>
	</div>

	<h2><?php esc_html_e( 'Feature comparison', 'epoll-wp-voting' ); ?></h2>
	<table class="widefat it_epoll-pricing-table it_epoll-feature-matrix">
		<thead>
			<tr>
				<th><?php esc_html_e( 'Feature', 'epoll-wp-voting' ); ?></th>
				<th class="it_epoll-col-free"><?php esc_html_e( 'Free', 'epoll-wp-voting' ); ?></th>
				<th class="it_epoll-col-pro"><?php esc_html_e( 'Pro', 'epoll-wp-voting' ); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ( $it_epoll_comparison_rows as $it_epoll_row ) : ?>
				<?php if ( isset( $it_epoll_row['group'] ) ) : ?>
					<tr class="it_epoll-feature-group">
						<th colspan="3"><?php echo esc_html( $it_epoll_row['group'] ); ?></th>
					</tr>
				<?php else : ?>
					<tr<?php echo ! empty( $it_epoll_row['highlight'] ) ? ' class="it_epoll-feature-highlight"' : ''; ?>>
						<td>
							<?php echo esc_html( $it_epoll_row['name'] ); ?>
							<?php if ( ! empty( $it_epoll_row['highlight'] ) ) : ?>
								<span class="it_epolladmin_pro_badge"><?php esc_html_e( 'Pro', 'epoll-wp-voting' ); ?></span>
							<?php endif; ?>
						</td>
						<td class="it_epoll-col-free">
							<?php echo ! empty( $it_epoll_row['free'] ) ? '<span class="it_epoll-check" aria-label="' . esc_attr__( 'Included', 'epoll-wp-voting' ) . '">&#10003;</span>' : '<span class="it_epoll-dash" aria-hidden="true">&mdash;</span>'; ?>
						</td>
						<td class="it_epoll-col-pro">
							<?php echo ! empty( $it_epoll_row['pro'] ) ? '<span class="it_epoll-check it_epoll-check-pro" aria-label="' . esc_attr__( 'Included', 'epoll-wp-voting' ) . '">&#10003;</span>' : '<span class="it_epoll-dash" aria-hidden="true">&mdash;</span>'; ?>
						</td>
					</tr>
				<?php endif; ?>
			<?php endforeach; ?>
		</tbody>
	</table>

	<div class="it_epoll-upgrade-cta">
		<h3><?php esc_html_e( 'Ready to upgrade?', 'epoll-wp-voting' ); ?></h3>
		<p><?php esc_html_e( 'Install the free ePoll plugin from WordPress.org, then purchase ePoll Pro from InfoTheme to unlock Pro features on your site.', 'epoll-wp-voting' ); ?></p>
		<p>
			<a class="button button-primary button-hero" href="<?php echo esc_url( $it_epoll_pro_url ); ?>" target="_blank" rel="noopener noreferrer">
				<?php esc_html_e( 'View ePoll Pro pricing', 'epoll-wp-voting' ); ?>
			</a>
			<a class="button button-secondary" href="<?php echo esc_url( 'https://tickets.infotheme.net/' ); ?>" target="_blank" rel="noopener noreferrer">
				<?php esc_html_e( 'Contact support', 'epoll-wp-voting' ); ?>
			</a>
		</p>
	</div>
</div>
