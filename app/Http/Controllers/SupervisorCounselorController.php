<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SupervisorCounselorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $counselors = User::where('role', 1)->get();

        return view('supervisor.users.index', compact('counselors'));
    }
    public function indexClient()
    {
        $clients = User::where('role', '=', 0)->get();

        return view('supervisor.users.indexClient', compact('clients'));
    }

    public function edit(User $counselor)
    {
        if (Auth::user()->id !== $counselor->id && Auth::user()->role !== 'supervisor') {
            // Redirect the user to an error page or show a 403 Forbidden error.
            abort(403, 'Unauthorized action.');
        }
        if (Auth::user()->role !== 'supervisor') {
            return view('users.edit', compact('counselor'));

        }
        return view('supervisor.users.edit', compact('counselor'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.createCounselor');
    }
    public function createClient()
    {
        return view('users.createClient');
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
            'fullName' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'address' => 'required|string',
            'password' => 'required|string',
            'icNo' => 'required|string',
            'phoneNo' => 'required|string',
            'dateOfBirth' => 'required|date',
            'nationality' => 'required|string',
            'qualification' => 'required|string',
            'roomLocation' => 'required|string',
            'position' => 'required|string',
            'faculty' => 'required|string',
            'department' => 'required|string',
        ]);

        $newCounselor = new User();
        $newCounselor->fullName = $validatedData['fullName'];
        $newCounselor->email = $validatedData['email'];
        $newCounselor->address = $validatedData['address'];
        $newCounselor->password = Hash::make($validatedData['password']);
        $newCounselor->icNo = $validatedData['icNo'];
        $newCounselor->phoneNo = $validatedData['phoneNo'];
        $newCounselor->dateOfBirth = $validatedData['dateOfBirth'];
        $newCounselor->nationality = $validatedData['nationality'];
        $newCounselor->qualification = $validatedData['qualification'];
        $newCounselor->roomLocation = $validatedData['roomLocation'];
        $newCounselor->position = $validatedData['position'];
        $newCounselor->faculty = $validatedData['faculty'];
        $newCounselor->department = $validatedData['department'];
        $newCounselor->role = 1;
        $newCounselor->save();

        return redirect()->route('supervisor.counselors.index')
            ->with('success', 'Counselor created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */

    public function show(User $counselor)
    {
        return view('supervisor.users.show', compact('counselor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'fullName' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6',
            'dateOfBirth' => 'required|date',
            'icNo' => 'required|numeric',
            'phoneNo' => 'required|numeric',
            'address' => 'required',
            'faculty' => 'string|nullable',
            'imagePath' => 'nullable|image|max:2048',
            'nationality' => 'string|nullable',

            'department' => 'string|nullable',
            'roomLocation' => 'string|nullable',
            'position' => 'string|nullable',
            'qualification' => 'string|nullable',

            'matricId' => 'string|nullable',
            'course' => 'string|nullable',
        ]);

        $user->fullName = $request->fullName;
        $user->email = $request->email;
        $user->dateOfBirth = $request->dateOfBirth;
        $user->icNo = $request->icNo;
        $user->address = $request->address;
        $user->phoneNo = $request->phoneNo;
        $user->faculty = $request->faculty;
        $user->nationality = $request->nationality;

        $user->department = $request->filled('department') ? $request->department : null;
        $user->roomLocation = $request->filled('roomLocation') ? $request->roomLocation : null;
        $user->position = $request->filled('position') ? $request->position : null;
        $user->qualification = $request->filled('qualification') ? $request->qualification : null;

        $user->matricId = $request->filled('matricId') ? $request->matricId : null;
        $user->course = $request->filled('course') ? $request->course : null;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        if ($request->hasFile('imagePath')) {
            $imagePath = $request->file('imagePath');
            $filename = time() . '.' . $imagePath->getClientOriginalExtension();
            $path = $imagePath->storeAs('public/images', $filename);
            $oldFilename = $user->imagePath;
            $user->imagePath = $filename;
            if ($oldFilename) {
                Storage::delete('public/images/' . $oldFilename);
            }
        }

        $user->save();

        return redirect()->route('users.edit', $user->id)
            ->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $counselor)
    {
        $counselor->delete();

        return redirect()->route('supervisor.counselors.index')
            ->with('success', 'User deleted successfully');
    }

}
