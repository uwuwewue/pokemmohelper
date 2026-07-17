document.addEventListener('DOMContentLoaded', function() {
    
    if (typeof window.flashSuccessMessage !== 'undefined') {
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'success',
            title: window.flashSuccessMessage,
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            background: '#212529',
            color: '#f8f9fa'
        });
    }

    const deleteForms = document.querySelectorAll('.delete-post-form');
    
    deleteForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Are you sure?',
                text: "This recruitment post will be permanently deleted!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545', 
                cancelButtonColor: '#6c757d',  
                confirmButtonText: 'Yes, delete it!',
                background: '#212529',         
                color: '#f8f9fa'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            });
        });
    });

});