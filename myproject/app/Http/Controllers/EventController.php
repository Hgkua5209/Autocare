<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

/**
 * Admin-only management of community events (talks, wellness programs, ...).
 * Users read events in the Community "Events" tab (see CommunityController@index).
 * Registration is handled offline through the admin contact number on each event.
 */
class EventController extends Controller
{
    public function create()
    {
        return view('community.event-form', [
            'event' => new Event(['type' => 'talk', 'is_published' => true]),
            'types' => Event::TYPES,
        ]);
    }

    public function store(Request $request)
    {
        $event = Event::create($this->validated($request) + ['created_by' => auth()->id()]);

        return redirect()->route('community', ['tab' => 'events'])
            ->with('success', 'Event "' . $event->title . '" created.');
    }

    public function edit(Event $event)
    {
        return view('community.event-form', ['event' => $event, 'types' => Event::TYPES]);
    }

    public function update(Request $request, Event $event)
    {
        $event->update($this->validated($request));

        return redirect()->route('community', ['tab' => 'events'])
            ->with('success', 'Event updated.');
    }

    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('community', ['tab' => 'events'])
            ->with('success', 'Event deleted.');
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'title'             => ['required', 'string', 'max:150'],
            'type'              => ['required', Rule::in(array_keys(Event::TYPES))],
            'description'       => ['required', 'string', 'max:5000'],
            'starts_at'         => ['required', 'date'],
            'ends_at'           => ['nullable', 'date', 'after_or_equal:starts_at'],
            'location'          => ['required', 'string', 'max:255'],
            'organizer'         => ['nullable', 'string', 'max:150'],
            'contact_name'      => ['nullable', 'string', 'max:150'],
            'contact_phone'     => ['required', 'string', 'max:30', 'regex:/^\+?[0-9][0-9\s().-]{5,28}$/'],
            'registration_info' => ['nullable', 'string', 'max:500'],
        ], [
            'contact_phone.regex' => 'Enter a valid phone number, e.g. +60 12-345 6789.',
            'ends_at.after_or_equal' => 'The end time must be the same as or after the start time.',
        ]);

        $data['is_published'] = $request->boolean('is_published');

        return $data;
    }
}
