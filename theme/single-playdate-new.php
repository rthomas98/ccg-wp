<?php
/**
 * The template for displaying single playdate posts
 *
 * @package _ccg
 */

get_header();

while (have_posts()) :
    the_post();
    
    // Get current status
    $spots_remaining = 0;
    $waitlist_available = false;
    if (have_rows('current_status')) :
        while (have_rows('current_status')) : the_row();
            $spots_remaining = get_sub_field('spots_remaining');
            $waitlist_available = get_sub_field('waitlist_available');
        endwhile;
    endif;
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
                        <?php if (have_rows('current_status')) : ?>
                            <?php while (have_rows('current_status')) : the_row(); ?>
                                <?php
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
                                ?>
                                <span class="mb-6 inline-block rounded-full <?php echo $status_class; ?> px-4 py-2 text-sm font-semibold uppercase tracking-wider text-white shadow-lg">
                                    <?php echo esc_html($status_text); ?>
                                </span>
                            <?php endwhile; ?>
                        <?php endif; ?>

                        <h1 class="mb-8 text-5xl font-bold text-white md:text-6xl lg:text-7xl">
                            <?php the_title(); ?>
                        </h1>

                        <?php if (have_rows('playdate_details')) : ?>
                            <?php while (have_rows('playdate_details')) : the_row(); ?>
                                <div class="flex flex-wrap items-center gap-8 text-lg text-white/90">
                                    <?php if (get_sub_field('date')) : ?>
                                        <div class="flex items-center gap-3">
                                            <i data-lucide="calendar" class="h-6 w-6 text-[#269763]"></i>
                                            <span class="font-medium"><?php echo esc_html(get_sub_field('date')); ?></span>
                                        </div>
                                    <?php endif; ?>

                                    <?php if (get_sub_field('tee_time_start')) : ?>
                                        <div class="flex items-center gap-3">
                                            <i data-lucide="clock" class="h-6 w-6 text-[#269763]"></i>
                                            <span class="font-medium"><?php echo esc_html(get_sub_field('tee_time_start')); ?></span>
                                        </div>
                                    <?php endif; ?>

                                    <?php if (get_sub_field('location')) : ?>
                                        <div class="flex items-center gap-3">
                                            <i data-lucide="map-pin" class="h-6 w-6 text-[#269763]"></i>
                                            <span class="font-medium"><?php echo esc_html(get_sub_field('location')); ?></span>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <?php if (get_sub_field('course_address')) : ?>
                                    <div class="mt-4 text-base text-white/80">
                                        <p><?php echo esc_html(get_sub_field('course_address')); ?></p>
                                    </div>
                                <?php endif; ?>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main Content -->
        <div class="container mx-auto px-4 py-12">
            <!-- Pricing Information -->
            <?php if (have_rows('pricing_information')) : ?>
                <?php while (have_rows('pricing_information')) : the_row(); ?>
                    <div class="mb-12 rounded-lg bg-gray-50 p-8">
                        <h2 class="mb-6 text-4xl font-bold md:text-5xl lg:text-6xl">Pricing</h2>
                        <div class="grid gap-6 md:grid-cols-2">
                            <div class="rounded-lg bg-white p-6 shadow-sm">
                                <h3 class="mb-2 text-xl font-semibold">Double Rider</h3>
                                <p class="text-3xl font-bold text-[#269763]">$<?php echo esc_html(get_sub_field('double_rider_price')); ?></p>
                            </div>
                            <div class="rounded-lg bg-white p-6 shadow-sm">
                                <h3 class="mb-2 text-xl font-semibold">Single Rider</h3>
                                <p class="text-3xl font-bold text-[#269763]">$<?php echo esc_html(get_sub_field('single_rider_price')); ?></p>
                            </div>
                        </div>

                        <?php if (have_rows('price_includes')) : ?>
                            <div class="mt-6">
                                <h3 class="mb-4 text-xl font-semibold">Price Includes:</h3>
                                <ul class="grid gap-2 md:grid-cols-2">
                                    <?php while (have_rows('price_includes')) : the_row(); ?>
                                        <li class="flex items-center gap-2">
                                            <i data-lucide="check" class="h-5 w-5 text-[#269763]"></i>
                                            <?php echo esc_html(get_sub_field('item')); ?>
                                        </li>
                                    <?php endwhile; ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <?php if (have_rows('additional_fees')) : ?>
                            <div class="mt-6">
                                <h3 class="mb-4 text-xl font-semibold">Additional Fees:</h3>
                                <ul class="grid gap-2 md:grid-cols-2">
                                    <?php while (have_rows('additional_fees')) : the_row(); ?>
                                        <li class="flex items-center gap-2">
                                            <i data-lucide="alert-circle" class="h-5 w-5 text-[#f59e0b]"></i>
                                            <?php echo esc_html(get_sub_field('fee_type')); ?>
                                        </li>
                                    <?php endwhile; ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>

            <!-- Additional Information -->
            <?php if (have_rows('additional_information')) : ?>
                <?php while (have_rows('additional_information')) : the_row(); ?>
                    <div class="mb-12">
                        <h2 class="mb-8 text-4xl font-bold md:text-5xl lg:text-6xl">Additional Information</h2>
                        
                        <?php if (get_sub_field('format')) : ?>
                            <div class="mb-6">
                                <h3 class="mb-3 text-xl font-semibold">Format</h3>
                                <div class="prose max-w-none">
                                    <?php echo wp_kses_post(get_sub_field('format')); ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if (get_sub_field('weather_policy')) : ?>
                            <div class="mb-6">
                                <h3 class="mb-3 text-xl font-semibold">Weather Policy</h3>
                                <div class="prose max-w-none">
                                    <?php echo wp_kses_post(get_sub_field('weather_policy')); ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if (get_sub_field('cancellation_policy')) : ?>
                            <div class="mb-6">
                                <h3 class="mb-3 text-xl font-semibold">Cancellation Policy</h3>
                                <div class="prose max-w-none">
                                    <?php echo wp_kses_post(get_sub_field('cancellation_policy')); ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if (get_sub_field('special_notes')) : ?>
                            <div class="rounded-lg bg-gray-50 p-6">
                                <h3 class="mb-3 text-xl font-semibold">Special Notes</h3>
                                <div class="prose max-w-none">
                                    <?php echo wp_kses_post(get_sub_field('special_notes')); ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>

            <!-- Contact Information -->
            <?php if (have_rows('contact_info')) : ?>
                <div class="mb-12 rounded-lg bg-gray-50 p-8">
                    <h2 class="mb-8 text-4xl font-bold md:text-5xl lg:text-6xl">Contact Information</h2>
                    <div class="grid gap-8 md:grid-cols-2">
                        <?php while (have_rows('contact_info')) : the_row(); ?>
                            <div>
                                <h3 class="mb-6 text-xl font-semibold">Organizer</h3>
                                <ul class="space-y-4">
                                    <?php if (get_sub_field('organizer_name')) : ?>
                                        <li class="flex items-center gap-3">
                                            <i data-lucide="user" class="h-5 w-5 text-[#269763]"></i>
                                            <span><?php echo esc_html(get_sub_field('organizer_name')); ?></span>
                                        </li>
                                    <?php endif; ?>
                                    
                                    <?php if (get_sub_field('organizer_email')) : ?>
                                        <li>
                                            <a href="mailto:<?php echo esc_attr(get_sub_field('organizer_email')); ?>" 
                                               class="flex items-center gap-3 text-[#269763] transition hover:text-[#1a724a]">
                                                <i data-lucide="mail" class="h-5 w-5"></i>
                                                <span><?php echo esc_html(get_sub_field('organizer_email')); ?></span>
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                    
                                    <?php if (get_sub_field('organizer_phone')) : ?>
                                        <li>
                                            <a href="tel:<?php echo esc_attr(get_sub_field('organizer_phone')); ?>"
                                               class="flex items-center gap-3 text-[#269763] transition hover:text-[#1a724a]">
                                                <i data-lucide="phone" class="h-5 w-5"></i>
                                                <span><?php echo esc_html(get_sub_field('organizer_phone')); ?></span>
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </div>

                            <?php if (get_sub_field('emergency_contact')) : ?>
                                <div>
                                    <h3 class="mb-6 text-xl font-semibold">Emergency Contact</h3>
                                    <div class="flex items-center gap-3">
                                        <i data-lucide="phone-call" class="h-5 w-5 text-[#f59e0b]"></i>
                                        <span><?php echo esc_html(get_sub_field('emergency_contact')); ?></span>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endwhile; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Registration Form -->
        <?php if ($spots_remaining > 0) : ?>
            <section id="registration-section" class="bg-gray-50 px-[5%] py-16 md:py-24">
                <div class="container mx-auto max-w-[50%]">
                    <div class="mb-12 text-center">
                        <h2 class="text-4xl font-bold md:text-5xl lg:text-6xl">Register for this Playdate</h2>
                        <p class="mt-4 text-gray-600">Fill out the form below to secure your spot</p>
                    </div>
                    <?php 
                    // Include registration form
                    require_once get_template_directory() . '/template-parts/forms/playdate-registration-form.php';
                    ?>
                </div>
            </section>
        <?php endif; ?>

        <!-- Waitlist Form -->
        <?php if (!$spots_remaining && $waitlist_available) : ?>
            <section id="waitlist-section" class="bg-gray-50 px-[5%] py-16 md:py-24">
                <div class="container mx-auto max-w-[50%]">
                    <div class="mb-12 text-center">
                        <h2 class="text-4xl font-bold md:text-5xl lg:text-6xl">Join the Waitlist</h2>
                        <p class="mt-4 text-gray-600">Fill out the form below to join the waitlist for this playdate</p>
                    </div>
                    <?php 
                    // Include waitlist form
                    require_once get_template_directory() . '/template-parts/forms/playdate-waitlist-form.php';
                    ?>
                </div>
            </section>
        <?php endif; ?>
    </article>

<?php
endwhile;
get_footer();
