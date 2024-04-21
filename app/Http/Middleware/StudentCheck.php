<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class StudentCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $contentId = $request->route('contentId');

        $enrolls = Enrollment::where('user_id', Auth::user()->id)->get();

        //dd($enrolls);
        foreach($enrolls as $enroll){
            if($enroll->status == true){
                foreach($enroll->course->topics as $topic){
                    foreach($topic->contents as $content){
                        if($content->id == $contentId){
                            return $next($request);
                        }
                    }
                }
            }else{
                return back()->with(['status' => 'you need to enroll this course and wait for permission']);
            }

        }
        return abort(404);
    }
}
