@extends('layouts.template')
@section('content')
<style>
    .report-card {
        border: 1px solid #ccc;
        padding: 10px;
    }

    .report-content {
        font-size: 14px;
        line-height: 1.5;
    }

    .report-timestamp {
        font-size: 12px;
        color: #999;
        margin-top: 10px;
    }
</style>
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            client/appointment/show
            <h2> Appointment Details</h2>
        </div>
    </div>
</div>
@if (Session::get('success'))
<div class="alert alert-success">
    <p>{{ Session::get('success') }}</p>
</div>
@endif

<div class="row">

    <div class="col-xs-12 col-sm-12 col-md-5 rounded border p-3 m-2">
        <h5>Counselor</h5>
        <img src="{{ !$appointment->counselor->imagePath ? asset('admin/dist/img/default.jpg'):Storage::url('images/' . $appointment-> counselor->imagePath) }}"
            class="img-circle " alt="{{ $appointment-> counselor->imagePath }}"
            style="object-fit: cover; width: 50px; height:50px;">
        <div class="form-group">
            <label>Full Name:</label>
            {{ $appointment-> counselor->fullName }} <br>
            <label>Email:</label>
            {{ $appointment-> counselor->email }}
            <br>
            <label>Phone No:</label>
            {{ $appointment-> counselor->phoneNo }}<br>
            <label>Position:</label>
            {{ $appointment-> counselor->position }}<br>
            <label>Room Location:</label>
            {{ $appointment-> counselor->roomLocation }}<br>
            <label>Department:</label>
            {{ $appointment-> client->department }}
            <br>
            <label>Faculty:</label>
            {{ $appointment-> client->faculty }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-5 rounded border p-3 m-2">
        <h5>Client</h5>
        <img src="{{!$appointment->client->imagePath ? asset('admin/dist/img/default.jpg') :Storage::url('images/' . $appointment-> client->imagePath) }}"
            class="img-circle " alt="{{ $appointment-> client->imagePath }}"
            style="object-fit: cover; width: 50px; height:50px;">
        <div class="form-group">

            <label>Full Name:</label>
            {{ $appointment-> client->fullName }} <br>
            <label>Email:</label>
            {{ $appointment-> client->email }}
            <br>
            <label>Phone No:</label>
            {{ $appointment-> client->phoneNo }}<br>
            <label>Matric ID:</label>
            {{ $appointment-> client->matricId }}<br>
            <label>Course:</label>
            {{ $appointment-> client->course }}<br>
            {{-- <label>Department:</label>
            {{ $appointment-> client->department }}
            <br> --}}
            <label>Faculty:</label>
            {{ $appointment-> client->faculty }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 p-3 m-2">
        <h5>Appointment</h5>
        <div class="form-group">
            <label>Date:</label>
            {{ Carbon\Carbon::parse($appointment->appointmentDate)->format('Y/m/d')}}<br>
            <label>Time:</label>
            {{Carbon\Carbon::parse($appointment->timeslot->startTime)->format('g:i A') }}<br>
            <label>Method:</label>
            {{ $appointment-> method }}<br>
            <label>Status:</label>
            {{ $statusLabels[$appointment-> status] }}<br>
            <label>Created at:</label>
            {{ $appointment-> created_at }}
        </div>
    </div>
    @foreach ($reports as $report)
    <div class="card mb-3 rounded-3">
        <div class="card-header">
            <label for="">Report Card #{{$loop->index+1}}</label>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <p class=" rounded-3" id="content" name="content" rows="8">{!! nl2br(e($report->report)) !!}</p>
                @if ($report->attachment)
                <div><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-paperclip" viewBox="0 0 16 16">
                        <path
                            d="M4.5 3a2.5 2.5 0 0 1 5 0v9a1.5 1.5 0 0 1-3 0V5a.5.5 0 0 1 1 0v7a.5.5 0 0 0 1 0V3a1.5 1.5 0 1 0-3 0v9a2.5 2.5 0 0 0 5 0V5a.5.5 0 0 1 1 0v7a3.5 3.5 0 1 1-7 0V3z" />
                    </svg>
                    <a href="{{ Storage::url('attachments/' . $report->attachment) }}" target="_blank">{{
                        $report->attachment }}</a>
                </div>
                @endif
            </div>
            <p class="card-text"><small class="text-muted">Created on {{
                    Carbon\Carbon::parse($report->created_at)->format('Y/m/d g:iA') }} <br>by
                    {{$report->counselor->fullName}}</small></p>
        </div>
    </div>

    @endforeach
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="pull-right">

            <a class="btn btn-primary" href="{{ route('supervisor.appointments.index') }}"> Back</a>
            <a class="btn btn-primary" href="{{ route('supervisor.appointments.index') }}"> Set Reminder</a>
        </div>

    </div>



</div>
@endsection