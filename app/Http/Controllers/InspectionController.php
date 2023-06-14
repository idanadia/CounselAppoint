<?php

namespace App\Http\Controllers;

// use App\Models\Timetable;
use App\Models\Inspection;
use App\Models\Symptom;
use App\Models\User;
use Illuminate\Http\Request;

class InspectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inspections = Inspection::with('user')
            ->get();

        return view('inspection.index', compact('inspections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $users = User::all();
        $symptoms = Symptom::all();

        return view('inspection.create', compact('users', 'symptoms'));
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
            'user_id' => 'required',
        ]);

        $symptomFields = ['symptom1', 'symptom2', 'symptom3', 'symptom4', 'symptom5', 'symptom6', 'symptom7', 'symptom8', 'symptom9', 'symptom10', 'symptom11', 'symptom12', 'symptom13', 'symptom14'];

        $inspection = new Inspection();
        $inspection->user_id = $request->input('user_id');
        $inspection->noOfSymptoms = 0;
        $inspection->result = 'Negative';

        foreach ($symptomFields as $field) {
            $inspection->{$field} = $request->has($field) ? true : false;
            if ($inspection->{$field}) {
                $inspection->noOfSymptoms++;
            }
        }

        if ($inspection->noOfSymptoms >= 2) {
            $inspection->result = 'Positive';
        }

        $inspection->save();

        return redirect()->route('inspections.index')
            ->with('success', 'Inspection created successfully.');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Timetable  $Timetable
     * @return \Illuminate\Http\Response
     */
    public function show(Inspection $inspection)
    {
        $symptoms = Symptom::all();

        return view('inspection.show', compact('inspection', 'symptoms'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Timetable  $Timetable
     * @return \Illuminate\Http\Response
     */
    public function edit(Inspection $inspection)
    {
        $users = User::get();
        $symptoms = Symptom::all();

        return view('inspection.edit', compact('users', 'inspection', 'symptoms'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Timetable  $Timetable
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inspection $inspection)
    {
        $validatedData = $request->validate([
            'user_id' => 'required',
            // 'symptoms.*' => 'nullable|in:1,2,3,4,5',
            'symptom1' => 'nullable',
            'symptom2' => 'nullable',
            'symptom3' => 'nullable',
            'symptom4' => 'nullable',
            'symptom5' => 'nullable',
            'symptom6' => 'nullable',
            'symptom7' => 'nullable',
            'symptom8' => 'nullable',
            'symptom9' => 'nullable',
            'symptom10' => 'nullable',
            'symptom11' => 'nullable',
            'symptom12' => 'nullable',
            'symptom13' => 'nullable',
            'symptom14' => 'nullable',
            // add more validation rules for symptoms if necessary
        ]);

        $count = 0;
        if ($request->has('symptom1')) {
            $count++;
        }

        if ($request->has('symptom2')) {
            $count++;
        }

        if ($request->has('symptom3')) {
            $count++;
        }

        if ($request->has('symptom4')) {
            $count++;
        }

        if ($request->has('symptom5')) {
            $count++;
        }
        if ($request->has('symptom6')) {
            $count++;
        }if ($request->has('symptom7')) {
            $count++;
        }if ($request->has('symptom8')) {
            $count++;
        }if ($request->has('symptom9')) {
            $count++;
        }if ($request->has('symptom10')) {
            $count++;
        }if ($request->has('symptom11')) {
            $count++;
        }if ($request->has('symptom12')) {
            $count++;
        }if ($request->has('symptom13')) {
            $count++;
        }if ($request->has('symptom14')) {
            $count++;
        }
        $inspection->update([
            'user_id' => $request->input('user_id'),
            'symptom1' => $request->has('symptom1'),
            'symptom2' => $request->has('symptom2'),
            'symptom3' => $request->has('symptom3'),
            'symptom4' => $request->has('symptom4'),
            'symptom5' => $request->has('symptom5'),
            'symptom6' => $request->has('symptom6'),
            'symptom7' => $request->has('symptom7'),
            'symptom8' => $request->has('symptom8'),
            'symptom9' => $request->has('symptom9'),
            'symptom10' => $request->has('symptom10'),
            'symptom11' => $request->has('symptom11'),
            'symptom12' => $request->has('symptom12'),
            'symptom13' => $request->has('symptom13'),
            'symptom14' => $request->has('symptom14'),
            'noOfSymptoms' => $count,
            'result' => $count >= 2 ? "Positive" : "Negative",
        ]);
        // $inspection->update($request->all());

        return redirect()->route('inspections.index')
            ->with('success', 'Inspection updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Timetable  $Timetable
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inspection $inspection)
    {
        $inspection->delete();

        return redirect()->route('inspections.index')
            ->with('success', 'Inspection deleted successfully');
    }
}
