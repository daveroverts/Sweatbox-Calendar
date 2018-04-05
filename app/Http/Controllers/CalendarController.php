<?php

namespace App\Http\Controllers;

use App\Mentor;
use App\Session;
use App\SessionType;
use App\Student;
Use Auth;
use Carbon\Carbon;
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
        if (Auth::check()){
            $sessions = Session::orderBy('inProgress','DESC')
                ->orderBy('actualEnd','ASC')
                ->orderBy('date', 'ASC')
                ->orderBy('begin')
                ->get();
            return view('calendar.overview', compact('sessions'));
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
        $currentMentor = Mentor::where('user_id', Auth::id())->first();
        $session->mentor_id = $currentMentor->id;
        $session->student_id = $request->student;
        $session->date = Carbon::createFromFormat('d-m-Y',$request->date)->toDateString();
        $session->begin = $request->timeBegin;
        $session->end = $request->timeEnd;
        $session->description = $request->description;
        $session->typeSession_id = $request->typeSession;
        $session->save();
        return redirect('/calendar')->with('message', 'Session created!');
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
            $session->date = Carbon::createFromFormat('Y-m-d', $session->date)->format('d-m-Y');
            $session->begin = Carbon::createFromFormat('H:i:s',$session->begin)->format('H:i');
            $session->end = Carbon::createFromFormat('H:i:s',$session->end)->format('H:i');
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
        $session->student_id = $request->student;
        $session->date = Carbon::createFromFormat('d-m-Y',$request->date)->toDateString();
        $session->begin = $request->timeBegin;
        $session->end = $request->timeEnd;
        $session->typeSession_id = $request->typeSession;
        $session->description = $request->description;
        $session->save();
        return redirect('/calendar')->with('message','Session has been updated!');
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
        return redirect('/calendar')->with('message','Session has been deleted!');
    }

    public function startSession($id){
        DB::table('sessions')
            ->where('id', $id)
            ->update(['inProgress' => 1, 'actualBegin' => now()]);
        return redirect('/calendar')->with('message','Session has been started! Don\'t forget to stop the session when you are done');
    }
    public function stopSession($id){
        DB::table('sessions')
            ->where('id', $id)
            ->update(['inProgress' => 0, 'actualEnd' => now()]);
        return redirect('/calendar')->with('message','Session has been stopped! If you did this by mistake, you can restart the session');
    }
}
