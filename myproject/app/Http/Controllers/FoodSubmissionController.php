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
            'ingredient' => $sData['ingredients'] ?? [], // Map plural to singular

            // Handle Nutrition (Keep 'N/A' if it's an 'Avoid' food)
            'nutrition' => [
                'calories' => $sData['nutrition']['calories'] === 'N/A' ? 'N/A' : ($sData['nutrition']['calories'] ?? '0') . ' kcal',
                'protein' => $sData['nutrition']['protein'] === 'N/A' ? 'N/A' : ($sData['nutrition']['protein'] ?? '0') . ' g',
                'carbs' => $sData['nutrition']['carbs'] === 'N/A' ? 'N/A' : ($sData['nutrition']['carbs'] ?? '0') . ' g',
                'fat' => $sData['nutrition']['fat'] === 'N/A' ? 'N/A' : ($sData['nutrition']['fat'] ?? '0') . ' g',
                'fiber' => $sData['nutrition']['fiber'] === 'N/A' ? 'N/A' : ($sData['nutrition']['fiber'] ?? '0') . ' g',
            ],

            'research' => $sData['research'] ?? [],
            'autoimmune_notes' => $sData['autoimmune_notes'] ?? '',
            'rating' => 0.0,
            'like' => 0,
            'saved' => 0,
        ];

        // 🔥 FIX: Explicitly map these two fields from the submission JSON
        \App\Models\Food::create([
            'name' => $submission->name,
            'type' => $submission->type,
            'disease_category' => $sData['disease_category'] ?? 'General',
            'recommendation_type' => $sData['recommendation_type'] ?? 'Benefit', // This maps 'Avoid' correctly
            'data' => $finalData,
            'status' => 'published'
        ]);

        $submission->delete();

        return redirect()->back()->with('success', 'Published to Hub with correct recommendation type!');
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
        // Define which fields are required based on the recommendation type
        $isAvoid = $request->recommendation_type === 'Avoid';

        $rules = [
            'name' => 'required|string|max:255',
            'type' => 'required',
            'disease_category' => 'required',
            'recommendation_type' => 'required',
            'image' => 'required|image|max:2048',
            'research_title' => 'required|string',
            'research_source' => 'required|string',
            'research_url' => 'required|url',
            'research_summary' => 'required|string',
        ];

        // 🔥 FIX: Only require autoimmune_notes and nutrition if NOT 'Avoid'
        if (!$isAvoid) {
            $rules['autoimmune_notes'] = 'required|string';
            $rules['calories'] = 'required';
            $rules['protein'] = 'required';
        } else {
            // If it's 'Avoid', these are now optional
            $rules['autoimmune_notes'] = 'nullable|string';
            $rules['calories'] = 'nullable';
            $rules['protein'] = 'nullable';
        }

        $request->validate($rules);

        // ... Handle Image Upload ...
        $imagePath = $request->file('image')->store('foods', 'public');

        // Prepare Nutrition Data
        $nutritionData = [
            'calories' => $isAvoid ? 'N/A' : ($request->calories ?? '0'),
            'protein' => $isAvoid ? 'N/A' : ($request->protein ?? '0'),
            'carbs' => $isAvoid ? 'N/A' : ($request->carbs ?? '0'),
            'fat' => $isAvoid ? 'N/A' : ($request->fat ?? '0'),
            'fiber' => $isAvoid ? 'N/A' : ($request->fiber ?? '0'),
        ];

        FoodSubmission::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'type' => $request->type,
            'data' => [
                'image' => $imagePath,
                'disease_category' => $request->disease_category,
                'recommendation_type' => $request->recommendation_type,
                'ingredients' => $request->ingredients
                    ? array_map('trim', explode(',', $request->ingredients))
                    : [],
                'nutrition' => $nutritionData,
                'description' => $request->description,
                'autoimmune_notes' => $isAvoid
                    ? ($request->autoimmune_notes ?? 'This food should be strictly avoided for this condition.')
                    : $request->autoimmune_notes,
                'research' => [
                    'title' => $request->research_title,
                    'source' => $request->research_source,
                    'url' => $request->research_url,
                    'summary' => $request->research_summary,
                ],
                'rating' => '0.0',
                'like' => 0,
                'saved' => 0,
            ],
            'status' => 'pending',
        ]);

        return redirect()->route('food.upload')->with('success', 'Food submitted successfully!');
    }
}
