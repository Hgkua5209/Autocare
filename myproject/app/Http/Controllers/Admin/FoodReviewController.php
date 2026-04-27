<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FoodSubmission;
use App\Models\Food;
use Illuminate\Http\Request;

class FoodReviewController extends Controller
{
    public function index()
    {
        $submissions = FoodSubmission::where('status', 'pending')->latest()->get();

        return view('admin.food-submissions.index', compact('submissions'));
    }

    public function show($id)
    {
        $submission = FoodSubmission::findOrFail($id);

        return view('admin.food-submissions.show', compact('submission'));
    }

    public function approve($id)
    {
        $submission = FoodSubmission::findOrFail($id);

        // 1. Get the JSON data from the submission
        $sData = $submission->data;

        // 2. Map the data to the foods table columns
        Food::create([
            'name' => $submission->name,

            // These map to the specific columns seen in your phpMyAdmin screenshot
            'disease_category' => $sData['disease_category'] ?? 'General',
            'recommendation_type' => $sData['recommendation_type'] ?? 'Benefit',

            // This keeps the rest of the "messy" details inside the JSON blob
            'data' => $sData,
        ]);

        // 3. Update status
        $submission->update(['status' => 'approved']);

        return redirect()->route('admin.food.review')->with('success', 'Food approved successfully.');
    }
    public function reject(Request $request, $id)
    {
        $request->validate([
            'rejection_reason' => 'required|min:10',
        ]);

        $submission = FoodSubmission::findOrFail($id);

        $submission->update([
            'status' => 'rejected',
            'rejection_reason' => $request->rejection_reason,
        ]);

        return redirect()
            ->route('admin.food.submissions')
            ->with('error', 'Food submission rejected with reason.');
    }
}
