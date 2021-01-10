<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    public function AttendanceChart(Request $request)
    {
        
        $current_month_attendance = Attendance::whereYear('attendance_date', Carbon::now()->year)->whereMonth('attendance_date', Carbon::now()->month)->count();

        $last_month_attendance = Attendance::whereYear('attendance_date', Carbon::now()->year)->whereMonth('attendance_date', Carbon::now()->subMonth(1))->count();
        
        $month_before_last_attendance = Attendance::whereYear('attendance_date', Carbon::now()->year)->whereMonth('attendance_date', Carbon::now()->subMonth(2))->count();

        // dd($last_month_attendance);
        return view('teacher_dashboard', compact('current_month_attendance','last_month_attendance','month_before_last_attendance'));
    }
}
