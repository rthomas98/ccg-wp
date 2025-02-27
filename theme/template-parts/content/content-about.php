<?php
/**
 * Template part for displaying page content in about.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package _ccg
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <?php
    // Header26 Component
    if (have_rows('header_26')) :
        while (have_rows('header_26')) : the_row();
            $header = get_sub_field('header');
            $content = get_sub_field('content');
            $images = get_sub_field('images');
    ?>
        <section id="relume" class="px-[5%] py-16 md:py-24 lg:py-28">
            <div class="container mx-auto">
                <div class="flex flex-col items-center">
                    <div class="mb-12 text-center md:mb-18 lg:mb-20">
                        <div class="w-full max-w-3xl mx-auto">
                            <?php if ($header) : ?>
                                <h1 class="mb-5 text-5xl font-bold md:mb-6 md:text-6xl lg:text-7xl">
                                    <?php echo esc_html($header); ?>
                                </h1>
                            <?php else : ?>
                                <h1 class="mb-5 text-5xl font-bold md:mb-6 md:text-7xl lg:text-8xl">
                                    Discover the Heart of Chau Chau Golf
                                </h1>
                            <?php endif; ?>
                            
                            <?php if ($content) : ?>
                                <p class="md:text-md">
                                    <?php echo esc_html($content); ?>
                                </p>
                            <?php else : ?>
                                <p class="md:text-md">
                                    At Chau Chau Golf, we are passionate about elevating the amateur golf experience in Dallas and beyond. Our mission is to create a vibrant community where golfers can connect, compete, and grow their skills.
                                </p>
                            <?php endif; ?>
                            
                            <div class="mt-6 flex items-center justify-center gap-x-4 md:mt-8">
                                <?php if (have_rows('buttons')) : ?>
                                    <?php while (have_rows('buttons')) : the_row(); 
                                        $button_one_label = get_sub_field('button_one_label');
                                        $button_one_link = get_sub_field('button_one_link');
                                        $button_two_label = get_sub_field('button_two_label');
                                        $button_two_link = get_sub_field('button_two_link');
                                    ?>
                                        <?php if ($button_one_label && $button_one_link) : ?>
                                            <a href="<?php echo esc_url($button_one_link); ?>" class="inline-flex items-center justify-center rounded-md bg-[#269763] px-6 py-3 text-center font-semibold text-white hover:bg-[#1c7049] focus:outline-none focus:ring-2 focus:ring-[#269763] focus:ring-offset-2">
                                                <?php echo esc_html($button_one_label); ?>
                                            </a>
                                        <?php else : ?>
                                            <a href="#" class="inline-flex items-center justify-center rounded-md bg-[#269763] px-6 py-3 text-center font-semibold text-white hover:bg-[#1c7049] focus:outline-none focus:ring-2 focus:ring-[#269763] focus:ring-offset-2">
                                                Learn More
                                            </a>
                                        <?php endif; ?>
                                        
                                        <?php if ($button_two_label && $button_two_link) : ?>
                                            <a href="<?php echo esc_url($button_two_link); ?>" class="inline-flex items-center justify-center rounded-md border border-[#141414] bg-white px-6 py-3 text-center font-semibold text-[#141414] hover:bg-[#f0f0f0] focus:outline-none focus:ring-2 focus:ring-[#141414] focus:ring-offset-2">
                                                <?php echo esc_html($button_two_label); ?>
                                            </a>
                                        <?php else : ?>
                                            <a href="#" class="inline-flex items-center justify-center rounded-md border border-[#141414] bg-white px-6 py-3 text-center font-semibold text-[#141414] hover:bg-[#f0f0f0] focus:outline-none focus:ring-2 focus:ring-[#141414] focus:ring-offset-2">
                                                Join Us
                                            </a>
                                        <?php endif; ?>
                                    <?php endwhile; ?>
                                <?php else : ?>
                                    <a href="#" class="inline-flex items-center justify-center rounded-md bg-[#269763] px-6 py-3 text-center font-semibold text-white hover:bg-[#1c7049] focus:outline-none focus:ring-2 focus:ring-[#269763] focus:ring-offset-2">
                                        Learn More
                                    </a>
                                    <a href="#" class="inline-flex items-center justify-center rounded-md border border-[#141414] bg-white px-6 py-3 text-center font-semibold text-[#141414] hover:bg-[#f0f0f0] focus:outline-none focus:ring-2 focus:ring-[#141414] focus:ring-offset-2">
                                        Join Us
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div>
                        <?php if ($images) : ?>
                            <img src="<?php echo esc_url($images['url']); ?>" class="size-full object-cover" alt="<?php echo esc_attr($images['alt']); ?>" />
                        <?php else : ?>
                            <img src="<?php echo esc_url(get_stylesheet_directory_uri() . '/assets/images/golf-landscape.jpg'); ?>" class="size-full object-cover" alt="Chau Chau Golf landscape" onerror="this.src='https://d22po4pjz3o32e.cloudfront.net/placeholder-image-landscape.svg'; this.onerror=null;" />
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
    // Layout222 Component
    if (have_rows('layout_222')) :
        while (have_rows('layout_222')) : the_row();
            $image = get_sub_field('image');
    ?>
        <section id="relume" class="px-[5%] py-16 md:py-24 lg:py-28">
            <div class="container mx-auto">
                <div class="grid grid-cols-1 items-center gap-12 md:grid-cols-2 lg:gap-x-20">
                    <div class="order-2 md:order-1">
                        <?php if ($image) : ?>
                            <img src="<?php echo esc_url($image['url']); ?>" class="w-full object-cover" alt="<?php echo esc_attr($image['alt']); ?>" />
                        <?php else : ?>
                            <img src="<?php echo esc_url(get_stylesheet_directory_uri() . '/assets/images/about-golf.jpg'); ?>" class="w-full object-cover" alt="About Chau Chau Golf" onerror="this.src='https://d22po4pjz3o32e.cloudfront.net/placeholder-image.svg'; this.onerror=null;" />
                        <?php endif; ?>
                    </div>
                    <div class="order-1 md:order-2">
                        <div class="grid grid-cols-1 gap-x-6 gap-y-8 py-2 sm:grid-cols-2">
                            <?php 
                            if (have_rows('cards')) :
                                while (have_rows('cards')) : the_row();
                                    $icon = get_sub_field('icon');
                                    $title = get_sub_field('title');
                                    $content = get_sub_field('content');
                                    $button_text = get_sub_field('button_text');
                                    $button_link = get_sub_field('button_link');
                            ?>
                                <div>
                                    <div class="mb-3 md:mb-4">
                                        <?php if ($icon) : ?>
                                            <?php echo $icon; ?>
                                        <?php else : ?>
                                            <div class="flex items-center justify-center size-12 rounded-full bg-[#269763]">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check"><path d="M20 6 9 17l-5-5"/></svg>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <h3 class="mb-3 text-xl font-bold md:mb-4 md:text-2xl">
                                        <?php echo $title ? esc_html($title) : 'Title'; ?>
                                    </h3>
                                    <p>
                                        <?php echo $content ? esc_html($content) : 'Content description goes here.'; ?>
                                    </p>
                                    <div class="mt-6 flex items-center gap-4 md:mt-8">
                                        <a href="<?php echo $button_link ? esc_url($button_link) : '#'; ?>" class="inline-flex items-center text-[#269763] hover:text-[#1c7049] font-semibold">
                                            <?php echo $button_text ? esc_html($button_text) : 'Learn More'; ?>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="ml-1"><path d="m9 18 6-6-6-6"/></svg>
                                        </a>
                                    </div>
                                </div>
                            <?php 
                                endwhile;
                            else : 
                                // Default cards if no ACF data
                                $default_cards = [
                                    [
                                        'title' => 'Our Story',
                                        'content' => 'Based in Dallas, we proudly honor the vibrant spirit of amateur golf while fostering a strong sense of community.',
                                        'button_text' => 'Learn More'
                                    ],
                                    [
                                        'title' => 'Our Mission',
                                        'content' => 'To empower amateur golfers through resources, events, and a supportive community.',
                                        'button_text' => 'Join Us'
                                    ],
                                    [
                                        'title' => 'Our Values',
                                        'content' => 'Integrity, passion, and inclusivity drive our commitment to the golfing community.',
                                        'button_text' => 'Discover'
                                    ],
                                    [
                                        'title' => 'Meet the Team',
                                        'content' => 'A dedicated group of golf enthusiasts committed to fostering growth and enjoyment.',
                                        'button_text' => 'Contact'
                                    ]
                                ];
                                
                                foreach ($default_cards as $card) :
                            ?>
                                <div>
                                    <div class="mb-3 md:mb-4">
                                        <div class="flex items-center justify-center size-12 rounded-full bg-[#269763]">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check"><path d="M20 6 9 17l-5-5"/></svg>
                                        </div>
                                    </div>
                                    <h3 class="mb-3 text-xl font-bold md:mb-4 md:text-2xl">
                                        <?php echo esc_html($card['title']); ?>
                                    </h3>
                                    <p>
                                        <?php echo esc_html($card['content']); ?>
                                    </p>
                                    <div class="mt-6 flex items-center gap-4 md:mt-8">
                                        <a href="#" class="inline-flex items-center text-[#269763] hover:text-[#1c7049] font-semibold">
                                            <?php echo esc_html($card['button_text']); ?>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="ml-1"><path d="m9 18 6-6-6-6"/></svg>
                                        </a>
                                    </div>
                                </div>
                            <?php 
                                endforeach;
                            endif; 
                            ?>
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
    // Layout275 Component
    if (have_rows('layout_275')) :
        while (have_rows('layout_275')) : the_row();
            $image = get_sub_field('image');
            $sub_header = get_sub_field('sub_header');
            $header = get_sub_field('header');
            $content = get_sub_field('content');
    ?>
        <section id="relume" class="relative px-[5%] py-16 md:py-24 lg:py-28">
            <div class="container relative z-10 mx-auto">
                <div class="mb-12 max-w-lg md:mb-18 lg:mb-20">
                    <?php if ($sub_header) : ?>
                        <p class="mb-3 font-semibold text-white md:mb-4">
                            <?php echo esc_html($sub_header); ?>
                        </p>
                    <?php else : ?>
                        <p class="mb-3 font-semibold text-white md:mb-4">
                            Fervor and enthusiasm for life and its pursuits.
                        </p>
                    <?php endif; ?>

                    <?php if ($header) : ?>
                        <h2 class="mb-5 text-4xl font-bold text-white md:mb-6 md:text-5xl lg:text-6xl">
                            <?php echo esc_html($header); ?>
                        </h2>
                    <?php else : ?>
                        <h2 class="mb-5 text-4xl font-bold text-white md:mb-6 md:text-5xl lg:text-6xl">
                            Our Journey: From Enthusiasts to Innovators
                        </h2>
                    <?php endif; ?>

                    <?php if ($content) : ?>
                        <p class="text-white md:text-md">
                            <?php echo esc_html($content); ?>
                        </p>
                    <?php else : ?>
                        <p class="text-white md:text-md">
                            Chau Chau Golf was born from a shared love for the game among local golf enthusiasts in Dallas. Our founders envisioned a platform that would elevate the amateur golf experience and foster a vibrant community.
                        </p>
                    <?php endif; ?>
                </div>

                <div class="grid grid-cols-1 gap-y-12 md:grid-cols-3 md:gap-x-8 md:gap-y-16 lg:gap-x-12">
                    <?php 
                    if (have_rows('cards')) :
                        while (have_rows('cards')) : the_row();
                            $icon = get_sub_field('icon');
                            $title = get_sub_field('title');
                            $card_content = get_sub_field('content');
                    ?>
                        <div class="flex w-full gap-6">
                            <?php if ($icon) : ?>
                                <?php echo $icon; ?>
                            <?php else : ?>
                                <div class="mb-5 size-12 flex-none self-start md:mb-6 flex items-center justify-center rounded-full bg-[#269763]">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check"><path d="M20 6 9 17l-5-5"/></svg>
                                </div>
                            <?php endif; ?>
                            <div>
                                <h3 class="mb-5 text-2xl font-bold text-white md:mb-6 md:text-3xl md:leading-[1.3] lg:text-4xl">
                                    <?php echo $title ? esc_html($title) : 'Title'; ?>
                                </h3>
                                <p class="text-white">
                                    <?php echo $card_content ? esc_html($card_content) : 'Content description goes here.'; ?>
                                </p>
                            </div>
                        </div>
                    <?php 
                        endwhile;
                    else : 
                        // Default cards if no ACF data
                        $default_cards = [
                            [
                                'title' => 'Commitment to Golf Excellence',
                                'content' => 'Our mission is to offer valuable resources and engaging events that empower and inspire amateur players.'
                            ],
                            [
                                'title' => 'Meet Our Dedicated Team of Golf Lovers',
                                'content' => 'Our dedicated team consists of passionate golfers who are fully committed to enhancing your overall experience with us.'
                            ],
                            [
                                'title' => 'Celebrate the Game of Golf with Us',
                                'content' => 'Let\'s work together to craft unforgettable experiences that will make lasting memories on the golf course for everyone involved.'
                            ]
                        ];
                        
                        foreach ($default_cards as $card) :
                    ?>
                        <div class="flex w-full gap-6">
                            <div class="mb-5 size-12 flex-none self-start md:mb-6 flex items-center justify-center rounded-full bg-[#269763]">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check"><path d="M20 6 9 17l-5-5"/></svg>
                            </div>
                            <div>
                                <h3 class="mb-5 text-2xl font-bold text-white md:mb-6 md:text-3xl md:leading-[1.3] lg:text-4xl">
                                    <?php echo esc_html($card['title']); ?>
                                </h3>
                                <p class="text-white">
                                    <?php echo esc_html($card['content']); ?>
                                </p>
                            </div>
                        </div>
                    <?php 
                        endforeach;
                    endif; 
                    ?>
                </div>

                <div class="mt-12 flex flex-wrap justify-start gap-4 md:mt-18 lg:mt-20">
                    <?php if (have_rows('buttons')) : ?>
                        <?php while (have_rows('buttons')) : the_row(); 
                            $button_one_label = get_sub_field('button_one_label');
                            $button_one_link = get_sub_field('button_one_link');
                            $button_two_label = get_sub_field('button_two_label');
                            $button_two_link = get_sub_field('button_two_link');
                        ?>
                            <?php if ($button_one_label && $button_one_link) : ?>
                                <a href="<?php echo esc_url($button_one_link); ?>" class="inline-flex items-center justify-center rounded-md bg-white px-6 py-3 text-center font-semibold text-[#141414] hover:bg-[#f0f0f0] focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-black">
                                    <?php echo esc_html($button_one_label); ?>
                                </a>
                            <?php else : ?>
                                <a href="#" class="inline-flex items-center justify-center rounded-md bg-white px-6 py-3 text-center font-semibold text-[#141414] hover:bg-[#f0f0f0] focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-black">
                                    Learn More
                                </a>
                            <?php endif; ?>
                            
                            <?php if ($button_two_label && $button_two_link) : ?>
                                <a href="<?php echo esc_url($button_two_link); ?>" class="inline-flex items-center text-white hover:text-[#f0f0f0] font-semibold">
                                    <?php echo esc_html($button_two_label); ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="ml-1"><path d="m9 18 6-6-6-6"/></svg>
                                </a>
                            <?php else : ?>
                                <a href="#" class="inline-flex items-center text-white hover:text-[#f0f0f0] font-semibold">
                                    Sign Up
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="ml-1"><path d="m9 18 6-6-6-6"/></svg>
                                </a>
                            <?php endif; ?>
                        <?php endwhile; ?>
                    <?php else : ?>
                        <a href="#" class="inline-flex items-center justify-center rounded-md bg-white px-6 py-3 text-center font-semibold text-[#141414] hover:bg-[#f0f0f0] focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-black">
                            Learn More
                        </a>
                        <a href="#" class="inline-flex items-center text-white hover:text-[#f0f0f0] font-semibold">
                            Sign Up
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="ml-1"><path d="m9 18 6-6-6-6"/></svg>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
            
            <div class="absolute inset-0 z-0">
                <?php if ($image) : ?>
                    <img src="<?php echo esc_url($image['url']); ?>" class="size-full object-cover" alt="<?php echo esc_attr($image['alt']); ?>" />
                <?php else : ?>
                    <img src="<?php echo esc_url(get_stylesheet_directory_uri() . '/assets/images/golf-course.jpg'); ?>" class="size-full object-cover" alt="Golf course" onerror="this.src='https://d22po4pjz3o32e.cloudfront.net/placeholder-image.svg'; this.onerror=null;" />
                <?php endif; ?>
                <div class="absolute inset-0 bg-black/50"></div>
            </div>
        </section>
    <?php
        endwhile;
    endif;
    ?>

    <?php
    // Layout408 Component
    if (have_rows('layout_408')) :
        while (have_rows('layout_408')) : the_row();
            $sub_header = get_sub_field('sub_header') ?: 'Elevate to new heights and achieve your dreams.';
            $header = get_sub_field('header') ?: 'Our Commitment to Golfers';
            $content = get_sub_field('content') ?: 'Empowering amateur players by providing them with unforgettable experiences that enhance their skills, build confidence, and create lasting memories in their journey toward becoming better athletes.';
    ?>
        <section id="layout408" class="px-[5%] py-16 md:py-24 lg:py-28">
            <div class="container mx-auto">
                <div class="mx-auto mb-12 w-full max-w-lg text-center md:mb-18 lg:mb-20">
                    <p class="mb-3 font-semibold md:mb-4">
                        <?php echo esc_html($sub_header); ?>
                    </p>
                    <h2 class="mb-5 text-4xl font-bold md:mb-6 md:text-5xl lg:text-6xl">
                        <?php echo esc_html($header); ?>
                    </h2>
                    <p class="md:text-md">
                        <?php echo esc_html($content); ?>
                    </p>
                </div>
                
                <div class="sticky top-0 grid grid-cols-1 gap-6 md:gap-0" id="scrollContainer">
                <?php 
                // Check if there are cards
                if (have_rows('cards')) :
                    $card_count = 0;
                    while (have_rows('cards')) : the_row();
                        $card_count++;
                        $card_sub_header = get_sub_field('sub_header') ?: 'Passion';
                        $card_title = get_sub_field('title') ?: 'Our Mission and Vision';
                        $card_content = get_sub_field('content') ?: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique. Duis cursus, mi quis viverra ornare, eros dolor interdum nulla, ut commodo diam libero vitae erat.';
                        $card_image = get_sub_field('image');
                        
                        // Get button info if available
                        $button_one_label = '';
                        $button_one_link = '';
                        $button_two_label = '';
                        $button_two_link = '';
                        
                        if (have_rows('buttons')) :
                            while (have_rows('buttons')) : the_row();
                                $button_one_label = get_sub_field('button_one_label') ?: 'Learn More';
                                $button_one_link = get_sub_field('button_one_link') ?: '#';
                                $button_two_label = get_sub_field('button_two_label') ?: 'Join';
                                $button_two_link = get_sub_field('button_two_link') ?: '#';
                            endwhile;
                        endif;
                        
                        // Determine order based on card number for desktop
                        $order_text = ($card_count % 2 == 0) ? 'md:order-last' : 'md:order-first';
                        $order_image = ($card_count % 2 == 0) ? 'md:order-first' : 'md:order-last';
                ?>
                    <!-- Mobile version -->
                    <div class="md:hidden static grid grid-cols-1 content-center overflow-hidden border border-[#e5e5e5] bg-white">
                        <div class="order-first flex flex-col justify-center p-6 md:p-8 lg:p-12">
                            <p class="mb-2 font-semibold"><?php echo esc_html($card_sub_header); ?></p>
                            <h3 class="mb-5 text-4xl font-bold leading-[1.2] md:mb-6 md:text-5xl lg:text-6xl"><?php echo esc_html($card_title); ?></h3>
                            <p><?php echo esc_html($card_content); ?></p>
                            <div class="mt-6 flex items-center gap-x-4 md:mt-8">
                                <a href="<?php echo esc_url($button_one_link); ?>" class="inline-flex items-center justify-center rounded-md border border-[#141414] bg-white px-6 py-3 text-center font-semibold text-[#141414] hover:bg-[#f0f0f0] focus:outline-none focus:ring-2 focus:ring-[#141414] focus:ring-offset-2">
                                    <?php echo esc_html($button_one_label); ?>
                                </a>
                                <a href="<?php echo esc_url($button_two_link); ?>" class="inline-flex items-center text-[#269763] hover:text-[#1c7049] font-semibold">
                                    <?php echo esc_html($button_two_label); ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="ml-1"><path d="m9 18 6-6-6-6"/></svg>
                                </a>
                            </div>
                        </div>
                        <div class="order-last flex flex-col items-center justify-center">
                            <?php 
                            $image = get_sub_field('image');
                            if ($image) : 
                                // Output the image using ACF's image field
                                echo wp_get_attachment_image($image, 'full', false, array('class' => 'w-full h-auto'));
                            else : 
                            ?>
                                <img src="https://d22po4pjz3o32e.cloudfront.net/placeholder-image.svg" alt="Relume placeholder image <?php echo $card_count; ?>" class="w-full h-auto">
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <!-- Tablet/Desktop version -->
                    <div class="hidden md:grid static grid-cols-1 content-center overflow-hidden border border-[#e5e5e5] bg-white md:sticky md:top-[10%] md:mb-[10vh] md:h-[80vh] md:grid-cols-2 scale-card" data-card-index="<?php echo $card_count - 1; ?>">
                        <div class="order-first flex flex-col justify-center p-6 md:p-8 lg:p-12 <?php echo $order_text; ?>">
                            <p class="mb-2 font-semibold"><?php echo esc_html($card_sub_header); ?></p>
                            <h3 class="mb-5 text-4xl font-bold leading-[1.2] md:mb-6 md:text-5xl lg:text-6xl"><?php echo esc_html($card_title); ?></h3>
                            <p><?php echo esc_html($card_content); ?></p>
                            <div class="mt-6 flex items-center gap-x-4 md:mt-8">
                                <a href="<?php echo esc_url($button_one_link); ?>" class="inline-flex items-center justify-center rounded-md border border-[#141414] bg-white px-6 py-3 text-center font-semibold text-[#141414] hover:bg-[#f0f0f0] focus:outline-none focus:ring-2 focus:ring-[#141414] focus:ring-offset-2">
                                    <?php echo esc_html($button_one_label); ?>
                                </a>
                                <a href="<?php echo esc_url($button_two_link); ?>" class="inline-flex items-center text-[#269763] hover:text-[#1c7049] font-semibold">
                                    <?php echo esc_html($button_two_label); ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="ml-1"><path d="m9 18 6-6-6-6"/></svg>
                                </a>
                            </div>
                        </div>
                        <div class="order-last flex flex-col items-center justify-center <?php echo $order_image; ?>">
                            <?php 
                            $image = get_sub_field('image');
                            if ($image) : 
                                // Output the image using ACF's image field
                                echo wp_get_attachment_image($image, 'full', false, array('class' => 'w-full h-full object-cover'));
                            else : 
                            ?>
                                <img src="https://d22po4pjz3o32e.cloudfront.net/placeholder-image.svg" alt="Relume placeholder image <?php echo $card_count; ?>" class="w-full h-full object-cover">
                            <?php endif; ?>
                        </div>
                    </div>
                <?php 
                    endwhile;
                else : 
                    // Default cards if no ACF data
                    $default_cards = [
                        [
                            'sub_header' => 'Excellence',
                            'title' => 'Commitment to Quality',
                            'content' => 'We strive to create exceptional golfing experiences that inspire and challenge players of all skill levels. Our dedication to excellence is evident in everything we do.',
                            'order_text' => 'md:order-first',
                            'order_image' => 'md:order-last',
                            'index' => 0
                        ],
                        [
                            'sub_header' => 'Community',
                            'title' => 'Building Lasting Connections',
                            'content' => 'Our community is the heart of Chau Chau Golf. We foster meaningful relationships among golfers who share a passion for the game and a desire to grow together.',
                            'order_text' => 'md:order-last',
                            'order_image' => 'md:order-first',
                            'index' => 1
                        ],
                        [
                            'sub_header' => 'Innovation',
                            'title' => 'Embracing New Approaches',
                            'content' => 'We continuously seek innovative ways to enhance the golfing experience, from tournament formats to training methods, always with the goal of making the game more enjoyable and accessible.',
                            'order_text' => 'md:order-first',
                            'order_image' => 'md:order-last',
                            'index' => 2
                        ]
                    ];
                    
                    foreach ($default_cards as $card) :
                        $card_count = $card['index'] + 1;
                ?>
                    <!-- Mobile version -->
                    <div class="md:hidden static grid grid-cols-1 content-center overflow-hidden border border-[#e5e5e5] bg-white">
                        <div class="order-first flex flex-col justify-center p-6 md:p-8 lg:p-12">
                            <p class="mb-2 font-semibold"><?php echo esc_html($card['sub_header']); ?></p>
                            <h3 class="mb-5 text-4xl font-bold leading-[1.2] md:mb-6 md:text-5xl lg:text-6xl"><?php echo esc_html($card['title']); ?></h3>
                            <p><?php echo esc_html($card['content']); ?></p>
                            <div class="mt-6 flex items-center gap-x-4 md:mt-8">
                                <a href="#" class="inline-flex items-center justify-center rounded-md border border-[#141414] bg-white px-6 py-3 text-center font-semibold text-[#141414] hover:bg-[#f0f0f0] focus:outline-none focus:ring-2 focus:ring-[#141414] focus:ring-offset-2">
                                    Learn More
                                </a>
                                <a href="#" class="inline-flex items-center text-[#269763] hover:text-[#1c7049] font-semibold">
                                    Join
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="ml-1"><path d="m9 18 6-6-6-6"/></svg>
                                </a>
                            </div>
                        </div>
                        <div class="order-last flex flex-col items-center justify-center">
                            <img src="https://d22po4pjz3o32e.cloudfront.net/placeholder-image.svg" alt="Relume placeholder image <?php echo $card_count; ?>" class="w-full h-auto">
                        </div>
                    </div>
                    
                    <!-- Tablet/Desktop version -->
                    <div class="hidden md:grid static grid-cols-1 content-center overflow-hidden border border-[#e5e5e5] bg-white md:sticky md:top-[10%] md:mb-[10vh] md:h-[80vh] md:grid-cols-2 scale-card" data-card-index="<?php echo $card['index']; ?>">
                        <div class="order-first flex flex-col justify-center p-6 md:p-8 lg:p-12 <?php echo $card['order_text']; ?>">
                            <p class="mb-2 font-semibold"><?php echo esc_html($card['sub_header']); ?></p>
                            <h3 class="mb-5 text-4xl font-bold leading-[1.2] md:mb-6 md:text-5xl lg:text-6xl"><?php echo esc_html($card['title']); ?></h3>
                            <p><?php echo esc_html($card['content']); ?></p>
                            <div class="mt-6 flex items-center gap-x-4 md:mt-8">
                                <a href="#" class="inline-flex items-center justify-center rounded-md border border-[#141414] bg-white px-6 py-3 text-center font-semibold text-[#141414] hover:bg-[#f0f0f0] focus:outline-none focus:ring-2 focus:ring-[#141414] focus:ring-offset-2">
                                    Learn More
                                </a>
                                <a href="#" class="inline-flex items-center text-[#269763] hover:text-[#1c7049] font-semibold">
                                    Join
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="ml-1"><path d="m9 18 6-6-6-6"/></svg>
                                </a>
                            </div>
                        </div>
                        <div class="order-last flex flex-col items-center justify-center <?php echo $card['order_image']; ?>">
                            <img src="https://d22po4pjz3o32e.cloudfront.net/placeholder-image.svg" alt="Relume placeholder image <?php echo $card_count; ?>" class="w-full h-full object-cover">
                        </div>
                    </div>
                <?php 
                    endforeach;
                endif; 
                ?>
                </div>
            </div>
        </section>

        <script>
        document.addEventListener('DOMContentLoaded', function() {
            const scrollContainer = document.getElementById('scrollContainer');
            const scaleCards = document.querySelectorAll('.scale-card');
            const totalCards = scaleCards.length;
            
            if (scrollContainer && scaleCards.length > 0) {
                // Function to calculate scale based on scroll position
                function calculateScale(index, totalSections, scrollProgress) {
                    const sectionFraction = 1 / totalSections;
                    const start = sectionFraction * index;
                    const end = sectionFraction * (index + 1);
                    
                    // Map the scroll progress to a scale value between 1 and 0.8
                    if (scrollProgress >= start && scrollProgress <= end) {
                        const sectionProgress = (scrollProgress - start) / sectionFraction;
                        return 1 - (0.2 * sectionProgress);
                    }
                    
                    return scrollProgress > end ? 0.8 : 1;
                }
                
                // Handle scroll for scaling effect
                window.addEventListener('scroll', function() {
                    const containerRect = scrollContainer.getBoundingClientRect();
                    const containerTop = containerRect.top;
                    const containerHeight = containerRect.height;
                    const windowHeight = window.innerHeight;
                    
                    // Calculate overall scroll progress (0 to 1)
                    let scrollProgress = 1 - (containerTop / (containerHeight - windowHeight * 0.6));
                    scrollProgress = Math.max(0, Math.min(1, scrollProgress));
                    
                    // Apply scale to each card based on its position
                    scaleCards.forEach(card => {
                        const cardIndex = parseInt(card.getAttribute('data-card-index'));
                        
                        // Calculate scale based on position in the scroll sequence
                        const scale = calculateScale(cardIndex, totalCards, scrollProgress);
                        
                        // Apply the scale transformation
                        card.style.transform = `scale(${scale})`;
                    });
                });
                
                // Trigger initial scroll event
                window.dispatchEvent(new Event('scroll'));
            }
        });
        </script>
    <?php
        endwhile;
    endif;
    ?>

    <?php
    // Layout4 Component
    if (have_rows('layout_4')) :
        while (have_rows('layout_4')) : the_row();
            $sub_header = get_sub_field('sub_header') ?: 'Together';
            $header = get_sub_field('header') ?: 'Our Commitment to Golf and Community';
            $content = get_sub_field('content') ?: 'At Chau Chau Golf, we believe in fostering a vibrant community of golf enthusiasts. Our mission is to elevate the amateur golfing experience through integrity and excellence.';
    ?>
        <section id="layout4" class="px-[5%] py-16 md:py-24 lg:py-28">
            <div class="container mx-auto">
                <div class="grid grid-cols-1 gap-y-12 md:grid-flow-row md:grid-cols-2 md:items-center md:gap-x-12 lg:gap-x-20">
                    <div>
                        <p class="mb-3 font-semibold md:mb-4"><?php echo esc_html($sub_header); ?></p>
                        <h2 class="mb-5 text-4xl font-bold md:mb-6 md:text-5xl lg:text-6xl"><?php echo esc_html($header); ?></h2>
                        <p class="mb-6 md:mb-8 md:text-md"><?php echo esc_html($content); ?></p>
                        
                        <div class="grid grid-cols-1 gap-6 py-2 sm:grid-cols-2">
                            <?php if (have_rows('cards')) : ?>
                                <?php while (have_rows('cards')) : the_row(); 
                                    $card_title = get_sub_field('title');
                                    $card_content = get_sub_field('content');
                                ?>
                                    <div>
                                        <h6 class="mb-3 text-md font-bold leading-[1.4] md:mb-4 md:text-xl">
                                            <?php echo esc_html($card_title); ?>
                                        </h6>
                                        <p><?php echo esc_html($card_content); ?></p>
                                    </div>
                                <?php endwhile; ?>
                            <?php else : ?>
                                <!-- Default cards if no ACF data -->
                                <div>
                                    <h6 class="mb-3 text-md font-bold leading-[1.4] md:mb-4 md:text-xl">Community First</h6>
                                    <p>We unite golfers to create lasting friendships and shared experiences on the course.</p>
                                </div>
                                <div>
                                    <h6 class="mb-3 text-md font-bold leading-[1.4] md:mb-4 md:text-xl">Pursuit of Excellence</h6>
                                    <p>We strive for the highest standards in every tournament and event we organize.</p>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="mt-6 flex flex-wrap items-center gap-4 md:mt-8">
                            <?php if (have_rows('buttons')) : ?>
                                <?php while (have_rows('buttons')) : the_row(); 
                                    $button_one_label = get_sub_field('button_one_label') ?: 'Learn More';
                                    $button_one_link = get_sub_field('button_one_link') ?: '#';
                                    $button_two_label = get_sub_field('button_two_label') ?: 'Join Us';
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
                                <!-- Default buttons if no ACF data -->
                                <a href="#" class="inline-flex items-center justify-center rounded-md border border-[#141414] bg-white px-6 py-3 text-center font-semibold text-[#141414] hover:bg-[#f0f0f0] focus:outline-none focus:ring-2 focus:ring-[#141414] focus:ring-offset-2">
                                    Learn More
                                </a>
                                <a href="#" class="inline-flex items-center text-[#269763] hover:text-[#1c7049] font-semibold">
                                    Join Us
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="ml-1"><path d="m9 18 6-6-6-6"/></svg>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div>
                        <?php 
                        $image = get_sub_field('image');
                        if ($image) : 
                            // Output the image using ACF's image field
                            echo wp_get_attachment_image($image, 'full', false, array('class' => 'w-full object-cover'));
                        else : 
                        ?>
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
    // Layout431 Component
    if (have_rows('layout_431')) :
        while (have_rows('layout_431')) : the_row();
            $sub_header = get_sub_field('sub_header') ?: 'Unity fosters cooperation and builds stronger communities.';
            $header = get_sub_field('header') ?: 'Our Commitment to Amateur Golfers Everywhere';
            $content = get_sub_field('content') ?: 'At Chau Chau Golf, we believe in empowering amateur golfers through community engagement and skill development. Our mission is to create a supportive environment where players can connect, compete, and elevate their game.';
            $image_one = get_sub_field('image_one');
            $image_two = get_sub_field('image_two');
    ?>
        <section id="layout431" class="bg-[#269763] text-white px-[5%] py-16 md:py-24 lg:py-28">
            <div class="container mx-auto">
                <div class="mb-12 md:mb-18 lg:mb-20">
                    <div class="max-w-md">
                        <p class="mb-3 font-semibold md:mb-4"><?php echo esc_html($sub_header); ?></p>
                        <h2 class="mb-5 text-4xl font-bold md:mb-6 md:text-5xl lg:text-6xl"><?php echo esc_html($header); ?></h2>
                    </div>
                </div>
                <div class="grid grid-cols-1 items-end gap-x-16 gap-y-12 md:grid-cols-[1fr_0.75fr]">
                    <div class="grid grid-cols-2 gap-6 sm:gap-8">
                        <div>
                            <?php if ($image_one) : ?>
                                <img src="<?php echo esc_url($image_one['url']); ?>" alt="<?php echo esc_attr($image_one['alt']); ?>" class="w-full object-cover" />
                            <?php else : ?>
                                <img src="https://d22po4pjz3o32e.cloudfront.net/placeholder-image.svg" class="w-full object-cover" alt="Relume placeholder image 1" />
                            <?php endif; ?>
                        </div>
                        <div class="mt-[25%]">
                            <?php if ($image_two) : ?>
                                <img src="<?php echo esc_url($image_two['url']); ?>" alt="<?php echo esc_attr($image_two['alt']); ?>" class="w-full object-cover" />
                            <?php else : ?>
                                <img src="https://d22po4pjz3o32e.cloudfront.net/placeholder-image.svg" class="w-full object-cover" alt="Relume placeholder image 2" />
                            <?php endif; ?>
                        </div>
                    </div>
                    <div>
                        <div class="ml-[5%] mr-[10%]">
                            <p class="md:text-md"><?php echo esc_html($content); ?></p>
                            <div class="mt-6 flex flex-wrap gap-4 md:mt-8">
                                <?php if (have_rows('buttons')) : ?>
                                    <?php while (have_rows('buttons')) : the_row(); 
                                        $button_one_label = get_sub_field('button_one_label') ?: 'Join';
                                        $button_one_link = get_sub_field('button_one_link') ?: '#';
                                        $button_two_label = get_sub_field('button_two_label') ?: 'Learn More';
                                        $button_two_link = get_sub_field('button_two_link') ?: '#';
                                    ?>
                                        <a href="<?php echo esc_url($button_one_link); ?>" class="inline-flex items-center justify-center rounded-md border border-white bg-transparent px-6 py-3 text-center font-semibold text-white hover:bg-white hover:text-[#269763] focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-[#269763]">
                                            <?php echo esc_html($button_one_label); ?>
                                        </a>
                                        <a href="<?php echo esc_url($button_two_link); ?>" class="inline-flex items-center text-white hover:text-[#e6e6e6] font-semibold">
                                            <?php echo esc_html($button_two_label); ?>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="ml-1"><path d="m9 18 6-6-6-6"/></svg>
                                        </a>
                                    <?php endwhile; ?>
                                <?php else : ?>
                                    <a href="#" class="inline-flex items-center justify-center rounded-md border border-white bg-transparent px-6 py-3 text-center font-semibold text-white hover:bg-white hover:text-[#269763] focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-[#269763]">
                                        Join
                                    </a>
                                    <a href="#" class="inline-flex items-center text-white hover:text-[#e6e6e6] font-semibold">
                                        Learn More
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="ml-1"><path d="m9 18 6-6-6-6"/></svg>
                                    </a>
                                <?php endif; ?>
                            </div>
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
    // CTA Component
    if (have_rows('cta_3')) :
        while (have_rows('cta_3')) : the_row();
    ?>
        <section class="px-[5%] py-16 md:py-24 lg:py-28 bg-[#f6f6f6]">
            <div class="container mx-auto grid w-full grid-cols-1 items-start justify-between gap-6 md:grid-cols-[1fr_max-content] md:gap-x-12 md:gap-y-8 lg:gap-x-20">
                <div class="md:mr-12 lg:mr-0">
                    <div class="w-full max-w-lg">
                        <h2 class="mb-3 text-4xl font-bold leading-[1.2] md:mb-4 md:text-5xl lg:text-6xl">
                            <?php the_sub_field('title'); ?>
                        </h2>
                        <p class="md:text-md">
                            <?php the_sub_field('content'); ?>
                        </p>
                    </div>
                </div>
                <div class="flex items-start justify-start gap-4">
                    <?php 
                    if (have_rows('buttons')) :
                        while (have_rows('buttons')) : the_row();
                            $button_one_label = get_sub_field('button_one_label');
                            $button_one_link = get_sub_field('button_one_link');
                            $button_two_label = get_sub_field('button_two_label');
                            $button_two_link = get_sub_field('button_two_link');
                    ?>
                            <?php if ($button_one_link) : ?>
                                <a href="<?php echo esc_url($button_one_link); ?>" class="inline-flex items-center justify-center rounded-md bg-[#269763] px-6 py-3 text-center font-semibold text-white hover:bg-[#1c7049] focus:outline-none focus:ring-2 focus:ring-[#269763] focus:ring-offset-2">
                                    <?php echo esc_html($button_one_label); ?>
                                </a>
                            <?php endif; ?>
                            <?php if ($button_two_link) : ?>
                                <a href="<?php echo esc_url($button_two_link); ?>" class="inline-flex items-center justify-center rounded-md border border-[#141414] bg-white px-6 py-3 text-center font-semibold text-[#141414] hover:bg-[#f0f0f0] focus:outline-none focus:ring-2 focus:ring-[#141414] focus:ring-offset-2">
                                    <?php echo esc_html($button_two_label); ?>
                                </a>
                            <?php endif; ?>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    <?php
        endwhile;
    endif;
    ?>

</article><!-- #post-<?php the_ID(); ?> -->