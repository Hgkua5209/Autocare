<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    public const TYPES = [
        'talk'          => 'Talk',
        'wellness'      => 'Wellness Program',
        'workshop'      => 'Workshop',
        'support_group' => 'Support Group',
        'other'         => 'Other',
    ];

    protected $fillable = [
        'created_by', 'title', 'type', 'description', 'starts_at', 'ends_at',
        'location', 'organizer', 'contact_name', 'contact_phone',
        'registration_info', 'is_published',
    ];

    protected $casts = [
        'starts_at'    => 'datetime',
        'ends_at'      => 'datetime',
        'is_published' => 'boolean',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function getTypeLabelAttribute(): string
    {
        return self::TYPES[$this->type] ?? ucfirst(str_replace('_', ' ', (string) $this->type));
    }

    /** Phone reduced to digits and a leading +, safe for a tel: link. */
    public function getTelAttribute(): string
    {
        return preg_replace('/[^\d+]/', '', (string) $this->contact_phone);
    }

    /** An event is "over" once its end time (or start time, if no end) has passed. */
    public function getIsPastAttribute(): bool
    {
        return ($this->ends_at ?? $this->starts_at)->isPast();
    }

    public function scopePublished(Builder $q): Builder
    {
        return $q->where('is_published', true);
    }
}
