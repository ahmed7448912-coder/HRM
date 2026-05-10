/* ── CONTACT PAGE INTERACTIONS ── */
document.addEventListener('DOMContentLoaded', () => {
    const contactForm = document.querySelector('.contact-form');
    
    if (contactForm) {
        contactForm.addEventListener('submit', (e) => {
            const submitBtn = contactForm.querySelector('button');
            submitBtn.innerText = 'Sending...';
            submitBtn.style.opacity = '0.7';
            // We don't preventDefault() here so the form actually submits to the backend
        });
    }
});
