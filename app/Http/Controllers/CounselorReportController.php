<?php

namespace App\Http\Controllers;

use App\Models\Report;

// use App\Models\Timetable;
use App\Models\Symptom;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CounselorReportController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user = auth()->user();
        $reports = Report::with('counselor')
            ->where('counselorId', '=', $user->id)
            ->get();

        return view('counselor.reports.index', compact('reports'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $clients = User::where('role', 0)->get();
        $symptoms = Symptom::all();

        return view('counselor.appointment.create', compact('clients', 'symptoms'));
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
            'clientId' => 'required|exists:users,id',
            'appointmentId' => 'required|exists:appointments,id',
            'report' => 'required',
            'attachment' => 'nullable|mimes:pdf,doc,docx|max:2048',
        ]);

        $report = new Report();
        $report->clientId = $validatedData['clientId'];
        $report->appointmentId = $validatedData['appointmentId'];
        $report->report = $validatedData['report'];
        $report->counselorId = Auth::user()->id;

        if ($request->hasFile('attachment')) {
            $attachment = $request->file('attachment');
            $filename = $attachment->getClientOriginalName();
            // $filename = time() . '.' . $attachment->getClientOriginalExtension();
            $path = $attachment->storeAs('public/attachments', $filename);
            $report->attachment = $filename;
        }

        $report->save();

        return redirect()->back()
            ->with('success', 'Report added successfully.');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Timetable  $Timetable
     * @return \Illuminate\Http\Response
     */
    public function show(Appointment $appointment)
    {
        $reports = Report::with('appointment')
            ->where('appointmentId', $appointment->id)
            ->get();

        return view('counselor.appointment.show', compact('appointment', 'reports'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Timetable  $Timetable
     * @return \Illuminate\Http\Response
     */
    public function edit(Appointment $appointment)
    {
        $clients = User::where('role', 0)->get();
        $symptoms = Symptom::all();

        return view('counselor.appointment.edit', compact('clients', 'appointment', 'symptoms'));

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
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'clientId' => 'required|exists:users,id',
            'method' => 'required',
            'status' => 'required|in:0,1,2,3,4',

            // 'symptoms' => 'array',
        ]);

        $datetime = Carbon::createFromFormat('Y-m-d H:i:s', $validatedData['date'] . ' ' . $validatedData['time'] . ":00");

        $appointment->update([
            'clientId' => $validatedData['clientId'],
            'method' => $validatedData['method'],
            'counselorId' => Auth::user()->id,
            'appointmentDateTime' => $datetime,
            'status' => $validatedData['status'],
        ]);
        // $inspection->update($request->all());

        return redirect()->route('counselor.appointments.index')
            ->with('success', 'Appointment updated successfully');
    }
    public function changeStatus($appointmentId, $status)
    {
        $counselor = Auth::user();
        $appointment = Appointment::where('id', $appointmentId)
            ->where('counselorId', $counselor->id)
            ->first();

        if (!$appointment) {
            return response()->json(['error' => 'Appointment not found'], 404);
        }

        $appointment->status = $status;
        $appointment->save();

        return redirect()->back()
            ->with('success', 'Appointment status updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Timetable  $Timetable
     * @return \Illuminate\Http\Response
     */
    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        return redirect()->route('counselor.appointments.index')
            ->with('success', 'Appointment deleted successfully');
    }

}
