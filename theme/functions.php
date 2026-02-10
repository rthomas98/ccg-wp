<?php
/**
 * _ccg functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package _ccg
 */

if ( ! defined( '_CCG_VERSION' ) ) {
	/*
	 * Set the theme’s version number.
	 *
	 * This is used primarily for cache busting. If you use `npm run bundle`
	 * to create your production build, the value below will be replaced in the
	 * generated zip file with a timestamp, converted to base 36.
	 */
	define( '_CCG_VERSION', '0.1.0' );
}

if ( ! defined( '_CCG_TYPOGRAPHY_CLASSES' ) ) {
	/*
	 * Set Tailwind Typography classes for the front end, block editor and
	 * classic editor using the constant below.
	 *
	 * For the front end, these classes are added by the `_ccg_content_class`
	 * function. You will see that function used everywhere an `entry-content`
	 * or `page-content` class has been added to a wrapper element.
	 *
	 * For the block editor, these classes are converted to a JavaScript array
	 * and then used by the `./javascript/block-editor.js` file, which adds
	 * them to the appropriate elements in the block editor (and adds them
	 * again when they’re removed.)
	 *
	 * For the classic editor (and anything using TinyMCE, like Advanced Custom
	 * Fields), these classes are added to TinyMCE’s body class when it
	 * initializes.
	 */
	define(
		'_CCG_TYPOGRAPHY_CLASSES',
		'prose prose-neutral max-w-none prose-a:text-primary'
	);
}

if ( ! function_exists( '_ccg_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function _ccg_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on _ccg, use a find and replace
		 * to change '_ccg' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( '_ccg', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in five places.
		register_nav_menus(
			array(
				'menu-1' => __( 'Primary', '_ccg' ),
				'menu-2' => __( 'Footer Menu', '_ccg' ),
				'footer-column-1' => __( 'Footer Column 1', '_ccg' ),
				'footer-column-2' => __( 'Footer Column 2', '_ccg' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );

		// Enqueue editor styles.
		add_editor_style( 'style-editor.css' );
		add_editor_style( 'style-editor-extra.css' );

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );

		// Remove support for block templates.
		remove_theme_support( 'block-templates' );
	}
endif;
add_action( 'after_setup_theme', '_ccg_setup' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function _ccg_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Footer', '_ccg' ),
			'id'            => 'sidebar-1',
			'description'   => __( 'Add widgets here to appear in your footer.', '_ccg' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', '_ccg_widgets_init' );

/**
 * Enqueue the block editor script.
 */
function _ccg_enqueue_block_editor_script() {
	if ( is_admin() ) {
		wp_enqueue_script(
			'_ccg-editor',
			get_template_directory_uri() . '/js/block-editor.min.js',
			array(
				'wp-blocks',
				'wp-edit-post',
			),
			_CCG_VERSION,
			true
		);
		wp_add_inline_script( '_ccg-editor', "tailwindTypographyClasses = '" . esc_attr( _CCG_TYPOGRAPHY_CLASSES ) . "'.split(' ');", 'before' );
	}
}
add_action( 'enqueue_block_assets', '_ccg_enqueue_block_editor_script' );

/**
 * Add the Tailwind Typography classes to TinyMCE.
 *
 * @param array $settings TinyMCE settings.
 * @return array
 */
function _ccg_tinymce_add_class( $settings ) {
	$settings['body_class'] = _CCG_TYPOGRAPHY_CLASSES;
	return $settings;
}
add_filter( 'tiny_mce_before_init', '_ccg_tinymce_add_class' );

/**
 * Theme Customizer settings for footer
 */
function _ccg_customize_register( $wp_customize ) {
    // Footer Section
    $wp_customize->add_section( 'footer_section', array(
        'title'       => __( 'Footer Settings', '_ccg' ),
        'priority'    => 30,
    ) );

    // Footer Heading
    $wp_customize->add_setting( 'footer_heading', array(
        'default'           => 'Stay Connected with Chau Chau Golf',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'footer_heading', array(
        'label'    => __( 'Footer Heading', '_ccg' ),
        'section'  => 'footer_section',
        'type'     => 'text',
    ) );

    // Footer Text
    $wp_customize->add_setting( 'footer_text', array(
        'default'           => 'Join our community and elevate your golf experience with exclusive resources and events.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ) );
    $wp_customize->add_control( 'footer_text', array(
        'label'    => __( 'Footer Text', '_ccg' ),
        'section'  => 'footer_section',
        'type'     => 'textarea',
    ) );

    // Join Button URL
    $wp_customize->add_setting( 'join_button_url', array(
        'default'           => '/join',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'join_button_url', array(
        'label'    => __( 'Join Button URL', '_ccg' ),
        'section'  => 'footer_section',
        'type'     => 'url',
    ) );

    // Join Button Text
    $wp_customize->add_setting( 'join_button_text', array(
        'default'           => 'Join',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'join_button_text', array(
        'label'    => __( 'Join Button Text', '_ccg' ),
        'section'  => 'footer_section',
        'type'     => 'text',
    ) );

    // Contact Button URL
    $wp_customize->add_setting( 'contact_button_url', array(
        'default'           => '/contact',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'contact_button_url', array(
        'label'    => __( 'Contact Button URL', '_ccg' ),
        'section'  => 'footer_section',
        'type'     => 'url',
    ) );

    // Contact Button Text
    $wp_customize->add_setting( 'contact_button_text', array(
        'default'           => 'Contact',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'contact_button_text', array(
        'label'    => __( 'Contact Button Text', '_ccg' ),
        'section'  => 'footer_section',
        'type'     => 'text',
    ) );

    // Social Media URLs
    $social_platforms = array(
        'facebook'  => 'Facebook URL',
        'instagram' => 'Instagram URL',
        'twitter'   => 'Twitter URL',
        'linkedin'  => 'LinkedIn URL',
        'youtube'   => 'YouTube URL',
    );

    foreach ( $social_platforms as $platform => $label ) {
        $wp_customize->add_setting( 'social_' . $platform, array(
            'default'           => '#',
            'sanitize_callback' => 'esc_url_raw',
        ) );
        $wp_customize->add_control( 'social_' . $platform, array(
            'label'    => __( $label, '_ccg' ),
            'section'  => 'footer_section',
            'type'     => 'url',
        ) );
    }

    // Copyright Text
    $wp_customize->add_setting( 'copyright_text', array(
        'default'           => ' ' . date('Y') . ' ' . get_bloginfo('name') . '. All rights reserved.',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'copyright_text', array(
        'label'    => __( 'Copyright Text', '_ccg' ),
        'section'  => 'footer_section',
        'type'     => 'text',
    ) );
}
add_action( 'customize_register', '_ccg_customize_register' );

/**
 * Register widget areas for footer menus
 */
function _ccg_footer_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Footer Menu 1', '_ccg' ),
        'id'            => 'footer-1',
        'description'   => __( 'Add widgets here to appear in your footer first column.', '_ccg' ),
        'before_widget' => '<div>',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="hidden">',
        'after_title'   => '</h2>',
    ) );

    register_sidebar( array(
        'name'          => __( 'Footer Menu 2', '_ccg' ),
        'id'            => 'footer-2',
        'description'   => __( 'Add widgets here to appear in your footer second column.', '_ccg' ),
        'before_widget' => '<div>',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="hidden">',
        'after_title'   => '</h2>',
    ) );
}
add_action( 'widgets_init', '_ccg_footer_widgets_init' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Custom Walker class for navigation menus
 */
class CCG_Walker_Nav_Menu extends Walker_Nav_Menu {
    /**
     * Starts the element output.
     */
    public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }
        $indent = ( $depth ) ? str_repeat( $t, $depth ) : '';

        $classes   = empty( $item->classes ) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;
        
        // Add class for items with children
        if ( in_array( 'menu-item-has-children', $classes ) ) {
            $classes[] = 'relative group';
        }

        /**
         * Filters the arguments for a single nav menu item.
         */
        $args = apply_filters( 'nav_menu_item_args', $args, $item, $depth );

        /**
         * Filters the CSS classes applied to a menu item's list item element.
         */
        $class_names = implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
        $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

        /**
         * Filters the ID applied to a menu item's list item element.
         */
        $id = apply_filters( 'nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth );
        $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

        $output .= $indent . '<li' . $id . $class_names . '>';

        $atts           = array();
        $atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
        $atts['target'] = ! empty( $item->target ) ? $item->target : '';
        if ( '_blank' === $item->target && empty( $item->xfn ) ) {
            $atts['rel'] = 'noopener';
        } else {
            $atts['rel'] = $item->xfn;
        }
        $atts['href']         = ! empty( $item->url ) ? $item->url : '';
        $atts['aria-current'] = $item->current ? 'page' : '';

        // Add classes to links
        $link_classes = array('block py-2 px-4 text-black hover:text-[#269763] transition-colors duration-300');
        
        if ( in_array( 'current-menu-item', $classes ) ) {
            $link_classes[] = 'text-[#269763] font-bold';
        }
        
        $atts['class'] = implode(' ', $link_classes);

        /**
         * Filters the HTML attributes applied to a menu item's anchor element.
         */
        $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

        $attributes = '';
        foreach ( $atts as $attr => $value ) {
            if ( is_scalar( $value ) && '' !== $value && false !== $value ) {
                $value       = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        /** This filter is documented in wp-includes/post-template.php */
        $title = apply_filters( 'the_title', $item->title, $item->ID );

        /**
         * Filters a menu item's title.
         */
        $title = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );

        $item_output  = $args->before;
        $item_output .= '<a' . $attributes . '>';
        $item_output .= $args->link_before . $title . $args->link_after;
        
        // We're not adding any chevrons here anymore - they're handled by JavaScript
        
        $item_output .= '</a>';
        $item_output .= $args->after;

        /**
         * Filters a menu item's starting output.
         */
        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }

    /**
     * Ends the element output, if needed.
     */
    public function end_el( &$output, $item, $depth = 0, $args = null ) {
        if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }
        $output .= "</li>{$n}";
    }

    /**
     * Starts the list before the elements are added.
     */
    public function start_lvl( &$output, $depth = 0, $args = null ) {
        if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }
        $indent = str_repeat( $t, $depth );

        // Default class.
        $classes = array( 'sub-menu', 'absolute left-0 mt-2 w-48 bg-white shadow-lg rounded-md py-2 z-10 hidden group-hover:block' );

        /**
         * Filters the CSS class(es) applied to a menu list element.
         */
        $class_names = implode( ' ', apply_filters( 'nav_menu_submenu_css_class', $classes, $args, $depth ) );
        $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

        $output .= "{$n}{$indent}<ul$class_names>{$n}";
    }
}

/**
 * Custom walker class for footer menu items
 */
class CCG_Footer_Walker_Nav_Menu extends Walker_Nav_Menu {
    /**
     * Starts the element output.
     */
    public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }
        $indent = ( $depth ) ? str_repeat( $t, $depth ) : '';

        $classes   = empty( $item->classes ) ? array() : (array) $item->classes;
        $classes[] = 'py-2 text-sm font-semibold';

        $args = apply_filters( 'nav_menu_item_args', $args, $item, $depth );

        $class_names = implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
        $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

        $id = apply_filters( 'nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth );
        $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

        $output .= $indent . '<li' . $id . $class_names . '>';

        $atts           = array();
        $atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
        $atts['target'] = ! empty( $item->target ) ? $item->target : '';
        if ( '_blank' === $item->target && empty( $item->xfn ) ) {
            $atts['rel'] = 'noopener';
        } else {
            $atts['rel'] = $item->xfn;
        }
        $atts['href']         = ! empty( $item->url ) ? $item->url : '';
        $atts['aria-current'] = $item->current ? 'page' : '';

        $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

        $attributes = '';
        foreach ( $atts as $attr => $value ) {
            if ( is_scalar( $value ) && '' !== $value && false !== $value ) {
                $value       = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        /** This filter is documented in wp-includes/post-template.php */
        $title = apply_filters( 'the_title', $item->title, $item->ID );
        $title = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );

        $item_output  = $args->before;
        $item_output .= '<a' . $attributes . '>';
        $item_output .= $args->link_before . $title . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}

/**
 * Handle tournament registration form submission
 */
function handle_tournament_registration() {
    // Verify nonce
    if (!isset($_POST['tournament_registration_nonce']) || 
        !wp_verify_nonce($_POST['tournament_registration_nonce'], 'tournament_registration_nonce')) {
        wp_send_json_error(['message' => 'Invalid nonce verification']);
        return;
    }

    // Get tournament ID
    $tournament_id = isset($_POST['tournament_id']) ? intval($_POST['tournament_id']) : 0;
    if (!$tournament_id) {
        wp_send_json_error(['message' => 'Invalid tournament ID']);
        return;
    }

    // Check if spots are available
    $spots_available = get_field('registration_info_spots_available', $tournament_id);
    if ($spots_available <= 0) {
        wp_send_json_error(['message' => 'Sorry, this tournament is full']);
        return;
    }

    // Get form data
    // Get and validate form data
    $first_name = isset($_POST['first_name']) ? sanitize_text_field($_POST['first_name']) : '';
    $last_name = isset($_POST['last_name']) ? sanitize_text_field($_POST['last_name']) : '';
    $email = isset($_POST['email']) ? sanitize_email($_POST['email']) : '';
    $phone = isset($_POST['phone']) ? sanitize_text_field($_POST['phone']) : '';
    $handicap = isset($_POST['handicap']) ? floatval($_POST['handicap']) : 0;
    $ghin_number = isset($_POST['ghin_number']) ? sanitize_text_field($_POST['ghin_number']) : '';
    $home_club = isset($_POST['home_club']) ? sanitize_text_field($_POST['home_club']) : '';
    $dietary_restrictions = isset($_POST['dietary_restrictions']) ? sanitize_textarea_field($_POST['dietary_restrictions']) : '';
    $special_requests = isset($_POST['special_requests']) ? sanitize_textarea_field($_POST['special_requests']) : '';

    // Validate required fields
    if (empty($first_name) || empty($last_name) || empty($email) || empty($phone) || 
        empty($handicap) || empty($ghin_number)) {
        wp_send_json_error(['message' => 'Please fill in all required fields']);
        return;
    }

    // Create registration post
    $registration = [
        'post_title' => $first_name . ' ' . $last_name . ' - ' . get_the_title($tournament_id),
        'post_type' => 'tournament_reg',
        'post_status' => 'publish',
    ];

    $registration_id = wp_insert_post($registration);

    if (is_wp_error($registration_id)) {
        wp_send_json_error(['message' => 'Failed to create registration']);
        return;
    }

    // Save registration details
    update_field('registration_details_first_name', $first_name, $registration_id);
    update_field('registration_details_last_name', $last_name, $registration_id);
    update_field('registration_details_email', $email, $registration_id);
    update_field('registration_details_phone', $phone, $registration_id);
    update_field('registration_details_handicap', $handicap, $registration_id);
    update_field('registration_details_ghin_number', $ghin_number, $registration_id);
    update_field('registration_details_home_club', $home_club, $registration_id);
    update_field('registration_details_dietary_restrictions', $dietary_restrictions, $registration_id);
    update_field('registration_details_special_requests', $special_requests, $registration_id);
    update_field('registration_details_tournament', $tournament_id, $registration_id);
    update_field('registration_details_status', 'registered', $registration_id);
    update_field('registration_details_payment_status', 'unpaid', $registration_id);
    update_field('registration_details_registration_date', date('Y-m-d H:i:s'), $registration_id);

    // Update spots available
    update_field('registration_info_spots_available', $spots_available - 1, $tournament_id);

    // Get payment link for email
    $tournament_payment_link = '';
    if (have_rows('registration_info', $tournament_id)) {
        while (have_rows('registration_info', $tournament_id)) {
            the_row();
            $tournament_payment_link = get_sub_field('payment_link');
        }
    }

    // Send confirmation email to registrant
    $to = $email;
    $subject = 'Tournament Registration Confirmation - ' . get_the_title($tournament_id);
    $message = "Thank you for registering for " . get_the_title($tournament_id) . ".\n\n";
    $message .= "Registration Details:\n";
    $message .= "Name: $first_name $last_name\n";
    $message .= "Email: $email\n";
    $message .= "Phone: $phone\n";
    $message .= "GHIN Number: $ghin_number\n";
    $message .= "Handicap Index: $handicap\n";
    if ($home_club) {
        $message .= "Home Club: $home_club\n";
    }
    $message .= "\nPayment Status: Unpaid\n";
    if ($tournament_payment_link) {
        $message .= "\nPlease complete your payment at: " . $tournament_payment_link . "\n";
    }

    $headers = ['Content-Type: text/plain; charset=UTF-8'];
    wp_mail($to, $subject, $message, $headers);

    // Send notification to admin
    $admin_email = get_option('admin_email');
    $admin_subject = 'New Tournament Registration - ' . get_the_title($tournament_id);
    wp_mail($admin_email, $admin_subject, $message, $headers);

    wp_send_json_success([
        'message' => 'Registration successful! Check your email for confirmation details.',
        'registration_id' => $registration_id,
        'player_name' => $first_name . ' ' . $last_name,
        'player_email' => $email,
        'payment_link' => $tournament_payment_link,
    ]);
}
add_action('wp_ajax_tournament_reg', 'handle_tournament_registration');
add_action('wp_ajax_nopriv_tournament_reg', 'handle_tournament_registration');

/**
 * Include playdate registration functionality
 */
require_once get_template_directory() . '/inc/post-types/playdate-registration.php';
require_once get_template_directory() . '/inc/playdate-registration-handler.php';

/**
 * Include tournament registration functionality
 */
require_once get_template_directory() . '/inc/post-types/tournament-registration.php';

/**
 * Include waitlist registration functionality
 */
require_once get_template_directory() . '/inc/post-types/waitlist.php';

/**
 * Include admin dashboard widgets
 */
require_once get_template_directory() . '/inc/admin-dashboard-widgets.php';

/**
 * Register ACF fields for the home page
 */
function _ccg_register_acf_fields() {
    if (function_exists('acf_add_local_field_group')) {
        acf_add_local_field_group(array(
            'key' => 'group_header_78',
            'title' => 'Header 78',
            'fields' => array(
                array(
                    'key' => 'field_header_78',
                    'label' => 'Header 78',
                    'name' => 'header_78',
                    'type' => 'group',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'layout' => 'block',
                    'sub_fields' => array(
                        array(
                            'key' => 'field_header',
                            'label' => 'Header',
                            'name' => 'header',
                            'type' => 'text',
                            'instructions' => '',
                            'required' => 0,
                            'conditional_logic' => 0,
                            'wrapper' => array(
                                'width' => '',
                                'class' => '',
                                'id' => '',
                            ),
                            'default_value' => 'Elevate Your Golf Experience with Chau Chau Golf Events and Merchandise',
                            'placeholder' => '',
                            'prepend' => '',
                            'append' => '',
                            'maxlength' => '',
                        ),
                        array(
                            'key' => 'field_content',
                            'label' => 'Content',
                            'name' => 'content',
                            'type' => 'textarea',
                            'instructions' => '',
                            'required' => 0,
                            'conditional_logic' => 0,
                            'wrapper' => array(
                                'width' => '',
                                'class' => '',
                                'id' => '',
                            ),
                            'default_value' => 'Become part of a dynamic community of golf enthusiasts and enhance your skills on the course. Explore thrilling tournaments, access expert resources, and participate in events designed specifically for you.',
                            'placeholder' => '',
                            'maxlength' => '',
                            'rows' => 4,
                            'new_lines' => 'br',
                        ),
                        array(
                            'key' => 'field_buttons',
                            'label' => 'Buttons',
                            'name' => 'buttons',
                            'type' => 'group',
                            'instructions' => '',
                            'required' => 0,
                            'conditional_logic' => 0,
                            'wrapper' => array(
                                'width' => '',
                                'class' => '',
                                'id' => '',
                            ),
                            'layout' => 'block',
                            'sub_fields' => array(
                                array(
                                    'key' => 'field_button_one_label',
                                    'label' => 'Button One Label',
                                    'name' => 'button_one_label',
                                    'type' => 'text',
                                    'instructions' => '',
                                    'required' => 0,
                                    'conditional_logic' => 0,
                                    'wrapper' => array(
                                        'width' => '50',
                                        'class' => '',
                                        'id' => '',
                                    ),
                                    'default_value' => 'Learn More',
                                    'placeholder' => '',
                                    'prepend' => '',
                                    'append' => '',
                                    'maxlength' => '',
                                ),
                                array(
                                    'key' => 'field_button_one_link',
                                    'label' => 'Button One Link',
                                    'name' => 'button_one_link',
                                    'type' => 'url',
                                    'instructions' => '',
                                    'required' => 0,
                                    'conditional_logic' => 0,
                                    'wrapper' => array(
                                        'width' => '50',
                                        'class' => '',
                                        'id' => '',
                                    ),
                                    'default_value' => '',
                                    'placeholder' => '',
                                ),
                                array(
                                    'key' => 'field_button_two_label',
                                    'label' => 'Button Two Label',
                                    'name' => 'button_two_label',
                                    'type' => 'text',
                                    'instructions' => '',
                                    'required' => 0,
                                    'conditional_logic' => 0,
                                    'wrapper' => array(
                                        'width' => '50',
                                        'class' => '',
                                        'id' => '',
                                    ),
                                    'default_value' => 'Sign Up',
                                    'placeholder' => '',
                                    'prepend' => '',
                                    'append' => '',
                                    'maxlength' => '',
                                ),
                                array(
                                    'key' => 'field_button_two_link',
                                    'label' => 'Button Two Link',
                                    'name' => 'button_two_link',
                                    'type' => 'url',
                                    'instructions' => '',
                                    'required' => 0,
                                    'conditional_logic' => 0,
                                    'wrapper' => array(
                                        'width' => '50',
                                        'class' => '',
                                        'id' => '',
                                    ),
                                    'default_value' => '',
                                    'placeholder' => '',
                                ),
                            ),
                        ),
                        array(
                            'key' => 'field_images',
                            'label' => 'Images',
                            'name' => 'images',
                            'type' => 'gallery',
                            'instructions' => 'Add images for the marquee slider',
                            'required' => 0,
                            'conditional_logic' => 0,
                            'wrapper' => array(
                                'width' => '',
                                'class' => '',
                                'id' => '',
                            ),
                            'return_format' => 'array',
                            'preview_size' => 'medium',
                            'insert' => 'append',
                            'library' => 'all',
                            'min' => '',
                            'max' => '',
                            'min_width' => '',
                            'min_height' => '',
                            'min_size' => '',
                            'max_width' => '',
                            'max_height' => '',
                            'max_size' => '',
                            'mime_types' => 'jpg, jpeg, png',
                        ),
                    ),
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'page_template',
                        'operator' => '==',
                        'value' => 'template-home.php',
                    ),
                ),
            ),
            'menu_order' => 0,
            'position' => 'normal',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
            'hide_on_screen' => '',
            'active' => true,
            'description' => '',
            'show_in_rest' => 0,
        ));
    }
}
add_action('acf/init', '_ccg_register_acf_fields');

/**
 * Register ACF fields for tournament registration
 */
function register_tournament_registration_acf_fields() {
    if (function_exists('acf_add_local_field_group')) {
        // Tournament Registration Details
        acf_add_local_field_group(array(
            'key' => 'group_tournament_registration_details',
            'title' => 'Registration Details',
            'fields' => array(
                array(
                    'key' => 'field_registration_details_first_name',
                    'label' => 'First Name',
                    'name' => 'registration_details_first_name',
                    'type' => 'text',
                    'required' => 1,
                ),
                array(
                    'key' => 'field_registration_details_last_name',
                    'label' => 'Last Name',
                    'name' => 'registration_details_last_name',
                    'type' => 'text',
                    'required' => 1,
                ),
                array(
                    'key' => 'field_registration_details_email',
                    'label' => 'Email',
                    'name' => 'registration_details_email',
                    'type' => 'email',
                    'required' => 1,
                ),
                array(
                    'key' => 'field_registration_details_phone',
                    'label' => 'Phone',
                    'name' => 'registration_details_phone',
                    'type' => 'text',
                    'required' => 1,
                ),
                array(
                    'key' => 'field_registration_details_handicap',
                    'label' => 'Handicap Index',
                    'name' => 'registration_details_handicap',
                    'type' => 'number',
                    'required' => 1,
                    'min' => -10,
                    'max' => 54,
                    'step' => 0.1,
                ),
                array(
                    'key' => 'field_registration_details_ghin_number',
                    'label' => 'GHIN Number',
                    'name' => 'registration_details_ghin_number',
                    'type' => 'text',
                    'required' => 1,
                ),
                array(
                    'key' => 'field_registration_details_home_club',
                    'label' => 'Home Club',
                    'name' => 'registration_details_home_club',
                    'type' => 'text',
                ),
                array(
                    'key' => 'field_registration_details_dietary_restrictions',
                    'label' => 'Dietary Restrictions',
                    'name' => 'registration_details_dietary_restrictions',
                    'type' => 'textarea',
                ),
                array(
                    'key' => 'field_registration_details_special_requests',
                    'label' => 'Special Requests',
                    'name' => 'registration_details_special_requests',
                    'type' => 'textarea',
                ),
                array(
                    'key' => 'field_registration_details_tournament',
                    'label' => 'Tournament',
                    'name' => 'registration_details_tournament',
                    'type' => 'post_object',
                    'post_type' => array('tournament'),
                    'required' => 1,
                ),
                array(
                    'key' => 'field_registration_details_status',
                    'label' => 'Status',
                    'name' => 'registration_details_status',
                    'type' => 'select',
                    'choices' => array(
                        'registered' => 'Registered',
                        'waitlisted' => 'Waitlisted',
                        'cancelled' => 'Cancelled',
                    ),
                    'default_value' => 'registered',
                    'required' => 1,
                ),
                array(
                    'key' => 'field_registration_details_payment_status',
                    'label' => 'Payment Status',
                    'name' => 'registration_details_payment_status',
                    'type' => 'select',
                    'choices' => array(
                        'unpaid' => 'Unpaid',
                        'paid' => 'Paid',
                        'refunded' => 'Refunded',
                    ),
                    'default_value' => 'unpaid',
                    'required' => 1,
                ),
                array(
                    'key' => 'field_registration_details_registration_date',
                    'label' => 'Registration Date',
                    'name' => 'registration_details_registration_date',
                    'type' => 'date_time_picker',
                    'required' => 1,
                    'display_format' => 'F j, Y g:i a',
                    'return_format' => 'Y-m-d H:i:s',
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'tournament_reg',
                    ),
                ),
            ),
            'menu_order' => 0,
            'position' => 'normal',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
            'hide_on_screen' => array(
                'permalink',
                'the_content',
                'excerpt',
                'discussion',
                'comments',
                'revisions',
                'slug',
                'author',
                'format',
                'page_attributes',
                'featured_image',
                'categories',
                'tags',
                'send-trackbacks',
            ),
        ));

        // Tournament Registration Info
        acf_add_local_field_group(array(
            'key' => 'group_tournament_registration_info',
            'title' => 'Registration Information',
            'fields' => array(
                array(
                    'key' => 'field_registration_info_registration_fee',
                    'label' => 'Registration Fee',
                    'name' => 'registration_info_registration_fee',
                    'type' => 'number',
                    'required' => 1,
                    'min' => 0,
                ),
                array(
                    'key' => 'field_registration_info_registration_deadline',
                    'label' => 'Registration Deadline',
                    'name' => 'registration_info_registration_deadline',
                    'type' => 'date_time_picker',
                    'required' => 1,
                    'display_format' => 'F j, Y',
                    'return_format' => 'F j, Y',
                ),
                array(
                    'key' => 'field_registration_info_spots_available',
                    'label' => 'Spots Available',
                    'name' => 'registration_info_spots_available',
                    'type' => 'number',
                    'required' => 1,
                    'min' => 0,
                ),
                array(
                    'key' => 'field_registration_info_registration_instructions',
                    'label' => 'Registration Instructions',
                    'name' => 'registration_info_registration_instructions',
                    'type' => 'wysiwyg',
                    'tabs' => 'visual',
                    'toolbar' => 'basic',
                    'media_upload' => 0,
                ),
                array(
                    'key' => 'field_registration_info_whats_included',
                    'label' => "What's Included",
                    'name' => 'registration_info_whats_included',
                    'type' => 'repeater',
                    'layout' => 'table',
                    'button_label' => 'Add Item',
                    'sub_fields' => array(
                        array(
                            'key' => 'field_registration_info_whats_included_item',
                            'label' => 'Item',
                            'name' => 'item',
                            'type' => 'text',
                            'required' => 1,
                        ),
                    ),
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'tournament',
                    ),
                ),
            ),
            'menu_order' => 0,
            'position' => 'normal',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
        ));
    }
}
add_action('acf/init', 'register_tournament_registration_acf_fields');

/**
 * Register additional ACF field groups for layouts
 */
function register_additional_layout_fields() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }

    // Configuration for all layout field groups
    $layouts = array(
        'layout_241' => array('location' => 'page_template', 'value' => 'template-home.php'),
        'layout_179' => array('location' => 'page_template', 'value' => 'template-home.php'),
        'layout_272' => array('location' => 'page_template', 'value' => 'template-home.php'),
        'layout_190' => array('location' => 'page_template', 'value' => 'template-home.php'),
        'layout_27' => array('location' => 'page_template', 'value' => 'template-playdates.php'),
        'layout_222' => array('location' => 'page_template', 'value' => 'template-about.php'),
        'layout_275' => array('location' => 'page_template', 'value' => 'template-about.php'),
        'layout_408' => array('location' => 'page_template', 'value' => 'template-about.php'),
        'layout_4' => array('location' => 'page_template', 'value' => 'template-about.php'),
        'layout_431' => array('location' => 'page_template', 'value' => 'template-about.php'),
        'header_46' => array('location' => 'page_template', 'value' => 'template-faqs.php'),
        'faq_2' => array('location' => 'page_template', 'value' => 'template-faqs.php'),
        'cta_3' => array('location' => 'page_template', 'value' => 'default'),
        'cta_1' => array('location' => 'page_template', 'value' => 'default'),
        'cta_31' => array('location' => 'page_template', 'value' => 'template-faqs.php'),
    );

    foreach ($layouts as $layout_name => $location) {
        // Base fields common to most layouts
        $fields = array(
            array(
                'key' => 'field_' . $layout_name . '_sub_header',
                'label' => 'Sub Header',
                'name' => $layout_name . '_sub_header',
                'type' => 'text',
            ),
            array(
                'key' => 'field_' . $layout_name . '_header',
                'label' => 'Header',
                'name' => $layout_name . '_header',
                'type' => 'text',
            ),
            array(
                'key' => 'field_' . $layout_name . '_content',
                'label' => 'Content',
                'name' => $layout_name . '_content',
                'type' => 'textarea',
            ),
        );

        // Add cards repeater for layout types
        if (strpos($layout_name, 'layout_') === 0) {
            $fields[] = array(
                'key' => 'field_' . $layout_name . '_cards',
                'label' => 'Cards',
                'name' => $layout_name . '_cards',
                'type' => 'repeater',
                'sub_fields' => array(
                    array(
                        'key' => 'field_' . $layout_name . '_card_icon_type',
                        'label' => 'Icon Type',
                        'name' => 'icon_type',
                        'type' => 'text',
                    ),
                    array(
                        'key' => 'field_' . $layout_name . '_card_header',
                        'label' => 'Header',
                        'name' => 'header',
                        'type' => 'text',
                    ),
                    array(
                        'key' => 'field_' . $layout_name . '_card_content',
                        'label' => 'Content',
                        'name' => 'content',
                        'type' => 'textarea',
                    ),
                ),
            );
        }

        // Add buttons for CTA types
        if (strpos($layout_name, 'cta_') === 0) {
            $fields[] = array(
                'key' => 'field_' . $layout_name . '_button_one_label',
                'label' => 'Button One Label',
                'name' => $layout_name . '_button_one_label',
                'type' => 'text',
            );
            $fields[] = array(
                'key' => 'field_' . $layout_name . '_button_one_link',
                'label' => 'Button One Link',
                'name' => $layout_name . '_button_one_link',
                'type' => 'url',
            );
            $fields[] = array(
                'key' => 'field_' . $layout_name . '_button_two_label',
                'label' => 'Button Two Label',
                'name' => $layout_name . '_button_two_label',
                'type' => 'text',
            );
            $fields[] = array(
                'key' => 'field_' . $layout_name . '_button_two_link',
                'label' => 'Button Two Link',
                'name' => $layout_name . '_button_two_link',
                'type' => 'url',
            );
            $fields[] = array(
                'key' => 'field_' . $layout_name . '_image',
                'label' => 'Image',
                'name' => $layout_name . '_image',
                'type' => 'image',
            );
        }

        // Add FAQ-specific fields
        if ($layout_name === 'faq_2') {
            $fields[] = array(
                'key' => 'field_faq_2_items',
                'label' => 'FAQ Items',
                'name' => 'faq_2_items',
                'type' => 'repeater',
                'sub_fields' => array(
                    array(
                        'key' => 'field_faq_2_question',
                        'label' => 'Question',
                        'name' => 'question',
                        'type' => 'text',
                    ),
                    array(
                        'key' => 'field_faq_2_answer',
                        'label' => 'Answer',
                        'name' => 'answer',
                        'type' => 'textarea',
                    ),
                ),
            );
        }

        // Register the field group
        acf_add_local_field_group(array(
            'key' => 'group_' . $layout_name,
            'title' => ucwords(str_replace('_', ' ', $layout_name)),
            'fields' => $fields,
            'location' => array(
                array(
                    array(
                        'param' => $location['location'],
                        'operator' => '==',
                        'value' => $location['value'],
                    ),
                ),
            ),
        ));
    }
}
add_action('acf/init', 'register_additional_layout_fields');

/**
 * Enqueue scripts and styles.
 */
function ccg_scripts() {
    wp_enqueue_style( '_ccg-style', get_stylesheet_uri(), array(), _CCG_VERSION );
    wp_enqueue_script( '_ccg-script', get_template_directory_uri() . '/js/script.min.js', array(), _CCG_VERSION, true );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }

    // Add AlpineJS for FAQ accordion
    wp_enqueue_script('alpinejs', 'https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js', array(), null, true);
    wp_script_add_data('alpinejs', 'defer', true);

    // Localize script for registration AJAX
    if ( is_singular( 'tournament' ) || is_singular( 'playdate' ) ) {
        wp_localize_script( '_ccg-script', 'ajax_object', array(
            'ajax_url' => admin_url( 'admin-ajax.php' ),
        ) );
    }
}
add_action('wp_enqueue_scripts', 'ccg_scripts');

/**
 * Custom Login Logo
 */
function ccg_custom_login_logo() {
    ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/assets/images/ccg-logo.png);
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
            width: 300px;
            height: 100px;
            margin-bottom: 20px;
        }
        
        .wp-core-ui .button-primary {
            background-color: #269763 !important;
            border-color: #269763 !important;
            color: #ffffff !important;
        }
        
        .wp-core-ui .button-primary:hover,
        .wp-core-ui .button-primary:focus {
            background-color: #1f7a4f !important;
            border-color: #1f7a4f !important;
            color: #ffffff !important;
        }
        
        .login #backtoblog a:hover, 
        .login #nav a:hover {
            color: #269763 !important;
        }
    </style>
    <?php
}
add_action('login_enqueue_scripts', 'ccg_custom_login_logo');

/**
 * Change custom logo link from wordpress.org to home url
 */
function _ccg_custom_logo_link($html) {
    $html = str_replace('href="https://wordpress.org/"', 'href="' . esc_url(home_url('/')) . '"', $html);
    return $html;
}
add_filter('get_custom_logo', '_ccg_custom_logo_link');
