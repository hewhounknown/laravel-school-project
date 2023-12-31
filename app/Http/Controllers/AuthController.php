<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use App\Models\Program;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    //
    public function registerForm ()
    {
        return view('register');
    }

    public function register(Request $req)
    {
        $req->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|min:6|max:15',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $req->name,
            'email' => $req->email,
            'phone' => $req->phone,
            'password' => Hash::make($req->password),
        ]);

        return redirect()->route('login')->with('success', 'Registration successful!');
    }

    public function loginForm()
    {
        return view('login');
    }

    public function login(Request $req)
    {
        $credentials = $req->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to authenticate the user
        if (Auth::attempt($credentials)) {
            // Authentication successful
            $req->session()->regenerate();

            return redirect()->intended('/');
        }

        // Authentication failed, redirect back with error message
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $req)
    {
        Auth::logout();

        $req->session()->invalidate();

        $req->session()->regenerateToken(); //Regenerates the CSRF token

        return redirect('/')->with('success', 'Logged out successfully.');
    }

    public function profileForm()
    {
      if (Auth::user()->role == 'student') {
        if(Enrollment::where('user_id', Auth::user()->id)->exists()){
            $enroll = Enrollment::where('user_id', Auth::user()->id)->get();
            //dd($enroll);
            $list = [];
            foreach($enroll as $e){
                //dd($e->course_id);
                $course = Course::where('id', $e->course_id)->get();
                $list[] = [
                    'course' => $course,
                    'enroll' => $e
                ];
                //
            }
            //dd($course);

            // dd($list);
            return view('student.profile', ['list' => $list]);
        }
        return view('student.profile', ['list' => null]);
      }
      elseif (Auth::user()->role == 'teacher' || Auth::user()->role == 'admin') {
        # code...
        $courses = Course::where('teacher_id', Auth::user()->id)->get();

        $program = Program::get(); // for course create

        return view('teacher.profile', ['courses' => $courses, 'program' => $program]);
      }
      //
    }

    public function editProfile( Request $req)
    {
        $req->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
        ]);

        $userInfo = $req->except('_token');  // remove CSRF token & create array to store in DB

        if($req->hasFile('image')){

            $image = $req->file('image');

            $imageInDB = User::where('id',$req->id)->first();
            $imageInDB = $imageInDB->image;

            if($imageInDB != null){
                Storage::disk('public')->delete('uploads/'. $imageInDB);  // Storage == storage/app
                }

            $imageName = time() . '_' . $image->getClientOriginalName();  // give a name combination with time

            Storage::disk('public')->putFileAs('uploads', $image, $imageName); // store in storage / app / public / uploads

            $userInfo['image'] = $imageName;
        }

       User::where('id', $userInfo['id'])->update($userInfo);

       return redirect('')->route('profile')->with('success', 'your profile is updated.');
    }
}
