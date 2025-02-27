<?php
/**
 * Template part for displaying page content in page.php
 *
 * @package _ccg
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php if (have_rows('header_81')) : ?>
        <?php while (have_rows('header_81')) : the_row(); ?>
            <style>
                .scroll-section {
                    position: relative;
                }
                @media (min-width: 768px) {
                    .scroll-section {
                        height: 300vh;
                    }
                    .scroll-content {
                        position: sticky;
                        top: 0;
                        height: 100vh;
                    }
                }
                .image-container {
                    transition: width 0.6s cubic-bezier(0.34, 1.56, 0.64, 1);
                    will-change: width;
                }
                @media (max-width: 991px) {
                    .image-container {
                        width: 100% !important;
                    }
                }
            </style>

            <section id="header-scroll" class="scroll-section">
                <div class="scroll-content static top-0 grid auto-cols-fr grid-cols-1 items-center gap-y-16 pt-16 md:pt-24 lg:sticky lg:h-screen lg:grid-cols-2 lg:gap-y-0 lg:pt-0">
                    <div class="relative mx-[5%] max-w-md lg:ml-[5vw] lg:mr-20 lg:justify-self-end">
                        <h1 class="mb-5 text-4xl font-bold md:mb-6 md:text-5xl lg:text-6xl"><?php the_sub_field('header'); ?></h1>
                        <p class="md:text-md"><?php the_sub_field('content'); ?></p>
                        
                        <?php if (have_rows('buttons')) : ?>
                            <div class="mt-6 flex flex-wrap gap-4 md:mt-8">
                                <?php while (have_rows('buttons')) : the_row(); ?>
                                    <a href="<?php echo esc_url(get_sub_field('button_one_link')); ?>" 
                                       class="inline-flex items-center justify-center rounded-md bg-[#269763] px-6 py-3 text-center font-semibold text-white hover:bg-[#1c7049] focus:outline-none focus:ring-2 focus:ring-[#269763] focus:ring-offset-2">
                                        <?php the_sub_field('button_one_label'); ?>
                                    </a>
                                    <a href="<?php echo esc_url(get_sub_field('button_two_link')); ?>" 
                                       class="inline-flex items-center justify-center rounded-md border-2 border-[#269763] bg-transparent px-6 py-3 text-center font-semibold text-[#269763] hover:bg-[#269763] hover:text-white focus:outline-none focus:ring-2 focus:ring-[#269763] focus:ring-offset-2">
                                        <?php the_sub_field('button_two_label'); ?>
                                    </a>
                                <?php endwhile; ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="image-wrapper">
                        <?php $images = get_sub_field('images'); ?>
                        <?php if ($images) : ?>
                            <div class="image-container absolute inset-0 left-auto w-1/2">
                                <div class="relative size-full pt-[100%] lg:pt-0">
                                    <img src="<?php echo esc_url($images['url']); ?>" 
                                         alt="<?php echo esc_attr($images['alt']); ?>" 
                                         class="absolute inset-0 size-full object-cover" />
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </section>

            <script>
            document.addEventListener('DOMContentLoaded', function() {
                const section = document.getElementById('header-scroll');
                const imageContainer = section.querySelector('.image-container');
                let lastScrollY = window.scrollY;
                let rafId = null;

                function lerp(start, end, factor) {
                    return start + (end - start) * factor;
                }

                let currentWidth = 50;
                let targetWidth = 50;

                function updateImageWidth() {
                    if (!section || !imageContainer) return;

                    const sectionRect = section.getBoundingClientRect();
                    const scrollProgress = Math.max(0, Math.min(1, -sectionRect.top / (sectionRect.height - window.innerHeight)));
                    
                    // Only update on desktop
                    if (window.innerWidth > 991) {
                        targetWidth = 50 + (scrollProgress * 50);
                        currentWidth = lerp(currentWidth, targetWidth, 0.1);
                        
                        if (Math.abs(currentWidth - targetWidth) > 0.01) {
                            imageContainer.style.width = `${currentWidth}%`;
                            rafId = requestAnimationFrame(updateImageWidth);
                        } else {
                            imageContainer.style.width = `${targetWidth}%`;
                            rafId = null;
                        }
                    }
                }

                function onScroll() {
                    lastScrollY = window.scrollY;
                    if (!rafId) {
                        rafId = requestAnimationFrame(updateImageWidth);
                    }
                }

                window.addEventListener('scroll', onScroll, { passive: true });

                // Initial update
                updateImageWidth();

                // Cleanup
                return () => {
                    window.removeEventListener('scroll', onScroll);
                    if (rafId) {
                        cancelAnimationFrame(rafId);
                    }
                };
            });
            </script>
        <?php endwhile; ?>
    <?php endif; ?>

    <?php if (have_rows('layout_12')) : ?>
        <?php while (have_rows('layout_12')) : the_row(); ?>
            <section class="px-[5%] py-16 md:py-24 lg:py-28">
                <div class="container mx-auto">
                    <div class="grid grid-cols-1 gap-y-12 md:grid-flow-row md:grid-cols-2 md:items-center md:gap-x-12 md:gap-y-8 lg:gap-x-20">
                        <div>
                            <?php if (get_sub_field('sub_header')) : ?>
                                <div class="mb-4 text-[#269763]"><?php the_sub_field('sub_header'); ?></div>
                            <?php endif; ?>
                            
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
                                            <div class="mb-3 md:mb-4">
                                                <?php 
                                                $icon = get_sub_field('icon');
                                                if ($icon) : ?>
                                                    <img src="<?php echo esc_url($icon['url']); ?>" 
                                                         alt="<?php echo esc_attr($icon['alt']); ?>" 
                                                         class="size-12" />
                                                <?php endif; ?>
                                            </div>
                                            <h6 class="mb-3 text-md font-bold leading-[1.4] md:mb-4 md:text-xl">
                                                <?php the_sub_field('title'); ?>
                                            </h6>
                                            <p><?php the_sub_field('content'); ?></p>
                                        </div>
                                    <?php endwhile; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div>
                            <?php 
                            $image = get_sub_field('image');
                            if ($image) : ?>
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

    <?php if (have_rows('cta_3')) : ?>
        <?php while (have_rows('cta_3')) : the_row(); ?>
            <section class="relative px-[5%] py-16 md:py-24 lg:py-28">
                <div class="container relative z-10 mx-auto">
                    <div class="grid w-full grid-cols-1 items-start justify-between gap-6 md:grid-cols-[1fr_max-content] md:gap-x-12 md:gap-y-8 lg:gap-x-20">
                        <div class="md:mr-12 lg:mr-0">
                            <div class="w-full max-w-lg">
                                <h2 class="mb-3 text-4xl font-bold leading-[1.2] text-white md:mb-4 md:text-5xl lg:text-6xl">
                                    <?php the_sub_field('title'); ?>
                                </h2>
                                <p class="text-white md:text-md">
                                    <?php the_sub_field('content'); ?>
                                </p>
                            </div>
                        </div>
                        <?php if (have_rows('buttons')) : ?>
                            <div class="flex items-start justify-start gap-4">
                                <?php while (have_rows('buttons')) : the_row(); ?>
                                    <a href="<?php echo esc_url(get_sub_field('button_one_link')); ?>" 
                                       class="inline-flex items-center justify-center rounded-md bg-white px-6 py-3 text-center font-semibold text-[#269763] hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2">
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
                </div>
                <div class="absolute inset-0 z-0">
                    <?php $background_image = get_sub_field('image'); ?>
                    <?php if ($background_image) : ?>
                        <img src="<?php echo esc_url($background_image); ?>" 
                             alt="Background Image"
                             class="size-full object-cover" />
                    <?php endif; ?>
                    <div class="absolute inset-0 bg-black/50"></div>
                </div>
            </section>
        <?php endwhile; ?>
    <?php endif; ?>
</article>