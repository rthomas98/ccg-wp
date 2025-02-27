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
    <div class="mx-auto px-8 md:px-10 lg:px-12 flex flex-wrap items-center justify-between">
        <!-- Logo -->
        <div class="flex items-center">
            <?php if (has_custom_logo()) : ?>
                <div class="site-logo">
                    <?php the_custom_logo(); ?>
                </div>
            <?php else : ?>
                <a href="<?php echo esc_url(home_url('/')); ?>" class="flex items-center">
                    <?php 
                    // Get the uploads directory URL dynamically
                    $upload_dir = wp_upload_dir();
                    $logo_path = '/2025/02/ccg.png'; // Relative path to the logo in uploads directory
                    $logo_url = $upload_dir['baseurl'] . $logo_path;
                    
                    // Check if the file exists or use a fallback
                    $logo_file_path = $upload_dir['basedir'] . $logo_path;
                    if (!file_exists($logo_file_path)) {
                        // Fallback to theme directory
                        $logo_url = get_template_directory_uri() . '/theme/assets/images/logo.png';
                        
                        // If that doesn't exist either, use the site name as text
                        if (!file_exists(get_template_directory() . '/theme/assets/images/logo.png')) {
                            echo '<span class="text-2xl font-bold text-[#269763]">' . get_bloginfo('name') . '</span>';
                        } else {
                            echo '<img src="' . esc_url($logo_url) . '" alt="' . esc_attr(get_bloginfo('name')) . '" class="h-20 w-auto">';
                        }
                    } else {
                        echo '<img src="' . esc_url($logo_url) . '" alt="' . esc_attr(get_bloginfo('name')) . '" class="h-20 w-auto">';
                    }
                    ?>
                </a>
            <?php endif; ?>
        </div>

        <!-- Mobile menu button -->
        <button id="mobile-menu-toggle" class="md:hidden flex items-center p-2 text-black hover:text-[#269763] focus:outline-none transition-colors duration-300" aria-label="Toggle menu" aria-expanded="false" aria-controls="primary-menu">
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
        <nav id="site-navigation" class="hidden md:flex items-center w-full md:w-auto md:ml-auto" aria-label="<?php esc_attr_e('Main Navigation', '_ccg'); ?>">
            <?php
            // Check if the menu exists and display it
            if (has_nav_menu('menu-1')) {
                wp_nav_menu(
                    array(
                        'theme_location' => 'menu-1',
                        'menu_id'        => 'primary-menu',
                        'container'      => false,
                        'menu_class'     => 'flex flex-col md:flex-row md:space-x-6',
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
                echo '<li class="relative"><a href="#" class="block py-2 px-4 text-black hover:text-[#269763] transition-colors duration-300">Contact</a></li>';
                echo '</ul>';
            }
            ?>
            
            <!-- CTA buttons -->
            <div class="header-cta mt-4 md:mt-0 md:ml-6 flex flex-wrap gap-4">
                <a href="<?php echo esc_url(home_url('/contact')); ?>" class="inline-block px-5 py-2 bg-[#269763] text-white font-medium rounded-md hover:bg-[#1c7a4e] transition-colors duration-300">
                    Contact Us
                </a>
            </div>
        </nav>
    </div>
</header>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
    const siteNavigation = document.getElementById('site-navigation');
    const menuIcon = document.querySelector('.menu-icon');
    const closeIcon = document.querySelector('.close-icon');
    
    // Function to check if menu exists
    function checkMenuExists() {
        const primaryMenu = document.getElementById('primary-menu');
        return primaryMenu && primaryMenu.children.length > 0;
    }
    
    // Only setup mobile menu if the menu exists
    if (mobileMenuToggle && checkMenuExists()) {
        mobileMenuToggle.addEventListener('click', function() {
            // Toggle the navigation
            siteNavigation.classList.toggle('hidden');
            
            // Toggle the icons
            menuIcon.classList.toggle('hidden');
            closeIcon.classList.toggle('hidden');
            
            // Update aria-expanded
            const expanded = mobileMenuToggle.getAttribute('aria-expanded') === 'true' || false;
            mobileMenuToggle.setAttribute('aria-expanded', !expanded);
        });
    }
    
    // Handle window resize
    window.addEventListener('resize', function() {
        if (window.innerWidth >= 768) { // md breakpoint
            if (checkMenuExists()) {
                siteNavigation.classList.remove('hidden');
                siteNavigation.classList.add('md:flex');
            }
            
            // Reset all mobile dropdown menus when switching to desktop
            document.querySelectorAll('.sub-menu').forEach(function(submenu) {
                if (window.innerWidth >= 768) {
                    submenu.classList.remove('mobile-dropdown-active');
                    submenu.style.display = '';
                } else {
                    submenu.style.display = 'none';
                }
            });
        } else {
            siteNavigation.classList.add('hidden');
            if (menuIcon) menuIcon.classList.remove('hidden');
            if (closeIcon) closeIcon.classList.add('hidden');
            if (mobileMenuToggle) mobileMenuToggle.setAttribute('aria-expanded', 'false');
        }
    });
    
    // Handle dropdown menus for mobile devices
    const menuItemsWithChildren = document.querySelectorAll('.menu-item-has-children > a');
    
    menuItemsWithChildren.forEach(function(menuItem) {
        // Add desktop chevron
        const desktopChevron = document.createElement('span');
        desktopChevron.className = 'desktop-chevron hidden md:inline-block ml-1';
        desktopChevron.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>';
        menuItem.appendChild(desktopChevron);
        
        // Create a dropdown toggle button for mobile
        const dropdownToggle = document.createElement('button');
        dropdownToggle.className = 'dropdown-toggle ml-2 p-1 focus:outline-none md:hidden';
        dropdownToggle.setAttribute('aria-expanded', 'false');
        dropdownToggle.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>';
        
        // Insert the toggle button after the menu item link (inside the li)
        menuItem.appendChild(dropdownToggle);
        
        // Find the submenu - it should be the next sibling of the menu item (li)
        const submenu = menuItem.parentNode.querySelector('.sub-menu');
        if (submenu) {
            if (window.innerWidth < 768) {
                submenu.style.display = 'none';
            }
        }
        
        // Add click event to toggle button
        dropdownToggle.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            // Find the submenu - it should be a sibling of the parent li
            const submenu = this.parentNode.parentNode.querySelector('.sub-menu');
            if (submenu) {
                // Toggle dropdown visibility
                if (window.innerWidth < 768) {
                    if (submenu.style.display === 'none' || submenu.style.display === '') {
                        submenu.style.display = 'block';
                        submenu.classList.add('mobile-dropdown-active');
                        this.setAttribute('aria-expanded', 'true');
                        // Rotate the arrow icon
                        this.querySelector('svg').style.transform = 'rotate(180deg)';
                    } else {
                        submenu.style.display = 'none';
                        submenu.classList.remove('mobile-dropdown-active');
                        this.setAttribute('aria-expanded', 'false');
                        // Reset the arrow icon
                        this.querySelector('svg').style.transform = '';
                    }
                }
            }
        });
        
        // Prevent the default hover behavior on mobile
        menuItem.addEventListener('click', function(e) {
            if (window.innerWidth < 768) {
                if (this.parentNode.classList.contains('menu-item-has-children')) {
                    e.preventDefault();
                    const dropdownToggle = this.querySelector('.dropdown-toggle');
                    if (dropdownToggle) {
                        dropdownToggle.click();
                    }
                }
            }
        });
    });
});
</script>

<!-- Add responsive styles -->
<style>
    @media (max-width: 767px) {
        #site-navigation:not(.hidden) {
            display: flex;
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
        
        .submenu-open > .sub-menu {
            display: block !important;
        }
    }
</style>
