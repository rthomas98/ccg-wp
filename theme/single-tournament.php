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
                                <?php if (get_sub_field('tournament_date')) : ?>
                                    <div class="flex items-center gap-3">
                                        <i data-lucide="calendar" class="h-6 w-6 text-[#269763]"></i>
                                        <span class="font-medium"><?php echo esc_html(get_sub_field('tournament_date')); ?></span>
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
                            </div>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Tournament Schedule -->
    <?php if (have_rows('tournament_schedule')) : ?>
        <section class="bg-gray-50 px-[5%] py-16 md:py-24">
            <div class="container mx-auto">
                <h2 class="mb-12 text-center text-4xl font-bold md:text-5xl lg:text-6xl">Tournament Schedule</h2>
                <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
                    <?php while (have_rows('tournament_schedule')) : the_row(); ?>
                        <div class="rounded-xl border border-gray-100 bg-white p-8 transition-transform hover:scale-105">
                            <div class="mb-4 inline-flex rounded-lg bg-[#269763]/10 p-3">
                                <i data-lucide="clock" class="h-6 w-6 text-[#269763]"></i>
                            </div>
                            <h3 class="mb-3 text-xl font-bold">Check-in Time</h3>
                            <p class="text-lg text-gray-600"><?php echo esc_html(get_sub_field('check-in_time')); ?></p>
                        </div>
                        <div class="rounded-xl border border-gray-100 bg-white p-8 transition-transform hover:scale-105">
                            <div class="mb-4 inline-flex rounded-lg bg-[#269763]/10 p-3">
                                <i data-lucide="play" class="h-6 w-6 text-[#269763]"></i>
                            </div>
                            <h3 class="mb-3 text-xl font-bold">Start Time</h3>
                            <p class="text-lg text-gray-600"><?php echo esc_html(get_sub_field('start_time')); ?></p>
                        </div>
                        <div class="rounded-xl border border-gray-100 bg-white p-8 transition-transform hover:scale-105">
                            <div class="mb-4 inline-flex rounded-lg bg-[#269763]/10 p-3">
                                <i data-lucide="layout-grid" class="h-6 w-6 text-[#269763]"></i>
                            </div>
                            <h3 class="mb-3 text-xl font-bold">Format</h3>
                            <p class="text-lg text-gray-600"><?php echo esc_html(get_sub_field('format')); ?></p>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <!-- Main Content -->
    <section class="px-[5%] py-16 md:py-24">
        <div class="container mx-auto">
            <div class="grid grid-cols-1 gap-12 lg:grid-cols-[2fr_1fr]">
                <!-- Left Column -->
                <div>
                    <!-- Tournament Features -->
                    <?php if (have_rows('tournament_features')) : ?>
                        <div class="mb-16">
                            <h2 class="mb-8 text-4xl font-bold md:text-5xl lg:text-6xl">Tournament Features</h2>
                            <?php while (have_rows('tournament_features')) : the_row(); ?>
                                <?php if (have_rows('prizes')) : ?>
                                    <div class="grid gap-8 md:grid-cols-2">
                                        <?php while (have_rows('prizes')) : the_row(); ?>
                                            <div class="rounded-lg bg-gray-50 p-6">
                                                <h3 class="mb-4 text-xl font-bold"><?php echo esc_html(get_sub_field('prize_category')); ?></h3>
                                                <p class="mb-2"><?php echo wp_kses_post(get_sub_field('prize_description')); ?></p>
                                                <?php if (get_sub_field('prize_value')) : ?>
                                                    <p class="text-[#269763] font-semibold">Value: <?php echo esc_html(get_sub_field('prize_value')); ?></p>
                                                <?php endif; ?>
                                            </div>
                                        <?php endwhile; ?>
                                    </div>
                                <?php endif; ?>
                            <?php endwhile; ?>
                        </div>
                    <?php endif; ?>

                    <!-- Additional Information -->
                    <?php if (have_rows('additional_information')) : ?>
                        <?php while (have_rows('additional_information')) : the_row(); ?>
                            <?php if (get_sub_field('rules_and_regulations')) : ?>
                                <div class="mb-12">
                                    <h2 class="mb-8 text-4xl font-bold md:text-5xl lg:text-6xl">Rules & Regulations</h2>
                                    <div class="rounded-xl border border-gray-100 bg-white p-8">
                                        <div class="mb-6 flex items-center gap-3">
                                            <div class="inline-flex rounded-lg bg-[#269763]/10 p-3">
                                                <i data-lucide="scroll" class="h-6 w-6 text-[#269763]"></i>
                                            </div>
                                            <p class="text-lg font-medium text-gray-600">Please review all tournament rules and regulations carefully</p>
                                        </div>
                                        <div class="prose max-w-none">
                                            <?php echo wp_kses_post(get_sub_field('rules_and_regulations')); ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php if (have_rows('what_to_bring')) : ?>
                                <div class="mb-12">
                                    <h2 class="mb-8 text-4xl font-bold md:text-5xl lg:text-6xl">What to Bring</h2>
                                    <div class="rounded-xl border border-gray-100 bg-white p-8">
                                        <div class="grid gap-6 md:grid-cols-2">
                                            <?php while (have_rows('what_to_bring')) : the_row(); ?>
                                                <div class="flex items-start gap-4">
                                                    <div class="mt-1 inline-flex rounded-lg bg-[#269763]/10 p-2">
                                                        <i data-lucide="check-circle" class="h-5 w-5 text-[#269763]"></i>
                                                    </div>
                                                    <div>
                                                        <p class="mb-1 text-lg font-semibold"><?php echo esc_html(get_sub_field('item')); ?></p>
                                                        <?php 
                                                        $status = get_sub_field('required_or_optional');
                                                        $status_class = strtolower($status) === 'required' ? 'bg-red-100 text-red-700' : 'bg-gray-100 text-gray-600';
                                                        ?>
                                                        <span class="inline-block rounded-full px-3 py-1 text-sm font-medium <?php echo $status_class; ?>">
                                                            <?php echo esc_html($status); ?>
                                                        </span>
                                                    </div>
                                                </div>
                                            <?php endwhile; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php if (get_sub_field('weather_policy') || get_sub_field('cancellation_policy')) : ?>
                                <div class="mb-12">
                                    <h2 class="mb-8 text-4xl font-bold md:text-5xl lg:text-6xl">Policies</h2>
                                    <div class="grid gap-8 md:grid-cols-2">
                                        <?php if (get_sub_field('weather_policy')) : ?>
                                            <div class="rounded-xl border border-gray-100 bg-white p-8">
                                                <div class="mb-6 flex items-center gap-3">
                                                    <div class="inline-flex rounded-lg bg-[#269763]/10 p-3">
                                                        <i data-lucide="cloud-rain" class="h-6 w-6 text-[#269763]"></i>
                                                    </div>
                                                    <h3 class="text-2xl font-bold">Weather Policy</h3>
                                                </div>
                                                <div class="prose max-w-none">
                                                    <?php echo wp_kses_post(get_sub_field('weather_policy')); ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        <?php if (get_sub_field('cancellation_policy')) : ?>
                                            <div class="rounded-xl border border-gray-100 bg-white p-8">
                                                <div class="mb-6 flex items-center gap-3">
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
                                </div>
                            <?php endif; ?>
                        <?php endwhile; ?>
                    <?php endif; ?>

                    <!-- Tournament Results -->
                    <?php if (have_rows('tournament_results')) : ?>
                        <?php while (have_rows('tournament_results')) : the_row(); ?>
                            <div class="mb-12">
                                <h2 class="mb-8 text-4xl font-bold md:text-5xl lg:text-6xl">Tournament Results</h2>
                                
                                <?php if (have_rows('winners')) : ?>
                                    <div class="mb-12 grid gap-6 md:grid-cols-2">
                                        <?php while (have_rows('winners')) : the_row(); ?>
                                            <div class="rounded-xl border border-gray-100 bg-white p-8 transition-transform hover:scale-105">
                                                <div class="mb-4 inline-flex rounded-lg bg-[#269763]/10 p-3">
                                                    <i data-lucide="trophy" class="h-6 w-6 text-[#269763]"></i>
                                                </div>
                                                <h3 class="mb-6 text-2xl font-bold"><?php echo esc_html(get_sub_field('category')); ?></h3>
                                                <div class="space-y-4 text-lg">
                                                    <div class="flex items-center gap-2">
                                                        <i data-lucide="user" class="h-5 w-5 text-gray-400"></i>
                                                        <p><span class="font-medium">Winner:</span> <?php echo esc_html(get_sub_field('player_name')); ?></p>
                                                    </div>
                                                    <div class="flex items-center gap-2">
                                                        <i data-lucide="target" class="h-5 w-5 text-gray-400"></i>
                                                        <p><span class="font-medium">Score:</span> <?php echo esc_html(get_sub_field('scoreresult')); ?></p>
                                                    </div>
                                                    <div class="flex items-center gap-2">
                                                        <i data-lucide="award" class="h-5 w-5 text-gray-400"></i>
                                                        <p><span class="font-medium">Prize:</span> <?php echo esc_html(get_sub_field('prize_won')); ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endwhile; ?>
                                    </div>
                                <?php endif; ?>

                                <?php if (get_sub_field('tournament_recap')) : ?>
                                    <div class="prose max-w-none">
                                        <h3 class="mb-6 text-2xl font-bold">Tournament Recap</h3>
                                        <?php echo wp_kses_post(get_sub_field('tournament_recap')); ?>
                                    </div>
                                <?php endif; ?>

                                <?php $final_leaderboard = get_sub_field('final_leaderboard'); ?>
                                <?php if ($final_leaderboard) : ?>
                                    <a href="<?php echo esc_url($final_leaderboard['url']); ?>" 
                                       class="mt-8 inline-flex items-center gap-3 rounded-lg bg-[#269763]/10 px-4 py-3 text-[#269763] transition-colors hover:bg-[#269763]/20">
                                        <i data-lucide="file-text" class="h-5 w-5"></i>
                                        <span class="font-medium">View Final Leaderboard</span>
                                    </a>
                                <?php endif; ?>
                            </div>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>

                <!-- Right Column -->
                <div>
                    <!-- Registration Info -->
                    <?php if (have_rows('registration_info')) : ?>
                        <?php while (have_rows('registration_info')) : the_row(); ?>
                            <div class="sticky top-8">
                                <div class="rounded-lg bg-gray-50 p-8">
                                    <h3 class="mb-6 text-2xl font-bold">Registration Details</h3>

                                    <?php if (get_sub_field('registration_fee')) : ?>
                                        <div class="mb-6">
                                            <span class="text-sm font-medium text-gray-600">Registration Fee</span>
                                            <p class="mt-1 text-3xl font-bold text-[#269763]">$<?php echo esc_html(get_sub_field('registration_fee')); ?></p>
                                        </div>
                                    <?php endif; ?>

                                    <?php if (get_sub_field('registration_deadline')) : ?>
                                        <div class="mb-6">
                                            <span class="text-sm font-medium text-gray-600">Registration Deadline</span>
                                            <p class="mt-1"><?php echo esc_html(get_sub_field('registration_deadline')); ?></p>
                                        </div>
                                    <?php endif; ?>

                                    <?php if (get_sub_field('spots_available')) : ?>
                                        <div class="mb-6">
                                            <span class="text-sm font-medium text-gray-600">Spots Available</span>
                                            <p class="mt-1"><?php echo esc_html(get_sub_field('spots_available')); ?> spots remaining</p>
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

                                    <?php if (have_rows('whats_included')) : ?>
                                        <div class="mb-6">
                                            <span class="text-sm font-medium text-gray-600">What's Included</span>
                                            <ul class="mt-2 space-y-2">
                                                <?php while (have_rows('whats_included')) : the_row(); ?>
                                                    <li class="flex items-start gap-2">
                                                        <i data-lucide="check" class="mt-1 h-4 w-4 text-[#269763]"></i>
                                                        <span><?php echo esc_html(get_sub_field('item')); ?></span>
                                                    </li>
                                                <?php endwhile; ?>
                                            </ul>
                                        </div>
                                    <?php endif; ?>

                                    <?php 
                                    $spots_available = get_sub_field('spots_available');
                                    if ($spots_available > 0) : ?>
                                        <button type="button"
                                           class="inline-flex w-full items-center justify-center rounded-md bg-[#269763] px-6 py-3 text-center font-semibold text-white hover:bg-[#1a724a] focus:outline-none focus:ring-2 focus:ring-[#269763] focus:ring-offset-2"
                                           onclick="document.getElementById('registration-section').scrollIntoView({ behavior: 'smooth' });">
                                            Register Now
                                            <i data-lucide="arrow-right" class="ml-2 h-5 w-5"></i>
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
    <?php if (have_rows('registration_info')) : ?>
        <?php while (have_rows('registration_info')) : the_row(); ?>
            <?php if (get_sub_field('spots_available') > 0) : ?>
                <section id="registration-section" class="bg-gray-50 px-[5%] py-16 md:py-24">
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

    <!-- Gallery -->
    <?php if (have_rows('media')) : ?>
        <?php while (have_rows('media')) : the_row(); ?>
            <?php if (get_sub_field('gallery')) : ?>
                <section class="px-[5%] py-16 md:py-24 lg:py-28">
                    <div class="container">
                        <div class="mb-12 text-center md:mb-18 lg:mb-20">
                            <h2 class="mb-5 text-5xl font-bold md:mb-6 md:text-7xl lg:text-8xl">Gallery</h2>
                            <p class="md:text-md">View our tournament gallery</p>
                        </div>
                        <div class="grid auto-cols-fr grid-cols-2 grid-rows-2 gap-6 md:auto-cols-auto md:grid-cols-[2fr_1fr_1fr] md:gap-8">
                            <?php 
                            $images = get_sub_field('gallery');
                            foreach ($images as $index => $image) : ?>
                                <a href="<?php echo esc_url($image['url']); ?>" 
                                   class="inline-block size-full <?php echo $index === 0 ? 'col-start-1 col-end-2 row-start-1 row-end-3' : ''; ?>">
                                    <div class="size-full">
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
</article>

<?php get_footer(); ?>
