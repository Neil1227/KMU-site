  window.addEventListener("load", function () {
    const preloader = document.getElementById("preloader");
    if (preloader) {
      setTimeout(() => {
        preloader.style.transition = "opacity 0.5s ease";
        preloader.style.opacity = 0;
        setTimeout(() => {
          preloader.style.display = "none";
        }, 500); // Wait for fade-out transition to complete
      }, 2000); // Delay before fade-out starts (in milliseconds)
    }
  });