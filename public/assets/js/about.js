/* ── ABOUT PAGE INTERACTIONS ── */
document.addEventListener('DOMContentLoaded', () => {
    const stats = document.querySelectorAll('.stat-value');
    
    const animateStats = () => {
        stats.forEach(stat => {
            const target = parseFloat(stat.getAttribute('data-target'));
            const duration = 2000; // 2 seconds
            const increment = target / (duration / 16); // 60fps
            
            let current = 0;
            const update = () => {
                current += increment;
                if (current < target) {
                    stat.innerText = Math.floor(current) + (stat.innerText.includes('%') ? '%' : '+');
                    requestAnimationFrame(update);
                } else {
                    stat.innerText = target + (stat.innerText.includes('%') ? '%' : '+');
                }
            };
            update();
        });
    };

    // Trigger animation when section is in view
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                animateStats();
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.5 });

    const statsSection = document.querySelector('.stats-dashboard');
    if (statsSection) observer.observe(statsSection);
});
