<?php
/**
 * Template part for displaying page content in page.php
 *
 * @package _ccg
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php if (have_rows('header_81')) : ?>
        <?php while (have_rows('header_81')) : the_row(); ?>
            <style>
                .scroll-section {
                    position: relative;
                }
                @media (min-width: 768px) {
                    .scroll-section {
                        height: 300vh;
                    }
                    .scroll-content {
                        position: sticky;
                        top: 0;
                        height: 100vh;
                    }
                }
                .image-container {
                    transition: width 0.6s cubic-bezier(0.34, 1.56, 0.64, 1);
                    will-change: width;
                }
                @media (max-width: 991px) {
                    .image-container {
                        width: 100% !important;
                    }
                }
            </style>

            <section id="header-scroll" class="scroll-section">
                <div class="scroll-content static top-0 grid auto-cols-fr grid-cols-1 items-center gap-y-16 pt-16 md:pt-24 lg:sticky lg:h-screen lg:grid-cols-2 lg:gap-y-0 lg:pt-0">
                    <div class="relative mx-[5%] max-w-md lg:ml-[5vw] lg:mr-20 lg:justify-self-end">
                        <h1 class="mb-5 text-4xl font-bold md:mb-6 md:text-5xl lg:text-6xl"><?php the_sub_field('header'); ?></h1>
                        <p class="md:text-md"><?php the_sub_field('content'); ?></p>
                        
                        <?php if (have_rows('buttons')) : ?>
                            <div class="mt-6 flex flex-wrap gap-4 md:mt-8">
                                <?php while (have_rows('buttons')) : the_row(); ?>
                                    <a href="<?php echo esc_url(get_sub_field('button_one_link')); ?>" 
                                       class="inline-flex items-center justify-center rounded-md bg-[#269763] px-6 py-3 text-center font-semibold text-white hover:bg-[#1c7049] focus:outline-none focus:ring-2 focus:ring-[#269763] focus:ring-offset-2">
                                        <?php the_sub_field('button_one_label'); ?>
                                    </a>
                                    <a href="<?php echo esc_url(get_sub_field('button_two_link')); ?>" 
                                       class="inline-flex items-center justify-center rounded-md border-2 border-[#269763] bg-transparent px-6 py-3 text-center font-semibold text-[#269763] hover:bg-[#269763] hover:text-white focus:outline-none focus:ring-2 focus:ring-[#269763] focus:ring-offset-2">
                                        <?php the_sub_field('button_two_label'); ?>
                                    </a>
                                <?php endwhile; ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="image-wrapper">
                        <?php $images = get_sub_field('images'); ?>
                        <?php if ($images) : ?>
                            <div class="image-container absolute inset-0 left-auto w-1/2">
                                <div class="relative size-full pt-[100%] lg:pt-0">
                                    <img src="<?php echo esc_url($images['url']); ?>" 
                                         alt="<?php echo esc_attr($images['alt']); ?>" 
                                         class="absolute inset-0 size-full object-cover" />
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </section>

            <script>
            document.addEventListener('DOMContentLoaded', function() {
                const section = document.getElementById('header-scroll');
                const imageContainer = section.querySelector('.image-container');
                let lastScrollY = window.scrollY;
                let rafId = null;

                function lerp(start, end, factor) {
                    return start + (end - start) * factor;
                }

                let currentWidth = 50;
                let targetWidth = 50;

                function updateImageWidth() {
                    if (!section || !imageContainer) return;

                    const sectionRect = section.getBoundingClientRect();
                    const scrollProgress = Math.max(0, Math.min(1, -sectionRect.top / (sectionRect.height - window.innerHeight)));
                    
                    // Only update on desktop
                    if (window.innerWidth > 991) {
                        targetWidth = 50 + (scrollProgress * 50);
                        currentWidth = lerp(currentWidth, targetWidth, 0.1);
                        
                        if (Math.abs(currentWidth - targetWidth) > 0.01) {
                            imageContainer.style.width = `${currentWidth}%`;
                            rafId = requestAnimationFrame(updateImageWidth);
                        } else {
                            imageContainer.style.width = `${targetWidth}%`;
                            rafId = null;
                        }
                    }
                }

                function onScroll() {
                    lastScrollY = window.scrollY;
                    if (!rafId) {
                        rafId = requestAnimationFrame(updateImageWidth);
                    }
                }

                window.addEventListener('scroll', onScroll, { passive: true });

                // Initial update
                updateImageWidth();

                // Cleanup
                return () => {
                    window.removeEventListener('scroll', onScroll);
                    if (rafId) {
                        cancelAnimationFrame(rafId);
                    }
                };
            });
            </script>
        <?php endwhile; ?>
    <?php endif; ?>

    <section id="tournaments" class="px-[5%] py-16 md:py-24 lg:py-28">
        <div class="container">
            

            <div class="grid grid-cols-1 gap-x-8 gap-y-12 md:grid-cols-2 md:gap-y-16 lg:grid-cols-3">
                <?php
                // First, let's do a simple query without date filtering
                $args = array(
                    'post_type' => 'tournament',
                    'posts_per_page' => -1,
                    'post_status' => 'publish',
                    'meta_query' => array(
                        array(
                            'key' => 'tournament_details_0_tournament_date', // ACF field key
                            'type' => 'DATE',
                            'compare' => 'EXISTS'
                        )
                    ),
                    'orderby' => 'meta_value',
                    'meta_key' => 'tournament_details_0_tournament_date',
                    'order' => 'ASC'
                );

                $tournaments = new WP_Query($args);

                // Debug query
                error_log('Tournament Query SQL: ' . $tournaments->request);

                // Debug output
                if (!$tournaments->have_posts()) {
                    echo '<div class="col-span-full text-center">';
                    echo '<p>No tournaments found. Total posts: ' . $tournaments->found_posts . '</p>';
                    
                    // Check if post type exists
                    $post_type = get_post_type_object('tournament');
                    if (!$post_type) {
                        echo '<p>Tournament post type not registered.</p>';
                    }
                    echo '</div>';
                }

                if ($tournaments->have_posts()) :
                    while ($tournaments->have_posts()) : $tournaments->the_post();
                        // Get tournament details
                        if (have_rows('tournament_details')) :
                            while (have_rows('tournament_details')) : the_row();
                                $tournament_date = get_sub_field('tournament_date', false); // Get raw value
                                $location = get_sub_field('location');
                                $golf_course_name = get_sub_field('golf_course_name');
                                $tournament_status = get_sub_field('tournament_status');
                                
                                // Debug date
                                error_log('Raw tournament date: ' . print_r($tournament_date, true));
                                
                                // Format date if it exists
                                $weekday = '';
                                $day = '';
                                $monthYear = '';
                                
                                if (!empty($tournament_date)) {
                                    // Convert to DateTime object
                                    if (is_numeric($tournament_date)) {
                                        // If it's a timestamp
                                        $date = new DateTime();
                                        $date->setTimestamp($tournament_date);
                                    } else {
                                        // Try different date formats
                                        $date = DateTime::createFromFormat('Ymd', $tournament_date); // ACF date picker format
                                        if (!$date) {
                                            $date = DateTime::createFromFormat('Y-m-d', $tournament_date);
                                        }
                                        if (!$date) {
                                            $date = DateTime::createFromFormat('d/m/Y', $tournament_date);
                                        }
                                    }
                                    
                                    if ($date) {
                                        $weekday = $date->format('D');
                                        $day = $date->format('d');
                                        $monthYear = $date->format('M Y');
                                        
                                        // Debug formatted date
                                        error_log('Formatted date - Weekday: ' . $weekday . ', Day: ' . $day . ', Month/Year: ' . $monthYear);
                                    } else {
                                        error_log('Failed to parse date: ' . $tournament_date);
                                    }
                                }
                                ?>

                                <div class="flex flex-col items-start">
                                    <div class="relative mb-5 block aspect-[3/2] w-full md:mb-6">
                                        <?php if ($weekday && $day && $monthYear) : ?>
                                            <div class="absolute right-4 top-4 z-20 flex min-w-[120px] flex-col items-center bg-white p-4">
                                                <span class="text-base font-medium text-[#141414]"><?php echo esc_html($weekday); ?></span>
                                                <span class="text-[56px] leading-[1] font-bold text-[#141414]"><?php echo esc_html($day); ?></span>
                                                <span class="text-base font-medium text-[#141414]"><?php echo esc_html($monthYear); ?></span>
                                            </div>
                                        <?php endif; ?>
                                        
                                        <a href="<?php echo esc_url(get_permalink()); ?>" class="relative block h-full">
                                            <?php if (have_rows('media')) : ?>
                                                <?php while (have_rows('media')) : the_row(); ?>
                                                    <?php if (get_sub_field('featured_image')) : ?>
                                                        <img src="<?php echo esc_url(get_sub_field('featured_image')['url']); ?>" 
                                                             alt="<?php echo esc_attr(get_sub_field('featured_image')['alt']); ?>" 
                                                             class="absolute size-full object-cover" />
                                                        <?php break; // Only show first image ?>
                                                    <?php endif; ?>
                                                <?php endwhile; ?>
                                            <?php elseif (has_post_thumbnail()) : ?>
                                                <?php the_post_thumbnail('large', array('class' => 'absolute size-full object-cover')); ?>
                                            <?php else: ?>
                                                <div class="absolute inset-0 bg-[#c3c3c3] size-full"></div>
                                            <?php endif; ?>
                                        </a>
                                    </div>

                                    <?php if ($tournament_status) : ?>
                                        <span class="mb-3 bg-[#269763] text-white px-2 py-1 text-sm font-semibold md:mb-4">
                                            <?php echo esc_html($tournament_status); ?>
                                        </span>
                                    <?php endif; ?>

                                    <a href="<?php echo esc_url(get_permalink()); ?>" class="transition-colors hover:text-[#269763]">
                                        <h2 class="text-xl font-bold md:text-2xl"><?php the_title(); ?></h2>
                                    </a>

                                    <?php if ($golf_course_name) : ?>
                                        <p class="mb-2"><?php echo esc_html($golf_course_name); ?></p>
                                    <?php endif; ?>
                                    
                                    <?php if (have_rows('additional_information')) : ?>
                                        <?php while (have_rows('additional_information')) : the_row(); ?>
                                            <?php 
                                            $rules = get_sub_field('rules_and_regulations');
                                            if ($rules) : 
                                            ?>
                                                <p><?php echo wp_trim_words($rules, 20); ?></p>
                                            <?php endif; ?>
                                        <?php endwhile; ?>
                                    <?php endif; ?>

                                    <div class="mt-5 md:mt-6 flex items-center gap-4">
                                        <a href="<?php echo esc_url(get_permalink()); ?>" 
                                           class="inline-flex items-center text-[#269763] hover:text-[#1a704a] transition-colors">
                                            View event
                                            <i data-lucide="chevron-right" class="ml-2 h-5 w-5"></i>
                                        </a>

                                        <?php
                                        // Default to showing register button if no registration info is set
                                        $show_register = true;
                                        $spots_available = null;

                                        if (have_rows('registration_info')) {
                                            while (have_rows('registration_info')) {
                                                the_row();
                                                $spots_available = get_sub_field('spots_available');
                                                // Only set to false if we explicitly know there are 0 spots
                                                if ($spots_available !== null && $spots_available <= 0) {
                                                    $show_register = false;
                                                }
                                            }
                                        }

                                        if ($show_register) : ?>
                                            <a href="<?php echo esc_url(get_permalink() . '#registration-section'); ?>" 
                                               class="inline-flex items-center justify-center rounded-md bg-[#269763] px-4 py-2 text-sm font-semibold text-white hover:bg-[#1a704a] transition-colors">
                                                Register Now
                                                <i data-lucide="arrow-right" class="ml-2 h-4 w-4"></i>
                                            </a>
                                        <?php else : ?>
                                            <span class="inline-flex items-center justify-center rounded-md bg-[#141414] px-4 py-2 text-sm font-semibold text-white">
                                                Sold Out
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>

                            <?php
                            endwhile;
                        endif;
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>
            </div>

            <?php if ($tournaments->found_posts > 6) : ?>
                <div class="mt-12 flex justify-center md:mt-18 lg:mt-20">
                    <a href="<?php echo get_post_type_archive_link('tournament'); ?>" 
                       class="inline-flex items-center justify-center px-6 py-3 border-2 border-[#269763] text-[#269763] hover:bg-[#269763] hover:text-white transition-colors rounded-md font-medium">
                        View all tournaments
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <?php if (have_rows('layout_12')) : ?>
        <?php while (have_rows('layout_12')) : the_row(); ?>
            <section class="px-[5%] py-16 md:py-24 lg:py-28">
                <div class="container mx-auto">
                    <div class="grid grid-cols-1 gap-y-12 md:grid-flow-row md:grid-cols-2 md:items-center md:gap-x-12 md:gap-y-8 lg:gap-x-20">
                        <div>
                            <?php if (get_sub_field('sub_header')) : ?>
                                <div class="mb-4 text-[#269763]"><?php the_sub_field('sub_header'); ?></div>
                            <?php endif; ?>
                            
                            <h2 class="mb-5 text-4xl font-bold leading-[1.2] md:mb-6 md:text-5xl lg:text-6xl">
                                <?php the_sub_field('header'); ?>
                            </h2>
                            <p class="mb-6 md:mb-8 md:text-md">
                                <?php the_sub_field('content'); ?>
                            </p>

                            <?php if (have_rows('cards')) : ?>
                                <div class="grid grid-cols-1 gap-6 py-2 sm:grid-cols-2">
                                    <?php while (have_rows('cards')) : the_row(); ?>
                                        <div>
                                            <div class="mb-3 md:mb-4">
                                                <?php 
                                                $icon = get_sub_field('icon');
                                                if ($icon) : ?>
                                                    <img src="<?php echo esc_url($icon['url']); ?>" 
                                                         alt="<?php echo esc_attr($icon['alt']); ?>" 
                                                         class="size-12" />
                                                <?php endif; ?>
                                            </div>
                                            <h6 class="mb-3 text-md font-bold leading-[1.4] md:mb-4 md:text-xl">
                                                <?php the_sub_field('title'); ?>
                                            </h6>
                                            <p><?php the_sub_field('content'); ?></p>
                                        </div>
                                    <?php endwhile; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div>
                            <?php 
                            $image = get_sub_field('image');
                            if ($image) : ?>
                                <img src="<?php echo esc_url($image['url']); ?>" 
                                     alt="<?php echo esc_attr($image['alt']); ?>" 
                                     class="w-full object-cover" />
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </section>
        <?php endwhile; ?>
    <?php endif; ?>

    <?php if (have_rows('cta_3')) : ?>
        <?php while (have_rows('cta_3')) : the_row(); ?>
            <section class="relative px-[5%] py-16 md:py-24 lg:py-28">
                <div class="container relative z-10 mx-auto">
                    <div class="grid w-full grid-cols-1 items-start justify-between gap-6 md:grid-cols-[1fr_max-content] md:gap-x-12 md:gap-y-8 lg:gap-x-20">
                        <div class="md:mr-12 lg:mr-0">
                            <div class="w-full max-w-lg">
                                <h2 class="mb-3 text-4xl font-bold leading-[1.2] text-white md:mb-4 md:text-5xl lg:text-6xl">
                                    <?php the_sub_field('title'); ?>
                                </h2>
                                <p class="text-white md:text-md">
                                    <?php the_sub_field('content'); ?>
                                </p>
                            </div>
                        </div>
                        <?php if (have_rows('buttons')) : ?>
                            <div class="flex items-start justify-start gap-4">
                                <?php while (have_rows('buttons')) : the_row(); ?>
                                    <a href="<?php echo esc_url(get_sub_field('button_one_link')); ?>" 
                                       class="inline-flex items-center justify-center rounded-md bg-white px-6 py-3 text-center font-semibold text-[#269763] hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2">
                                        <?php the_sub_field('button_one_label'); ?>
                                    </a>
                                    <a href="<?php echo esc_url(get_sub_field('button_two_link')); ?>" 
                                       class="inline-flex items-center justify-center rounded-md border-2 border-white bg-transparent px-6 py-3 text-center font-semibold text-white hover:bg-white hover:text-[#269763] focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2">
                                        <?php the_sub_field('button_two_label'); ?>
                                    </a>
                                <?php endwhile; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="absolute inset-0 z-0">
                    <?php $background_image = get_sub_field('image'); ?>
                    <?php if ($background_image) : ?>
                        <img src="<?php echo esc_url($background_image); ?>" 
                             alt="Background Image"
                             class="size-full object-cover" />
                    <?php endif; ?>
                    <div class="absolute inset-0 bg-black/50"></div>
                </div>
            </section>
        <?php endwhile; ?>
    <?php endif; ?>

</article>