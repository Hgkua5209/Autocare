@extends('layouts.app')

@section('content')

@include('treatment.partials.styles')

<div class="carehub">

    {{-- HEADER --}}
    <div class="ch-header">
        <div>
            <h1 class="ch-title">Care Hub</h1>
            <p class="ch-subtitle">Care plans for managing flares and day-to-day symptoms.</p>
        </div>

        @if(auth()->check() && auth()->user()->role === 'admin')
            <a class="btn-create" href="{{ route('treatment.create') }}">+ Create Care Plan</a>
        @endif
    </div>

    <div class="ch-disclaimer" role="note">
        <i class="fas fa-triangle-exclamation" aria-hidden="true"></i>
        <span>
            This information is educational and does not replace professional medical advice.
            If you have severe or sudden symptoms, contact your doctor or local emergency services.
        </span>
    </div>

    {{-- TOOLBAR --}}
    <div class="ch-toolbar">
        <div class="ch-search">
            <i class="fas fa-magnifying-glass" aria-hidden="true"></i>
            <input type="search" id="searchInput" placeholder="Search by title, type or condition..." aria-label="Search care plans" autocomplete="off">
        </div>

        <select id="levelSelect" class="ch-select" aria-label="Filter by level">
            <option value="all">All levels</option>
            <option value="high">High</option>
            <option value="moderate">Moderate</option>
            <option value="low">Low / Easy</option>
        </select>

        <span class="ch-count" id="resultCount" aria-live="polite"></span>
    </div>

    {{-- DISEASE FILTER (built from the database) --}}
    <div class="filter-container" role="group" aria-label="Filter by condition">
        <button type="button" class="filter-btn active" data-filter="all" aria-pressed="true">All Conditions</button>
        @foreach($diseases as $disease)
            <button type="button" class="filter-btn" data-filter="{{ mb_strtolower($disease) }}" aria-pressed="false">{{ $disease }}</button>
        @endforeach
    </div>

    @if($treatments->isEmpty())
        <div class="ch-empty">
            <i class="fas fa-box-open fa-2x" aria-hidden="true"></i>
            <p>No care plans yet.@if(auth()->check() && auth()->user()->role === 'admin') Click "Create Care Plan" to add one.@endif</p>
        </div>
    @else

        {{-- PRIORITY CARE --}}
        @if($emergency->isNotEmpty())
        <section class="ch-section emergency-section" data-expanded="0">
            <div class="ch-section-head">
                <h2 class="ch-section-title emergency-title"><i class="fas fa-circle-exclamation" aria-hidden="true"></i> Priority Care</h2>
                <span class="ch-section-note">For flares and urgent symptoms</span>
            </div>

            <div class="ch-grid">
                @foreach($emergency as $item)
                    @include('treatment.partials.card', ['item' => $item, 'variant' => 'emergency', 'extra' => $loop->index >= 3])
                @endforeach
            </div>

            @if($emergency->count() > 3)
                <button type="button" class="ch-toggle" aria-expanded="false">Show all {{ $emergency->count() }} &darr;</button>
            @endif
        </section>
        @endif

        {{-- RECOMMENDED CARE --}}
        @if($recommended->isNotEmpty())
        <section class="ch-section recommended-section" data-expanded="0">
            <div class="ch-section-head">
                <h2 class="ch-section-title recommended-title"><i class="fas fa-heart-pulse" aria-hidden="true"></i> Recommended Care</h2>
                <span class="ch-section-note">Everyday habits and long-term management</span>
            </div>

            <div class="ch-grid">
                @foreach($recommended as $item)
                    @include('treatment.partials.card', ['item' => $item, 'variant' => 'recommended', 'extra' => $loop->index >= 6])
                @endforeach
            </div>

            @if($recommended->count() > 6)
                <button type="button" class="ch-toggle" aria-expanded="false">Show all {{ $recommended->count() }} &darr;</button>
            @endif
        </section>
        @endif

        <div class="ch-empty" id="noResults" hidden>
            <i class="fas fa-magnifying-glass fa-2x" aria-hidden="true"></i>
            <p>No care plans match your search. Try a different keyword or clear the filters.</p>
        </div>

    @endif

    {{-- DETAILS MODAL --}}
    <div id="treatmentModal" class="ch-modal" role="dialog" aria-modal="true" aria-labelledby="modalTitle">
        <div class="ch-modal-content">
            <button type="button" class="ch-close" data-close aria-label="Close">&times;</button>

            <h2 id="modalTitle"></h2>

            <div class="ch-meta">
                <span class="ch-badge type" id="modalType"></span>
                <span class="ch-badge" id="modalLevel"></span>
                <span class="ch-badge" id="modalCategory"></span>
            </div>

            <div class="ch-modal-section">
                <h4>Description</h4>
                <p id="modalDesc"></p>
            </div>

            <div class="ch-modal-section" id="modalStepsWrap">
                <h4>Steps</h4>
                <ol class="ch-steps" id="modalSteps"></ol>
            </div>

            <div class="ch-modal-section">
                <h4>Research</h4>
                <a id="modalResearch" class="ch-research"></a>
            </div>

            <button type="button" class="ch-back-btn" data-close>&larr; Back</button>
        </div>
    </div>

</div>

@include('treatment.partials.scripts')

@endsection
