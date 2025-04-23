<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package _ccg
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>



    <?php
    /**
     * Field Structure:
     * - pricing_11 (Group)
     *   - sub_header (Text)
     *   - header (Text)
     *   - content (Text)
     *   - plan (Repeater)
     *     - title (Text)
     *     - price (Text)
     *     - description (Text)
     *     - benefits (Repeater)
     *       - benefit (Text)
     *     - buttons (Repeater)
     *       - button_one_label (Text)
     *       - button_one_link (Link)
     */

    if (have_rows('pricing_11')) : ?>
        <?php while (have_rows('pricing_11')) : the_row(); ?>
            <section id="pricing11" class="px-[5%] py-16 md:py-24 lg:py-28">
                <div class="container mx-auto">
                    <div class="mx-auto mb-12 max-w-3xl text-center md:mb-18 lg:mb-20">
                        <p class="mb-3 font-semibold md:mb-4"><?php the_sub_field('sub_header'); ?></p>
                        <h2 class="mb-5 text-4xl font-bold md:text-5xl lg:text-6xl"><?php the_sub_field('header'); ?></h2>
                        <p class="md:text-md"><?php the_sub_field('content'); ?></p>
                    </div>

                    <div class="grid grid-cols-1 gap-8 md:grid-cols-2">
                        <?php if (have_rows('plan')) : ?>
                            <?php while (have_rows('plan')) : the_row(); ?>
                                <div class="flex h-full flex-col justify-between border border-[#e5e7eb] px-6 py-8 md:p-8">
                                    <div>
                                        <div class="mb-4 flex flex-col items-end justify-end">
                                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/land-plot.svg" alt="Land plot icon" class="w-12 h-12" />
                                        </div>
                                        <h3 class="text-md font-bold leading-[1.4] md:text-xl">
                                            <?php the_sub_field('title'); ?>
                                        </h3>
                                        <h4 class="my-2 text-3xl font-bold md:text-4xl lg:text-5xl">
                                            <?php the_sub_field('price'); ?>/yr
                                        </h4>
                                        <p><?php the_sub_field('description'); ?></p>
                                        <div class="my-8 h-px w-full shrink-0 bg-[#e5e7eb]"></div>
                                        <p>Includes:</p>
                                        <div class="mb-8 mt-4 grid grid-cols-1 gap-y-4 py-2">
                                            <?php if (have_rows('benefits')) : ?>
                                                <?php while (have_rows('benefits')) : the_row(); ?>
                                                    <div class="flex self-start">
                                                        <div class="mr-4 flex-none self-start text-[#269763]">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check"><path d="M20 6 9 17l-5-5"/></svg>
                                                        </div>
                                                        <p><?php the_sub_field('benefit'); ?></p>
                                                    </div>
                                                <?php endwhile; ?>
                                            <?php else : ?>
                                                <?php // No rows found ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div>
                                        <?php if (have_rows('buttons')) : ?>
                                            <?php while (have_rows('buttons')) : the_row(); ?>
                                                <?php $button_one_link = get_sub_field('button_one_link'); ?>
                                                <?php if ($button_one_link) : ?>
                                                    <a href="<?php echo esc_url($button_one_link['url']); ?>" target="<?php echo esc_attr($button_one_link['target']); ?>" class="inline-flex w-full items-center justify-center rounded-md bg-[#269763] px-6 py-3 text-center font-semibold text-white hover:bg-[#1c7049] focus:outline-none focus:ring-2 focus:ring-[#269763] focus:ring-offset-2">
                                                        <?php the_sub_field('button_one_label'); ?>
                                                    </a>
                                                <?php endif; ?>
                                            <?php endwhile; ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        <?php else : ?>
                            <?php // No rows found ?>
                        <?php endif; ?>
                    </div>
                </div>
            </section>
        <?php endwhile; ?>
    <?php endif; ?>

    <?php if (have_rows('layout_245')) : ?>
        <?php while (have_rows('layout_245')) : the_row(); ?>
            <section id="layout245" class="bg-[#269763] text-white px-[5%] py-16 md:py-24 lg:py-28">
                <div class="container mx-auto">
                    <div class="flex flex-col items-start">
                        <div class="rb-12 mb-12 grid grid-cols-1 items-start justify-between gap-5 md:mb-18 md:grid-cols-2 md:gap-x-12 md:gap-y-8 lg:mb-20 lg:gap-x-20">
                            <div>
                                <p class="mb-3 font-semibold md:mb-4"><?php the_sub_field('sub_header'); ?></p>
                                <h2 class="text-4xl font-bold md:text-5xl lg:text-6xl"><?php the_sub_field('header'); ?></h2>
                            </div>
                            <div>
                                <p class="md:text-md"><?php the_sub_field('content'); ?></p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 items-start gap-y-12 md:grid-cols-3 md:gap-x-8 md:gap-y-16 lg:gap-x-12">
                            <?php if (have_rows('cards')) : ?>
                                <?php while (have_rows('cards')) : the_row(); ?>
                                    <div>
                                        <div class="rb-5 mb-5 md:mb-6">
                                            <?php 
                                            $icon = get_sub_field('icon');
                                            if ($icon) : ?>
                                                <img src="<?php echo esc_url($icon['url']); ?>" alt="<?php echo esc_attr($icon['alt']); ?>" class="w-12 h-12" />
                                            <?php endif; ?>
                                        </div>
                                        <h3 class="mb-5 text-2xl font-bold md:mb-6 md:text-3xl md:leading-[1.3] lg:text-4xl">
                                            <?php the_sub_field('title'); ?>
                                        </h3>
                                        <p><?php the_sub_field('content'); ?></p>
                                    </div>
                                <?php endwhile; ?>
                            <?php endif; ?>
                        </div>

                        <div class="mt-10 flex items-center gap-4 md:mt-14 lg:mt-16">
                            <?php if (have_rows('buttons')) : ?>
                                <?php while (have_rows('buttons')) : the_row(); 
                                    $button_one_link = get_sub_field('button_one_link');
                                    $button_two_link = get_sub_field('button_two_link');
                                ?>
                                    <?php if ($button_one_link) : ?>
                                        <a href="<?php echo esc_url($button_one_link); ?>" target="<?php echo esc_attr($button_one_link['target']); ?>" class="inline-flex items-center justify-center rounded-md border-2 border-white bg-transparent px-6 py-3 text-center font-semibold text-white hover:bg-white hover:text-[#269763] focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2">
                                            <?php the_sub_field('button_one_label'); ?>
                                        </a>
                                    <?php endif; ?>
                                    <?php if ($button_two_link) : ?>
                                        <a href="<?php echo esc_url($button_two_link); ?>" target="<?php echo esc_attr($button_two_link['target']); ?>" class="inline-flex items-center justify-center gap-2 text-white hover:underline">
                                            <?php the_sub_field('button_two_label'); ?>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-right"><path d="m9 18 6-6-6-6"/></svg>
                                        </a>
                                    <?php endif; ?>
                                <?php endwhile; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </section>
        <?php endwhile; ?>
    <?php endif; ?>

    <?php if (have_rows('faq_5')) : ?>
        <?php while (have_rows('faq_5')) : the_row(); ?>
            <style>
                .faq-content {
                    overflow: hidden;
                    transition: height 0.4s cubic-bezier(0.4, 0, 0.2, 1);
                    height: 0;
                }
                .faq-content.expanded {
                    height: var(--content-height);
                }
                .faq-trigger svg {
                    transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
                }
                .faq-trigger[aria-expanded="true"] svg {
                    transform: rotate(45deg);
                }
            </style>

            <section id="faq" class="px-[5%] py-16 md:py-24 lg:py-28">
                <div class="container mx-auto">
                    <div class="mb-12 max-w-lg md:mb-18 lg:mb-20">
                        <h2 class="mb-5 text-4xl font-bold md:text-5xl lg:text-6xl"><?php the_sub_field('header'); ?></h2>
                        <p class="md:text-md"><?php the_sub_field('content'); ?></p>
                    </div>

                    <?php if (have_rows('faqs')) : ?>
                        <div class="grid items-start justify-stretch gap-4 faq-accordion">
                            <?php 
                            $counter = 0;
                            while (have_rows('faqs')) : the_row(); 
                                $item_id = "accordion-" . $counter;
                            ?>
                                <div class="border border-border-primary px-5 md:px-6 faq-item" data-accordion-id="<?php echo $item_id; ?>">
                                    <button 
                                        class="faq-trigger flex w-full items-center justify-between py-4 text-left md:py-5 md:text-md"
                                        aria-expanded="false"
                                        aria-controls="<?php echo $item_id; ?>-content"
                                    >
                                        <?php the_sub_field('question'); ?>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-7 shrink-0 text-text-primary md:size-8">
                                            <line x1="12" y1="5" x2="12" y2="19"></line>
                                            <line x1="5" y1="12" x2="19" y2="12"></line>
                                        </svg>
                                    </button>
                                    <div 
                                        id="<?php echo $item_id; ?>-content"
                                        class="faq-content"
                                    >
                                        <div class="pb-4 md:pb-6">
                                            <?php the_sub_field('answer'); ?>
                                        </div>
                                    </div>
                                </div>
                            <?php 
                                $counter++;
                            endwhile; 
                            ?>
                        </div>
                    <?php endif; ?>

                    <div class="mt-12 md:mt-18 lg:mt-20">
                        <h4 class="mb-3 text-2xl font-bold md:mb-4 md:text-3xl md:leading-[1.3] lg:text-4xl">Still have questions?</h4>
                        <p class="md:text-md">We're here to help!</p>
                        <div class="mt-6 md:mt-8">
                            <a href="/contact" class="inline-flex items-center justify-center rounded-md bg-[#269763] px-6 py-3 text-center font-semibold text-white hover:bg-[#1c7049] focus:outline-none focus:ring-2 focus:ring-[#269763] focus:ring-offset-2">
                                Contact
                            </a>
                        </div>
                    </div>
                </div>
            </section>

            <script>
            document.addEventListener('DOMContentLoaded', function() {
                const faqItems = document.querySelectorAll('.faq-item');
                
                faqItems.forEach(item => {
                    const trigger = item.querySelector('.faq-trigger');
                    const content = item.querySelector('.faq-content');
                    const contentInner = content.querySelector('div');
                    
                    // Set initial height
                    content.style.setProperty('--content-height', contentInner.offsetHeight + 'px');
                    
                    // Update height on window resize
                    window.addEventListener('resize', () => {
                        content.style.setProperty('--content-height', contentInner.offsetHeight + 'px');
                    });
                    
                    trigger.addEventListener('click', () => {
                        const isExpanded = trigger.getAttribute('aria-expanded') === 'true';
                        
                        // Toggle current item
                        trigger.setAttribute('aria-expanded', !isExpanded);
                        content.classList.toggle('expanded');
                    });
                });
            });
            </script>
        <?php endwhile; ?>
    <?php endif; ?>

</article><!-- #post-<?php the_ID(); ?> -->