<?php
/**
 * Template part for displaying page content in page.php
 *
 * @package _ccg
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php if (have_rows('header_46')) : ?>
        <?php while (have_rows('header_46')) : the_row(); ?>
            <section class="bg-[#269763] px-[5%] py-16 text-white md:py-24 lg:py-28">
                <div class="container mx-auto">
                    <div class="w-full max-w-lg">
                        <h1 class="mb-5 text-4xl font-bold md:mb-6 md:text-5xl lg:text-6xl">
                            <?php the_sub_field('header'); ?>
                        </h1>
                        <p class="md:text-md">
                            <?php the_sub_field('content'); ?>
                        </p>
                    </div>
                </div>
            </section>
        <?php endwhile; ?>
    <?php endif; ?>

    <?php if (have_rows('faq_2')) : ?>
        <?php while (have_rows('faq_2')) : the_row(); ?>
            <section class="px-[5%] py-16 md:py-24 lg:py-28">
                <div class="container mx-auto">

                    <?php if (have_rows('faqs')) : ?>
                        <div class="divide-y divide-gray-200" x-data="{ active: null }">
                            <?php while (have_rows('faqs')) : the_row(); 
                                $id = uniqid('faq-'); ?>
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

                    <div class="mt-12 md:mt-18 lg:mt-20">
                        <h4 class="mb-3 text-2xl font-bold md:mb-4 md:text-3xl md:leading-[1.3] lg:text-4xl">
                            Still have questions?
                        </h4>
                        <p class="md:text-md">We're here to help you.</p>
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

    <?php if (have_rows('cta_31')) : ?>
        <?php while (have_rows('cta_31')) : the_row(); ?>
            <section class="px-[5%] py-16 md:py-24 lg:py-28 bg-[#f6f6f6]">
                <div class="container mx-auto flex flex-col items-center">
                    <div class="mb-12 max-w-3xl text-center md:mb-18 lg:mb-20">
                        <h2 class="mb-5 text-4xl font-bold md:mb-6 md:text-5xl lg:text-6xl">
                            <?php the_sub_field('header'); ?>
                        </h2>
                        <p class="md:text-md">
                            <?php the_sub_field('content'); ?>
                        </p>
                        
                        <?php if (have_rows('buttons')) : ?>
                            <div class="mt-6 flex flex-wrap items-center justify-center gap-4 md:mt-8">
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
                    
                    <?php $image = get_sub_field('image'); ?>
                    <?php if ($image) : ?>
                        <img src="<?php echo esc_url($image['url']); ?>" 
                             alt="<?php echo esc_attr($image['alt']); ?>"
                             class="w-1/2 object-cover" />
                    <?php endif; ?>
                </div>
            </section>
        <?php endwhile; ?>
    <?php endif; ?>
</article>