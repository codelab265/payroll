<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Reply;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\EmployeeDetail;
use App\Models\Schedule;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('month') && $request->month != "") {

            $current_month = $request->month;
        } else {
            $current_month = date('m');
        }

        if ($request->has('year') && $request->year != "") {

            $current_year = $request->year;
        } else {
            $current_year = date('Y');
        }

        $employees = User::where('is_admin', false)->where('is_active', true)->with('attendance', function ($query) use ($current_year) {
            $query->whereYear('attendance_date', $current_year);
        })->get();
        if ($request->ajax()) {
            # code...

            $daysInMonth = Carbon::now()->month($current_month)->daysInMonth;
            $view = view('admin.attendance.data', compact('daysInMonth', 'employees', 'current_year', 'current_month'))->render();
            return Reply::dataOnly(['status' => 'success', 'data' => $view]);
        }

        return view('admin.attendance.index', compact(
            'employees',
            'current_month',
            'current_year'
        ));
    }

    public function create()
    {
        $employees = User::where('is_admin', false)->where('is_active', true)->get();

        return view('admin.attendance.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'attendance_date' => 'required',
            'time_in' => 'required',
            'time_out' => 'required',
            'user_id.*' => 'required',
        ]);

        $clockIn = new Carbon($request->attendance_date . ' ' . $request->time_in);
        $clockOut = new Carbon($request->attendance_date . ' ' . $request->time_out);

        $attendance_hours = $clockIn->diffInHours($clockOut);

        for ($i = 0; $i < count($request->user_id); $i++) {
            $overtime = 0;
            $attendance = Attendance::where('user_id', $request->user_id[$i])->whereDate('attendance_date', $request->attendance_date)->first();

            $employee_detail = EmployeeDetail::where('user_id', $request->user_id[$i])->first();

            $schedule = Schedule::find($employee_detail->schedule->id);
            $scheduleClockIn = new Carbon($request->attendance_date . ' ' . $schedule->time_in);
            $scheduleClockOut = new Carbon($request->attendance_date . ' ' . $schedule->time_out);
            $schedule_hours = $scheduleClockIn->diffInHours($scheduleClockOut);

            if ($attendance_hours > $schedule_hours) {
                $overtime = $attendance_hours - $schedule_hours;
            }

            if ($attendance) {
                $attendance->update([
                    'time_in' => $request->time_in,
                    'time_out' => $request->time_out,
                    'over_time' => $overtime,
                    'number_of_hours' => $attendance_hours
                ]);
            } else {
                Attendance::create([
                    'user_id' => $request->user_id[$i],
                    'attendance_date' => $request->attendance_date,
                    'time_in' => $request->time_in,
                    'time_out' => $request->time_out,
                    'over_time' => $overtime,
                    'number_of_hours' => $attendance_hours,
                ]);
            }
            # code...
        }

        return Reply::redirect(route('admin.attendance.create'), 'Added successfully');
    }
}