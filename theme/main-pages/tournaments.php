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
 

        <!-- Upcoming Tournaments Section -->
        <section id="upcoming-tournaments" class="bg-gray-50 px-[5%] py-16 md:py-24">
            <div class="container mx-auto">
                <div class="mb-12 text-center">
                    <h2 class="text-4xl font-bold md:text-5xl lg:text-6xl">All Tournaments</h2>
                    <p class="mt-4 text-gray-600 max-w-3xl mx-auto">Browse our tournament schedule and register for upcoming events.</p>
                </div>

                <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                    <?php
                    // Get current date in ACF format (Ymd)
                    $today = date('Ymd');
                    
                    // Query for all tournaments without date filtering
                    $args = array(
                        'post_type' => 'tournament',
                        'posts_per_page' => -1,
                        'post_status' => 'publish',
                        'orderby' => 'date',
                        'order' => 'DESC'
                    );

                    $upcoming_tournaments = new WP_Query($args);

                    if ($upcoming_tournaments->have_posts()) :
                        while ($upcoming_tournaments->have_posts()) : $upcoming_tournaments->the_post();
                            // Get tournament details
                            if (have_rows('tournament_details')) :
                                while (have_rows('tournament_details')) : the_row();
                                    $tournament_date = get_sub_field('tournament_date', false);
                                    $location = get_sub_field('location');
                                    $golf_course_name = get_sub_field('golf_course_name');
                                    $tournament_status = get_sub_field('tournament_status');
                                    
                                    // Format date
                                    $date_obj = null;
                                    if (!empty($tournament_date)) {
                                        if (is_string($tournament_date)) {
                                            // Try different date formats
                                            $date_obj = DateTime::createFromFormat('Ymd', $tournament_date);
                                            if (!$date_obj) {
                                                $date_obj = DateTime::createFromFormat('Y-m-d', $tournament_date);
                                            }
                                        } elseif (is_numeric($tournament_date)) {
                                            $date_obj = new DateTime();
                                            $date_obj->setTimestamp($tournament_date);
                                        }
                                    }
                                    
                                    $formatted_date = $date_obj ? $date_obj->format('F j, Y') : '';
                                    $weekday = $date_obj ? $date_obj->format('D') : '';
                                    $day = $date_obj ? $date_obj->format('d') : '';
                                    $monthYear = $date_obj ? $date_obj->format('M Y') : '';
                                    ?>
                                    
                                    <div class="bg-white rounded-lg shadow-sm overflow-hidden transition-transform duration-300 hover:shadow-md hover:-translate-y-1">
                                        <div class="relative">
                                            <?php 
                                            $featured_image = '';
                                            if (have_rows('media')) {
                                                while (have_rows('media')) {
                                                    the_row();
                                                    if (get_sub_field('featured_image')) {
                                                        $featured_image = get_sub_field('featured_image')['url'];
                                                        break;
                                                    }
                                                }
                                            }
                                            
                                            if (empty($featured_image) && has_post_thumbnail()) {
                                                $featured_image = get_the_post_thumbnail_url(get_the_ID(), 'large');
                                            }
                                            ?>
                                            
                                            <?php if (!empty($featured_image)) : ?>
                                                <img src="<?php echo esc_url($featured_image); ?>" alt="<?php the_title_attribute(); ?>" class="w-full h-48 object-cover">
                                            <?php endif; ?>
                                            
                                            <?php if ($weekday && $day && $monthYear) : ?>
                                                <div class="absolute right-4 top-4 z-20 flex min-w-[120px] flex-col items-center bg-white p-4 shadow-md">
                                                    <span class="text-base font-medium text-[#141414]"><?php echo esc_html($weekday); ?></span>
                                                    <span class="text-[42px] leading-[1] font-bold text-[#141414]"><?php echo esc_html($day); ?></span>
                                                    <span class="text-base font-medium text-[#141414]"><?php echo esc_html($monthYear); ?></span>
                                                </div>
                                            <?php endif; ?>
                                            
                                            <?php if ($tournament_status) : ?>
                                                <div class="absolute left-4 top-4 z-10 rounded-md bg-[#269763] px-3 py-1 text-sm font-medium text-white">
                                                    <?php echo esc_html($tournament_status); ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        
                                        <div class="p-6">
                                            <h3 class="text-xl font-bold mb-2"><?php the_title(); ?></h3>
                                            
                                            <?php if ($location || $golf_course_name) : ?>
                                                <div class="flex items-center text-gray-600 mb-3">
                                                    <i data-lucide="map-pin" class="h-5 w-5 mr-2 text-[#269763]"></i>
                                                    <span><?php echo esc_html($golf_course_name ?: $location); ?></span>
                                                </div>
                                            <?php endif; ?>
                                            
                                            <?php if ($formatted_date) : ?>
                                                <div class="flex items-center text-gray-600 mb-4">
                                                    <i data-lucide="calendar" class="h-5 w-5 mr-2 text-[#269763]"></i>
                                                    <span><?php echo esc_html($formatted_date); ?></span>
                                                </div>
                                            <?php endif; ?>
                                            
                                            <div class="mt-4">
                                                <a href="<?php the_permalink(); ?>" class="inline-flex items-center text-[#269763] hover:text-[#1a704a] transition-colors">
                                                    View details
                                                    <i data-lucide="chevron-right" class="ml-2 h-5 w-5"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    
                                <?php endwhile;
                            endif;
                        endwhile;
                        wp_reset_postdata();
                    else : ?>
                        <div class="col-span-full text-center py-12">
                            <p class="text-xl text-gray-600">No upcoming tournaments found.</p>
                            <p class="mt-4">Check back soon for new tournament announcements!</p>
                        </div>
                    <?php endif; ?>
                </div>
                
                <?php if ($upcoming_tournaments->found_posts > 6) : ?>
                    <div class="mt-12 text-center">
                        <a href="<?php echo get_post_type_archive_link('tournament'); ?>" class="inline-flex items-center justify-center rounded-md border-2 border-[#269763] bg-transparent px-6 py-3 text-center font-semibold text-[#269763] hover:bg-[#269763] hover:text-white focus:outline-none focus:ring-2 focus:ring-[#269763] focus:ring-offset-2">
                            View All Tournaments
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </section>

        <!-- Additional Content -->
        <?php the_content(); ?>
    </main>
</section>

<!-- Initialize Lucide Icons -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    });
</script>

<?php
get_footer();