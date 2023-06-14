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
                    <img src="{{!$user->imagePath ?asset('admin/dist/img/default.jpg'):Storage::url('images/' . $user->imagePath) }}"
                        class="img-circle " alt="{{ $user->imagePath }}"
                        style="object-fit: cover; width: 70px; height:70px;">
                    <br><br>
                    <p>
                        Name: {{$user->fullName}} <br>
                        Matrics No/IC: {{$user->matricId}}/{{$user->icNo}} <br>
                        Course: {{$user->course}}
                    </p>
                    <div class="float-right">
                        <a type="button" href="{{ route('users.edit', ['user' => Auth::user()->id]) }}"
                            class="btn btn-primary">Show Profile</a>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Active Appointment</div>

                <div class="card-body">
                    @if($appointment)
                    <h5>Counselling Session with {{$appointment->counselor->fullName}}</h5>
                    <h6> {{ Carbon\Carbon::parse($appointment->appointmentDate)->format('D d F Y')
                        .' - '.Carbon\Carbon::parse($appointment->timeslot->startTime)->format('g:i A')
                        }}</h6>
                    <p>Platform: {{$appointment->method}} <br> Counsellor: {{$appointment->counselor->fullName}}</p>
                    <a type="button" href="{{route('client.appointments.show',$appointment->id) }}"
                        class="btn btn-primary">See More</a>
                    @else
                    <p>There's no active appointment for you right now</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection