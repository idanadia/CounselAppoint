<?php

namespace App\Http\Controllers;

use App\Models\Timetable;
use App\Models\Hall;
use App\Models\Subject;
use App\Models\Day;
use Illuminate\Http\Request;

class TimetableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $timetables = Timetable::with('day', 'subject', 'hall')
        ->get();

        return view('timetables.index',compact('timetables'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $days = Day::pluck('day_name', 'id');
        $halls = Hall::pluck('lecture_hall_name', 'id');
        $subjects = Subject::pluck('subject_name', 'id', 'subject_code');
    
        return view('timetables.create', compact('days', 'subjects', 'halls'));
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Timetable::create([
    		'user_id' => auth()->user()->id,
    		'day_id' => $request->day_id,
            'subject_id' => $request->subject_id,
    		'lecture_hall_id' => $request->lecture_hall_id,
    		'time_from' => $request->time_from,
            'time_to' => $request->time_to,
    	]);

        return redirect()->route('timetables.index')
                        ->with('success','Timetables created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Timetable  $Timetable
     * @return \Illuminate\Http\Response
     */
    public function show(Timetable $timetable)
    {
        return view('timetables.show',compact('timetable'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Timetable  $Timetable
     * @return \Illuminate\Http\Response
     */
    public function edit(Timetable $timetable)
    {
        $days = Day::pluck('day_name', 'id');

        $halls = Hall::pluck('lecture_hall_name', 'id');

        $subjects = Subject::pluck('subject_name', 'id', 'subject_code');

        return view('timetables.edit',compact('days', 'subjects', 'halls', 'timetable'));

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Timetable  $Timetable
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Timetable $timetable)
    {
        $timetable->update($request->all());

        return redirect()->route('timetables.index')
                        ->with('success','Timetables updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Timetable  $Timetable
     * @return \Illuminate\Http\Response
     */
    public function destroy(Timetable $timetable)
    {
        $timetable->delete();
  
        return redirect()->route('timetables.index')
                        ->with('success','Timetable deleted successfully');
    }
}
