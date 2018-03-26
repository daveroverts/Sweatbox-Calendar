<?php

namespace App\Http\Controllers;

use App\Student;
use App\Rating;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MentorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mentors = User::all()->except(1);
        return view('mentor.overview', compact('mentors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::check()) {
            $ratings = Rating::all()->except([1,2]);
            return view('mentor.create')->with('ratings', $ratings);
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
            return redirect('mentor/create')
                ->withErrors($validator)
                ->withInput();
        }
        $mentor = new User();
        $mentor->name = $request->name;
        $mentor->vatsim_id = $request->vatsim_id;
        $mentor->email = $request->email;
        $mentor->rating_id = $request->rating;
        $mentor->password = bcrypt('Password');
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
            $ratings = Rating::all();
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
        $mentor->save();
        return redirect('/mentor');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $mentor)
    {
        //
    }
}