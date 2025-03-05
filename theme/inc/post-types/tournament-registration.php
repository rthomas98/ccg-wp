<?php
/**
 * Tournament Registration Post Type
 *
 * @package _ccg
 */

/**
 * Register Tournament Registration post type
 */
function register_tournament_registration_post_type() {
    $labels = array(
        'name'                  => _x('Tournament Registrations', 'Post type general name', '_ccg'),
        'singular_name'         => _x('Tournament Registration', 'Post type singular name', '_ccg'),
        'menu_name'            => _x('Tournament Registrations', 'Admin Menu text', '_ccg'),
        'name_admin_bar'       => _x('Tournament Registration', 'Add New on Toolbar', '_ccg'),
        'add_new'              => __('Add New', '_ccg'),
        'add_new_item'         => __('Add New Registration', '_ccg'),
        'new_item'             => __('New Registration', '_ccg'),
        'edit_item'            => __('Edit Registration', '_ccg'),
        'view_item'            => __('View Registration', '_ccg'),
        'all_items'            => __('All Registrations', '_ccg'),
        'search_items'         => __('Search Registrations', '_ccg'),
        'not_found'            => __('No registrations found.', '_ccg'),
        'not_found_in_trash'   => __('No registrations found in Trash.', '_ccg'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => false,
        'publicly_queryable' => false,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'tournament-registration'),
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => null,
        'menu_icon'          => 'dashicons-calendar-alt',
        'supports'           => array('title'),
    );

    register_post_type('tournament_registration', $args);
}
add_action('init', 'register_tournament_registration_post_type');

/**
 * Add custom columns to tournament registration admin list
 */
function add_tournament_registration_columns($columns) {
    $new_columns = array();
    foreach ($columns as $key => $value) {
        if ($key === 'title') {
            $new_columns[$key] = $value;
            $new_columns['player_name'] = __('Player Name', '_ccg');
            $new_columns['tournament'] = __('Tournament', '_ccg');
            $new_columns['registration_date'] = __('Registration Date', '_ccg');
            $new_columns['status'] = __('Status', '_ccg');
        } else {
            $new_columns[$key] = $value;
        }
    }
    return $new_columns;
}
add_filter('manage_tournament_registration_posts_columns', 'add_tournament_registration_columns');

/**
 * Display custom column content
 */
function display_tournament_registration_columns($column, $post_id) {
    switch ($column) {
        case 'player_name':
            $first_name = get_field('registration_details_first_name', $post_id);
            $last_name = get_field('registration_details_last_name', $post_id);
            echo esc_html($first_name . ' ' . $last_name);
            break;
        case 'tournament':
            $tournament_id = get_field('registration_details_tournament', $post_id);
            if ($tournament_id) {
                echo esc_html(get_the_title($tournament_id));
            }
            break;
        case 'registration_date':
            $date = get_field('registration_details_registration_date', $post_id);
            echo esc_html($date);
            break;
        case 'status':
            $status = get_field('registration_details_status', $post_id);
            echo '<span class="registration-status status-' . esc_attr($status) . '">' . esc_html(ucfirst($status)) . '</span>';
            break;
    }
}
add_action('manage_tournament_registration_posts_custom_column', 'display_tournament_registration_columns', 10, 2);

/**
 * Add custom admin styles for registration status
 */
function add_tournament_registration_admin_styles() {
    $screen = get_current_screen();
    if ($screen && $screen->post_type === 'tournament_registration') {
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
            .status-registered {
                background-color: #e6f4ea;
                color: #1e7e34;
            }
            .status-cancelled {
                background-color: #feeced;
                color: #dc3545;
            }
            .status-waitlisted {
                background-color: #fff3cd;
                color: #856404;
            }
        </style>
        <?php
    }
}
add_action('admin_head', 'add_tournament_registration_admin_styles');
