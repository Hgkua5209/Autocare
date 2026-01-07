<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    // Food Hub main page
    public function index()
    {
        return view('food-hub', [
            'foods' => Food::all(),
            'mealOfDay' => Food::inRandomOrder()->first()
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
