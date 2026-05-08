/**
 * PeopleDesk - Complex Interactions (Reveal, Tilt, FAQ, Stats)
 */
document.addEventListener('DOMContentLoaded', () => {
    // Reveal Observer
    const revealObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-up');
                revealObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.15 });
    document.querySelectorAll('.feature-card, .showcase-item, .price-card, .hero-visual').forEach(el => revealObserver.observe(el));

    // Hero Tilt
    const heroVisual = document.querySelector('.dashboard-preview');
    if (heroVisual) {
        document.addEventListener('mousemove', (e) => {
            const xAxis = (window.innerWidth / 2 - e.pageX) / 25;
            const yAxis = (window.innerHeight / 2 - e.pageY) / 25;
            heroVisual.style.transform = `perspective(1000px) rotateY(${xAxis}deg) rotateX(${yAxis}deg)`;
        });
        document.addEventListener('mouseleave', () => {
            heroVisual.style.transform = `perspective(1000px) rotateY(-15deg) rotateX(5deg)`;
        });
    }

    // FAQ Accordion
    document.querySelectorAll('.faq-item').forEach(item => {
        item.querySelector('.faq-trigger').addEventListener('click', () => {
            const content = item.querySelector('.faq-content');
            const icon = item.querySelector('.faq-icon');
            const isOpen = content.style.maxHeight !== '0px' && content.style.maxHeight !== '';
            
            document.querySelectorAll('.faq-content').forEach(c => c.style.maxHeight = '0');
            document.querySelectorAll('.faq-icon').forEach(i => i.textContent = '+');

            if (!isOpen) {
                content.style.maxHeight = content.scrollHeight + 'px';
                icon.textContent = '-';
            }
        });
    });
});
