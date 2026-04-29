<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\DailyLog;
use App\Models\Progress;
use Carbon\Carbon;


class AnalyticsController extends Controller
{

public function show($id)
{
    $logs = DailyLog::where('progress_id', $id)
        ->orderBy('created_at')
        ->get();

    if ($logs->isEmpty()) {
        return view('analytics', [
            'noData' => true,
            'dates' => [],
            'pain' => [],
            'fatigue' => [],
            'stress' => [],
            'overall' => [],
            'avgPain' => 0,
            'avgStress' => 0,
            'avgSleep' => 0,
            'status' => 'No Data',
            'insights' => [],
            'recommendations' => [],
            'healthScore' => 0
        ]);
    }

    
    // ================= BASIC =================
    //real date
    //$dates = $logs->pluck('created_at')->map(fn($d) => $d->format('d M'));
    $dates = $logs->keys()->map(fn($i) => 'Day '.($i+1)); // dev mode
    $pain = $logs->pluck('pain_level');
    $fatigue = $logs->pluck('fatigue_level');
    $stress = $logs->pluck('stress_level');
    $overall = $logs->pluck('overall_condition');
    $sleep = $logs->pluck('sleep_hours');

    // ================= AVERAGE =================
    $avgPain = round($logs->avg('pain_level'), 1);
    $avgStress = round($logs->avg('stress_level'), 1);
    $avgSleep = round($logs->avg('sleep_hours'), 1);

    // ================= STATUS =================
    if ($avgPain >= 7) $status = "Critical";
    elseif ($avgPain >= 4) $status = "Moderate";
    else $status = "Stable";

    $firstPain = $pain->first();
    $lastPain = $pain->last();

    $trendScore = $lastPain - $firstPain;

    if ($trendScore <= -2) {
        $trend = "Strong Improvement";
    } elseif ($trendScore < 0) {
        $trend = "Improving";
    } elseif ($trendScore == 0) {
        $trend = "Stable";
    } elseif ($trendScore < 2) {
        $trend = "Worsening";
    } else {
        $trend = "Critical Worsening";
    }


    if ($avgSleep < 5 && $avgPain > 6) {
        $correlationInsight = "Low sleep is likely increasing pain level.";
    }

    $insights = [];

    if ($avgPain > 6) {
        $insights[] = "Pain level is high.";
    } elseif ($avgPain >= 4) {
        $insights[] = "Pain level is moderate.";
    }

    if ($avgStress > 6) {
        $insights[] = "Stress level is high.";
    } elseif ($avgStress >= 4) {
        $insights[] = "Stress level is moderate.";
    }

    if ($avgSleep < 5) {
        $insights[] = "Sleep is insufficient.";
    } elseif ($avgSleep < 6) {
        $insights[] = "Sleep could be improved.";
    }
    $trend = $lastPain > $firstPain ? "Worsening" : ($lastPain < $firstPain ? "Improving" : "Stable");
    $recommendations = [];

    $correlation = "No strong correlation";


if ($avgSleep < 5 && $avgPain > 6) {
    $correlation = "Low sleep may be increasing pain";
}


    if ($avgPain >= 4) {
        $recommendations[] = "Avoid excessive physical strain.";
    }

    if ($avgSleep < 6) {
        $recommendations[] = "Try to improve sleep quality.";
    }

    if ($avgStress >= 4) {
        $recommendations[] = "Manage stress with relaxation techniques.";
    }

    $healthScore = 100;

$healthScore -= $avgPain * 5;
$healthScore -= $avgStress * 3;
$healthScore -= (7 - $avgSleep) * 4;

//correlation 2
$sleepPainImpact = $logs->filter(function($log){
    return $log->sleep_hours < 5 && $log->pain_level > 6;
})->count();

if ($sleepPainImpact >= 3) {
    $correlation = "Strong link: Low sleep increases pain";
} elseif ($sleepPainImpact > 0) {
    $correlation = "Possible link between sleep and pain";
} else {
    $correlation = "No strong correlation";
}

//flare detection
$flareCount = 0;

for ($i = 1; $i < count($pain); $i++) {
    if ($pain[$i] - $pain[$i-1] >= 2) {
        $flareCount++;
    }
}

if ($flareCount >= 2) {
    $risk = "High Risk (Frequent flare detected)";
} elseif ($flareCount == 1) {
    $risk = "Medium Risk (Occasional flare)";
} else {
    $risk = "Low Risk";
}

//risk

$summaryText = "Overall: {$status}. ";

$summaryText .= "Trend shows {$trend}. ";

if ($risk === "High Risk") {
    $summaryText .= "Frequent flare-ups detected. Immediate attention recommended. ";
}

if ($avgSleep < 6) {
    $summaryText .= "Sleep is affecting recovery. ";
}

$healthScore = max(0, min(100, round($healthScore)));

$worstDay = $logs->sortByDesc('pain_level')->first();

if ($avgPain > 6 && $avgStress > 6) {
    $risk = "High Risk";
} elseif ($avgPain > 4) {
    $risk = "Medium Risk";
} else {
    $risk = "Low Risk";
}

//progress and date

$progress = Progress::find($id);

$title = $progress->title ?? "Health Progress";

$startDate = $progress->start_date ?? $logs->first()->created_at;
$endDate = $progress->end_date ?? $logs->last()->created_at;

$startDateFormatted = Carbon::parse($startDate)->format('d M Y');
$endDateFormatted = Carbon::parse($endDate)->format('d M Y');

//consistency

$variance = $pain->max() - $pain->min();

if ($variance <= 2) {
    $consistency = "Stable condition";
} elseif ($variance <= 4) {
    $consistency = "Moderate fluctuation";
} else {
    $consistency = "Highly unstable condition";
}

    return view('analytics', compact(
        'dates',
        'pain',
        'fatigue',
        'stress',
        'overall',
        'avgPain',
        'avgStress',
        'avgSleep',
        'status',
        'insights',
        'recommendations',
        'healthScore',
        'trend',
        'correlation',
        'summaryText',
        'worstDay',   // 🔥 WAJIB
        'risk',
        'consistency',
        'title',
        'startDateFormatted',
        'endDateFormatted'
    ));
}
}