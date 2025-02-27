<?php
/**
 * Template part for displaying Layout408 component
 *
 * @package _ccg
 */

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
                        <?php if ($card_image) : ?>
                            <img src="<?php echo esc_url($card_image['url']); ?>" alt="<?php echo esc_attr($card_image['alt']); ?>" class="w-full h-auto">
                        <?php else : ?>
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
                        <?php if ($card_image) : ?>
                            <img src="<?php echo esc_url($card_image['url']); ?>" alt="<?php echo esc_attr($card_image['alt']); ?>" class="w-full h-full object-cover">
                        <?php else : ?>
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
                
                foreach ($default_cards as $index => $card) :
                    $card_count = $index + 1;
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
