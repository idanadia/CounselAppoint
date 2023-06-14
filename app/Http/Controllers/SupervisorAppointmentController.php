<?php

namespace App\Http\Controllers;

use App\Models\Appointment;

// use App\Models\Timetable;
use App\Models\Report;
use App\Models\Symptom;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SupervisorAppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $statusLabels = [
            0 => 'Scheduled',
            1 => 'Confirmed',
            2 => 'In Progress',
            3 => 'Completed',
            4 => 'Cancelled',
        ];
        $appointments = Appointment::with('counselor')
            ->get();

        return view('supervisor.appointment.index', compact('appointments', 'statusLabels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $counselors = User::where('role', 1)->get();
        $timeslots = [];

        foreach ($counselors as $counselor) {
            $timeslots[$counselor->id] = Timeslot::where('counselorId', $counselor->id)
                ->where('isActive', true)
                ->select('startTime', 'endTime', 'id')->get()
                ->toArray();
        }

        return view('appointment.create', compact('counselors', 'timeslots'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'counselorId' => 'required|exists:users,id',
            // 'symptoms' => 'array',
        ]);

        $datetime = Carbon::createFromFormat('Y-m-d H:i:s', $validatedData['date'] . ' ' . $validatedData['time'] . ":00");

        $appointment = new Appointment();
        $appointment->id = Str::uuid();
        $appointment->counselorId = $validatedData['counselorId'];
        $appointment->clientId = Auth::user()->id;
        $appointment->appointmentDateTime = $datetime;

        // $inspection->noOfSymptoms = 0;
        // $inspection->result = 'Negative';

        // foreach ($symptomFields as $field) {
        //     $inspection->{$field} = $request->has($field) ? true : false;
        //     if ($inspection->{$field}) {
        //         $inspection->noOfSymptoms++;
        //     }
        // }

        // if ($inspection->noOfSymptoms >= 2) {
        //     $inspection->result = 'Positive';
        // }

        $appointment->save();

        return redirect()->route('appointments.index')
            ->with('success', 'Inspection created successfully.');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Timetable  $Timetable
     * @return \Illuminate\Http\Response
     */
    public function show(Appointment $appointment)
    {
        $statusLabels = [
            0 => 'Scheduled',
            1 => 'Confirmed',
            2 => 'In Progress',
            3 => 'Completed',
            4 => 'Cancelled',
        ];
        $reports = Report::with('appointment')
            ->where('appointmentId', $appointment->id)
            ->get();
        return view('supervisor.appointment.show', compact('appointment', 'statusLabels', 'reports'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Timetable  $Timetable
     * @return \Illuminate\Http\Response
     */
    public function edit(Appointment $appointment)
    {
        $users = User::get();
        $symptoms = Symptom::all();

        return view('appointment.edit', compact('users', 'appointment', 'symptoms'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Timetable  $Timetable
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Appointment $appointment)
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

        return redirect()->route('appointments.index')
            ->with('success', 'Appointment updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Timetable  $Timetable
     * @return \Illuminate\Http\Response
     */
    public function destroy(Appointment $appointment)
    {
        $inspection->delete();

        return redirect()->route('appointments.index')
            ->with('success', 'Inspection deleted successfully');
    }

}
