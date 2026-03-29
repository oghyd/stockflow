<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalAdmins = User::role('admin')->count();
        $totalVendeurs = User::role('vendeur')->count();
        $totalFournisseurs = User::role('fournisseur')->count();

        $recentActivities = ActivityLog::with('user')
            ->latest()
            ->take(8)
            ->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalAdmins',
            'totalVendeurs',
            'totalFournisseurs',
            'recentActivities'
        ));
    }
}