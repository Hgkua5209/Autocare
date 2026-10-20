<script>
(function () {
    // Data comes from the server as JSON (safely encoded), not interpolated into inline handlers.
    const TREATMENTS = {!! json_encode($treatments->keyBy('id'), JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_UNESCAPED_UNICODE) !!};

    const root = document.querySelector('.carehub');
    const searchInput = document.getElementById('searchInput');
    const levelSelect = document.getElementById('levelSelect');
    const chips = root.querySelectorAll('.filter-btn');
    const sections = root.querySelectorAll('.ch-section');
    const countEl = document.getElementById('resultCount');
    const noResults = document.getElementById('noResults');

    /* ---------- Filtering ---------- */
    function levelBucket(level) {
        level = (level || '').toLowerCase();
        if (level === 'high') return 'high';
        if (level === 'moderate' || level === 'mid') return 'moderate';
        return 'low';
    }

    function applyFilters() {
        const keyword = searchInput.value.trim().toLowerCase();
        const disease = root.querySelector('.filter-btn.active').dataset.filter;
        const level = levelSelect.value;
        const filterActive = keyword !== '' || disease !== 'all' || level !== 'all';

        let totalShown = 0;

        sections.forEach(function (section) {
            const cards = section.querySelectorAll('.searchable');
            const expanded = section.dataset.expanded === '1';
            let matched = 0;
            let extras = 0;

            cards.forEach(function (card) {
                const ok =
                    (keyword === '' || (card.dataset.search || '').includes(keyword)) &&
                    (disease === 'all' || card.dataset.disease === disease) &&
                    (level === 'all' || levelBucket(card.dataset.level) === level);

                const isExtra = card.classList.contains('is-extra');
                if (ok) { matched++; if (isExtra) extras++; }
                // While searching/filtering show every match; otherwise respect "show more".
                card.hidden = !(ok && (filterActive || expanded || !isExtra));
            });

            const toggle = section.querySelector('.ch-toggle');
            if (toggle) {
                toggle.hidden = filterActive || extras === 0;
                toggle.textContent = expanded ? 'Show less \u2191' : 'Show all ' + (cards.length) + ' \u2193';
                toggle.setAttribute('aria-expanded', expanded ? 'true' : 'false');
            }

            section.hidden = matched === 0;
            totalShown += matched;
        });

        countEl.textContent = totalShown + (totalShown === 1 ? ' care plan' : ' care plans');
        noResults.hidden = totalShown !== 0 || !root.querySelector('.searchable');
    }

    let timer;
    searchInput.addEventListener('input', function () {
        clearTimeout(timer);
        timer = setTimeout(applyFilters, 120);
    });
    levelSelect.addEventListener('change', applyFilters);
    chips.forEach(function (btn) {
        btn.addEventListener('click', function () {
            chips.forEach(function (b) { b.classList.remove('active'); b.setAttribute('aria-pressed', 'false'); });
            btn.classList.add('active');
            btn.setAttribute('aria-pressed', 'true');
            applyFilters();
        });
    });
    root.querySelectorAll('.ch-toggle').forEach(function (btn) {
        btn.addEventListener('click', function () {
            const section = btn.closest('.ch-section');
            section.dataset.expanded = section.dataset.expanded === '1' ? '0' : '1';
            applyFilters();
        });
    });

    /* ---------- Modal ---------- */
    const modal = document.getElementById('treatmentModal');
    const closeBtn = modal.querySelector('.ch-close');
    let lastFocus = null;

    function setBadge(el, text, cls) {
        el.textContent = text;
        el.className = 'ch-badge ' + cls;
    }

    function safeUrl(value) {
        try {
            const u = new URL(value);
            return (u.protocol === 'http:' || u.protocol === 'https:') ? u.href : null;
        } catch (e) { return null; }
    }

    function openModal(id) {
        const t = TREATMENTS[id];
        if (!t) return;

        document.getElementById('modalTitle').textContent = t.title || '';

        setBadge(document.getElementById('modalType'), t.type || '', 'type');

        const bucket = levelBucket(t.level);
        setBadge(
            document.getElementById('modalLevel'),
            'Level: ' + (t.level || 'n/a'),
            bucket === 'high' ? 'level-high' : (bucket === 'moderate' ? 'level-mid' : 'level-easy')
        );

        const isEmergency = (t.category || '').toLowerCase() === 'emergency';
        setBadge(
            document.getElementById('modalCategory'),
            isEmergency ? 'Priority care' : 'Recommended care',
            isEmergency ? 'cat-emergency' : 'cat-recommended'
        );

        document.getElementById('modalDesc').textContent = t.description || '';

        // Steps: one list item per line, strip existing "1." / "-" prefixes.
        const stepsWrap = document.getElementById('modalStepsWrap');
        const stepsEl = document.getElementById('modalSteps');
        stepsEl.innerHTML = '';
        const lines = String(t.steps || '').split(/\r?\n/)
            .map(function (l) { return l.trim().replace(/^(\d+[.)]|[-*\u2022])\s*/, ''); })
            .filter(Boolean);
        lines.forEach(function (line) {
            const li = document.createElement('li');
            li.textContent = line;
            stepsEl.appendChild(li);
        });
        stepsWrap.hidden = lines.length === 0;

        // Research link (http/https only)
        const researchEl = document.getElementById('modalResearch');
        const url = t.research ? safeUrl(String(t.research).trim()) : null;
        if (url) {
            researchEl.href = url;
            researchEl.textContent = 'View research study \u2197';
            researchEl.target = '_blank';
            researchEl.rel = 'noopener noreferrer';
        } else {
            researchEl.removeAttribute('href');
            researchEl.textContent = 'No research provided';
            researchEl.style.color = '#94a3b8';
        }
        if (url) researchEl.style.color = '';

        lastFocus = document.activeElement;
        modal.classList.add('open');
        document.body.style.overflow = 'hidden';
        closeBtn.focus();
    }

    function closeModal() {
        modal.classList.remove('open');
        document.body.style.overflow = '';
        if (lastFocus && lastFocus.focus) lastFocus.focus();
    }

    root.addEventListener('click', function (e) {
        const btn = e.target.closest('[data-open]');
        if (btn) openModal(btn.dataset.open);
    });
    modal.addEventListener('click', function (e) {
        if (e.target === modal || e.target.closest('[data-close]')) closeModal();
    });
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && modal.classList.contains('open')) closeModal();
    });

    applyFilters();
})();
</script>
