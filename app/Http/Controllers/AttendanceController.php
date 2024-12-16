<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user()->role;
        $attendance = [];
        if ($user == 'admin') {
            $attendance = Attendance::all();
            return view('absen', compact('attendance'));
        }
        $attendance = Attendance::where('user_id', Auth::user()->id)->get();
        return view('absen', compact('attendance'));
    }

    public function store(Request $request)
    {
        $attendance = new Attendance;
        $attendance->user_id = Auth::user()->id;
        $attendance->check_in = $request->check_in;
        $attendance->check_out = $request->check_out;
        $attendance->save();
        return redirect()->route('absen.index');
    }

    public function create()
    {
        return view('create_absen');
    }
}
