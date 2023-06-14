@extends('layouts.template')
@php
use Carbon\Carbon;
@endphp
@section('content')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.0/css/dataTables.bootstrap4.min.css">
<script src="https://cdn.datatables.net/1.11.0/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.0/js/dataTables.bootstrap4.min.js"></script>
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            counselor/app/create
            <h2>Add New Appointment</h2>
        </div>

    </div>
</div>

@if ($errors->any())
<div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

@foreach ($clients as $client)
<div class="modal fade" id="client-modal-{{ $client->id }}" tabindex="-1" role="dialog"
    aria-labelledby="client-modal-{{ $client->id }}-label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="client-modal-{{ $client->id }}-label">{{ $client->fullName }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table>
                    <tr>
                        <td width="100px">Name</td>
                        <td>{{$client->fullName}}</td>
                    </tr>
                    <tr>
                        <td>Matric ID</td>
                        <td>{{$client->matricId}}</td>
                    </tr>
                    <tr>
                        <td>Course</td>
                        <td>{{$client->course}}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>{{$client->email}}</td>
                    </tr>
                    <tr>
                        <td>Faculty</td>
                        <td>{{$client->faculty}}</td>
                    </tr>
                </table>

                <!-- Add any other information you want to display here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endforeach
<form action="{{ route('counselor.appointments.store') }}" method="POST">
    @csrf
    {{-- z --}}
    <div class="form-group">
        <table id="client-table" class="table table-bordered">
            <thead>
                <tr>
                    <th></th>
                    <th width="280px">Full Name</th>
                    <th>Email</th>
                    <th>IC No</th>
                    <th>Matrics No</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($clients as $client)
                <tr>
                    <td>
                        <input type="checkbox" name="clientId" value="{{ $client->id }}"
                            onclick="console.log(this.value)">
                    </td>
                    <td>{{ $client->fullName }}</td>
                    <td>{{ $client->email }}</td>
                    <td>{{ $client->icNo }}</td>
                    <td>{{ $client->matricId }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{-- <div class="form-group">
        <label for="client">Email/Matric No/IC</label>
        <input type="text" name="client" id="client" class="form-control" placeholder="Email/Matric No/IC" required>
    </div> --}}

    <div class="form-group">
        <label for="date">Date</label>
        <input type="date" name="date" id="date" class="form-control" value="{{ old('date') }}" required>
    </div>
    <div class="form-group">
        <label for="time">Time</label>
        <select name="time" id="time" class="form-control" required>
            <option value="">Select a time slot</option>
            @foreach($timeslots as $timeslot)
            <option value="{{$timeslot->id}}">{{Carbon::parse($timeslot->startTime)->format('g:i A')
                ." - ".Carbon::parse($timeslot->endTime)->format('g:i A')}}
            </option>
            @endforeach
        </select>
    </div>



    <div class="form-group">
        <label for="method">Method of Appointment</label>
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="method" id="video-call"
                                    value="Video Call" {{ (isset($appointment['method']) &&
                                    $appointment['method']=='Video Call' ) ? ' checked' : '' }}>
                                <label class="form-check-label" for="video-call">
                                    Video Call
                                </label>
                            </div>
                            <p class="card-text">Have your appointment via video call.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="method" id="phone-call"
                                    value="Phone Call" {{ (isset($appointment['method']) &&
                                    $appointment['method']=='Phone Call' ) ? ' checked' : '' }}>
                                <label class="form-check-label" for="phone-call">
                                    Phone Call
                                </label>
                            </div>
                            <p class="card-text">Have your appointment via phone call.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="method" id="face-to-face"
                                    value="Face to Face" {{ (isset($appointment['method']) &&
                                    $appointment['method']=='Face to Face' ) ? ' checked' : '' }}>
                                <label class="form-check-label" for="face-to-face">
                                    Face to Face
                                </label>
                            </div>
                            <p class="card-text">Have your appointment face to face.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Submit</button>

            <a class="btn btn-primary" href="{{ route('counselor.appointments.index') }}"> Back</a>
        </div>
    </div>

</form>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.3/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>

<script>
    $(document).ready(function() {
        $('#client-table').DataTable();
    });
    $(document).ready(function () {
        $('a[data-toggle="modal"]').on('click', function () {
            var target = $(this).data('target');
            $(target).modal('show');
        });
    });
</script>