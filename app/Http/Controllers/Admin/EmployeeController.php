<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Reply;
use App\Models\Schedule;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Deduction;
use App\Models\EmployeeDeduction;
use App\Models\EmployeeDetail;
use App\Models\EmployeeTax;
use App\Models\Tax;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $employees = EmployeeDetail::all();
            return DataTables::of($employees)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '';
                    $btn .= '<div class="btn-group">';
                    $btn .= '<a href="javascript:void(0)" class="btn btn-success btn-sm editButton" data-id="' . $row->id . '">View</a>';
                    $btn .= '<a href="javascript:void(0)" class="btn btn-primary btn-sm editButton" data-id="' . $row->id . '">Edit</a>';
                    $btn .= '<a href="javascript:void(0)" class="btn btn-danger btn-sm deleteButton" data-id="' . $row->user_id . '">Delete</a>';
                    $btn .= '</div>';
                    return $btn;
                })->editColumn('user_id', function ($row) {
                    return $row->user->name;
                })
                ->addColumn('email', function ($row) {
                    return $row->user->email;
                })
                ->addColumn('phone_number', function ($row) {
                    return $row->user->phone_number;
                })
                ->editColumn('department_id', function ($row) {
                    return $row->department->name;
                })
                ->addColumn('status', function ($row) {
                    if ($row->user->is_active) {
                        $status = '<span class="badge rounded-pill bg-success">Active</span>';
                    } else {
                        $status = '<span class="badge rounded-pill bg-danger">Deactivated</span>';
                    }
                    return $status;
                })
                ->rawColumns(['user_id', 'department_id', 'status', 'action'])
                ->make(true);
        }

        $departments = Department::all();
        $schedules = Schedule::all();
        $taxes = Tax::all();
        $deductions = Deduction::all();


        return view('admin.employee.index', compact('departments', 'schedules', 'taxes', 'deductions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone_number' => 'required',
            'address' => 'required',
            'gender' => 'required',
            'department_id' => 'required',
            'schedule_id' => 'required',
            'hour_rate' => 'required',
            'password' => 'required'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        $user->password = Hash::make($request->password);
        $user->save();

        $user->employee_detail()->create([
            'address' => $request->address,
            'gender' => $request->gender,
            'dob' => $request->dob,
            'hour_rate' => $request->hour_rate,
            'department_id' => $request->department_id,
            'schedule_id' => $request->schedule_id
        ]);

        for ($i = 0; $i < count($request->deduction_id); $i++) {
            # code...
            EmployeeDeduction::create([
                'user_id' => $user->id,
                'deduction_id' => $request->deduction_id[$i]
            ]);
        }

        for ($i = 0; $i < count($request->tax_id); $i++) {
            # code...
            EmployeeTax::create([
                'user_id' => $user->id,
                'tax_id' => $request->tax_id[$i]
            ]);
        }

        return Reply::success('Added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee_deductions = [];
        $employee_detail = EmployeeDetail::find($id);
        $departments = Department::all();
        $schedules = Schedule::all();
        $taxes = Tax::all();
        $deductions = Deduction::all();

        foreach ($employee_detail->employee_deduction as $employee_deduction) {
            $employee_deductions[] = $employee_deduction->deduction_id;
        }


        return view('admin.employee.edit', compact('employee_detail', 'departments', 'schedules', 'taxes', 'deductions', 'employee_deductions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user_id = $request->id;
        $user = User::find($user_id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        if ($request->password != "") {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        $user->employee_detail->update([
            'address' => $request->address,
            'gender' => $request->gender,
            'dob' => $request->dob,
            'hour_rate' => $request->hour_rate,
            'department_id' => $request->department_id,
            'schedule_id' => $request->schedule_id
        ]);

        return Reply::success('Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        return Reply::success('Deleted successfully');
    }
}