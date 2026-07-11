document.addEventListener('DOMContentLoaded', function () {
    const deleteForms = document.querySelectorAll('.delete-post-form');

    deleteForms.forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault(); 

            Swal.fire({
                title: 'Are you sure you want to delete this post?',
                text: "You will permanently delete this post!",
                icon: 'warning',
                showCancelButton: true,
                background: '#2b2b2b',
                color: '#f8f9fa',
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Delete',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
});