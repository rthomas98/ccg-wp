<?php
/**
 * The template for displaying single tournament posts
 *
 * @package _ccg
 */

get_header();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <!-- Hero Section -->
    <section class="relative min-h-[80vh] bg-[#141414]">
        <?php if (have_rows('media')) : ?>
            <?php while (have_rows('media')) : the_row(); ?>
                <div class="absolute inset-0 z-0 after:absolute after:inset-0 after:bg-gradient-to-t after:from-black/80 after:to-black/20">
                    <?php $featured_image = get_sub_field('featured_image'); ?>
                    <?php if ($featured_image) : ?>
                        <img src="<?php echo esc_url($featured_image['url']); ?>" 
                             alt="<?php echo esc_attr($featured_image['alt']); ?>"
                             class="h-full w-full object-cover" />
                    <?php endif; ?>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>
        
        <div class="relative z-10 flex min-h-[80vh] items-end px-[5%] pb-16 pt-32 md:pb-24 lg:pb-28">
            <div class="container mx-auto">
                <div class="max-w-3xl">
                    <?php if (have_rows('tournament_details')) : ?>
                        <?php while (have_rows('tournament_details')) : the_row(); ?>
                            <?php if (get_sub_field('tournament_status')) : ?>
                                <span class="mb-6 inline-block rounded-full bg-[#269763] px-4 py-2 text-sm font-semibold uppercase tracking-wider text-white shadow-lg">
                                    <?php echo esc_html(get_sub_field('tournament_status')); ?>
                                </span>
                            <?php endif; ?>

                            <h1 class="mb-8 text-5xl font-bold text-white md:text-6xl lg:text-7xl">
                                <?php the_title(); ?>
                            </h1>

                            <div class="flex flex-wrap items-center gap-8 text-lg text-white/90">
                                <?php 
                                // Format tournament date if it exists
                                $tournament_date = get_sub_field('tournament_date');
                                $formatted_date = '';
                                
                                if (!empty($tournament_date)) {
                                    if (is_string($tournament_date)) {
                                        // Try different date formats
                                        $date_obj = DateTime::createFromFormat('Ymd', $tournament_date);
                                        if (!$date_obj) {
                                            $date_obj = DateTime::createFromFormat('Y-m-d', $tournament_date);
                                        }
                                        if ($date_obj) {
                                            $formatted_date = $date_obj->format('F j, Y');
                                        } else {
                                            $formatted_date = $tournament_date;
                                        }
                                    }
                                }
                                ?>
                                
                                <?php if ($formatted_date) : ?>
                                    <div class="flex items-center gap-3">
                                        <i data-lucide="calendar" class="h-6 w-6 text-[#269763]"></i>
                                        <span class="font-medium"><?php echo esc_html($formatted_date); ?></span>
                                    </div>
                                <?php endif; ?>

                                <?php if (get_sub_field('location')) : ?>
                                    <div class="flex items-center gap-3">
                                        <i data-lucide="map-pin" class="h-6 w-6 text-[#269763]"></i>
                                        <span class="font-medium"><?php echo esc_html(get_sub_field('location')); ?></span>
                                    </div>
                                <?php endif; ?>

                                <?php if (get_sub_field('golf_course_name')) : ?>
                                    <div class="flex items-center gap-3">
                                        <i data-lucide="flag" class="h-6 w-6 text-[#269763]"></i>
                                        <span class="font-medium"><?php echo esc_html(get_sub_field('golf_course_name')); ?></span>
                                    </div>
                                <?php endif; ?>
                                
                                <?php 
                                // Format registration deadline if it exists
                                $reg_deadline = get_sub_field('registration_deadline');
                                $formatted_reg_deadline = '';
                                
                                if (!empty($reg_deadline)) {
                                    if (is_string($reg_deadline)) {
                                        // Try different date formats
                                        $date_obj = DateTime::createFromFormat('Ymd', $reg_deadline);
                                        if (!$date_obj) {
                                            $date_obj = DateTime::createFromFormat('Y-m-d', $reg_deadline);
                                        }
                                        if ($date_obj) {
                                            $formatted_reg_deadline = $date_obj->format('F j, Y');
                                        } else {
                                            $formatted_reg_deadline = $reg_deadline;
                                        }
                                    }
                                }
                                ?>
                                
                                <?php if ($formatted_reg_deadline) : ?>
                                    <div class="flex items-center gap-3">
                                        <i data-lucide="clock" class="h-6 w-6 text-[#269763]"></i>
                                        <span class="font-medium">Register by: <?php echo esc_html($formatted_reg_deadline); ?></span>
                                    </div>
                                <?php endif; ?>
                            </div>
                            
                            <?php if (get_sub_field('golf_course_address')) : ?>
                                <?php 
                                $address = get_sub_field('golf_course_address');
                                $google_maps_url = 'https://www.google.com/maps/search/?api=1&query=' . urlencode($address);
                                ?>
                                <div class="mt-6 flex items-start gap-3 text-lg text-white/80">
                                    <i data-lucide="map" class="mt-1 h-6 w-6 text-[#269763]"></i>
                                    <a href="<?php echo esc_url($google_maps_url); ?>" target="_blank" rel="noopener noreferrer" class="hover:text-white">
                                        <span><?php echo nl2br(esc_html($address)); ?></span>
                                    </a>
                                </div>
                            <?php endif; ?>
                        <?php endwhile; ?>
                    <?php endif; ?>
                    
                    <?php if (have_rows('registration_info')) : ?>
                        <?php while (have_rows('registration_info')) : the_row(); ?>
                            <?php if (get_sub_field('payment_link')) : ?>
                                <div class="mt-8">
                                    <button 
                                       onclick="document.getElementById('registration-section').scrollIntoView({ behavior: 'smooth' });"
                                       class="inline-flex items-center justify-center rounded-md bg-[#269763] px-6 py-3 text-center font-semibold text-white hover:bg-[#269763]/90 focus:outline-none focus:ring-2 focus:ring-[#269763] focus:ring-offset-2">
                                        Register Now
                                        <i data-lucide="arrow-right" class="ml-2 h-5 w-5"></i>
                                    </button>
                                </div>
                            <?php endif; ?>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Header 81 Section -->
    <?php if (have_rows('header_81')) : ?>
        <?php while (have_rows('header_81')) : the_row(); ?>
            <section class="bg-white px-[5%] py-16 md:py-24">
                <div class="container mx-auto">
                    <div class="mx-auto max-w-4xl text-center">
                        <?php if (get_sub_field('header')) : ?>
                            <h2 class="mb-6 text-4xl font-bold md:text-5xl lg:text-6xl">
                                <?php echo esc_html(get_sub_field('header')); ?>
                            </h2>
                        <?php endif; ?>

                        <?php if (get_sub_field('content')) : ?>
                            <div class="prose prose-lg mx-auto mb-8 max-w-none text-gray-600">
                                <?php echo wp_kses_post(get_sub_field('content')); ?>
                            </div>
                        <?php endif; ?>

                        <?php if (have_rows('buttons')) : ?>
                            <?php while (have_rows('buttons')) : the_row(); ?>
                                <div class="flex flex-wrap items-center justify-center gap-4">
                                    <?php
                                    $button_one_label = get_sub_field('button_one_label');
                                    $button_one_link = get_sub_field('button_one_link');
                                    if ($button_one_label && $button_one_link) :
                                    ?>
                                        <a href="<?php echo esc_url($button_one_link); ?>"
                                           class="inline-flex items-center justify-center rounded-md bg-[#269763] px-6 py-3 text-center font-semibold text-white hover:bg-[#269763]/90 focus:outline-none focus:ring-2 focus:ring-[#269763] focus:ring-offset-2">
                                            <?php echo esc_html($button_one_label); ?>
                                        </a>
                                    <?php endif; ?>

                                    <?php
                                    $button_two_label = get_sub_field('button_two_label');
                                    $button_two_link = get_sub_field('button_two_link');
                                    if ($button_two_label && $button_two_link) :
                                    ?>
                                        <a href="<?php echo esc_url($button_two_link); ?>"
                                           class="inline-flex items-center justify-center rounded-md border border-gray-300 bg-white px-6 py-3 text-center font-semibold text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-[#269763] focus:ring-offset-2">
                                            <?php echo esc_html($button_two_label); ?>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </div>

                    <?php
                    $images = get_sub_field('images');
                    if ($images && is_array($images) && count($images) > 0) :
                    ?>
                        <div class="mt-12 grid grid-cols-2 gap-6 md:grid-cols-3 lg:grid-cols-4">
                            <?php foreach ($images as $image) : ?>
                                <div class="overflow-hidden rounded-lg shadow-md transition-transform hover:scale-105">
                                    <img src="<?php echo esc_url($image['sizes']['medium']); ?>"
                                         alt="<?php echo esc_attr($image['alt']); ?>"
                                         class="aspect-square h-full w-full object-cover" />
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </section>
        <?php endwhile; ?>
    <?php endif; ?>

    <!-- Event 7 Section -->
    <?php if (have_rows('event_7')) : ?>
        <?php while (have_rows('event_7')) : the_row(); ?>
            <section class="bg-gray-50 px-[5%] py-16 md:py-24">
                <div class="container mx-auto">
                    <div class="mx-auto max-w-4xl text-center">
                        <?php if (get_sub_field('sub_header')) : ?>
                            <span class="mb-4 inline-block rounded-full bg-[#269763]/10 px-4 py-2 text-sm font-semibold uppercase tracking-wider text-[#269763]">
                                <?php echo esc_html(get_sub_field('sub_header')); ?>
                            </span>
                        <?php endif; ?>

                        <?php if (get_sub_field('header')) : ?>
                            <h2 class="mb-6 text-4xl font-bold md:text-5xl lg:text-6xl">
                                <?php echo esc_html(get_sub_field('header')); ?>
                            </h2>
                        <?php endif; ?>

                        <?php if (get_sub_field('content')) : ?>
                            <div class="prose prose-lg mx-auto max-w-none text-gray-600">
                                <?php echo wp_kses_post(get_sub_field('content')); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </section>
        <?php endwhile; ?>
    <?php endif; ?>

    <!-- Tournament Info Cards -->
    <section class="bg-white px-[5%] py-16 md:py-24">
        <div class="container mx-auto">
            <?php if (get_field('introduction_')) : ?>
            <div class="mb-8 w-full">
                <div class="rounded-xl border border-gray-100 bg-gray-50 p-8 transition-transform hover:shadow-md w-full">
                    <div class="mb-4 inline-flex rounded-lg bg-[#269763]/10 p-3">
                        <i data-lucide="file-text" class="h-6 w-6 text-[#269763]"></i>
                    </div>
                    <h3 class="mb-3 text-xl font-bold">Introduction</h3>
                    <div class="prose max-w-none text-gray-600">
                        <?php echo wp_kses_post(get_field('introduction_')); ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <div class="grid grid-cols-1 gap-8 md:grid-cols-2">
                <?php if (have_rows('tournament_details')) : ?>
                    <?php while (have_rows('tournament_details')) : the_row(); ?>
                        <div class="rounded-xl border border-gray-100 bg-gray-50 p-8 transition-transform hover:shadow-md w-full">
                            <div class="mb-4 inline-flex rounded-lg bg-[#269763]/10 p-3">
                                <i data-lucide="info" class="h-6 w-6 text-[#269763]"></i>
                            </div>
                            <h3 class="mb-3 text-xl font-bold">Tournament Details</h3>
                            <ul class="space-y-2 text-gray-600">
                                <?php if (get_sub_field('tournament_date')) : ?>
                                    <li class="flex items-start gap-2">
                                        <i data-lucide="calendar" class="mt-1 h-4 w-4 text-[#269763]"></i>
                                        <span><?php echo esc_html(get_sub_field('tournament_date')); ?></span>
                                    </li>
                                <?php endif; ?>
                                <?php if (get_sub_field('registration_deadline')) : ?>
                                    <li class="flex items-start gap-2">
                                        <i data-lucide="calendar-clock" class="mt-1 h-4 w-4 text-[#269763]"></i>
                                        <span>Deadline: <?php echo esc_html(get_sub_field('registration_deadline')); ?></span>
                                    </li>
                                <?php endif; ?>
                                <?php if (get_sub_field('golf_course_name')) : ?>
                                    <li class="flex items-start gap-2">
                                        <i data-lucide="flag" class="mt-1 h-4 w-4 text-[#269763]"></i>
                                        <span><?php echo esc_html(get_sub_field('golf_course_name')); ?></span>
                                    </li>
                                <?php endif; ?>
                                <?php if (get_sub_field('location')) : ?>
                                    <li class="flex items-start gap-2">
                                        <i data-lucide="map-pin" class="mt-1 h-4 w-4 text-[#269763]"></i>
                                        <span><?php echo esc_html(get_sub_field('location')); ?></span>
                                    </li>
                                <?php endif; ?>
                                <?php if (get_sub_field('golf_course_address')) : ?>
                                    <li class="flex items-start gap-2">
                                        <i data-lucide="map" class="mt-1 h-4 w-4 text-[#269763]"></i>
                                        <span><?php echo esc_html(get_sub_field('golf_course_address')); ?></span>
                                    </li>
                                <?php endif; ?>
                                <?php if (get_sub_field('tournament_status')) : ?>
                                    <li class="flex items-start gap-2">
                                        <i data-lucide="activity" class="mt-1 h-4 w-4 text-[#269763]"></i>
                                        <span>Status: <?php echo esc_html(get_sub_field('tournament_status')); ?></span>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
                
                <?php if (have_rows('registration_info')) : ?>
                    <?php while (have_rows('registration_info')) : the_row(); ?>
                        <div class="rounded-xl border border-gray-100 bg-gray-50 p-8 transition-transform hover:shadow-md w-full">
                            <div class="mb-4 inline-flex rounded-lg bg-[#269763]/10 p-3">
                                <i data-lucide="credit-card" class="h-6 w-6 text-[#269763]"></i>
                            </div>
                            <h3 class="mb-3 text-xl font-bold">Registration</h3>
                            <ul class="space-y-2 text-gray-600">
                                <?php if (get_sub_field('entry_fee')) : ?>
                                    <li class="flex items-start gap-2">
                                        <i data-lucide="dollar-sign" class="mt-1 h-4 w-4 text-[#269763]"></i>
                                        <span>Entry Fee: $<?php echo esc_html(get_sub_field('entry_fee')); ?></span>
                                    </li>
                                <?php endif; ?>
                                <?php 
                                // Format early bird deadline if it exists
                                $early_bird = get_sub_field('early_bird_deadline');
                                $formatted_early_bird = '';
                                
                                if (!empty($early_bird)) {
                                    if (is_string($early_bird)) {
                                        // Try different date formats
                                        $date_obj = DateTime::createFromFormat('Ymd', $early_bird);
                                        if (!$date_obj) {
                                            $date_obj = DateTime::createFromFormat('Y-m-d', $early_bird);
                                        }
                                        if ($date_obj) {
                                            $formatted_early_bird = $date_obj->format('F j, Y');
                                        } else {
                                            $formatted_early_bird = $early_bird;
                                        }
                                    }
                                }
                                ?>
                                <?php if ($formatted_early_bird) : ?>
                                    <li class="flex items-start gap-2">
                                        <i data-lucide="calendar-clock" class="mt-1 h-4 w-4 text-[#269763]"></i>
                                        <span>Early Bird: <?php echo esc_html($formatted_early_bird); ?></span>
                                    </li>
                                <?php endif; ?>

                                <?php
                                // Display What's Included as a repeater field
                                if (have_rows('registration_info_whats_included')) :
                                ?>
                                    <li class="mt-4 pt-4 border-t border-gray-200">
                                        <h4 class="font-semibold mb-3 text-gray-900">What's Included:</h4>
                                        <ul class="space-y-2">
                                            <?php while (have_rows('registration_info_whats_included')) : the_row(); ?>
                                                <?php if (get_sub_field('item')) : ?>
                                                    <li class="flex items-start gap-2">
                                                        <i data-lucide="check-circle" class="mt-0.5 h-5 w-5 flex-shrink-0 text-[#269763]"></i>
                                                        <span class="text-gray-700"><?php echo esc_html(get_sub_field('item')); ?></span>
                                                    </li>
                                                <?php endif; ?>
                                            <?php endwhile; ?>
                                        </ul>
                                    </li>
                                <?php endif; ?>

                                <?php if (get_sub_field('payment_link')) : ?>
                                    <li class="flex items-start gap-2 mt-6 pt-4 border-t border-gray-200">
                                        <a href="<?php echo esc_url(get_sub_field('payment_link')); ?>" class="inline-flex items-center gap-2 rounded-lg bg-[#269763] px-4 py-2 text-sm font-semibold text-white transition hover:bg-[#269763]/90" target="_blank" rel="noopener noreferrer">
                                            <i data-lucide="credit-card" class="h-4 w-4"></i>
                                            Make Payment
                                        </a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
                
                <?php if (have_rows('tournament_schedule')) : ?>
                    <?php while (have_rows('tournament_schedule')) : the_row(); ?>
                        <div class="rounded-xl border border-gray-100 bg-gray-50 p-8 transition-transform hover:shadow-md w-full">
                            <div class="mb-4 inline-flex rounded-lg bg-[#269763]/10 p-3">
                                <i data-lucide="clock" class="h-6 w-6 text-[#269763]"></i>
                            </div>
                            <h3 class="mb-3 text-xl font-bold">Schedule</h3>
                            <ul class="space-y-2 text-gray-600">
                                <?php if (get_sub_field('check-in_time')) : ?>
                                    <li class="flex items-start gap-2">
                                        <i data-lucide="user-check" class="mt-1 h-4 w-4 text-[#269763]"></i>
                                        <span>Check-in: <?php echo esc_html(get_sub_field('check-in_time')); ?></span>
                                    </li>
                                <?php endif; ?>
                                <?php if (get_sub_field('start_time')) : ?>
                                    <li class="flex items-start gap-2">
                                        <i data-lucide="play" class="mt-1 h-4 w-4 text-[#269763]"></i>
                                        <span>Start: <?php echo esc_html(get_sub_field('start_time')); ?></span>
                                    </li>
                                <?php endif; ?>
                                <?php if (get_sub_field('format')) : ?>
                                    <li class="flex items-start gap-2">
                                        <i data-lucide="layout-grid" class="mt-1 h-4 w-4 text-[#269763]"></i>
                                        <span>Format: <?php echo esc_html(get_sub_field('format')); ?></span>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
                

            </div>
        </div>
    </section>

    <!-- Layout 12 Section -->
    <?php if (have_rows('layout_12')) : ?>
        <?php while (have_rows('layout_12')) : the_row(); ?>
            <section class="bg-white px-[5%] py-16 md:py-24">
                <div class="container mx-auto">
                    <div class="mb-12 text-center">
                        <?php if (get_sub_field('sub_header')) : ?>
                            <span class="mb-4 inline-block rounded-full bg-[#269763]/10 px-4 py-2 text-sm font-semibold uppercase tracking-wider text-[#269763]">
                                <?php echo esc_html(get_sub_field('sub_header')); ?>
                            </span>
                        <?php endif; ?>

                        <?php if (get_sub_field('header')) : ?>
                            <h2 class="mb-6 text-4xl font-bold md:text-5xl lg:text-6xl">
                                <?php echo esc_html(get_sub_field('header')); ?>
                            </h2>
                        <?php endif; ?>

                        <?php if (get_sub_field('content')) : ?>
                            <p class="mx-auto max-w-3xl text-lg text-gray-600">
                                <?php echo esc_html(get_sub_field('content')); ?>
                            </p>
                        <?php endif; ?>
                    </div>

                    <?php if (have_rows('cards')) : ?>
                        <div class="mb-12 grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                            <?php while (have_rows('cards')) : the_row(); ?>
                                <div class="rounded-xl border border-gray-100 bg-gray-50 p-8 transition-transform hover:shadow-md">
                                    <?php if (get_sub_field('icon')) : ?>
                                        <div class="mb-4 inline-flex rounded-lg bg-[#269763]/10 p-3">
                                            <i data-lucide="<?php echo esc_attr(get_sub_field('icon')); ?>" class="h-6 w-6 text-[#269763]"></i>
                                        </div>
                                    <?php endif; ?>

                                    <?php if (get_sub_field('title')) : ?>
                                        <h3 class="mb-3 text-xl font-bold">
                                            <?php echo esc_html(get_sub_field('title')); ?>
                                        </h3>
                                    <?php endif; ?>

                                    <?php if (get_sub_field('content')) : ?>
                                        <p class="text-gray-600">
                                            <?php echo esc_html(get_sub_field('content')); ?>
                                        </p>
                                    <?php endif; ?>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    <?php endif; ?>

                    <?php
                    $image = get_sub_field('image');
                    if ($image) :
                    ?>
                        <div class="overflow-hidden rounded-xl shadow-lg">
                            <img src="<?php echo esc_url($image['url']); ?>"
                                 alt="<?php echo esc_attr($image['alt']); ?>"
                                 class="h-auto w-full object-cover" />
                        </div>
                    <?php endif; ?>
                </div>
            </section>
        <?php endwhile; ?>
    <?php endif; ?>

    <?php
    // Check if tournament schedule has data before displaying the section
    $has_schedule_data = false;
    if (have_rows('tournament_schedule')) {
        while (have_rows('tournament_schedule')) {
            the_row();
            if (get_sub_field('check-in_time') || get_sub_field('start_time') || get_sub_field('format')) {
                $has_schedule_data = true;
                break;
            }
        }
        reset_rows(); // Reset the loop for later use
    }
    
    if ($has_schedule_data) : 
    ?>
        <section class="bg-gray-50 px-[5%] py-16 md:py-24">
            <div class="container mx-auto">
                <h2 class="mb-12 text-center text-4xl font-bold md:text-5xl lg:text-6xl">Tournament Schedule</h2>
                <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
                    <?php while (have_rows('tournament_schedule')) : the_row(); ?>
                        <?php if (get_sub_field('check-in_time')) : ?>
                            <div class="rounded-xl border border-gray-100 bg-white p-8 transition-transform hover:scale-105">
                                <div class="mb-4 inline-flex rounded-lg bg-[#269763]/10 p-3">
                                    <i data-lucide="clock" class="h-6 w-6 text-[#269763]"></i>
                                </div>
                                <h3 class="mb-3 text-xl font-bold">Check-in Time</h3>
                                <p class="text-lg text-gray-600"><?php echo esc_html(get_sub_field('check-in_time')); ?></p>
                            </div>
                        <?php endif; ?>
                        
                        <?php if (get_sub_field('start_time')) : ?>
                            <div class="rounded-xl border border-gray-100 bg-white p-8 transition-transform hover:scale-105">
                                <div class="mb-4 inline-flex rounded-lg bg-[#269763]/10 p-3">
                                    <i data-lucide="play" class="h-6 w-6 text-[#269763]"></i>
                                </div>
                                <h3 class="mb-3 text-xl font-bold">Start Time</h3>
                                <p class="text-lg text-gray-600"><?php echo esc_html(get_sub_field('start_time')); ?></p>
                            </div>
                        <?php endif; ?>
                        
                        <?php if (get_sub_field('format')) : ?>
                            <div class="rounded-xl border border-gray-100 bg-white p-8 transition-transform hover:scale-105">
                                <div class="mb-4 inline-flex rounded-lg bg-[#269763]/10 p-3">
                                    <i data-lucide="layout-grid" class="h-6 w-6 text-[#269763]"></i>
                                </div>
                                <h3 class="mb-3 text-xl font-bold">Format</h3>
                                <p class="text-lg text-gray-600"><?php echo esc_html(get_sub_field('format')); ?></p>
                            </div>
                        <?php endif; ?>
                    <?php endwhile; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <?php 
    // Check if tournament results has actual data
    $has_results = false;
    if (have_rows('tournament_results')) {
        while (have_rows('tournament_results')) {
            the_row();
            if (get_sub_field('tournament_recap')) {
                $has_results = true;
                break;
            }
            
            $final_leaderboard = get_sub_field('final_leaderboard');
            if ($final_leaderboard) {
                $has_results = true;
                break;
            }
            
            // Check winners
            if (have_rows('winners')) {
                while (have_rows('winners')) {
                    the_row();
                    if (get_sub_field('category') || get_sub_field('player_name') || 
                        get_sub_field('scoreresult') || get_sub_field('prize_won')) {
                        $has_results = true;
                        break 2;
                    }
                }
            }
        }
        reset_rows();
    }
    
    if ($has_results) : 
    ?>
        <section class="bg-gray-50 px-[5%] py-16 md:py-24">
            <div class="container mx-auto">
                <div class="mb-12 text-center">
                    <h2 class="mb-4 text-4xl font-bold md:text-5xl lg:text-6xl">Tournament Results</h2>
                    <p class="text-gray-600">Congratulations to all our winners!</p>
                </div>
                
                <?php while (have_rows('tournament_results')) : the_row(); ?>
                    <?php 
                    // Check if winners repeater has items with content
                    $has_winners = false;
                    if (have_rows('winners')) {
                        while (have_rows('winners')) {
                            the_row();
                            if (get_sub_field('category') || get_sub_field('player_name') || 
                                get_sub_field('scoreresult') || get_sub_field('prize_won')) {
                                $has_winners = true;
                                break;
                            }
                        }
                        reset_rows(); // Reset for the actual loop
                    }
                    
                    if ($has_winners) : 
                    ?>
                        <div class="mb-16 grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                            <?php while (have_rows('winners')) : the_row(); ?>
                                <?php 
                                // Only show winner if it has at least one piece of data
                                if (get_sub_field('category') || get_sub_field('player_name') || 
                                    get_sub_field('scoreresult') || get_sub_field('prize_won')) : 
                                ?>
                                    <div class="rounded-xl border border-gray-100 bg-white p-8 shadow-md transition-transform hover:scale-105">
                                        <div class="mb-6 inline-flex rounded-lg bg-[#269763]/10 p-3">
                                            <i data-lucide="trophy" class="h-6 w-6 text-[#269763]"></i>
                                        </div>
                                        <?php if (get_sub_field('category')) : ?>
                                            <h3 class="mb-4 text-2xl font-bold"><?php echo esc_html(get_sub_field('category')); ?></h3>
                                        <?php endif; ?>
                                        <div class="space-y-3">
                                            <?php if (get_sub_field('player_name')) : ?>
                                                <div class="flex items-center gap-2">
                                                    <i data-lucide="user" class="h-5 w-5 text-gray-400"></i>
                                                    <p><span class="font-medium">Winner:</span> <?php echo esc_html(get_sub_field('player_name')); ?></p>
                                                </div>
                                            <?php endif; ?>
                                            <?php if (get_sub_field('scoreresult')) : ?>
                                                <div class="flex items-center gap-2">
                                                    <i data-lucide="target" class="h-5 w-5 text-gray-400"></i>
                                                    <p><span class="font-medium">Score:</span> <?php echo esc_html(get_sub_field('scoreresult')); ?></p>
                                                </div>
                                            <?php endif; ?>
                                            <?php if (get_sub_field('prize_won')) : ?>
                                                <div class="flex items-center gap-2">
                                                    <i data-lucide="award" class="h-5 w-5 text-gray-400"></i>
                                                    <p><span class="font-medium">Prize:</span> <?php echo esc_html(get_sub_field('prize_won')); ?></p>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endwhile; ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if (get_sub_field('tournament_recap')) : ?>
                        <div class="mb-12 rounded-xl border border-gray-100 bg-white p-8 shadow-sm">
                            <h3 class="mb-6 text-2xl font-bold">Tournament Recap</h3>
                            <div class="prose max-w-none">
                                <?php echo wp_kses_post(get_sub_field('tournament_recap')); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    
                    <?php $final_leaderboard = get_sub_field('final_leaderboard'); ?>
                    <?php if ($final_leaderboard) : ?>
                        <div class="text-center">
                            <a href="<?php echo esc_url($final_leaderboard['url']); ?>" 
                               class="inline-flex items-center gap-2 rounded-md bg-[#269763] px-6 py-3 text-white transition-colors hover:bg-[#269763]/90">
                                <i data-lucide="list-ordered" class="h-5 w-5"></i>
                                <span>View Final Leaderboard: <?php echo esc_html($final_leaderboard['filename']); ?></span>
                            </a>
                        </div>
                    <?php endif; ?>
                <?php endwhile; ?>
            </div>
        </section>
    <?php endif; ?>





    <!-- Additional Information Section -->
    <?php if (have_rows('additional_information')) : ?>
        <section class="bg-white px-[5%] py-16 md:py-24">
            <div class="container mx-auto">
                <div class="mb-12 text-center">
                    <h2 class="text-4xl font-bold md:text-5xl lg:text-6xl">Additional Information</h2>
                </div>
                
                <div class="grid grid-cols-1 gap-12 lg:grid-cols-2">
                    <?php while (have_rows('additional_information')) : the_row(); ?>
                        <?php if (get_sub_field('rules_and_regulations')) : ?>
                            <div class="rounded-xl border border-gray-100 bg-gray-50 p-8">
                                <h3 class="mb-6 text-2xl font-bold">Rules & Regulations</h3>
                                <div class="prose max-w-none">
                                    <?php echo wp_kses_post(get_sub_field('rules_and_regulations')); ?>
                                </div>
                            </div>
                        <?php endif; ?>
                        
                        <?php if (have_rows('what_to_bring')) : ?>
                            <div class="rounded-xl border border-gray-100 bg-gray-50 p-8">
                                <h3 class="mb-6 text-2xl font-bold">What to Bring</h3>
                                <ul class="space-y-4">
                                    <?php while (have_rows('what_to_bring')) : the_row(); ?>
                                        <?php if (get_sub_field('item')) : ?>
                                            <li class="flex items-start gap-3">
                                                <i data-lucide="check-circle" class="mt-1 h-5 w-5 flex-shrink-0 text-[#269763]"></i>
                                                <div>
                                                    <p class="font-medium"><?php echo esc_html(get_sub_field('item')); ?></p>
                                                    <?php if (get_sub_field('required_or_optional')) : ?>
                                                        <span class="text-sm text-gray-500">
                                                            <?php echo esc_html(get_sub_field('required_or_optional')); ?>
                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </li>
                                        <?php endif; ?>
                                    <?php endwhile; ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                        
                        <?php if (get_sub_field('weather_policy')) : ?>
                            <div class="rounded-xl border border-gray-100 bg-gray-50 p-8">
                                <h3 class="mb-6 text-2xl font-bold">Weather Policy</h3>
                                <div class="prose max-w-none">
                                    <?php echo wp_kses_post(get_sub_field('weather_policy')); ?>
                                </div>
                            </div>
                        <?php endif; ?>
                        
                        <?php if (get_sub_field('cancellation_policy')) : ?>
                            <div class="rounded-xl border border-gray-100 bg-gray-50 p-8">
                                <h3 class="mb-6 text-2xl font-bold">Cancellation Policy</h3>
                                <div class="prose max-w-none">
                                    <?php echo wp_kses_post(get_sub_field('cancellation_policy')); ?>
                                </div>
                            </div>
                        <?php endif; ?>
                        
                        <?php if (have_rows('contact_information')) : ?>
                            <div class="rounded-xl border border-gray-100 bg-gray-50 p-8 lg:col-span-2">
                                <h3 class="mb-6 text-2xl font-bold">Contact Information</h3>
                                <div class="space-y-4">
                                    <?php while (have_rows('contact_information')) : the_row(); ?>
                                        <?php if (get_sub_field('contact_name')) : ?>
                                            <div class="flex items-center gap-3">
                                                <i data-lucide="user" class="h-5 w-5 text-[#269763]"></i>
                                                <p><?php echo esc_html(get_sub_field('contact_name')); ?></p>
                                            </div>
                                        <?php endif; ?>
                                        
                                        <?php if (get_sub_field('contact_email')) : ?>
                                            <div class="flex items-center gap-3">
                                                <i data-lucide="mail" class="h-5 w-5 text-[#269763]"></i>
                                                <a href="mailto:<?php echo esc_attr(get_sub_field('contact_email')); ?>" class="text-[#269763] hover:underline">
                                                    <?php echo esc_html(get_sub_field('contact_email')); ?>
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                        
                                        <?php if (get_sub_field('contact_phone')) : ?>
                                            <div class="flex items-center gap-3">
                                                <i data-lucide="phone" class="h-5 w-5 text-[#269763]"></i>
                                                <a href="tel:<?php echo esc_attr(get_sub_field('contact_phone')); ?>" class="text-[#269763] hover:underline">
                                                    <?php echo esc_html(get_sub_field('contact_phone')); ?>
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                    <?php endwhile; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endwhile; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <!-- Registration Section -->
    <?php
    $has_payment_link = false;
    $payment_link = '';
    if (have_rows('registration_info')) {
        while (have_rows('registration_info')) {
            the_row();
            if (get_sub_field('payment_link')) {
                $has_payment_link = true;
                $payment_link = get_sub_field('payment_link');
                break;
            }
        }
        reset_rows(); // Reset the loop for later use
    }

    if ($has_payment_link) :
    ?>
    <section id="registration-section" class="bg-gray-50 py-16 md:py-24">
        <div class="container mx-auto px-4">
            <div class="mx-auto max-w-3xl text-center">
                <h2 class="mb-6 text-4xl font-bold md:text-5xl lg:text-6xl">Register Now</h2>
                <p class="mb-12 text-lg text-gray-600">Complete the form below to register for this tournament.</p>
            </div>
            
            <div class="mx-auto max-w-3xl">
                <!-- Hidden field for payment link -->
                <div id="payment_link_container" style="display: none;" data-payment-link="<?php echo esc_url($payment_link); ?>"></div>
                
                <?php echo do_shortcode('[fluentform id="6"]'); ?>
                
                <script>
                document.addEventListener('DOMContentLoaded', function() {
                    // Get the payment link from the hidden container
                    const paymentLink = document.getElementById('payment_link_container').getAttribute('data-payment-link');
                    
                    if (window.jQuery && paymentLink) {
                        // Method 1: Using Fluent Forms' success event
                        jQuery(document).on('fluentform_submission_success', function(event, data) {
                            if (data.form_id === '6') {
                                setTimeout(function() {
                                    window.open(paymentLink, '_blank');
                                }, 1500);
                            }
                        });
                        
                        // Method 2: Watch for success message appearance as backup
                        const observer = new MutationObserver(function(mutations) {
                            mutations.forEach(function(mutation) {
                                if (mutation.type === 'childList' && mutation.addedNodes.length > 0) {
                                    // Look for success message in the form
                                    const successMessage = document.querySelector('.ff-message-success');
                                    if (successMessage) {
                                        setTimeout(function() {
                                            window.open(paymentLink, '_blank');
                                        }, 1500);
                                        observer.disconnect(); // Stop observing once we've found the success message
                                    }
                                }
                            });
                        });
                        
                        // Start observing the form container for changes
                        const formContainer = document.querySelector('.fluentform');
                        if (formContainer) {
                            observer.observe(formContainer, { childList: true, subtree: true });
                        }
                    }
                });
                </script>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- Tournament Description -->
    <?php
    // Check if any content exists for this section
    $has_tournament_content = !empty(get_the_content());

    $has_features_check = false;
    if (have_rows('tournament_features')) {
        while (have_rows('tournament_features')) {
            the_row();
            if (get_sub_field('feature_title') || get_sub_field('feature_description')) {
                $has_features_check = true;
                break;
            }
        }
        reset_rows();
    }

    $has_additional_check = false;
    if (have_rows('additional_information')) {
        while (have_rows('additional_information')) {
            the_row();
            if (get_sub_field('rules') || get_sub_field('prizes') || get_sub_field('faq') || get_sub_field('cancellation_policy')) {
                $has_additional_check = true;
                break;
            }
        }
        reset_rows();
    }

    $has_sponsorship_check = false;
    if (have_rows('sponsor_information')) {
        while (have_rows('sponsor_information')) {
            the_row();
            if (get_sub_field('sponsorship_opportunities') || get_sub_field('sponsorship_contact')) {
                $has_sponsorship_check = true;
                break;
            }
        }
        reset_rows();
    }

    // Only render section if any content exists
    if ($has_tournament_content || $has_features_check || $has_additional_check || $has_sponsorship_check) :
    ?>
    <section class="px-[5%] py-16 md:py-24">
        <div class="container mx-auto">
            <div class="grid grid-cols-1 gap-16">
                <!-- Left Column -->
                <div>
                    <!-- Tournament Description -->
                    <?php if (!empty(get_the_content())) : ?>
                    <div class="mb-16">
                        <h2 class="mb-8 text-4xl font-bold md:text-5xl lg:text-6xl">About This Tournament</h2>
                        <div class="prose max-w-none">
                            <?php the_content(); ?>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php 
                    // Check if tournament features has data before displaying the section
                    $has_features_data = false;
                    if (have_rows('tournament_features')) {
                        while (have_rows('tournament_features')) {
                            the_row();
                            if (get_sub_field('feature_title') || get_sub_field('feature_description')) {
                                $has_features_data = true;
                                break;
                            }
                        }
                        reset_rows(); // Reset the loop for later use
                    }
                    
                    if ($has_features_data) : 
                    ?>
                        <div class="mb-16">
                            <h2 class="mb-8 text-4xl font-bold md:text-5xl lg:text-6xl">Tournament Features</h2>
                            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                                <?php while (have_rows('tournament_features')) : the_row(); ?>
                                    <?php if (get_sub_field('feature_title') || get_sub_field('feature_description')) : ?>
                                        <div class="rounded-xl border border-gray-100 bg-white p-8 shadow-sm transition-transform hover:shadow-md">
                                            <div class="mb-4 inline-flex rounded-lg bg-[#269763]/10 p-3">
                                                <i data-lucide="star" class="h-6 w-6 text-[#269763]"></i>
                                            </div>
                                            <?php if (get_sub_field('feature_title')) : ?>
                                            <h3 class="mb-4 text-xl font-bold"><?php echo esc_html(get_sub_field('feature_title')); ?></h3>
                                            <?php endif; ?>
                                            <?php if (get_sub_field('feature_description')) : ?>
                                            <p class="text-gray-600"><?php echo esc_html(get_sub_field('feature_description')); ?></p>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>
                                <?php endwhile; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php 
                    // Check if additional information has data before displaying the section
                    $has_additional_info = false;
                    if (have_rows('additional_information')) {
                        while (have_rows('additional_information')) {
                            the_row();
                            if (get_sub_field('rules') || get_sub_field('prizes') || get_sub_field('faq') || get_sub_field('cancellation_policy')) {
                                $has_additional_info = true;
                                break;
                            }
                            // Contact information check removed to prevent duplication
                        }
                        reset_rows(); // Reset the loop for later use
                    }
                    
                    if ($has_additional_info) : 
                    ?>
                        <?php while (have_rows('additional_information')) : the_row(); ?>
                            <?php 
                            $has_rules = !empty(get_sub_field('rules'));
                            $has_prizes = !empty(get_sub_field('prizes'));
                            $has_faq = !empty(get_sub_field('faq'));
                            $has_cancellation = !empty(get_sub_field('cancellation_policy'));
                            
                            if ($has_rules || $has_prizes) : ?>
                            <div class="mb-16">
                                <h2 class="mb-8 text-4xl font-bold md:text-5xl lg:text-6xl">Additional Information</h2>
                                
                                <?php if ($has_rules || $has_prizes) : ?>
                                <div class="grid grid-cols-1 gap-8 md:grid-cols-2">
                                    <?php if ($has_rules) : ?>
                                        <div class="rounded-xl border border-gray-100 bg-white p-8 shadow-sm">
                                            <div class="mb-4 flex items-center gap-3">
                                                <div class="inline-flex rounded-lg bg-[#269763]/10 p-3">
                                                    <i data-lucide="book" class="h-6 w-6 text-[#269763]"></i>
                                                </div>
                                                <h3 class="text-2xl font-bold">Rules</h3>
                                            </div>
                                            <div class="prose max-w-none">
                                                <?php echo wp_kses_post(get_sub_field('rules')); ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ($has_prizes) : ?>
                                        <div class="rounded-xl border border-gray-100 bg-white p-8 shadow-sm">
                                            <div class="mb-4 flex items-center gap-3">
                                                <div class="inline-flex rounded-lg bg-[#269763]/10 p-3">
                                                    <i data-lucide="award" class="h-6 w-6 text-[#269763]"></i>
                                                </div>
                                                <h3 class="text-2xl font-bold">Prizes</h3>
                                            </div>
                                            <div class="prose max-w-none">
                                                <?php echo wp_kses_post(get_sub_field('prizes')); ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <?php endif; ?>

                                <?php if ($has_faq || $has_cancellation) : ?>
                                <div class="mt-8 grid grid-cols-1 gap-8 md:grid-cols-2">
                                    <?php if ($has_faq) : ?>
                                        <div class="rounded-xl border border-gray-100 bg-white p-8 shadow-sm">
                                            <div class="mb-4 flex items-center gap-3">
                                                <div class="inline-flex rounded-lg bg-[#269763]/10 p-3">
                                                    <i data-lucide="help-circle" class="h-6 w-6 text-[#269763]"></i>
                                                </div>
                                                <h3 class="text-2xl font-bold">FAQ</h3>
                                            </div>
                                            <div class="prose max-w-none">
                                                <?php echo wp_kses_post(get_sub_field('faq')); ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ($has_cancellation) : ?>
                                        <div class="rounded-xl border border-gray-100 bg-white p-8 shadow-sm">
                                            <div class="mb-4 flex items-center gap-3">
                                                <div class="inline-flex rounded-lg bg-[#269763]/10 p-3">
                                                    <i data-lucide="x-circle" class="h-6 w-6 text-[#269763]"></i>
                                                </div>
                                                <h3 class="text-2xl font-bold">Cancellation Policy</h3>
                                            </div>
                                            <div class="prose max-w-none">
                                                <?php echo wp_kses_post(get_sub_field('cancellation_policy')); ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <?php endif; ?>
                            </div>
                            <?php endif; ?>
                        <?php endwhile; ?>
                    <?php endif; ?>

                    <!-- Sponsorship Opportunities Section -->
                    <?php 
                    // Check if sponsorship opportunities exist
                    $has_sponsorship_opportunities = false;
                    if (have_rows('sponsor_information')) {
                        while (have_rows('sponsor_information')) {
                            the_row();
                            if (get_sub_field('sponsorship_opportunities') || get_sub_field('sponsorship_contact')) {
                                $has_sponsorship_opportunities = true;
                                break;
                            }
                        }
                        reset_rows(); // Reset the loop for later use
                    }
                    
                    if ($has_sponsorship_opportunities) : 
                    ?>
                        <div class="mb-16">
                            <h2 class="mb-8 text-4xl font-bold md:text-5xl lg:text-6xl">Sponsorship Opportunities</h2>
                            
                            <?php if (have_rows('sponsor_information')) : ?>
                                <?php while (have_rows('sponsor_information')) : the_row(); ?>
                                    <?php if (get_sub_field('sponsorship_opportunities')) : ?>
                                        <div class="rounded-xl bg-gray-50 p-8">
                                            <div class="prose max-w-none">
                                                <?php echo wp_kses_post(get_sub_field('sponsorship_opportunities')); ?>
                                            </div>
                                            <?php if (get_sub_field('sponsorship_contact')) : ?>
                                                <div class="mt-6">
                                                    <a href="mailto:<?php echo esc_attr(get_sub_field('sponsorship_contact')); ?>" 
                                                       class="inline-flex items-center gap-2 rounded-md bg-[#269763]/10 px-4 py-2 text-[#269763] hover:bg-[#269763]/20">
                                                        <i data-lucide="mail" class="h-5 w-5"></i>
                                                        <span>Contact for Sponsorship</span>
                                                    </a>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>
                                <?php endwhile; ?>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>


            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- CTA 3 Section -->
    <?php
    // Check if CTA 3 has actual content before rendering
    $has_cta3_content = false;
    if (have_rows('cta_3')) {
        while (have_rows('cta_3')) {
            the_row();
            if (get_sub_field('title') || get_sub_field('content') || get_sub_field('image')) {
                $has_cta3_content = true;
                break;
            }
            // Check for buttons with content
            if (have_rows('buttons')) {
                while (have_rows('buttons')) {
                    the_row();
                    if ((get_sub_field('button_one_label') && get_sub_field('button_one_link')) ||
                        (get_sub_field('button_two_label') && get_sub_field('button_two_link'))) {
                        $has_cta3_content = true;
                        break 2;
                    }
                }
            }
        }
        reset_rows();
    }

    if ($has_cta3_content && have_rows('cta_3')) :
    ?>
        <?php while (have_rows('cta_3')) : the_row(); ?>
            <?php
            $cta_image = get_sub_field('image');
            $has_background = $cta_image && !empty($cta_image);
            ?>
            <section class="relative px-[5%] py-20 md:py-28 <?php echo $has_background ? 'bg-gray-900' : 'bg-[#269763]'; ?>">
                <?php if ($has_background) : ?>
                    <div class="absolute inset-0 z-0">
                        <img src="<?php echo esc_url($cta_image); ?>"
                             alt="CTA Background"
                             class="h-full w-full object-cover opacity-40" />
                    </div>
                <?php endif; ?>

                <div class="container relative z-10 mx-auto">
                    <div class="mx-auto max-w-4xl text-center">
                        <?php if (get_sub_field('title')) : ?>
                            <h2 class="mb-6 text-4xl font-bold text-white md:text-5xl lg:text-6xl">
                                <?php echo esc_html(get_sub_field('title')); ?>
                            </h2>
                        <?php endif; ?>

                        <?php if (get_sub_field('content')) : ?>
                            <p class="mb-10 text-xl text-white/90">
                                <?php echo esc_html(get_sub_field('content')); ?>
                            </p>
                        <?php endif; ?>

                        <?php if (have_rows('buttons')) : ?>
                            <?php while (have_rows('buttons')) : the_row(); ?>
                                <div class="flex flex-wrap items-center justify-center gap-4">
                                    <?php
                                    $button_one_label = get_sub_field('button_one_label');
                                    $button_one_link = get_sub_field('button_one_link');
                                    if ($button_one_label && $button_one_link) :
                                    ?>
                                        <a href="<?php echo esc_url($button_one_link); ?>"
                                           class="inline-flex items-center justify-center rounded-md bg-white px-8 py-4 text-center text-lg font-semibold text-[#269763] hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2">
                                            <?php echo esc_html($button_one_label); ?>
                                        </a>
                                    <?php endif; ?>

                                    <?php
                                    $button_two_label = get_sub_field('button_two_label');
                                    $button_two_link = get_sub_field('button_two_link');
                                    if ($button_two_label && $button_two_link) :
                                    ?>
                                        <a href="<?php echo esc_url($button_two_link); ?>"
                                           class="inline-flex items-center justify-center rounded-md border-2 border-white bg-transparent px-8 py-4 text-center text-lg font-semibold text-white hover:bg-white/10 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2">
                                            <?php echo esc_html($button_two_label); ?>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </section>
        <?php endwhile; ?>
    <?php endif; ?>

    <?php
    // Check if gallery has data before displaying the section
    $has_gallery_data = false;
    if (have_rows('media')) {
        while (have_rows('media')) {
            the_row();
            if (get_sub_field('gallery') && count(get_sub_field('gallery')) > 0) {
                $has_gallery_data = true;
                break;
            }
        }
        reset_rows(); // Reset the loop for later use
    }
    
    if ($has_gallery_data) : 
    ?>
        <?php while (have_rows('media')) : the_row(); ?>
            <?php
            $gallery = get_sub_field('gallery');
            $gallery_title = get_sub_field('gallery_title');
            if ($gallery && count($gallery) > 0) :
            ?>
                <section class="px-0 pt-8 pb-16 md:pt-12 md:pb-24 lg:pt-16 lg:pb-28">
                    <div class="container mx-auto">
                        <div class="mb-12 text-center md:mb-16 lg:mb-20">
                            <h2 class="mb-5 text-4xl font-bold md:text-5xl lg:text-6xl"><?php echo esc_html($gallery_title ?: 'Tournament Gallery'); ?></h2>
                            <p class="text-gray-600">View photos from this tournament</p>
                        </div>
                        <div class="grid auto-cols-fr grid-cols-2 grid-rows-2 gap-6 md:auto-cols-auto md:grid-cols-[2fr_1fr_1fr] md:gap-8">
                            <?php 
                            foreach ($gallery as $index => $image) : ?>
                                <a href="<?php echo esc_url($image['url']); ?>" 
                                   class="inline-block size-full <?php echo $index === 0 ? 'col-start-1 col-end-2 row-start-1 row-end-3' : ''; ?>">
                                    <div class="size-full overflow-hidden rounded-lg transition-transform hover:scale-[1.02]">
                                        <img src="<?php echo esc_url($image['sizes']['large']); ?>" 
                                             alt="<?php echo esc_attr($image['alt']); ?>"
                                             class="aspect-square size-full object-cover" />
                                    </div>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </section>
            <?php endif; ?>
        <?php endwhile; ?>
    <?php endif; ?>

    <!-- Registration Form -->
    <?php if (have_rows('registration_info')) : ?>
        <?php while (have_rows('registration_info')) : the_row(); ?>
            <?php if (get_sub_field('spots_available') > 0) : ?>
                <section id="registration-section" class="bg-gray-50 px-0 py-16 md:py-24">
                    <div class="container mx-auto max-w-3xl">
                        <div class="mb-12 text-center">
                            <h2 class="text-4xl font-bold md:text-5xl lg:text-6xl">Register for Tournament</h2>
                            <p class="mt-4 text-gray-600">Fill out the form below to secure your spot</p>
                        </div>
                        <?php 
                        // Include registration form
                        get_template_part('template-parts/forms/tournament-registration-form');
                        ?>
                    </div>
                </section>
            <?php endif; ?>
        <?php endwhile; ?>
    <?php endif; ?>

</article>

<?php get_footer(); ?>

<script src="https://unpkg.com/lucide@latest"></script>
<script>
    lucide.createIcons();
</script>
