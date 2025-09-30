document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll(".push-to-notif").forEach(button => {
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
                    title: "Notification Sent",
                    text: res.data.message || "Commodity pushed to notifications!",
                    timer: 2000,
                    showConfirmButton: false
                });
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
