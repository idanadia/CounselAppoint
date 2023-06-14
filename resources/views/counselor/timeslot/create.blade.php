@extends('layouts.template')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            counselor/timeslot/create
            <h2>Add New Timeslot</h2>
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

<form action="{{ route('counselor.timeslots.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="startTime">Start Time</label>
        <input type="time" name="startTime" id="startTime" class="form-control" value="{{ old('time') }}" required>
    </div>
    <div class="form-group">
        <label for="endTime">End Time</label>
        <input type="time" name="endTime" id="endTime" class="form-control" value="{{ old('time') }}" required>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Submit</button>

            <a class="btn btn-primary" href="{{ route('counselor.timeslots.index') }}"> Back</a>
        </div>
    </div>

</form>
@endsection