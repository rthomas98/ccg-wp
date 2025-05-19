<?php
/**
 * Template part for displaying home page content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package _ccg
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <?php
    // Header78 Component
    if (have_rows('header_78')) :
        while (have_rows('header_78')) : the_row();
            $header = get_sub_field('header');
            $content = get_sub_field('content');
            $images = get_sub_field('images');
    ?>
        <section id="hero" class="px-[5%] py-16 md:py-24 lg:py-28 my-auto">
            <div class="container mx-auto flex flex-col items-center">
                <div class="rb-12 mb-12 max-w-3xl text-center md:mb-18 lg:mb-20">
                    <?php if ($header) : ?>
                        <h1 class="mb-5 text-4xl font-bold md:mb-6 md:text-5xl lg:text-6xl">
                            <?php echo $header; ?>
                        </h1>
                    <?php else : ?>
                        <h1 class="mb-5 text-4xl font-bold md:mb-6 md:text-5xl lg:text-6xl">
                            Elevate Your Golf Experience with Chau Chau Golf Events and Merchandise
                        </h1>
                    <?php endif; ?>

                    <?php if ($content) : ?>
                        <p class="md:text-md">
                            <?php echo $content; ?>
                        </p>
                    <?php else : ?>
                        <p class="md:text-md">
                            Become part of a dynamic community of golf enthusiasts and enhance
                            your skills on the course. Explore thrilling tournaments, access
                            expert resources, and participate in events designed specifically
                            for you.
                        </p>
                    <?php endif; ?>

                    <?php if (have_rows('buttons')) : ?>
                        <div class="mt-6 flex items-center justify-center gap-x-4 md:mt-8">
                            <?php while (have_rows('buttons')) : the_row(); 
                                $button_one_label = get_sub_field('button_one_label');
                                $button_one_link = get_sub_field('button_one_link');
                                $button_two_label = get_sub_field('button_two_label');
                                $button_two_link = get_sub_field('button_two_link');
                            ?>
                                <?php if ($button_one_link && $button_one_label) : ?>
                                    <a href="<?php echo esc_url($button_one_link); ?>" class="inline-block px-5 py-2 bg-[#269763] text-white font-medium rounded-md hover:bg-[#1c7a4e] transition-colors duration-300">
                                        <?php echo esc_html($button_one_label); ?>
                                    </a>
                                <?php endif; ?>

                                <?php if ($button_two_link && $button_two_label) : ?>
                                    <a href="<?php echo esc_url($button_two_link); ?>" class="inline-block px-5 py-2 border border-[#269763] text-[#269763] font-medium rounded-md hover:bg-[#f8f8f8] transition-colors duration-300">
                                        <?php echo esc_html($button_two_label); ?>
                                    </a>
                                <?php endif; ?>

                                <!-- Add Third Button for Modal -->
                                <button type="button" data-modal-target="contact-modal-<?php echo get_the_ID(); ?>" class="open-contact-modal-button inline-block px-5 py-2 bg-[#141414] text-white font-medium rounded-md hover:bg-opacity-80 transition-colors duration-300">
                                Corporation Golf Events?
                                </button>
                            <?php endwhile; ?>
                        </div>
                    <?php else : ?>
                        <div class="mt-6 flex items-center justify-center gap-x-4 md:mt-8">
                            <a href="<?php echo esc_url(home_url('/learn-more')); ?>" class="inline-block px-5 py-2 bg-[#269763] text-white font-medium rounded-md hover:bg-[#1c7a4e] transition-colors duration-300">
                                Learn More
                            </a>
                            <a href="<?php echo esc_url(home_url('/sign-up')); ?>" class="inline-block px-5 py-2 border border-[#269763] text-[#269763] font-medium rounded-md hover:bg-[#f8f8f8] transition-colors duration-300">
                                Sign Up
                            </a>
                            <!-- Add Third Button for Modal (Fallback) -->
                            <button type="button" data-modal-target="contact-modal-<?php echo get_the_ID(); ?>" class="open-contact-modal-button inline-block px-5 py-2 bg-[#141414] text-white font-medium rounded-md hover:bg-opacity-80 transition-colors duration-300">
                                Contact Us
                            </button>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="flex w-screen justify-start overflow-hidden">
                    <div class="grid shrink-0 grid-cols-1 gap-y-4">
                        <div class="grid w-full animate-marquee-top auto-cols-fr grid-cols-2 gap-4 self-center">
                            <div class="grid w-full grid-flow-col gap-4">
                                <?php 
                                if ($images && count($images) >= 6) :
                                    for ($i = 0; $i < 6; $i++) :
                                        $image = $images[$i];
                                ?>
                                <div class="relative w-[60vw] pt-[75%] sm:w-[18rem] md:w-[26rem]">
                                    <img
                                        class="absolute inset-0 size-full object-cover"
                                        src="<?php echo esc_url($image['sizes']['large']); ?>"
                                        alt="<?php echo esc_attr($image['alt']); ?>"
                                    />
                                </div>
                                <?php 
                                    endfor;
                                else :
                                    for ($i = 1; $i <= 6; $i++) :
                                ?>
                                <div class="relative w-[60vw] pt-[75%] sm:w-[18rem] md:w-[26rem]">
                                    <img
                                        class="absolute inset-0 size-full object-cover"
                                        src="https://placehold.co/600x400/269763/FFFFFF.png?text=Golf+Image+<?php echo $i; ?>"
                                        alt="Golf placeholder image <?php echo $i; ?>"
                                    />
                                </div>
                                <?php 
                                    endfor;
                                endif; 
                                ?>
                            </div>
                            <div class="grid w-full grid-flow-col gap-4">
                                <?php 
                                if ($images && count($images) >= 6) :
                                    for ($i = 0; $i < 6; $i++) :
                                        $image = $images[$i];
                                ?>
                                <div class="relative w-[60vw] pt-[75%] sm:w-[18rem] md:w-[26rem]">
                                    <img
                                        class="absolute inset-0 size-full object-cover"
                                        src="<?php echo esc_url($image['sizes']['large']); ?>"
                                        alt="<?php echo esc_attr($image['alt']); ?>"
                                    />
                                </div>
                                <?php 
                                    endfor;
                                else :
                                    for ($i = 1; $i <= 6; $i++) :
                                ?>
                                <div class="relative w-[60vw] pt-[75%] sm:w-[18rem] md:w-[26rem]">
                                    <img
                                        class="absolute inset-0 size-full object-cover"
                                        src="https://placehold.co/600x400/269763/FFFFFF.png?text=Golf+Image+<?php echo $i; ?>"
                                        alt="Golf placeholder image <?php echo $i; ?>"
                                    />
                                </div>
                                <?php 
                                    endfor;
                                endif; 
                                ?>
                            </div>
                        </div>
                        <div class="grid w-full animate-marquee-bottom grid-cols-2 gap-4 self-center">
                            <div class="grid w-full grid-flow-col gap-4">
                                <?php 
                                if ($images && count($images) >= 6) :
                                    for ($i = 0; $i < 6; $i++) :
                                        $image = $images[$i];
                                ?>
                                <div class="relative w-[60vw] pt-[75%] sm:w-[18rem] md:w-[26rem]">
                                    <img
                                        class="absolute inset-0 size-full object-cover"
                                        src="<?php echo esc_url($image['sizes']['large']); ?>"
                                        alt="<?php echo esc_attr($image['alt']); ?>"
                                    />
                                </div>
                                <?php 
                                    endfor;
                                else :
                                    for ($i = 1; $i <= 6; $i++) :
                                ?>
                                <div class="relative w-[60vw] pt-[75%] sm:w-[18rem] md:w-[26rem]">
                                    <img
                                        class="absolute inset-0 size-full object-cover"
                                        src="https://placehold.co/600x400/269763/FFFFFF.png?text=Golf+Image+<?php echo $i; ?>"
                                        alt="Golf placeholder image <?php echo $i; ?>"
                                    />
                                </div>
                                <?php 
                                    endfor;
                                endif; 
                                ?>
                            </div>
                            <div class="grid w-full grid-flow-col gap-4">
                                <?php 
                                if ($images && count($images) >= 6) :
                                    for ($i = 0; $i < 6; $i++) :
                                        $image = $images[$i];
                                ?>
                                <div class="relative w-[60vw] pt-[75%] sm:w-[18rem] md:w-[26rem]">
                                    <img
                                        class="absolute inset-0 size-full object-cover"
                                        src="<?php echo esc_url($image['sizes']['large']); ?>"
                                        alt="<?php echo esc_attr($image['alt']); ?>"
                                    />
                                </div>
                                <?php 
                                    endfor;
                                else :
                                    for ($i = 1; $i <= 6; $i++) :
                                ?>
                                <div class="relative w-[60vw] pt-[75%] sm:w-[18rem] md:w-[26rem]">
                                    <img
                                        class="absolute inset-0 size-full object-cover"
                                        src="https://placehold.co/600x400/269763/FFFFFF.png?text=Golf+Image+<?php echo $i; ?>"
                                        alt="Golf placeholder image <?php echo $i; ?>"
                                    />
                                </div>
                                <?php 
                                    endfor;
                                endif; 
                                ?>
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
    // New Layout241 Component
    if (have_rows('layout_241')) :
        while (have_rows('layout_241')) : the_row();
            $sub_header = get_sub_field('sub_header');
            $header = get_sub_field('header');
            $content = get_sub_field('content');
    ?>
    <section id="relume" class="bg-[#269763] text-white px-[5%] py-16 md:py-24 lg:py-28">
        <div class="container">
            <div class="flex flex-col">
                <div class="rb-12 mb-12 md:mb-18 lg:mb-20">
                    <div class="w-full max-w-lg">
                        <?php if ($sub_header) : ?>
                            <p class="mb-3 font-semibold text-white md:mb-4"><?php echo esc_html($sub_header); ?></p>
                        <?php else : ?>
                            <p class="mb-3 font-semibold text-white md:mb-4">Elevate</p>
                        <?php endif; ?>

                        <?php if ($header) : ?>
                            <h2 class="mb-5 text-4xl font-bold text-white md:mb-6 md:text-5xl lg:text-6xl"><?php echo esc_html($header); ?></h2>
                        <?php else : ?>
                            <h2 class="mb-5 text-4xl font-bold text-white md:mb-6 md:text-5xl lg:text-6xl">Enhance Your Golfing Potential with Our Expertise</h2>
                        <?php endif; ?>

                        <?php if ($content) : ?>
                            <p class="md:text-md text-white"><?php echo esc_html($content); ?></p>
                        <?php else : ?>
                            <p class="md:text-md text-white">At Chau Chau Golf, we facilitate connections for golf enthusiasts with dynamic tournaments and events customized to their skill levels. Our platform offers comprehensive resources and support to elevate your golfing experience.</p>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="grid grid-cols-1 items-start justify-center gap-y-12 md:grid-cols-3 md:gap-x-8 md:gap-y-16 lg:gap-x-12">
                    <?php 
                    if (have_rows('cards')) :
                        while (have_rows('cards')) : the_row();
                            $icon = get_sub_field('icon');
                            $title = get_sub_field('title');
                            $card_content = get_sub_field('content');
                    ?>
                        <div class="flex w-full flex-col">
                            <div class="mb-5 md:mb-6">
                                <?php if ($icon) : ?>
                                    <img src="<?php echo esc_url($icon['url']); ?>" class="size-12" alt="<?php echo esc_attr($icon['alt']); ?>" />
                                <?php else : ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trophy size-12"><path d="M6 9H4.5a2.5 2.5 0 0 1 0-5H6"/><path d="M18 9h1.5a2.5 2.5 0 0 0 0-5H18"/><path d="M4 22h16"/><path d="M10 14.66V17c0 .55-.47.98-.97 1.21C7.85 18.75 7 20.24 7 22"/><path d="M14 14.66V17c0 .55.47.98.97 1.21C16.15 18.75 17 20.24 17 22"/><path d="M18 2H6v7a6 6 0 0 0 12 0V2Z"/></svg>
                                <?php endif; ?>
                            </div>
                            <h3 class="mb-5 text-2xl font-bold text-white md:mb-6 md:text-3xl md:leading-[1.3] lg:text-4xl">
                                <?php echo $title ? esc_html($title) : 'Card Title'; ?>
                            </h3>
                            <p class="text-white">
                                <?php echo $card_content ? esc_html($card_content) : 'Card content goes here.'; ?>
                            </p>
                        </div>
                    <?php 
                        endwhile;
                    else : 
                        // Default cards if none are provided
                    ?>
                        <div class="flex w-full flex-col">
                            <div class="mb-5 md:mb-6">
                                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trophy size-12"><path d="M6 9H4.5a2.5 2.5 0 0 1 0-5H6"/><path d="M18 9h1.5a2.5 2.5 0 0 0 0-5H18"/><path d="M4 22h16"/><path d="M10 14.66V17c0 .55-.47.98-.97 1.21C7.85 18.75 7 20.24 7 22"/><path d="M14 14.66V17c0 .55.47.98.97 1.21C16.15 18.75 17 20.24 17 22"/><path d="M18 2H6v7a6 6 0 0 0 12 0V2Z"/></svg>
                            </div>
                            <h3 class="mb-5 text-2xl font-bold text-white md:mb-6 md:text-3xl md:leading-[1.3] lg:text-4xl">
                                Customized Solutions for Every Golfer
                            </h3>
                            <p class="text-white">
                                Our services include customized tournament setups tailored to your needs, along with expert coaching to help you excel and achieve your goals.
                            </p>
                        </div>
                        <div class="flex w-full flex-col">
                            <div class="mb-5 md:mb-6">
                                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar size-12"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg>
                            </div>
                            <h3 class="mb-5 text-2xl font-bold text-white md:mb-6 md:text-3xl md:leading-[1.3] lg:text-4xl">
                                Stay Informed About Upcoming Events
                            </h3>
                            <p class="text-white">
                                Become a part of our vibrant community today, and ensure you stay informed about all upcoming events so you never miss out on the excitement!
                            </p>
                        </div>
                        <div class="flex w-full flex-col">
                            <div class="mb-5 md:mb-6">
                                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users size-12"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                            </div>
                            <h3 class="mb-5 text-2xl font-bold text-white md:mb-6 md:text-3xl md:leading-[1.3] lg:text-4xl">
                                Join Our Thriving Golf Community
                            </h3>
                            <p class="text-white">
                                Engage with other players to share your unique experiences, tips, and strategies, fostering a vibrant community for everyone involved in the game.
                            </p>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="mt-6 flex flex-wrap items-center gap-4 md:mt-8">
                    <?php 
                    if (have_rows('buttons')) :
                        while (have_rows('buttons')) : the_row();
                            $button_one_label = get_sub_field('button_one_label');
                            $button_one_link = get_sub_field('button_one_link');
                            $button_two_label = get_sub_field('button_two_label');
                            $button_two_link = get_sub_field('button_two_link');
                    ?>
                        <?php if ($button_one_label && $button_one_link) : ?>
                            <a href="<?php echo esc_url($button_one_link); ?>" class="inline-flex items-center justify-center rounded-md bg-white px-6 py-3 text-center font-semibold text-[#269763] hover:bg-[#f0f0f0] focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-[#269763]">
                                <?php echo esc_html($button_one_label); ?>
                            </a>
                        <?php else : ?>
                            <a href="#" class="inline-flex items-center justify-center rounded-md bg-white px-6 py-3 text-center font-semibold text-[#269763] hover:bg-[#f0f0f0] focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-[#269763]">
                                Learn More
                            </a>
                        <?php endif; ?>

                        <?php if ($button_two_label && $button_two_link) : ?>
                            <a href="<?php echo esc_url($button_two_link); ?>" class="inline-flex items-center justify-center font-semibold text-white hover:text-[#f0f0f0] focus:outline-none">
                                <?php echo esc_html($button_two_label); ?>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-right ml-1"><path d="m9 18 6-6-6-6"/></svg>
                            </a>
                        <?php else : ?>
                            <a href="#" class="inline-flex items-center justify-center font-semibold text-white hover:text-[#f0f0f0] focus:outline-none">
                                Sign Up
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-right ml-1"><path d="m9 18 6-6-6-6"/></svg>
                            </a>
                        <?php endif; ?>
                    <?php 
                        endwhile;
                    else : 
                    ?>
                        <a href="#" class="inline-flex items-center justify-center rounded-md bg-white px-6 py-3 text-center font-semibold text-[#269763] hover:bg-[#f0f0f0] focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-[#269763]">
                            Learn More
                        </a>
                        <a href="#" class="inline-flex items-center justify-center font-semibold text-white hover:text-[#f0f0f0] focus:outline-none">
                            Sign Up
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-right ml-1"><path d="m9 18 6-6-6-6"/></svg>
                        </a>
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
    // Layout179 Component
    if (have_rows('layout_179')) :
        while (have_rows('layout_179')) : the_row();
    ?>
        <section id="relume" class="px-[5%] py-16 md:py-24 lg:py-28">
            <div class="container mx-auto">
                <div class="grid grid-cols-1 items-start gap-y-12 md:grid-cols-2 md:gap-x-8 md:gap-y-16 lg:gap-16">
                    <?php if (have_rows('cards')) : ?>
                        <?php while (have_rows('cards')) : the_row(); 
                            $image = get_sub_field('image');
                            $title = get_sub_field('title');
                            $content = get_sub_field('content');
                        ?>
                            <div class="flex flex-col items-center justify-start text-center">
                                <div class="rb-6 mb-6 md:mb-8">
                                    <?php if ($image) : ?>
                                        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                                    <?php else : ?>
                                        <img src="https://d22po4pjz3o32e.cloudfront.net/placeholder-image-landscape.svg" alt="Placeholder image" />
                                    <?php endif; ?>
                                </div>
                                <h3 class="mb-5 text-2xl font-bold md:mb-6 md:text-3xl md:leading-[1.3] lg:text-4xl">
                                    <?php echo $title ? esc_html($title) : 'Unmatched Golf Tournaments for Every Enthusiast'; ?>
                                </h3>
                                <p>
                                    <?php echo $content ? esc_html($content) : 'At Chau Chau Golf, we offer a unique platform for amateur players to showcase their skills in competitive tournaments. Join us for an unforgettable golfing experience that fosters community and sportsmanship.'; ?>
                                </p>
                                <div class="mt-6 flex gap-4 md:mt-8">
                                    <?php if (have_rows('buttons')) : ?>
                                        <?php while (have_rows('buttons')) : the_row(); 
                                            $button_one_label = get_sub_field('button_one_label');
                                            $button_one_link = get_sub_field('button_one_link');
                                        ?>
                                            <?php if ($button_one_label && $button_one_link) : ?>
                                                <a href="<?php echo esc_url($button_one_link); ?>" class="inline-flex items-center justify-center font-semibold text-[#269763] hover:text-[#1c7049]">
                                                    <?php echo esc_html($button_one_label); ?>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-right ml-1"><path d="m9 18 6-6-6-6"/></svg>
                                                </a>
                                            <?php else : ?>
                                                <a href="#" class="inline-flex items-center justify-center font-semibold text-[#269763] hover:text-[#1c7049]">
                                                    Learn More
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-right ml-1"><path d="m9 18 6-6-6-6"/></svg>
                                                </a>
                                            <?php endif; ?>
                                        <?php endwhile; ?>
                                    <?php else : ?>
                                        <a href="#" class="inline-flex items-center justify-center font-semibold text-[#269763] hover:text-[#1c7049]">
                                            Learn More
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-right ml-1"><path d="m9 18 6-6-6-6"/></svg>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php else : ?>
                        <!-- Default content when no cards are defined -->
                        <div class="flex flex-col items-center justify-start text-center">
                            <div class="rb-6 mb-6 md:mb-8">
                                <div class="bg-[#269763] w-full aspect-video flex items-center justify-center rounded-md">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="120" height="120" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check size-24 md:size-32 lg:size-40"><path d="M20 6 9 17l-5-5"/></svg>
                                </div>
                            </div>
                            <h3 class="mb-5 text-2xl font-bold md:mb-6 md:text-3xl md:leading-[1.3] lg:text-4xl">
                                Unmatched Golf Tournaments for Every Enthusiast
                            </h3>
                            <p>
                                At Chau Chau Golf, we offer a unique platform for amateur players to showcase their skills in competitive tournaments. Join us for an unforgettable golfing experience that fosters community and sportsmanship.
                            </p>
                            <div class="mt-6 flex gap-4 md:mt-8">
                                <a href="#" class="inline-flex items-center justify-center font-semibold text-[#269763] hover:text-[#1c7049]">
                                    Learn More
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-right ml-1"><path d="m9 18 6-6-6-6"/></svg>
                                </a>
                            </div>
                        </div>
                        <div class="flex flex-col items-center justify-start text-center">
                            <div class="rb-6 mb-6 md:mb-8">
                                <div class="bg-[#269763] w-full aspect-video flex items-center justify-center rounded-md">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="120" height="120" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check size-24 md:size-32 lg:size-40"><path d="M20 6 9 17l-5-5"/></svg>
                                </div>
                            </div>
                            <h3 class="mb-5 text-2xl font-bold md:mb-6 md:text-3xl md:leading-[1.3] lg:text-4xl">
                                Join Our Thriving Community of Golfers and Tournament Enthusiasts Today
                            </h3>
                            <p>
                                Our events are designed to bring together players of all skill levels, ensuring everyone has a chance to compete and connect. Discover upcoming tournaments and be part of a vibrant golfing community.
                            </p>
                            <div class="mt-6 flex gap-4 md:mt-8">
                                <a href="#" class="inline-flex items-center justify-center font-semibold text-[#269763] hover:text-[#1c7049]">
                                    Sign Up
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-right ml-1"><path d="m9 18 6-6-6-6"/></svg>
                                </a>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    <?php
        endwhile;
    endif;
    ?>


    <?php
    // Layout272 Component
    if (have_rows('layout_272')) :
        while (have_rows('layout_272')) : the_row();
            $sub_header = get_sub_field('sub_header');
            $header = get_sub_field('header');
            $content = get_sub_field('content');
            $video = get_sub_field('video');
    ?>
        <section id="relume" class="relative px-[5%] py-16 md:py-24 lg:py-28">
            <div class="container relative z-10 mx-auto">
                <div class="w-full max-w-lg">
                    <?php if ($sub_header) : ?>
                        <p class="mb-3 font-semibold text-white md:mb-4">
                            <?php echo esc_html($sub_header); ?>
                        </p>
                    <?php else : ?>
                        <p class="mb-3 font-semibold text-white md:mb-4">
                            Connect
                        </p>
                    <?php endif; ?>
                    
                    <?php if ($header) : ?>
                        <h2 class="mb-5 text-4xl font-bold text-white md:text-5xl lg:text-6xl md:mb-6">
                            <?php echo esc_html($header); ?>
                        </h2>
                    <?php else : ?>
                        <h2 class="mb-5 text-4xl font-bold text-white md:text-5xl lg:text-6xl md:mb-6">
                            Join a Community of Passionate Golfers
                        </h2>
                    <?php endif; ?>
                    
                    <?php if ($content) : ?>
                        <p class="text-white md:text-md">
                            <?php echo esc_html($content); ?>
                        </p>
                    <?php else : ?>
                        <p class="text-white md:text-md">
                            At Chau Chau Golf, we bring together golf enthusiasts of all skill levels. Connect with fellow players, share experiences, and enhance your game through our vibrant community.
                        </p>
                    <?php endif; ?>
                </div>
                
                <div class="grid grid-cols-1 items-start gap-y-12 md:grid-cols-3 md:gap-x-8 md:gap-y-16 lg:gap-x-12">
                    <?php if (have_rows('cards')) : ?>
                        <?php while (have_rows('cards')) : the_row(); 
                            $icon = get_sub_field('icon');
                            $title = get_sub_field('title');
                            $card_content = get_sub_field('content');
                        ?>
                            <div class="w-full">
                                <div class="mb-5 h-12 md:mb-6">
                                    <div class="inline-block">
                                        <?php if ($icon) : ?>
                                            <?php echo $icon; ?>
                                        <?php else : ?>
                                            <div class="bg-[#269763] size-12 flex items-center justify-center rounded-md">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check"><path d="M20 6 9 17l-5-5"/></svg>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <h3 class="mb-5 text-2xl font-bold text-white md:mb-6 md:text-3xl md:leading-[1.3] lg:text-4xl">
                                    <?php echo $title ? esc_html($title) : 'Card Title'; ?>
                                </h3>
                                <p class="text-white">
                                    <?php echo $card_content ? esc_html($card_content) : 'Card content goes here.'; ?>
                                </p>
                            </div>
                        <?php endwhile; ?>
                    <?php else : ?>
                        <!-- Default card 1 -->
                        <div class="w-full">
                            <div class="mb-5 h-12 md:mb-6">
                                <div class="inline-block">
                                    <div class="bg-[#269763] size-12 flex items-center justify-center rounded-md">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar"><path d="M8 2v4"/><path d="M16 2v4"/><rect width="18" height="18" x="3" y="4" rx="2"/><path d="M3 10h18"/></svg>
                                    </div>
                                </div>
                            </div>
                            <h3 class="mb-5 text-2xl font-bold text-white md:mb-6 md:text-3xl md:leading-[1.3] lg:text-4xl">
                                Discover Upcoming Tournaments and Events
                            </h3>
                            <p class="text-white">
                                Keep yourself updated on thrilling tournaments and events happening in your local area, so you never miss out on the excitement and fun!
                            </p>
                        </div>
                        
                        <!-- Default card 2 -->
                        <div class="w-full">
                            <div class="mb-5 h-12 md:mb-6">
                                <div class="inline-block">
                                    <div class="bg-[#269763] size-12 flex items-center justify-center rounded-md">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-book-open"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
                                    </div>
                                </div>
                            </div>
                            <h3 class="mb-5 text-2xl font-bold text-white md:mb-6 md:text-3xl md:leading-[1.3] lg:text-4xl">
                                Enhance Your Skills with Expert Resources
                            </h3>
                            <p class="text-white">
                                Discover a wealth of valuable tips and resources designed to help you enhance your gaming skills and elevate your performance.
                            </p>
                        </div>
                        
                        <!-- Default card 3 -->
                        <div class="w-full">
                            <div class="mb-5 h-12 md:mb-6">
                                <div class="inline-block">
                                    <div class="bg-[#269763] size-12 flex items-center justify-center rounded-md">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                                    </div>
                                </div>
                            </div>
                            <h3 class="mb-5 text-2xl font-bold text-white md:mb-6 md:text-3xl md:leading-[1.3] lg:text-4xl">
                                Network with Players and Organizers
                            </h3>
                            <p class="text-white">
                                Establish meaningful connections that can open doors to exciting new opportunities and experiences in your professional journey.
                            </p>
                        </div>
                    <?php endif; ?>
                </div>
                
                <div class="mt-12 flex flex-wrap gap-4 md:mt-18 lg:mt-20">
                    <?php if (have_rows('buttons')) : ?>
                        <?php while (have_rows('buttons')) : the_row(); 
                            $button_one_label = get_sub_field('button_one_label');
                            $button_one_link = get_sub_field('button_one_link');
                            $button_two_label = get_sub_field('button_two_label');
                            $button_two_link = get_sub_field('button_two_link');
                        ?>
                            <?php if ($button_one_label && $button_one_link) : ?>
                                <a href="<?php echo esc_url($button_one_link); ?>" class="inline-flex items-center justify-center rounded-md bg-white px-6 py-3 text-center font-semibold text-black hover:bg-[#f0f0f0] focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-black">
                                    <?php echo esc_html($button_one_label); ?>
                                </a>
                            <?php else : ?>
                                <a href="#" class="inline-flex items-center justify-center rounded-md bg-white px-6 py-3 text-center font-semibold text-black hover:bg-[#f0f0f0] focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-black">
                                    Learn More
                                </a>
                            <?php endif; ?>
                            
                            <?php if ($button_two_label && $button_two_link) : ?>
                                <a href="<?php echo esc_url($button_two_link); ?>" class="inline-flex items-center justify-center font-semibold text-white hover:text-[#f0f0f0]">
                                    <?php echo esc_html($button_two_label); ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-right ml-1"><path d="m9 18 6-6-6-6"/></svg>
                                </a>
                            <?php else : ?>
                                <a href="#" class="inline-flex items-center justify-center font-semibold text-white hover:text-[#f0f0f0]">
                                    Sign Up
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-right ml-1"><path d="m9 18 6-6-6-6"/></svg>
                                </a>
                            <?php endif; ?>
                        <?php endwhile; ?>
                    <?php else : ?>
                        <a href="#" class="inline-flex items-center justify-center rounded-md bg-white px-6 py-3 text-center font-semibold text-black hover:bg-[#f0f0f0] focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-black">
                            Learn More
                        </a>
                        <a href="#" class="inline-flex items-center justify-center font-semibold text-white hover:text-[#f0f0f0]">
                            Sign Up
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-right ml-1"><path d="m9 18 6-6-6-6"/></svg>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
            
            <div class="absolute inset-0 z-0">
                <?php if ($video) : ?>
                    <video class="absolute inset-0 aspect-video size-full object-cover" autoplay loop muted playsinline>
                        <source src="<?php echo esc_url($video['url']); ?>" type="video/mp4">
                    </video>
                <?php else : ?>
                    <video class="absolute inset-0 aspect-video size-full object-cover" autoplay loop muted playsinline>
                        <source src="<?php echo esc_url(str_replace('http://localhost:10023', site_url(), '/wp-content/uploads/2025/02/854185-hd_1920_1080_24fps.mp4')); ?>" type="video/mp4">
                    </video>
                <?php endif; ?>
                <div class="absolute inset-0 bg-black/50"></div>
            </div>
        </section>
    <?php
        endwhile;
    endif;
    ?>

    <?php
    // Cta3 Component
    if (have_rows('cta_3')) :
        while (have_rows('cta_3')) : the_row();
            $title = get_sub_field('title');
            $content = get_sub_field('content');
            $image = get_sub_field('image');
    ?>
        <section id="relume" class="relative px-[5%] py-16 md:py-24 lg:py-28">
            <div class="container relative z-10 mx-auto">
                <div class="w-full max-w-[30vw]">
                    <?php if ($title) : ?>
                        <h2 class="mb-5 text-4xl font-bold text-white md:text-5xl lg:text-6xl md:mb-6">
                            <?php echo esc_html($title); ?>
                        </h2>
                    <?php else : ?>
                        <h2 class="mb-5 text-4xl font-bold text-white md:text-5xl lg:text-6xl md:mb-6">
                            Join the Golf Community Today
                        </h2>
                    <?php endif; ?>
                    
                    <?php if ($content) : ?>
                        <p class="text-white md:text-md">
                            <?php echo esc_html($content); ?>
                        </p>
                    <?php else : ?>
                        <p class="text-white md:text-md">
                            Stay informed about upcoming tournaments, exciting events, and special offers designed specifically for golf enthusiasts like you. Don't miss out on the latest news and opportunities that cater to your passion for the game of golf!
                        </p>
                    <?php endif; ?>
                    
                    <div class="mt-6 flex flex-wrap gap-4 md:mt-8">
                        <?php if (have_rows('buttons')) : ?>
                            <?php while (have_rows('buttons')) : the_row(); 
                                $button_one_label = get_sub_field('button_one_label');
                                $button_one_link = get_sub_field('button_one_link');
                                $button_two_label = get_sub_field('button_two_label');
                                $button_two_link = get_sub_field('button_two_link');
                            ?>
                                <?php if ($button_one_label && $button_one_link) : ?>
                                    <a href="<?php echo esc_url($button_one_link); ?>" class="inline-flex items-center justify-center rounded-md bg-[#269763] px-6 py-3 text-center font-semibold text-white hover:bg-[#1c7049] focus:outline-none focus:ring-2 focus:ring-[#269763] focus:ring-offset-2 focus:ring-offset-black">
                                        <?php echo esc_html($button_one_label); ?>
                                    </a>
                                <?php else : ?>
                                    <a href="#" class="inline-flex items-center justify-center rounded-md bg-[#269763] px-6 py-3 text-center font-semibold text-white hover:bg-[#1c7049] focus:outline-none focus:ring-2 focus:ring-[#269763] focus:ring-offset-2 focus:ring-offset-black">
                                        Sign Up
                                    </a>
                                <?php endif; ?>
                                
                                <?php if ($button_two_label && $button_two_link) : ?>
                                    <a href="<?php echo esc_url($button_two_link); ?>" class="inline-flex items-center justify-center rounded-md bg-white px-6 py-3 text-center font-semibold text-black hover:bg-[#f0f0f0] focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-black">
                                        <?php echo esc_html($button_two_label); ?>
                                    </a>
                                <?php else : ?>
                                    <a href="#" class="inline-flex items-center justify-center rounded-md bg-white px-6 py-3 text-center font-semibold text-black hover:bg-[#f0f0f0] focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-black">
                                        Learn More
                                    </a>
                                <?php endif; ?>
                            <?php endwhile; ?>
                        <?php else : ?>
                            <a href="#" class="inline-flex items-center justify-center rounded-md bg-[#269763] px-6 py-3 text-center font-semibold text-white hover:bg-[#1c7049] focus:outline-none focus:ring-2 focus:ring-[#269763] focus:ring-offset-2 focus:ring-offset-black">
                                Sign Up
                            </a>
                            <a href="#" class="inline-flex items-center justify-center rounded-md bg-white px-6 py-3 text-center font-semibold text-black hover:bg-[#f0f0f0] focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-black">
                                Learn More
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            
            <div class="absolute inset-0 z-0">
                <?php if ($image) : ?>
                    <img src="<?php echo esc_url($image); ?>" class="size-full object-cover" alt="<?php echo $title ? esc_attr($title) : 'Background image'; ?>" />
                <?php else : ?>
                    <img src="<?php echo esc_url(get_stylesheet_directory_uri() . '/assets/images/golf-background.jpg'); ?>" class="size-full object-cover" alt="Golf background" onerror="this.src='https://d22po4pjz3o32e.cloudfront.net/placeholder-image.svg'; this.onerror=null;" />
                <?php endif; ?>
                <div class="absolute inset-0 bg-black/50"></div>
            </div>
        </section>
    <?php
        endwhile;
    endif;
    ?>

    <!-- Fluent Form Modal -->
    <div id="contact-modal-<?php echo get_the_ID(); ?>" class="contact-modal fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-50 p-4" aria-labelledby="modal-title-<?php echo get_the_ID(); ?>" role="dialog" aria-modal="true">
        <div class="relative w-full max-w-[50vw] max-h-[90vh] rounded-lg bg-white p-6 shadow-xl sm:p-8 overflow-y-auto">
            <button type="button" data-modal-close="contact-modal-<?php echo get_the_ID(); ?>" class="close-contact-modal-button sticky top-3 right-3 float-right text-gray-400 hover:text-gray-600 z-10">
                <span class="sr-only">Close modal</span>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x h-6 w-6"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
            </button>
            <h2 id="modal-title-<?php echo get_the_ID(); ?>" class="mb-4 text-center text-2xl font-bold">Contact Us</h2>
            <?php echo do_shortcode('[fluentform id="7"]'); ?>
        </div>
    </div>

    <?php
    // Layout 190 Component
    if (have_rows('layout_190')) :
        while (have_rows('layout_190')) : the_row();
            $sub_header = get_sub_field('sub_header');
            $header = get_sub_field('header');
            $content = get_sub_field('content');
    ?>
        <section id="layout190" class="px-[5%] py-16 md:py-24 lg:py-28">
            <div class="container mx-auto">
                <div class="flex flex-col items-center">
                    <div class="mb-12 text-center md:mb-18 lg:mb-20">
                        <div class="mx-auto w-full max-w-3xl">
                            <?php if ($sub_header) : ?>
                                <p class="mb-3 font-semibold md:mb-4"><?php echo esc_html($sub_header); ?></p>
                            <?php endif; ?>
                            
                            <?php if ($header) : ?>
                                <h2 class="mb-5 text-4xl font-bold md:mb-6 md:text-5xl lg:text-6xl"><?php echo esc_html($header); ?></h2>
                            <?php endif; ?>
                            
                            <?php if ($content) : ?>
                                <p class="md:text-md"><?php echo esc_html($content); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <?php if (have_rows('cards')) : ?>
                        <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
                            <?php while (have_rows('cards')) : the_row(); 
                                $card_image = get_sub_field('image');
                                $card_title = get_sub_field('title');
                                $card_content = get_sub_field('content');
                            ?>
                                <div class="flex flex-col items-center text-center">
                                    <?php if ($card_image) : ?>
                                        <img src="<?php echo esc_url($card_image['url']); ?>" alt="<?php echo esc_attr($card_image['alt']); ?>" class="mb-6 w-full object-cover md:mb-8" />
                                    <?php endif; ?>
                                    
                                    <?php if ($card_title) : ?>
                                        <h3 class="mb-4 text-xl font-bold md:text-2xl"><?php echo esc_html($card_title); ?></h3>
                                    <?php endif; ?>
                                    
                                    <?php if ($card_content) : ?>
                                        <p><?php echo esc_html($card_content); ?></p>
                                    <?php endif; ?>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    <?php
        endwhile;
    endif; // End Layout 190 Component
    ?>

</article><!-- #post-<?php the_ID(); ?> -->