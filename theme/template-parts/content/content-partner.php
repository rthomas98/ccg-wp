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
    // Layout439 Component
    if (have_rows('header_439')) :
        while (have_rows('header_439')) : the_row();
            $sub_header = get_sub_field('sub_header') ?: 'Your Gateway to Local Golf';
            $header = get_sub_field('header') ?: 'Explore Dallas Golf Courses and Partnerships';
            $content = get_sub_field('content') ?: 'Discover the finest golf courses in the Dallas area, where lush greens and challenging layouts await. Our partnerships with local clubs ensure you have access to exclusive rates and exceptional experiences.';
            $images = get_sub_field('images');
            $image_two = get_sub_field('image_two');
    ?>
        <section id="layout439" class="px-[5%] py-16 md:py-24 lg:py-28">
            <div class="container mx-auto">
                <div class="grid grid-cols-1 items-start gap-x-16 gap-y-6 sm:gap-y-8 md:grid-cols-2">
                    <div class="order-last flex h-full flex-col justify-between md:order-first">
                        <?php if ($images) : ?>
                            <img src="<?php echo esc_url($images['url']); ?>" alt="<?php echo esc_attr($images['alt']); ?>" class="mb-6 w-full object-cover md:mb-8" />
                        <?php else : ?>
                            <img src="https://d22po4pjz3o32e.cloudfront.net/placeholder-image.svg" class="mb-6 w-full object-cover md:mb-8" alt="Relume placeholder image 1" />
                        <?php endif; ?>
                        <div class="ml-[10%] mr-[5%]">
                            <p class="md:text-md"><?php echo esc_html($content); ?></p>
                            <div class="mt-6 flex flex-wrap gap-4 md:mt-8">
                                <?php if (have_rows('buttons')) : ?>
                                    <?php while (have_rows('buttons')) : the_row(); 
                                        $button_one_label = get_sub_field('button_one_label') ?: 'Learn More';
                                        $button_one_link = get_sub_field('button_one_link') ?: '#';
                                        $button_two_label = get_sub_field('button_two_label') ?: 'Sign Up';
                                        $button_two_link = get_sub_field('button_two_link') ?: '#';
                                    ?>
                                        <a href="<?php echo esc_url($button_one_link); ?>" class="inline-flex items-center justify-center rounded-md border border-[#141414] bg-white px-6 py-3 text-center font-semibold text-[#141414] hover:bg-[#f0f0f0] focus:outline-none focus:ring-2 focus:ring-[#141414] focus:ring-offset-2">
                                            <?php echo esc_html($button_one_label); ?>
                                        </a>
                                        <a href="<?php echo esc_url($button_two_link); ?>" class="inline-flex items-center text-[#269763] hover:text-[#1c7049] font-semibold">
                                            <?php echo esc_html($button_two_label); ?>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="ml-1"><path d="m9 18 6-6-6-6"/></svg>
                                        </a>
                                    <?php endwhile; ?>
                                <?php else : ?>
                                    <a href="#" class="inline-flex items-center justify-center rounded-md border border-[#141414] bg-white px-6 py-3 text-center font-semibold text-[#141414] hover:bg-[#f0f0f0] focus:outline-none focus:ring-2 focus:ring-[#141414] focus:ring-offset-2">
                                        Learn More
                                    </a>
                                    <a href="#" class="inline-flex items-center text-[#269763] hover:text-[#1c7049] font-semibold">
                                        Sign Up
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="ml-1"><path d="m9 18 6-6-6-6"/></svg>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="flex h-full flex-col justify-between">
                        <div>
                            <p class="mb-3 font-semibold md:mb-4"><?php echo esc_html($sub_header); ?></p>
                            <h2 class="text-4xl font-bold md:text-5xl lg:text-6xl"><?php echo esc_html($header); ?></h2>
                        </div>
                        <?php if ($image_two) : ?>
                            <img src="<?php echo esc_url($image_two['url']); ?>" alt="<?php echo esc_attr($image_two['alt']); ?>" class="mt-12 aspect-square w-full object-cover md:mt-18 lg:mt-20" />
                        <?php else : ?>
                            <img src="https://d22po4pjz3o32e.cloudfront.net/placeholder-image-landscape.svg" class="mt-12 aspect-square w-full object-cover md:mt-18 lg:mt-20" alt="Relume placeholder image 2" />
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
    // Layout216 Component
    if (have_rows('layout_216')) :
        while (have_rows('layout_216')) : the_row();
            $sub_header = get_sub_field('sub_header') ?: 'Discover';
            $header = get_sub_field('header') ?: 'Explore the Unique Features of Our Courses';
            $content = get_sub_field('content') ?: 'Dallas is home to some of the most picturesque golf courses in Texas. Each course offers its own unique challenges and stunning landscapes for players of all skill levels.';
            $image = get_sub_field('image');
    ?>
        <section id="layout216" class="px-[5%] py-16 md:py-24 lg:py-28 bg-[#f6f6f6]">
            <div class="container mx-auto">
                <div class="grid grid-cols-1 items-center gap-12 md:grid-cols-2 lg:gap-x-20">
                    <div class="order-2 md:order-1">
                        <?php if ($image) : ?>
                            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" class="w-full object-cover" />
                        <?php else : ?>
                            <img src="https://d22po4pjz3o32e.cloudfront.net/placeholder-image.svg" class="w-full object-cover" alt="Relume placeholder image" />
                        <?php endif; ?>
                    </div>
                    <div class="order-1 md:order-2">
                        <p class="mb-3 font-semibold md:mb-4"><?php echo esc_html($sub_header); ?></p>
                        <h2 class="mb-5 text-4xl font-bold md:mb-6 md:text-5xl lg:text-6xl"><?php echo esc_html($header); ?></h2>
                        <p class="mb-6 md:mb-8 md:text-md"><?php echo esc_html($content); ?></p>
                        <div class="grid grid-cols-1 gap-6 py-2 sm:grid-cols-2">
                            <?php if (have_rows('cards')) : ?>
                                <?php while (have_rows('cards')) : the_row(); 
                                    $state = get_sub_field('state');
                                    $title = get_sub_field('title');
                                    $card_content = get_sub_field('content');
                                ?>
                                    <div>
                                        <h3 class="mb-2 text-3xl font-bold md:text-4xl lg:text-5xl"><?php echo esc_html($state); ?></h3>
                                        <p><?php echo esc_html($card_content); ?></p>
                                    </div>
                                <?php endwhile; ?>
                            <?php else : ?>
                                <div>
                                    <h3 class="mb-2 text-3xl font-bold md:text-4xl lg:text-5xl">50%</h3>
                                    <p>Exclusive discounts for members and tournament participants.</p>
                                </div>
                                <div>
                                    <h3 class="mb-2 text-3xl font-bold md:text-4xl lg:text-5xl">50%</h3>
                                    <p>Join us for special events and tournaments.</p>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="mt-6 flex flex-wrap gap-4 md:mt-8">
                            <?php if (have_rows('buttons')) : ?>
                                <?php while (have_rows('buttons')) : the_row(); 
                                    $button_one_label = get_sub_field('button_one_label') ?: 'Learn More';
                                    $button_one_link = get_sub_field('button_one_link') ?: '#';
                                    $button_two_label = get_sub_field('button_two_label') ?: 'Sign Up';
                                    $button_two_link = get_sub_field('button_two_link') ?: '#';
                                ?>
                                    <a href="<?php echo esc_url($button_one_link); ?>" class="inline-flex items-center justify-center rounded-md border border-[#141414] bg-white px-6 py-3 text-center font-semibold text-[#141414] hover:bg-[#f0f0f0] focus:outline-none focus:ring-2 focus:ring-[#141414] focus:ring-offset-2">
                                        <?php echo esc_html($button_one_label); ?>
                                    </a>
                                    <a href="<?php echo esc_url($button_two_link); ?>" class="inline-flex items-center text-[#269763] hover:text-[#1c7049] font-semibold">
                                        <?php echo esc_html($button_two_label); ?>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="ml-1"><path d="m9 18 6-6-6-6"/></svg>
                                    </a>
                                <?php endwhile; ?>
                            <?php else : ?>
                                <a href="#" class="inline-flex items-center justify-center rounded-md border border-[#141414] bg-white px-6 py-3 text-center font-semibold text-[#141414] hover:bg-[#f0f0f0] focus:outline-none focus:ring-2 focus:ring-[#141414] focus:ring-offset-2">
                                    Learn More
                                </a>
                                <a href="#" class="inline-flex items-center text-[#269763] hover:text-[#1c7049] font-semibold">
                                    Sign Up
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="ml-1"><path d="m9 18 6-6-6-6"/></svg>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php
        endwhile;
    endif;
    ?>

    <?php
    // Layout239 Component
    if (have_rows('layout_239')) :
        while (have_rows('layout_239')) : the_row();
            $sub_header = get_sub_field('sub_header') ?: 'Courses';
            $header = get_sub_field('header') ?: 'Explore Dallas\'s Premier Golf Courses';
            $content = get_sub_field('content') ?: 'Discover the best golf courses in the Dallas area, each offering unique challenges and stunning landscapes. Whether you\'re a seasoned player or just starting out, there\'s a perfect course waiting for you.';
    ?>
        <section id="layout239" class="px-[5%] py-16 md:py-24 lg:py-28">
            <div class="container mx-auto">
                <div class="flex flex-col items-center">
                    <div class="mb-12 text-center md:mb-18 lg:mb-20">
                        <div class="mx-auto w-full max-w-3xl">
                            <p class="mb-3 font-semibold md:mb-4"><?php echo esc_html($sub_header); ?></p>
                            <h2 class="mb-5 text-4xl font-bold md:mb-6 md:text-5xl lg:text-6xl"><?php echo esc_html($header); ?></h2>
                            <p class="md:text-md"><?php echo esc_html($content); ?></p>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 items-start justify-center gap-y-12 md:grid-cols-3 md:gap-x-8 md:gap-y-16 lg:gap-x-12">
                        <?php if (have_rows('cards')) : ?>
                            <?php while (have_rows('cards')) : the_row();
                                $image = get_sub_field('image');
                                $title = get_sub_field('title');
                                $card_content = get_sub_field('content');
                            ?>
                                <div class="flex w-full flex-col items-center text-center">
                                    <div class="mb-6 md:mb-8">
                                        <?php if ($image) : ?>
                                            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                                        <?php else : ?>
                                            <img src="https://d22po4pjz3o32e.cloudfront.net/placeholder-image-landscape.svg" alt="Relume placeholder image" />
                                        <?php endif; ?>
                                    </div>
                                    <h3 class="mb-5 text-2xl font-bold md:mb-6 md:text-3xl md:leading-[1.3] lg:text-4xl">
                                        <?php echo esc_html($title); ?>
                                    </h3>
                                    <p><?php echo esc_html($card_content); ?></p>
                                </div>
                            <?php endwhile; ?>
                        <?php else : ?>
                            <div class="flex w-full flex-col items-center text-center">
                                <div class="mb-6 md:mb-8">
                                    <img src="https://d22po4pjz3o32e.cloudfront.net/placeholder-image-landscape.svg" alt="Relume placeholder image" />
                                </div>
                                <h3 class="mb-5 text-2xl font-bold md:mb-6 md:text-3xl md:leading-[1.3] lg:text-4xl">
                                    Top Local Courses to Experience
                                </h3>
                                <p>Discover the vibrant greens and expertly designed layouts at these incredible golf courses you absolutely must visit.</p>
                            </div>
                            <div class="flex w-full flex-col items-center text-center">
                                <div class="mb-6 md:mb-8">
                                    <img src="https://d22po4pjz3o32e.cloudfront.net/placeholder-image-landscape.svg" alt="Relume placeholder image" />
                                </div>
                                <h3 class="mb-5 text-2xl font-bold md:mb-6 md:text-3xl md:leading-[1.3] lg:text-4xl">
                                    Exclusive Partnerships with Local Clubs
                                </h3>
                                <p>Take advantage of exclusive rates and special access made possible by our trusted partnerships and collaborations with industry leaders.</p>
                            </div>
                            <div class="flex w-full flex-col items-center text-center">
                                <div class="mb-6 md:mb-8">
                                    <img src="https://d22po4pjz3o32e.cloudfront.net/placeholder-image-landscape.svg" alt="Relume placeholder image" />
                                </div>
                                <h3 class="mb-5 text-2xl font-bold md:mb-6 md:text-3xl md:leading-[1.3] lg:text-4xl">
                                    Member Reviews of Local Courses
                                </h3>
                                <p>Discover insights and experiences shared by fellow golfers about their memorable moments on the course.</p>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="mt-6 flex flex-wrap items-center gap-4 md:mt-8">
                        <a href="#" class="inline-flex items-center justify-center rounded-md border border-[#141414] bg-white px-6 py-3 text-center font-semibold text-[#141414] hover:bg-[#f0f0f0] focus:outline-none focus:ring-2 focus:ring-[#141414] focus:ring-offset-2">
                            Learn More
                        </a>
                        <a href="#" class="inline-flex items-center text-[#269763] hover:text-[#1c7049] font-semibold">
                            Sign Up
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="ml-1"><path d="m9 18 6-6-6-6"/></svg>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    <?php
        endwhile;
    endif;
    ?>

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
    // Layout27 Component
    if (have_rows('layout_27')) :
        while (have_rows('layout_27')) : the_row();
            $header = get_sub_field('header') ?: 'Discover the Premier Golf Experience at Dallas\' Top Courses';
            $content = get_sub_field('content') ?: 'Dallas is home to some of the finest golf courses in Texas, offering stunning landscapes and challenging layouts. Experience exceptional amenities and a welcoming atmosphere that caters to players of all skill levels.';
            $image = get_sub_field('image');
    ?>
        <section id="layout27" class="bg-[#269763] text-white px-[5%] py-16 md:py-24 lg:py-28">
            <div class="container mx-auto">
                <div class="grid grid-cols-1 gap-y-12 md:grid-flow-row md:grid-cols-2 md:items-center md:gap-x-12 lg:gap-x-20">
                    <div>
                        <h2 class="mb-5 text-4xl font-bold leading-[1.2] md:mb-6 md:text-5xl lg:text-6xl"><?php echo esc_html($header); ?></h2>
                        <p class="mb-6 md:mb-8 md:text-md"><?php echo esc_html($content); ?></p>
                        <div class="grid grid-cols-1 gap-6 py-2 sm:grid-cols-2">
                            <?php if (have_rows('cards')) : ?>
                                <?php while (have_rows('cards')) : the_row(); 
                                    $card_title = get_sub_field('title');
                                    $card_content = get_sub_field('content');
                                ?>
                                    <div>
                                        <h3 class="mb-2 text-3xl font-bold md:text-4xl lg:text-5xl"><?php echo esc_html($card_title); ?></h3>
                                        <p><?php echo esc_html($card_content); ?></p>
                                    </div>
                                <?php endwhile; ?>
                            <?php else : ?>
                                <div>
                                    <h3 class="mb-2 text-5xl font-bold md:text-7xl lg:text-8xl">Amenities</h3>
                                    <p>Experience stunning views, top-notch pro shops, and a variety of delightful dining options to enjoy.</p>
                                </div>
                                <div>
                                    <h3 class="mb-2 text-5xl font-bold md:text-7xl lg:text-8xl">Reviews</h3>
                                    <p>Players consistently rave about the challenging courses and the welcoming, friendly staff members.</p>
                                </div>
                            <?php endif; ?>
                        </div>
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