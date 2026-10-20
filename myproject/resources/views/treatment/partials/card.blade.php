@php
    $levelKey = strtolower((string) $item->level);
    $levelClass = $levelKey === 'high' ? 'level-high' : (in_array($levelKey, ['moderate', 'mid']) ? 'level-mid' : 'level-easy');
@endphp
<article class="ch-card {{ $variant }}-card searchable {{ !empty($extra) ? 'is-extra' : '' }}"
         data-id="{{ $item->id }}"
         data-disease="{{ strtolower(trim((string) $item->disease_name)) }}"
         data-level="{{ $levelKey }}"
         data-search="{{ strtolower($item->title . ' ' . $item->type . ' ' . $item->disease_name . ' ' . $item->description) }}">

    <div class="ch-card-top">
        <span class="ch-chip">{{ $item->type }}</span>
        <span class="ch-badge {{ $levelClass }}">{{ ucfirst($item->level) }}</span>
    </div>

    <h3 class="ch-card-title">{{ $item->title }}</h3>

    @if($item->disease_name)
        <div class="ch-disease"><i class="fas fa-notes-medical"></i> {{ $item->disease_name }}</div>
    @endif

    <p class="ch-card-desc">{{ $item->description }}</p>

    <div class="ch-card-footer">
        <button type="button" class="ch-view-btn" data-open="{{ $item->id }}" aria-haspopup="dialog">
            View details <i class="fas fa-arrow-right"></i>
        </button>
    </div>
</article>
