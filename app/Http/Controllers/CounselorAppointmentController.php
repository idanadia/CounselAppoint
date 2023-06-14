<?php

namespace App\Http\Controllers;

use App\Mail\AppointmentBookedForClient;
use App\Mail\AppointmentBookedForCounselor;
use App\Models\Appointment;
// use App\Models\Timetable;
use App\Models\Client;
use App\Models\Report;
use App\Models\Timeslot;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Mail;

class CounselorAppointmentController extends Controller
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
        $user = auth()->user();
        $appointments = Appointment::with('counselor')
            ->where('counselorId', '=', $user->id)
            ->get();

        return view('counselor.appointment.index', compact('appointments', 'statusLabels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $clients = User::where('role', 0)->get();
        $timeslots = Timeslot::where('counselorId', Auth::user()->id)
            ->where('isActive', true)->get();
        return view('counselor.appointment.create', compact('clients', 'timeslots'));
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
            'clientId' => 'required',
            'date' => 'required|date',
            'time' => 'required',
            // 'clientId' => 'required|exists:users,id',
            'method' => 'required',
            // 'symptoms' => 'array',
        ]);

        // $datetime = Carbon::createFromFormat('Y-m-d H:i:s', $validatedData['date'] . ' ' . $validatedData['time'] . ":00");

        // $existClient = User::where('email', $validatedData['client'])
        //     ->orWhere('matricId', $validatedData['client'])
        //     ->orWhere('icNo', $validatedData['client'])
        //     ->first();

        // if ($existClient) {
        $appointment = new Appointment();
        $appointment->clientId = $validatedData['clientId'];
        $appointment->method = $validatedData['method'];
        $appointment->timeslotId = $validatedData['time'];
        $appointment->counselorId = Auth::user()->id;
        $appointment->appointmentDate = $validatedData['date'];

        $client = Client::where('counselorId', $appointment->counselorId)
            ->where('clientId', $appointment->clientId)
            ->first();

        if (!$client) {
            $newClient = new Client();
            $newClient->clientId = $appointment->clientId;
            $newClient->counselorId = Auth::user()->id;
            $newClient->save();
        }
        $existAppointment = Appointment::where('counselorId', $appointment->counselorId)
            ->where('timeslotId', $appointment->timeslotId)
            ->where('appointmentDate', $appointment->appointmentDate)
            ->first();

        if ($existAppointment) {
            return redirect()->back()->withErrors(['error' => 'Appointment already exists']);
        } else {
            $appointment->save();

            Mail::to($appointment->counselor->email)->send(new AppointmentBookedForCounselor($appointment));
            Mail::to($appointment->client->email)->send(new AppointmentBookedForClient($appointment));
        }

        // } else {
        //     return response()->json(['error' => 'Client not found'], 404);
        // }

        return redirect()->route('counselor.appointments.index')
            ->with('success', 'Appointment created successfully.')->with('appointment', $appointment);
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
