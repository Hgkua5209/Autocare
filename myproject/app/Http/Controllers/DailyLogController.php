<?php

namespace App\Http\Controllers;

use App\Models\DailyLog;
use Illuminate\Http\Request;
use App\Models\Progress;
use Carbon\Carbon;

class DailyLogController extends Controller
{
public function create()
{
    $progress = Progress::where('user_id', auth()->id())
        ->where('is_active', true)
        ->first();

    $streak = 0;
    $days = [];

    if ($progress) {

        $logs = DailyLog::where('user_id', auth()->id())
            ->where('progress_id', $progress->id)
            ->get();

        $mode = 'dev';

        if ($mode === 'real') {
            $days = $this->generateDaysReal($logs);

            // real streak
            for ($i = 0; $i < 7; $i++) {
                $date = Carbon::today()->subDays($i);

                $found = $logs->first(function ($item) use ($date) {
                    return Carbon::parse($item->created_at)->isSameDay($date);
                });

                if ($found) {
                    $streak++;
                } else {
                    break;
                }
            }

        } else {
            $days = $this->generateDaysDev($logs);
            $streak = $logs->count(); // 🔥 dev mode
        }
    }

    return view('daily', compact('streak', 'days', 'progress'));
}

public function store(Request $request)
{

    $progress = Progress::where('user_id', auth()->id())
        ->where('is_active', true)
        ->first();

    if (!$progress) {
        return back()->with('error', 'No active progress!');
    }

    // ❌ BUANG DATE CHECK — kita tak pakai hari sebenar
    // ❌ BUANG duplicate create

    $validated = $request->validate([
    'pain_level' => 'required|integer|min:1|max:10',
    'fatigue_level' => 'required|integer|min:1|max:10',
    'stress_level' => 'required|integer|min:1|max:10',
    'sleep_hours' => 'required|integer',
    'water_intake' => 'required|integer',
    'overall_condition' => 'required|integer|min:1|max:10',
    'activity_level' => 'required|string',
    'took_medication' => 'required|in:0,1',

    // 🔥 TAMBAH NI (ikut style sama)
    'food_intake' => 'nullable|string',
    'triggers' => 'nullable|string',
        
    ]);

    $validated['user_id'] = auth()->id();
    $validated['progress_id'] = $progress->id;

    $validated['symptoms'] = $request->symptoms ?? [];
    $validated['progress_id'] = $progress->id;

    DailyLog::create($validated);

    return redirect('/daily');
}

private function generateInsights($logs)
{
    $insights = [];

    if ($logs->count() < 3) {
        return ["Not enough data for analysis yet"];
    }

    // ambil latest 7 hari
    $recent = $logs->take(7);

    // ======================
    // 1. AVERAGE CALCULATION
    // ======================
    $avgPain = $recent->avg('pain_level');
    $avgFatigue = $recent->avg('fatigue_level');
    $avgStress = $recent->avg('stress_level');
    $avgSleep = $recent->avg('sleep_hours');

    // ======================
    // 2. TREND DETECTION
    // ======================
    $latest = $recent->first();
    $previous = $recent->skip(1)->first();

    if ($latest && $previous) {
        if ($latest->pain_level < $previous->pain_level) {
            $insights[] = "Your pain is improving 👍";
        } else {
            $insights[] = "Your pain has increased ⚠️";
        }
    }

    // ======================
    // 3. TRIGGER DETECTION
    // ======================
    if ($avgSleep < 6 && $avgFatigue > 6) {
        $insights[] = "Low sleep may be causing high fatigue";
    }

    if ($avgStress > 7 && $avgPain > 6) {
        $insights[] = "High stress may be triggering pain flare";
    }

    // ======================
    // 4. MEDICATION EFFECT
    // ======================
    $withMed = $recent->where('took_medication', 1)->avg('pain_level');
    $withoutMed = $recent->where('took_medication', 0)->avg('pain_level');

    if ($withMed && $withoutMed && $withMed < $withoutMed) {
        $insights[] = "Medication appears to reduce your pain";
    }

    return $insights;
}

private function generateDaysReal($logs)
{
    $days = [];
    $today = Carbon::today();

    for ($i = 1; $i <= 7; $i++) {
        $date = $today->copy()->subDays(7 - $i);

        $log = $logs->first(function ($item) use ($date) {
            return Carbon::parse($item->created_at)->isSameDay($date);
        });

        if ($log) {
            $days[$i] = 'done';
        } elseif ($date->isToday()) {
            $days[$i] = 'today';
        } elseif ($date->lt($today)) {
            $days[$i] = 'missed';
        } else {
            $days[$i] = 'pending';
        }
    }

    return $days;
}

private function generateDaysDev($logs)
{
    $days = [];

    $currentDay = $logs->count() + 1;

    for ($i = 1; $i <= 7; $i++) {
        if ($i < $currentDay) {
            $days[$i] = 'done';
        } elseif ($i == $currentDay) {
            $days[$i] = 'today';
        } else {
            $days[$i] = 'pending';
        }
    }

    return $days;
}

}
