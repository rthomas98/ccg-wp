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
    // Layout24 Component
    if (have_rows('layout_24')) :
        while (have_rows('layout_24')) : the_row();
            $header = get_sub_field('header') ?: 'Discover Premier Golf Courses and Exclusive Partnerships in the Dallas Area';
            $content = get_sub_field('content') ?: 'Chau Chau Golf proudly partners with top local clubs to enhance your golfing experience. Enjoy exclusive rates and access to some of the finest courses in Dallas, tailored for both amateur players and tournament participants.';
            $image = get_sub_field('image');
    ?>
        <section id="layout24" class="px-[5%] py-16 md:py-24 lg:py-28 bg-[#f6f6f6]">
            <div class="container mx-auto">
                <div class="grid grid-cols-1 gap-y-12 md:grid-cols-2 md:items-center md:gap-x-12 lg:gap-x-20">
                    <div>
                        
                        <h3 class="mb-5 text-4xl font-bold leading-[1.2] md:mb-6 md:text-5xl lg:text-6xl">
                            <?php echo esc_html($header); ?>
                        </h3>
                        <p class="md:text-md">
                            <?php echo esc_html($content); ?>
                        </p>
                    </div>
                    <div>
                        <?php if ($image) : ?>
                            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" class="w-full object-cover" />
                        <?php else : ?>
                            <img src="https://d22po4pjz3o32e.cloudfront.net/placeholder-image.svg" class="w-full object-cover" alt="Relume placeholder image" />
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
    <?php
        endwhile;
    endif;
    ?>

 

    <?php
    // Fluent Form Section
    if (get_field('form')) :
    ?>
        <section class="px-[5%] py-16 md:py-24 lg:py-28 bg-[#f6f6f6]">
            <div class="container mx-auto">
                <div class="mx-auto max-w-3xl">
                    <?php the_field('form'); ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

</article><!-- #post-<?php the_ID(); ?> -->