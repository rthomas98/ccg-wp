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
