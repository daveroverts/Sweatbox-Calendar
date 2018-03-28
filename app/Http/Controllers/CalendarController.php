<?php

namespace App\Http\Controllers;

use App\Session;
use App\SessionType;
use App\Student;
Use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;

class CalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sessions = Session::orderBy('inProgress','DESC')
            ->orderBy('actualEnd','ASC')
            ->orderBy('date', 'ASC')
            ->orderBy('begin')
            ->get();
        return view('calendar.overview', compact('sessions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::check()) {
            $sessionTypes = SessionType::all();
            $students = Student::all();
            return view('calendar.create')
                ->with('sessionTypes', $sessionTypes)
                ->with('students', $students);
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
                'date' => 'bail|required|date:after_or_equal:today',
                'timeBegin' => 'required',
                'timeEnd' => 'required',
            ]);
        if ($validator->fails()) {
            return redirect('calendar/create')
                ->withErrors($validator)
                ->withInput();
        }
        $session = new Session();
        $session->user_id = Auth::id();
        $session->student_id = $request->student;
        $session->date = $request->date;
        $session->begin = $request->timeBegin;
        $session->end = $request->timeEnd;
        $session->description = $request->description;
        $session->typeSession_id = $request->typeSession;
        $session->save();
        return redirect('/calendar');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function show(Session $session)
    {
        if (Auth::check() && Auth::user()->id == $session->mentor){
            return view('edit', compact('session'));
        }
        else{
            return redirect('/calendar');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::check()){
            $session = Session::find($id);
            $students = Student::all();
            $sessionTypes = SessionType::all();
            return view('calendar.edit', compact('session', 'id'))->with('students', $students)->with('sessionTypes', $sessionTypes);
        }
        else return view('/calendar');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $session = Session::find($id);
        $session->user_id = Auth::id();
        $session->student_id = $request->student;
        $session->date = $request->date;
        $session->begin = $request->timeBegin;
        $session->end = $request->timeEnd;
        $session->typeSession_id = $request->typeSession;
        $session->description = $request->description;
        $session->save();
        return redirect('/calendar');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Session::find($id)->delete();
        return redirect('/calendar');
    }

    public function startSession($id){
        DB::table('sessions')
            ->where('id', $id)
            ->update(['inProgress' => 1, 'actualBegin' => now()]);
        return redirect('/calendar');
    }
    public function stopSession($id){
        DB::table('sessions')
            ->where('id', $id)
            ->update(['inProgress' => 0, 'actualEnd' => now()]);
        return redirect('/calendar');
    }
}
