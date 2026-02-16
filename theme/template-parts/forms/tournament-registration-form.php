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

<form id="tournament-registration-form" class="space-y-6 rounded-xl border border-gray-100 bg-white p-4 shadow-sm md:space-y-8 md:p-8" method="POST">
    <?php wp_nonce_field('tournament_registration_nonce', 'tournament_registration_nonce'); ?>
    <input type="hidden" name="action" value="tournament_reg">
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
                <label for="scorecard_range" class="mb-2 block text-sm font-medium text-gray-700">Scorecard Range *</label>
                <select id="scorecard_range"
                        name="scorecard_range"
                        required
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-[#269763] focus:ring-[#269763]">
                    <option value="">Select your typical scorecard range</option>
                    <option value="70-85">70 - 85</option>
                    <option value="86-96">86 - 96</option>
                    <option value="above-96">Above 96</option>
                </select>
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

<!-- Registration Confirmation Panel -->
<div id="registration-confirmation" class="hidden">
    <div class="rounded-xl border border-green-200 bg-green-50 p-4 text-center md:p-8">
        <div class="mx-auto mb-4 inline-flex h-16 w-16 items-center justify-center rounded-full bg-green-100">
            <i data-lucide="check-circle" class="h-8 w-8 text-green-600"></i>
        </div>
        <h3 class="mb-2 text-2xl font-bold text-green-800">Registration Confirmed!</h3>
        <p class="mb-6 text-green-700">Your spot has been secured. A confirmation email has been sent.</p>

        <div id="confirmation-details" class="mb-6 rounded-lg bg-white p-4 text-left text-sm text-gray-700">
            <!-- Populated by JS -->
        </div>

        <div id="payment-button-container" class="mb-4">
            <!-- Populated by JS if payment_link exists -->
        </div>

        <p id="payment-note" class="hidden text-sm text-gray-500">
            You can also pay later before the registration deadline. A payment link has been included in your confirmation email.
        </p>
    </div>
</div>

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
                // Hide the form and show confirmation panel
                form.classList.add('hidden');
                formResponse.classList.add('hidden');

                const confirmationPanel = document.getElementById('registration-confirmation');
                const confirmationDetails = document.getElementById('confirmation-details');
                const paymentButtonContainer = document.getElementById('payment-button-container');
                const paymentNote = document.getElementById('payment-note');

                // Populate confirmation details using safe DOM methods
                const playerName = data.data.player_name || '';
                const playerEmail = data.data.player_email || '';
                const serverPaymentLink = data.data.payment_link || '';

                // Clear and build details safely
                confirmationDetails.textContent = '';
                const detailsWrapper = document.createElement('div');
                detailsWrapper.className = 'space-y-2';

                // Name row
                const nameP = document.createElement('p');
                const nameLabel = document.createElement('span');
                nameLabel.className = 'font-semibold';
                nameLabel.textContent = 'Name: ';
                nameP.appendChild(nameLabel);
                nameP.appendChild(document.createTextNode(playerName));
                detailsWrapper.appendChild(nameP);

                // Email row
                const emailP = document.createElement('p');
                const emailLabel = document.createElement('span');
                emailLabel.className = 'font-semibold';
                emailLabel.textContent = 'Email: ';
                emailP.appendChild(emailLabel);
                emailP.appendChild(document.createTextNode(playerEmail));
                detailsWrapper.appendChild(emailP);

                // Status row
                const statusP = document.createElement('p');
                const statusLabel = document.createElement('span');
                statusLabel.className = 'font-semibold';
                statusLabel.textContent = 'Status: ';
                statusP.appendChild(statusLabel);
                const statusBadge = document.createElement('span');
                statusBadge.className = 'inline-block rounded-full bg-green-100 px-2 py-0.5 text-xs font-semibold text-green-800';
                statusBadge.textContent = 'Registered';
                statusP.appendChild(statusBadge);
                detailsWrapper.appendChild(statusP);

                // Payment row
                const paymentP = document.createElement('p');
                const paymentLabel = document.createElement('span');
                paymentLabel.className = 'font-semibold';
                paymentLabel.textContent = 'Payment: ';
                paymentP.appendChild(paymentLabel);
                const paymentBadge = document.createElement('span');
                paymentBadge.className = 'inline-block rounded-full bg-amber-100 px-2 py-0.5 text-xs font-semibold text-amber-800';
                paymentBadge.textContent = 'Unpaid';
                paymentP.appendChild(paymentBadge);
                detailsWrapper.appendChild(paymentP);

                confirmationDetails.appendChild(detailsWrapper);

                // Show payment button if payment link exists
                const effectivePaymentLink = serverPaymentLink || paymentLink;
                if (effectivePaymentLink && effectivePaymentLink.length > 0) {
                    try {
                        const url = new URL(effectivePaymentLink, window.location.origin);
                        if (url.protocol === 'http:' || url.protocol === 'https:') {
                            paymentButtonContainer.textContent = '';
                            const paymentBtn = document.createElement('a');
                            paymentBtn.href = effectivePaymentLink;
                            paymentBtn.target = '_blank';
                            paymentBtn.rel = 'noopener noreferrer';
                            paymentBtn.className = 'inline-flex items-center justify-center gap-2 rounded-md bg-[#269763] px-8 py-3 text-center font-semibold text-white hover:bg-[#1a724a] focus:outline-none focus:ring-2 focus:ring-[#269763] focus:ring-offset-2';
                            const btnIcon = document.createElement('i');
                            btnIcon.setAttribute('data-lucide', 'credit-card');
                            btnIcon.className = 'h-5 w-5';
                            paymentBtn.appendChild(btnIcon);
                            paymentBtn.appendChild(document.createTextNode(' Proceed to Payment'));
                            paymentButtonContainer.appendChild(paymentBtn);
                            paymentNote.classList.remove('hidden');
                        }
                    } catch (e) {
                        console.error('Invalid payment URL', e);
                    }
                }

                // Show the confirmation panel
                confirmationPanel.classList.remove('hidden');

                // Scroll to confirmation
                confirmationPanel.scrollIntoView({ behavior: 'smooth', block: 'center' });

                // Re-initialize Lucide icons for dynamically added elements
                if (typeof lucide !== 'undefined') {
                    lucide.createIcons();
                }
            } else {
                // Show error message
                const errorMessage = document.createTextNode(data.data.message || 'Registration failed. Please try again.');
                const errorP = document.createElement('p');
                errorP.className = 'text-red-700';
                errorP.appendChild(errorMessage);
                formResponse.textContent = '';
                formResponse.appendChild(errorP);
                formResponse.classList.remove('hidden', 'bg-green-100');
                formResponse.classList.add('bg-red-100');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            const catchErrorMessage = document.createTextNode('An error occurred. Please try again.');
            const catchErrorP = document.createElement('p');
            catchErrorP.className = 'text-red-700';
            catchErrorP.appendChild(catchErrorMessage);
            formResponse.textContent = '';
            formResponse.appendChild(catchErrorP);
            formResponse.classList.remove('hidden', 'bg-green-100');
            formResponse.classList.add('bg-red-100');
        });
    });
});
</script>
