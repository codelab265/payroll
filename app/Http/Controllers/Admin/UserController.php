<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Reply;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::where('is_admin', true)->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '';
                    $btn .= '<div class="btn-group">';
                    $btn .= '<a href="javascript:void(0)" class="btn btn-primary btn-sm editButton" data-id="' . $row->id . '">Edit</a>';
                    $btn .= '<a href="javascript:void(0)" class="btn btn-danger btn-sm deleteButton" data-id="' . $row->id . '">Delete</a>';
                    $btn .= '</div>';
                    return $btn;
                })->editColumn('is_active', function ($row) {
                    if ($row->is_active) {
                        $status = '<span class="badge rounded-pill bg-success">Active</span>';
                    } else {
                        $status = '<span class="badge rounded-pill bg-danger">Deactivated</span>';
                    }
                    return $status;
                })
                ->rawColumns(['action', 'is_active'])
                ->make(true);
        }
        return view('admin.users.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'phone_number' => 'required|min:10|max:10'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone_number' => $request->phone_number,
            'is_admin' => true,
        ]);

        return Reply::success('Added successfully');
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request)
    {

        $data = $request->only('name', 'email', 'phone_number', 'is_active');
        if ($request->password != "") {
            $data['password'] = Hash::make($request->password);
        }
        if (!isset($request->is_active)) {
            $data['is_active'] = false;
        } else {
            $data['is_active'] = true;
        };

        User::find($request->id)->update($data);
        return Reply::success('Updated successfully');
    }

    public function delete(Request $request)
    {
        User::destroy($request->id);
        return Reply::success('Deleted successfully');
    }
}