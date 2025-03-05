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
                    <?php 
                    $current_status = get_field('current_status');
                    $spots_remaining = get_field('spots_remaining');
                    if (!$spots_remaining && $spots_remaining !== '0' && $spots_remaining !== 0) {
                        $spots_remaining = get_field('spots_available');
                    }
                    $waitlist_available = $current_status['waitlist_available'] ?? false;
                    
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
                                        <span class="font-medium"><?php echo esc_attr(get_sub_field('location')); ?></span>
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

    <section class="px-[5%] py-16 md:py-24">
        <div class="container mx-auto">
            <div class="grid grid-cols-1 gap-12 lg:grid-cols-[2fr_1fr]">
                <!-- Left Column -->
                <div>
                    <!-- Course Information -->
                    <?php if (have_rows('media')) : ?>
                        <?php while (have_rows('media')) : the_row(); 
                            $course_logo = get_sub_field('course_logo');
                            $course_photos = get_sub_field('course_photos');
                        ?>
                            <?php if ($course_logo || $course_photos) : ?>
                                <div class="mb-12">
                                    <?php if ($course_logo) : ?>
                                        <div class="mb-8 flex justify-center">
                                            <img src="<?php echo esc_url($course_logo['url']); ?>" 
                                                 alt="<?php echo esc_attr($course_logo['alt']); ?>"
                                                 class="max-h-32 w-auto" />
                                        </div>
                                    <?php endif; ?>

                                    <?php if ($course_photos) : ?>
                                        <div class="grid grid-cols-2 gap-4 md:grid-cols-3">
                                            <?php foreach ($course_photos as $photo) : ?>
                                                <div class="aspect-video overflow-hidden rounded-lg">
                                                    <img src="<?php echo esc_url($photo['url']); ?>" 
                                                         alt="<?php echo esc_attr($photo['alt']); ?>"
                                                         class="h-full w-full object-cover" />
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        <?php endwhile; ?>
                    <?php endif; ?>

                    <!-- Event Description -->
                    <?php if (have_rows('playdate_details')) : ?>
                        <?php while (have_rows('playdate_details')) : the_row(); ?>
                            <?php if (get_sub_field('description')) : ?>
                                <div class="mb-12">
                                    <h2 class="mb-8 text-4xl font-bold md:text-5xl lg:text-6xl">About This Event</h2>
                                    <div class="prose max-w-none">
                                        <?php echo get_sub_field('description'); ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endwhile; ?>
                    <?php endif; ?>

                    <!-- What to Bring -->
                    <?php if (have_rows('equipment_requirements')) : ?>
                        <div class="mb-12">
                            <h2 class="mb-8 text-4xl font-bold md:text-5xl lg:text-6xl">What to Bring</h2>
                            <div class="grid gap-4 sm:grid-cols-2">
                                <?php while (have_rows('equipment_requirements')) : the_row(); ?>
                                    <div class="flex items-start gap-4 rounded-lg border border-gray-100 bg-white p-6">
                                        <div class="flex size-10 shrink-0 items-center justify-center rounded-full <?php echo get_sub_field('required') ? 'bg-[#269763]/10 text-[#269763]' : 'bg-gray-100 text-gray-500'; ?>">
                                            <i data-lucide="<?php echo get_sub_field('required') ? 'check' : 'minus'; ?>" class="size-5"></i>
                                        </div>
                                        <div>
                                            <h3 class="font-semibold"><?php the_sub_field('item'); ?></h3>
                                            <p class="mt-1 text-sm text-gray-600"><?php the_sub_field('description'); ?></p>
                                        </div>
                                    </div>
                                <?php endwhile; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Rules & Policies -->
                    <?php if (have_rows('rules_and_policies')) : ?>
                        <?php while (have_rows('rules_and_policies')) : the_row(); ?>
                            <?php if (get_sub_field('rules') || get_sub_field('weather_policy') || get_sub_field('cancellation_policy')) : ?>
                                <div class="mb-12">
                                    <h2 class="mb-8 text-4xl font-bold md:text-5xl lg:text-6xl">Rules & Policies</h2>
                                    <div class="grid gap-8">
                                        <?php if (get_sub_field('rules')) : ?>
                                            <div class="rounded-xl border border-gray-100 bg-white p-8">
                                                <h3 class="mb-4 text-xl font-bold">Rules & Guidelines</h3>
                                                <div class="prose max-w-none">
                                                    <?php echo get_sub_field('rules'); ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>

                                        <div class="grid gap-8 md:grid-cols-2">
                                            <?php if (get_sub_field('weather_policy')) : ?>
                                                <div class="rounded-xl border border-gray-100 bg-white p-8">
                                                    <div class="mb-4 flex items-center gap-3">
                                                        <i data-lucide="cloud-rain" class="h-6 w-6 text-[#269763]"></i>
                                                        <h3 class="text-xl font-bold">Weather Policy</h3>
                                                    </div>
                                                    <div class="prose max-w-none">
                                                        <?php echo get_sub_field('weather_policy'); ?>
                                                    </div>
                                                </div>
                                            <?php endif; ?>

                                            <?php if (get_sub_field('cancellation_policy')) : ?>
                                                <div class="rounded-xl border border-gray-100 bg-white p-8">
                                                    <div class="mb-4 flex items-center gap-3">
                                                        <i data-lucide="x-circle" class="h-6 w-6 text-[#269763]"></i>
                                                        <h3 class="text-xl font-bold">Cancellation Policy</h3>
                                                    </div>
                                                    <div class="prose max-w-none">
                                                        <?php echo get_sub_field('cancellation_policy'); ?>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>

                <!-- Right Column -->
                <div>
                    <!-- Registration Info -->
                    <?php if (have_rows('registration_details')) : ?>
                        <?php while (have_rows('registration_details')) : the_row(); ?>
                            <div class="sticky top-8">
                                <div class="rounded-lg bg-gray-50 p-8">
                                    <h3 class="mb-6 text-2xl font-bold">Registration Details</h3>

                                    <?php if (get_sub_field('payment_method')) : ?>
                                        <div class="mb-6">
                                            <span class="text-sm font-medium text-gray-600">Payment Method</span>
                                            <p class="mt-1"><?php echo esc_html(get_sub_field('payment_method')); ?></p>
                                        </div>
                                    <?php endif; ?>

                                    <?php if (get_sub_field('registration_deadline')) : ?>
                                        <div class="mb-6">
                                            <span class="text-sm font-medium text-gray-600">Registration Deadline</span>
                                            <p class="mt-1"><?php echo esc_html(get_sub_field('registration_deadline')); ?></p>
                                        </div>
                                    <?php endif; ?>

                                    <?php if (get_sub_field('registration_instructions')) : ?>
                                        <div class="mb-6">
                                            <span class="text-sm font-medium text-gray-600">Instructions</span>
                                            <div class="mt-1 prose max-w-none">
                                                <?php echo wp_kses_post(get_sub_field('registration_instructions')); ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <?php if (have_rows('included_items')) : ?>
                                        <?php while (have_rows('included_items')) : the_row(); ?>
                                            <?php if (get_sub_field('golf_gift')) : ?>
                                                <div class="mb-6">
                                                    <span class="text-sm font-medium text-gray-600">Golf Gift</span>
                                                    <p class="mt-1"><?php echo esc_html(get_sub_field('golf_gift')); ?></p>
                                                </div>
                                            <?php endif; ?>

                                            <?php if (have_rows('additional_inclusions')) : ?>
                                                <div class="mb-6">
                                                    <span class="text-sm font-medium text-gray-600">Additional Inclusions</span>
                                                    <ul class="mt-2 space-y-2">
                                                        <?php while (have_rows('additional_inclusions')) : the_row(); ?>
                                                            <li class="flex items-start gap-2">
                                                                <i data-lucide="check" class="mt-1 h-4 w-4 text-[#269763]"></i>
                                                                <div>
                                                                    <strong><?php echo esc_html(get_sub_field('item_name')); ?></strong>
                                                                    <?php if (get_sub_field('item_description')) : ?>
                                                                        <p class="text-sm text-gray-600"><?php echo esc_html(get_sub_field('item_description')); ?></p>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </li>
                                                        <?php endwhile; ?>
                                                    </ul>
                                                </div>
                                            <?php endif; ?>
                                        <?php endwhile; ?>
                                    <?php endif; ?>

                                    <?php if ($spots_remaining > 0) : ?>
                                        <button type="button"
                                           class="inline-flex w-full items-center justify-center rounded-md bg-[#269763] px-6 py-3 text-center font-semibold text-white hover:bg-[#1a724a] focus:outline-none focus:ring-2 focus:ring-[#269763] focus:ring-offset-2"
                                           onclick="document.getElementById('registration-section').scrollIntoView({ behavior: 'smooth' });">
                                            Register Now
                                            <i data-lucide="arrow-right" class="ml-2 h-5 w-5"></i>
                                        </button>
                                    <?php elseif ($waitlist_available) : ?>
                                        <button type="button"
                                           class="inline-flex w-full items-center justify-center rounded-md bg-[#f59e0b] px-6 py-3 text-center font-semibold text-white hover:bg-[#d97706] focus:outline-none focus:ring-2 focus:ring-[#f59e0b] focus:ring-offset-2"
                                           onclick="document.getElementById('waitlist-section').scrollIntoView({ behavior: 'smooth' });">
                                            Join Waitlist
                                        </button>
                                    <?php else : ?>
                                        <button type="button" disabled
                                           class="inline-flex w-full items-center justify-center rounded-md bg-gray-400 px-6 py-3 text-center font-semibold text-white cursor-not-allowed">
                                            Sold Out
                                        </button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

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
<?php get_footer(); ?>