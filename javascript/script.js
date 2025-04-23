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

// Run the setup function when the DOM is ready
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', setupContactModals);
} else {
    // DOMContentLoaded has already fired
    setupContactModals();
}
