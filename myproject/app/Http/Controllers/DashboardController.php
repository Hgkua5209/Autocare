<?php

namespace App\Http\Controllers;

use App\Models\MedicalSurvey;
use App\Services\MedicalAnalytics;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // SMART DASHBOARD - PUT THIS METHOD FIRST
    public function smartDashboard()
    {
        // Get the latest survey
        $survey = MedicalSurvey::latest()->first();
        
        if (!$survey) {
            // No survey exists - show welcome page
            return view('dashboard-welcome');
        }
        
        // Survey exists - show analytics dashboard
        $analytics = new MedicalAnalytics($survey);
        
        return view('dashboard', [
            'survey' => $survey,
            'analytics' => $analytics,
            'reportData' => [
                'autoimmuneMatches' => $analytics->getAutoimmuneMatches(),
                'symptomSeverity' => $analytics->getSymptomSeverity(),
                'healthScores' => $analytics->getHealthScores(),
                'triggers' => $analytics->getTriggers(),
            ]
        ]);
    }
    
    // Show specific survey dashboard (keep existing)
    public function show($id)
    {
        $survey = MedicalSurvey::findOrFail($id);
        $analytics = new MedicalAnalytics($survey);
        
        return view('dashboard', [
            'survey' => $survey,
            'analytics' => $analytics,
            'reportData' => [
                'autoimmuneMatches' => $analytics->getAutoimmuneMatches(),
                'symptomSeverity' => $analytics->getSymptomSeverity(),
                'healthScores' => $analytics->getHealthScores(),
                'triggers' => $analytics->getTriggers(),
            ]
        ]);
    }
    
    // Optional: Show dashboard for the latest survey (you can remove this if using smartDashboard)
    public function showLatest()
    {
        $survey = MedicalSurvey::latest()->first();
        
        if (!$survey) {
            return redirect()->route('checksurvey')->with('error', 'Please complete a survey first.');
        }
        
        $analytics = new MedicalAnalytics($survey);
        
        return view('dashboard', [
            'survey' => $survey,
            'analytics' => $analytics,
            'reportData' => [
                'autoimmuneMatches' => $analytics->getAutoimmuneMatches(),
                'symptomSeverity' => $analytics->getSymptomSeverity(),
                'healthScores' => $analytics->getHealthScores(),
                'triggers' => $analytics->getTriggers(),
            ]
        ]);
    }
}