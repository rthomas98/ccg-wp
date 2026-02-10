<?php
/**
 * Register Playdate Registration post type
 */

function ccg_register_playdate_registration_post_type() {
    $labels = array(
        'name'               => 'Playdate Registrations',
        'singular_name'      => 'Playdate Registration',
        'menu_name'          => 'Registrations',
        'add_new'           => 'Add New Registration',
        'add_new_item'      => 'Add New Playdate Registration',
        'edit_item'         => 'Edit Playdate Registration',
        'new_item'          => 'New Playdate Registration',
        'view_item'         => 'View Playdate Registration',
        'search_items'      => 'Search Playdate Registrations',
        'not_found'         => 'No registrations found',
        'not_found_in_trash'=> 'No registrations found in trash',
    );

    $args = array(
        'labels'              => $labels,
        'public'              => false,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => false,
        'show_in_admin_bar'   => true,
        'menu_position'       => 25,
        'menu_icon'           => 'dashicons-clipboard',
        'hierarchical'        => false,
        'supports'            => array('title'),
        'has_archive'         => false,
        'rewrite'            => false,
        'capability_type'    => 'post',
        'show_in_rest'       => true,
    );

    register_post_type('playdate_reg', $args);
}
add_action('init', 'ccg_register_playdate_registration_post_type');

/**
 * Add custom columns to the playdate registration list
 */
function ccg_playdate_registration_columns($columns) {
    $new_columns = array();
    $new_columns['cb'] = $columns['cb'];
    $new_columns['title'] = __('Registration ID', '_ccg');
    $new_columns['player_name'] = __('Player Name', '_ccg');
    $new_columns['playdate'] = __('Playdate', '_ccg');
    $new_columns['status'] = __('Status', '_ccg');
    $new_columns['payment_status'] = __('Payment Status', '_ccg');
    $new_columns['date'] = $columns['date'];
    return $new_columns;
}
add_filter('manage_playdate_reg_posts_columns', 'ccg_playdate_registration_columns');

/**
 * Display custom column content
 */
function ccg_playdate_registration_column_content($column, $post_id) {
    switch ($column) {
        case 'player_name':
            $first_name = get_post_meta($post_id, '_first_name', true);
            $last_name = get_post_meta($post_id, '_last_name', true);
            echo esc_html(trim($first_name . ' ' . $last_name));
            break;
        case 'playdate':
            $playdate_id = get_post_meta($post_id, '_playdate_id', true);
            if ($playdate_id) {
                echo '<a href="' . esc_url(get_edit_post_link($playdate_id)) . '">' . esc_html(get_the_title($playdate_id)) . '</a>';
            }
            break;
        case 'status':
            $status = get_post_meta($post_id, '_registration_status', true);
            echo '<span class="registration-status status-' . esc_attr($status ?: 'pending') . '">' . esc_html(ucfirst($status ?: 'pending')) . '</span>';
            break;
        case 'payment_status':
            $payment_status = get_post_meta($post_id, '_payment_status', true);
            if (!$payment_status) {
                $payment_status = 'unpaid';
            }
            echo '<span class="payment-status payment-' . esc_attr($payment_status) . '">' . esc_html(ucfirst($payment_status)) . '</span>';
            break;
    }
}
add_action('manage_playdate_reg_posts_custom_column', 'ccg_playdate_registration_column_content', 10, 2);

/**
 * Make custom columns sortable
 */
function ccg_playdate_registration_sortable_columns($columns) {
    $columns['player_name'] = 'player_name';
    $columns['playdate'] = 'playdate';
    $columns['status'] = 'status';
    return $columns;
}
add_filter('manage_edit-playdate_reg_sortable_columns', 'ccg_playdate_registration_sortable_columns');

/**
 * Add custom admin styles for playdate registration status badges
 */
function ccg_playdate_registration_admin_styles() {
    $screen = get_current_screen();
    if ($screen && $screen->post_type === 'playdate_reg') {
        ?>
        <style>
            .registration-status {
                display: inline-block;
                padding: 4px 8px;
                border-radius: 4px;
                font-size: 12px;
                font-weight: 600;
                text-transform: uppercase;
            }
            .status-pending {
                background-color: #fff3cd;
                color: #856404;
            }
            .status-confirmed {
                background-color: #e6f4ea;
                color: #1e7e34;
            }
            .status-cancelled {
                background-color: #feeced;
                color: #dc3545;
            }
            .payment-status {
                display: inline-block;
                padding: 4px 8px;
                border-radius: 4px;
                font-size: 12px;
                font-weight: 600;
                text-transform: uppercase;
            }
            .payment-paid {
                background-color: #e6f4ea;
                color: #1e7e34;
            }
            .payment-unpaid {
                background-color: #fff3cd;
                color: #856404;
            }
            .payment-refunded {
                background-color: #e2e8f0;
                color: #64748b;
            }
        </style>
        <?php
    }
}
add_action('admin_head', 'ccg_playdate_registration_admin_styles');
