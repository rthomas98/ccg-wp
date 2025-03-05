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

    // Check if spots are available
    if ($spots_available <= 0) {
        wp_send_json_error(['message' => 'Sorry, this playdate is full.']);
    }

    // Create registration post
    $registration_data = array(
        'post_title'    => wp_strip_all_tags($_POST['first_name'] . ' ' . $_POST['last_name'] . ' - ' . get_the_title($playdate_id)),
        'post_status'   => 'publish',
        'post_type'     => 'playdate_registration'
    );

    $registration_id = wp_insert_post($registration_data);

    if (is_wp_error($registration_id)) {
        wp_send_json_error(['message' => 'Failed to create registration. Please try again.']);
    }

    // Save registration meta
    $meta_fields = [
        '_first_name' => sanitize_text_field($_POST['first_name']),
        '_last_name' => sanitize_text_field($_POST['last_name']),
        '_email' => sanitize_email($_POST['email']),
        '_phone' => sanitize_text_field($_POST['phone']),
        '_handicap' => $handicap,
        '_special_requests' => sanitize_textarea_field($_POST['special_requests'] ?? ''),
        '_playdate_id' => $playdate_id,
        '_registration_status' => 'pending',
        '_registration_date' => current_time('mysql')
    ];

    foreach ($meta_fields as $key => $value) {
        update_post_meta($registration_id, $key, $value);
    }

    // Update spots available
    update_field('spots_available', $spots_available - 1, $playdate_id);

    // Send confirmation email
    ccg_send_registration_confirmation_email($registration_id);

    // Send admin notification
    ccg_send_admin_registration_notification($registration_id);

    wp_send_json_success([
        'message' => 'Registration successful! You will receive a confirmation email shortly.',
        'registration_id' => $registration_id
    ]);
}

/**
 * Send confirmation email to the registrant
 */
function ccg_send_registration_confirmation_email($registration_id) {
    $registration = get_post($registration_id);
    $playdate_id = get_post_meta($registration_id, '_playdate_id', true);
    $playdate = get_post($playdate_id);
    $first_name = get_post_meta($registration_id, '_first_name', true);
    $email = get_post_meta($registration_id, '_email', true);
    
    $subject = 'Registration Confirmation - ' . get_the_title($playdate_id);
    
    $message = sprintf(
        'Hello %s,

Thank you for registering for %s.

Registration Details:
- Date: %s
- Time: %s
- Location: %s
- Price: $%s

We will review your registration and send you payment instructions shortly.

If you have any questions, please don\'t hesitate to contact us.

Best regards,
%s',
        esc_html($first_name),
        esc_html(get_the_title($playdate_id)),
        esc_html(get_field('date', $playdate_id)),
        esc_html(get_field('time', $playdate_id)),
        esc_html(get_field('location', $playdate_id)),
        esc_html(get_field('price', $playdate_id)),
        esc_html(get_bloginfo('name'))
    );

    $headers = ['Content-Type: text/plain; charset=UTF-8'];
    
    wp_mail($email, $subject, $message, $headers);
}

/**
 * Send notification email to admin
 */
function ccg_send_admin_registration_notification($registration_id) {
    $registration = get_post($registration_id);
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

/**
 * Add the registration form to single playdate content
 */
function ccg_add_registration_form_to_playdate($content) {
    if (is_singular('playdate')) {
        ob_start();
        get_template_part('template-parts/forms/playdate-registration-form');
        $form = ob_get_clean();
        $content .= $form;
    }
    return $content;
}
add_filter('the_content', 'ccg_add_registration_form_to_playdate');

/**
 * Enqueue scripts and localize AJAX URL
 */
function ccg_enqueue_registration_scripts() {
    if (is_singular('playdate')) {
        wp_enqueue_script('ccg-registration', get_stylesheet_directory_uri() . '/assets/js/registration.js', array('jquery'), '1.0', true);
        wp_localize_script('ccg-registration', 'ccg_ajax', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('playdate_registration_nonce')
        ));
    }
}
add_action('wp_enqueue_scripts', 'ccg_enqueue_registration_scripts');
