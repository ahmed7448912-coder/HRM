/**
 * PeopleDesk - Typewriter Animation Engine
 */
document.addEventListener('DOMContentLoaded', () => {
    const initTypewriter = (selector, words) => {
        const el = document.querySelector(selector);
        if (!el) return;
        
        let wordIdx = 0, charIdx = 0, isDeleting = false, typeSpeed = 100;

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

    initTypewriter('.text-gradient:not(.type-features):not(.type-pricing):not(.type-integrations):not(.type-reviews):not(.type-faq)', ['smarter.', 'faster.', 'better.', 'together.']);
    initTypewriter('.type-features', ['scale your culture.', 'boost your team.', 'grow your business.']);
    initTypewriter('.type-pricing', ['every stage.', 'every team.', 'every budget.']);
    initTypewriter('.type-integrations', ['everyone.', 'every app.', 'every workflow.']);
    initTypewriter('.type-reviews', ['HR leaders', 'Founders', 'Teams']);
    initTypewriter('.type-faq', ['Questions', 'Support', 'Answers']);
});
