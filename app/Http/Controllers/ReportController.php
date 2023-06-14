<?php

namespace App\Http\Controllers;

// use App\Models\Timetable;
use App\Models\Inspection;
use App\Models\Symptom;
use App\Models\User;
use Dompdf\Dompdf;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $user = auth()->user();
        $inspections = Inspection::where('user_id', $user->id)
            ->with('user')
            ->get();

        return view('report.index', compact('inspections'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     $days = Day::pluck('day_name', 'id');
    //     $halls = Hall::pluck('lecture_hall_name', 'id');
    //     $subjects = Subject::pluck('subject_name', 'id', 'subject_code');

    //     return view('timetables.create', compact('days', 'subjects', 'halls'));
    // }
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
    // public function store(Request $request)
    // {
    //     Timetable::create([
    //         'user_id' => auth()->user()->id,
    //         'day_id' => $request->day_id,
    //         'subject_id' => $request->subject_id,
    //         'lecture_hall_id' => $request->lecture_hall_id,
    //         'time_from' => $request->time_from,
    //         'time_to' => $request->time_to,
    //     ]);

    //     return redirect()->route('timetables.index')
    //                     ->with('success','Timetables created successfully.');
    // }
    public function store(Request $request)
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
        $inspection = new Inspection();
        $inspection->user_id = $request->input('user_id');
        $inspection->symptom1 = $request->has('symptom1') ? true : false;
        $inspection->symptom2 = $request->has('symptom2') ? true : false;
        $inspection->symptom3 = $request->has('symptom3') ? true : false;
        $inspection->symptom4 = $request->has('symptom4') ? true : false;
        $inspection->symptom5 = $request->has('symptom5') ? true : false;
        $inspection->symptom6 = $request->has('symptom6') ? true : false;
        $inspection->symptom7 = $request->has('symptom7') ? true : false;
        $inspection->symptom8 = $request->has('symptom8') ? true : false;
        $inspection->symptom9 = $request->has('symptom9') ? true : false;
        $inspection->symptom10 = $request->has('symptom10') ? true : false;
        $inspection->symptom11 = $request->has('symptom11') ? true : false;
        $inspection->symptom12 = $request->has('symptom12') ? true : false;
        $inspection->symptom13 = $request->has('symptom13') ? true : false;
        $inspection->symptom14 = $request->has('symptom14') ? true : false;

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

        $inspection->noOfSymptoms = $count;
        $inspection->result = $count >= 2 ? "Positive" : "Negative";
        $inspection->save();
// Inspection::create($validatedData);

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
        // $inspection = Inspection::find($id);
        return view('report.show', compact('inspection', 'symptoms'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Timetable  $Timetable
     * @return \Illuminate\Http\Response
     */
    public function edit(Inspection $inspection)
    {
        $users = User::pluck('fullName', 'id');

        return view('inspection.edit', compact('users', 'inspection'));

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
        $inspection->update($request->all());

        return redirect()->route('inspections.index')
            ->with('success', 'Timetables updated successfully');
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
            ->with('success', 'inspection deleted successfully');
    }

    public function generatePDF($id)
    {

        $data = [
            'title' => 'Health Inspection Report',
            'inspection' => Inspection::find($id),
            'symptoms' => Symptom::all(),
        ];

        $pdf = new Dompdf();
        $html = view('report.pdf', $data)->render();
        $pdf->loadHtml($html);
        $pdf->render();

        return $pdf->stream('inspection_report_' . $id . '.pdf');
    }

}
