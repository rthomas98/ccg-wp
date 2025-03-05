<?php
/**
 * Register Waitlist Post Type
 */

function ccg_register_waitlist_post_type() {
    $labels = array(
        'name'                  => _x('Waitlist', 'Post Type General Name', '_ccg'),
        'singular_name'         => _x('Waitlist Entry', 'Post Type Singular Name', '_ccg'),
        'menu_name'            => __('Waitlist', '_ccg'),
        'name_admin_bar'       => __('Waitlist', '_ccg'),
        'archives'             => __('Waitlist Archives', '_ccg'),
        'attributes'           => __('Waitlist Attributes', '_ccg'),
        'all_items'            => __('All Entries', '_ccg'),
        'add_new_item'         => __('Add New Entry', '_ccg'),
        'add_new'             => __('Add New', '_ccg'),
        'new_item'            => __('New Entry', '_ccg'),
        'edit_item'           => __('Edit Entry', '_ccg'),
        'update_item'         => __('Update Entry', '_ccg'),
        'view_item'           => __('View Entry', '_ccg'),
        'view_items'          => __('View Entries', '_ccg'),
        'search_items'        => __('Search Entry', '_ccg'),
    );

    $args = array(
        'label'               => __('Waitlist', '_ccg'),
        'description'         => __('Waitlist entries for playdates', '_ccg'),
        'labels'             => $labels,
        'supports'           => array('title'),
        'hierarchical'       => false,
        'public'             => false,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'menu_position'      => 25,
        'menu_icon'          => 'dashicons-list-view',
        'show_in_admin_bar'  => false,
        'show_in_nav_menus'  => false,
        'can_export'         => true,
        'has_archive'        => false,
        'exclude_from_search'=> true,
        'publicly_queryable' => false,
        'capability_type'    => 'post',
        'show_in_rest'       => false,
    );

    register_post_type('waitlist', $args);
}
add_action('init', 'ccg_register_waitlist_post_type');

/**
 * Add custom columns to waitlist admin
 */
function ccg_waitlist_columns($columns) {
    $new_columns = array();
    foreach ($columns as $key => $value) {
        if ($key === 'title') {
            $new_columns[$key] = $value;
            $new_columns['playdate'] = __('Playdate', '_ccg');
            $new_columns['name'] = __('Name', '_ccg');
            $new_columns['email'] = __('Email', '_ccg');
            $new_columns['phone'] = __('Phone', '_ccg');
            $new_columns['status'] = __('Status', '_ccg');
        } else {
            $new_columns[$key] = $value;
        }
    }
    unset($new_columns['date']);
    return $new_columns;
}
add_filter('manage_waitlist_posts_columns', 'ccg_waitlist_columns');

/**
 * Add content to custom columns in waitlist admin
 */
function ccg_waitlist_column_content($column, $post_id) {
    switch ($column) {
        case 'playdate':
            $playdate_id = get_post_meta($post_id, 'playdate_id', true);
            echo get_the_title($playdate_id);
            break;
        case 'name':
            $first_name = get_post_meta($post_id, 'first_name', true);
            $last_name = get_post_meta($post_id, 'last_name', true);
            echo esc_html($first_name . ' ' . $last_name);
            break;
        case 'email':
            echo esc_html(get_post_meta($post_id, 'email', true));
            break;
        case 'phone':
            echo esc_html(get_post_meta($post_id, 'phone', true));
            break;
        case 'status':
            $status = get_post_meta($post_id, 'status', true);
            $status_class = $status === 'pending' ? 'orange' : ($status === 'contacted' ? 'blue' : 'green');
            echo '<span class="waitlist-status ' . $status_class . '">' . ucfirst($status) . '</span>';
            break;
    }
}
add_action('manage_waitlist_posts_custom_column', 'ccg_waitlist_column_content', 10, 2);

/**
 * Add custom meta box for waitlist details
 */
function ccg_add_waitlist_meta_box() {
    add_meta_box(
        'waitlist_details',
        __('Waitlist Details', '_ccg'),
        'ccg_waitlist_meta_box_callback',
        'waitlist',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'ccg_add_waitlist_meta_box');

/**
 * Render waitlist meta box content
 */
function ccg_waitlist_meta_box_callback($post) {
    $playdate_id = get_post_meta($post->ID, 'playdate_id', true);
    $first_name = get_post_meta($post->ID, 'first_name', true);
    $last_name = get_post_meta($post->ID, 'last_name', true);
    $email = get_post_meta($post->ID, 'email', true);
    $phone = get_post_meta($post->ID, 'phone', true);
    $handicap = get_post_meta($post->ID, 'handicap', true);
    $notes = get_post_meta($post->ID, 'notes', true);
    $status = get_post_meta($post->ID, 'status', true);
    ?>
    <style>
        .waitlist-meta-box { margin: 1em 0; }
        .waitlist-meta-box label { display: block; margin-bottom: 0.5em; font-weight: bold; }
        .waitlist-meta-box input[type="text"],
        .waitlist-meta-box input[type="email"],
        .waitlist-meta-box input[type="tel"],
        .waitlist-meta-box input[type="number"],
        .waitlist-meta-box textarea,
        .waitlist-meta-box select { width: 100%; margin-bottom: 1em; }
        .waitlist-meta-box textarea { min-height: 100px; }
    </style>

    <div class="waitlist-meta-box">
        <p>
            <label for="playdate_id"><?php _e('Playdate', '_ccg'); ?></label>
            <select name="playdate_id" id="playdate_id" required>
                <?php
                $playdates = get_posts(array(
                    'post_type' => 'playdate',
                    'posts_per_page' => -1,
                    'orderby' => 'date',
                    'order' => 'DESC',
                ));
                foreach ($playdates as $pd) {
                    printf(
                        '<option value="%s" %s>%s</option>',
                        esc_attr($pd->ID),
                        selected($pd->ID, $playdate_id, false),
                        esc_html($pd->post_title)
                    );
                }
                ?>
            </select>
        </p>
        <p>
            <label for="first_name"><?php _e('First Name', '_ccg'); ?></label>
            <input type="text" id="first_name" name="first_name" value="<?php echo esc_attr($first_name); ?>" required>
        </p>
        <p>
            <label for="last_name"><?php _e('Last Name', '_ccg'); ?></label>
            <input type="text" id="last_name" name="last_name" value="<?php echo esc_attr($last_name); ?>" required>
        </p>
        <p>
            <label for="email"><?php _e('Email', '_ccg'); ?></label>
            <input type="email" id="email" name="email" value="<?php echo esc_attr($email); ?>" required>
        </p>
        <p>
            <label for="phone"><?php _e('Phone', '_ccg'); ?></label>
            <input type="tel" id="phone" name="phone" value="<?php echo esc_attr($phone); ?>" required>
        </p>
        <p>
            <label for="handicap"><?php _e('Handicap', '_ccg'); ?></label>
            <input type="number" id="handicap" name="handicap" value="<?php echo esc_attr($handicap); ?>" min="0" max="36" step="0.1">
        </p>
        <p>
            <label for="notes"><?php _e('Notes', '_ccg'); ?></label>
            <textarea id="notes" name="notes"><?php echo esc_textarea($notes); ?></textarea>
        </p>
        <p>
            <label for="status"><?php _e('Status', '_ccg'); ?></label>
            <select name="status" id="status">
                <option value="pending" <?php selected($status, 'pending'); ?>><?php _e('Pending', '_ccg'); ?></option>
                <option value="contacted" <?php selected($status, 'contacted'); ?>><?php _e('Contacted', '_ccg'); ?></option>
                <option value="registered" <?php selected($status, 'registered'); ?>><?php _e('Registered', '_ccg'); ?></option>
            </select>
        </p>
    </div>
    <?php
}

/**
 * Save waitlist meta box data
 */
function ccg_save_waitlist_meta_box($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    $fields = array(
        'playdate_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'handicap',
        'notes',
        'status'
    );

    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, $field, sanitize_text_field($_POST[$field]));
        }
    }
}
add_action('save_post_waitlist', 'ccg_save_waitlist_meta_box');
