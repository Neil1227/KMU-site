// ictv
document.addEventListener('DOMContentLoaded', function () {
    const cards = document.querySelectorAll('.ictv-card');
    const toggleBtn = document.getElementById('toggleIctvBtn');
    let expanded = false;

    toggleBtn?.addEventListener('click', function () {
        cards.forEach((card, index) => {
            if (index >= 6) {
                card.classList.toggle('collapsed');
            }
        });

        expanded = !expanded;
        toggleBtn.textContent = expanded ? 'Show Less' : 'Show More';

        if (!expanded) {
            document.getElementById('ictvCards').scrollIntoView({ behavior: 'smooth' });
        }
    });
});
// module
document.addEventListener('DOMContentLoaded', () => {
    const cards = document.querySelectorAll('.module-card');
    const toggleBtn = document.getElementById('toggleBtn');
    let expanded = false;

    toggleBtn.addEventListener('click', () => {
        cards.forEach((card, index) => {
            if (index >= 6) {
                card.classList.toggle('hidden-card');
            }
        });

        toggleBtn.textContent = expanded ? 'Show More' : 'Show Less';
        expanded = !expanded;

        if (!expanded) {
            document.getElementById('moduleCards').scrollIntoView({ behavior: 'smooth' });
        }
    });
});
// newsletter
document.addEventListener('DOMContentLoaded', function () {
    const cards = document.querySelectorAll('.newsletter-card');
    const toggleBtn = document.getElementById('toggleNewsletterBtn');
    let expanded = false;

    toggleBtn.addEventListener('click', function () {
        cards.forEach((card, index) => {
            if (index >= 6) {
                card.classList.toggle('collapsed');
            }
        });

        expanded = !expanded;
        toggleBtn.textContent = expanded ? 'Show Less' : 'Show More';

        if (!expanded) {
            document.getElementById('newsletterCards').scrollIntoView({ behavior: 'smooth' });
        }
    });
});
// podcast
document.getElementById('togglePodcastBtn')?.addEventListener('click', function () {
    const hiddenCards = document.querySelectorAll('.podcast-card.d-none');
    const isHidden = hiddenCards.length > 0;

    hiddenCards.forEach(card => {
        card.classList.toggle('d-none');
    });

    this.textContent = isHidden ? 'Show Less' : 'Show More';
});
