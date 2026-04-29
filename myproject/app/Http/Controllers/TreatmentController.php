<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Treatment;

class TreatmentController extends Controller
{
    // 🔥 Display treatment page
public function index()
{
    $treatments = Treatment::all();


    // 🔥 This line solves the "Undefined variable" error
    // It looks at the 'disease_name' column and gets one of each unique name
    $diseases = Treatment::distinct()->pluck('disease_name')->filter()->toArray();

    // pecahkan ikut category
    $emergency = $treatments->where('category', 'emergency');
    $recommended = $treatments->where('category', 'recommended');

    return view('treatment.treatment', compact('treatments', 'emergency', 'recommended'));
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
