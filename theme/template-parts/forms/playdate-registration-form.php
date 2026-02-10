<?php
/**
 * Template part for displaying the playdate registration form
 *
 * @package _ccg
 */

// Get the current playdate
$playdate_id = get_the_ID();

// Initialize pricing variables
$course_member_price = 0;
$non_member_price = 0;
$payment_link = '';
$member_payment_link = '';
$non_member_payment_link = '';

// Get pricing information
if (have_rows('pricing_information', $playdate_id)) {
    while (have_rows('pricing_information', $playdate_id)) {
        the_row();
        $course_member_price = get_sub_field('course_member_price') ? (float)get_sub_field('course_member_price') : 0;
        $non_member_price = get_sub_field('non_member_price') ? (float)get_sub_field('non_member_price') : 0;
        $payment_link = get_sub_field('payment_link') ?: '';
        $member_payment_link = get_sub_field('member_payment_link') ?: '';
        $non_member_payment_link = get_sub_field('non_member_payment_link') ?: '';
    }
}

// Fallback: if individual payment links don't exist, use the general one
if (empty($member_payment_link)) {
    $member_payment_link = $payment_link;
}
if (empty($non_member_payment_link)) {
    $non_member_payment_link = $payment_link;
}

// Get playdate date for display
$playdate_date_display = 'TBD';
if (have_rows('playdate_details', $playdate_id)) {
    while (have_rows('playdate_details', $playdate_id)) {
        the_row();
        if (get_sub_field('date')) {
            $playdate_date_display = date('M j, Y', strtotime(get_sub_field('date')));
        }
    }
}
?>

<!-- Membership Status Selector -->
<div class="bg-white rounded-lg shadow-sm p-6 mb-6 border border-gray-200">
    <h3 class="text-lg font-semibold mb-4">Select Your Membership Type</h3>
    <div class="flex flex-wrap gap-4 mb-4">
        <label class="flex items-center cursor-pointer">
            <input type="radio" name="membership_type_selector" value="member" class="form-radio h-5 w-5 text-[#269763]" checked>
            <span class="ml-2 font-medium">Course Member</span>
            <?php if ($course_member_price > 0) : ?>
                <span class="ml-2 text-gray-600">— $<?php echo number_format($course_member_price, 2); ?></span>
            <?php endif; ?>
        </label>
        <label class="flex items-center cursor-pointer">
            <input type="radio" name="membership_type_selector" value="non-member" class="form-radio h-5 w-5 text-[#269763]">
            <span class="ml-2 font-medium">Non-Member</span>
            <?php if ($non_member_price > 0) : ?>
                <span class="ml-2 text-gray-600">— $<?php echo number_format($non_member_price, 2); ?></span>
            <?php endif; ?>
        </label>
    </div>
    <div class="bg-gray-50 rounded-lg p-4">
        <div class="flex justify-between items-center">
            <span class="text-gray-700 font-medium">Your Price:</span>
            <span id="playdate-price-display" class="text-xl font-bold text-[#269763]">
                $<?php echo number_format($course_member_price, 2); ?>
            </span>
        </div>
    </div>
    <p class="mt-3 text-sm text-gray-500">You will be able to make payment after registration.</p>
</div>

<!-- Registration Form -->
<div class="max-w-2xl mx-auto bg-white rounded-lg shadow-sm p-6 md:p-8">
    <form id="playdate-registration-form" class="space-y-6" method="POST">
        <?php wp_nonce_field('playdate_registration_nonce', 'playdate_registration_nonce'); ?>
        <input type="hidden" name="action" value="playdate_registration">
        <input type="hidden" name="playdate_id" value="<?php echo esc_attr($playdate_id); ?>">
        <input type="hidden" name="membership_status" id="membership_status" value="member">
        <input type="hidden" name="selected_price" id="selected_price" value="<?php echo esc_attr($course_member_price); ?>">

        <div class="bg-gray-50 rounded-lg p-4 mb-6">
            <h3 class="font-semibold text-gray-900 mb-2">Playdate Details</h3>
            <div class="grid grid-cols-2 gap-4 text-sm">
                <div>
                    <span class="text-gray-600">Date:</span>
                    <span class="text-gray-900"><?php echo esc_html($playdate_date_display); ?></span>
                </div>
                <div>
                    <span class="text-gray-600">Price:</span>
                    <span id="playdate-form-price" class="text-gray-900">$<?php echo number_format($course_member_price, 2); ?></span>
                </div>
            </div>
        </div>

        <div class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="first_name" class="block text-sm font-medium text-gray-700 mb-1">First Name *</label>
                    <input type="text" name="first_name" id="first_name" required
                        class="w-full rounded-lg border-gray-300 px-4 py-3 shadow-sm focus:border-[#269763] focus:ring-[#269763]">
                </div>
                <div>
                    <label for="last_name" class="block text-sm font-medium text-gray-700 mb-1">Last Name *</label>
                    <input type="text" name="last_name" id="last_name" required
                        class="w-full rounded-lg border-gray-300 px-4 py-3 shadow-sm focus:border-[#269763] focus:ring-[#269763]">
                </div>
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
                <input type="email" name="email" id="email" required
                    class="w-full rounded-lg border-gray-300 px-4 py-3 shadow-sm focus:border-[#269763] focus:ring-[#269763]">
            </div>

            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone *</label>
                <input type="tel" name="phone" id="phone" required
                    class="w-full rounded-lg border-gray-300 px-4 py-3 shadow-sm focus:border-[#269763] focus:ring-[#269763]">
            </div>

            <div>
                <label for="handicap" class="block text-sm font-medium text-gray-700 mb-1">Handicap *</label>
                <input type="number" name="handicap" id="handicap" min="0" max="36" step="0.1" required
                    class="w-full rounded-lg border-gray-300 px-4 py-3 shadow-sm focus:border-[#269763] focus:ring-[#269763]">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="gender" class="block text-sm font-medium text-gray-700 mb-1">Gender *</label>
                    <select name="gender" id="gender" required
                        class="w-full rounded-lg border-gray-300 px-4 py-3 shadow-sm focus:border-[#269763] focus:ring-[#269763]">
                        <option value="">Select Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>
                <div>
                    <label for="is_member" class="block text-sm font-medium text-gray-700 mb-1">Golf Course Member? *</label>
                    <select name="is_member" id="is_member" required
                        class="w-full rounded-lg border-gray-300 px-4 py-3 shadow-sm focus:border-[#269763] focus:ring-[#269763]">
                        <option value="">Select Option</option>
                        <option value="yes">Yes</option>
                        <option value="no">No</option>
                    </select>
                </div>
            </div>

            <div>
                <label for="special_requests" class="block text-sm font-medium text-gray-700 mb-1">Special Requests (Optional)</label>
                <textarea name="special_requests" id="special_requests" rows="3"
                    class="w-full rounded-lg border-gray-300 px-4 py-3 shadow-sm focus:border-[#269763] focus:ring-[#269763]"></textarea>
            </div>

            <div class="pt-4">
                <button type="submit"
                    class="w-full rounded-lg bg-[#269763] px-6 py-3 text-center font-semibold text-white shadow-sm hover:bg-[#269763]/90 focus:outline-none focus:ring-2 focus:ring-[#269763] focus:ring-offset-2">
                    Register Now
                </button>
            </div>
        </div>

        <div id="form-response" class="mt-4 hidden rounded-lg p-4 text-center"></div>
    </form>
</div>

<!-- Registration Confirmation Panel -->
<div id="playdate-registration-confirmation" class="hidden">
    <div class="rounded-xl border border-green-200 bg-green-50 p-8 text-center">
        <div class="mx-auto mb-4 inline-flex h-16 w-16 items-center justify-center rounded-full bg-green-100">
            <i data-lucide="check-circle" class="h-8 w-8 text-green-600"></i>
        </div>
        <h3 class="mb-2 text-2xl font-bold text-green-800">Registration Confirmed!</h3>
        <p class="mb-6 text-green-700">Your spot has been secured. A confirmation email has been sent.</p>

        <div id="playdate-confirmation-details" class="mb-6 rounded-lg bg-white p-4 text-left text-sm text-gray-700">
            <!-- Populated by JS -->
        </div>

        <div id="playdate-payment-button-container" class="mb-4">
            <!-- Populated by JS if payment_link exists -->
        </div>

        <p id="playdate-payment-note" class="hidden text-sm text-gray-500">
            You can also pay later before the registration deadline. A payment link has been included in your confirmation email.
        </p>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Price and payment link data from PHP
    var memberPrice = <?php echo (float)$course_member_price; ?>;
    var nonMemberPrice = <?php echo (float)$non_member_price; ?>;
    var memberPaymentLink = <?php echo wp_json_encode($member_payment_link); ?>;
    var nonMemberPaymentLink = <?php echo wp_json_encode($non_member_payment_link); ?>;

    // DOM references
    var membershipRadios = document.querySelectorAll('input[name="membership_type_selector"]');
    var priceDisplay = document.getElementById('playdate-price-display');
    var formPriceDisplay = document.getElementById('playdate-form-price');
    var membershipStatusInput = document.getElementById('membership_status');
    var selectedPriceInput = document.getElementById('selected_price');

    // Current state
    var currentMembershipType = 'member';

    function formatPrice(price) {
        return '$' + price.toFixed(2);
    }

    function updatePriceDisplay() {
        var price = currentMembershipType === 'member' ? memberPrice : nonMemberPrice;
        if (priceDisplay) priceDisplay.textContent = formatPrice(price);
        if (formPriceDisplay) formPriceDisplay.textContent = formatPrice(price);
        if (membershipStatusInput) membershipStatusInput.value = currentMembershipType;
        if (selectedPriceInput) selectedPriceInput.value = price;
    }

    // Listen for membership type changes
    membershipRadios.forEach(function(radio) {
        radio.addEventListener('change', function() {
            currentMembershipType = this.value;
            updatePriceDisplay();
        });
    });

    // Form submission handler
    var form = document.getElementById('playdate-registration-form');
    var formResponse = document.getElementById('form-response');

    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            var formData = new FormData(form);

            // Show processing state
            formResponse.textContent = '';
            var processingP = document.createElement('p');
            processingP.className = 'text-gray-700';
            processingP.textContent = 'Processing your registration...';
            formResponse.appendChild(processingP);
            formResponse.classList.remove('hidden', 'bg-red-100', 'bg-green-100');
            formResponse.classList.add('bg-gray-100');

            fetch(ajax_object.ajax_url, {
                method: 'POST',
                body: formData,
                credentials: 'same-origin'
            })
            .then(function(response) { return response.json(); })
            .then(function(data) {
                if (data.success) {
                    // Hide form and response area
                    form.classList.add('hidden');
                    formResponse.classList.add('hidden');

                    // Also hide the membership selector
                    var membershipSelector = form.closest('.max-w-2xl');
                    if (membershipSelector && membershipSelector.previousElementSibling) {
                        membershipSelector.previousElementSibling.classList.add('hidden');
                    }

                    var confirmationPanel = document.getElementById('playdate-registration-confirmation');
                    var confirmationDetails = document.getElementById('playdate-confirmation-details');
                    var paymentButtonContainer = document.getElementById('playdate-payment-button-container');
                    var paymentNote = document.getElementById('playdate-payment-note');

                    // Get response data
                    var playerName = data.data.player_name || '';
                    var playerEmail = data.data.player_email || '';
                    var serverPaymentLink = data.data.payment_link || '';

                    // Build confirmation details
                    confirmationDetails.textContent = '';
                    var detailsWrapper = document.createElement('div');
                    detailsWrapper.className = 'space-y-2';

                    // Name row
                    var nameP = document.createElement('p');
                    var nameLabel = document.createElement('span');
                    nameLabel.className = 'font-semibold';
                    nameLabel.textContent = 'Name: ';
                    nameP.appendChild(nameLabel);
                    nameP.appendChild(document.createTextNode(playerName));
                    detailsWrapper.appendChild(nameP);

                    // Email row
                    var emailP = document.createElement('p');
                    var emailLabel = document.createElement('span');
                    emailLabel.className = 'font-semibold';
                    emailLabel.textContent = 'Email: ';
                    emailP.appendChild(emailLabel);
                    emailP.appendChild(document.createTextNode(playerEmail));
                    detailsWrapper.appendChild(emailP);

                    // Membership type row
                    var memberP = document.createElement('p');
                    var memberLabel = document.createElement('span');
                    memberLabel.className = 'font-semibold';
                    memberLabel.textContent = 'Membership: ';
                    memberP.appendChild(memberLabel);
                    memberP.appendChild(document.createTextNode(currentMembershipType === 'member' ? 'Course Member' : 'Non-Member'));
                    detailsWrapper.appendChild(memberP);

                    // Status row
                    var statusP = document.createElement('p');
                    var statusLabel = document.createElement('span');
                    statusLabel.className = 'font-semibold';
                    statusLabel.textContent = 'Status: ';
                    statusP.appendChild(statusLabel);
                    var statusBadge = document.createElement('span');
                    statusBadge.className = 'inline-block rounded-full bg-green-100 px-2 py-0.5 text-xs font-semibold text-green-800';
                    statusBadge.textContent = 'Registered';
                    statusP.appendChild(statusBadge);
                    detailsWrapper.appendChild(statusP);

                    // Payment row
                    var paymentStatusP = document.createElement('p');
                    var paymentStatusLabel = document.createElement('span');
                    paymentStatusLabel.className = 'font-semibold';
                    paymentStatusLabel.textContent = 'Payment: ';
                    paymentStatusP.appendChild(paymentStatusLabel);
                    var paymentBadge = document.createElement('span');
                    paymentBadge.className = 'inline-block rounded-full bg-amber-100 px-2 py-0.5 text-xs font-semibold text-amber-800';
                    paymentBadge.textContent = 'Unpaid';
                    paymentStatusP.appendChild(paymentBadge);
                    detailsWrapper.appendChild(paymentStatusP);

                    confirmationDetails.appendChild(detailsWrapper);

                    // Determine which payment link to show based on membership selection
                    var effectivePaymentLink = '';
                    if (currentMembershipType === 'member' && memberPaymentLink) {
                        effectivePaymentLink = memberPaymentLink;
                    } else if (currentMembershipType !== 'member' && nonMemberPaymentLink) {
                        effectivePaymentLink = nonMemberPaymentLink;
                    } else if (serverPaymentLink) {
                        effectivePaymentLink = serverPaymentLink;
                    }

                    // Show payment button if payment link exists
                    if (effectivePaymentLink && effectivePaymentLink.length > 0) {
                        try {
                            var url = new URL(effectivePaymentLink, window.location.origin);
                            if (url.protocol === 'http:' || url.protocol === 'https:') {
                                paymentButtonContainer.textContent = '';
                                var paymentBtn = document.createElement('a');
                                paymentBtn.href = effectivePaymentLink;
                                paymentBtn.target = '_blank';
                                paymentBtn.rel = 'noopener noreferrer';
                                paymentBtn.className = 'inline-flex items-center justify-center gap-2 rounded-md bg-[#269763] px-8 py-3 text-center font-semibold text-white hover:bg-[#1a724a] focus:outline-none focus:ring-2 focus:ring-[#269763] focus:ring-offset-2';
                                var btnIcon = document.createElement('i');
                                btnIcon.setAttribute('data-lucide', 'credit-card');
                                btnIcon.className = 'h-5 w-5';
                                paymentBtn.appendChild(btnIcon);
                                paymentBtn.appendChild(document.createTextNode(' Proceed to Payment'));
                                paymentButtonContainer.appendChild(paymentBtn);
                                paymentNote.classList.remove('hidden');
                            }
                        } catch (err) {
                            console.error('Invalid payment URL', err);
                        }
                    }

                    // Show confirmation panel
                    confirmationPanel.classList.remove('hidden');

                    // Scroll to confirmation
                    confirmationPanel.scrollIntoView({ behavior: 'smooth', block: 'center' });

                    // Re-initialize Lucide icons
                    if (typeof lucide !== 'undefined') {
                        lucide.createIcons();
                    }
                } else {
                    // Show error
                    var errorMsg = document.createTextNode((data.data && data.data.message) || 'Registration failed. Please try again.');
                    var errorP = document.createElement('p');
                    errorP.className = 'text-red-700';
                    errorP.appendChild(errorMsg);
                    formResponse.textContent = '';
                    formResponse.appendChild(errorP);
                    formResponse.classList.remove('hidden', 'bg-gray-100', 'bg-green-100');
                    formResponse.classList.add('bg-red-100');
                }
            })
            .catch(function(error) {
                console.error('Error:', error);
                var catchMsg = document.createTextNode('An error occurred. Please try again.');
                var catchP = document.createElement('p');
                catchP.className = 'text-red-700';
                catchP.appendChild(catchMsg);
                formResponse.textContent = '';
                formResponse.appendChild(catchP);
                formResponse.classList.remove('hidden', 'bg-gray-100', 'bg-green-100');
                formResponse.classList.add('bg-red-100');
            });
        });
    }
});
</script>
