<?php
/**
 * Template Name: Tournaments Page Template
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package _ccg
 */

get_header();
?>

<section id="primary">
    <main id="main">
        <?php
        while (have_posts()) :
            the_post();
            get_template_part('theme/template-parts/content/content', 'tournament');
        endwhile;
        ?>
    </main>
</section>

<?php
get_footer();