@extends('layouts.app')

@section('content')

<style>
body {
    background:#f1f5f9;
}

/* CONTAINER */
.treatment-container {
    padding: 20px;
}

/* TOP */
.top-actions {
    display: grid;
    grid-template-columns: 1fr auto 1fr;
    align-items: center;
    margin-bottom: 30px;
}

.btn-create {
    justify-self: start;
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    padding: 10px 20px;
    border-radius: 10px;
    border: none;
    cursor: pointer;
}

.page-title {
    text-align: center;
    font-size: 2rem;
    font-weight: 700;
    color: white;
}

.search-box {
    justify-self: end;
    padding: 10px 15px;
    border-radius: 10px;
    border: none;
    width: 250px;
}
        .dashboard-footer {
            text-align: center;
            padding: 20px;
            color: var(--gray);
            font-size: 0.9rem;
            border-top: 1px solid var(--gray-light);
            margin-top: 30px;
        }

        .footer-warning {
    font-size: 0.8rem;
    margin-top: 5px;
    color: #ef4444; /* 🔥 merah */
}

/* SECTION STYLE */
.section {
    padding: 20px;
    border-radius: 15px;
    margin-bottom: 30px;
}

/* 🚨 EMERGENCY */
.emergency-section {
    background: linear-gradient(135deg, rgba(239,68,68,0.15), rgba(239,68,68,0.05));
    border: 1px solid rgba(239,68,68,0.3);
}

.emergency-title {
    color: #f87171;
}

/* ⭐ RECOMMENDED */
.recommended-section {
    background: linear-gradient(135deg, rgba(102,126,234,0.15), rgba(102,126,234,0.05));
    border: 1px solid rgba(102,126,234,0.3);
}

.recommended-title {
    color: #a5b4fc;
}

/* TITLE */
.section-title {
    font-size: 1.4rem;
    margin-bottom: 15px;
    font-weight: 600;
}

/* GRID */
.treatment-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 25px;
}

/* CARD */
.treatment-card {
    background: #ffffff;
    border-radius: 15px;
    padding: 20px;
    transition: 0.3s;
}

.treatment-card:hover {
    transform: translateY(-5px);
}

/* DIFFERENT BORDER */
.emergency-card {
    border-left: 5px solid #ef4444;
}

.recommended-card {
    border-left: 5px solid #667eea;
}

.treatment-title {
    font-size: 1.2rem;
    font-weight: 600;
}

.treatment-type {
    display: inline-block;
    margin: 10px 0;
    padding: 5px 10px;
    background: #c7d2fe;
    border-radius: 20px;
    font-size: 0.8rem;
}

.treatment-desc {
    color: #475569;
    margin-bottom: 10px;
}

.treatment-footer {
    display: flex;
    justify-content: space-between;
    font-size: 0.85rem;
}
.title {
    width: 100%;
    text-align: center;
    font-size: 28px;
    font-weight: 600;
    color: #1e293b;
    margin: 20px 0;
}
/* SEE MORE */
.see-more {
    margin-top: 15px;
    color: #fc6363;
    cursor: pointer;
    text-align: right;
}

/* popup details */
.modal {
    display: none;
    position: fixed;
    z-index: 999;
    inset: 0;
    background: rgba(0,0,0,0.5);
    backdrop-filter: blur(4px);
}

.modal-content {
    background: #ffffff;
    margin: 5% auto;
    padding: 30px;
    width: 550px;
    max-height: 80vh;
    overflow-y: auto;

    border-radius: 20px;
    position: relative;

    box-shadow: 0 25px 60px rgba(0,0,0,0.25);
}


.close-btn {
    position: absolute;
    right: 15px;
    top: 10px;
    font-size: 22px;
    cursor: pointer;
}

/* Title */
#modalTitle {
    font-size: 22px;
    font-weight: 700;
    margin-bottom: 20px;
}

/* Section */
.modal-section {
    margin-bottom: 18px;
}

/* Section label */
.modal-section h4 {
    font-size: 13px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    color: #94a3b8;
    margin-bottom: 6px;
}

/* Content text */
.modal-section p {
    font-size: 15px;
    color: #334155;
    line-height: 1.6;
}

/* Steps box */
#modalSteps {
    white-space: pre-line;
    background: #f1f5f9;
    padding: 12px;
    border-radius: 10px;
    font-size: 14px;
    color: #1e293b;
}

/* steps formatting */
#modalSteps {
    white-space: pre-line;
    background: #f8fafc;
    padding: 10px;
    border-radius: 10px;
}

/* button */
.full-page-btn {
    margin-top: 20px;
    width: 100%;
    padding: 12px;

    background: #667eea;
    color: white;
    border: none;
    border-radius: 12px;

    cursor: pointer;
}

.meta-row {
    display: flex;
    gap: 10px;
    margin-bottom: 20px;
}

/* base badge */
.badge {
    padding: 6px 12px;
    border-radius: 999px;
    font-size: 12px;
    font-weight: 600;
}

/* type */
.badge.type {
    background: #e0e7ff;
    color: #4338ca;
}

/* ===== LEVEL ===== */
.level-high {
    background: #fee2e2;
    color: #dc2626;
}

.level-mid {
    background: #fef3c7;
    color: #d97706;
}

.level-easy {
    background: #dcfce7;
    color: #16a34a;
}

/* ===== CATEGORY ===== */
.cat-emergency {
    background: #fee2e2;
    color: #dc2626;
}

.cat-recommended {
    background: #dcfce7;
    color: #16a34a;
}

/* ===== LEVEL ===== */
.level-high {
    background: #fee2e2;
    color: #dc2626;
}

.level-mid {
    background: #fef3c7;
    color: #d97706;
}

.level-easy {
    background: #dcfce7;
    color: #16a34a;
}

/* ===== CATEGORY ===== */
.cat-emergency {
    background: #fee2e2;
    color: #dc2626;
}

.cat-recommended {
    background: #dcfce7;
    color: #16a34a;
}

/* ===== research ===== */
.research-link {
    display: inline-block;
    margin-top: 5px;
    color: #667eea;
    font-weight: 600;
    text-decoration: none;
}

.research-link:hover {
    text-decoration: underline;
}
</style>

<div class="treatment-container">

    <!-- TOP -->
    <div class="top-actions">
        <button class="btn-create" onclick="window.location='{{ route('treatment.create') }}'">+ Create Treatment</button>

        <div class="title">Treatment Hub</div>

        <input 
            type="text" 
            placeholder="Search treatment..." 
            class="search-box"
            id="searchInput"
        >
    </div>

    <!-- 🚨 EMERGENCY -->
<div class="section emergency-section">

    <h2 class="section-title emergency-title">Emergency Treatment</h2>

    <div class="treatment-grid">

        {{-- SHOW FIRST 3 --}}
        @foreach($emergency->take(3) as $item)
<div class="treatment-card emergency-card searchable"
     data-title="{{ strtolower($item->title) }}"
     data-type="{{ strtolower($item->type) }}"
     data-desc="{{ strtolower($item->description) }}">
            <h3 class="treatment-title">{{ $item->title }}</h3>

            <span class="treatment-type">{{ $item->type }}</span>

            <p class="treatment-desc">{{ $item->description }}</p>

            <div class="treatment-footer">
                <span>Level: {{ $item->level }}</span>
<span class="view-btn"
onclick="openModal(
    `{{ $item->title }}`,
    `{{ $item->type }}`,
    `{{ $item->level }}`,
    `{{ $item->category }}`,
    `{{ addslashes($item->description) }}`,
    `{{ addslashes($item->research) }}`,
    `{{ addslashes($item->steps) }}`
)">
    View
</span>
            </div>
        </div>
        @endforeach

        {{-- HIDDEN EXTRA --}}
        @foreach($emergency->skip(3) as $item)
        <div class="treatment-card emergency-card extra-card" style="display:none;">
            <h3 class="treatment-title">{{ $item->title }}</h3>

            <span class="treatment-type">{{ $item->type }}</span>

            <p class="treatment-desc">{{ $item->description }}</p>

            <div class="treatment-footer">
                <span>Level: {{ $item->level }}</span>
<span class="view-btn"
onclick="openModal(
    `{{ $item->title }}`,
    `{{ $item->type }}`,
    `{{ $item->level }}`,
    `{{ $item->category }}`,
    `{{ addslashes($item->description) }}`,
    `{{ addslashes($item->research) }}`,
    `{{ addslashes($item->steps) }}`
)">
    View
</span>
            </div>
        </div>
        @endforeach

    </div>

    {{-- SEE MORE BUTTON --}}
    @if($emergency->count() > 3)
    <div class="see-more" onclick="toggleEmergency()">
        See More ↓
    </div>
    @endif

</div>

    <!-- ⭐ RECOMMENDED -->
<div class="section recommended-section">

    <h2 class="section-title recommended-title">Recommended Treatment</h2>

    <div class="treatment-grid">

        @foreach($recommended as $item)
<div class="treatment-card recommended-card searchable"
     data-title="{{ strtolower($item->title) }}"
     data-type="{{ strtolower($item->type) }}"
     data-desc="{{ strtolower($item->description) }}">
            <h3 class="treatment-title">{{ $item->title }}</h3>

            <span class="treatment-type">{{ $item->type }}</span>

            <p class="treatment-desc">{{ $item->description }}</p>

            <div class="treatment-footer">
                <span>Level: {{ $item->level }}</span>
<span class="view-btn"
onclick="openModal(
    `{{ $item->title }}`,
    `{{ $item->type }}`,
    `{{ $item->level }}`,
    `{{ $item->category }}`,
    `{{ addslashes($item->description) }}`,
    `{{ addslashes($item->research) }}`,
    `{{ addslashes($item->steps) }}`
)">
    View
</span>
            </div>
        </div>
        @endforeach

    </div>
</div>

@if($treatments->isEmpty())
    <p style="text-align:center; color:#94a3b8;">
        No treatments yet. Click "Create Treatment" to add one.
    </p>
@endif

        <!-- popup details -->
<div id="treatmentModal" class="modal">
    <div class="modal-content">

        <span class="close-btn" onclick="closeModal()">&times;</span>

        <!-- TITLE -->
        <h2 id="modalTitle"></h2>

        <!-- META INFO -->
        <div class="meta-row">
            <span class="badge type" id="modalType"></span>
            <span class="badge level" id="modalLevel"></span>
            <span class="badge category" id="modalCategory"></span>
        </div>

        <!-- CONTENT -->
        <div class="modal-section">
            <h4>Description</h4>
            <p id="modalDesc"></p>
        </div>

        <div class="modal-section">
            <h4>Research</h4>
            <a id="modalResearch" target="_blank" class="research-link"></a>
        </div>

        <div class="modal-section">
            <h4>Steps</h4>
            <pre id="modalSteps"></pre>
        </div>

        <button class="full-page-btn" onclick="closeModal()">← Back</button>

    </div>
</div>

<script>
const searchInput = document.getElementById('searchInput');

searchInput.addEventListener('keyup', function () {
    const keyword = this.value.toLowerCase();

    const cards = document.querySelectorAll('.searchable');

    cards.forEach(card => {
        const title = card.dataset.title;
        const type = card.dataset.type;
        const desc = card.dataset.desc;

        if (
            title.includes(keyword) ||
            type.includes(keyword) ||
            desc.includes(keyword)
        ) {
            card.style.display = "block";
        } else {
            card.style.display = "none";
        }
    });
});


/* ===========================
   CARD
=========================== */

function createCard(item, type){
    return `
        <div class="treatment-card ${type}-card">
            <div class="treatment-title">${item.title}</div>
            <div class="treatment-type">${item.type}</div>
            <div class="treatment-desc">${item.description}</div>
            <div class="treatment-footer">
                <span>Level: ${item.level}</span>
                <span>View</span>
            </div>
        </div>
    `;
}

/* ===========================
   EMERGENCY
=========================== */

let showAll = false;

function renderEmergency(){
    const grid = document.getElementById("emergencyGrid");
    grid.innerHTML = "";

    let data = showAll ? emergencyTreatments : emergencyTreatments.slice(0,3);

    data.forEach(item => {
        grid.innerHTML += createCard(item, 'emergency');
    });
}

function toggleEmergency() {
    const hiddenCards = document.querySelectorAll('.extra-card');
    const btn = document.querySelector('.see-more');

    let isHidden = hiddenCards[0].style.display === "none";

    hiddenCards.forEach(card => {
        card.style.display = isHidden ? "block" : "none";
    });

    btn.innerText = isHidden ? "Show Less ↑" : "See More ↓";
}

/* ===========================
   RECOMMENDED
=========================== */

function renderRecommended(){
    const grid = document.getElementById("recommendedGrid");
    grid.innerHTML = "";

    recommendedTreatments.forEach(item => {
        grid.innerHTML += createCard(item, 'recommended');
    });
}

/* INIT */
renderEmergency();
renderRecommended();

/* ===========================
popup details
=========================== */

function openModal(title, type, level, category, desc, research, steps) {
    document.getElementById("modalTitle").innerText = title;

    // TYPE (tak perlu dynamic)
    document.getElementById("modalType").innerText = type;

    // LEVEL
    let levelEl = document.getElementById("modalLevel");
    levelEl.innerText = "Level: " + level;

    levelEl.className = "badge level"; // reset

    if (level.toLowerCase() === "high") {
        levelEl.classList.add("level-high");
    } else if (level.toLowerCase() === "moderate") {
        levelEl.classList.add("level-mid");
    } else {
        levelEl.classList.add("level-easy");
    }

    // CATEGORY
    let catEl = document.getElementById("modalCategory");
    catEl.innerText = category;

    catEl.className = "badge category"; // reset

    if (category.toLowerCase() === "emergency") {
        catEl.classList.add("cat-emergency");
    } else {
        catEl.classList.add("cat-recommended");
    }

    // CONTENT
    document.getElementById("modalDesc").innerText = desc;
    document.getElementById("modalResearch").innerText = research;
    document.getElementById("modalSteps").innerText = steps;

    document.getElementById("treatmentModal").style.display = "block";

    // research
    let researchEl = document.getElementById("modalResearch");

if (research) {
    researchEl.href = research;
    researchEl.innerText = "View Research Study";
} else {
    researchEl.innerText = "No research provided";
    researchEl.removeAttribute("href");
}
}
function closeModal() {
    document.getElementById("treatmentModal").style.display = "none";
}

</script>

@endsection