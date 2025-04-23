<?php
/**
 * Template part for displaying the playdate waitlist form
 */

// Get the current playdate
$playdate_id = get_the_ID();

// Initialize price display
$price_display = 'TBD';

// Get price from pricing_information
if (have_rows('pricing_information', $playdate_id)) {
    while (have_rows('pricing_information', $playdate_id)) {
        the_row();
        // Use single rider price if available, otherwise double rider price
        if (get_sub_field('single_rider_price')) {
            $price_display = '$' . number_format((float)get_sub_field('single_rider_price'), 2);
        } elseif (get_sub_field('double_rider_price')) {
            $price_display = '$' . number_format((float)get_sub_field('double_rider_price'), 2);
        }
    }
}
?>

<div class="max-w-2xl mx-auto bg-white rounded-lg shadow-sm p-6 md:p-8">
    <form id="playdate-waitlist-form" class="space-y-6" method="POST">
        <?php wp_nonce_field('playdate_waitlist_nonce', 'playdate_waitlist_nonce'); ?>
        <input type="hidden" name="action" value="playdate_waitlist">
        <input type="hidden" name="playdate_id" value="<?php echo esc_attr($playdate_id); ?>">

        <div class="bg-gray-50 rounded-lg p-4 mb-6">
            <h3 class="font-semibold text-gray-900 mb-2">Playdate Details</h3>
            <div class="grid grid-cols-2 gap-4 text-sm">
                <div>
                    <span class="text-gray-600">Date:</span>
                    <span class="text-gray-900">
                        <?php 
                        if (have_rows('playdate_details', $playdate_id)) {
                            while (have_rows('playdate_details', $playdate_id)) {
                                the_row();
                                if (get_sub_field('date')) {
                                    echo date('M j, Y', strtotime(get_sub_field('date')));
                                } else {
                                    echo 'TBD';
                                }
                            }
                        } else {
                            echo 'TBD';
                        }
                        ?>
                    </span>
                </div>
                <div>
                    <span class="text-gray-600">Price:</span>
                    <span class="text-gray-900"><?php echo esc_html($price_display); ?></span>
                </div>
            </div>
        </div>

        <div class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="first_name" class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
                    <input type="text" name="first_name" id="first_name" required
                        class="w-full rounded-lg border-gray-300 px-4 py-3 shadow-sm focus:border-[#269763] focus:ring-[#269763]">
                </div>
                <div>
                    <label for="last_name" class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
                    <input type="text" name="last_name" id="last_name" required
                        class="w-full rounded-lg border-gray-300 px-4 py-3 shadow-sm focus:border-[#269763] focus:ring-[#269763]">
                </div>
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" name="email" id="email" required
                    class="w-full rounded-lg border-gray-300 px-4 py-3 shadow-sm focus:border-[#269763] focus:ring-[#269763]">
            </div>

            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                <input type="tel" name="phone" id="phone" required
                    class="w-full rounded-lg border-gray-300 px-4 py-3 shadow-sm focus:border-[#269763] focus:ring-[#269763]">
            </div>

            <div>
                <label for="handicap" class="block text-sm font-medium text-gray-700 mb-1">Handicap</label>
                <input type="number" name="handicap" id="handicap" min="0" max="36" step="0.1" required
                    class="w-full rounded-lg border-gray-300 px-4 py-3 shadow-sm focus:border-[#269763] focus:ring-[#269763]">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="gender" class="block text-sm font-medium text-gray-700 mb-1">Gender</label>
                    <select name="gender" id="gender" required
                        class="w-full rounded-lg border-gray-300 px-4 py-3 shadow-sm focus:border-[#269763] focus:ring-[#269763]">
                        <option value="">Select Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>
                <div>
                    <label for="is_member" class="block text-sm font-medium text-gray-700 mb-1">Golf Course Member?</label>
                    <select name="is_member" id="is_member" required
                        class="w-full rounded-lg border-gray-300 px-4 py-3 shadow-sm focus:border-[#269763] focus:ring-[#269763]">
                        <option value="">Select Option</option>
                        <option value="yes">Yes</option>
                        <option value="no">No</option>
                    </select>
                </div>
            </div>

            <div>
                <label for="notes" class="block text-sm font-medium text-gray-700 mb-1">Additional Notes (Optional)</label>
                <textarea name="notes" id="notes" rows="3"
                    class="w-full rounded-lg border-gray-300 px-4 py-3 shadow-sm focus:border-[#269763] focus:ring-[#269763]"
                    placeholder="Any specific preferences or availability constraints?"></textarea>
            </div>
        </div>

        <div class="pt-4">
            <button type="submit" class="w-full rounded-lg bg-[#f59e0b] px-6 py-3 text-center font-semibold text-white shadow-sm hover:bg-[#d97706] focus:outline-none focus:ring-2 focus:ring-[#f59e0b] focus:ring-offset-2">
                Join Waitlist
                <i data-lucide="arrow-right" class="h-4 w-4 ml-2"></i>
            </button>
        </div>
    </form>

    <div id="waitlist-message" class="hidden mt-4"></div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('playdate-waitlist-form');
    const messageDiv = document.getElementById('waitlist-message');

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
            fetch(ccg_ajax.ajax_url, {
                method: 'POST',
                body: formData,
            })
            .then(response => response.json())
            .then(data => {
                messageDiv.classList.remove('hidden');
                
                if (data.success) {
                    messageDiv.className = 'mt-4 p-4 rounded-lg bg-green-50 text-green-800';
                    messageDiv.innerHTML = '<div class="flex items-center gap-2"><i data-lucide="check-circle" class="h-5 w-5"></i>' + data.data.message + '</div>';
                    form.reset();
                } else {
                    messageDiv.className = 'mt-4 p-4 rounded-lg bg-red-50 text-red-800';
                    messageDiv.innerHTML = '<div class="flex items-center gap-2"><i data-lucide="alert-circle" class="h-5 w-5"></i>' + data.data.message + '</div>';
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
});</script>
