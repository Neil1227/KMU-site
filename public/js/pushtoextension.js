document.querySelectorAll('.tag').forEach(button => {
    button.addEventListener('click', function (event) {
 // 🔒 Prevent button default reload
        const url = this.dataset.url;

        Swal.fire({
            title: 'Push to Extension?',
            text: "This will copy the record to the Extension table.",
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes, push it!',
            cancelButtonText: 'Cancel'
        }).then(result => {
            if (result.isConfirmed) {
                axios.post(url)
                    .then(response => {
                        if (response.data.status === 'success') {
                            Swal.fire({
                                title: 'Pushed!',
                                text: response.data.message,
                                icon: 'success'
                            }).then(() => {
                                // Optional: reload table after user confirms SweetAlert
                                location.reload();
                            });
                        } else if (response.data.status === 'exists') {
                            Swal.fire('Exists', response.data.message, 'info');
                        }
                    })
                    .catch(() => {
                        Swal.fire('Error', 'Something went wrong.', 'error');
                    });
            }
        });
    });
});
