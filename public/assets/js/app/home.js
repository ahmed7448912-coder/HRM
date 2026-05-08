/**
 * PeopleDesk - Professional Enterprise Landing Engine
 */

document.addEventListener('DOMContentLoaded', () => {
    console.log("PeopleDesk Professional Engine Loaded");

    // 1. ADVANCED NAVBAR HANDLING
    const navbar = document.querySelector('.navbar');
    const handleScroll = () => {
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    };
    window.addEventListener('scroll', handleScroll);
    handleScroll();

    // 2. MULTI-INSTANCE TYPEWRITER ENGINE
    const initTypewriter = (selector, words) => {
        const el = document.querySelector(selector);
        if (!el) return;
        
        let wordIdx = 0;
        let charIdx = 0;
        let isDeleting = false;
        let typeSpeed = 100;

        const type = () => {
            const currentWord = words[wordIdx];
            
            if (isDeleting) {
                el.textContent = currentWord.substring(0, charIdx - 1);
                charIdx--;
                typeSpeed = 50;
            } else {
                el.textContent = currentWord.substring(0, charIdx + 1);
                charIdx++;
                typeSpeed = 150;
            }

            if (!isDeleting && charIdx === currentWord.length) {
                isDeleting = true;
                typeSpeed = 2500;
            } else if (isDeleting && charIdx === 0) {
                isDeleting = false;
                wordIdx = (wordIdx + 1) % words.length;
                typeSpeed = 500;
            }

            setTimeout(type, typeSpeed);
        };
        type();
    };

    // Initialize all typewriters
    initTypewriter('.text-gradient:not(.type-features):not(.type-pricing):not(.type-integrations):not(.type-reviews):not(.type-faq)', ['smarter.', 'faster.', 'better.', 'together.']);
    initTypewriter('.type-features', ['scale your culture.', 'boost your team.', 'grow your business.']);
    initTypewriter('.type-pricing', ['every stage.', 'every team.', 'every budget.']);
    initTypewriter('.type-integrations', ['everyone.', 'every app.', 'every workflow.']);
    initTypewriter('.type-reviews', ['HR leaders', 'Founders', 'Teams']);
    initTypewriter('.type-faq', ['Questions', 'Support', 'Answers']);
 // Initial state

    // 2. SMOOTH SECTION SCROLLING
    const scrollLinks = document.querySelectorAll('a[href^="#"]');
    scrollLinks.forEach(link => {
        link.addEventListener('click', (e) => {
            const href = link.getAttribute('href');
            if (href !== '#') {
                e.preventDefault();
                const target = document.querySelector(href);
                if (target) {
                    const navHeight = navbar.offsetHeight;
                    const offsetPosition = target.getBoundingClientRect().top + window.pageYOffset - navHeight;
                    window.scrollTo({
                        top: offsetPosition,
                        behavior: 'smooth'
                    });
                }
            }
        });
    });

    // 3. REVEAL ANIMATIONS (Intersection Observer)
    const revealOptions = {
        threshold: 0.15,
        rootMargin: "0px 0px -50px 0px"
    };

    const revealObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-up');
                revealObserver.unobserve(entry.target);
            }
        });
    }, revealOptions);

    const elementsToReveal = document.querySelectorAll('.feature-card, .showcase-item, .price-card, .section-header, .hero-visual');
    elementsToReveal.forEach(el => revealObserver.observe(el));

    // 4. MICRO-INTERACTION: HERO TILT
    const heroVisual = document.querySelector('.dashboard-preview');
    if (heroVisual) {
        document.addEventListener('mousemove', (e) => {
            const xAxis = (window.innerWidth / 2 - e.pageX) / 25;
            const yAxis = (window.innerHeight / 2 - e.pageY) / 25;
            heroVisual.style.transform = `perspective(1000px) rotateY(${xAxis}deg) rotateX(${yAxis}deg)`;
        });

        document.addEventListener('mouseleave', () => {
            heroVisual.style.transition = 'all 0.5s ease';
            heroVisual.style.transform = `perspective(1000px) rotateY(-15deg) rotateX(5deg)`;
        });

        document.addEventListener('mouseenter', () => {
            heroVisual.style.transition = 'none';
        });
    }

    // 5. STATS COUNTER (REUSE PREVIOUS LOGIC BUT CLEANER)
    const countStats = (el) => {
        const target = parseFloat(el.getAttribute('data-target'));
        const suffix = el.getAttribute('data-suffix') || '';
        let start = 0;
        const duration = 2000;
        
        const animate = (currentTime) => {
            if (!start) start = currentTime;
            const progress = (currentTime - start) / duration;
            if (progress < 1) {
                el.textContent = Math.floor(progress * target).toLocaleString() + suffix;
                requestAnimationFrame(animate);
            } else {
                el.textContent = target.toLocaleString() + suffix;
            }
        };
        requestAnimationFrame(animate);
    };

    const statObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                countStats(entry.target);
                statObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.5 });

    document.querySelectorAll('.stat-num').forEach(stat => statObserver.observe(stat));

    // 6. FAQ ACCORDION
    const faqItems = document.querySelectorAll('.faq-item');
    faqItems.forEach(item => {
        const trigger = item.querySelector('.faq-trigger');
        const content = item.querySelector('.faq-content');
        const icon = item.querySelector('.faq-icon');

        trigger.addEventListener('click', () => {
            const isOpen = content.style.maxHeight !== '0px' && content.style.maxHeight !== '';
            
            // Close all others
            faqItems.forEach(otherItem => {
                otherItem.querySelector('.faq-content').style.maxHeight = '0';
                otherItem.querySelector('.faq-icon').textContent = '+';
            });

            if (!isOpen) {
                content.style.maxHeight = content.scrollHeight + 'px';
                icon.textContent = '-';
            }
        });
    });
});
