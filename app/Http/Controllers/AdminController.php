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
            ->orwhere('email', 'like', '%' . $req->search . '%')->get();
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
                            <td>';
                            if ($user->role == 'student') {
                                $response .= '<span class="badge bg-secondary">'.$user->role.'</span>';
                            }elseif($user->role == 'teacher'){
                                $response .= '<span class="badge bg-info">'.$user->role.'</span>';
                            }else{
                                $response .= '<span class="badge bg-warning">'.$user->role.'</span>';
                            };
                            $response .= '</td>
                            <td>';
                            if ($user->role == 'student') {
                                $response .= '<div class="btn-group" role="group">
                                                <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa-solid fa-user"></i>
                                                </button>
                                                <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="' . route("user.role", ["id" => $user->id, "role" => "teacher"]) . '">Teacher</a></li>
                                                <li><a class="dropdown-item" href="' . route("user.role", ["id" => $user->id, "role" => "admin"]) . '">Admin</a></li>
                                                </ul>
                                            </div>';
                            }elseif($user->role == 'teacher'){
                                $response .= '<div class="btn-group" role="group">
                                                <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa-solid fa-chalkboard-user"></i>
                                                </button>
                                                <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="' . route("user.role", ["id" => $user->id, "role" => "student"]) . '">Student</a></li>
                                                <li><a class="dropdown-item" href="' . route("user.role", ["id" => $user->id, "role" => "admin"]) . '">Admin</a></li>
                                                </ul>
                                            </div>';
                            }else{
                                $response .= '<button type="button" class="btn btn-outline-secondary">
                                                    <i class="fa-solid fa-user-tie"></i>
                                            </button>';
                            };

                            if ($user->account_status == 'active') {
                                $response .= '<a href=" '. route('user.status',['id'=>$user->id, 'status'=>'suspend']) .' " type="button" class="btn btn-outline-info" onclick="return confirm(\'Are you sure, ban this account?\')">
                                                <i class="fa-solid fa-lightbulb"></i>
                                            </a>';
                            } else{
                                $response .= '<a href=" '. route('user.status',['id'=>$user->id, 'status'=>'active']) .' " type="button" class="btn btn-outline-warning">
                                                    <i class="fa-solid fa-ban"></i>
                                                </a>';
                            }

                            if($user->id != Auth::user()->id){
                                $response .= '<a href=" '. route('user.delete',$user->id) .' " type="button" class="btn btn-outline-danger" onclick="return confirm(\'Are you sure?\')">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </a>';
                            }

                        $response .='</td>
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
