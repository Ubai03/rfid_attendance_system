<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;

class AttendanceController extends Controller
{
    public function index()
    {
        $attendance = Attendance::with('student')->get();

        return view('attendance', compact('attendance'));
    }
}
