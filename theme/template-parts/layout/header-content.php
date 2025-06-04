<?php
/**
 * Template part for displaying the header content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package _ccg
 */

?>

<header id="masthead" class="sticky top-0 z-50 bg-white shadow-md">
    <div class="mx-auto px-8 md:px-10 lg:px-12 flex flex-wrap items-center justify-between container">
        <!-- Logo -->
        <div class="flex items-center">
            <?php if (has_custom_logo()) : ?>
                <div class="site-logo">
                    <?php the_custom_logo(); ?>
                </div>
            <?php else : ?>
                <a href="<?php echo esc_url(home_url('/')); ?>" class="flex items-center">
                    <img src="<?php echo esc_url(get_theme_file_uri('/assets/images/ChauChau-Golf.svg')); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" class="h-48 w-auto">
                </a>
            <?php endif; ?>
        </div>

        <!-- Mobile menu button -->
        <button id="mobile-menu-toggle" class="md:hidden flex items-center p-2 text-black hover:text-[#269763] focus:outline-none transition-colors duration-300">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="menu-icon">
                <line x1="3" y1="12" x2="21" y2="12"></line>
                <line x1="3" y1="6" x2="21" y2="6"></line>
                <line x1="3" y1="18" x2="21" y2="18"></line>
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="close-icon hidden">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
        </button>

        <!-- Navigation -->
        <div id="nav-container" class="hidden w-full md:w-auto md:flex items-center justify-between flex-1 pl-8">
            <nav id="site-navigation" class="flex items-center justify-center flex-grow mx-8" aria-label="<?php esc_attr_e('Main Navigation', '_ccg'); ?>">
                <?php
                // Check if the menu exists and display it
                if (has_nav_menu('menu-1')) {
                    wp_nav_menu(
                        array(
                            'theme_location' => 'menu-1',
                            'menu_id'        => 'primary-menu',
                            'container'      => false,
                            'menu_class'     => 'flex flex-col md:flex-row md:space-x-12',
                            'items_wrap'     => '<ul id="%1$s" class="%2$s" aria-label="submenu">%3$s</ul>',
                            'walker'         => new CCG_Walker_Nav_Menu(),
                            'fallback_cb'    => false,
                        )
                    );
                } else {
                    // Fallback menu if no menu is assigned
                    echo '<ul id="primary-menu" class="flex flex-col md:flex-row md:space-x-6" aria-label="submenu">';
                    echo '<li class="relative"><a href="' . esc_url(home_url('/')) . '" class="block py-2 px-4 text-black hover:text-[#269763] transition-colors duration-300">Home</a></li>';
                    echo '<li class="relative"><a href="#" class="block py-2 px-4 text-black hover:text-[#269763] transition-colors duration-300">About</a></li>';
                    echo '<li class="relative"><a href="#" class="block py-2 px-4 text-black hover:text-[#269763] transition-colors duration-300">Services</a></li>';
                    echo '</ul>';
                }
                ?>
            </nav>

            <?php if (!is_user_logged_in()) : ?>
                <div class="flex flex-col md:flex-row gap-2 mt-4 md:mt-0">
                    <a href="<?php echo esc_url(wp_login_url()); ?>" class="inline-flex items-center justify-center gap-2 rounded-lg bg-[#269763] px-4 py-2 text-sm font-semibold text-white transition hover:bg-[#269763]/80">
                        Login
                    </a>
                    <a href="<?php echo esc_url(home_url('/register')); ?>" class="inline-flex items-center justify-center gap-2 rounded-lg border border-[#269763] px-4 py-2 text-sm font-semibold text-[#269763] transition hover:bg-[#269763] hover:text-white">
                        Register                    </a>
                </div>
            <?php else : ?>
                <div class="relative" id="user-menu">
                    <button id="user-menu-button" class="inline-flex items-center gap-2 rounded-lg border border-[#269763] px-4 py-2 text-sm font-semibold text-[#269763] transition hover:bg-[#269763]/10">
                        <i data-lucide="user" class="h-4 w-4"></i>
                        <?php 
                        $current_user = wp_get_current_user();
                        echo esc_html($current_user->display_name);
                        ?>
                        <i data-lucide="chevron-down" class="h-4 w-4"></i>
                    </button>
                    
                    <div id="user-dropdown" class="hidden absolute right-0 mt-2 w-48 origin-top-right rounded-lg bg-white py-2 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                        <a href="<?php echo esc_url(home_url('/dashboard')); ?>" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            <i data-lucide="layout-dashboard" class="h-4 w-4"></i>
                            Dashboard
                        </a>
                        <a href="<?php echo home_url('/my-playdates'); ?>" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            <i data-lucide="calendar-check" class="h-4 w-4"></i>
                            My Playdates
                        </a>
                        <a href="<?php echo wp_logout_url(home_url()); ?>" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            <i data-lucide="log-out" class="h-4 w-4"></i>
                            Logout
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</header>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Mobile Menu Toggle
    const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
    const navContainer = document.getElementById('nav-container');
    const menuIcon = document.querySelector('.menu-icon');
    const closeIcon = document.querySelector('.close-icon');

    if (mobileMenuToggle) {
        mobileMenuToggle.addEventListener('click', function() {
            navContainer.classList.toggle('hidden');
            menuIcon.classList.toggle('hidden');
            closeIcon.classList.toggle('hidden');
            
            if (window.innerWidth < 768) {
                navContainer.classList.toggle('mobile-menu-open');
            }
        });
    }

    // User Menu Toggle
    const userMenuButton = document.getElementById('user-menu-button');
    const userDropdown = document.getElementById('user-dropdown');

    if (userMenuButton && userDropdown) {
        userMenuButton.addEventListener('click', function(e) {
            e.stopPropagation();
            userDropdown.classList.toggle('hidden');
        });

        document.addEventListener('click', function(e) {
            if (!userMenuButton.contains(e.target)) {
                userDropdown.classList.add('hidden');
            }
        });
    }

    // Handle window resize
    window.addEventListener('resize', function() {
        if (window.innerWidth >= 768) {
            navContainer.classList.remove('mobile-menu-open');
            menuIcon.classList.remove('hidden');
            closeIcon.classList.add('hidden');
            if (!navContainer.classList.contains('md:flex')) {
                navContainer.classList.add('md:flex');
            }
        }
    });
});
</script>

<style>
@media (max-width: 767px) {
    #nav-container.mobile-menu-open {
        display: flex !important;
        flex-direction: column;
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background-color: white;
        padding: 1rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        z-index: 50;
    }

    #nav-container.mobile-menu-open #site-navigation {
        margin-bottom: 1rem;
    }

    #nav-container.mobile-menu-open .flex.flex-col {
        width: 100%;
    }

    #user-dropdown {
        position: static !important;
        width: 100% !important;
        margin-top: 0.5rem !important;
        box-shadow: none !important;
    }

    #user-menu {
        width: 100%;
    }

    #user-menu button {
        width: 100%;
        justify-content: center;
    }
}

@media (min-width: 768px) {
    .menu-item-has-children {
        position: relative;
    }

    .menu-item-has-children:hover > .sub-menu {
        display: block;
        opacity: 1;
        visibility: visible;
    }

    .sub-menu {
        position: absolute;
        top: 100%;
        left: 0;
        min-width: 200px;
        background: white;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.2s, visibility 0.2s;
        z-index: 50;
        padding: 0.5rem 0;
    }

    .sub-menu .menu-item {
        display: block;
        width: 100%;
    }

    .sub-menu .menu-item a {
        padding: 0.5rem 1rem;
        display: block;
        width: 100%;
        white-space: nowrap;
    }
}
</style>
