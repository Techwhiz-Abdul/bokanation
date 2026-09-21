


/* =========================================================
   BOKA NATION — SCROLL REVEAL  ·  reveal.js
   No dependencies. Works with reveal.css.

   Include with:  <script src="reveal.js" defer></script>

   What it does
   1. Finds the elements listed in MAP below and tags each with a kind
      (label / title / text / media / card / item / cta).
   2. Reveals them as they approach the viewport, cascading them in the
      editorial order: label -> heading -> paragraph -> image -> button.
   3. When an element has scrolled fully out of view BELOW the viewport
      (i.e. the visitor scrolled back up), it quietly resets so it can
      emerge again next time. Content that has scrolled off the TOP
      stays put, so nothing re-animates behind the visitor.

   Add your own elements without touching this file:
      <div data-reveal="text">…</div>          kind
      <div data-reveal="text" data-reveal-rank="2.5">   order override
   Opt a whole area out:  <div data-reveal-off>…</div>
   ========================================================= */

(() => {
    'use strict';

    const root = document.documentElement;
    const mqReduce = window.matchMedia('(prefers-reduced-motion: reduce)');
    const mqPhone  = window.matchMedia('(max-width: 700px)');

    /* Bail out cleanly: visitors who prefer reduced motion, or very old
       browsers, simply see the normal static site. */
    if (mqReduce.matches || !('IntersectionObserver' in window)) {
        root.classList.remove('reveal-pending');
        return;
    }


    /* -----------------------------------------------------
       SETTINGS
       ----------------------------------------------------- */

    const STEP_DESKTOP = 120;    // ms between elements in a cascade
    const STEP_PHONE   = 90;
    const MAX_DELAY    = 640;    // never make anyone wait longer than this
    const TRIGGER      = '-8%';  // reveal a touch after an element enters the screen
    const SETTLE_MS    = 1700;   // > longest transition; then the element goes back to plain CSS
    const IDLE_REVEAL  = 1400;   // content sitting in the bottom strip of a still page appears anyway


    /* -----------------------------------------------------
       WHAT TO ANIMATE
       [ selector(s), kind, rank?, flag? ]
       Rank sets the cascade order inside a section (lower = earlier).
       First match wins, so put specific selectors first.
       Header and footer are deliberately left static.
       ----------------------------------------------------- */

    const KIND_RANK = { label: 1, title: 2, text: 3, media: 4, card: 4, item: 4, cta: 5 };

    const MAP = [

        /* Hero: the photograph leads, then the copy follows */
        ['.hero-image', 'media', 0, 'slow'],
        ['.hero-label', 'label'],
        ['.hero-content h1', 'title'],
        ['.hero-text', 'text'],

        /* Small labels / eyebrows */
        ['.section-number, .intro-label, .intro-heading p, .gallery-label, .about-label, .contact-label, ' +
         '.collection-index, .service-detail-number, .service-detail-content > span, ' +
         '.about-cta > p, .collections-cta > p, .services-cta > p, .contact-final > p', 'label'],
        ['.collection-category', 'label', 1.5],

        /* Headings */
        ['.page-intro h1, .intro-heading h2, .heading-row h2, .lookbook-title h2, .services-heading h2, ' +
         '.contact-content h2, .about-text h2, .approach-content h2, .collection-feature-content h2, ' +
         '.gallery-top h2, .gallery-cta h2, .service-detail-content h2, .experience-content h2, ' +
         '.contact-main-content h2, .contact-social h2, .about-cta h2, .collections-cta h2, ' +
         '.services-cta h2, .contact-final h2', 'title'],

        /* Supporting copy */
        ['.intro-description p, .lookbook-title p, .services-heading p, .contact-content > p, .page-intro p, ' +
         '.about-text p, .approach-text p, .collection-description, .gallery-top > p, .gallery-cta p, ' +
         '.service-detail-content p, .experience-text p, .contact-description, .contact-social > p', 'text'],

        /* Editorial photography */
        ['.lookbook-item, .about-image, .collection-feature-image, .gallery-item, .service-detail-image, ' +
         '.contact-image, .contact-main-image', 'media'],

        /* Cards and rows */
        ['.collection-card', 'card'],
        ['.service-item, .value-item, .contact-detail, .contact-social-links a', 'item'],

        /* Links and buttons */
        ['.view-all', 'cta', 3],                         // sits beside its heading
        ['.hero-button, .text-link, .contact-actions', 'cta'],
        ['.lookbook-footer', 'text', 5]
    ];

    /* The nearest "scene" an element belongs to. Cascades run per scene. */
    const GROUP_SELECTOR = '[data-reveal-group], .hero, .service-detail, .collection-feature, .about-story, section';


    /* -----------------------------------------------------
       TAGGING
       ----------------------------------------------------- */

    const tagged = new WeakSet();
    const groupState = new WeakMap();          // group element -> { next: timestamp }

    const groupOf = (el) =>
        el.closest(GROUP_SELECTOR) || el.closest('main > *, body > *') || el.parentElement || root;

    function collect() {
        const found = [];

        const add = (el, kind, rank, flag) => {
            if (tagged.has(el)) return;
            if (el.closest('[data-reveal-off], header, footer')) return;
            tagged.add(el);
            found.push({ el, kind, rank, flag });
        };

        MAP.forEach(([selector, kind, rank, flag]) => {
            document.querySelectorAll(selector).forEach((el) =>
                add(el, kind, rank ?? KIND_RANK[kind], flag));
        });

        /* Anything tagged by hand in the HTML */
        document.querySelectorAll('[data-reveal]:not([data-reveal-state])').forEach((el) => {
            const kind = el.dataset.reveal in KIND_RANK ? el.dataset.reveal : 'text';
            const manual = parseFloat(el.dataset.revealRank);
            add(el, kind, Number.isNaN(manual) ? KIND_RANK[kind] : manual, el.dataset.revealSpeed);
        });

        /* Never animate a child inside an animated parent (double movement) */
        return found.filter(({ el }) => !found.some((o) => o.el !== el && o.el.contains(el)));
    }

    function scan() {
        const list = collect();
        if (!list.length) return;

        /* Read pass, then write pass, to avoid layout thrashing */
        const info = list.map((item) => {
            const cs = getComputedStyle(item.el);
            return { ...item, inline: cs.display === 'inline', centred: cs.textAlign === 'center' };
        });

        info.forEach(({ el, kind, rank, flag, inline, centred }) => {
            if (inline) el.style.display = 'inline-block';    // transforms need a box
            if (centred) el.dataset.revealAlign = 'center';
            if (flag === 'slow') el.dataset.revealSpeed = 'slow';
            el.dataset.reveal = kind;
            el._rv = { group: groupOf(el), rank };
            el.dataset.revealState = 'hidden';
            revealObserver.observe(el);
            edgeObserver.observe(el);
        });

        root.classList.add('reveal-ready');
        root.classList.remove('reveal-pending');
    }


    /* -----------------------------------------------------
       REVEAL / RESET
       ----------------------------------------------------- */

    const stateOf = (el) => el.dataset.revealState;

    function reveal(el, delay) {
        clearTimeout(el._rvTimer);
        el.style.setProperty('--rv-delay', delay + 'ms');
        el.dataset.revealState = 'in';

        /* When it has landed, hand the element back to plain CSS so your
           own hover transitions behave exactly as before. */
        el._rvTimer = setTimeout(() => {
            if (stateOf(el) === 'in') {
                el.dataset.revealState = 'done';
                el.style.removeProperty('--rv-delay');
            }
        }, delay + SETTLE_MS);
    }

    function reset(el) {
        clearTimeout(el._rvTimer);
        el.style.removeProperty('--rv-delay');
        el.dataset.revealState = 'hidden';
    }

    /* Editorial order: scene by scene, then label -> title -> text -> media -> cta */
    function byOrder(a, b) {
        if (a._rv.group !== b._rv.group) {
            return a._rv.group.compareDocumentPosition(b._rv.group) & Node.DOCUMENT_POSITION_FOLLOWING ? -1 : 1;
        }
        if (a._rv.rank !== b._rv.rank) return a._rv.rank - b._rv.rank;
        return a.compareDocumentPosition(b) & Node.DOCUMENT_POSITION_FOLLOWING ? -1 : 1;
    }

    /* Each scene keeps a "next free slot", so elements that arrive a moment
       apart still cascade instead of colliding. */
    function schedule(batch) {
        if (!batch.length) return;

        const now  = performance.now();
        const step = mqPhone.matches ? STEP_PHONE : STEP_DESKTOP;

        batch.sort(byOrder).forEach((el) => {
            const g = groupState.get(el._rv.group) || { next: 0 };
            const start = Math.max(now, g.next);
            const delay = Math.min(Math.round(start - now), MAX_DELAY);
            g.next = now + delay + step;
            groupState.set(el._rv.group, g);
            reveal(el, delay);
        });
    }

    const inViewport = (el) => {
        const r = el.getBoundingClientRect();
        return r.bottom > 0 && r.top < window.innerHeight;
    };


    /* -----------------------------------------------------
       OBSERVERS
       revealObserver : fires slightly inside the viewport edge
       edgeObserver   : fires at the true edge; handles the reset
                        (hysteresis, so nothing flickers on small scrolls)
       ----------------------------------------------------- */

    const revealObserver = new IntersectionObserver((entries) => {
        schedule(entries
            .filter((e) => e.isIntersecting && stateOf(e.target) === 'hidden')
            .map((e) => e.target));
    }, { rootMargin: `0px 0px ${TRIGGER} 0px`, threshold: 0 });

    const edgeObserver = new IntersectionObserver((entries) => {
        entries.forEach(({ target: el, isIntersecting, boundingClientRect }) => {
            if (isIntersecting) {
                /* Safety net: something resting in the trigger strip of a page
                   that isn't scrolling should still appear. */
                if (stateOf(el) === 'hidden' && !el._rvIdle) {
                    el._rvIdle = setTimeout(() => {
                        el._rvIdle = 0;
                        if (stateOf(el) === 'hidden' && inViewport(el)) schedule([el]);
                    }, IDLE_REVEAL);
                }
                return;
            }

            clearTimeout(el._rvIdle);
            el._rvIdle = 0;

            /* Fully gone off the bottom (scrolled back up): re-arm quietly.
               Gone off the top: leave it revealed. */
            if (boundingClientRect.top > 0 && stateOf(el) !== 'hidden') reset(el);
        });
    }, { rootMargin: '0px', threshold: 0 });


    /* -----------------------------------------------------
       LIFECYCLE
       ----------------------------------------------------- */

    /* If the visitor switches on reduced motion mid-session, stand down. */
    const onMotionPref = (e) => {
        if (!e.matches) return;
        revealObserver.disconnect();
        edgeObserver.disconnect();
        root.classList.remove('reveal-ready', 'reveal-pending');
    };
    mqReduce.addEventListener ? mqReduce.addEventListener('change', onMotionPref)
                              : mqReduce.addListener(onMotionPref);

    /* Public hook, e.g. after injecting new sections:  BokaReveal.refresh() */
    window.BokaReveal = { refresh: scan };

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', scan);
    } else {
        scan();
    }
})();
