@extends('layouts.template')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Welcome '.$user->fullName.'!') }}</div>

                <div class="card-body">
                    @if (session('message'))
                    <div class="alert alert-success" role="alert">
                        {{ session('message') }}
                    </div>
                    @endif
                    <img src="{{!$user->imagePath ? asset('admin/dist/img/default.jpg') : Storage::url('images/' . $user->imagePath) }}"
                        class="img-circle " alt="{{ $user->imagePath }}"
                        style="object-fit: cover; width: 70px; height:70px;">
                    <br><br>
                    <p>
                        Name: {{$user->fullName}} <br>
                        Staff ID: {{$user->matricId}} <br>
                        Department: {{$user->department}}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h1><b>{{$counselorCount+$clientCount}}</b> Users</h1>
                    <p>
                        <b> {{$counselorCount}}</b> counselors <br>
                        <b> {{$clientCount}}</b> clients
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h1><b>{{$appointmentCount}}</b> Sessions</h1>
                    <p>
                        <b> {{$activeAppointmentCount}}</b> active <br>
                        <b> {{$appointmentCount-$activeAppointmentCount}}</b> unresponsive
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection