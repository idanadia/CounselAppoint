<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function clientHome()
    {
        $user = User::where('id', Auth::user()->id)->first();
        $appointment = Appointment::where('clientId', Auth::user()->id)
            ->whereNotIn('status', [0, 4])
            ->first();
        return view('home', ["message" => "I am client role", 'appointment' => $appointment, 'user' => $user]);
    }
    public function counselorHome()
    {
        Log::info(Auth::user()->id);

        $user = User::where('id', Auth::user()->id)->first();

        $appointment = Appointment::where('counselorId', Auth::user()->id)
            ->whereNotIn('status', [0, 4])
            ->first();
        return view('counselor.home', ["message" => "I am counselor role"])->with(['appointment' => $appointment, 'user' => $user]);
    }
    public function supervisorHome()
    {
        $user = User::where('id', Auth::user()->id)->first();
        $appointmentCount = Appointment::count();
        $activeAppointmentCount = Appointment::whereNotIn('status', [0, 4])->count();
        $clientCount = User::where('role', 0)->count();
        $counselorCount = User::where('role', 1)->count();
        return view('supervisor.home',
            [
                "message" => "I am supervisor role",
                'user' => $user,
                'activeAppointmentCount' => $activeAppointmentCount,
                'appointmentCount' => $appointmentCount,
                'clientCount' => $clientCount,
                'counselorCount' => $counselorCount,
            ]);
    }
}
