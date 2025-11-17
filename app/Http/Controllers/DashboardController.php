<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumni;

class DashboardController extends Controller
{
    public function index()
    {
        $totalAlumni = Alumni::count();
        $workingAlumni = Alumni::where('status', 'Bekerja')->count();
        $furtherStudies = Alumni::where('status', 'Studi Lanjut')->count();
        $unemployed = Alumni::where('status', 'Belum Bekerja')->count();

        return view('dashboard', compact('totalAlumni', 'workingAlumni', 'furtherStudies', 'unemployed'));
    }

    public function markNotificationsRead(Request $request)
    {
        session(['notifications_read_at' => now()]);
        return response()->json(['status' => 'success']);
    }
}
