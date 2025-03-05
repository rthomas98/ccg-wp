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

    register_post_type('playdate_registration', $args);
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
    $new_columns['date'] = $columns['date'];
    return $new_columns;
}
add_filter('manage_playdate_registration_posts_columns', 'ccg_playdate_registration_columns');

/**
 * Display custom column content
 */
function ccg_playdate_registration_column_content($column, $post_id) {
    switch ($column) {
        case 'player_name':
            $player_name = get_post_meta($post_id, '_player_name', true);
            echo esc_html($player_name);
            break;
        case 'playdate':
            $playdate_id = get_post_meta($post_id, '_playdate_id', true);
            if ($playdate_id) {
                echo '<a href="' . esc_url(get_edit_post_link($playdate_id)) . '">' . esc_html(get_the_title($playdate_id)) . '</a>';
            }
            break;
        case 'status':
            $status = get_post_meta($post_id, '_registration_status', true);
            $status_class = '';
            switch ($status) {
                case 'pending':
                    $status_class = 'bg-yellow-100 text-yellow-800';
                    break;
                case 'confirmed':
                    $status_class = 'bg-green-100 text-green-800';
                    break;
                case 'cancelled':
                    $status_class = 'bg-red-100 text-red-800';
                    break;
            }
            echo '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ' . esc_attr($status_class) . '">';
            echo esc_html(ucfirst($status ?: 'pending'));
            echo '</span>';
            break;
    }
}
add_action('manage_playdate_registration_posts_custom_column', 'ccg_playdate_registration_column_content', 10, 2);

/**
 * Make custom columns sortable
 */
function ccg_playdate_registration_sortable_columns($columns) {
    $columns['player_name'] = 'player_name';
    $columns['playdate'] = 'playdate';
    $columns['status'] = 'status';
    return $columns;
}
add_filter('manage_edit-playdate_registration_sortable_columns', 'ccg_playdate_registration_sortable_columns');
