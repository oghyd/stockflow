<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;

class ActivityLogController extends Controller
{
    public function index()
    {
        $logs = ActivityLog::with('user')
            ->latest() //most recent (self explanatory)
            ->paginate(15); //top 15

        return view('admin.activity.index', compact('logs'));
    }
}