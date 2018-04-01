<?php

namespace App\Http\Controllers;

use App\Mentor;
use App\Student;
use App\Rating;
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
            $students = Student::all();
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
     * @param  \App\User  $mentor
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::check()){
            $mentor = User::find($id);
            $ratings = Rating::all()->except([1,2]);
            return view('mentor.edit', compact('mentor', 'id'))->with('ratings', $ratings);
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
    public function update(Request $request, User $mentor)
    {
        $mentor->email = $request->email;
        $mentor->rating_id = $request->rating;
        if ($request->admin){
            $mentor->isAdmin = $request->admin;
        }
        else $mentor->isAdmin = 0;
        $mentor->save();
        return redirect('/mentor');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect('/mentor');

    }
}