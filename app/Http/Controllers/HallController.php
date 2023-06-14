<?php

namespace App\Http\Controllers;
use DB;
use Hash;
use App\Models\Hall;
use Illuminate\Http\Request;

class HallController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hall = Hall::all();

        return view('halls.index',compact('hall'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('halls.create');
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
            'lecture_hall_name' => 'required',
            'lecture_hall_place' => 'required',
        ]);

        DB::table('lecture_halls')->insert([
            'lecture_hall_name' => $request->lecture_hall_name,
            'lecture_hall_place' => $request->lecture_hall_place,
        ]);
  
        // User::create($request->all());
   
        return redirect()->route('halls.index')
                        ->with('success','Lecture Hall created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Hall  $Hall
     * @return \Illuminate\Http\Response
     */
    public function show(Hall $hall)
    {
        return view('halls.show',compact('hall'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Hall  $Hall
     * @return \Illuminate\Http\Response
     */
    public function edit(Hall $hall)
    {
        return view('halls.edit',compact('hall'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Hall  $Hall
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hall $hall)
    {
        $request->validate([
            'lecture_hall_name' => 'required',
            'lecture_hall_place' => 'required',
        ]);

        DB::table('lecture_halls')->where('id',$request->id)->update([
            'lecture_hall_name' => $request->lecture_hall_name,
            'lecture_hall_place' => $request->lecture_hall_place,
        ]);
  
        // $student->update($request->all());
  
        return redirect()->route('halls.index')
                        ->with('success','Lecture Hall updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Hall  $Hall
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hall $hall)
    {
        $hall->delete();
  
        return redirect()->route('halls.index')
                        ->with('success','Lecture Hall deleted successfully');
    }
}
