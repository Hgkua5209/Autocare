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

        // Move approved data into foods table
        Food::create([
            'name' => $submission->name,
            'data' => $submission->data,
        ]);

        $submission->update([
            'status' => 'approved',
        ]);

        return redirect()->route('admin.food.review')
            ->with('success', 'Food approved and published.');
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
