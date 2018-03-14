<?php

namespace App\Http\Controllers;

use App\Student;
use App\Rating;
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
        $students = Student::all();
        return view('student.overview', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::check()) {
            $ratings = Rating::all();
            $mentors = User::all();
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
            'email' => 'required|email|max:255|unique:students',
        ]);
        if ($validator->fails()) {
            return redirect('student/create')
                ->withErrors($validator)
                ->withInput();
        }
        $student = new Student();
        $student->name = $request->name;
        $student->vatsim_id = $request->vatsim_id;
        $student->email = $request->email;
        $student->rating_id = $request->rating;
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
        if (Auth::check()){
            $student = Student::find($id);
            $ratings = Rating::all();
            $mentors = User::all();
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
    public function update(Request $request, Student $student)
    {
        $student->email = $request->email;
        $student->rating_id = $request->rating;
        $student->mentor_id = $request->mentor;
        $student->save();
        return redirect('/student');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        //
    }
}
