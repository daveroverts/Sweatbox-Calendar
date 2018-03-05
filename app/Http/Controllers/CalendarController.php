<?php

namespace App\Http\Controllers;

use App\Session;
Use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class CalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = \Auth::user();
        return view('calendar.overview', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('calendar.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try {
            Validator::make($request->all(), [
                'date' => 'required|date:after_or_equal:today',
                'begin' => 'required|time|after:now',
                'end' => 'required:time:after:begin',
            ])->validate();
        } catch (ValidationException $e) {
        }
        $session = new Session();
        $session->user_id = Auth::id();
        $session->student = $request->student;
        $session->date = $request->date;
        $session->begin = $request->timeBegin;
        $session->end = $request->timeEnd;
        $session->description = $request->description;
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
    public function edit(Session $session)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Session $session)
    {
        if (isset($_POST['delete'])){
            $session->delete();
            return view('/calendar');
        }
        else{
            $session->student = $request->student;
            $session->date = $request->date;
            $session->begin = $request->begin;
            $session->end = $request->end;
            $session->description = $request->description;
            $session->save();
            return redirect('/calendar');
        }
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
}
