<?php
/**
 * Template part for displaying the tournament registration form
 *
 * @package _ccg
 */

$tournament_id = get_the_ID();

// Initialize payment link
$payment_link = '';

// Get payment link from registration_info
if (have_rows('registration_info', $tournament_id)) {
    while (have_rows('registration_info', $tournament_id)) {
        the_row();
        $payment_link = get_sub_field('payment_link');
    }
}
?>

<form id="tournament-registration-form" class="space-y-8" method="POST">
    <?php wp_nonce_field('tournament_registration_nonce', 'tournament_registration_nonce'); ?>
    <input type="hidden" name="action" value="tournament_registration">
    <input type="hidden" name="tournament_id" value="<?php echo esc_attr($tournament_id); ?>">
    <input type="hidden" name="payment_link" value="<?php echo esc_url($payment_link); ?>">

    <!-- Tournament Details Summary -->
    <div class="bg-gray-50 rounded-lg p-4 mb-6">
        <h3 class="font-semibold text-gray-900 mb-2">Tournament Details</h3>
        <div class="grid grid-cols-2 gap-4 text-sm">
            <div>
                <span class="text-gray-600">Date:</span>
                <span class="text-gray-900">
                    <?php 
                    if (have_rows('tournament_details', $tournament_id)) {
                        while (have_rows('tournament_details', $tournament_id)) {
                            the_row();
                            if (get_sub_field('tournament_date')) {
                                // Try to format the date if it's a valid date
                                $date = get_sub_field('tournament_date');
                                if (is_string($date)) {
                                    $date_obj = DateTime::createFromFormat('Ymd', $date);
                                    if (!$date_obj) {
                                        $date_obj = DateTime::createFromFormat('Y-m-d', $date);
                                    }
                                    if ($date_obj) {
                                        echo date('M j, Y', $date_obj->getTimestamp());
                                    } else {
                                        echo esc_html($date);
                                    }
                                } else {
                                    echo esc_html($date);
                                }
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
                <span class="text-gray-600">Location:</span>
                <span class="text-gray-900">
                    <?php 
                    if (have_rows('tournament_details', $tournament_id)) {
                        while (have_rows('tournament_details', $tournament_id)) {
                            the_row();
                            if (get_sub_field('golf_course_name')) {
                                echo esc_html(get_sub_field('golf_course_name'));
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
        </div>
    </div>

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

    <div id="form-response" class="mt-4 hidden rounded-lg p-4 text-center"></div>
</form>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('tournament-registration-form');
    const formResponse = document.getElementById('form-response');
    
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(form);
        const paymentLink = formData.get('payment_link');
        
        fetch(ajax_object.ajax_url, {
            method: 'POST',
            body: formData,
            credentials: 'same-origin'
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Show success message
                formResponse.classList.remove('hidden', 'bg-red-100');
                formResponse.classList.add('bg-green-100');
                formResponse.innerHTML = '<p class="text-green-700">' + data.data.message + '</p>';
                
                // Reset the form
                form.reset();
                
                // Redirect to payment link after a short delay if available
                if (paymentLink && paymentLink.length > 0) {
                    setTimeout(function() {
                        window.location.href = paymentLink;
                    }, 1500);
                }
            } else {
                // Show error message
                formResponse.classList.remove('hidden', 'bg-green-100');
                formResponse.classList.add('bg-red-100');
                formResponse.innerHTML = '<p class="text-red-700">' + (data.data.message || 'Registration failed. Please try again.') + '</p>';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            formResponse.classList.remove('hidden', 'bg-green-100');
            formResponse.classList.add('bg-red-100');
            formResponse.innerHTML = '<p class="text-red-700">An error occurred. Please try again.</p>';
        });
    });
});
</script>
