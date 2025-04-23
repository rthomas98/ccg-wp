    <!-- Fluent Form Modal -->
    <div id="contact-modal-<?php echo get_the_ID(); ?>" class="contact-modal fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-50 p-4" aria-labelledby="modal-title-<?php echo get_the_ID(); ?>" role="dialog" aria-modal="true">
        <div class="relative w-full max-w-[50vw] rounded-lg bg-white p-6 shadow-xl sm:p-8">
            <button type="button" data-modal-close="contact-modal-<?php echo get_the_ID(); ?>" class="close-contact-modal-button absolute top-3 right-3 text-gray-400 hover:text-gray-600">
                <span class="sr-only">Close modal</span>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x h-6 w-6"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
            </button>
            <h2 id="modal-title-<?php echo get_the_ID(); ?>" class="mb-4 text-center text-2xl font-bold">Contact Us</h2>
            <?php echo do_shortcode('[fluentform id="7"]'); ?>
        </div>
    </div>
