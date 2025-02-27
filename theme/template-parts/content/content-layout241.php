<?php
/**
 * Template part for displaying the Layout241 component
 *
 * @package _ccg
 */

// Get ACF fields
$sub_header = get_field('layout_241_sub_header');
$header = get_field('layout_241_header');
$content = get_field('layout_241_content');
$cards = get_field('layout_241_cards');
$button_one_label = get_field('layout_241_button_one_label');
$button_one_link = get_field('layout_241_button_one_link');
$button_two_label = get_field('layout_241_button_two_label');
$button_two_link = get_field('layout_241_button_two_link');
?>

<section class="bg-[#269763] px-[5%] py-16 md:py-24 lg:py-28">
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
                if ($cards && count($cards) > 0) :
                    foreach ($cards as $card) :
                        $icon_type = !empty($card['icon_type']) ? $card['icon_type'] : 'golf';
                ?>
                    <div class="flex w-full flex-col">
                        <div class="mb-5 md:mb-6">
                            <?php if (!empty($card['icon'])) : ?>
                                <img src="<?php echo esc_url($card['icon']['url']); ?>" class="size-12" alt="<?php echo esc_attr($card['icon']['alt']); ?>" />
                            <?php elseif ($icon_type === 'trophy') : ?>
                                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trophy"><path d="M6 9H4.5a2.5 2.5 0 0 1 0-5H6"/><path d="M18 9h1.5a2.5 2.5 0 0 0 0-5H18"/><path d="M4 22h16"/><path d="M10 14.66V17c0 .55-.47.98-.97 1.21C7.85 18.75 7 20.24 7 22"/><path d="M14 14.66V17c0 .55.47.98.97 1.21C16.15 18.75 17 20.24 17 22"/><path d="M18 2H6v7a6 6 0 0 0 12 0V2Z"/></svg>
                            <?php elseif ($icon_type === 'calendar') : ?>
                                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg>
                            <?php elseif ($icon_type === 'users') : ?>
                                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                            <?php elseif ($icon_type === 'target') : ?>
                                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-target"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="6"/><circle cx="12" cy="12" r="2"/></svg>
                            <?php elseif ($icon_type === 'award') : ?>
                                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-award"><circle cx="12" cy="8" r="7"/><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"/></svg>
                            <?php elseif ($icon_type === 'flag') : ?>
                                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-flag"><path d="M4 15s1-1 4-1 5 2 8 2 4-1 4-1V3s-1 1-4 1-5-2-8-2-4 1-4 1z"/><line x1="4" x2="4" y1="22" y2="15"/></svg>
                            <?php else : ?>
                                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-golf"><path d="M12 18V5l7 8-7 8"/><path d="M5 5.5C5 8 7 10 12 10"/></svg>
                            <?php endif; ?>
                        </div>
                        <h3 class="mb-5 text-2xl font-bold text-white md:mb-6 md:text-3xl md:leading-[1.3] lg:text-4xl">
                            <?php echo !empty($card['title']) ? esc_html($card['title']) : 'Card Title'; ?>
                        </h3>
                        <p class="text-white">
                            <?php echo !empty($card['content']) ? esc_html($card['content']) : 'Card content goes here.'; ?>
                        </p>
                    </div>
                <?php 
                    endforeach;
                else : 
                    // Default cards if none are provided
                    $default_cards = [
                        [
                            'title' => 'Customized Solutions for Every Golfer',
                            'content' => 'Our services include customized tournament setups tailored to your needs, along with expert coaching to help you excel and achieve your goals.',
                            'icon_type' => 'trophy'
                        ],
                        [
                            'title' => 'Stay Informed About Upcoming Events',
                            'content' => 'Become a part of our vibrant community today, and ensure you stay informed about all upcoming events so you never miss out on the excitement!',
                            'icon_type' => 'calendar'
                        ],
                        [
                            'title' => 'Join Our Thriving Golf Community',
                            'content' => 'Engage with other players to share your unique experiences, tips, and strategies, fostering a vibrant community for everyone involved in the game.',
                            'icon_type' => 'users'
                        ]
                    ];
                    
                    foreach ($default_cards as $card) :
                ?>
                    <div class="flex w-full flex-col">
                        <div class="mb-5 md:mb-6">
                            <?php if ($card['icon_type'] === 'trophy') : ?>
                                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trophy"><path d="M6 9H4.5a2.5 2.5 0 0 1 0-5H6"/><path d="M18 9h1.5a2.5 2.5 0 0 0 0-5H18"/><path d="M4 22h16"/><path d="M10 14.66V17c0 .55-.47.98-.97 1.21C7.85 18.75 7 20.24 7 22"/><path d="M14 14.66V17c0 .55.47.98.97 1.21C16.15 18.75 17 20.24 17 22"/><path d="M18 2H6v7a6 6 0 0 0 12 0V2Z"/></svg>
                            <?php elseif ($card['icon_type'] === 'calendar') : ?>
                                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg>
                            <?php elseif ($card['icon_type'] === 'users') : ?>
                                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                            <?php elseif ($card['icon_type'] === 'target') : ?>
                                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-target"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="6"/><circle cx="12" cy="12" r="2"/></svg>
                            <?php elseif ($card['icon_type'] === 'award') : ?>
                                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-award"><circle cx="12" cy="8" r="7"/><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"/></svg>
                            <?php elseif ($card['icon_type'] === 'flag') : ?>
                                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-flag"><path d="M4 15s1-1 4-1 5 2 8 2 4-1 4-1V3s-1 1-4 1-5-2-8-2-4 1-4 1z"/><line x1="4" x2="4" y1="22" y2="15"/></svg>
                            <?php else : ?>
                                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-golf"><path d="M12 18V5l7 8-7 8"/><path d="M5 5.5C5 8 7 10 12 10"/></svg>
                            <?php endif; ?>
                        </div>
                        <h3 class="mb-5 text-2xl font-bold text-white md:mb-6 md:text-3xl md:leading-[1.3] lg:text-4xl">
                            <?php echo esc_html($card['title']); ?>
                        </h3>
                        <p class="text-white">
                            <?php echo esc_html($card['content']); ?>
                        </p>
                    </div>
                <?php 
                    endforeach;
                endif; 
                ?>
            </div>

            <div class="mt-6 flex flex-wrap items-center gap-4 md:mt-8">
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
            </div>
        </div>
    </div>
</section>
