<?php

namespace App\Http\Controllers;

use App\Models\Timeslot;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TimeslotsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $timeslots = Timeslot::with('counselor')
            ->where('counselorId', '=', $user->id)
            ->get();

        return view('counselor.timeslot.index', compact('timeslots'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients = User::where('role', 0)->get();

        return view('counselor.timeslot.create', compact('clients'));
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
            'startTime' => 'required|date_format:H:i',
            'endTime' => 'required|date_format:H:i|after:startTime',
        ]);
        $todayDate = Carbon::today()->format('Y-m-d');
        $startDateTime = Carbon::createFromFormat('Y-m-d H:i:s', $todayDate . ' ' . $request->startTime . ":00");
        $endDateTime = Carbon::createFromFormat('Y-m-d H:i:s', $todayDate . ' ' . $request->endTime . ":00");

        $timeslot = new Timeslot();
        $timeslot->counselorId = Auth::user()->id;
        $timeslot->isActive = true;
        $timeslot->startTime = $startDateTime;
        $timeslot->endTime = $endDateTime;

        $timeslot->save();

        return redirect()->route('counselor.timeslots.index')
            ->with('success', 'Counselor Timeslot created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function show(Group $group)
    {
        return view('groups.show', compact('group'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function edit(Timeslot $timeslot)
    {
        return view('counselor.timeslot.edit', compact('timeslot'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, Timeslot $timeslot)
    {
        $request->validate([
            'startTime' => 'required|date_format:H:i',
            'endTime' => 'required|date_format:H:i|after:startTime',
        ]);

        $timeslot = Timeslot::findOrFail($timeslot->id);
        $todayDate = Carbon::today()->format('Y-m-d');
        $startDateTime = Carbon::createFromFormat('Y-m-d H:i:s', $todayDate . ' ' . $request->startTime . ":00");
        $endDateTime = Carbon::createFromFormat('Y-m-d H:i:s', $todayDate . ' ' . $request->endTime . ":00");

        $timeslot->startTime = $startDateTime;
        $timeslot->endTime = $endDateTime;
        $timeslot->save();

        return redirect()->route('counselor.timeslots.index')
            ->with('success', 'Timeslot updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group)
    {
        $group->delete();

        return redirect()->route('groups.index')
            ->with('success', 'Lecturer Group deleted successfully');
    }

    public function switchActive($timeslotId)
    {
        $counselor = Auth::user();
        $timeslot = Timeslot::where('id', $timeslotId)
            ->where('counselorId', $counselor->id)
            ->first();

        if (!$timeslot) {
            return response()->json(['error' => 'Timeslot not found'], 404);
        }

        $timeslot->isActive = !$timeslot->isActive;
        $timeslot->save();

        return redirect()->back()
            ->with('success', 'Timeslot isActive updated successfully');
    }
}
