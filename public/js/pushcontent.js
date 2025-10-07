document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll(".push-action").forEach(button => {
        button.addEventListener("click", function () {
            const url = this.dataset.url;

            axios.post(url, {}, {
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
                }
            })
            .then(res => {
                Swal.fire({
                    icon: "success",
                    title: "Success",
                    text: res.data.message,
                    timer: 2000,
                    showConfirmButton: false
                });

                // Optional: remove the row after push
                const row = this.closest("tr");
                if(row) row.remove();
            })
            .catch(err => {
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: err.response?.data?.message || "Something went wrong."
                });
            });
        });
    });
});
