<?php
/**
 * Template part for displaying the playdate registration form
 */

// Get the current playdate
$playdate_id = get_the_ID();
$price = get_field('price', $playdate_id);
$date = get_field('date', $playdate_id);
?>

<div class="max-w-2xl mx-auto bg-white rounded-lg shadow-sm p-6 md:p-8">
    <form id="playdate-registration-form" class="space-y-6" method="POST">
        <?php wp_nonce_field('playdate_registration_nonce', 'playdate_registration_nonce'); ?>
        <input type="hidden" name="action" value="playdate_registration">
        <input type="hidden" name="playdate_id" value="<?php echo esc_attr($playdate_id); ?>">

        <div class="bg-gray-50 rounded-lg p-4 mb-6">
            <h3 class="font-semibold text-gray-900 mb-2">Playdate Details</h3>
            <div class="grid grid-cols-2 gap-4 text-sm">
                <div>
                    <span class="text-gray-600">Date:</span>
                    <span class="text-gray-900"><?php echo esc_html(date('F j, Y', strtotime($date))); ?></span>
                </div>
                <div>
                    <span class="text-gray-600">Price:</span>
                    <span class="text-gray-900">$<?php echo esc_html(number_format($price, 2)); ?></span>
                </div>
            </div>
        </div>

        <div class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="first_name" class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
                    <input type="text" name="first_name" id="first_name" required
                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-[#269763] focus:ring-[#269763]">
                </div>
                <div>
                    <label for="last_name" class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
                    <input type="text" name="last_name" id="last_name" required
                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-[#269763] focus:ring-[#269763]">
                </div>
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                <input type="email" name="email" id="email" required
                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-[#269763] focus:ring-[#269763]">
            </div>

            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                <input type="tel" name="phone" id="phone" required
                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-[#269763] focus:ring-[#269763]">
            </div>

            <div>
                <label for="handicap" class="block text-sm font-medium text-gray-700 mb-1">Handicap</label>
                <input type="number" name="handicap" id="handicap" min="0" max="36" step="0.1" required
                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-[#269763] focus:ring-[#269763]">
            </div>

            <div>
                <label for="special_requests" class="block text-sm font-medium text-gray-700 mb-1">Special Requests (Optional)</label>
                <textarea name="special_requests" id="special_requests" rows="3"
                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-[#269763] focus:ring-[#269763]"></textarea>
            </div>
        </div>

        <div class="pt-4">
            <button type="submit" class="w-full inline-flex items-center justify-center gap-2 rounded-lg bg-[#269763] px-4 py-2 text-sm font-semibold text-white transition hover:bg-[#269763]/80">
                Register Now
                <i data-lucide="arrow-right" class="h-4 w-4"></i>
            </button>
        </div>
    </form>

    <div id="registration-message" class="hidden mt-4"></div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('playdate-registration-form');
    const messageDiv = document.getElementById('registration-message');

    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Show loading state
            const submitButton = form.querySelector('button[type="submit"]');
            const originalButtonText = submitButton.innerHTML;
            submitButton.innerHTML = '<i data-lucide="loader-2" class="h-4 w-4 animate-spin"></i> Processing...';
            submitButton.disabled = true;

            // Collect form data
            const formData = new FormData(form);

            // Send AJAX request
            fetch(ajax_object.ajax_url, {
                method: 'POST',
                body: formData,
            })
            .then(response => response.json())
            .then(data => {
                messageDiv.classList.remove('hidden');
                
                if (data.success) {
                    messageDiv.className = 'mt-4 p-4 rounded-lg bg-green-50 text-green-800';
                    messageDiv.innerHTML = '<div class="flex items-center gap-2"><i data-lucide="check-circle" class="h-5 w-5"></i>' + data.message + '</div>';
                    form.reset();
                } else {
                    messageDiv.className = 'mt-4 p-4 rounded-lg bg-red-50 text-red-800';
                    messageDiv.innerHTML = '<div class="flex items-center gap-2"><i data-lucide="alert-circle" class="h-5 w-5"></i>' + data.message + '</div>';
                }

                // Reset button state
                submitButton.innerHTML = originalButtonText;
                submitButton.disabled = false;

                // Reinitialize Lucide icons
                if (typeof lucide !== 'undefined') {
                    lucide.createIcons();
                }
            })
            .catch(error => {
                messageDiv.classList.remove('hidden');
                messageDiv.className = 'mt-4 p-4 rounded-lg bg-red-50 text-red-800';
                messageDiv.innerHTML = '<div class="flex items-center gap-2"><i data-lucide="alert-circle" class="h-5 w-5"></i>An error occurred. Please try again.</div>';
                
                // Reset button state
                submitButton.innerHTML = originalButtonText;
                submitButton.disabled = false;

                // Reinitialize Lucide icons
                if (typeof lucide !== 'undefined') {
                    lucide.createIcons();
                }
            });
        });
    }
});
</script>
