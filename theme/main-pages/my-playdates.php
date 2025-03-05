<?php
/**
 * Template Name: My Playdates
 * 
 * @package _ccg
 */

get_header();

// Ensure user is logged in
if (!is_user_logged_in()) {
    wp_redirect(home_url('/login'));
    exit;
}

$current_user = wp_get_current_user();
$user_email = $current_user->user_email;

// Get all playdates where this user is registered
$registered_playdates = get_posts(array(
    'post_type' => 'playdate',
    'posts_per_page' => -1,
    'meta_query' => array(
        array(
            'key' => 'registered_players_%_email',
            'value' => $user_email,
            'compare' => '='
        )
    )
));

// Get all playdates where this user is on waitlist
$waitlisted_playdates = get_posts(array(
    'post_type' => 'playdate',
    'posts_per_page' => -1,
    'meta_query' => array(
        array(
            'key' => 'waitlist_%_email',
            'value' => $user_email,
            'compare' => '='
        )
    )
));
?>

<div class="min-h-screen bg-gray-50 py-16 md:py-24">
    <div class="container mx-auto px-[5%]">
        <h1 class="mb-12 text-4xl font-bold md:text-5xl lg:text-6xl">My Playdates</h1>

        <?php if (!empty($registered_playdates)) : ?>
            <div class="mb-16">
                <h2 class="mb-8 text-4xl font-bold md:text-5xl lg:text-6xl">Registered Events</h2>
                <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                    <?php foreach ($registered_playdates as $playdate) : 
                        $date = get_field('playdate_details_date', $playdate->ID);
                        $location = get_field('playdate_details_location', $playdate->ID);
                        $tee_time = get_field('playdate_details_tee_time_start', $playdate->ID);
                        
                        // Get the featured image
                        if (have_rows('media', $playdate->ID)) {
                            while (have_rows('media', $playdate->ID)) {
                                the_row();
                                $featured_image = get_sub_field('featured_image');
                            }
                        }
                    ?>
                        <div class="overflow-hidden rounded-lg bg-white shadow-sm transition hover:shadow-md">
                            <?php if ($featured_image) : ?>
                                <div class="aspect-video">
                                    <img src="<?php echo esc_url($featured_image['url']); ?>" 
                                         alt="<?php echo esc_attr($featured_image['alt']); ?>"
                                         class="h-full w-full object-cover" />
                                </div>
                            <?php endif; ?>
                            
                            <div class="p-6">
                                <h3 class="mb-4 text-xl font-bold">
                                    <a href="<?php echo get_permalink($playdate->ID); ?>" 
                                       class="hover:text-[#269763]">
                                        <?php echo get_the_title($playdate->ID); ?>
                                    </a>
                                </h3>
                                
                                <div class="space-y-2 text-sm text-gray-600">
                                    <?php if ($date) : ?>
                                        <div class="flex items-center gap-2">
                                            <i data-lucide="calendar" class="h-4 w-4"></i>
                                            <span><?php echo esc_html($date); ?></span>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <?php if ($tee_time) : ?>
                                        <div class="flex items-center gap-2">
                                            <i data-lucide="clock" class="h-4 w-4"></i>
                                            <span><?php echo esc_html($tee_time); ?></span>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <?php if ($location) : ?>
                                        <div class="flex items-center gap-2">
                                            <i data-lucide="map-pin" class="h-4 w-4"></i>
                                            <span><?php echo esc_html($location); ?></span>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <div class="mt-4">
                                    <a href="<?php echo get_permalink($playdate->ID); ?>" 
                                       class="inline-flex items-center gap-2 text-sm font-medium text-[#269763] hover:text-[#1a724a]">
                                        View Details
                                        <i data-lucide="arrow-right" class="h-4 w-4"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>

        <?php if (!empty($waitlisted_playdates)) : ?>
            <div>
                <h2 class="mb-8 text-4xl font-bold md:text-5xl lg:text-6xl">Waitlisted Events</h2>
                <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                    <?php foreach ($waitlisted_playdates as $playdate) : 
                        $date = get_field('playdate_details_date', $playdate->ID);
                        $location = get_field('playdate_details_location', $playdate->ID);
                        $tee_time = get_field('playdate_details_tee_time_start', $playdate->ID);
                        
                        // Get the featured image
                        if (have_rows('media', $playdate->ID)) {
                            while (have_rows('media', $playdate->ID)) {
                                the_row();
                                $featured_image = get_sub_field('featured_image');
                            }
                        }
                    ?>
                        <div class="overflow-hidden rounded-lg bg-white shadow-sm transition hover:shadow-md">
                            <?php if ($featured_image) : ?>
                                <div class="aspect-video">
                                    <img src="<?php echo esc_url($featured_image['url']); ?>" 
                                         alt="<?php echo esc_attr($featured_image['alt']); ?>"
                                         class="h-full w-full object-cover" />
                                </div>
                            <?php endif; ?>
                            
                            <div class="p-6">
                                <div class="mb-4 flex items-center justify-between">
                                    <h3 class="text-xl font-bold">
                                        <a href="<?php echo get_permalink($playdate->ID); ?>" 
                                           class="hover:text-[#269763]">
                                            <?php echo get_the_title($playdate->ID); ?>
                                        </a>
                                    </h3>
                                    <span class="rounded-full bg-[#f59e0b]/10 px-3 py-1 text-sm font-medium text-[#f59e0b]">
                                        Waitlisted
                                    </span>
                                </div>
                                
                                <div class="space-y-2 text-sm text-gray-600">
                                    <?php if ($date) : ?>
                                        <div class="flex items-center gap-2">
                                            <i data-lucide="calendar" class="h-4 w-4"></i>
                                            <span><?php echo esc_html($date); ?></span>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <?php if ($tee_time) : ?>
                                        <div class="flex items-center gap-2">
                                            <i data-lucide="clock" class="h-4 w-4"></i>
                                            <span><?php echo esc_html($tee_time); ?></span>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <?php if ($location) : ?>
                                        <div class="flex items-center gap-2">
                                            <i data-lucide="map-pin" class="h-4 w-4"></i>
                                            <span><?php echo esc_html($location); ?></span>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <div class="mt-4">
                                    <a href="<?php echo get_permalink($playdate->ID); ?>" 
                                       class="inline-flex items-center gap-2 text-sm font-medium text-[#269763] hover:text-[#1a724a]">
                                        View Details
                                        <i data-lucide="arrow-right" class="h-4 w-4"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>

        <?php if (empty($registered_playdates) && empty($waitlisted_playdates)) : ?>
            <div class="rounded-lg bg-white p-8 text-center">
                <div class="mb-4 inline-flex size-16 items-center justify-center rounded-full bg-gray-100">
                    <i data-lucide="calendar-x" class="h-8 w-8 text-gray-400"></i>
                </div>
                <h2 class="mb-2 text-xl font-bold">No Playdates Found</h2>
                <p class="mb-6 text-gray-600">You haven't registered for any playdates yet.</p>
                <a href="<?php echo home_url('/playdates'); ?>" 
                   class="inline-flex items-center gap-2 rounded-md bg-[#269763] px-6 py-3 text-white hover:bg-[#1a724a]">
                    Browse Available Playdates
                    <i data-lucide="arrow-right" class="h-5 w-5"></i>
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php get_footer(); ?>
