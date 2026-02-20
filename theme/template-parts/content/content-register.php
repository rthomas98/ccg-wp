<?php
/**
 * Template part for displaying registration content
 */
?>

<section class="grid grid-cols-1 gap-y-16 py-24 md:grid-flow-row md:py-32 lg:grid-flow-col lg:grid-cols-2 lg:items-center">
    <div class="mx-[5%] max-w-[40rem] justify-self-start lg:ml-[5vw] lg:mr-20 lg:justify-self-end pt-16">
        <?php if (have_rows('header_76')) : ?>
            <?php while (have_rows('header_76')) : the_row(); ?>
                <h1 class="mb-5 text-4xl font-bold md:mb-6 md:text-5xl lg:text-6xl">
                    <?php echo wp_kses_post(get_sub_field('header')); ?>
                </h1>
                
                <div class="md:text-md prose max-w-none">
                    <?php echo wp_kses_post(get_sub_field('content')); ?>
                </div>

                <?php if (get_sub_field('form')) : ?>
                    <div class="mt-6 md:mt-8">
                        <?php if (is_user_logged_in()) : ?>
                            <div class="rounded-lg bg-[#269763]/10 p-6">
                                <div class="flex items-start gap-4">
                                    <i data-lucide="check-circle" class="h-6 w-6 text-[#269763]"></i>
                                    <div>
                                        <h3 class="mb-2 font-semibold">You're Already Registered!</h3>
                                        <p class="text-gray-600">You already have an account with us. Visit your dashboard to manage your profile and tournaments.</p>
                                        <a href="<?php echo esc_url(home_url('/dashboard')); ?>" class="mt-4 inline-flex items-center gap-2 text-[#269763] hover:underline">
                                            Go to Dashboard
                                            <i data-lucide="arrow-right" class="h-4 w-4"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php else : ?>
                            <?php
                            $stripe_individual = get_field( 'stripe_individual_link' );
                            $stripe_business   = get_field( 'stripe_business_link' );
                            ?>
                            <div class="ccg-registration-form"
                                 data-stripe-individual="<?php echo esc_url( $stripe_individual ); ?>"
                                 data-stripe-business="<?php echo esc_url( $stripe_business ); ?>">
                                <?php echo do_shortcode( get_sub_field( 'form' ) ); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>

    <div class="relative h-[30rem] overflow-hidden pl-[5vw] pr-[5vw] md:h-[40rem] lg:h-screen lg:pl-0">
        <?php if (have_rows('header_76')) : ?>
            <?php while (have_rows('header_76')) : the_row(); ?>
                <?php $gallery_images = get_sub_field('gallery'); ?>
                <?php if ($gallery_images) : ?>
                    <div class="absolute inset-0 grid w-full grid-cols-2 gap-x-4">
                        <!-- First Column -->
                        <div class="relative grid size-full grid-cols-1 gap-4">
                            <div class="animate-loop-vertically">
                                <?php foreach ($gallery_images as $index => $image) : ?>
                                    <div class="mb-4 aspect-[3/4] w-full">
                                        <img class="size-full object-cover" 
                                             src="<?php echo esc_url($image['sizes']['large']); ?>" 
                                             alt="<?php echo esc_attr($image['alt']); ?>" />
                                    </div>
                                <?php endforeach; ?>
                                <?php foreach ($gallery_images as $index => $image) : ?>
                                    <div class="mb-4 aspect-[3/4] w-full">
                                        <img class="size-full object-cover" 
                                             src="<?php echo esc_url($image['sizes']['large']); ?>" 
                                             alt="<?php echo esc_attr($image['alt']); ?>" />
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <!-- Second Column -->
                        <div class="relative grid size-full grid-cols-1 gap-4">
                            <div class="animate-loop-vertically-delayed">
                                <?php foreach ($gallery_images as $index => $image) : ?>
                                    <div class="mb-4 aspect-[3/4] w-full">
                                        <img class="size-full object-cover" 
                                             src="<?php echo esc_url($image['sizes']['large']); ?>" 
                                             alt="<?php echo esc_attr($image['alt']); ?>" />
                                    </div>
                                <?php endforeach; ?>
                                <?php foreach ($gallery_images as $index => $image) : ?>
                                    <div class="mb-4 aspect-[3/4] w-full">
                                        <img class="size-full object-cover" 
                                             src="<?php echo esc_url($image['sizes']['large']); ?>" 
                                             alt="<?php echo esc_attr($image['alt']); ?>" />
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>
</section>

<style>
@keyframes loopVertically {
    0% {
        transform: translateY(0);
    }
    100% {
        transform: translateY(-50%);
    }
}

.animate-loop-vertically {
    animation: loopVertically 30s linear infinite;
}

.animate-loop-vertically-delayed {
    animation: loopVertically 30s linear infinite;
    animation-delay: -15s;
}
</style>