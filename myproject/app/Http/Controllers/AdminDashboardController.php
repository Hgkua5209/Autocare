<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Food;
use App\Models\FoodSubmission;

class AdminDashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'totalUsers' => User::count(),
            'totalFoods' => Food::count(),
            'pendingSubmissions' => FoodSubmission::where('status', 'pending')->count(),
            'approvedSubmissions' => FoodSubmission::where('status', 'approved')->count(),
            'rejectedSubmissions' => FoodSubmission::where('status', 'rejected')->count(),
        ]);
    }

}
