  document.addEventListener("DOMContentLoaded", function () {
    const images = document.querySelectorAll(".image-container");
    const modal = new bootstrap.Modal(document.getElementById("imageModal"));
    const modalImg = document.getElementById("modalImage");
    const allImages = Array.from(document.querySelectorAll(".image-container img"));
    let currentIndex = 0;

    const observer = new IntersectionObserver(entries => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add("visible");
        }
      });
    }, { threshold: 0.1 });

    images.forEach(img => observer.observe(img));

    allImages.forEach((img, i) => {
      img.addEventListener("click", () => {
        showImage(i);
      });
    });

    function showImage(index) {
      const img = allImages[index];
      modalImg.src = img.src;
      modalImg.alt = img.alt;
      currentIndex = index;
      modal.show();
    }

    document.getElementById("prevBtn").addEventListener("click", () => {
      currentIndex = (currentIndex - 1 + allImages.length) % allImages.length;
      showImage(currentIndex);
    });

    document.getElementById("nextBtn").addEventListener("click", () => {
      currentIndex = (currentIndex + 1) % allImages.length;
      showImage(currentIndex);
    });

    document.addEventListener("keydown", e => {
      if (!document.getElementById("imageModal").classList.contains("show")) return;

      if (e.key === "ArrowLeft") {
        currentIndex = (currentIndex - 1 + allImages.length) % allImages.length;
        showImage(currentIndex);
      } else if (e.key === "ArrowRight") {
        currentIndex = (currentIndex + 1) % allImages.length;
        showImage(currentIndex);
      } else if (e.key === "Escape") {
        modal.hide();
      }
    });
  });