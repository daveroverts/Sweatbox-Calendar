<?php

namespace App\Http\Controllers;

use App\Session;
Use Auth;
use Illuminate\Http\Request;

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
        $session = new Session();
        $session->mentor = Auth::id();
        $session->student = $request->student;
        $session->begin = $request->begin;
        $session->end = $request->end;
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
            return('/calendar');
        }
        else{
            $session->student = $request->student;
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
    public function destroy(Session $session)
    {
        //
    }
}
