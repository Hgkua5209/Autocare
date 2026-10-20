<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Treatment;

class TreatmentController extends Controller
{
    // Display the Care Hub page
    public function index()
    {
        // Most severe first, then alphabetical, so urgent plans always lead.
        $levelRank = ['high' => 0, 'moderate' => 1, 'mid' => 1, 'low' => 2, 'easy' => 2];

        $treatments = Treatment::all()
            ->sortBy(fn ($t) => [
                $levelRank[strtolower((string) $t->level)] ?? 3,
                strtolower((string) $t->title),
            ], SORT_REGULAR)
            ->values();

        // Unique, non-empty disease names (case-insensitive), alphabetical.
        $diseases = $treatments
            ->pluck('disease_name')
            ->map(fn ($d) => trim((string) $d))
            ->filter()
            ->unique(fn ($d) => strtolower($d))
            ->sort(SORT_NATURAL | SORT_FLAG_CASE)
            ->values()
            ->all();

        // Split by category (case-insensitive).
        $emergency = $treatments->filter(fn ($t) => strtolower((string) $t->category) === 'emergency')->values();
        $recommended = $treatments->filter(fn ($t) => strtolower((string) $t->category) === 'recommended')->values();

        return view('treatment.treatment', compact('treatments', 'emergency', 'recommended', 'diseases'));
    }

    // 🔥 Show create form
    public function create()
    {
        return view('treatment.create');
    }

    // 🔥 Save data into DB
    public function store(Request $request)
    {
        // ✅ validation
        $request->validate([
            'title' => 'required',
            'disease_name' => 'required|string',
            'type' => 'required',
            'level' => 'required',
            'description' => 'required',
            'research' => 'nullable|url', // 🔥 important
            'steps' => 'nullable',
            'category' => 'required',
        ]);

        // ✅ insert into DB
        Treatment::create([
            'title' => $request->title,
            'disease_name' => $request->disease_name,
            'type' => $request->type,
            'description' => $request->description,
            'level' => $request->level,
            'research' => $request->research,
            'steps' => $request->steps,
            'category' => $request->category,
        ]);

        // ✅ redirect balik + message
        return redirect()->back()->with('success', 'Treatment created successfully!');
    }
}
