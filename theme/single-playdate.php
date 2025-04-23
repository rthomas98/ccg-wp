<?php
/**
 * The template for displaying single playdate posts
 *
 * @package _ccg
 */

get_header();

while (have_posts()) :
    the_post();
    
    // Initialize variables
    $spots_remaining = 0;
    $waitlist_available = false;
    $current_players = 0;
    $waitlist_count = 0;
    $playdate_title = get_the_title();
    $playdate_date = '';
    $tee_time = '';
    $location = '';
    $course_address = '';
    $player_limit = '';
    $registration_status = '';
    $member_price = 0;
    $non_member_price = 0;
    $course_member_price = 0;
    $payment_link = '';
    
    // Get values from ACF fields
    if (have_rows('current_status')) {
        while (have_rows('current_status')) {
            the_row();
            $current_players = get_sub_field('current_players');
            $spots_remaining = get_sub_field('spots_remaining');
            $waitlist_available = get_sub_field('waitlist_available') == 1;
            $waitlist_count = get_sub_field('waitlist_count');
        }
    }
    
    // Get playdate details
    if (have_rows('playdate_details')) {
        while (have_rows('playdate_details')) {
            the_row();
            $playdate_date = get_sub_field('date');
            $tee_time = get_sub_field('tee_time_start');
            $location = get_sub_field('location');
            $course_address = get_sub_field('course_address');
            $player_limit = get_sub_field('player_limit');
            $registration_status = get_sub_field('registration_status');
        }
    }
    
    // Get pricing information
    if (have_rows('pricing_information')) {
        while (have_rows('pricing_information')) {
            the_row();
            $course_member_price = get_sub_field('course_member_price');
            $non_member_price = get_sub_field('non_member_price');
            $payment_link = get_sub_field('payment_link');
            
            // For backward compatibility
            $member_price = $course_member_price;
        }
    }
    
    // Fallback to spots_available if spots_remaining is not set
    if (empty($spots_remaining) && $spots_remaining !== '0' && $spots_remaining !== 0) {
        $spots_remaining = get_field('spots_available');
    }
    
    // Determine status text and class
    if ($spots_remaining > 0) {
        $status_text = $spots_remaining . ' spots remaining';
        $status_class = 'bg-[#269763]';
    } elseif ($waitlist_available) {
        $status_text = 'Waitlist Available';
        $status_class = 'bg-[#f59e0b]';
    } else {
        $status_text = 'Sold Out';
        $status_class = 'bg-gray-500';
    }
    
    // Format date for display
    $formatted_date = !empty($playdate_date) ? date('F j, Y', strtotime($playdate_date)) : '';
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('playdate-single'); ?>>
    <!-- Hero Section -->
    <section class="relative min-h-[60vh] bg-[#141414]">
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
        
        <div class="relative z-10 flex min-h-[60vh] items-end px-[5%] pb-16 pt-32 md:pb-24 lg:pb-28">
            <div class="container mx-auto">
                <div class="max-w-3xl">
                    <span class="mb-6 inline-block rounded-full <?php echo $status_class; ?> px-4 py-2 text-sm font-semibold uppercase tracking-wider text-white shadow-lg">
                        <?php echo esc_html($status_text); ?>
                    </span>

                    <h1 class="mb-8 text-5xl font-bold text-white md:text-6xl lg:text-7xl">
                        <?php the_title(); ?>
                    </h1>

                    <div class="flex flex-wrap items-center gap-8 text-lg text-white/90">
                        <?php if (!empty($formatted_date)) : ?>
                            <div class="flex items-center gap-3">
                                <i data-lucide="calendar" class="h-6 w-6 text-[#269763]"></i>
                                <span class="font-medium"><?php echo esc_html($formatted_date); ?></span>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($tee_time)) : ?>
                            <div class="flex items-center gap-3">
                                <i data-lucide="clock" class="h-6 w-6 text-[#269763]"></i>
                                <span class="font-medium"><?php echo esc_html($tee_time); ?></span>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($location)) : ?>
                            <div class="flex items-center gap-3">
                                <i data-lucide="map-pin" class="h-6 w-6 text-[#269763]"></i>
                                <span class="font-medium"><?php echo esc_html($location); ?></span>
                            </div>
                        <?php endif; ?>
                        
                        <?php if (!empty($player_limit)) : ?>
                            <div class="flex items-center gap-3">
                                <i data-lucide="users" class="h-6 w-6 text-[#269763]"></i>
                                <span class="font-medium"><?php echo esc_html($player_limit); ?> Players</span>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content Section -->
    <section class="bg-white px-[5%] py-16 md:py-24">
        <div class="container mx-auto">
            <!-- Event Details Tabs -->
            <div class="mb-16 border-b border-gray-200">
                <div class="flex flex-wrap -mb-px">
                    <a href="#details" class="inline-block p-4 text-[#269763] border-b-2 border-[#269763] rounded-t-lg active font-medium">
                        Details
                    </a>
                    <a href="#venue" class="inline-block p-4 text-gray-600 hover:text-[#269763] border-b-2 border-transparent hover:border-[#269763] rounded-t-lg font-medium">
                        Venue
                    </a>
                    <a href="#organizer" class="inline-block p-4 text-gray-600 hover:text-[#269763] border-b-2 border-transparent hover:border-[#269763] rounded-t-lg font-medium">
                        Organizer
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-12 lg:grid-cols-[2fr_1fr]">
                <!-- Left Column - Event Details -->
                <div>
                    <!-- Event Description -->
                    <div class="mb-12">
                        <div class="prose max-w-none">
                            <?php the_content(); ?>
                        </div>
                    </div>

                    <!-- Course Information -->
                    <?php if (!empty($location) || !empty($course_address)) : ?>
                        <div class="mb-12">
                            <h3 class="text-2xl font-bold mb-6">Venue Information</h3>
                            <div class="bg-gray-50 rounded-lg p-6 shadow-sm">
                                <?php if (!empty($location)) : ?>
                                    <h4 class="text-xl font-semibold mb-2"><?php echo esc_html($location); ?></h4>
                                <?php endif; ?>
                                
                                <?php if (!empty($course_address)) : ?>
                                    <p class="text-gray-700 mb-4"><?php echo esc_html($course_address); ?></p>
                                <?php endif; ?>
                                
                                <?php if (have_rows('media')) : ?>
                                    <?php while (have_rows('media')) : the_row(); ?>
                                        <?php $course_logo = get_sub_field('course_logo'); ?>
                                        <?php if ($course_logo) : ?>
                                            <div class="mt-4">
                                                <img src="<?php echo esc_url($course_logo['url']); ?>" 
                                                     alt="<?php echo esc_attr($course_logo['alt']); ?>"
                                                     class="max-h-16" />
                                            </div>
                                        <?php endif; ?>
                                    <?php endwhile; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Course Photos -->
                    <?php if (have_rows('media')) : ?>
                        <?php while (have_rows('media')) : the_row(); ?>
                            <?php $course_photos = get_sub_field('course_photos'); ?>
                            <?php if ($course_photos) : ?>
                                <div class="mb-12">
                                    <h3 class="text-2xl font-bold mb-6">Course Photos</h3>
                                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                        <?php foreach ($course_photos as $photo) : ?>
                                            <div class="relative overflow-hidden rounded-lg group">
                                                <img src="<?php echo esc_url($photo['sizes']['medium_large']); ?>" 
                                                     alt="<?php echo esc_attr($photo['alt']); ?>"
                                                     class="w-full h-64 object-cover transition-transform duration-300 group-hover:scale-110" />
                                                <?php if (!empty($photo['caption'])) : ?>
                                                    <div class="absolute bottom-0 left-0 right-0 bg-black/60 p-3 text-white text-sm">
                                                        <?php echo esc_html($photo['caption']); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endwhile; ?>
                    <?php endif; ?>

                    <!-- Format & Rules -->
                    <?php if (have_rows('additional_information')) : ?>
                        <?php while (have_rows('additional_information')) : the_row(); ?>
                            <?php if (get_sub_field('format') || get_sub_field('weather_policy') || get_sub_field('cancellation_policy') || get_sub_field('special_notes')) : ?>
                                <div class="mb-12">
                                    <h3 class="text-2xl font-bold mb-6">Format & Rules</h3>
                                    <div class="grid gap-6">
                                        <?php if (get_sub_field('format')) : ?>
                                            <div class="bg-gray-50 rounded-lg p-6 shadow-sm">
                                                <h4 class="text-lg font-semibold mb-3 flex items-center">
                                                    <i data-lucide="flag" class="h-5 w-5 mr-2 text-[#269763]"></i>
                                                    Format
                                                </h4>
                                                <div class="text-gray-700">
                                                    <?php echo wp_kses_post(get_sub_field('format')); ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        
                                        <?php if (get_sub_field('weather_policy')) : ?>
                                            <div class="bg-gray-50 rounded-lg p-6 shadow-sm">
                                                <h4 class="text-lg font-semibold mb-3 flex items-center">
                                                    <i data-lucide="cloud-rain" class="h-5 w-5 mr-2 text-[#269763]"></i>
                                                    Weather Policy
                                                </h4>
                                                <div class="text-gray-700">
                                                    <?php echo wp_kses_post(get_sub_field('weather_policy')); ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        
                                        <?php if (get_sub_field('cancellation_policy')) : ?>
                                            <div class="bg-gray-50 rounded-lg p-6 shadow-sm">
                                                <h4 class="text-lg font-semibold mb-3 flex items-center">
                                                    <i data-lucide="x-circle" class="h-5 w-5 mr-2 text-[#269763]"></i>
                                                    Cancellation Policy
                                                </h4>
                                                <div class="text-gray-700">
                                                    <?php echo wp_kses_post(get_sub_field('cancellation_policy')); ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        
                                        <?php if (get_sub_field('special_notes')) : ?>
                                            <div class="bg-gray-50 rounded-lg p-6 shadow-sm">
                                                <h4 class="text-lg font-semibold mb-3 flex items-center">
                                                    <i data-lucide="info" class="h-5 w-5 mr-2 text-[#269763]"></i>
                                                    Special Notes
                                                </h4>
                                                <div class="text-gray-700">
                                                    <?php echo wp_kses_post(get_sub_field('special_notes')); ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endwhile; ?>
                    <?php endif; ?>

                    <!-- Contact Information -->
                    <?php if (have_rows('contact_info')) : ?>
                        <div class="mb-12">
                            <h3 class="text-2xl font-bold mb-6">Contact Information</h3>
                            <div class="bg-gray-50 rounded-lg p-6 shadow-sm">
                                <?php while (have_rows('contact_info')) : the_row(); ?>
                                    <div class="grid gap-6 md:grid-cols-2">
                                        <?php if (get_sub_field('organizer_name') || get_sub_field('organizer_email') || get_sub_field('organizer_phone')) : ?>
                                            <div>
                                                <h4 class="text-lg font-semibold mb-3 flex items-center">
                                                    <i data-lucide="user" class="h-5 w-5 mr-2 text-[#269763]"></i>
                                                    Organizer
                                                </h4>
                                                <ul class="space-y-2">
                                                    <?php if (get_sub_field('organizer_name')) : ?>
                                                        <li class="flex items-start">
                                                            <i data-lucide="user" class="h-5 w-5 mr-2 text-gray-500 mt-0.5"></i>
                                                            <span><?php echo esc_html(get_sub_field('organizer_name')); ?></span>
                                                        </li>
                                                    <?php endif; ?>
                                                    
                                                    <?php if (get_sub_field('organizer_email')) : ?>
                                                        <li class="flex items-start">
                                                            <i data-lucide="mail" class="h-5 w-5 mr-2 text-gray-500 mt-0.5"></i>
                                                            <a href="mailto:<?php echo esc_attr(get_sub_field('organizer_email')); ?>" class="text-[#269763] hover:underline">
                                                                <?php echo esc_html(get_sub_field('organizer_email')); ?>
                                                            </a>
                                                        </li>
                                                    <?php endif; ?>
                                                    
                                                    <?php if (get_sub_field('organizer_phone')) : ?>
                                                        <li class="flex items-start">
                                                            <i data-lucide="phone" class="h-5 w-5 mr-2 text-gray-500 mt-0.5"></i>
                                                            <a href="tel:<?php echo esc_attr(get_sub_field('organizer_phone')); ?>" class="text-[#269763] hover:underline">
                                                                <?php echo esc_html(get_sub_field('organizer_phone')); ?>
                                                            </a>
                                                        </li>
                                                    <?php endif; ?>
                                                </ul>
                                            </div>
                                        <?php endif; ?>
                                        
                                        <?php if (get_sub_field('emergency_contact')) : ?>
                                            <div>
                                                <h4 class="text-lg font-semibold mb-3 flex items-center">
                                                    <i data-lucide="alert-circle" class="h-5 w-5 mr-2 text-[#269763]"></i>
                                                    Emergency Contact
                                                </h4>
                                                <div class="text-gray-700">
                                                    <?php echo wp_kses_post(get_sub_field('emergency_contact')); ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                <?php endwhile; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                
                <!-- Right Column - Registration Card -->
                <div>
                    <div class="sticky top-8">
                        <div class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden">
                            <!-- Registration Card Header -->
                            <div class="bg-[#269763] text-white p-6">
                                <h3 class="text-2xl font-bold">Registration</h3>
                                <?php if (!empty($formatted_date)) : ?>
                                    <p class="mt-2 flex items-center">
                                        <i data-lucide="calendar" class="h-5 w-5 mr-2"></i>
                                        <?php echo esc_html($formatted_date); ?>
                                    </p>
                                <?php endif; ?>
                                <?php if (!empty($tee_time)) : ?>
                                    <p class="mt-2 flex items-center">
                                        <i data-lucide="clock" class="h-5 w-5 mr-2"></i>
                                        <?php echo esc_html($tee_time); ?>
                                    </p>
                                <?php endif; ?>
                            </div>
                            
                            <!-- Registration Card Body -->
                            <div class="p-6">
                                <!-- Pricing Information -->
                                <?php if (have_rows('pricing_information')) : ?>
                                    <?php while (have_rows('pricing_information')) : the_row(); ?>
                                        <div class="mb-6">
                                            <h4 class="text-lg font-semibold mb-3">Pricing</h4>
                                            <div class="space-y-2">
                                                <?php if (get_sub_field('course_member_price')) : ?>
                                                    <div class="flex justify-between">
                                                        <span class="text-gray-700">Course Member:</span>
                                                        <span class="font-medium">$<?php echo number_format(get_sub_field('course_member_price'), 2); ?></span>
                                                    </div>
                                                <?php endif; ?>
                                                
                                                <?php if (get_sub_field('non_member_price')) : ?>
                                                    <div class="flex justify-between">
                                                        <span class="text-gray-700">Non-Member:</span>
                                                        <span class="font-medium">$<?php echo number_format(get_sub_field('non_member_price'), 2); ?></span>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        
                                        <!-- Additional Fees -->
                                        <?php if (have_rows('additional_fees')) : ?>
                                            <div class="mb-6">
                                                <h4 class="text-lg font-semibold mb-3">Additional Fees</h4>
                                                <ul class="space-y-2">
                                                    <?php while (have_rows('additional_fees')) : the_row(); ?>
                                                        <li class="flex items-start">
                                                            <i data-lucide="plus-circle" class="h-5 w-5 mr-2 text-[#269763] mt-0.5"></i>
                                                            <span><?php echo esc_html(get_sub_field('fee_type')); ?></span>
                                                        </li>
                                                    <?php endwhile; ?>
                                                </ul>
                                            </div>
                                        <?php endif; ?>
                                        
                                        <!-- Price Includes -->
                                        <?php if (have_rows('price_includes')) : ?>
                                            <div class="mb-6">
                                                <h4 class="text-lg font-semibold mb-3">Price Includes</h4>
                                                <ul class="space-y-2">
                                                    <?php while (have_rows('price_includes')) : the_row(); ?>
                                                        <li class="flex items-start">
                                                            <i data-lucide="check" class="h-5 w-5 mr-2 text-[#269763] mt-0.5"></i>
                                                            <span><?php echo esc_html(get_sub_field('item')); ?></span>
                                                        </li>
                                                    <?php endwhile; ?>
                                                </ul>
                                            </div>
                                        <?php endif; ?>
                                    <?php endwhile; ?>
                                <?php endif; ?>
                                
                                <!-- Registration Details -->
                                <?php if (have_rows('registration_details')) : ?>
                                    <?php while (have_rows('registration_details')) : the_row(); ?>
                                        <?php if (get_sub_field('registration_instructions')) : ?>
                                            <div class="mb-6">
                                                <h4 class="text-lg font-semibold mb-3">Registration Instructions</h4>
                                                <div class="text-gray-700">
                                                    <?php echo wp_kses_post(get_sub_field('registration_instructions')); ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        
                                        <?php if (get_sub_field('registration_deadline')) : ?>
                                            <div class="mb-6">
                                                <h4 class="text-lg font-semibold mb-3">Registration Deadline</h4>
                                                <div class="text-gray-700 flex items-center">
                                                    <i data-lucide="calendar-clock" class="h-5 w-5 mr-2 text-[#269763]"></i>
                                                    <span><?php echo esc_html(get_sub_field('registration_deadline')); ?></span>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        
                                        <!-- Included Items -->
                                        <?php if (have_rows('included_items')) : ?>
                                            <?php while (have_rows('included_items')) : the_row(); ?>
                                                <?php if (get_sub_field('golf_gift')) : ?>
                                                    <div class="mb-6">
                                                        <h4 class="text-lg font-semibold mb-3">Golf Gift</h4>
                                                        <div class="text-gray-700 flex items-start">
                                                            <i data-lucide="gift" class="h-5 w-5 mr-2 text-[#269763] mt-0.5"></i>
                                                            <span><?php echo esc_html(get_sub_field('golf_gift')); ?></span>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                                
                                                <?php if (have_rows('additional_inclusions')) : ?>
                                                    <div class="mb-6">
                                                        <h4 class="text-lg font-semibold mb-3">Additional Inclusions</h4>
                                                        <ul class="space-y-3">
                                                            <?php while (have_rows('additional_inclusions')) : the_row(); ?>
                                                                <li class="bg-gray-50 p-3 rounded">
                                                                    <h5 class="font-medium"><?php echo esc_html(get_sub_field('item_name')); ?></h5>
                                                                    <?php if (get_sub_field('item_description')) : ?>
                                                                        <p class="text-sm text-gray-600 mt-1"><?php echo esc_html(get_sub_field('item_description')); ?></p>
                                                                    <?php endif; ?>
                                                                </li>
                                                            <?php endwhile; ?>
                                                        </ul>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endwhile; ?>
                                        <?php endif; ?>
                                    <?php endwhile; ?>
                                <?php endif; ?>
                                
                                <!-- Current Status -->
                                <?php if (have_rows('current_status')) : ?>
                                    <?php while (have_rows('current_status')) : the_row(); ?>
                                        <div class="mb-6">
                                            <h4 class="text-lg font-semibold mb-3">Current Status</h4>
                                            <div class="space-y-2">
                                                <?php if (get_sub_field('current_players')) : ?>
                                                    <div class="flex justify-between">
                                                        <span class="text-gray-700">Current Players:</span>
                                                        <span class="font-medium"><?php echo esc_html(get_sub_field('current_players')); ?></span>
                                                    </div>
                                                <?php endif; ?>
                                                
                                                <?php if (get_sub_field('spots_remaining')) : ?>
                                                    <div class="flex justify-between">
                                                        <span class="text-gray-700">Spots Remaining:</span>
                                                        <span class="font-medium"><?php echo esc_html(get_sub_field('spots_remaining')); ?></span>
                                                    </div>
                                                <?php endif; ?>
                                                
                                                <?php if (get_sub_field('waitlist_available') == 1 && get_sub_field('waitlist_count')) : ?>
                                                    <div class="flex justify-between">
                                                        <span class="text-gray-700">Waitlist Count:</span>
                                                        <span class="font-medium"><?php echo esc_html(get_sub_field('waitlist_count')); ?></span>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endwhile; ?>
                                <?php endif; ?>
                                
                                <!-- Registration Button -->
                                <?php if ($spots_remaining > 0) : ?>
                                    <a href="#registration-section" class="scroll-to-section block w-full bg-[#269763] hover:bg-[#1e7a4f] text-white text-center font-bold py-3 px-4 rounded transition duration-300" data-target="registration-section">
                                        Register Now
                                    </a>
                                <?php elseif ($waitlist_available) : ?>
                                    <a href="#waitlist-section" class="scroll-to-section block w-full bg-[#f59e0b] hover:bg-[#d97706] text-white text-center font-bold py-3 px-4 rounded transition duration-300" data-target="waitlist-section">
                                        Join Waitlist
                                    </a>
                                <?php else : ?>
                                    <button disabled class="block w-full bg-gray-400 text-white text-center font-bold py-3 px-4 rounded cursor-not-allowed">
                                        Sold Out
                                    </button>
                                <?php endif; ?>
                                
                                <!-- External Payment Link -->
                                <?php if (have_rows('pricing_information')) : ?>
                                    <?php while (have_rows('pricing_information')) : the_row(); ?>
                                        <?php if (get_sub_field('payment_link')) : ?>
                                            <div class="mt-4">
                                                <a href="<?php echo esc_url(get_sub_field('payment_link')); ?>" target="_blank" class="block w-full bg-blue-600 hover:bg-blue-700 text-white text-center font-bold py-3 px-4 rounded transition duration-300">
                                                    Pay Directly
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                    <?php endwhile; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Registration Form -->
    <?php if ($spots_remaining > 0) : ?>
        <section id="registration-section" class="bg-gray-50 px-[5%] py-16 md:py-24">
            <div class="container mx-auto max-w-4xl">
                <div class="mb-12 text-center">
                    <h2 class="text-4xl font-bold md:text-5xl lg:text-6xl">Register for this Playdate</h2>
                    <p class="mt-4 text-gray-600">Fill out the form below to secure your spot</p>
                </div>
                
                <?php
                // Get playdate details
                $playdate_id = get_the_ID();
                $playdate_title = get_the_title();
                
                // Initialize price variables
                $member_price = 0;
                $non_member_price = 0;
                
                // Get pricing information
                if (have_rows('pricing_information')) {
                    while (have_rows('pricing_information')) {
                        the_row();
                        
                        // Get member/non-member prices
                        $member_price = get_sub_field('course_member_price') ? (float)get_sub_field('course_member_price') : 0;
                        $non_member_price = get_sub_field('non_member_price') ? (float)get_sub_field('non_member_price') : 0;
                    }
                }
                
                // Get date
                $playdate_date = '';
                if (have_rows('playdate_details')) {
                    while (have_rows('playdate_details')) {
                        the_row();
                        if (get_sub_field('date')) {
                            $playdate_date = date('M j, Y', strtotime(get_sub_field('date')));
                        }
                    }
                }
                ?>
                
                <!-- Custom Pre-Registration Form -->
                <div id="pre-registration-form" class="bg-white rounded-lg shadow-sm p-6 mb-8 border border-gray-200">
                    <h3 class="text-xl font-semibold mb-4">Playdate Options</h3>
                    
                    <!-- Membership Status -->
                    <div class="mb-6">
                        <label class="block text-gray-700 font-medium mb-2">Membership Status</label>
                        <div class="flex flex-wrap gap-4">
                            <label class="flex items-center cursor-pointer">
                                <input type="radio" name="membership-status" value="member" class="form-radio h-5 w-5 text-[#269763]" checked>
                                <span class="ml-2">Course Member</span>
                            </label>
                            <label class="flex items-center cursor-pointer">
                                <input type="radio" name="membership-status" value="non-member" class="form-radio h-5 w-5 text-[#269763]">
                                <span class="ml-2">Non-Member</span>
                            </label>
                        </div>
                    </div>
                    
                    <div class="payment-summary bg-gray-50 rounded-lg p-6 mb-6 border border-gray-200">
                        <h3 class="font-semibold text-gray-900 mb-4 text-lg">Payment Summary</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <p class="text-gray-600 text-sm">Green Fee</p>
                                <p class="text-lg font-medium" id="green-fee-display">$<?php echo number_format($member_price, 2); ?></p>
                            </div>
                        </div>
                        
                        <div class="border-t border-gray-300 pt-4 mb-4">
                            <div class="flex justify-between items-center">
                                <p class="font-semibold">Total</p>
                                <p class="text-xl font-bold text-[#269763]" id="total-price-display">$<?php echo number_format($member_price, 2); ?></p>
                            </div>
                        </div>
                        
                        <div class="mt-4 text-sm text-gray-600">
                            <p>Your card will be charged immediately upon submission.</p>
                            <?php if (have_rows('additional_information')) : ?>
                                <?php while (have_rows('additional_information')) : the_row(); ?>
                                    <?php if (get_sub_field('cancellation_policy')) : ?>
                                        <p class="mt-2"><strong>Cancellation Policy:</strong> <?php echo esc_html(get_sub_field('cancellation_policy')); ?></p>
                                    <?php endif; ?>
                                <?php endwhile; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <!-- Continue to Registration Button -->
                    <button id="continue-to-registration" class="w-full bg-[#269763] hover:bg-[#1e7a4f] text-white font-bold py-3 px-4 rounded focus:outline-none focus:shadow-outline transition duration-300">
                        Continue to Registration
                    </button>
                </div>
                
                <!-- Hidden Fluent Form (will be shown after pre-registration) -->
                <div id="fluent-form-container" class="hidden bg-white rounded-lg shadow-sm p-6 border border-gray-200">
                    <?php echo do_shortcode('[fluentform id="5"]'); ?>
                </div>
                
                <script>
                document.addEventListener('DOMContentLoaded', function() {
                    // Price variables from PHP
                    const memberPrice = <?php echo $member_price; ?>;
                    const nonMemberPrice = <?php echo $non_member_price; ?>;
                    
                    // Get payment link
                    <?php if (have_rows('pricing_information')) : ?>
                        <?php while (have_rows('pricing_information')) : the_row(); ?>
                            const memberPaymentLink = "<?php echo esc_url(get_sub_field('member_payment_link')); ?>";
                            const nonMemberPaymentLink = "<?php echo esc_url(get_sub_field('non_member_payment_link')); ?>";
                        <?php endwhile; ?>
                    <?php else : ?>
                        const memberPaymentLink = "";
                        const nonMemberPaymentLink = "";
                    <?php endif; ?>
                    
                    // DOM elements
                    const membershipRadios = document.querySelectorAll('input[name="membership-status"]');
                    const greenFeeDisplay = document.getElementById('green-fee-display');
                    const totalPriceDisplay = document.getElementById('total-price-display');
                    const continueButton = document.getElementById('continue-to-registration');
                    const preRegistrationForm = document.getElementById('pre-registration-form');
                    const fluentFormContainer = document.getElementById('fluent-form-container');
                    
                    // Current state
                    let currentMembershipStatus = 'member';
                    
                    // Format price as currency
                    function formatPrice(price) {
                        return '$' + price.toFixed(2);
                    }
                    
                    // Update displayed prices
                    function updatePrices() {
                        const greenFee = currentMembershipStatus === 'member' ? memberPrice : nonMemberPrice;
                        
                        greenFeeDisplay.textContent = formatPrice(greenFee);
                        totalPriceDisplay.textContent = formatPrice(greenFee);
                    }
                    
                    // Membership status change handler
                    membershipRadios.forEach(radio => {
                        radio.addEventListener('change', function() {
                            currentMembershipStatus = this.value;
                            updatePrices();
                        });
                    });
                    
                    // Continue to registration button handler
                    continueButton.addEventListener('click', function() {
                        preRegistrationForm.style.display = 'none';
                        fluentFormContainer.style.display = 'block';
                        
                        // Scroll to the form
                        fluentFormContainer.scrollIntoView({ 
                            behavior: 'smooth',
                            block: 'start'
                        });
                        
                        // Store the payment link in a global variable to use after form submission
                        window.ccgSelectedPaymentLink = currentMembershipStatus === 'member' ? memberPaymentLink : nonMemberPaymentLink;
                        
                        // Add a hidden field to the form to store the selected payment link
                        if (!document.getElementById('ccg_selected_payment_link')) {
                            const hiddenLinkField = document.createElement('input');
                            hiddenLinkField.type = 'hidden';
                            hiddenLinkField.id = 'ccg_selected_payment_link';
                            hiddenLinkField.name = 'ccg_selected_payment_link';
                            hiddenLinkField.value = window.ccgSelectedPaymentLink;
                            fluentFormContainer.querySelector('form').appendChild(hiddenLinkField);
                        } else {
                            document.getElementById('ccg_selected_payment_link').value = window.ccgSelectedPaymentLink;
                        }
                    });
                });
                </script>
                
                <!-- Script to handle form submission and redirection -->
                <script>
                document.addEventListener('DOMContentLoaded', function() {
                    // Listen for the Fluent Form success event
                    jQuery(document).on('fluentform_submission_success', function(event, data) {
                        // Get the stored payment link
                        const redirectLink = window.ccgSelectedPaymentLink;
                        
                        // Log for debugging
                        console.log('Form submitted successfully');
                        console.log('Redirecting to:', redirectLink);
                        
                        // Redirect to payment link after successful form submission
                        if (redirectLink && redirectLink.length > 0) {
                            setTimeout(function() {
                                window.open(redirectLink, '_blank');
                            }, 1500);
                        }
                    });
                });
                </script>
            </div>
        </section>
    <?php endif; ?>

    <!-- Waitlist Form -->
    <?php if (!$spots_remaining && $waitlist_available) : ?>
        <section id="waitlist-section" class="bg-gray-50 px-[5%] py-16 md:py-24">
            <div class="container mx-auto max-w-4xl">
                <div class="mb-12 text-center">
                    <h2 class="text-4xl font-bold md:text-5xl lg:text-6xl">Join the Waitlist</h2>
                    <p class="mt-4 text-gray-600">This playdate is currently full, but you can join our waitlist</p>
                </div>
                <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
                    <?php 
                    // Include waitlist form
                    echo do_shortcode('[fluentform id="6"]'); 
                    ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <!-- Gallery -->
    <?php if (have_rows('media')) : ?>
        <?php while (have_rows('media')) : the_row(); ?>
            <?php if (have_rows('gallery')) : ?>
                <section class="bg-gray-50 px-[5%] py-16 md:py-24">
                    <div class="container mx-auto">
                        <h2 class="mb-12 text-center text-4xl font-bold md:text-5xl lg:text-6xl">Event Gallery</h2>
                        <div class="grid grid-cols-2 gap-4 md:grid-cols-3 lg:grid-cols-4">
                            <?php while (have_rows('gallery')) : the_row(); 
                                $image = get_sub_field('image');
                                if ($image) : ?>
                                    <div class="aspect-square">
                                        <img src="<?php echo esc_url($image['url']); ?>" 
                                             alt="<?php echo esc_attr($image['alt']); ?>" 
                                             class="h-full w-full object-cover" />
                                    </div>
                                <?php endif; ?>
                            <?php endwhile; ?>
                        </div>
                    </div>
                </section>
            <?php endif; ?>
        <?php endwhile; ?>
    <?php endif; ?>
</article>

<?php endwhile; ?>

<!-- Tab Functionality Script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Tab functionality
    const tabLinks = document.querySelectorAll('a[href^="#"]');
    
    // Find tab content sections
    function findTabContents() {
        const tabContents = {
            'details': document.querySelector('.prose'),
            'venue': null,
            'organizer': null
        };
        
        // Find venue and organizer sections
        const headings = document.querySelectorAll('h3');
        headings.forEach(heading => {
            if (heading.textContent.includes('Venue Information')) {
                tabContents.venue = heading.closest('div');
            }
            if (heading.textContent.includes('Contact Information')) {
                tabContents.organizer = heading.closest('div');
            }
        });
        
        return tabContents;
    }
    
    const tabContents = findTabContents();
    
    // Hide all tab contents except the first one
    Object.keys(tabContents).forEach((key, index) => {
        if (index > 0 && tabContents[key]) {
            tabContents[key].style.display = 'none';
        }
    });
    
    // Add click event to tab links
    tabLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Remove active class from all tabs
            tabLinks.forEach(tab => {
                tab.classList.remove('text-[#269763]', 'border-[#269763]');
                tab.classList.add('text-gray-600', 'border-transparent');
            });
            
            // Add active class to clicked tab
            this.classList.remove('text-gray-600', 'border-transparent');
            this.classList.add('text-[#269763]', 'border-[#269763]');
            
            // Hide all tab contents
            Object.values(tabContents).forEach(content => {
                if (content) content.style.display = 'none';
            });
            
            // Show selected tab content
            const tabId = this.getAttribute('href').substring(1);
            if (tabContents[tabId]) {
                tabContents[tabId].style.display = 'block';
            }
        });
    });
    
    // Initialize Lucide icons
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add smooth scrolling to all scroll-to-section links
    const scrollLinks = document.querySelectorAll('.scroll-to-section');
    
    scrollLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            
            const targetId = this.getAttribute('data-target');
            const targetElement = document.getElementById(targetId);
            
            if (targetElement) {
                // Scroll to the target element with smooth behavior
                targetElement.scrollIntoView({ 
                    behavior: 'smooth',
                    block: 'start'
                });
                
                // Update URL hash without jumping
                history.pushState(null, null, '#' + targetId);
            }
        });
    });
});
</script>

<?php get_footer(); ?>