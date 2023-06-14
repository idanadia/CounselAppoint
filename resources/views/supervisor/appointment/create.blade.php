@extends('layouts.template')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            client/appointment/create
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
@foreach ($counselors as $counselor)
<div class="modal fade" id="counselor-modal-{{ $counselor->id }}" tabindex="-1" role="dialog"
    aria-labelledby="counselor-modal-{{ $counselor->id }}-label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="counselor-modal-{{ $counselor->id }}-label">{{ $counselor->fullName }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img src="{{ !$counselor->imagePath ? Storage::url('images/default.jpg' ):Storage::url('images/' . $counselor->imagePath) }}"
                    class="img-circle " alt="{{ $counselor->imagePath }}"
                    style="object-fit: cover; width: 70px; height:70px;"><br>
                <table>
                    <tr>
                        <td width="100px">Name</td>
                        <td>{{$counselor->fullName}}</td>
                    </tr>
                    <tr>
                        <td>Position</td>
                        <td>{{$counselor->position}}</td>
                    </tr>
                    <tr>
                        <td>Qualification</td>
                        <td>{{$counselor->qualification}}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>{{$counselor->email}}</td>
                    </tr>
                    <tr>
                        <td>Position</td>
                        <td>{{$counselor->phoneNo}}</td>
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
<form action="{{ route('client.appointments.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="date">Counselor</label>
        <div class="row">
            @foreach ($counselors as $counselor)
            <div class="col-sm-4">
                <div class="card mb-3">
                    <div class="card-body">
                        <img src="{{ !$counselor->imagePath ? Storage::url('images/default.jpg' ):Storage::url('images/' . $counselor->imagePath) }}"
                            class="img-circle " alt="{{ $counselor->imagePath }}"
                            style="object-fit: cover; width: 50px; height:50px;">
                        <p class="card-text mt-3">{{ $counselor->fullName }}</p>
                        <p class="card-text">{{ $counselor->position }}</p>
                        <button class="btn btn-primary" data-toggle="modal"
                            data-target="#counselor-modal-{{ $counselor->id }}">See
                            More</button>
                        <div class="form-check mt-3">
                            <input class="form-check-input" type="radio" name="counselorId"
                                id="counselor-{{ $counselor->id }}" value="{{ $counselor->id }}" {{
                                (isset($appointment['counselorId']) && $appointment['counselorId']==$counselor->id)
                            ? '
                            checked' : '' }}>
                            <label class="form-check-label" for="counselor-{{ $counselor->id }}">
                                Select
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>



    <div class="form-group">
        <label for="date">Date</label>
        <input type="date" name="date" id="date" class="form-control" value="{{ old('date') }}" required>
    </div>

    <div class="form-group">
        <label for="time">Time</label>
        <input type="time" name="time" id="time" class="form-control" value="{{ old('time') }}" required>
    </div>

    <div class="form-group">
        <label for="time">Method of Appointment</label>
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

<script>
    $(document).ready(function () {
        $('a[data-toggle="modal"]').on('click', function () {
            var target = $(this).data('target');
            $(target).modal('show');
        });
    });
</script>
@endsection