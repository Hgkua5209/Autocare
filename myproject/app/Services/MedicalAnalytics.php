<?php
//test
namespace App\Services;

use App\Models\MedicalSurvey;
//test again
class MedicalAnalytics
{
    private $survey;

    public function __construct(MedicalSurvey $survey)
    {
        $this->survey = $survey;
    }

    // SIMPLE VERSION - Easy to understand
    public function getAutoimmuneMatches()
    {
        $matches = [];

        // 1. Rheumatoid Arthritis Score
        $raScore = ($this->survey->pain_level * 10) +
                   ($this->survey->fatigue_level * 5) +
                   (10 - $this->survey->sleep_quality) * 3;
        $matches['Rheumatoid Arthritis (RA)'] = min(95, $raScore / 2);

        // 2. Lupus Score
        $lupusScore = ($this->survey->fatigue_level * 15) +
                      ($this->survey->stress_level * 10);
        $matches['Lupus (SLE)'] = min(90, $lupusScore / 2.5);

        // 3. Psoriasis Score
        $psoriasisScore = ($this->survey->stress_level * 20) +
                          ($this->survey->pain_level * 5);
        $matches['Psoriatic Arthritis'] = min(85, $psoriasisScore / 2.5);

        return $matches;
    }

    public function getSymptomSeverity()
    {
        return [
            'Joint Pain' => $this->survey->pain_level,
            'Fatigue' => $this->survey->fatigue_level,
            'Daily Impact' => $this->survey->impact_on_daily_life,
            'Sleep Issues' => 10 - $this->survey->sleep_quality,
        ];
    }

    public function getHealthScores()
    {
        // Activity level score
        $activityScore = [
            'Sedentary' => 3,
            'Light' => 5,
            'Moderate' => 7,
            'Active' => 9,
            'Athlete' => 10,
        ];

        return [
            'Sleep Quality' => $this->survey->sleep_quality,
            'Stress Level' => 10 - $this->survey->stress_level, // Reverse: lower stress = higher score
            'Physical Activity' => $activityScore[$this->survey->physical_activity_level] ?? 5,
            'Diet Score' => $this->getDietScore(),
            'Water Intake' => $this->survey->water_consumption * 2,
        ];
    }

    public function getDietScore()
    {
        $diet = strtolower($this->survey->diet_description);
        $score = 5; // Start at 5/10

        // Good keywords add points
        $goodKeywords = ['vegetable', 'fruit', 'healthy', 'balanced', 'water', 'salad', 'lean'];
        foreach ($goodKeywords as $keyword) {
            if (strpos($diet, $keyword) !== false) {
                $score += 1;
            }
        }

        // Bad keywords subtract points
        $badKeywords = ['fast food', 'processed', 'sugar', 'soda', 'junk', 'fried'];
        foreach ($badKeywords as $keyword) {
            if (strpos($diet, $keyword) !== false) {
                $score -= 1;
            }
        }

        return min(10, max(1, $score));
    }

public function getTriggers()
{
    $triggers = [];

    // Just return scores, not arrays
    if ($this->survey->stress_level >= 7) {
        $triggers['Stress'] = $this->survey->stress_level;
    }

    if ($this->survey->sleep_quality <= 4) {
        $triggers['Poor Sleep'] = 10 - $this->survey->sleep_quality;
    }

    $dietScore = $this->getDietScore();
    if ($dietScore <= 4) {
        $triggers['Diet Quality'] = $dietScore;
    }

    if ($this->survey->physical_activity_level === 'Sedentary') {
        $triggers['Inactivity'] = 8; // High score for sedentary
    }

    return $triggers;
}

    public function getRecommendations()
    {
        $recommendations = [];

        // Based on pain
        if ($this->survey->pain_level >= 7) {
            $recommendations[] = 'Consider gentle exercises like swimming or yoga';
        }

        // Based on sleep
        if ($this->survey->sleep_quality <= 4) {
            $recommendations[] = 'Improve sleep: No screens 1 hour before bed';
        }

        // Based on stress
        if ($this->survey->stress_level >= 7) {
            $recommendations[] = 'Practice 10-minute daily meditation';
        }

        // Based on activity
        if ($this->survey->physical_activity_level === 'Sedentary') {
            $recommendations[] = 'Start with 10-minute daily walks';
        }

        // General recommendations
        $recommendations[] = 'Drink at least 8 glasses of water daily';
        $recommendations[] = 'Track symptoms for 2 weeks to identify patterns';

        return $recommendations;
    }

    public function getRiskLevel()
    {
        $score = $this->survey->pain_level +
                 $this->survey->fatigue_level +
                 $this->survey->impact_on_daily_life;

        if ($score >= 20) return 'High';
        if ($score >= 15) return 'Medium';
        return 'Low';
    }
}
