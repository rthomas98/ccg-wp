<?php
/**
 * Template part for displaying the tournament registration form
 *
 * @package _ccg
 */

$tournament_id = get_the_ID();
?>

<form id="tournament-registration-form" class="space-y-8" method="POST">
    <?php wp_nonce_field('tournament_registration_nonce', 'tournament_registration_nonce'); ?>
    <input type="hidden" name="action" value="tournament_registration">
    <input type="hidden" name="tournament_id" value="<?php echo esc_attr($tournament_id); ?>">

    <!-- Player Information -->
    <div>
        <h3 class="mb-6 text-xl font-bold">Player Information</h3>
        <div class="grid gap-6 md:grid-cols-2">
            <div>
                <label for="first_name" class="mb-2 block text-sm font-medium text-gray-700">First Name *</label>
                <input type="text" 
                       id="first_name" 
                       name="first_name" 
                       required
                       class="w-full rounded-md border-gray-300 shadow-sm focus:border-[#269763] focus:ring-[#269763]">
            </div>
            <div>
                <label for="last_name" class="mb-2 block text-sm font-medium text-gray-700">Last Name *</label>
                <input type="text" 
                       id="last_name" 
                       name="last_name" 
                       required
                       class="w-full rounded-md border-gray-300 shadow-sm focus:border-[#269763] focus:ring-[#269763]">
            </div>
            <div>
                <label for="email" class="mb-2 block text-sm font-medium text-gray-700">Email *</label>
                <input type="email" 
                       id="email" 
                       name="email" 
                       required
                       class="w-full rounded-md border-gray-300 shadow-sm focus:border-[#269763] focus:ring-[#269763]">
            </div>
            <div>
                <label for="phone" class="mb-2 block text-sm font-medium text-gray-700">Phone *</label>
                <input type="tel" 
                       id="phone" 
                       name="phone" 
                       required
                       class="w-full rounded-md border-gray-300 shadow-sm focus:border-[#269763] focus:ring-[#269763]">
            </div>
        </div>
    </div>

    <!-- Golf Information -->
    <div>
        <h3 class="mb-6 text-xl font-bold">Golf Information</h3>
        <div class="grid gap-6 md:grid-cols-2">
            <div>
                <label for="handicap" class="mb-2 block text-sm font-medium text-gray-700">Handicap Index *</label>
                <input type="number" 
                       id="handicap" 
                       name="handicap" 
                       step="0.1"
                       required
                       class="w-full rounded-md border-gray-300 shadow-sm focus:border-[#269763] focus:ring-[#269763]">
            </div>
            <div>
                <label for="ghin_number" class="mb-2 block text-sm font-medium text-gray-700">GHIN Number *</label>
                <input type="text" 
                       id="ghin_number" 
                       name="ghin_number" 
                       required
                       class="w-full rounded-md border-gray-300 shadow-sm focus:border-[#269763] focus:ring-[#269763]">
            </div>
            <div>
                <label for="home_club" class="mb-2 block text-sm font-medium text-gray-700">Home Club</label>
                <input type="text" 
                       id="home_club" 
                       name="home_club" 
                       class="w-full rounded-md border-gray-300 shadow-sm focus:border-[#269763] focus:ring-[#269763]">
            </div>
        </div>
    </div>

    <!-- Additional Information -->
    <div>
        <h3 class="mb-6 text-xl font-bold">Additional Information</h3>
        <div class="space-y-6">
            <div>
                <label for="dietary_restrictions" class="mb-2 block text-sm font-medium text-gray-700">Dietary Restrictions</label>
                <textarea id="dietary_restrictions" 
                          name="dietary_restrictions" 
                          rows="3"
                          class="w-full rounded-md border-gray-300 shadow-sm focus:border-[#269763] focus:ring-[#269763]"></textarea>
            </div>
            <div>
                <label for="special_requests" class="mb-2 block text-sm font-medium text-gray-700">Special Requests</label>
                <textarea id="special_requests" 
                          name="special_requests" 
                          rows="3"
                          class="w-full rounded-md border-gray-300 shadow-sm focus:border-[#269763] focus:ring-[#269763]"></textarea>
            </div>
        </div>
    </div>

    <!-- Terms and Conditions -->
    <div>
        <div class="flex items-start">
            <div class="flex h-5 items-center">
                <input type="checkbox" 
                       id="terms" 
                       name="terms" 
                       required
                       class="h-4 w-4 rounded border-gray-300 text-[#269763] focus:ring-[#269763]">
            </div>
            <div class="ml-3">
                <label for="terms" class="text-sm text-gray-700">
                    I agree to the tournament rules and regulations *
                </label>
            </div>
        </div>
    </div>

    <!-- Submit Button -->
    <div>
        <button type="submit" 
                class="inline-flex w-full items-center justify-center rounded-md bg-[#269763] px-6 py-3 text-center font-semibold text-white hover:bg-[#1a724a] focus:outline-none focus:ring-2 focus:ring-[#269763] focus:ring-offset-2">
            Register for Tournament
            <i data-lucide="arrow-right" class="ml-2 h-5 w-5"></i>
        </button>
    </div>
</form>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('tournament-registration-form');
    
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(form);
        
        fetch(ajax_object.ajax_url, {
            method: 'POST',
            body: formData,
            credentials: 'same-origin'
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Show success message
                alert(data.data.message);
                // Redirect to confirmation page or refresh
                window.location.reload();
            } else {
                // Show error message
                alert(data.data.message || 'Registration failed. Please try again.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred. Please try again.');
        });
    });
});
