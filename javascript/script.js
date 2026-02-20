/**
 * Front-end JavaScript
 *
 * The JavaScript code you place here will be processed by esbuild. The output
 * file will be created at `../theme/js/script.min.js` and enqueued in
 * `../theme/functions.php`.
 *
 * For esbuild documentation, please see:
 * https://esbuild.github.io/
 */

// Function to handle modal interactions
function setupContactModals() {
    const openModalButtons = document.querySelectorAll('.open-contact-modal-button');
    const closeModalButtons = document.querySelectorAll('.close-contact-modal-button');
    const modals = document.querySelectorAll('.contact-modal');

    openModalButtons.forEach(button => {
        button.addEventListener('click', () => {
            const modalId = button.getAttribute('data-modal-target');
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.classList.remove('hidden');
                modal.classList.add('flex'); // Use flex to center content
                document.body.style.overflow = 'hidden'; // Prevent background scrolling
            }
        });
    });

    closeModalButtons.forEach(button => {
        button.addEventListener('click', () => {
            const modalId = button.getAttribute('data-modal-close');
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
                document.body.style.overflow = ''; // Restore background scrolling
            }
        });
    });

    // Close modal when clicking outside the modal content
    modals.forEach(modal => {
        modal.addEventListener('click', (event) => {
            // Check if the click is on the modal background itself (not its children)
            if (event.target === modal) {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
                document.body.style.overflow = ''; // Restore background scrolling
            }
        });
    });

    // Close modal with the Escape key
    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') {
            modals.forEach(modal => {
                if (!modal.classList.contains('hidden')) {
                    modal.classList.add('hidden');
                    modal.classList.remove('flex');
                    document.body.style.overflow = ''; // Restore background scrolling
                }
            });
        }
    });
}

// Stripe Payment Link redirect after registration form submission
function setupStripeRedirect() {
    const registrationForm = document.querySelector('.ccg-registration-form');
    if (!registrationForm) return;

    const individualUrl = registrationForm.dataset.stripeIndividual;
    const businessUrl = registrationForm.dataset.stripeBusiness;
    if (!individualUrl && !businessUrl) return;

    // Track the selected membership plan before the form resets on submit
    let selectedPlan = '';
    const form = registrationForm.querySelector('form');
    if (form) {
        // Capture plan selection on form submit and also on change
        const planSelect = form.querySelector(
            'select[name="payment_input"],' +
            'select[data-subscription_item="yes"]'
        );
        if (planSelect) {
            const capturePlan = function () {
                const option = planSelect.options[planSelect.selectedIndex];
                selectedPlan = option
                    ? option.getAttribute('data-plan_name') || option.text.trim()
                    : '';
            };
            planSelect.addEventListener('change', capturePlan);
            capturePlan(); // capture default selection
        }
    }

    const observer = new MutationObserver(function (mutations) {
        for (const mutation of mutations) {
            for (const node of mutation.addedNodes) {
                if (
                    node.nodeType === 1 &&
                    node.classList &&
                    node.classList.contains('ff-message-success')
                ) {
                    observer.disconnect();
                    const isBusiness =
                        selectedPlan.toLowerCase().includes('business');
                    const redirectUrl = isBusiness
                        ? businessUrl || individualUrl
                        : individualUrl || businessUrl;
                    if (redirectUrl) {
                        window.location.href = redirectUrl;
                    }
                    return;
                }
            }
        }
    });
    observer.observe(registrationForm, { childList: true, subtree: true });
}

// Run the setup functions when the DOM is ready
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => {
        setupContactModals();
        setupStripeRedirect();
    });
} else {
    setupContactModals();
    setupStripeRedirect();
}
