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
        $request->validate([
            'vatsim_id' => 'bail|required|numeric|digits_between:6,7|unique:users',
            'name' => 'required|string',
            'email' => 'required|email|max:255|unique:users',
        ]);
        //First create the user
        $user = User::create([
            'name' => $request->name,
            'vatsim_id' => $request->vatsim_id,
            'email' => $request->email,
            'rating_id' => $request->rating,
        ]);
        $user->save();


        //When User has been saved, create the student.
        $student = Student::create([
            'user_id' => $user->id,
            'mentor_id' => $request->mentor,
        ]);
        $student->save();
        return redirect('/student')->with('message', 'Student has been added into the system!');
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
            $mentors = Mentor::all()->except($student->user->id);
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

        return redirect('/student')->with('message', 'Student has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //First, get remove the mentor from student
        $student = Student::find($id);
        $student->mentor_id = null;
        $student->save();
        //If student was also a mentor, remove him from the mentors table
        Mentor::where('user_id',$student->user_id)->delete();
        //Then, delete student
        User::find($student->user_id)->delete();
        $student->delete();
        return redirect('/student')->with('message','Student has been deleted from the system! If you ever want to re-add him/her in the system, press \'Re-add inactive student\'');
    }

    public function showRestoreForm(){
        if (Auth::check() && Auth::user()->isAdmin()){
            $students = User::onlyTrashed()->get();
            return view('student.restore', compact('students'));
        }
        else return redirect('/');
    }

    public function restore(Request $request){
        User::onlyTrashed()
            ->where('id', $request->student)
            ->restore();
        Student::onlyTrashed()
            ->where('user_id', $request->student)
            ->restore();
        return redirect('/student')->with('message', 'Student has now been marked as active again');
    }
}
