<?php

namespace App\Http\Controllers;

use App\Student;
use App\Rating;
use App\Mentor;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()){
            $students = Student::all();
            return view('student.overview', compact('students'));
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
            $ratings = Rating::all();
            $mentors = Mentor::all();
            return view('student.create')->with('ratings', $ratings)->with('mentors', $mentors);
        }
        else return redirect('/');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'bail|required|string',
            'vatsim_id' => 'required|numeric|digits_between:6,7',
            'email' => 'required|email|max:255|unique:users',
        ]);
        if ($validator->fails()) {
            return redirect('student/create')
                ->withErrors($validator)
                ->withInput();
        }
        //First create the user
        $user = new User();
        $user->name = $request->name;
        $user->vatsim_id = $request->vatsim_id;
        $user->email = $request->email;
        $user->rating_id = $request->rating;
        $user->save();

        //When User has been saved, create the student.
        $student = new Student();
        $student->user_id = $user->id;
        $student->mentor_id = $request->mentor;
        $student->save();
        return redirect('/student');
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
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::check() && Auth::user()->isAdmin()){
            $student = Student::find($id);
            $ratings = Rating::all();
            $mentors = Mentor::all();
            return view('student.edit', compact('student', 'id'))->with('ratings', $ratings)->with('mentors', $mentors);
        }
        else return view('/student');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //First, save/delete mentor (if changed)
        $student = Student::find($id);
        $student->mentor_id = $request->mentor;
        $student->save();

        //Then, change email and rating
        $user = User::find($student->user_id);
        $user->email = $request->email;
        $user->rating_id = $request->rating;
        $user->save();

        return redirect('/student');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Student::find($id)->delete();
        return redirect('/student');
    }
}
