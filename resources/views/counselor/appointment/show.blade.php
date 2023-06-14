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
            counselor/appointment/show
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
    <div class="col-xs-12 col-sm-12 col-md-6">
        <div class="form-group">
            <button class="btn btn-success" data-toggle="modal" data-target="#addReportModal">Add Report</button>
        </div>
    </div>
</div>

<!-- Add Report Modal -->
<div class="modal fade" id="addReportModal" tabindex="-1" role="dialog" aria-labelledby="addReportModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addReportModalLabel">Add Report</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('counselor.reports.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="clientId" value="{{ $appointment->clientId }}">
                <input type="hidden" name="appointmentId" value="{{ $appointment->id }}">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="report">Report</label>
                        <textarea class="form-control" id="report" name="report"></textarea>
                    </div>
                    <input type="file" class="form-control" name="attachment" id="attachment">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Report</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-6 rounded border p-3 m-2">

        <h5>Client</h5>
        <img src="{{!$appointment-> client->imagePath ? asset('admin/dist/img/default.jpg'):Storage::url('images/' . $appointment-> client->imagePath) }}"
            class="img-circle " alt="{{ $appointment-> client->imagePath }}"
            style="object-fit: cover; width: 70px; height:70px;">
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

            <label>Faculty:</label>
            {{ $appointment-> client->faculty }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-6 rounded border p-3 m-2">
        <h5>Counselor</h5>
        <img src="{{! $appointment-> counselor->imagePath ? asset('admin/dist/img/default.jpg'):Storage::url('images/' .  $appointment-> counselor->imagePath) }}"
            class="img-circle " alt="{{  $appointment-> counselor->imagePath }}"
            style="object-fit: cover; width: 70px; height:70px;">
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
    <div class="col-xs-12 col-sm-12 col-md-12 p-3 m-2">
        <h5>Appointment</h5>
        <div class="form-group">
            <label>Date:</label>
            {{ Carbon\Carbon::parse($appointment->appointmentDate)->format('Y/m/d l')}}<br>
            <label>Time:</label>
            {{Carbon\Carbon::parse($appointment->timeslot->startTime)->format('g:i A') }}<br>
            <label>Method:</label>
            {{ $appointment-> method }}<br>
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
                    <a href="{{ Storage::url('attachments/' .  $report->attachment) }}" target="_blank">{{
                        $report->attachment }}</a>
                </div>
                @endif
            </div>
            <p class="card-text"><small class="text-muted">Created on {{ $report->created_at }}</small></p>
        </div>
    </div>

    @endforeach
    <div class="col-xs-12 col-sm-12 col-md-12">
        <form action="{{ route('counselor.appointments.changeStatus', [$appointment->id, $appointment->status]) }}"
            method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="status">Status:</label>
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <select class="form-control" id="status" name="status"
                        onchange="this.form.action = '{{ route('counselor.appointments.changeStatus', [$appointment->id, ':status']) }}'.replace(':status', this.value);">
                        <option value="0" {{ $appointment->status == 0 ? 'selected' : '' }}>Scheduled</option>
                        <option value="1" {{ $appointment->status == 1 ? 'selected' : '' }}>Confirmed</option>
                        <option value="2" {{ $appointment->status == 2 ? 'selected' : '' }}>In Progress</option>
                        <option value="3" {{ $appointment->status == 3 ? 'selected' : '' }}>Completed</option>
                        <option value="4" {{ $appointment->status == 4 ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>

            </div>
            <div class="form-group">
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <button type="submit" class="btn btn-primary">Change Status</button>
                </div>
            </div>

        </form>
    </div>


    <div class="pull-right">

        <a class="btn btn-primary" href="{{ route('counselor.appointments.index') }}"> Back</a>
        <a class="btn btn-primary" href="{{ route('counselor.appointments.index') }}"> Set Reminder</a>
    </div>

</div>

@endsection