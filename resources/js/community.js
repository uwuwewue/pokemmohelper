document.addEventListener('DOMContentLoaded', function () {
    const deleteForms = document.querySelectorAll('.delete-post-form');
    const likeButtons = document.querySelectorAll('.like-btn');

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

    likeButtons.forEach(button => {
        button.addEventListener('click', async function() {
            const postId = this.dataset.id;
            const icon = this.querySelector('.like-icon');
            const countSpan = this.querySelector('.likes-count');

            try {
                const response = await fetch(`/post/${postId}/like`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                });

                const data = await response.json();

                if (data.status === 'success') {
                    countSpan.textContent = data.likes_count;

                    if (data.liked) {
                        icon.classList.remove('far', 'text-light');
                        icon.classList.add('fas', 'text-danger');
                    } else {
                        icon.classList.remove('fas', 'text-danger');
                        icon.classList.add('far', 'text-light'); 
                    }
                }
            } catch (error) {
                console.error('Error', error);
            }
        });
    });
});