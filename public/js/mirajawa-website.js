document.addEventListener('DOMContentLoaded', function () {
    const header = document.querySelector('.mj-header');
    const toggle = document.querySelector('.mj-menu-toggle');
    const closeBtn = document.querySelector('.mj-menu-close');
    const navWrap = document.querySelector('.mj-nav-wrap');
    const overlay = document.querySelector('.mj-overlay');

    if (header) {
        const onScroll = () => header.classList.toggle('scrolled', window.scrollY > 24);
        onScroll();
        window.addEventListener('scroll', onScroll, { passive: true });
    }

    function closeMenu() {
        navWrap?.classList.remove('open');
        overlay?.classList.remove('show');
        toggle?.setAttribute('aria-expanded', 'false');
        document.body.classList.remove('mj-menu-open');
    }

    function openMenu() {
        navWrap?.classList.add('open');
        overlay?.classList.add('show');
        toggle?.setAttribute('aria-expanded', 'true');
        document.body.classList.add('mj-menu-open');
    }

    toggle?.addEventListener('click', () => {
        if (navWrap?.classList.contains('open')) {
            closeMenu();
        } else {
            openMenu();
        }
    });

    closeBtn?.addEventListener('click', closeMenu);
    overlay?.addEventListener('click', closeMenu);

    document.querySelectorAll('.mj-nav a').forEach(link => {
        link.addEventListener('click', closeMenu);
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') closeMenu();
    });

    const slides = document.querySelectorAll('.mj-hero__slide');
    const dots = document.querySelectorAll('.mj-hero__dot');
    let current = 0;
    let heroTimer;

    function goToSlide(index) {
        if (!slides.length) return;
        slides[current]?.classList.remove('active');
        dots[current]?.classList.remove('active');
        current = (index + slides.length) % slides.length;
        slides[current]?.classList.add('active');
        dots[current]?.classList.add('active');
    }

    function startHeroTimer() {
        if (slides.length <= 1) return;
        clearInterval(heroTimer);
        heroTimer = setInterval(() => goToSlide(current + 1), 7000);
    }

    dots.forEach((dot, i) => {
        dot.addEventListener('click', () => {
            goToSlide(i);
            startHeroTimer();
        });
    });

    startHeroTimer();

    const revealElements = document.querySelectorAll('.mj-reveal');
    if (revealElements.length && 'IntersectionObserver' in window) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });

        revealElements.forEach(el => observer.observe(el));
    }
});
