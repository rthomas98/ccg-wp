<?php
/**
 * Handle playdate registration functionality
 */

// Add AJAX handlers
add_action('wp_ajax_playdate_registration', 'ccg_handle_playdate_registration');
add_action('wp_ajax_nopriv_playdate_registration', 'ccg_handle_playdate_registration');

/**
 * Handle the registration form submission
 */
function ccg_handle_playdate_registration() {
    // Verify nonce
    if (!isset($_POST['playdate_registration_nonce']) || !wp_verify_nonce($_POST['playdate_registration_nonce'], 'playdate_registration_nonce')) {
        wp_send_json_error(['message' => 'Invalid security token. Please refresh the page and try again.']);
    }

    // Validate required fields
    $required_fields = ['first_name', 'last_name', 'email', 'phone', 'handicap', 'playdate_id'];
    foreach ($required_fields as $field) {
        if (empty($_POST[$field])) {
            wp_send_json_error(['message' => 'Please fill in all required fields.']);
        }
    }

    // Validate email
    if (!is_email($_POST['email'])) {
        wp_send_json_error(['message' => 'Please enter a valid email address.']);
    }

    // Validate handicap
    $handicap = floatval($_POST['handicap']);
    if ($handicap < 0 || $handicap > 36) {
        wp_send_json_error(['message' => 'Please enter a valid handicap between 0 and 36.']);
    }

    // Get playdate details
    $playdate_id = intval($_POST['playdate_id']);
    $spots_available = get_field('spots_available', $playdate_id);

    // Also check current_status spots_remaining
    if (have_rows('current_status', $playdate_id)) {
        while (have_rows('current_status', $playdate_id)) {
            the_row();
            $spots_remaining = get_sub_field('spots_remaining');
            if ($spots_remaining !== null && $spots_remaining !== '' && $spots_remaining !== false) {
                $spots_available = intval($spots_remaining);
            }
        }
    }

    // Check if spots are available
    if ($spots_available <= 0) {
        wp_send_json_error(['message' => 'Sorry, this playdate is full.']);
    }

    // Sanitize inputs
    $first_name = sanitize_text_field($_POST['first_name']);
    $last_name = sanitize_text_field($_POST['last_name']);
    $email = sanitize_email($_POST['email']);

    // Create registration post
    $registration_data = array(
        'post_title'    => wp_strip_all_tags($first_name . ' ' . $last_name . ' - ' . get_the_title($playdate_id)),
        'post_status'   => 'publish',
        'post_type'     => 'playdate_registration'
    );

    $registration_id = wp_insert_post($registration_data);

    if (is_wp_error($registration_id)) {
        wp_send_json_error(['message' => 'Failed to create registration. Please try again.']);
    }

    // Save registration meta
    $meta_fields = [
        '_first_name' => $first_name,
        '_last_name' => $last_name,
        '_email' => $email,
        '_phone' => sanitize_text_field($_POST['phone']),
        '_handicap' => $handicap,
        '_gender' => sanitize_text_field($_POST['gender'] ?? ''),
        '_is_member' => sanitize_text_field($_POST['is_member'] ?? ''),
        '_membership_status' => sanitize_text_field($_POST['membership_status'] ?? ''),
        '_special_requests' => sanitize_textarea_field($_POST['special_requests'] ?? ''),
        '_playdate_id' => $playdate_id,
        '_registration_status' => 'pending',
        '_payment_status' => 'unpaid',
        '_registration_date' => current_time('mysql')
    ];

    foreach ($meta_fields as $key => $value) {
        update_post_meta($registration_id, $key, $value);
    }

    // Update spots available
    update_field('spots_available', $spots_available - 1, $playdate_id);

    // Also update current_status spots_remaining if it exists
    if (have_rows('current_status', $playdate_id)) {
        while (have_rows('current_status', $playdate_id)) {
            the_row();
            update_sub_field('spots_remaining', $spots_available - 1);
        }
    }

    // Get payment link from pricing_information
    $payment_link = '';
    if (have_rows('pricing_information', $playdate_id)) {
        while (have_rows('pricing_information', $playdate_id)) {
            the_row();
            $payment_link = get_sub_field('payment_link');
        }
    }

    // Send confirmation email
    ccg_send_registration_confirmation_email($registration_id);

    // Send admin notification
    ccg_send_admin_registration_notification($registration_id);

    wp_send_json_success([
        'message' => 'Registration successful! You will receive a confirmation email shortly.',
        'registration_id' => $registration_id,
        'player_name' => $first_name . ' ' . $last_name,
        'player_email' => $email,
        'payment_link' => $payment_link
    ]);
}

/**
 * Send confirmation email to the registrant
 */
function ccg_send_registration_confirmation_email($registration_id) {
    $playdate_id = get_post_meta($registration_id, '_playdate_id', true);
    $first_name = get_post_meta($registration_id, '_first_name', true);
    $email = get_post_meta($registration_id, '_email', true);

    // Get playdate details from ACF group
    $playdate_date = '';
    $tee_time = '';
    $location = '';
    if (have_rows('playdate_details', $playdate_id)) {
        while (have_rows('playdate_details', $playdate_id)) {
            the_row();
            $playdate_date = get_sub_field('date');
            $tee_time = get_sub_field('tee_time_start');
            $location = get_sub_field('location');
        }
    }

    // Get pricing info
    $price_display = 'TBD';
    $payment_link = '';
    if (have_rows('pricing_information', $playdate_id)) {
        while (have_rows('pricing_information', $playdate_id)) {
            the_row();
            $member_price = get_sub_field('course_member_price');
            $non_member_price = get_sub_field('non_member_price');
            $payment_link = get_sub_field('payment_link');
            if ($member_price) {
                $price_display = '$' . number_format((float)$member_price, 2);
            } elseif ($non_member_price) {
                $price_display = '$' . number_format((float)$non_member_price, 2);
            }
        }
    }

    // Format date for display
    $formatted_date = !empty($playdate_date) ? date('F j, Y', strtotime($playdate_date)) : 'TBD';

    $subject = 'Registration Confirmation - ' . get_the_title($playdate_id);

    $message = sprintf(
        'Hello %s,

Thank you for registering for %s.

Registration Details:
- Date: %s
- Tee Time: %s
- Location: %s
- Price: %s',
        esc_html($first_name),
        esc_html(get_the_title($playdate_id)),
        esc_html($formatted_date),
        esc_html($tee_time ?: 'TBD'),
        esc_html($location ?: 'TBD'),
        esc_html($price_display)
    );

    // Add payment link if available
    if (!empty($payment_link)) {
        $message .= sprintf(
            '

Complete your payment at: %s',
            esc_url($payment_link)
        );
    }

    $message .= sprintf(
        '

We will review your registration and confirm your spot shortly.

If you have any questions, please don\'t hesitate to contact us.

Best regards,
%s',
        esc_html(get_bloginfo('name'))
    );

    $headers = ['Content-Type: text/plain; charset=UTF-8'];

    wp_mail($email, $subject, $message, $headers);
}

/**
 * Send notification email to admin
 */
function ccg_send_admin_registration_notification($registration_id) {
    $playdate_id = get_post_meta($registration_id, '_playdate_id', true);
    $first_name = get_post_meta($registration_id, '_first_name', true);
    $last_name = get_post_meta($registration_id, '_last_name', true);
    $email = get_post_meta($registration_id, '_email', true);
    $phone = get_post_meta($registration_id, '_phone', true);
    $handicap = get_post_meta($registration_id, '_handicap', true);

    $subject = 'New Playdate Registration - ' . get_the_title($playdate_id);

    $message = sprintf(
        'New registration received for %s

Player Details:
- Name: %s %s
- Email: %s
- Phone: %s
- Handicap: %s

View registration: %s',
        esc_html(get_the_title($playdate_id)),
        esc_html($first_name),
        esc_html($last_name),
        esc_html($email),
        esc_html($phone),
        esc_html($handicap),
        esc_url(get_edit_post_link($registration_id))
    );

    $admin_email = get_option('admin_email');
    $headers = ['Content-Type: text/plain; charset=UTF-8'];

    wp_mail($admin_email, $subject, $message, $headers);
}

/**
 * Handle waitlist form submission
 */
function ccg_handle_waitlist_submission() {
    check_ajax_referer('playdate_waitlist_nonce', 'playdate_waitlist_nonce');

    $playdate_id = isset($_POST['playdate_id']) ? intval($_POST['playdate_id']) : 0;
    $first_name = isset($_POST['first_name']) ? sanitize_text_field($_POST['first_name']) : '';
    $last_name = isset($_POST['last_name']) ? sanitize_text_field($_POST['last_name']) : '';
    $email = isset($_POST['email']) ? sanitize_email($_POST['email']) : '';
    $phone = isset($_POST['phone']) ? sanitize_text_field($_POST['phone']) : '';
    $handicap = isset($_POST['handicap']) ? floatval($_POST['handicap']) : 0;
    $notes = isset($_POST['notes']) ? sanitize_textarea_field($_POST['notes']) : '';

    // Validate required fields
    if (!$playdate_id || !$first_name || !$last_name || !$email || !$phone) {
        wp_send_json_error(array('message' => 'Please fill in all required fields.'));
    }

    // Create waitlist entry
    $waitlist_id = wp_insert_post(array(
        'post_type' => 'waitlist',
        'post_title' => sprintf('%s %s - %s', $first_name, $last_name, get_the_title($playdate_id)),
        'post_status' => 'publish',
    ));

    if (is_wp_error($waitlist_id)) {
        wp_send_json_error(array('message' => 'Failed to join waitlist. Please try again.'));
    }

    // Save waitlist details
    update_post_meta($waitlist_id, 'playdate_id', $playdate_id);
    update_post_meta($waitlist_id, 'first_name', $first_name);
    update_post_meta($waitlist_id, 'last_name', $last_name);
    update_post_meta($waitlist_id, 'email', $email);
    update_post_meta($waitlist_id, 'phone', $phone);
    update_post_meta($waitlist_id, 'handicap', $handicap);
    update_post_meta($waitlist_id, 'notes', $notes);
    update_post_meta($waitlist_id, 'status', 'pending');

    // Send confirmation email
    $to = $email;
    $subject = sprintf('Waitlist Confirmation - %s', get_the_title($playdate_id));
    $message = sprintf(
        "Hi %s,\n\nYou have been added to the waitlist for %s. We will contact you if a spot becomes available.\n\nBest regards,\nThe CCG Team",
        $first_name,
        get_the_title($playdate_id)
    );
    $headers = array('Content-Type: text/plain; charset=UTF-8');
    wp_mail($to, $subject, $message, $headers);

    wp_send_json_success(array('message' => 'You have been added to the waitlist. We will contact you if a spot becomes available.'));
}
add_action('wp_ajax_playdate_waitlist', 'ccg_handle_waitlist_submission');
add_action('wp_ajax_nopriv_playdate_waitlist', 'ccg_handle_waitlist_submission');
