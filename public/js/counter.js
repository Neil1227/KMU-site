const counters = document.querySelectorAll('.counter');

counters.forEach(counter => {
    const target = +counter.dataset.target;
    const duration = 5000; // 0.8 seconds
    const start = 0;
    const startTime = performance.now();

    function animate(time) {
        const progress = Math.min((time - startTime) / duration, 1);
        counter.innerText = Math.floor(progress * target);

        if (progress < 1) requestAnimationFrame(animate);
    }

    requestAnimationFrame(animate);
});
