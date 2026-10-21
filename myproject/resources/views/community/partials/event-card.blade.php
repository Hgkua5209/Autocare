@php
    $past = $event->is_past;
    $sameDay = $event->ends_at && $event->ends_at->isSameDay($event->starts_at);
    $longDesc = mb_strlen($event->description) > 180 || substr_count($event->description, "\n") >= 3;
@endphp
<article class="ev-card {{ $past ? 'is-past' : '' }} {{ !$event->is_published ? 'is-draft' : '' }}"
         data-type="{{ $event->type }}">

    <div class="ev-date" aria-hidden="true">
        <div class="m">{{ $event->starts_at->format('M') }}</div>
        <div class="d">{{ $event->starts_at->format('j') }}</div>
        <div class="y">{{ $event->starts_at->format('Y') }}</div>
    </div>

    <div class="ev-body">
        <div class="ev-top">
            <span class="ev-badge t-{{ $event->type }}">{{ $event->type_label }}</span>
            @if(!$event->is_published)
                <span class="ev-badge b-draft">Draft - hidden from users</span>
            @endif
            @if($past)
                <span class="ev-badge b-past">Ended</span>
            @endif
        </div>

        <h4 class="ev-title">{{ $event->title }}</h4>

        <div class="ev-meta">
            <span>
                <i class="fas fa-clock" aria-hidden="true"></i>
                {{ $event->starts_at->format('D, j M Y, g:i A') }}@if($event->ends_at) &ndash; {{ $sameDay ? $event->ends_at->format('g:i A') : $event->ends_at->format('D, j M Y, g:i A') }}@endif
            </span>
            <span><i class="fas fa-location-dot" aria-hidden="true"></i> {{ $event->location }}</span>
            @if($event->organizer)
                <span><i class="fas fa-user-group" aria-hidden="true"></i> {{ $event->organizer }}</span>
            @endif
        </div>

        <div class="ev-desc {{ $longDesc ? 'clamp' : '' }}">{!! nl2br(e($event->description)) !!}</div>
        @if($longDesc)
            <button type="button" class="ev-readmore" aria-expanded="false">Read more</button>
        @endif

        <div class="ev-contact">
            <h4>How to register</h4>
            @auth
                <div class="row">
                    <span>Contact the admin{!! $event->contact_name ? ': <strong>'.e($event->contact_name).'</strong>' : '' !!}</span>
                    <a class="ev-call" href="tel:{{ $event->tel }}">
                        <i class="fas fa-phone" aria-hidden="true"></i> {{ $event->contact_phone }}
                    </a>
                </div>
                @if($event->registration_info)
                    <p class="ev-note">{{ $event->registration_info }}</p>
                @endif
            @else
                <p class="ev-note" style="margin:0;">
                    <a class="ev-login" href="{{ route('login') }}">Log in</a> to see the contact number and register through the admin.
                </p>
            @endauth
        </div>

        @if($isAdminUser)
            <div class="ev-admin">
                <a href="{{ route('events.edit', $event) }}">Edit</a>
                <form method="POST" action="{{ route('events.destroy', $event) }}"
                      onsubmit="return confirm('Delete this event? This cannot be undone.');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="danger">Delete</button>
                </form>
            </div>
        @endif
    </div>
</article>
