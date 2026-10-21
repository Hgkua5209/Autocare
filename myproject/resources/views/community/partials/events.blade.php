<style>
/* ===== Community > Events tab (scoped under .events-tab) ===== */
.events-tab { color: #1e293b; }
.events-tab [hidden] { display: none !important; }

.events-tab .ev-banner {
    background: rgba(255,255,255,0.92); border-left: 5px solid #667eea; border-radius: 12px;
    padding: 14px 16px; margin-bottom: 16px; display: flex; gap: 12px; align-items: flex-start;
}
.events-tab .ev-banner i { color: #667eea; margin-top: 3px; }
.events-tab .ev-banner p { margin: 0; font-size: 0.9rem; color: #475569; line-height: 1.5; }
.events-tab .ev-banner strong { color: #1e293b; }

.events-tab .ev-flash {
    background: #dcfce7; color: #166534; border-radius: 10px; padding: 10px 14px; margin-bottom: 14px; font-size: 0.9rem;
}

.events-tab .ev-toolbar { display: flex; flex-wrap: wrap; gap: 8px; align-items: center; margin-bottom: 16px; }
.events-tab .ev-chip {
    padding: 6px 16px; border-radius: 20px; background: rgba(255,255,255,0.9); border: 1px solid #e2e8f0;
    color: #64748b; font-weight: 600; font-size: 0.85rem; cursor: pointer;
}
.events-tab .ev-chip.active { background: #667eea; border-color: #667eea; color: #fff; }
.events-tab .ev-chip:focus-visible, .events-tab .ev-more summary:focus-visible { outline: 3px solid #a5b4fc; outline-offset: 2px; }
.events-tab .ev-create {
    margin-left: auto; background: linear-gradient(135deg, #667eea, #764ba2); color: #fff; padding: 8px 18px;
    border-radius: 10px; font-weight: 600; text-decoration: none; font-size: 0.9rem;
}

.events-tab .ev-heading { color: #fff; font-size: 1.05rem; font-weight: 700; margin: 18px 0 10px; }

.events-tab .ev-card {
    background: #fff; border-radius: 14px; padding: 18px; margin-bottom: 14px;
    box-shadow: 0 1px 3px rgba(15,23,42,0.08); display: flex; gap: 16px;
}
.events-tab .ev-card.is-draft { border: 2px dashed #f59e0b; }
.events-tab .ev-card.is-past { opacity: 0.8; }

.events-tab .ev-date {
    flex: 0 0 64px; text-align: center; background: #eef2ff; color: #4338ca; border-radius: 12px;
    padding: 8px 4px; align-self: flex-start;
}
.events-tab .ev-date .m { font-size: 0.7rem; font-weight: 700; text-transform: uppercase; letter-spacing: .5px; }
.events-tab .ev-date .d { font-size: 1.6rem; font-weight: 800; line-height: 1.1; }
.events-tab .ev-date .y { font-size: 0.7rem; color: #6366f1; }

.events-tab .ev-body { flex: 1; min-width: 0; }
.events-tab .ev-top { display: flex; flex-wrap: wrap; gap: 6px; align-items: center; margin-bottom: 6px; }
.events-tab .ev-badge { padding: 3px 10px; border-radius: 999px; font-size: 0.72rem; font-weight: 700; }
.events-tab .t-talk { background: #e0e7ff; color: #4338ca; }
.events-tab .t-wellness { background: #dcfce7; color: #166534; }
.events-tab .t-workshop { background: #fef3c7; color: #b45309; }
.events-tab .t-support_group { background: #fce7f3; color: #be185d; }
.events-tab .t-other { background: #e2e8f0; color: #475569; }
.events-tab .b-draft { background: #fef3c7; color: #b45309; }
.events-tab .b-past { background: #e2e8f0; color: #475569; }

.events-tab .ev-title { font-size: 1.15rem; font-weight: 700; margin: 0 0 8px; word-break: break-word; }
.events-tab .ev-meta { display: flex; flex-wrap: wrap; gap: 6px 18px; color: #475569; font-size: 0.88rem; margin-bottom: 10px; }
.events-tab .ev-meta i { width: 16px; color: #94a3b8; }

.events-tab .ev-desc { color: #334155; font-size: 0.92rem; line-height: 1.6; word-break: break-word; }
.events-tab .ev-desc.clamp { display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; }
.events-tab .ev-readmore { background: none; border: none; color: #667eea; font-weight: 600; cursor: pointer; padding: 4px 0; font-size: 0.85rem; }

.events-tab .ev-contact {
    margin-top: 12px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 12px 14px;
}
.events-tab .ev-contact h4 { margin: 0 0 6px; font-size: 0.72rem; text-transform: uppercase; letter-spacing: .5px; color: #94a3b8; }
.events-tab .ev-contact .row { display: flex; flex-wrap: wrap; gap: 8px 16px; align-items: center; font-size: 0.9rem; }
.events-tab .ev-call {
    display: inline-flex; gap: 6px; align-items: center; background: #667eea; color: #fff; padding: 7px 14px;
    border-radius: 9px; font-weight: 600; text-decoration: none; font-size: 0.88rem;
}
.events-tab .ev-call:hover { filter: brightness(1.08); }
.events-tab .ev-note { margin: 8px 0 0; font-size: 0.85rem; color: #475569; }
.events-tab .ev-login { color: #667eea; font-weight: 600; }

.events-tab .ev-admin { display: flex; gap: 8px; margin-top: 12px; }
.events-tab .ev-admin a, .events-tab .ev-admin button {
    padding: 6px 14px; border-radius: 8px; font-size: 0.82rem; font-weight: 600; cursor: pointer; text-decoration: none;
    border: 1px solid #e2e8f0; background: #fff; color: #475569;
}
.events-tab .ev-admin button.danger { color: #dc2626; border-color: #fecaca; }

.events-tab .ev-empty {
    background: rgba(255,255,255,0.9); border-radius: 14px; text-align: center; color: #64748b; padding: 36px 16px;
}
.events-tab .ev-more summary { cursor: pointer; color: #fff; font-weight: 700; margin: 18px 0 10px; }

@media (max-width: 560px) {
    .events-tab .ev-card { flex-direction: column; gap: 10px; }
    .events-tab .ev-date { flex-basis: auto; display: flex; gap: 8px; align-items: baseline; justify-content: center; padding: 6px 10px; }
    .events-tab .ev-create { margin-left: 0; }
}
</style>

@php
    $isAdminUser = auth()->check() && auth()->user()->role === 'admin';
@endphp

<div id="eventsFeed" class="events-tab" style="display:none;">

    @if(session('success'))
        <div class="ev-flash" role="status">{{ session('success') }}</div>
    @endif

    <div class="ev-banner" role="note">
        <i class="fas fa-circle-info" aria-hidden="true"></i>
        <p>
            Talks, wellness programs and workshops organised by our team.
            <strong>To register, contact the admin</strong> using the phone number shown on each event.
        </p>
    </div>

    <div class="ev-toolbar" role="group" aria-label="Filter events by type">
        <button type="button" class="ev-chip active" data-ev-type="all">All</button>
        @foreach($eventTypes as $key => $label)
            <button type="button" class="ev-chip" data-ev-type="{{ $key }}">{{ $label }}</button>
        @endforeach

        @if($isAdminUser)
            <a class="ev-create" href="{{ route('events.create') }}">+ Create event</a>
        @endif
    </div>

    <h3 class="ev-heading">Upcoming events</h3>

    @forelse($upcomingEvents as $event)
        @include('community.partials.event-card', ['event' => $event, 'isAdminUser' => $isAdminUser])
    @empty
        <div class="ev-empty">
            <i class="fas fa-calendar-xmark fa-2x" aria-hidden="true"></i>
            <p>No upcoming events right now. Check back soon!</p>
        </div>
    @endforelse

    <div class="ev-empty" id="evNoMatch" hidden>
        <p>No events of this type.</p>
    </div>

    @if($pastEvents->isNotEmpty())
        <details class="ev-more">
            <summary>Past events ({{ $pastEvents->count() }})</summary>
            @foreach($pastEvents as $event)
                @include('community.partials.event-card', ['event' => $event, 'isAdminUser' => $isAdminUser])
            @endforeach
        </details>
    @endif
</div>

<script>
(function () {
    var feed = document.getElementById('eventsFeed');
    if (!feed) return;

    var chips = feed.querySelectorAll('.ev-chip');
    var cards = feed.querySelectorAll('.ev-card');
    var upcomingCards = feed.querySelectorAll('.ev-card:not(.is-past)');
    var noMatch = document.getElementById('evNoMatch');

    chips.forEach(function (chip) {
        chip.addEventListener('click', function () {
            chips.forEach(function (c) { c.classList.remove('active'); });
            chip.classList.add('active');
            var type = chip.dataset.evType;
            var shownUpcoming = 0;
            cards.forEach(function (card) {
                var show = type === 'all' || card.dataset.type === type;
                card.hidden = !show;
                if (show && !card.classList.contains('is-past')) shownUpcoming++;
            });
            // Only show the "no match" note when upcoming events exist but none match the filter.
            noMatch.hidden = !(upcomingCards.length > 0 && shownUpcoming === 0);
        });
    });

    feed.addEventListener('click', function (e) {
        var btn = e.target.closest('.ev-readmore');
        if (!btn) return;
        var desc = btn.previousElementSibling;
        var clamped = desc.classList.toggle('clamp');
        btn.textContent = clamped ? 'Read more' : 'Show less';
        btn.setAttribute('aria-expanded', clamped ? 'false' : 'true');
    });
})();
</script>
