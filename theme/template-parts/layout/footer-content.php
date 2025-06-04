<?php
/**
 * Template part for displaying the footer content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package _ccg
 */

?>

<footer id="colophon" class="px-[5%] py-12 md:py-18 lg:py-20">
    <div class="container mx-auto bg-white p-4">
        <div class="grid grid-cols-1 gap-x-[4vw] gap-y-12 border border-gray-200 p-8 md:gap-y-16 md:p-12 lg:grid-cols-[1fr_0.5fr] lg:gap-y-4">
            <div class="flex flex-col items-start">
                <div class="rb-6 max-w-md">
                    <div class="rb-6 mb-5 md:mb-6">
                        <a href="<?php echo esc_url(home_url('/')); ?>">
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
                                    echo '<img src="' . esc_url($logo_url) . '" alt="' . esc_attr(get_bloginfo('name')) . '" class="inline-block h-32 w-auto">';
                                }
                            } else {
                                echo '<img src="' . esc_url($logo_url) . '" alt="' . esc_attr(get_bloginfo('name')) . '" class="inline-block h-32 w-auto">';
                            }
                            ?>
                        </a>
                    </div>
                    <h1 class="mb-5 text-4xl font-bold md:mb-6 md:text-5xl lg:text-6xl">
                        <?php echo esc_html(get_theme_mod('footer_heading', 'Stay Connected with Chau Chau Golf')); ?>
                    </h1>
                    <p>
                        <?php echo esc_html(get_theme_mod('footer_text', 'Join our community and elevate your golf experience with exclusive resources and events.')); ?>
                    </p>
                    <div class="mt-6 flex flex-wrap gap-4 md:mt-8">
                        <a href="<?php echo esc_url(home_url(get_theme_mod('join_button_url', '/register'))); ?>" class="inline-block px-5 py-2 bg-[#269763] text-white font-medium rounded-md hover:bg-[#1c7a4e] transition-colors duration-300">
                            <?php echo esc_html(get_theme_mod('join_button_text', 'Become A Member')); ?>
                        </a>
                        <a href="<?php echo esc_url(home_url(get_theme_mod('contact_button_url', '/contact-us'))); ?>" class="inline-block px-5 py-2 border border-[#269763] text-[#269763] font-medium rounded-md hover:bg-[#f8f8f8] transition-colors duration-300">
                            <?php echo esc_html(get_theme_mod('contact_button_text', 'Contact Us')); ?>
                        </a>
                    </div>
                </div>
            </div>
            <div class="flex flex-col justify-between gap-8">
                <div class="grid grid-cols-1 items-start gap-x-6 gap-y-10 sm:grid-cols-2 md:gap-x-8 md:gap-y-4">
                    <?php if (has_nav_menu('footer-column-1')) : ?>
                        <?php
                        wp_nav_menu(
                            array(
                                'theme_location' => 'footer-column-1',
                                'menu_class'     => 'footer-menu',
                                'container'      => false,
                                'items_wrap'     => '<ul>%3$s</ul>',
                                'depth'          => 1,
                                'link_before'    => '<span class="py-2 text-sm font-semibold">',
                                'link_after'     => '</span>',
                                'walker'         => new CCG_Footer_Walker_Nav_Menu(),
                            )
                        );
                        ?>
                    <?php else : ?>
                        <ul>
                            <li class="py-2 text-sm font-semibold">
                                <a href="<?php echo esc_url(home_url('/about')); ?>">About Us</a>
                            </li>
                            <li class="py-2 text-sm font-semibold">
                                <a href="<?php echo esc_url(home_url('/tournaments')); ?>">Tournaments</a>
                            </li>
                            <li class="py-2 text-sm font-semibold">
                                <a href="<?php echo esc_url(home_url('/playdates')); ?>">Playdates</a>
                            </li>
                            <li class="py-2 text-sm font-semibold">
                                <a href="<?php echo esc_url(home_url('/register')); ?>">Get Started</a>
                            </li>
                            <li class="py-2 text-sm font-semibold">
                                <a href="<?php echo esc_url(home_url('/contact-us')); ?>">Contact Us</a>
                            </li>
                        </ul>
                    <?php endif; ?>

                    <?php if (has_nav_menu('footer-column-2')) : ?>
                        <?php
                        wp_nav_menu(
                            array(
                                'theme_location' => 'footer-column-2',
                                'menu_class'     => 'footer-menu',
                                'container'      => false,
                                'items_wrap'     => '<ul>%3$s</ul>',
                                'depth'          => 1,
                                'link_before'    => '<span class="py-2 text-sm font-semibold">',
                                'link_after'     => '</span>',
                                'walker'         => new CCG_Footer_Walker_Nav_Menu(),
                            )
                        );
                        ?>
                    <?php else : ?>
                        <ul>
                            <li class="py-2 text-sm font-semibold">
                                <a href="<?php echo esc_url(home_url('/membership')); ?>">Membership</a>
                            </li>
                            <li class="py-2 text-sm font-semibold">
                                <a href="<?php echo esc_url(home_url('/become-a-partner')); ?>">Become A Partner</a>
                            </li>
                            <li class="py-2 text-sm font-semibold">
                                <a href="<?php echo esc_url(home_url('/about-us')); ?>">About Us</a>
                            </li>
                        
                        </ul>
                    <?php endif; ?>
                </div>
                <div class="grid grid-flow-col grid-cols-[max-content] justify-start gap-x-3 md:justify-end">
                    <?php if (get_theme_mod('social_facebook', '#')) : ?>
                        <a href="<?php echo esc_url(get_theme_mod('social_facebook', '#')); ?>" aria-label="Facebook">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-facebook"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                        </a>
                    <?php endif; ?>
                    
                    <?php if (get_theme_mod('social_instagram', '#')) : ?>
                        <a href="<?php echo esc_url(get_theme_mod('social_instagram', '#')); ?>" aria-label="Instagram">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-instagram"><rect width="20" height="20" x="2" y="2" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" x2="17.51" y1="6.5" y2="6.5"/></svg>
                        </a>
                    <?php endif; ?>
                    
                    <?php if (get_theme_mod('social_twitter', '#')) : ?>
                        <a href="<?php echo esc_url(get_theme_mod('social_twitter', '#')); ?>" aria-label="Twitter">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-twitter"><path d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z"/></svg>
                        </a>
                    <?php endif; ?>
                    
                    <?php if (get_theme_mod('social_linkedin', '#')) : ?>
                        <a href="<?php echo esc_url(get_theme_mod('social_linkedin', '#')); ?>" aria-label="LinkedIn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-linkedin"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/><rect width="4" height="12" x="2" y="9"/><circle cx="4" cy="4" r="2"/></svg>
                        </a>
                    <?php endif; ?>
                    
                    <?php if (get_theme_mod('social_youtube', '#')) : ?>
                        <a href="<?php echo esc_url(get_theme_mod('social_youtube', '#')); ?>" aria-label="YouTube">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-youtube"><path d="M2.5 17a24.12 24.12 0 0 1 0-10 2 2 0 0 1 1.4-1.4 49.56 49.56 0 0 1 16.2 0A2 2 0 0 1 21.5 7a24.12 24.12 0 0 1 0 10 2 2 0 0 1-1.4 1.4 49.55 49.55 0 0 1-16.2 0A2 2 0 0 1 2.5 17"/><path d="m10 15 5-3-5-3z"/></svg>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="flex justify-center pb-4 pt-6 text-sm md:pb-0 md:pt-8">
            <p><?php echo esc_html(get_theme_mod('copyright_text', '  ' . date('Y') . ' ' . get_bloginfo('name') . '. All rights reserved.')); ?></p>
        </div>
    </div>
</footer><!-- #colophon -->
