<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FoodSubmission;
use App\Models\Food; // Ensure Food model is imported
use Illuminate\Support\Facades\Auth;

class FoodSubmissionController extends Controller
{
    public function create()
    {
        return view('food-upload');
    }

    public function approve($id)
    {
        $submission = FoodSubmission::findOrFail($id);

        // Pull the raw data from the submission
        $sData = $submission->data;

        // Transform data to match Food Hub requirements
        $finalData = [
            'image' => $sData['image'] ?? null,
            'description' => $sData['description'] ?? '',
            // FIX: Map plural 'ingredients' from submission to singular 'ingredient' for Hub
            'ingredient' => $submission->data['ingredients'] ?? [],

            // Ensure nutrition values have units for display
            'nutrition' => [
                'calories' => ($sData['nutrition']['calories'] ?? '0') . ' kcal',
                'protein' => ($sData['nutrition']['protein'] ?? '0') . ' g',
                'carbs' => ($sData['nutrition']['carbs'] ?? '0') . ' g',
                'fat' => ($sData['nutrition']['fat'] ?? '0') . ' g',
                'fiber' => ($sData['nutrition']['fiber'] ?? '0') . ' g',
            ],

            // Carry over the Research Evidence
            'research' => $sData['research'] ?? [],
            'autoimmune_notes' => $sData['autoimmune_notes'] ?? '',

            // Initialize user interaction stats
            'rating' => 0.0,
            'like' => 0,
            'saved' => 0,
        ];

        \App\Models\Food::create([
            'name' => $submission->name,
            'type' => $submission->type,
            'data' => $finalData,
            'status' => 'published'
        ]);

        $submission->delete();

        return redirect()->back()->with('success', 'Published to Hub with full Research data!');
    }

    public function mySubmissions()
    {
        $submissions = FoodSubmission::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('food.submissions.mine', compact('submissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:food,meal',
            'description' => 'required|string',
            'autoimmune_notes' => 'required|string',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            //'image' => 'required|mimes:jpg,jpeg,png,webp,gif,mp4,mov,m4v,avi|max:20480',
            'ingredients' => 'nullable|string',
            'calories' => 'nullable|numeric',
            'protein' => 'nullable|numeric',
            'carbs' => 'nullable|numeric',
            'fat' => 'nullable|numeric',
            'fiber' => 'nullable|numeric',
            'research_title' => 'required|string',
            'research_source' => 'required|string',
            'research_url' => 'required|url',
            'research_summary' => 'required|string|min:50',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('food-submissions', 'public');
        }

        FoodSubmission::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'type' => $request->type,
            'data' => [
                'image' => $imagePath,
                // Convert "Egg, Milk" into ["Egg", "Milk"]
                'ingredients' => $request->ingredients
                    ? array_map('trim', explode(',', $request->ingredients))
                    : [],
                'nutrition' => [
                    'calories' => $request->calories ?? 0,
                    'protein' => $request->protein ?? 0,
                    'carbs' => $request->carbs ?? 0,
                    'fat' => $request->fat ?? 0,
                    'fiber' => $request->fiber ?? 0,
                ],
                'description' => $request->description,
                'autoimmune_notes' => $request->autoimmune_notes,
                'research' => [
                    'title' => $request->research_title,
                    'source' => $request->research_source,
                    'url' => $request->research_url,
                    'summary' => $request->research_summary,
                ],
                // We add these here too so the "Review" page doesn't crash either
                'rating' => '0.0',
                'like' => 0,
                'saved' => 0,
            ],
            'status' => 'pending',
        ]);

        return redirect()
            ->route('food.upload')
            ->with('success', 'Food submitted for admin review.');
    }
}
