<?php

namespace App\Http\Controllers;

use App\Models\Inspection;
use App\Models\User;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $userCount = User::count();
        $healthReportCount = Inspection::count();

        return view('dashboard', compact('userCount', 'healthReportCount'));
    }
}
