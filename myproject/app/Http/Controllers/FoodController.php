<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Http\Request;
use App\Models\UserFoodInteraction;
use Illuminate\Support\Facades\DB;

class FoodController extends Controller
{
    // Food Hub main page
    public function index(Request $request)
    {
        // 1. Handle Categories
        $category = $request->query('category', 'All');
        $query = \App\Models\Food::query();

        if ($category === 'All') {
            $foods = $query->get();
        } elseif ($category === 'General') {
            $foods = $query->where('disease_category', 'General')
                        ->where('recommendation_type', 'Benefit')
                        ->get();
        } else {
            $foods = $query->where('disease_category', $category)->get();
        }

        // 2. FETCH INTERACTIONS (This is what fixes the highlight)
        $userId = auth()->id();
        $userInteractions = collect(); // Default empty if not logged in

        if ($userId) {
            $userInteractions = \App\Models\UserFoodInteraction::where('user_id', $userId)
                ->get()
                ->keyBy('food_id');
        }

        // 3. Meal of the Day
        $mealOfDay = Food::where('recommendation_type', '!=', 'Avoid')
                        ->inRandomOrder()
                        ->first();

        // 4. Return the View (Make sure the view name matches your file name)
        return view('food-hub', [
            'foods' => $foods,
            'selectedCategory' => $category,
            'mealOfDay' => $mealOfDay,
            'userInteractions' => $userInteractions // MUST BE PASSED HERE
        ]);
    }

    // Single food detail page
    public function show($id)
    {
        return view('food-show', [
            'food' => Food::findOrFail($id)
        ]);
    }

    // Update these methods in FoodController.php

    public function toggleLike($id)
    {
        $userId = auth()->id();

        // 1. Find or create the interaction
        $interaction = \App\Models\UserFoodInteraction::firstOrNew([
            'user_id' => $userId,
            'food_id' => $id
        ]);

        // 2. Toggle the like status
        $interaction->is_liked = !$interaction->is_liked;
        $interaction->save();

        // 3. Count ALL likes for this specific food to send back to the UI
        $totalLikes = \App\Models\UserFoodInteraction::where('food_id', $id)
            ->where('is_liked', true)
            ->count();

        // 4. Return success and the NEW count
        return response()->json([
            'success' => true,
            'count' => $totalLikes,
            'status' => $interaction->is_liked
        ]);
    }

    public function toggleSave($id)
    {
        try {
            $userId = auth()->id();

            // Find the interaction or create a new one
            $interaction = UserFoodInteraction::firstOrNew([
                'user_id' => $userId,
                'food_id' => $id
            ]);

            // Toggle the boolean
            $interaction->is_saved = !$interaction->is_saved;
            $interaction->save();

            return response()->json([
                'success' => true,
                'status' => $interaction->is_saved
            ]);
        } catch (\Exception $e) {
            // This will tell you the exact error in your Laravel logs
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


}
