<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function manageUsers()
    {
        $users = User::all();
        return view('admin.users', ['users' => $users]);
    }

    public function deleteUser($id)
    {
        User::where('id', $id)->delete();
        return back()->with(['status' => 'deleted user account successfully!']);
    }

    public function changeRole($id, $role)
    {
        $user = User::where('id', $id)->first();
        User::where('id', $id)->update(['role' => $role]);
        return back()->with(['status' => 'successfully, changed ' . $user->name . ' role to ' . $role]);
    }

    public function changeStatus($id, $status)
    {
        $user = User::where('id', $id)->first();
        User::where('id', $id)->update(['account_status' => $status]);
        return back()->with(['status' => 'successfully, changed ' . $user->name . "'s account to " . $status]);
    }
}
