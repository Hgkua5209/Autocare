<?php
//test
namespace App\Http\Controllers;

use App\Models\MedicalSurvey;  // ✅ Correct model name
use Illuminate\Http\Request;
use App\Services\MedicalAnalytics;

class MedicalSurveyController extends Controller  // ✅ Correct class name
{
    public function showSurvey()
    {
    $latestSurvey = MedicalSurvey::latest()->first();

    // Debug: Show what we're getting
    \Log::info('Latest Survey:', [$latestSurvey]);
    // OR dump it to see in browser (temporary):
    // dd($latestSurvey);

    return view('checksurvey', compact('latestSurvey'));
    }
public function store(Request $request)
{
    try {
        // Validation rules
        $validated = $request->validate([
            // Personal Information
            'patient_name' => 'required|string|max:255',
            'age' => 'required|integer|min:1|max:120',
            'gender' => 'required|string|in:Male,Female,Other',
            'height_cm' => 'required|integer|min:50|max:250',
            'weight_kg' => 'required|numeric|min:20|max:300',

            // Symptoms
            'main_symptoms' => 'required|array|min:1',
            'main_symptoms.*' => 'string|max:100',
            'symptom_duration' => 'required|string|max:100',
            'pain_level' => 'required|integer|min:1|max:10',
            'fatigue_level' => 'required|integer|min:1|max:10',
            'impact_on_daily_life' => 'required|integer|min:1|max:10',

            // Lifestyle & Diet
            'diet_description' => 'required|string|min:5|max:5000',
            'sleep_quality' => 'required|integer|min:1|max:10',
            'sleep_duration' => 'required|string|max:50',
            'stress_level' => 'required|integer|min:1|max:10',
            'water_consumption' => 'required|integer|min:1|max:15',

            // Habits
            'smoking_status' => 'required|string|in:Non-smoker,Occasional,Regular,Former smoker',
            'alcohol_consumption' => 'required|string|in:Non-drinker,Occasionally,Moderately,Heavily',
            'physical_activity_level' => 'required|string|in:Sedentary,Light,Moderate,Active,Athlete',

            // Medical History
            'existing_diagnosis' => 'nullable|string|max:500',
            'medications' => 'nullable|string|max:1000',
            'family_history' => 'nullable|string|max:1000',
            'diagnosis_details' => 'nullable|string|max:2000',
        ]);

        // Calculate BMI
        $height_m = $validated['height_cm'] / 100;
        $validated['bmi'] = $validated['weight_kg'] / ($height_m * $height_m);

        // Convert arrays to JSON
        if (isset($validated['main_symptoms'])) {
            $validated['main_symptoms'] = json_encode($validated['main_symptoms']);
        }

        // Save to database
        MedicalSurvey::create($validated);

        // Redirect to report page
        return redirect()->route('medical.report')
            ->with('success', 'Survey submitted successfully! Your analysis report is ready.');

    } catch (\Exception $e) {
        return redirect()->back()
            ->with('error', 'Error: ' . $e->getMessage())
            ->withInput();
    }
}

public function showReport()
{
    $latestSurvey = MedicalSurvey::latest()->first();

    if (!$latestSurvey) {
        return redirect()->route('medical.survey')
            ->with('error', 'No survey data found. Please complete the survey first.');
    }

    // Use our analytics service
    $analytics = new MedicalAnalytics($latestSurvey);

    // Create reportData array (what your view expects)
    $reportData = [
        'autoimmuneMatches' => $analytics->getAutoimmuneMatches(),
        'symptomSeverity' => $analytics->getSymptomSeverity(),
        'healthScores' => $analytics->getHealthScores(),
        'triggers' => $analytics->getTriggers(),
        'symptoms' => $latestSurvey->main_symptoms ? json_decode($latestSurvey->main_symptoms, true) : [],
        'recommendations' => $analytics->getRecommendations(),
    ];

    return view('trackreport', [
        'survey' => $latestSurvey,
        'reportData' => $reportData,  // Now it matches your view
        'analytics' => $analytics,    // Optional: keep if you want
    ]);
}

private function generateReportData($survey)
{
    // Decode symptoms if stored as JSON
    $symptoms = is_string($survey->main_symptoms)
        ? json_decode($survey->main_symptoms, true)
        : $survey->main_symptoms;

    // Calculate autoimmune match percentages (example logic)
    $autoimmuneMatches = [
        'Rheumatoid Arthritis (RA)' => $this->calculateRAMatch($survey),
        'Lupus (SLE)' => $this->calculateLupusMatch($survey),
        'Psoriasis Arthritis' => $this->calculatePsoriasisMatch($survey),
    ];

    // Prepare symptom severity data
    $symptomSeverity = [
        'Fatigue' => $survey->fatigue_level,
        'Joint Pain' => $survey->pain_level,
        'Brain Fog' => $this->calculateBrainFogScore($survey),
        'Skin Issues' => $this->calculateSkinScore($survey),
    ];

    // Health scores (1-10 scale)
    $healthScores = [
        'Sleep Quality' => $survey->sleep_quality,
        'Stress Level' => $survey->stress_level,
        'Physical Activity' => $this->mapActivityToScore($survey->physical_activity_level),
        'Diet Quality' => $this->calculateDietScore($survey->diet_description),
    ];

    // Potential triggers
    $triggers = [
        'Stress' => $survey->stress_level,
        'Sleep Quality' => $survey->sleep_quality,
        'Diet' => $this->calculateDietQuality($survey->diet_description),
        'Activity Level' => $this->mapActivityToScore($survey->physical_activity_level),
    ];

    return [
        'autoimmuneMatches' => $autoimmuneMatches,
        'symptomSeverity' => $symptomSeverity,
        'healthScores' => $healthScores,
        'triggers' => $triggers,
        'symptoms' => $symptoms ?: [],
        'recommendations' => $this->generateRecommendations($survey),
    ];
}

// Helper calculation methods (add these to the same controller)
private function calculateRAMatch($survey)
{
    // Example scoring logic
    $score = 0;
    $score += $survey->pain_level * 8;
    $score += $survey->fatigue_level * 6;
    $score += (10 - $survey->sleep_quality) * 4;
    $score += $survey->stress_level * 3;

    return min(95, max(50, $score / 2.5));
}

private function calculateLupusMatch($survey)
{
    $score = 0;
    $score += $survey->fatigue_level * 9;
    $score += $survey->stress_level * 7;
    $score += (10 - $survey->sleep_quality) * 5;

    return min(90, max(40, $score / 2.8));
}

private function calculatePsoriasisMatch($survey)
{
    $score = 0;
    $score += $survey->stress_level * 10;
    $score += $survey->pain_level * 6;

    return min(85, max(35, $score / 2.2));
}

private function calculateBrainFogScore($survey)
{
    return (int)(($survey->fatigue_level + $survey->stress_level + (10 - $survey->sleep_quality)) / 3);
}

private function calculateSkinScore($survey)
{
    return (int)(($survey->stress_level + (10 - $survey->sleep_quality)) / 2);
}

private function mapActivityToScore($activityLevel)
{
    $map = [
        'Sedentary' => 2,
        'Light' => 4,
        'Moderate' => 6,
        'Active' => 8,
        'Athlete' => 10,
    ];

    return $map[$activityLevel] ?? 5;
}

private function calculateDietScore($description)
{
    $keywords = ['healthy', 'vegetables', 'fruits', 'balanced', 'nutritious', 'organic'];
    $score = 5; // Default

    foreach ($keywords as $keyword) {
        if (stripos($description, $keyword) !== false) {
            $score += 1;
        }
    }

    return min(10, $score);
}

private function calculateDietQuality($description)
{
    $length = strlen($description);
    if ($length < 50) return 3;
    if ($length < 100) return 5;
    if ($length < 200) return 7;
    return 9;
}

private function generateRecommendations($survey)
{
    $recommendations = [];

    if ($survey->sleep_quality < 5) {
        $recommendations[] = 'Improve sleep hygiene: Aim for 7-9 hours, maintain consistent schedule';
    }

    if ($survey->stress_level > 7) {
        $recommendations[] = 'Practice stress management: Meditation, yoga, or deep breathing exercises';
    }

    if ($survey->water_consumption < 5) {
        $recommendations[] = 'Increase water intake: Aim for 8 glasses (2L) per day';
    }

    if ($survey->physical_activity_level === 'Sedentary') {
        $recommendations[] = 'Increase physical activity: Start with 30-minute walks 3x/week';
    }

    if ($survey->smoking_status === 'Regular') {
        $recommendations[] = 'Consider smoking cessation program';
    }

    return $recommendations;
}
}
