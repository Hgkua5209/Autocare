<?php
namespace App\Services;

use App\Models\MedicalSurvey;

class MedicalAnalytics
{
    protected $survey;

    public function __construct(MedicalSurvey $survey)
    {
        $this->survey = $survey;
    }

    // Helper method to ensure we always have an array
    private function ensureArray($data)
    {
        if (is_array($data)) {
            return $data;
        }
        
        if (is_string($data)) {
            // Try JSON decode first
            $decoded = json_decode($data, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                return $decoded;
            }
            
            // If not JSON, try comma-separated
            return explode(',', $data);
        }
        
        // If null or other type, return empty array
        return [];
    }

    public function getAutoimmuneMatches()
    {
        $matches = [
            'Rheumatoid Arthritis (RA)' => $this->calculateRAMatch(),
            'Lupus (SLE)' => $this->calculateLupusMatch(),
            'Psoriatic Arthritis' => $this->calculatePsoriaticMatch(),
            'Ankylosing Spondylitis' => $this->calculateASMatch(),
            'Sjögren\'s Syndrome' => $this->calculateSjogrenMatch(),
            'Inflammatory Bowel Disease' => $this->calculateIBDMatch(),
            'Celiac Disease' => $this->calculateCeliacMatch(),
        ];

    $customOrder = [
        'Lupus (SLE)',
        'Rheumatoid Arthritis (RA)',
        'Sjögren\'s Syndrome',  // Moved up
        'Celiac Disease',
        'Ankylosing Spondylitis',  // Moved down
        'Inflammatory Bowel Disease',
        'Psoriatic Arthritis'
    ];
    
    $sortedMatches = [];
    foreach ($customOrder as $condition) {
        if (isset($matches[$condition])) {
            $sortedMatches[$condition] = $matches[$condition];
        }
    }
    
    // Add any remaining conditions that weren't in custom order
    foreach ($matches as $condition => $score) {
        if (!isset($sortedMatches[$condition])) {
            $sortedMatches[$condition] = $score;
        }
    }
    
    return $sortedMatches;
    }

    private function calculateRAMatch()
    {
        $score = 0;
        
        // Morning stiffness scoring
        if ($this->survey->morning_stiffness == '1_2h' || $this->survey->morning_stiffness == 'more_2h') {
            $score += 30;
        } elseif ($this->survey->morning_stiffness == '30min_1h') {
            $score += 20;
        }
        
        $score += $this->survey->pain_level * 2;
        $score += $this->survey->fatigue_level * 1.5;
        
        // Check if joint pain is in symptoms
        $symptoms = $this->ensureArray($this->survey->main_symptoms);
        if (in_array('Joint Pain', $symptoms)) {
            $score += 15;
        }
        
        return min(95, $score);
    }

    private function calculateLupusMatch()
    {
        $score = 0;
        
        // Skin symptoms for Lupus
        $skinSymptoms = $this->ensureArray($this->survey->skin_symptoms);
        
        if (in_array('butterfly_rash', $skinSymptoms)) {
            $score += 40;
        }
        
        if (in_array('sun_sensitivity', $skinSymptoms)) {
            $score += 25;
        }
        
        if (in_array('mouth_ulcers', $skinSymptoms)) {
            $score += 20;
        }
        
        // Existing calculations
        $mainSymptoms = $this->ensureArray($this->survey->main_symptoms);
        
        if (in_array('Fever', $mainSymptoms)) {
            $score += 15;
        }
        
        if (in_array('Hair Loss', $mainSymptoms)) {
            $score += 15;
        }
        
        if (in_array('Joint Pain', $mainSymptoms)) {
            $score += 10;
        }
        
        $score += $this->survey->fatigue_level * 2;
        
        return min(95, $score);
    }

    private function calculatePsoriaticMatch()
    {
        $score = 0;
        
        // Skin symptoms for Psoriatic Arthritis
        $skinSymptoms = $this->ensureArray($this->survey->skin_symptoms);
        
        if (in_array('silvery_scales', $skinSymptoms)) {
            $score += 35;
        }
        
        // Triggers
        $triggers = $this->ensureArray($this->survey->triggers);
        if (in_array('stress', $triggers)) {
            $score += 15;
        }
        
        // Existing
        $mainSymptoms = $this->ensureArray($this->survey->main_symptoms);
        
        if (in_array('Joint Pain', $mainSymptoms)) {
            $score += 20;
        }
        
        if (in_array('Skin Rash', $mainSymptoms)) {
            $score += 15;
        }
        
        return min(95, $score);
    }

    private function calculateASMatch()
    {
        $score = 0;
        
        // Eye symptoms
        if ($this->survey->eye_symptoms == 'uveitis') {
            $score += 40;
        }
        
        // Morning stiffness
        if ($this->survey->morning_stiffness == '1_2h' || $this->survey->morning_stiffness == 'more_2h') {
            $score += 25;
        }
        
        // Existing
        $mainSymptoms = $this->ensureArray($this->survey->main_symptoms);
        if (in_array('Joint Pain', $mainSymptoms)) {
            $score += 15;
        }
        
        return min(95, $score);
    }

    private function calculateSjogrenMatch()
    {
        $score = 0;
        
        // Eye symptoms
        if ($this->survey->eye_symptoms == 'dry_eyes') {
            $score += 35;
        }
        
        // Existing
        $score += $this->survey->fatigue_level * 2;
        
        return min(95, $score);
    }

    private function calculateIBDMatch()
    {
        $score = 0;
        
        // Digestive pattern
        if ($this->survey->digestive_pattern == 'blood_stool') {
            $score += 40;
        }
        
        // Triggers
        $triggers = $this->ensureArray($this->survey->triggers);
        if (in_array('food', $triggers)) {
            $score += 20;
        }
        
        // Existing
        $mainSymptoms = $this->ensureArray($this->survey->main_symptoms);
        if (in_array('Digestive Issues', $mainSymptoms)) {
            $score += 25;
        }
        
        return min(95, $score);
    }

    private function calculateCeliacMatch()
    {
        $score = 0;
        
        // Digestive pattern
        if ($this->survey->digestive_pattern == 'worse_food') {
            $score += 35;
        }
        
        // Triggers
        $triggers = $this->ensureArray($this->survey->triggers);
        if (in_array('food', $triggers)) {
            $score += 25;
        }
        
        // Existing
        $mainSymptoms = $this->ensureArray($this->survey->main_symptoms);
        if (in_array('Digestive Issues', $mainSymptoms)) {
            $score += 20;
        }
        
        $score += $this->survey->fatigue_level * 1.5;
        
        return min(95, $score);
    }

    public function getSymptomSeverity()
    {
        return [
            'Joint Pain' => $this->survey->pain_level,
            'Fatigue' => $this->survey->fatigue_level,
            'Sleep Quality' => 10 - $this->survey->sleep_quality,
            'Stress' => $this->survey->stress_level,
            'Impact on Life' => $this->survey->impact_on_daily_life,
        ];
    }

    public function getHealthScores()
    {
        return [
            'Sleep' => $this->survey->sleep_quality,
            'Stress' => 10 - $this->survey->stress_level,
            'Physical Activity' => $this->mapActivityToScore($this->survey->physical_activity_level),
            'Diet Quality' => $this->calculateDietScore($this->survey->diet_description),
            'Hydration' => min(10, $this->survey->water_consumption * 2),
        ];
    }

    public function getTriggers()
    {
        $triggers = $this->ensureArray($this->survey->triggers);
        $triggerData = [];
        
        foreach ($triggers as $trigger) {
            switch ($trigger) {
                case 'stress':
                    $score = $this->survey->stress_level;
                    break;
                case 'food':
                    $score = 7;
                    break;
                case 'infection':
                    $score = 8;
                    break;
                case 'weather':
                    $score = 6;
                    break;
                case 'hormonal':
                    $score = $this->survey->gender == 'Female' ? 7 : 3;
                    break;
                default:
                    $score = 5;
            }
            
            $triggerData[ucfirst($trigger)] = $score;
        }
        
        return $triggerData;
    }

    public function getRecommendations()
    {
        $recommendations = [];
        
        // Morning stiffness recommendations
        if ($this->survey->morning_stiffness == '1_2h' || $this->survey->morning_stiffness == 'more_2h') {
            $recommendations[] = "Consider consulting a rheumatologist for evaluation of inflammatory arthritis.";
        }
        
        // Skin symptoms recommendations
        $skinSymptoms = $this->ensureArray($this->survey->skin_symptoms);
        if (in_array('butterfly_rash', $skinSymptoms)) {
            $recommendations[] = "Sun protection is crucial. Use SPF 50+ daily and avoid direct sun exposure.";
        }
        
        // Eye symptoms recommendations
        if ($this->survey->eye_symptoms == 'dry_eyes') {
            $recommendations[] = "Use preservative-free artificial tears 4-6 times daily for dry eyes.";
        }
        
        // Digestive pattern recommendations
        if ($this->survey->digestive_pattern == 'blood_stool') {
            $recommendations[] = "Schedule a gastroenterology consultation for possible inflammatory bowel disease.";
        }
        
        // Keep existing recommendations
        if ($this->survey->sleep_quality < 5) {
            $recommendations[] = 'Improve sleep hygiene: Maintain consistent sleep schedule.';
        }
        
        if ($this->survey->stress_level > 7) {
            $recommendations[] = 'Practice stress management: Try 10-minute daily meditation or yoga.';
        }
        
        if ($this->survey->water_consumption < 5) {
            $recommendations[] = 'Increase water intake: Aim for 8-10 glasses (2-2.5L) daily.';
        }
        
        if ($this->survey->physical_activity_level === 'Sedentary') {
            $recommendations[] = 'Start light exercise: 30-minute walks 3-4 times per week.';
        }
        
        return array_slice($recommendations, 0, 8);
    }

    public function getRiskLevel()
    {
        $riskScore = 0;
        
        // High morning stiffness = higher risk
        if ($this->survey->morning_stiffness == 'more_2h') $riskScore += 30;
        elseif ($this->survey->morning_stiffness == '1_2h') $riskScore += 20;
        
        // Specific symptoms increase risk
        $skinSymptoms = $this->ensureArray($this->survey->skin_symptoms);
        if (in_array('butterfly_rash', $skinSymptoms)) $riskScore += 25;
        if ($this->survey->digestive_pattern == 'blood_stool') $riskScore += 25;
        
        // High pain/fatigue
        $riskScore += $this->survey->pain_level * 2;
        $riskScore += $this->survey->fatigue_level * 1.5;
        
        // High impact on life
        $riskScore += $this->survey->impact_on_daily_life * 2;
        
        if ($riskScore > 70) return 'High';
        if ($riskScore > 40) return 'Medium';
        return 'Low';
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
        $positiveKeywords = ['vegetable', 'fruit', 'whole grain', 'lean protein', 'healthy', 'balanced', 'nutritious'];
        $negativeKeywords = ['fast food', 'processed', 'sugary', 'fried', 'junk food'];
        
        $score = 5;
        
        foreach ($positiveKeywords as $keyword) {
            if (stripos($description, $keyword) !== false) {
                $score += 1;
            }
        }
        
        foreach ($negativeKeywords as $keyword) {
            if (stripos($description, $keyword) !== false) {
                $score -= 1;
            }
        }
        
        return min(10, max(1, $score));
    }
}