@extends('layouts.template')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        counselor/timeslots/edit
        <div class="pull-left">
            <h2>Edit Timeslot</h2>
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

<form action="{{ route('counselor.timeslots.update',$timeslot->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="startTime">Start Time</label>
        <input type="time" name="startTime" id="startTime" class="form-control"
            value="{{ Carbon\Carbon::parse($timeslot->startTime)->format('H:i') }}" required>
    </div>
    <div class="form-group">
        <label for="endTime">End Time</label>
        <input type="time" name="endTime" id="endTime" class="form-control"
            value="{{ Carbon\Carbon::parse($timeslot->endTime)->format('H:i') }}" required>
    </div>

    <br>
    <br>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a class="btn btn-primary" href="{{ route('counselor.timeslots.index') }}"> Back</a>
        </div>
    </div>

</form>
@endsection