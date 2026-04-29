<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Progress;
use App\Models\DailyLog;
use Carbon\Carbon;

class ProgressController extends Controller
{
public function index()
{
    $activeProgress = Progress::where('user_id', auth()->id())
        ->where('is_active', true)
        ->first();

    $progressList = Progress::where('user_id', auth()->id())
        ->orderBy('created_at', 'desc')
        ->get();

    // ❗ KALAU TAKDE ACTIVE → RETURN TERUS
    if (!$activeProgress) {
        return view('daily', [
            'activeProgress' => null,
            'progressList' => $progressList,
            'days' => [],
            'streak' => 0
        ]);
    }

    $logs = DailyLog::where('user_id', auth()->id())
        ->where('progress_id', $activeProgress->id)
        ->get();

    $streak = $logs->count();

    $days = [];
    for ($i = 1; $i <= 7; $i++) {
        if ($i <= $streak) {
            $days[$i] = 'done';
        } elseif ($i == $streak + 1) {
            $days[$i] = 'today';
        } else {
            $days[$i] = 'pending';
        }
    }

    return view('daily', compact('activeProgress', 'progressList', 'days', 'streak'));
}

public function store(Request $request)
{
    // 🔥 TAMBAH INI (RESET SEMUA PROGRESS LAMA)
    Progress::where('user_id', auth()->id())
        ->update(['is_active' => false]);

    // 🔥 CREATE PROGRESS BARU
    Progress::create([
        'user_id' => auth()->id(),
        'title' => $request->title,
        'is_active' => true
    ]);

return redirect('/daily')->with('success', 'created');
}

public function end()
{
    Progress::where('user_id', auth()->id())
        ->where('is_active', true)
        ->update(['is_active' => false]);

    return redirect('/daily'); // 🔥 wajib redirect
}

public function destroy($id)
{
    $progress = Progress::where('user_id', auth()->id())
        ->where('id', $id)
        ->first();

    if ($progress) {
        $progress->delete();
    }

return redirect('/daily?tab=recordTab');
}
}