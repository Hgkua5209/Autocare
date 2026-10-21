@extends('layouts.app')

@section('content')

@php
    $editing = $event->exists;
    $fmt = fn ($d) => $d ? $d->format('Y-m-d\TH:i') : '';
@endphp

<style>
.event-form-wrap { max-width: 760px; margin: 0 auto; padding: 20px; }
.event-form-card { background: #fff; border-radius: 16px; padding: 28px; box-shadow: 0 4px 20px rgba(15,23,42,0.08); color: #1e293b; }
.event-form-card h2 { margin: 0 0 4px; font-size: 1.5rem; font-weight: 700; }
.event-form-card .sub { margin: 0 0 22px; color: #64748b; font-size: 0.9rem; }
.ef-group { margin-bottom: 16px; }
.ef-group label { display: block; font-weight: 600; font-size: 0.88rem; margin-bottom: 6px; }
.ef-group .hint { font-weight: 400; color: #94a3b8; }
.ef-group input[type=text], .ef-group input[type=tel], .ef-group input[type=datetime-local], .ef-group select, .ef-group textarea {
    width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 10px; font: inherit; background: #fff;
}
.ef-group textarea { min-height: 130px; resize: vertical; }
.ef-group input:focus, .ef-group select:focus, .ef-group textarea:focus { outline: 3px solid #c7d2fe; border-color: #667eea; }
.ef-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
.ef-error { color: #dc2626; font-size: 0.82rem; margin-top: 4px; }
.ef-check { display: flex; gap: 10px; align-items: flex-start; background: #f8fafc; border-radius: 10px; padding: 12px; }
.ef-actions { display: flex; gap: 10px; margin-top: 22px; }
.ef-btn { padding: 11px 24px; border-radius: 10px; font-weight: 600; border: none; cursor: pointer; text-decoration: none; font-size: 0.95rem; }
.ef-btn.primary { background: linear-gradient(135deg, #667eea, #764ba2); color: #fff; }
.ef-btn.ghost { background: #f1f5f9; color: #475569; }
.ef-alert { background: #fee2e2; color: #991b1b; border-radius: 10px; padding: 10px 14px; margin-bottom: 16px; font-size: 0.9rem; }
@media (max-width: 600px) { .ef-row { grid-template-columns: 1fr; } }
</style>

<div class="event-form-wrap">
    <div class="event-form-card">
        <h2>{{ $editing ? 'Edit event' : 'Create event' }}</h2>
        <p class="sub">Events appear in the Community &rarr; Events tab. Users register by calling the contact number you enter here.</p>

        @if($errors->any())
            <div class="ef-alert" role="alert">Please fix the highlighted fields below.</div>
        @endif

        <form method="POST" action="{{ $editing ? route('events.update', $event) : route('events.store') }}" novalidate>
            @csrf
            @if($editing) @method('PUT') @endif

            <div class="ef-group">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" maxlength="150" required
                       value="{{ old('title', $event->title) }}" placeholder="e.g. Living well with Lupus: a talk by Dr. Aisha">
                @error('title')<div class="ef-error">{{ $message }}</div>@enderror
            </div>

            <div class="ef-group">
                <label for="type">Type</label>
                <select id="type" name="type" required>
                    @foreach($types as $key => $label)
                        <option value="{{ $key }}" @selected(old('type', $event->type) === $key)>{{ $label }}</option>
                    @endforeach
                </select>
                @error('type')<div class="ef-error">{{ $message }}</div>@enderror
            </div>

            <div class="ef-row">
                <div class="ef-group">
                    <label for="starts_at">Starts</label>
                    <input type="datetime-local" id="starts_at" name="starts_at" required value="{{ old('starts_at', $fmt($event->starts_at)) }}">
                    @error('starts_at')<div class="ef-error">{{ $message }}</div>@enderror
                </div>
                <div class="ef-group">
                    <label for="ends_at">Ends <span class="hint">(optional)</span></label>
                    <input type="datetime-local" id="ends_at" name="ends_at" value="{{ old('ends_at', $fmt($event->ends_at)) }}">
                    @error('ends_at')<div class="ef-error">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="ef-group">
                <label for="location">Location</label>
                <input type="text" id="location" name="location" maxlength="255" required
                       value="{{ old('location', $event->location) }}" placeholder="Venue address, or &quot;Online (Zoom)&quot;">
                @error('location')<div class="ef-error">{{ $message }}</div>@enderror
            </div>

            <div class="ef-group">
                <label for="organizer">Organizer / speaker <span class="hint">(optional)</span></label>
                <input type="text" id="organizer" name="organizer" maxlength="150" value="{{ old('organizer', $event->organizer) }}">
                @error('organizer')<div class="ef-error">{{ $message }}</div>@enderror
            </div>

            <div class="ef-group">
                <label for="description">Details</label>
                <textarea id="description" name="description" maxlength="5000" required
                          placeholder="What is this event about? Who is it for? What should attendees bring?">{{ old('description', $event->description) }}</textarea>
                @error('description')<div class="ef-error">{{ $message }}</div>@enderror
            </div>

            <div class="ef-row">
                <div class="ef-group">
                    <label for="contact_phone">Contact number</label>
                    <input type="tel" id="contact_phone" name="contact_phone" maxlength="30" required
                           value="{{ old('contact_phone', $event->contact_phone) }}" placeholder="+60 12-345 6789">
                    @error('contact_phone')<div class="ef-error">{{ $message }}</div>@enderror
                </div>
                <div class="ef-group">
                    <label for="contact_name">Contact person <span class="hint">(optional)</span></label>
                    <input type="text" id="contact_name" name="contact_name" maxlength="150" value="{{ old('contact_name', $event->contact_name) }}">
                    @error('contact_name')<div class="ef-error">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="ef-group">
                <label for="registration_info">Registration note <span class="hint">(optional)</span></label>
                <input type="text" id="registration_info" name="registration_info" maxlength="500"
                       value="{{ old('registration_info', $event->registration_info) }}"
                       placeholder="e.g. Call or WhatsApp before 5 Nov. Limited to 30 seats.">
                @error('registration_info')<div class="ef-error">{{ $message }}</div>@enderror
            </div>

            <div class="ef-group">
                <label class="ef-check">
                    <input type="checkbox" name="is_published" value="1" @checked($errors->any() ? old('is_published') : $event->is_published)>
                    <span><strong>Published</strong><br><span class="hint">Untick to save as a draft that only admins can see.</span></span>
                </label>
            </div>

            <div class="ef-actions">
                <button type="submit" class="ef-btn primary">{{ $editing ? 'Save changes' : 'Create event' }}</button>
                <a href="{{ route('community', ['tab' => 'events']) }}" class="ef-btn ghost">Cancel</a>
            </div>
        </form>
    </div>
</div>

@endsection
