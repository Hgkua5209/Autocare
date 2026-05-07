@extends('layouts.app')

@section('content')

<!-- TABS -->
<div class="tabs">
<button class="tab-btn active" onclick="switchTab('progressTab')">
    Progress
</button>

<button class="tab-btn" onclick="switchTab('recordTab')">
    Record
</button>
</div>

<!-- ================= PROGRESS ================= -->
<div id="progressTab" class="tab-content active">

    @if($activeProgress)

        <div class="daily-container">

            <!-- SIDEBAR -->
            <div class="day-sidebar">
                @for($i = 1; $i <= 7; $i++)
                    <div class="day-tab 
                        {{ $days[$i] == 'done' ? 'done' : '' }}
                        {{ $days[$i] == 'today' ? 'active' : '' }}">
                        Day {{ $i }}
                    </div>
                @endfor

                <div class="streak-box">🔥 {{ $streak }}</div>
            </div>

            <!-- MAIN -->
            <div class="day-content">

                <h2 class="title">
                    Daily Health Check : {{ $activeProgress->title }}
                </h2>

                @if($streak < 7)

                    @include('daily_form')



                @else

                    <div class="center-box">
                        <button class="start-btn" onclick="openModal()">Start New Journey</button>
                    </div>

                @endif

            </div>

        </div>

    @else

        <!-- NO ACTIVE -->
        <div class="center-box">
            <button class="start-btn" onclick="openModal()">Start New Journey</button>
        </div>

    @endif
@if($activeProgress)
    <div class="end-container">
        <button onclick="confirmEnd()" class="end-btn">End Progress</button>
    </div>
@endif
</div>

<!-- ================= RECORD ================= -->
<div id="recordTab" class="tab-content">

<div class="record-header">
    <h2>Progress History</h2>
    <p>Your previous health journeys</p>
</div>

<div class="record-container">

    @forelse($progressList as $progress)
<div class="record-card" onclick="goToAnalytics({{ $progress->id }})">

    <div class="record-info">
        <h3>{{ $progress->title }}</h3>
        <p>{{ $progress->created_at->format('d M Y') }}</p>
    </div>

    <form method="POST" action="/progress/{{ $progress->id }}">
        @csrf
        @method('DELETE')
        <button onclick="event.stopPropagation()" class="delete-btn">
            Delete
        </button>
    </form>

</div>
    @empty
        <p class="no-record">No progress history yet</p>
    @endforelse

</div>

</div>

<!-- ================= MODAL ================= -->
<div id="progressModal" class="modal">
    <div class="modal-box">

        <h3>Create New Progress</h3>

        <form method="POST" action="/progress">
            @csrf

            <input type="text" name="title" placeholder="Progress Title">

            <div class="modal-actions">
                <button type="submit" class="start-btn">Start</button>
                <button type="button" class="cancel-btn" onclick="closeModal()">Cancel</button>
            </div>

        </form>

    </div>
</div>

<style>

input, select, textarea {
    background: white;
    color: black;
    border: 1px solid #ccc;
}

input::placeholder {
    color: #888;
}


.page-header {
    text-align: center;
    margin-bottom: 5px;
}

.page-header h1 {
    font-size: 24px;
    font-weight: 600;
    color: #333;
}
/* LAYOUT */
.daily-container {
    display: flex;
    gap: 20px;
}

/* SIDEBAR */
.day-sidebar {
    width: 120px;
}

.day-tab {
    padding: 10px;
    margin-bottom: 10px;
    background: #ccc;
    border-radius: 10px;
    text-align: center;
    transition: 0.2s;
}

.day-tab.active {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
}

.day-tab.done {
    background: #00c853;
    color: white;
}
.day-tab.pending {
    background: #aaa;
    color: white;


}
.day-tab.missed {
    background: #d50000;
    color: white;
}

.day-tab:hover {
    transform: scale(1.05);
}
.streak-box {
    margin-top: 20px;
    font-size: 20px;
    text-align: center;
}

/* CONTENT */
.day-content {
    flex: 1;
    background: linear-gradient(135deg, #4a4277, #6a5acd);
    padding: 40px;
    border-radius: 16px;
    color: white;

    display: flex;
    flex-direction: column;
    align-items: center; /* 🔥 center content */
}

/* EMPTY */
.empty-state {
    text-align: center;
    margin-top: 100px;
}


.start-btn {
    background: linear-gradient(135deg, #6a5acd, #7b68ee);
    color: white;
    padding: 15px 25px;
    border-radius: 10px;
    border: none;
}

.end-btn {
    background: #d50000;
    color: white;
    padding: 12px 20px;
    border-radius: 10px;
    border: none;
}
.end-container {
    margin-top: 20px;
    text-align: right;
}
/* modal simple */
/* OVERLAY */
.modal {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.6);
    backdrop-filter: blur(4px);

    display: flex;
    justify-content: center;
    align-items: center;
}

/* BOX */
.modal-box {
    background: linear-gradient(135deg, #2c2c2c, #1e1e1e);
    padding: 25px;
    border-radius: 16px;
    width: 320px;
    text-align: center;
    box-shadow: 0 10px 30px rgba(0,0,0,0.5);
}

/* TITLE */
.modal-box h3 {
    color: white;
    margin-bottom: 15px;
    font-weight: 600;
}

/* INPUT */
.modal-box input {
    width: 100%;
    padding: 12px;
    border-radius: 10px;
    border: none;
    background: #fff;
    color: #333;
    margin-bottom: 15px;
}

/* BUTTON CONTAINER */
.modal-actions {
    display: flex;
    justify-content: space-between;
    gap: 10px;
}

/* START BUTTON */
.start-btn {
    flex: 1;
    border: none;
    width: fit-content !important;
    max-width: max-content;       /* 🔥 paksa override */
    display: inline-block !important;
    padding: 12px 25px;
    border-radius: 10px;
    color: white;
    cursor: pointer;
    width: 10px;
}

/* CANCEL BUTTON */
.cancel-btn {
    flex: 1;
    background: #444;
    border: none;
    padding: 10px;
    border-radius: 10px;
    color: white;
    cursor: pointer;
}

.start-btn:hover {
    transform: scale(1.05);
}

.cancel-btn:hover {
    background: #666;
}

.generate-btn {
    background: #00c853;
    color: white;
    padding: 15px 25px;
    border: none;
    border-radius: 10px;
    font-size: 16px;
    cursor: pointer;
}
/* RECORD */
/* container */
.record-container {
    max-width: 800px;
    margin: 30px auto;
    display: flex;
    flex-direction: column;
    gap: 15px;
}

/* card */
.record-card {
    background: linear-gradient(135deg, #2c2c2c, #1e1e1e);
    padding: 18px 20px;
    border-radius: 14px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    color: white;
    box-shadow: 0 6px 15px rgba(0,0,0,0.3);
}

/* text */
.record-info h3 {
    margin: 0;
    font-size: 16px;
}

.record-info p {
    margin: 3px 0 0;
    font-size: 12px;
    color: #aaa;
}

/* delete button */
.delete-btn {
    background: #d50000;
    border: none;
    padding: 8px 14px;
    border-radius: 8px;
    color: white;
    cursor: pointer;
}

.delete-btn:hover {
    background: #ff1744;
}

/* empty */
.no-record {
    text-align: center;
    color: #999;
}

.active-progress {
    border-left: 5px solid #00c853;
}

.badge {
    display: inline-block;
    margin-top: 5px;
    padding: 4px 8px;
    background: #00c853;
    color: white;
    border-radius: 6px;
    font-size: 12px;
}

.tabs {
    display: flex;
    justify-content: center;
    gap: 10px;
    margin: 20px 0;
    background: #e0e0e0;
    padding: 6px;
    border-radius: 12px;
    width: fit-content;
    margin-left: auto;
    margin-right: auto;
}

.tab-btn {
    padding: 10px 20px;
    border: none;
    border-radius: 10px;
    background: transparent;
    cursor: pointer;
    font-weight: 500;
    color: #555;
    transition: 0.2s;
}

.tab-btn.active {
    background: linear-gradient(135deg, #6a5acd, #7b68ee);
    color: white;
}

.tab-btn:hover {
    background: #ccc;
}

.tab-header {
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 10px;
    color: #333;
}

.tab-buttons {
    display: inline-flex;
    background: #eee;
    padding: 5px;
    border-radius: 10px;
}

.tab-buttons button {
    padding: 10px 25px;
    border: none;
    background: transparent;
    cursor: pointer;
    border-radius: 10px;
    font-weight: 500;
    color: #555;
    transition: 0.2s;
}
.tabs button {
    padding: 10px 20px;
    margin-right: 10px;
    cursor: pointer;
}

.tab-content {
    display: none;
}

.tab-content.active {
    display: block;
}

.active-tab {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
}

.title {
    font-size: 22px;
    font-weight: 700;
    text-align: center;
    margin-bottom: 20px;

    background:  #ffffff;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.tab-btn {
    padding: 10px 25px;
    border: none;
    background: transparent;
    cursor: pointer;
    border-radius: 10px;
    font-weight: 500;
    color: #555;
    transition: 0.3s;
}

.tab-btn.active {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
}
.start-new-btn {
    background: #2979ff;
    color: white;
    padding: 15px 30px;
    border-radius: 12px;
    border: none;
    font-size: 16px;
    cursor: pointer;
}

.center-box {
    height: 300px;
    display: flex;
    justify-content: center;
    align-items: center;
}

.record-header {
    text-align: center;
    margin-bottom: 25px;
}

.record-header h2 {
    font-size: 22px;
    font-weight: 700;
    margin-bottom: 5px;

    background: linear-gradient(135deg, #6a5acd, #7b68ee);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.record-header p {
    font-size: 13px;
    color: #aaa;
}
</style>

<script>
function switchTab(tab) {

    // hide semua tab
    document.querySelectorAll('.tab-content')
        .forEach(el => el.classList.remove('active'));

    // show selected
    document.getElementById(tab).classList.add('active');

    // reset semua button
    document.querySelectorAll('.tab-btn')
        .forEach(btn => btn.classList.remove('active'));

    // 🔥 manual detect button (NO this dependency)
    if (tab === 'recordTab') {
        document.querySelectorAll('.tab-btn')[1].classList.add('active');
    } else {
        document.querySelectorAll('.tab-btn')[0].classList.add('active');
    }

    // update URL
    const url = new URL(window.location);
    url.searchParams.set('tab', tab);
    window.history.replaceState({}, '', url);
}

function confirmEnd() {
    if (confirm("End current progress?")) {
        window.location.href = "/progress/end";
    }
}

function openModal() {
    document.getElementById('progressModal').style.display = 'flex';
}

function closeModal() {
    document.getElementById('progressModal').style.display = 'none';
}

window.onload = function() {

    document.getElementById('progressModal').style.display = 'none';

    const params = new URLSearchParams(window.location.search);
    const tab = params.get('tab');

    if (tab === 'recordTab') {
        switchTab('recordTab');
    } else {
        switchTab('progressTab');
    }
}


function goToAnalytics(id) {
    window.location.href = '/analytics/' + id;
}

</script>

@endsection