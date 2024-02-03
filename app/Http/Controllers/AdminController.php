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

    public function searchUsers(Request $req)
    {
        if($req->ajax()){
            $users = User::where('name', 'like', '%' . $req->search . '%')
            ->orwhere('email', 'like', '%' . $req->search . '%')
            ->orwhere('role', 'like', '%' . $req->search . '%')->get();
        };

        $response = '';
        if (count($users)>0) {
            $response = '
            <div id="userList" class=" text-center" style="overflow-x: auto;">
            <table class="table table-striped table-hover rounded">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Control</th>
                    </tr>
                </thead>
                <tbody>';

                foreach($users as $user){
                    $response .= '
                    <tr>
                            <td>'.$user->name.'</td>
                            <td>'.$user->email.'</td>
                            <td>'. $user->role.'</td>
                    </tr>';
                }

                $response .= '
                            </tbody>
                        </table>';

        } else{
            $response = 'No Results';
        }

        return $response;
    }

    public function manageLibrary()
    {
        return view('admin.library');
    }
}
