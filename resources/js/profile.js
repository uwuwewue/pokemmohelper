import Swal from 'sweetalert2';

document.addEventListener("DOMContentLoaded", function() {
    let hash = window.location.hash;
    
    if (hash) {
        let triggerEl = document.querySelector(`button[data-bs-target="${hash}"], a[href="${hash}"], button[aria-controls="${hash.replace('#', '')}"]`);
        
        if (triggerEl) {
            console.log("3. Przycisk znaleziony, wymuszam kliknięcie!");
            triggerEl.click();
        }
    }

    const deleteForms = document.querySelectorAll('.delete-shiny-form');

    deleteForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Are you sure?',
                text: "You are about to release this Shiny. This action cannot be undone!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, release it!',
                cancelButtonText: 'Cancel',
                background: '#212529', 
                color: '#f8f9fa',
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
});