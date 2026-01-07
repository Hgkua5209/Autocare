<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FoodSubmission;
use App\Models\User;

class FoodSubmissionSeeder extends Seeder
{
    public function run(): void
    {
        // Get the first user to assign the submission to
        $user = User::first();

        if ($user) {
            FoodSubmission::create([
                'user_id' => $user->id,
                'name' => 'Organic Spinach Salad',
                'type' => 'food',
                'status' => 'pending',
                'data' => [
                    'image' => 'food-submissions/sample.jpg',
                    'ingredients' => ['Spinach', 'Walnuts', 'Olive Oil'],
                    'nutrition' => [
                        'calories' => 150,
                        'protein' => 3,
                        'carbs' => 5,
                        'fat' => 12,
                        'fiber' => 2,
                    ],
                    'description' => 'A healthy autoimmune-friendly salad.',
                    'autoimmune_notes' => 'No nightshades included.',
                    'research' => [
                        'title' => 'Benefits of Spinach',
                        'source' => 'Nutrition Journal',
                        'url' => 'https://example.com',
                        'summary' => 'Spinach is high in vitamins and low in inflammatory markers.',
                    ],
                ],
            ]);
        }
    }
}
