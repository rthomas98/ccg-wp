<?php
/**
 * Template part for displaying page content in page.php
 *
 * @package _ccg
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php if (have_rows('header_44')) : ?>
        <?php while (have_rows('header_44')) : the_row(); ?>
            <section class="px-[5%] py-16 md:py-24 lg:py-28 bg-[#f6f6f6]">
                <div class="container mx-auto">
                    <div class="w-full max-w-lg">
                        <p class="mb-3 font-semibold md:mb-4">
                            <?php the_sub_field('sub_header'); ?>
                        </p>
                        <h1 class="mb-5 text-5xl font-bold md:mb-6 md:text-5xl lg:text-7xl">
                            <?php the_sub_field('header'); ?>
                        </h1>
                        <p class="md:text-md">
                            <?php the_sub_field('content'); ?>
                        </p>

                        <?php if (have_rows('buttons')) : ?>
                            <div class="mt-6 flex flex-wrap gap-4 md:mt-8">
                                <?php while (have_rows('buttons')) : the_row(); 
                                    $button_one_link = get_sub_field('button_one_link');
                                    $button_two_link = get_sub_field('button_two_link');
                                ?>
                                    <?php if ($button_one_link) : ?>
                                        <a href="<?php echo esc_url($button_one_link); ?>" 
                                           class="inline-flex items-center justify-center rounded-md bg-[#269763] px-6 py-3 text-center font-semibold text-white hover:bg-[#1a724a] focus:outline-none focus:ring-2 focus:ring-[#269763] focus:ring-offset-2">
                                            <?php the_sub_field('button_one_label'); ?>
                                        </a>
                                    <?php endif; ?>
                                    
                                    <?php if ($button_two_link) : ?>
                                        <a href="<?php echo esc_url($button_two_link); ?>" 
                                           class="inline-flex items-center justify-center rounded-md border-2 border-[#269763] bg-transparent px-6 py-3 text-center font-semibold text-[#269763] hover:bg-[#269763] hover:text-white focus:outline-none focus:ring-2 focus:ring-[#269763] focus:ring-offset-2">
                                            <?php the_sub_field('button_two_label'); ?>
                                        </a>
                                    <?php endif; ?>
                                <?php endwhile; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </section>
        <?php endwhile; ?>
    <?php endif; ?>

    <?php
    // Query recent playdates
    $playdates_query = new WP_Query(array(
        'post_type' => 'playdate',
        'posts_per_page' => 5,
        'orderby' => 'meta_value',
        'meta_key' => 'playdate_details_date',
        'order' => 'DESC'
    ));
    ?>

    <section id="relume" class="px-[5%] py-16 md:py-24 lg:py-28">
        <div class="container mx-auto">
            <div class="mx-auto w-full max-w-4xl">
                <div class="mb-12 text-center md:mb-18 lg:mb-20">
                    <h4 class="text-base font-semibold">Playdates</h4>
                    <h1 class="mt-3 text-4xl font-bold md:mt-4 md:text-6xl lg:text-7xl">Events</h1>
                    <p class="mx-auto mt-5 max-w-lg text-base text-gray-600 md:mt-6">
                        Come and be part of our thrilling playdates, where you can enjoy a fantastic mix of golf, 
                        fun activities, and the chance to build lasting friendships with fellow enthusiasts. 
                        We can't wait to see you there!
                    </p>
                </div>

                <div class="flex flex-col justify-start">
                    <?php if ($playdates_query->have_posts()) : ?>
                        <div class="flex flex-col gap-6 md:gap-8">
                            <?php while ($playdates_query->have_posts()) : $playdates_query->the_post(); 
                                $details = get_field('playdate_details');
                                $status = get_field('current_status');
                                $registration = get_field('registration_details');
                                $media = get_field('media');
                                
                                $featured_image = $media['featured_image'] ?? null;
                                $image_url = $featured_image ? $featured_image['url'] : '';
                                
                                $spots_remaining = $status['spots_remaining'] ?? 0;
                                $registration_status = $spots_remaining > 0 ? $spots_remaining . ' spots available' : 'Sold out';
                            ?>
                                <div class="flex flex-col border border-gray-200 md:flex-row">
                                    <a href="<?php the_permalink(); ?>" class="relative aspect-[3/2] w-full shrink-0 md:aspect-auto md:w-48 lg:aspect-square">
                                        <?php if ($featured_image) : ?>
                                            <img src="<?php echo esc_url($image_url); ?>" 
                                                 alt="<?php the_title(); ?>" 
                                                 class="absolute size-full object-cover" />
                                        <?php else : ?>
                                            <div class="absolute inset-0 bg-[#c3c3c3] size-full"></div>
                                        <?php endif; ?>
                                    </a>
                                    <div class="flex w-full flex-col items-start gap-8 p-6 sm:p-8 lg:flex-row lg:items-center">
                                        <div>
                                            <div class="mb-2 flex flex-wrap items-center gap-2 sm:mb-0 sm:gap-4">
                                                <a href="<?php the_permalink(); ?>" class="text-xl font-bold hover:text-[#269763] md:text-2xl">
                                                    <?php the_title(); ?>
                                                </a>
                                                <p class="bg-gray-100 px-2 py-1 text-sm font-semibold">
                                                    <?php echo esc_html($registration_status); ?>
                                                </p>
                                            </div>
                                            <div class="mb-3 flex items-center text-sm text-gray-600 md:mb-4">
                                                <span><?php echo esc_html($details['date']); ?></span>
                                                <span class="mx-2 text-base">•</span>
                                                <span><?php echo esc_html($details['location']); ?></span>
                                            </div>
                                            <p class="text-gray-600">Join us for a fun-filled day of golf at <?php echo esc_html($details['location']); ?>.</p>
                                        </div>
                                        <a href="<?php echo $spots_remaining > 0 ? get_permalink() : 'javascript:void(0)'; ?>" 
                                           class="inline-flex items-center justify-center rounded-md border-2 <?php echo $spots_remaining > 0 ? 'border-[#269763] text-[#269763] hover:bg-[#269763] hover:text-white' : 'border-gray-300 text-gray-300 cursor-not-allowed'; ?> bg-transparent px-4 py-2 text-center text-sm font-semibold">
                                            Save my spot
                                        </a>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                            <?php wp_reset_postdata(); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <?php if (have_rows('layout_27')) : ?>
        <?php while (have_rows('layout_27')) : the_row(); ?>
            <section class="bg-[#269763] px-[5%] py-16 text-white md:py-24 lg:py-28">
                <div class="container mx-auto">
                    <div class="grid grid-cols-1 gap-y-12 md:grid-flow-row md:grid-cols-2 md:items-center md:gap-x-12 lg:gap-x-20">
                        <div>
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
                                            <h3 class="mb-2 text-2xl font-bold md:text-3xl lg:text-4xl">
                                                <?php the_sub_field('title'); ?>
                                            </h3>
                                            <p>
                                                <?php the_sub_field('content'); ?>
                                            </p>
                                        </div>
                                    <?php endwhile; ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div>
                            <?php $image = get_sub_field('image'); ?>
                            <?php if ($image) : ?>
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

    <?php if (have_rows('cta_1')) : ?>
        <?php while (have_rows('cta_1')) : the_row(); ?>
            <section class="px-[5%] py-16 md:py-24 lg:py-28 bg-[#f6f6f6]">
                <div class="container mx-auto">
                    <div class="grid grid-cols-1 gap-x-20 gap-y-12 md:gap-y-16 lg:grid-cols-2 lg:items-center">
                        <div>
                            <h2 class="mb-5 text-4xl font-bold md:mb-6 md:text-5xl lg:text-6xl">
                                <?php the_sub_field('title'); ?>
                            </h2>
                            <p class="md:text-md">
                                <?php the_sub_field('content'); ?>
                            </p>

                            <?php if (have_rows('buttons')) : ?>
                                <div class="mt-6 flex flex-wrap gap-4 md:mt-8">
                                    <?php while (have_rows('buttons')) : the_row(); 
                                        $button_one_link = get_sub_field('button_one_link');
                                        $button_two_link = get_sub_field('button_two_link');
                                    ?>
                                        <?php if ($button_one_link) : ?>
                                            <a href="<?php echo esc_url($button_one_link); ?>" 
                                               class="inline-flex items-center justify-center rounded-md bg-[#269763] px-6 py-3 text-center font-semibold text-white hover:bg-[#1a724a] focus:outline-none focus:ring-2 focus:ring-[#269763] focus:ring-offset-2">
                                                <?php the_sub_field('button_one_label'); ?>
                                            </a>
                                        <?php endif; ?>
                                        
                                        <?php if ($button_two_link) : ?>
                                            <a href="<?php echo esc_url($button_two_link); ?>" 
                                               class="inline-flex items-center justify-center rounded-md border-2 border-[#269763] bg-transparent px-6 py-3 text-center font-semibold text-[#269763] hover:bg-[#269763] hover:text-white focus:outline-none focus:ring-2 focus:ring-[#269763] focus:ring-offset-2">
                                                <?php the_sub_field('button_two_label'); ?>
                                            </a>
                                        <?php endif; ?>
                                    <?php endwhile; ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div>
                            <?php if (get_sub_field('image')) : ?>
                                <img src="<?php the_sub_field('image'); ?>" 
                                     alt="<?php the_sub_field('title'); ?>"
                                     class="w-full object-cover" />
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </section>
        <?php endwhile; ?>
    <?php endif; ?>

    <?php if (have_rows('faq_1')) : ?>
        <?php while (have_rows('faq_1')) : the_row(); ?>
            <section class="px-[5%] py-16 md:py-24 lg:py-28">
                <div class="container mx-auto max-w-lg">
                    <div class="mb-12 text-center md:mb-18 lg:mb-20">
                        <h2 class="mb-5 text-4xl font-bold md:mb-6 md:text-5xl lg:text-6xl">
                            <?php the_sub_field('header'); ?>
                        </h2>
                        <p class="md:text-md">
                            <?php the_sub_field('content'); ?>
                        </p>
                    </div>

                    <?php if (have_rows('faqs')) : ?>
                        <div class="divide-y divide-gray-200" x-data="{ active: null }">
                            <?php while (have_rows('faqs')) : the_row(); 
                                $id = uniqid('faq-');
                            ?>
                                <div class="faq-item">
                                    <button class="flex w-full items-center justify-between py-4 text-left text-lg font-semibold md:py-5 md:text-md hover:text-[#269763]" 
                                            @click="active = (active === '<?php echo $id; ?>') ? null : '<?php echo $id; ?>'">
                                        <span><?php the_sub_field('question'); ?></span>
                                        <i data-lucide="chevron-down" 
                                           class="h-6 w-6 transform transition-transform duration-300"
                                           :class="{ 'rotate-180': active === '<?php echo $id; ?>' }"></i>
                                    </button>
                                    <div class="overflow-hidden transition-all duration-300"
                                         x-show="active === '<?php echo $id; ?>'"
                                         x-collapse
                                         x-cloak>
                                        <div class="pb-4 md:pb-6 text-gray-600">
                                            <?php the_sub_field('answer'); ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    <?php endif; ?>

                    <div class="mx-auto mt-12 max-w-md text-center md:mt-18 lg:mt-20">
                        <h4 class="mb-3 text-2xl font-bold md:mb-4 md:text-3xl md:leading-[1.3] lg:text-4xl">
                            Still have questions?
                        </h4>
                        <p class="md:text-md">We're here to help!</p>
                        <div class="mt-6 md:mt-8">
                            <a href="/contact" 
                               class="inline-flex items-center justify-center rounded-md border-2 border-[#269763] bg-transparent px-6 py-3 text-center font-semibold text-[#269763] hover:bg-[#269763] hover:text-white focus:outline-none focus:ring-2 focus:ring-[#269763] focus:ring-offset-2">
                                Contact
                            </a>
                        </div>
                    </div>
                </div>
            </section>
        <?php endwhile; ?>
    <?php endif; ?>
</article>