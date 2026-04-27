<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    // Food Hub main page
    public function index(Request $request)
    {
        // 1. Get the category from the URL (e.g., food-hub?category=Lupus)
        // Default to 'All' if no category is selected
        $category = $request->query('category', 'All');

        $query = \App\Models\Food::query();

        // 2. Filter Logic
        if ($category === 'All') {
            // Show everything
            $foods = $query->get();
        } elseif ($category === 'General') {
            // Show only General Benefits
            $foods = $query->where('disease_category', 'General')
                        ->where('recommendation_type', 'Benefit')
                        ->get();
        } else {
            // Show specific disease (Both Benefit and Avoid)
            $foods = $query->where('disease_category', $category)->get();
        }

        return view('food-hub', [
            'foods' => $foods,
            'selectedCategory' => $category,
            // 🔥 Updated: Filter out 'Avoid' items from being selected as Meal of the Day
            'mealOfDay' => Food::where('recommendation_type', '!=', 'Avoid')
                            ->inRandomOrder()
                            ->first()
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

    public function like($id)
    {
        $food = Food::findOrFail($id);
        $data = $food->data;
        $data['like'] = ($data['like'] ?? 0) + 1;

        $food->update(['data' => $data]);

        // Return JSON so the page doesn't reload
        return response()->json([
            'success' => true,
            'new_count' => $data['like']
        ]);
    }

    public function save($id)
    {
        $food = Food::findOrFail($id);
        $data = $food->data;
        $data['saved'] = ($data['saved'] ?? 0) + 1;

        $food->update(['data' => $data]);

        return response()->json([
            'success' => true,
            'new_count' => $data['saved']
        ]);
    }


}
