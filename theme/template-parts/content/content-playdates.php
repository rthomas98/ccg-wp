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

    <?php if (have_rows('event_4')) : ?>
        <?php while (have_rows('event_4')) : the_row(); ?>
            <section class="px-[5%] py-16 md:py-24 lg:py-28">
                <div class="container mx-auto">
                    <div class="mx-auto flex w-full max-w-lg flex-col">
                        <div class="mb-12 text-center md:mb-18 lg:mb-20">
                            <h4 class="font-semibold">
                                <?php the_sub_field('sub_header'); ?>
                            </h4>
                            <h2 class="mt-3 text-4xl font-bold md:mt-4 md:text-5xl lg:text-6xl">
                                <?php the_sub_field('header'); ?>
                            </h2>
                            <p class="mt-5 text-base md:mt-6 md:text-md">
                                <?php the_sub_field('content'); ?>
                            </p>
                        </div>

                        <div class="flex flex-col justify-start">
                            <div class="no-scrollbar mb-12 flex w-full items-center overflow-auto md:justify-center md:overflow-hidden">
                                <a href="#" class="inline-flex items-center justify-center rounded-md border-2 border-[#269763] bg-transparent px-4 py-2 text-center text-sm font-semibold text-[#269763] hover:bg-[#269763] hover:text-white">
                                    View all
                                </a>
                                <a href="#" class="inline-flex items-center justify-center px-4 py-2 text-center text-sm font-semibold text-gray-600 hover:text-[#269763]">
                                    Upcoming Playdates
                                </a>
                                <a href="#" class="inline-flex items-center justify-center px-4 py-2 text-center text-sm font-semibold text-gray-600 hover:text-[#269763]">
                                    Past Events
                                </a>
                                <a href="#" class="inline-flex items-center justify-center px-4 py-2 text-center text-sm font-semibold text-gray-600 hover:text-[#269763]">
                                    Golf Tournaments
                                </a>
                                <a href="#" class="inline-flex items-center justify-center px-4 py-2 text-center text-sm font-semibold text-gray-600 hover:text-[#269763]">
                                    Social Events
                                </a>
                            </div>

                            <?php if (have_rows('events')) : ?>
                                <div class="flex flex-col gap-6 md:gap-8">
                                    <?php while (have_rows('events')) : the_row(); 
                                        $title = get_sub_field('title');
                                        $status = get_sub_field('status');
                                        $date = get_sub_field('date');
                                        $location = get_sub_field('location');
                                        $description = get_sub_field('description');
                                        $image = get_sub_field('image');
                                        $button_link = get_sub_field('button_link');
                                    ?>
                                        <div class="flex flex-col border border-gray-200 md:flex-row">
                                            <div class="relative aspect-[3/2] w-full shrink-0 md:aspect-auto md:w-48 lg:aspect-square">
                                                <?php if ($image) : ?>
                                                    <img src="<?php echo esc_url($image['url']); ?>" 
                                                         alt="<?php echo esc_attr($image['alt']); ?>" 
                                                         class="absolute size-full object-cover" />
                                                <?php endif; ?>
                                            </div>
                                            <div class="flex w-full flex-col items-start gap-8 p-6 sm:p-8 lg:flex-row lg:items-center">
                                                <div>
                                                    <div class="mb-2 flex flex-wrap items-center gap-2 sm:mb-0 sm:gap-4">
                                                        <h3 class="text-xl font-bold md:text-2xl">
                                                            <?php echo esc_html($title); ?>
                                                        </h3>
                                                        <?php if ($status) : ?>
                                                            <p class="bg-gray-100 px-2 py-1 text-sm font-semibold">
                                                                <?php echo esc_html($status); ?>
                                                            </p>
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="mb-3 flex items-center text-sm md:mb-4">
                                                        <?php if ($date) : ?>
                                                            <span><?php echo esc_html($date); ?></span>
                                                        <?php endif; ?>
                                                        <?php if ($date && $location) : ?>
                                                            <span class="mx-2 text-base">•</span>
                                                        <?php endif; ?>
                                                        <?php if ($location) : ?>
                                                            <span><?php echo esc_html($location); ?></span>
                                                        <?php endif; ?>
                                                    </div>
                                                    <p><?php echo esc_html($description); ?></p>
                                                </div>
                                                <?php if ($button_link) : ?>
                                                    <a href="<?php echo esc_url($button_link); ?>" 
                                                       class="inline-flex items-center justify-center rounded-md border-2 border-[#269763] bg-transparent px-4 py-2 text-center text-sm font-semibold text-[#269763] hover:bg-[#269763] hover:text-white">
                                                        Save my spot
                                                    </a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endwhile; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </section>
        <?php endwhile; ?>
    <?php endif; ?>

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