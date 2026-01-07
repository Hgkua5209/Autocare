<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Food;

class FoodSeeder extends Seeder
{
    public function run(): void
    {
        Food::create([
            'name' => 'Apricot Pancake',
            'data' => [
                'image' => 'images/foods/apricot-pancake.jpg',
                'rating' => 4,
                'like' => 120,
                'saved' => 56,
                'ingredient' => [
                    'Apricot',
                    'Egg',
                    'Milk'
                ],
                'description' => 'Autoimmune friendly pancake',
                'nutrition' => [
                    'calories' => '320 kcal',
                    'protein' => '12 g',
                    'carbs' => '40 g',
                    'fat' => '10 g',
                ]
            ]
        ]);

        Food::create([
            'name' => 'Egg Dim Sum',
            'data' => [
                'image' => 'images/foods/Egg-Dim-Sum.jpg',
                'rating' => 4.5,
                'like' => 98,
                'saved' => 40,
                'ingredient' => [
                    'Egg',
                    'Rice Flour',
                    'Vegetables'
                ],
                'description' => 'Light and gut-friendly dim sum',
                'nutrition' => [
                    'calories' => '180 kcal',
                    'protein'  => '9 g',
                    'carbs'    => '22 g',
                    'fat'      => '6 g',
                ]
            ]
        ]);
    }
}
