<?php
/**
 * Admin Dashboard Widgets
 *
 * Adds recent registration widgets to the WordPress admin dashboard.
 *
 * @package _ccg
 */

/**
 * Register dashboard widgets
 */
function ccg_register_dashboard_widgets() {
	wp_add_dashboard_widget(
		'ccg_playdate_registrations',
		'Recent Playdate Registrations',
		'ccg_dashboard_playdate_registrations_callback'
	);
	wp_add_dashboard_widget(
		'ccg_tournament_registrations',
		'Recent Tournament Registrations',
		'ccg_dashboard_tournament_registrations_callback'
	);
}
add_action( 'wp_dashboard_setup', 'ccg_register_dashboard_widgets' );

/**
 * Playdate Registrations widget callback
 */
function ccg_dashboard_playdate_registrations_callback() {
	$query = new WP_Query(
		array(
			'post_type'      => 'playdate_registration',
			'posts_per_page' => 10,
			'orderby'        => 'date',
			'order'          => 'DESC',
			'post_status'    => 'publish',
		)
	);

	if ( ! $query->have_posts() ) {
		echo '<p>No playdate registrations yet.</p>';
		return;
	}

	echo '<div class="ccg-dashboard-widget-table-wrap">';
	echo '<table class="ccg-dashboard-widget-table widefat striped">';
	echo '<thead><tr>';
	echo '<th>Player Name</th>';
	echo '<th>Playdate</th>';
	echo '<th>Status</th>';
	echo '<th>Payment</th>';
	echo '<th>Date</th>';
	echo '</tr></thead>';
	echo '<tbody>';

	while ( $query->have_posts() ) {
		$query->the_post();
		$post_id    = get_the_ID();
		$first_name = get_post_meta( $post_id, '_first_name', true );
		$last_name  = get_post_meta( $post_id, '_last_name', true );
		$player     = trim( $first_name . ' ' . $last_name );

		$playdate_id    = get_post_meta( $post_id, '_playdate_id', true );
		$playdate_title = $playdate_id ? get_the_title( $playdate_id ) : '—';

		$status = get_post_meta( $post_id, '_registration_status', true );
		if ( ! $status ) {
			$status = 'pending';
		}

		$payment = get_post_meta( $post_id, '_payment_status', true );
		if ( ! $payment ) {
			$payment = 'unpaid';
		}

		$reg_date = get_post_meta( $post_id, '_registration_date', true );
		$edit_url = admin_url( 'post.php?post=' . $post_id . '&action=edit' );

		echo '<tr>';
		echo '<td><a href="' . esc_url( $edit_url ) . '">' . esc_html( $player ) . '</a></td>';
		echo '<td>' . esc_html( $playdate_title ) . '</td>';
		echo '<td><span class="ccg-badge ccg-status-' . esc_attr( $status ) . '">' . esc_html( ucfirst( $status ) ) . '</span></td>';
		echo '<td><span class="ccg-badge ccg-payment-' . esc_attr( $payment ) . '">' . esc_html( ucfirst( $payment ) ) . '</span></td>';
		echo '<td>' . esc_html( $reg_date ) . '</td>';
		echo '</tr>';
	}
	wp_reset_postdata();

	echo '</tbody></table>';
	echo '</div>';
	echo '<p class="ccg-dashboard-widget-footer"><a href="' . esc_url( admin_url( 'edit.php?post_type=playdate_registration' ) ) . '">View All Playdate Registrations &rarr;</a></p>';
}

/**
 * Tournament Registrations widget callback
 */
function ccg_dashboard_tournament_registrations_callback() {
	$query = new WP_Query(
		array(
			'post_type'      => 'tournament_registration',
			'posts_per_page' => 10,
			'orderby'        => 'date',
			'order'          => 'DESC',
			'post_status'    => 'publish',
		)
	);

	if ( ! $query->have_posts() ) {
		echo '<p>No tournament registrations yet.</p>';
		return;
	}

	echo '<div class="ccg-dashboard-widget-table-wrap">';
	echo '<table class="ccg-dashboard-widget-table widefat striped">';
	echo '<thead><tr>';
	echo '<th>Player Name</th>';
	echo '<th>Tournament</th>';
	echo '<th>Status</th>';
	echo '<th>Payment</th>';
	echo '<th>Date</th>';
	echo '</tr></thead>';
	echo '<tbody>';

	while ( $query->have_posts() ) {
		$query->the_post();
		$post_id    = get_the_ID();
		$first_name = get_field( 'registration_details_first_name', $post_id );
		$last_name  = get_field( 'registration_details_last_name', $post_id );
		$player     = trim( $first_name . ' ' . $last_name );

		$tournament_id    = get_field( 'registration_details_tournament', $post_id );
		$tournament_title = $tournament_id ? get_the_title( $tournament_id ) : '—';

		$status = get_field( 'registration_details_status', $post_id );
		if ( ! $status ) {
			$status = 'registered';
		}

		$payment = get_field( 'registration_details_payment_status', $post_id );
		if ( ! $payment ) {
			$payment = 'unpaid';
		}

		$reg_date = get_field( 'registration_details_registration_date', $post_id );
		$edit_url = admin_url( 'post.php?post=' . $post_id . '&action=edit' );

		echo '<tr>';
		echo '<td><a href="' . esc_url( $edit_url ) . '">' . esc_html( $player ) . '</a></td>';
		echo '<td>' . esc_html( $tournament_title ) . '</td>';
		echo '<td><span class="ccg-badge ccg-status-' . esc_attr( $status ) . '">' . esc_html( ucfirst( $status ) ) . '</span></td>';
		echo '<td><span class="ccg-badge ccg-payment-' . esc_attr( $payment ) . '">' . esc_html( ucfirst( $payment ) ) . '</span></td>';
		echo '<td>' . esc_html( $reg_date ) . '</td>';
		echo '</tr>';
	}
	wp_reset_postdata();

	echo '</tbody></table>';
	echo '</div>';
	echo '<p class="ccg-dashboard-widget-footer"><a href="' . esc_url( admin_url( 'edit.php?post_type=tournament_registration' ) ) . '">View All Tournament Registrations &rarr;</a></p>';
}

/**
 * Dashboard widget styles (only on the dashboard screen)
 */
function ccg_dashboard_widget_styles() {
	$screen = get_current_screen();
	if ( ! $screen || 'dashboard' !== $screen->id ) {
		return;
	}
	?>
	<style>
		.ccg-dashboard-widget-table-wrap {
			overflow-x: auto;
		}
		.ccg-dashboard-widget-table {
			width: 100%;
			border-collapse: collapse;
		}
		.ccg-dashboard-widget-table th {
			text-align: left;
			font-size: 12px;
			font-weight: 600;
			text-transform: uppercase;
			color: #555;
			padding: 8px 10px;
		}
		.ccg-dashboard-widget-table td {
			padding: 8px 10px;
			font-size: 13px;
			vertical-align: middle;
		}
		.ccg-dashboard-widget-table td a {
			font-weight: 600;
			text-decoration: none;
		}
		.ccg-dashboard-widget-table td a:hover {
			text-decoration: underline;
		}
		.ccg-badge {
			display: inline-block;
			padding: 3px 7px;
			border-radius: 4px;
			font-size: 11px;
			font-weight: 600;
			text-transform: uppercase;
			white-space: nowrap;
		}
		/* Status badges */
		.ccg-status-pending,
		.ccg-status-waitlisted {
			background-color: #fff3cd;
			color: #856404;
		}
		.ccg-status-confirmed,
		.ccg-status-registered {
			background-color: #e6f4ea;
			color: #1e7e34;
		}
		.ccg-status-cancelled {
			background-color: #feeced;
			color: #dc3545;
		}
		/* Payment badges */
		.ccg-payment-unpaid {
			background-color: #fff3cd;
			color: #856404;
		}
		.ccg-payment-paid {
			background-color: #e6f4ea;
			color: #1e7e34;
		}
		.ccg-payment-refunded {
			background-color: #e2e8f0;
			color: #64748b;
		}
		.ccg-dashboard-widget-footer {
			margin: 12px 0 0;
			text-align: right;
		}
		.ccg-dashboard-widget-footer a {
			font-size: 13px;
			text-decoration: none;
			font-weight: 600;
		}
		.ccg-dashboard-widget-footer a:hover {
			text-decoration: underline;
		}
	</style>
	<?php
}
add_action( 'admin_head', 'ccg_dashboard_widget_styles' );
