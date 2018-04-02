<?php

namespace App\Http\Controllers;

use App\Action;
use App\Mentor;
use App\Student;
use App\User;
use Auth;
use Illuminate\Http\Request;

class MentorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()){
            $mentors = Mentor::all();
            return view('mentor.overview', compact('mentors'));
        }
        else return redirect('/');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::check() && Auth::user()->isAdmin()) {
            $mentors = Mentor::pluck('user_id');
            $students = Student::whereNotIn('user_id', $mentors)->get();
            return view('mentor.create')->with('students', $students);
        }
        else return redirect('/mentor');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $mentor = new Mentor();
        $mentor->user_id = $request->student;
        $mentor->save();
        return redirect('/mentor');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Mentor  $mentor
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::check()){
            $mentor = Mentor::find($id);
            $actions = Action::all();
            return view('mentor.edit', compact('mentor', 'id'))->with('actions', $actions);
        }
        else return view('/mentor');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $mentor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mentor $mentor)
    {
        //First, save the mentor type (mentors)
        $mentor->action_id = $request->typeMentor;
        $mentor->save();

        //Then, save admin setting (users)
        $user = User::find($mentor->user_id);
        if ($request->admin){
            $user->isAdmin = $request->admin;
        }
        else $user->isAdmin = 0;
        $user->save();
        return redirect('/mentor');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Mentor
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Mentor::find($id)->delete();
        return redirect('/mentor');

    }
}