@extends('layouts.template')
@section('content')
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
<form action="{{ route('counselor.clients.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="date">Client</label>
        <div class="row">

            @foreach ($clients as $client)
            <div class="col-sm-4">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">{{ $client->fullName }}</h5>
                        <p class="card-text">{{ $client->matricId }}<br>{{ $client->course }}<br>{{ $client->faculty }}
                        </p>
                        <button class="btn" data-toggle="modal" data-target="#client-modal-{{ $client->id }}">See
                            More</button>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="clientId" id="client-{{ $client->id }}"
                                value="{{ $client->id }}" {{ (isset($appointment['clientId']) &&
                                $appointment['clientId']==$client->id) ? '
                            checked' : '' }}>
                            <label class="form-check-label" for="client-{{ $client->id }}">
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
        <label for="method">Method</label>
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

            <a class="btn btn-primary" href="{{ route('counselor.clients.index') }}"> Back</a>
        </div>
    </div>

</form>
@endsection
<script>
    $(document).ready(function () {
        $('a[data-toggle="modal"]').on('click', function () {
            var target = $(this).data('target');
            $(target).modal('show');
        });
    });
</script>