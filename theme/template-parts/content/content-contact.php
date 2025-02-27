<?php
/**
 * Template part for displaying page content in page.php
 *
 * @package _ccg
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php if (have_rows('header_127')) : ?>
        <?php while (have_rows('header_127')) : the_row(); ?>
            <section id="header" class="bg-[#269763] text-white px-[5%] py-16 md:py-24 lg:py-28">
                <div class="container mx-auto">
                    <div class="grid grid-cols-1 items-center gap-12 md:grid-cols-2 md:gap-16">
                        <div>
                            <h1 class="mb-5 text-4xl font-bold md:mb-6 md:text-5xl lg:text-6xl"><?php the_sub_field('header'); ?></h1>
                            <p class="md:text-md"><?php the_sub_field('content'); ?></p>
                            
                            <?php if (have_rows('buttons')) : ?>
                                <div class="mt-6 flex flex-wrap gap-4 md:mt-8">
                                    <?php while (have_rows('buttons')) : the_row(); ?>
                                        <a href="<?php echo esc_url(get_sub_field('button_one_link')); ?>" 
                                           class="inline-flex items-center justify-center rounded-md border-2 border-white bg-white px-6 py-3 text-center font-semibold text-[#269763] hover:bg-transparent hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2">
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
                        <div class="relative flex w-full">
                            <div class="mx-[15%] w-full">
                                <?php $image_one = get_sub_field('image_one'); ?>
                                <?php if ($image_one) : ?>
                                    <img src="<?php echo esc_url($image_one['url']); ?>" 
                                         alt="<?php echo esc_attr($image_one['alt']); ?>" 
                                         class="aspect-[2/3] size-full object-cover" />
                                <?php endif; ?>
                            </div>
                            <div class="absolute bottom-auto left-auto right-0 top-[10%] w-[40%]">
                                <?php $image_two = get_sub_field('image_two'); ?>
                                <?php if ($image_two) : ?>
                                    <img src="<?php echo esc_url($image_two['url']); ?>" 
                                         alt="<?php echo esc_attr($image_two['alt']); ?>" 
                                         class="aspect-square size-full object-cover" />
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php endwhile; ?>
    <?php endif; ?>

    <section class="px-[5%] py-16 md:py-24 lg:py-28">
        <div class="container mx-auto">
            <?php the_field('form'); ?>
        </div>
    </section>
</article>