<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SupervisorClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = User::where('role', '=', 0)->get();

        return view('supervisor.users.indexClient', compact('clients'));
    }

    public function edit(User $client)
    {
        if (Auth::user()->id !== $client->id && Auth::user()->role !== 'supervisor') {
            // Redirect the user to an error page or show a 403 Forbidden error.
            abort(403, 'Unauthorized action.');
        }
        if (Auth::user()->role !== 'supervisor') {
            return view('users.edit', compact('user'));

        }
        return view('supervisor.users.editClient', compact('client'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
            'matricId' => 'required|string',
            'course' => 'required|string',
            'faculty' => 'required|string',

        ]);

        $newClient = new User();
        $newClient->fullName = $validatedData['fullName'];
        $newClient->email = $validatedData['email'];
        $newClient->address = $validatedData['address'];
        $newClient->password = Hash::make($validatedData['password']);
        $newClient->icNo = $validatedData['icNo'];
        $newClient->phoneNo = $validatedData['phoneNo'];
        $newClient->dateOfBirth = $validatedData['dateOfBirth'];
        $newClient->nationality = $validatedData['nationality'];
        $newClient->matricId = $validatedData['matricId'];
        $newClient->course = $validatedData['course'];
        $newClient->faculty = $validatedData['faculty'];

        $newClient->role = 0;
        $newClient->save();

        return redirect()->route('supervisor.clients.index')
            ->with('success', 'Client created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */

    public function show(User $client)
    {
        return view('supervisor.users.showClient', compact('client'));
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
    public function update(Request $request, User $client)
    {
        $request->validate([
            'fullName' => 'required',
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

        $client->fullName = $request->fullName;
        if ($request->filled('email') && ($request->email != $client->email)) {
            $request->validate([
                'email' => 'required|email|unique:users,email,' . $client->id,
            ]);
            $client->email = $request->email;
        }
        $client->dateOfBirth = $request->dateOfBirth;
        $client->icNo = $request->icNo;
        $client->address = $request->address;
        $client->phoneNo = $request->phoneNo;
        $client->faculty = $request->faculty;
        $client->nationality = $request->nationality;

        $client->department = $request->filled('department') ? $request->department : null;
        $client->roomLocation = $request->filled('roomLocation') ? $request->roomLocation : null;
        $client->position = $request->filled('position') ? $request->position : null;
        $client->qualification = $request->filled('qualification') ? $request->qualification : null;

        $client->matricId = $request->filled('matricId') ? $request->matricId : null;
        $client->course = $request->filled('course') ? $request->course : null;

        if ($request->filled('password')) {
            $client->password = Hash::make($request->password);
        }

        if ($request->hasFile('imagePath')) {
            $imagePath = $request->file('imagePath');
            $filename = time() . '.' . $imagePath->getClientOriginalExtension();
            $path = $imagePath->storeAs('public/images', $filename);
            $oldFilename = $client->imagePath;
            $client->imagePath = $filename;
            if ($oldFilename) {
                Storage::delete('public/images/' . $oldFilename);
            }
        }

        $client->update();

        return redirect()->route('supervisor.clients.edit', $client->id)
            ->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $client)
    {
        $client->delete();

        return redirect()->route('supervisor.clients.index')
            ->with('success', 'Client deleted successfully');
    }

}
