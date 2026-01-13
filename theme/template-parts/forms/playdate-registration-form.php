<?php
/**
 * Template part for displaying the playdate registration form
 */

// Get the current playdate
$playdate_id = get_the_ID();

// Initialize price display and payment link
$price_display = 'TBD';
$payment_link = '';

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
        
        // Get payment link
        $payment_link = get_sub_field('payment_link');
    }
}
?>

<div class="max-w-2xl mx-auto bg-white rounded-lg shadow-sm p-6 md:p-8">
    <form id="playdate-registration-form" class="space-y-6" method="POST">
        <?php wp_nonce_field('playdate_registration_nonce', 'playdate_registration_nonce'); ?>
        <input type="hidden" name="action" value="playdate_registration">
        <input type="hidden" name="playdate_id" value="<?php echo esc_attr($playdate_id); ?>">
        <input type="hidden" name="payment_link" value="<?php echo esc_url($payment_link); ?>">

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

<script>
    jQuery(document).ready(function($) {
        $('#playdate-registration-form').on('submit', function(e) {
            e.preventDefault();
            
            var formData = $(this).serialize();
            var formResponse = $('#form-response');
            var paymentLink = $('input[name="payment_link"]').val();
            
            $.ajax({
                type: 'POST',
                url: '<?php echo admin_url('admin-ajax.php'); ?>',
                data: formData,
                beforeSend: function() {
                    formResponse.removeClass('hidden bg-red-100 bg-green-100').addClass('bg-gray-100').html('<p class="text-gray-700">Processing your registration...</p>').show();
                },
                success: function(response) {
                    if (response.success) {
                        const successP = $('<p>').addClass('text-green-700').text(response.data.message);
                        formResponse.removeClass('bg-gray-100 bg-red-100').addClass('bg-green-100').empty().append(successP);
                        $('#playdate-registration-form')[0].reset();
                        
                        // Redirect to payment link after validation
                        if (paymentLink && paymentLink.length > 0) {
                            try {
                                const url = new URL(paymentLink, window.location.origin);
                                if (url.protocol === 'http:' || url.protocol === 'https:') {
                                    setTimeout(function() {
                                        window.location.href = paymentLink;
                                    }, 1500);
                                } else {
                                    console.error('Invalid payment URL protocol');
                                }
                            } catch (e) {
                                console.error('Invalid payment URL', e);
                            }
                        }
                    } else {
                        const errorP = $('<p>').addClass('text-red-700').text(response.data.message);
                        formResponse.removeClass('bg-gray-100 bg-green-100').addClass('bg-red-100').empty().append(errorP);
                    }
                },
                error: function() {
                    const catchErrorP = $('<p>').addClass('text-red-700').text('There was an error processing your registration. Please try again later.');
                    formResponse.removeClass('bg-gray-100 bg-green-100').addClass('bg-red-100').empty().append(catchErrorP);
                }
            });
        });
    });
</script>
