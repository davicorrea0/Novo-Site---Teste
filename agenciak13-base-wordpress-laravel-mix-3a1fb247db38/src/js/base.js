import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';
import { CustomEase } from 'gsap/CustomEase';
import Swiper from 'swiper';
import { Navigation } from 'swiper/modules';
import Plyr from 'plyr';
import { animate as motionDevAnimate } from 'motion';

window.gsap = gsap;
window.ScrollTrigger = ScrollTrigger;
window.Swiper = Swiper;
window.Plyr = Plyr;
window.motionDevAnimate = motionDevAnimate;

document.addEventListener('DOMContentLoaded', () => {
    'use strict';

    const LOADER_APPEAR_ANIMATION = 'cb-loader-appear';
    const LOADER_PULSE_ANIMATION = 'cb-loader-pulse';
    const LOADER_LOGO_FADE_ANIMATION = 'cb-loader-logo-fade-in';

    const prefersReducedMotion = typeof window.matchMedia === 'function'
        && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    if (typeof gsap !== 'undefined') {
        gsap.registerPlugin(ScrollTrigger, CustomEase);
    }

    const heroSettleEase = typeof CustomEase !== 'undefined'
        ? CustomEase.create('cbHeroSettleEase', '0.76,0,0.24,1')
        : 'power3.out';
    const heroRevealEase = typeof CustomEase !== 'undefined'
        ? CustomEase.create('cbHeroRevealEase', '0.16,1,0.3,1')
        : 'power3.out';

    const normalizeGsapEase = (value) => {
        if (Array.isArray(value)) {
            return 'power3.out';
        }

        if (typeof value !== 'string') {
            return 'power1.out';
        }

        const normalized = value.trim().toLowerCase();
        if (normalized === '') {
            return 'power1.out';
        }

        if (normalized.includes('cubic-bezier')) {
            return 'power3.out';
        }

        if (normalized === 'ease-out' || normalized === 'easeout') {
            return 'power2.out';
        }

        if (normalized === 'ease-in' || normalized === 'easein') {
            return 'power2.in';
        }

        if (normalized === 'ease-in-out' || normalized === 'easeinout') {
            return 'power2.inOut';
        }

        if (normalized === 'linear') {
            return 'none';
        }

        return value;
    };

    const motionAnimate = (target, keyframes, options = {}) => {
        if (!target || prefersReducedMotion) {
            return null;
        }

        if (typeof gsap === 'undefined') {
            return null;
        }

        const fromVars = {};
        const toVars = {};

        Object.entries(keyframes || {}).forEach(([prop, value]) => {
            if (Array.isArray(value) && value.length > 0) {
                fromVars[prop] = value[0];
                toVars[prop] = value[value.length - 1];
                return;
            }

            toVars[prop] = value;
        });

        const rawEase = options.ease || options.easing;
        const duration = typeof options.duration === 'number' ? options.duration : 0.4;
        const delay = typeof options.delay === 'number' ? options.delay : 0;
        const repeat = typeof options.repeat === 'number' ? options.repeat : 0;
        const yoyo = Boolean(options.yoyo || options.direction === 'alternate');

        let resolveFinished;
        const finished = new Promise((resolve) => {
            resolveFinished = resolve;
        });

        const tweenOptions = {
            ...toVars,
            duration,
            delay,
            repeat,
            yoyo,
            ease: normalizeGsapEase(rawEase),
            overwrite: 'auto',
            onComplete: () => {
                if (typeof resolveFinished === 'function') {
                    resolveFinished();
                }
            },
            onInterrupt: () => {
                if (typeof resolveFinished === 'function') {
                    resolveFinished();
                }
            }
        };

        if (Object.keys(fromVars).length === 0) {
            const tween = gsap.to(target, tweenOptions);
            return {
                tween,
                finished
            };
        }

        try {
            const tween = gsap.fromTo(target, fromVars, tweenOptions);
            return {
                tween,
                finished
            };
        } catch (error) {
            if (typeof resolveFinished === 'function') {
                resolveFinished();
            }
            return null;
        }
    };

    const normalizeMotionEase = (value) => {
        if (Array.isArray(value) && value.length === 4) {
            return `cubic-bezier(${value.join(',')})`;
        }

        if (typeof value === 'string') {
            if (value === 'ease-out' || value === 'easeOut') {
                return 'ease-out';
            }

            if (value === 'ease-in' || value === 'easeIn') {
                return 'ease-in';
            }

            if (value === 'ease-in-out' || value === 'easeInOut') {
                return 'ease-in-out';
            }
        }

        return value || 'ease-out';
    };

    const motionLoaderAnimate = (target, keyframes, options = {}) => {
        if (!target) {
            return null;
        }

        const duration = typeof options.duration === 'number' ? options.duration : 0.4;
        const delay = typeof options.delay === 'number' ? options.delay : 0;
        const ease = normalizeMotionEase(options.ease || options.easing);
        const repeat = typeof options.repeat === 'number' ? options.repeat : 0;
        const direction = options.direction || 'normal';
        const fill = options.fill || 'forwards';

        if (typeof motionDevAnimate === 'function') {
            try {
                const controls = motionDevAnimate(target, keyframes, {
                    duration,
                    delay,
                    ease,
                    repeat,
                    direction,
                    fill
                });

                return {
                    controls,
                    finished: controls && controls.finished ? controls.finished : Promise.resolve()
                };
            } catch (error) {
                // Fall back to GSAP helper below.
            }
        }

        return motionAnimate(target, keyframes, {
            duration,
            delay,
            easing: ease,
            repeat,
            direction
        });
    };

    const runLoaderRadialAnimation = (radialSvg) => {
        if (!radialSvg) {
            return false;
        }

        const groupedPaths = radialSvg.querySelectorAll('#paths-group path');
        const paths = groupedPaths.length > 0
            ? Array.from(groupedPaths)
            : Array.from(radialSvg.querySelectorAll('path'));

        if (paths.length === 0) {
            return false;
        }

        paths.forEach((path) => {
            path.style.animation = 'none';
            path.style.opacity = '0';
            path.style.fill = '#555555';
            path.style.transformBox = 'fill-box';
            path.style.transformOrigin = 'center center';
            path.setAttribute('data-cb-loader-path', '1');
        });

        // Force reflow so the same animation can be replayed reliably.
        // eslint-disable-next-line no-unused-expressions
        radialSvg.getBoundingClientRect();

        const cx = 1543 / 2;
        const cy = 1080 / 2;

        const pathData = paths.map((path) => {
            let px = 0;
            let py = 0;

            try {
                const bbox = path.getBBox();
                px = bbox.x + (bbox.width / 2);
                py = bbox.y + (bbox.height / 2);

                if ((bbox.width === 0 && bbox.height === 0) || Number.isNaN(px) || Number.isNaN(py)) {
                    throw new Error('Invalid SVG bbox');
                }
            } catch (error) {
                const d = path.getAttribute('d') || '';
                const match = d.match(/[Mm]\s*([-\d.]+)[,\s]*([-\d.]+)/);
                px = match ? parseFloat(match[1]) : 0;
                py = match ? parseFloat(match[2]) : 0;
            }

            const angle = Math.atan2(py - cy, px - cx);
            const dist = Math.hypot(px - cx, py - cy);

            return {
                el: path,
                x: px,
                angle,
                dist,
                sortAngle: 0
            };
        });

        const left = pathData.filter((item) => item.x < cx);
        left.forEach((item) => {
            item.sortAngle = item.angle < 0 ? item.angle + (2 * Math.PI) : item.angle;
        });
        left.sort((a, b) => a.sortAngle - b.sortAngle);

        const right = pathData.filter((item) => item.x >= cx);
        right.forEach((item) => {
            item.sortAngle = item.angle;
        });
        right.sort((a, b) => a.sortAngle - b.sortAngle);

        const maxDist = Math.max(...pathData.map((item) => item.dist), 1);
        const maxLen = Math.max(left.length, right.length, 1);
        const radialDuration = 1500;
        const pulseWait = radialDuration + 300;

        const applyAnimation = (group) => {
            group.forEach((item, index) => {
                const delayAppear = (index / maxLen) * radialDuration;
                const delayPulse = pulseWait + ((item.dist / maxDist) * 500);

                item.el.style.animation = [
                    `${LOADER_APPEAR_ANIMATION} 0.4s ${delayAppear}ms cubic-bezier(0.25, 1, 0.5, 1) forwards`,
                    `${LOADER_PULSE_ANIMATION} 0.6s ${delayPulse}ms ease-in-out forwards`
                ].join(', ');
            });
        };

        applyAnimation(left);
        applyAnimation(right);
        return true;
    };

    const runLoaderCenterLogoAnimation = (loaderLogo, logoSvg) => {
        if (!loaderLogo) {
            return;
        }

        loaderLogo.style.opacity = '0';
        loaderLogo.style.transform = 'scale(0.9)';
        loaderLogo.style.animation = `${LOADER_LOGO_FADE_ANIMATION} 1s 1.5s ease-out forwards`;

        if (logoSvg) {
            logoSvg.classList.add('cb-loader-logo-glow');
        }
    };

    const primePageEntranceState = () => {
        const siteContent = document.getElementById('site-content');
        const footer = document.querySelector('.cb-footer');

        if (siteContent) {
            siteContent.style.transform = 'translateY(100px)';
        }

        if (footer) {
            footer.style.opacity = '0';
        }
    };

    const animatePageEntrance = () => {
        const siteContent = document.getElementById('site-content');
        const footer = document.querySelector('.cb-footer');

        if (prefersReducedMotion || typeof gsap === 'undefined') {
            if (siteContent) {
                siteContent.style.transform = '';
            }

            if (footer) {
                footer.style.opacity = '';
            }

            return;
        }

        if (siteContent) {
            gsap.to(siteContent, {
                y: 0,
                duration: 0.92,
                delay: 0.04,
                ease: heroSettleEase,
                clearProps: 'transform'
            });
        }

        if (footer) {
            gsap.to(footer, {
                opacity: 1,
                duration: 1,
                delay: 0.5,
                ease: 'power1.out',
                clearProps: 'opacity'
            });
        }
    };

    const primeHeroInitialState = () => {
        const heroSection = document.getElementById('cb-hero');
        const heroBgSplit = document.querySelector('#cb-hero .cb-hero__bg-split');
        const heroContainer = document.querySelector('#cb-hero .cb-hero__container');
        const heroWords = document.querySelectorAll('[data-hero-word]');
        const subtitle = document.querySelector('#cb-hero .cb-hero__subtitle');
        const cta = document.querySelector('#cb-hero .cb-hero__cta');
        const heroImg = document.getElementById('cb-hero-img');

        if (heroSection) {
            heroSection.classList.remove('is-breathing');
        }

        if (heroBgSplit) {
            heroBgSplit.style.opacity = '0';
        }

        if (heroContainer) {
            heroContainer.style.opacity = '0';
        }

        if (heroWords.length > 0) {
            heroWords.forEach((word) => {
                word.style.opacity = '0';
                word.style.transform = 'translateY(24px)';
            });
        }

        if (subtitle) {
            subtitle.style.opacity = '0';
            subtitle.style.transform = 'translateY(24px)';
        }

        if (cta) {
            cta.style.opacity = '0';
            cta.style.transform = 'translateY(24px)';
        }

        if (heroImg) {
            heroImg.style.transform = 'scale(1.2)';
        }
    };

    const waitForNextPaint = () => new Promise((resolve) => {
        window.requestAnimationFrame(() => resolve());
    });

    const initLoader = () => {
        return new Promise((resolve) => {
        const loader = document.getElementById('cb-loader');
        const radialSvg = document.getElementById('cb-loader-radial');
        const loaderLogo = loader ? loader.querySelector('.cb-loader__logo') : null;
        const logoSvg = loaderLogo ? loaderLogo.querySelector('svg') : null;
        const heroSection = document.getElementById('cb-hero');

        document.body.classList.add('cb-loading');
        if (loader && radialSvg && heroSection) {
            document.body.classList.add('cb-hero-locked');
        }

        let hasRemoved = false;
        let hasReleasedPage = false;
        const startEntranceSequence = () => {
            if (hasReleasedPage) {
                return;
            }

            hasReleasedPage = true;
            document.body.style.overflow = '';
            document.body.classList.remove('cb-loading');
            document.body.classList.remove('cb-hero-locked');
            document.body.classList.add('cb-loader-finished');
            animatePageEntrance();
            resolve();
        };

        if (!loader || !radialSvg) {
            startEntranceSequence();
            return;
        }

        const removeLoader = () => {
            if (hasRemoved) {
                return;
            }

            hasRemoved = true;
            startEntranceSequence();
            loader.remove();
        };

        window.scrollTo(0, 0);
        document.body.style.overflow = 'hidden';

        let hasStarted = false;
        let radialAttempts = 0;
        const maxRadialAttempts = 12;
        const startLoaderAnimation = () => {
            if (hasStarted) {
                return;
            }

            if (!runLoaderRadialAnimation(radialSvg)) {
                radialAttempts += 1;
                if (radialAttempts < maxRadialAttempts) {
                    window.setTimeout(startLoaderAnimation, 80);
                    return;
                }
                hasStarted = true;
                removeLoader();
                return;
            }

            hasStarted = true;
            runLoaderCenterLogoAnimation(loaderLogo, logoSvg);

            const exitDelayMs = 3500;
            const contentFadeDurationMs = 500;
            const fadeLeadBeforeCurtainMs = 160;
            const hideDurationMs = 1000;
            const hardTimeoutMs = 9000;
            const hardTimeoutId = window.setTimeout(removeLoader, hardTimeoutMs);

            window.setTimeout(() => {
                if (hasRemoved) {
                    return;
                }

                // Start content fade slightly before curtain goes up.
                loader.classList.add('is-content-fading');

                window.setTimeout(() => {
                    if (hasRemoved) {
                        return;
                    }

                    // Run the page entrance in parallel with the curtain so it is settled as the loader clears.
                    loader.classList.add('hide-loader');
                    startEntranceSequence();

                    window.setTimeout(() => {
                        window.clearTimeout(hardTimeoutId);
                        removeLoader();
                    }, hideDurationMs);
                }, Math.min(contentFadeDurationMs, fadeLeadBeforeCurtainMs));
            }, exitDelayMs);
        };

        const triggerLoaderStart = () => {
            startLoaderAnimation();
        };

        window.requestAnimationFrame(() => {
            window.requestAnimationFrame(triggerLoaderStart);
        });
        window.setTimeout(triggerLoaderStart, 120);
        window.addEventListener('load', triggerLoaderStart, { once: true });
        });
    };

    const initHeader = () => {
        return new Promise((resolveHeaderAnimation) => {
        const header = document.getElementById('cb-header');
        const menuToggle = document.getElementById('cb-menu-toggle');
        const mobileMenu = document.getElementById('cb-mobile-menu');

        if (!header) {
            resolveHeaderAnimation();
            return;
        }

        const closeMobileMenu = () => {
            if (!menuToggle || !mobileMenu) {
                return;
            }

            mobileMenu.classList.remove('is-open');
            mobileMenu.setAttribute('aria-hidden', 'true');
            menuToggle.classList.remove('is-open');
            menuToggle.setAttribute('aria-expanded', 'false');
            document.body.style.overflow = '';
        };

        const openMobileMenu = () => {
            if (!menuToggle || !mobileMenu) {
                return;
            }

            mobileMenu.classList.add('is-open');
            mobileMenu.setAttribute('aria-hidden', 'false');
            menuToggle.classList.add('is-open');
            menuToggle.setAttribute('aria-expanded', 'true');
            document.body.style.overflow = 'hidden';

            mobileMenu.querySelectorAll('.cb-mobile-menu__link').forEach((link, index) => {
                motionAnimate(link, {
                    opacity: [0, 1],
                    y: [20, 0]
                }, {
                    duration: 0.35,
                    delay: index * 0.05,
                    easing: 'cubic-bezier(0.16, 1, 0.3, 1)'
                });
            });
        };

        window.closeMobileMenu = closeMobileMenu;

        const shouldAnimateHeader = !prefersReducedMotion && typeof gsap !== 'undefined';
        const hasPendingHeader = header.classList.contains('cb-header--pending');

        if (hasPendingHeader && typeof gsap !== 'undefined') {
            gsap.set(header, {
                autoAlpha: 0,
                y: -20,
                pointerEvents: 'none'
            });
            header.classList.remove('cb-header--pending');
        } else {
            header.classList.remove('cb-header--pending');
        }

        let hasResolvedHeaderAnimation = false;
        const finishHeaderAnimation = () => {
            if (hasResolvedHeaderAnimation) {
                return;
            }

            hasResolvedHeaderAnimation = true;
            header.style.pointerEvents = '';

            if (typeof gsap !== 'undefined') {
                gsap.set(header, {
                    clearProps: 'transform,opacity,visibility'
                });
            }

            resolveHeaderAnimation();
        };

        if (shouldAnimateHeader) {
            const isTopAtStart = window.scrollY <= 10;
            const headerDelay = hasPendingHeader && isTopAtStart ? 0.18 : 0;
            gsap.to(header, {
                y: 0,
                autoAlpha: 1,
                duration: 0.72,
                ease: 'power2.out',
                delay: headerDelay,
                onComplete: () => {
                    finishHeaderAnimation();
                },
                onInterrupt: () => {
                    finishHeaderAnimation();
                }
            });
        } else {
            finishHeaderAnimation();
        }

        const canAnimateHeaderOnScroll = !prefersReducedMotion && typeof gsap !== 'undefined';
        let isHeaderHidden = false;
        let lastScrollY = Math.max(window.scrollY, 0);

        const setHeaderHiddenState = (shouldHideHeader) => {
            if (isHeaderHidden === shouldHideHeader) {
                return;
            }

            isHeaderHidden = shouldHideHeader;
            header.classList.toggle('is-hidden', shouldHideHeader);

            if (!canAnimateHeaderOnScroll) {
                return;
            }

            gsap.to(header, {
                yPercent: shouldHideHeader ? -100 : 0,
                autoAlpha: shouldHideHeader ? 0 : 1,
                duration: 0.35,
                ease: 'power2.inOut',
                overwrite: 'auto'
            });
        };

        const syncHeaderScrollState = (scrollPosition) => {
            const currentScrollY = Math.max(scrollPosition, 0);
            const hasScrolledPastCompactState = currentScrollY > 150;

            if (hasScrolledPastCompactState) {
                const isScrollingDown = currentScrollY > lastScrollY;
                const shouldHideHeader = isScrollingDown && currentScrollY > 300;

                header.classList.add('is-scrolled');
                setHeaderHiddenState(shouldHideHeader);
            } else {
                header.classList.remove('is-scrolled');
                setHeaderHiddenState(false);
            }

            lastScrollY = currentScrollY;
        };

        const handleScroll = () => {
            syncHeaderScrollState(window.scrollY);
        };

        syncHeaderScrollState(window.scrollY);
        window.addEventListener('scroll', handleScroll, { passive: true });

        if (menuToggle && mobileMenu) {
            menuToggle.addEventListener('click', () => {
                if (mobileMenu.classList.contains('is-open')) {
                    closeMobileMenu();
                    return;
                }

                openMobileMenu();
            });
        }

        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape') {
                closeMobileMenu();
            }
        });

        window.addEventListener('resize', () => {
            if (window.innerWidth >= 992) {
                closeMobileMenu();
            }
        });
        });
    };

    const initHero = () => {
        const heroBgSplit = document.querySelector('#cb-hero .cb-hero__bg-split');
        const heroContainer = document.querySelector('#cb-hero .cb-hero__container');
        const heroWords = document.querySelectorAll('[data-hero-word]');
        const subtitle = document.querySelector('#cb-hero .cb-hero__subtitle');
        const cta = document.querySelector('#cb-hero .cb-hero__cta');
        const heroImg = document.getElementById('cb-hero-img');
        const heroSection = document.getElementById('cb-hero');
        const bgSplitDelay = 0.03;
        const bgSplitDuration = 0.42;
        const containerFadeDelay = 0.08;
        const containerFadeDuration = 0.5;
        const containerStartDelay = 0.04;
        const imageZoomDuration = 0.96;
        const titleStartDelay = 0.16;
        const titleDuration = 0.58;
        const subtitleDelay = 0.28;
        const ctaDelay = 0.34;
        const contentDuration = 0.56;

        const showHeroFinalState = () => {
            if (heroBgSplit) {
                heroBgSplit.style.opacity = '1';
            }

            if (heroContainer) {
                heroContainer.style.opacity = '1';
            }

            heroWords.forEach((word) => {
                word.style.opacity = '1';
                word.style.transform = 'translateY(0)';
            });

            if (subtitle) {
                subtitle.style.opacity = '1';
                subtitle.style.transform = 'translateY(0)';
            }

            if (cta) {
                cta.style.opacity = '1';
                cta.style.transform = 'translateY(0)';
            }

        };

        if (prefersReducedMotion || typeof gsap === 'undefined') {
            showHeroFinalState();
            if (heroImg) {
                heroImg.style.transform = '';
            }
        } else {
            const heroTimeline = gsap.timeline({
                defaults: {
                    ease: 'power3.out',
                    force3D: true
                },
                onComplete: showHeroFinalState,
                onInterrupt: showHeroFinalState
            });

            if (heroBgSplit) {
                heroTimeline.to(heroBgSplit, {
                    opacity: 1,
                    duration: bgSplitDuration,
                    ease: heroSettleEase,
                    clearProps: 'opacity'
                }, bgSplitDelay);
            }

            if (heroContainer) {
                heroTimeline.to(heroContainer, {
                    opacity: 1,
                    duration: containerFadeDuration,
                    ease: 'power2.out',
                    clearProps: 'opacity'
                }, containerFadeDelay);
            }

            if (heroWords.length > 0) {
                if (heroWords[0]) {
                    heroTimeline.to(heroWords[0], {
                        opacity: 1,
                        y: 0,
                        duration: titleDuration,
                        clearProps: 'transform,opacity'
                    }, titleStartDelay);
                }

                if (heroWords[1]) {
                    heroTimeline.to(heroWords[1], {
                        opacity: 1,
                        y: 0,
                        duration: titleDuration,
                        clearProps: 'transform,opacity'
                    }, titleStartDelay + 0.08);
                }
            }

            if (subtitle) {
                heroTimeline.to(subtitle, {
                    opacity: 1,
                    y: 0,
                    duration: contentDuration,
                    clearProps: 'transform,opacity'
                }, subtitleDelay);
            }

            if (cta) {
                heroTimeline.to(cta, {
                    opacity: 1,
                    y: 0,
                    duration: contentDuration,
                    clearProps: 'transform,opacity'
                }, ctaDelay);
            }
        }

        if (!prefersReducedMotion && heroImg && heroSection && typeof gsap !== 'undefined') {
            gsap.fromTo(heroImg, {
                scale: 1.2
            }, {
                scale: 1,
                duration: imageZoomDuration,
                delay: containerStartDelay,
                ease: heroSettleEase,
                clearProps: 'transform',
                onComplete: () => {
                    heroSection.classList.add('is-breathing');
                },
                onInterrupt: () => {
                    gsap.set(heroImg, {
                        clearProps: 'transform'
                    });
                    heroSection.classList.add('is-breathing');
                }
            });

            gsap.to(heroImg, {
                yPercent: 30,
                ease: 'none',
                scrollTrigger: {
                    trigger: heroSection,
                    start: 'top top',
                    end: 'bottom top',
                    scrub: true
                }
            });
        }
    };

    const initSectionReveal = () => {
        if (prefersReducedMotion || typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') {
            return;
        }

        const revealTargets = document.querySelectorAll([
            '.cb-video__container',
            '.cb-about__label',
            '.cb-about__title',
            '.cb-about__desc',
            '.cb-about-card',
            '.cb-carousel__wrapper',
            '.cb-brands__header',
            '.cb-location__header',
            '.cb-location__card-inner',
            '.cb-contact__container'
        ].join(','));

        revealTargets.forEach((element) => {
            gsap.fromTo(element, {
                y: 32,
                opacity: 0
            }, {
                y: 0,
                opacity: 1,
                duration: 0.85,
                ease: 'power3.out',
                scrollTrigger: {
                    trigger: element,
                    start: 'top 88%',
                    once: true
                }
            });
        });
    };

    const initAboutCards = () => {
        const aboutCards = document.querySelectorAll('.cb-about-card');

        aboutCards.forEach((card) => {
            card.addEventListener('click', () => {
                if (window.innerWidth >= 992) {
                    return;
                }

                const isFlipped = card.classList.contains('is-flipped');
                aboutCards.forEach((otherCard) => {
                    otherCard.classList.remove('is-flipped');
                });

                if (!isFlipped) {
                    card.classList.add('is-flipped');
                }
            });
        });
    };

    const equalizeSegmentCards = () => {
        const cards = Array.from(document.querySelectorAll('.cb-segment-card'));

        if (cards.length === 0) {
            return;
        }

        cards.forEach((card) => {
            card.style.minHeight = '';
        });

        const maxHeight = Math.max(...cards.map((card) => Math.ceil(card.getBoundingClientRect().height)));

        if (!Number.isFinite(maxHeight) || maxHeight <= 0) {
            return;
        }

        cards.forEach((card) => {
            card.style.minHeight = `${maxHeight}px`;
        });
    };

    const initSegments = () => {
        const section = document.querySelector('.cb-segments');
        const title = section?.querySelector('.cb-segments__title');
        const cards = section ? Array.from(section.querySelectorAll('.cb-segment-card')) : [];
        const icons = cards
            .map((card) => card.querySelector('.cb-segment-card__icon'))
            .filter(Boolean);
        const contents = cards
            .map((card) => card.querySelector('.cb-segment-card__content'))
            .filter(Boolean);

        if (!section || cards.length === 0) {
            return;
        }

        const runSegmentSizing = () => {
            window.requestAnimationFrame(() => {
                equalizeSegmentCards();
            });
        };

        runSegmentSizing();
        window.addEventListener('resize', runSegmentSizing, { passive: true });
        window.addEventListener('load', runSegmentSizing, { once: true });

        if (prefersReducedMotion || typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') {
            return;
        }

        const segmentsTimeline = gsap.timeline({
            scrollTrigger: {
                trigger: section,
                start: 'top 78%',
                once: true
            }
        });

        if (title) {
            segmentsTimeline.fromTo(title, {
                opacity: 0,
                y: 24
            }, {
                opacity: 1,
                y: 0,
                duration: 0.7,
                ease: 'power3.out',
                clearProps: 'opacity,transform'
            });
        }

        segmentsTimeline.fromTo(cards, {
            opacity: 0,
            y: 20
        }, {
            opacity: 1,
            y: 0,
            duration: 0.65,
            stagger: 0.1,
            ease: 'power3.out',
            clearProps: 'opacity,transform'
        }, title ? '-=0.35' : 0);

        if (icons.length > 0) {
            segmentsTimeline.fromTo(icons, {
                opacity: 0,
                y: 14,
                scale: 0.82,
                transformOrigin: '50% 50%'
            }, {
                opacity: 1,
                y: 0,
                scale: 1,
                duration: 0.45,
                stagger: 0.08,
                ease: 'back.out(1.4)',
                clearProps: 'opacity,transform'
            }, '-=0.7');
        }

        if (contents.length > 0) {
            segmentsTimeline.fromTo(contents, {
                opacity: 0,
                y: 18
            }, {
                opacity: 1,
                y: 0,
                duration: 0.5,
                stagger: 0.1,
                ease: 'power3.out',
                clearProps: 'opacity,transform'
            }, '-=0.34');
        }
    };

    const initBrands = () => {
        const brandsTrack = document.querySelector('.cb-brands__track');

        if (!brandsTrack || prefersReducedMotion || typeof gsap === 'undefined') {
            return;
        }

        gsap.killTweensOf(brandsTrack);
        gsap.set(brandsTrack, {
            xPercent: 0
        });

        gsap.to(brandsTrack, {
            xPercent: -50,
            duration: 30,
            ease: 'none',
            repeat: -1
        });
    };

    const initGallery = () => {
        const carouselWrapper = document.querySelector('.cb-carousel__wrapper');
        const carouselMotion = document.querySelector('.cb-carousel__motion');
        const swiperElement = document.querySelector('.cb-gallery-swiper');
        const galleryItems = Array.from(document.querySelectorAll('.cb-gallery-item'));
        const lightbox = document.getElementById('cb-lightbox');
        const lightboxViewport = document.querySelector('.cb-lightbox__viewport');
        const lightboxSwiperElement = document.querySelector('.cb-lightbox__swiper');
        const lightboxClose = document.getElementById('cb-lightbox-close');
        const lightboxPrev = document.getElementById('cb-lightbox-prev');
        const lightboxNext = document.getElementById('cb-lightbox-next');

        if (carouselWrapper && carouselMotion && !prefersReducedMotion && typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined') {
            gsap.fromTo(carouselMotion, {
                xPercent: 0
            }, {
                xPercent: -15,
                ease: 'none',
                scrollTrigger: {
                    trigger: carouselWrapper,
                    start: 'top bottom',
                    end: 'bottom top',
                    scrub: true
                }
            });
        }

        if (swiperElement && typeof Swiper !== 'undefined') {
            // Keep the React-like one-slide stepping while preserving drag support.
            new Swiper(swiperElement, {
                modules: [Navigation],
                slidesPerView: 'auto',
                spaceBetween: 24,
                grabCursor: true,
                speed: 700,
                rewind: true,
                navigation: {
                    prevEl: '#cb-carousel-prev',
                    nextEl: '#cb-carousel-next'
                }
            });
        }

        let lightboxSwiper = null;

        if (lightboxSwiperElement && typeof Swiper !== 'undefined') {
            lightboxSwiper = new Swiper(lightboxSwiperElement, {
                modules: [Navigation],
                slidesPerView: 1,
                spaceBetween: 24,
                speed: 500,
                rewind: true,
                centeredSlides: true,
                grabCursor: true,
                navigation: {
                    prevEl: '#cb-lightbox-prev',
                    nextEl: '#cb-lightbox-next'
                }
            });
        }

        if (!lightbox || galleryItems.length === 0) {
            return;
        }

        const openLightbox = (index) => {
            lightbox.classList.add('is-open');
            lightbox.setAttribute('aria-hidden', 'false');
            document.body.style.overflow = 'hidden';

            requestAnimationFrame(() => {
                if (lightboxSwiper) {
                    lightboxSwiper.update();
                    lightboxSwiper.slideTo(index, 0);
                }

                lightboxClose?.focus();
            });
        };

        const closeLightbox = () => {
            lightbox.classList.remove('is-open');
            lightbox.setAttribute('aria-hidden', 'true');
            document.body.style.overflow = '';
        };

        galleryItems.forEach((item, index) => {
            item.addEventListener('click', () => {
                openLightbox(index);
            });
        });

        lightboxClose?.addEventListener('click', (event) => {
            event.stopPropagation();
            closeLightbox();
        });

        lightboxPrev?.addEventListener('click', (event) => {
            event.stopPropagation();
            lightboxSwiper?.slidePrev();
        });

        lightboxNext?.addEventListener('click', (event) => {
            event.stopPropagation();
            lightboxSwiper?.slideNext();
        });

        lightbox.addEventListener('click', (event) => {
            if (event.target === lightbox) {
                closeLightbox();
            }
        });
        lightboxViewport?.addEventListener('click', (event) => event.stopPropagation());

        document.addEventListener('keydown', (event) => {
            if (!lightbox.classList.contains('is-open')) {
                return;
            }

            if (event.key === 'Escape') {
                closeLightbox();
            }

            if (event.key === 'ArrowLeft') {
                lightboxSwiper?.slidePrev();
            }

            if (event.key === 'ArrowRight') {
                lightboxSwiper?.slideNext();
            }
        });
    };

    const initVideo = () => {
        const videoThumbnail = document.getElementById('cb-video-thumbnail');
        const videoModal = document.getElementById('cb-video-modal');
        const videoModalClose = document.getElementById('cb-video-modal-close');
        const videoModalDialog = document.getElementById('cb-video-modal-dialog');
        const videoPlayerContainer = document.getElementById('cb-video-player');
        const videoId = videoPlayerContainer?.dataset.videoId;

        if (!videoThumbnail || !videoModal || !videoModalClose || !videoModalDialog || !videoPlayerContainer || !videoId || typeof Plyr === 'undefined') {
            return;
        }

        videoThumbnail.setAttribute('aria-controls', 'cb-video-modal');
        videoThumbnail.setAttribute('aria-expanded', 'false');

        const videoElement = document.createElement('div');
        videoElement.id = 'cb-plyr-video';
        videoElement.setAttribute('data-plyr-provider', 'youtube');
        videoElement.setAttribute('data-plyr-embed-id', videoId);
        videoPlayerContainer.appendChild(videoElement);

        const player = new Plyr(videoElement, {
            autoplay: false,
            controls: ['play-large', 'play', 'progress', 'current-time', 'mute', 'volume', 'fullscreen'],
            youtube: {
                rel: 0,
                noCookie: true,
                modestbranding: 1,
                playsinline: 1,
                iv_load_policy: 3
            }
        });

        const openVideoModal = () => {
            videoModal.classList.add('is-open');
            videoModal.setAttribute('aria-hidden', 'false');
            videoThumbnail.setAttribute('aria-expanded', 'true');
            document.body.style.overflow = 'hidden';
            videoModalClose.focus();

            window.requestAnimationFrame(() => {
                try {
                    const playPromise = player.play();
                    if (playPromise && typeof playPromise.catch === 'function') {
                        playPromise.catch(() => {
                            // Ignore autoplay rejection.
                        });
                    }
                } catch (error) {
                    // Ignore player readiness issues until the iframe is available.
                }
            });
        };

        const closeVideoModal = () => {
            if (!videoModal.classList.contains('is-open')) {
                return;
            }

            videoModal.classList.remove('is-open');
            videoModal.setAttribute('aria-hidden', 'true');
            videoThumbnail.setAttribute('aria-expanded', 'false');
            document.body.style.overflow = '';

            try {
                player.pause();
            } catch (error) {
                // Ignore pause errors if the player is still booting.
            }

            videoThumbnail.focus();
        };

        videoThumbnail.addEventListener('click', openVideoModal);

        videoModalClose.addEventListener('click', (event) => {
            event.stopPropagation();
            closeVideoModal();
        });

        videoModal.addEventListener('click', closeVideoModal);
        videoModalDialog.addEventListener('click', (event) => {
            event.stopPropagation();
        });

        document.addEventListener('keydown', (event) => {
            if (!videoModal.classList.contains('is-open')) {
                return;
            }

            if (event.key === 'Escape') {
                closeVideoModal();
            }
        });

        window.addEventListener('beforeunload', () => {
            document.body.style.overflow = '';

            try {
                player.destroy();
            } catch (error) {
                // Ignore cleanup errors on navigation.
            }
        });
    };

    const initCookieConsent = () => {
        const banner = document.getElementById('cb-cookie-consent');
        const actionButtons = banner ? Array.from(banner.querySelectorAll('[data-cookie-consent-action]')) : [];
        const storageKey = 'cookie-consent';

        if (!banner || actionButtons.length === 0) {
            return;
        }

        const getStoredConsent = () => {
            try {
                return window.localStorage.getItem(storageKey);
            } catch (error) {
                return null;
            }
        };

        const setStoredConsent = (value) => {
            try {
                window.localStorage.setItem(storageKey, value);
            } catch (error) {
                // Ignore storage issues so the banner still remains usable.
            }
        };

        if (getStoredConsent()) {
            return;
        }

        let revealTimerId = null;
        let hideTimerId = null;
        let isDismissed = false;

        const setBannerHiddenState = (isHidden) => {
            if (isHidden) {
                banner.setAttribute('hidden', 'hidden');
                banner.setAttribute('aria-hidden', 'true');
                return;
            }

            banner.removeAttribute('hidden');
            banner.setAttribute('aria-hidden', 'false');
        };

        const isLoaderActive = () => {
            return document.body.classList.contains('cb-loading')
                || document.body.classList.contains('cb-hero-locked')
                || Boolean(document.getElementById('cb-loader'));
        };

        const revealBanner = () => {
            if (isDismissed || getStoredConsent()) {
                return;
            }

            if (isLoaderActive()) {
                window.setTimeout(revealBanner, 180);
                return;
            }

            setBannerHiddenState(false);
            banner.classList.remove('is-hiding');

            window.requestAnimationFrame(() => {
                banner.classList.add('is-visible');
            });
        };

        const closeBanner = (consentValue) => {
            if (isDismissed) {
                return;
            }

            isDismissed = true;
            window.clearTimeout(revealTimerId);
            window.clearTimeout(hideTimerId);
            setStoredConsent(consentValue);

            banner.classList.remove('is-visible');
            banner.classList.add('is-hiding');
            banner.setAttribute('aria-hidden', 'true');

            hideTimerId = window.setTimeout(() => {
                banner.classList.remove('is-hiding');
                setBannerHiddenState(true);
            }, 650);
        };

        actionButtons.forEach((button) => {
            button.addEventListener('click', () => {
                const action = button.dataset.cookieConsentAction === 'accept'
                    ? 'accepted'
                    : 'declined';

                closeBanner(action);
            });
        });

        revealTimerId = window.setTimeout(revealBanner, 2000);
    };

    const initSmoothScroll = () => {
        document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
            anchor.addEventListener('click', (event) => {
                const href = anchor.getAttribute('href');
                if (!href || href === '#') {
                    return;
                }

                const target = document.querySelector(href);
                if (!target) {
                    return;
                }

                event.preventDefault();
                if (typeof window.closeMobileMenu === 'function') {
                    window.closeMobileMenu();
                }

                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            });
        });
    };

    primePageEntranceState();
    primeHeroInitialState();
    initCookieConsent();

    initLoader().finally(async () => {
        const headerAnimation = initHeader();

        if (document.body.classList.contains('cb-loader-finished')) {
            await waitForNextPaint();
        }

        initHero();
        await headerAnimation;
        initSectionReveal();
        initAboutCards();
        initSegments();
        initBrands();
        initGallery();
        initVideo();
        initSmoothScroll();
    });
});
