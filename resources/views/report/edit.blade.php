@extends('layouts.template')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Edit inspection</h2>
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

<form action="{{ route('inspections.update',$inspection->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="row">
        <div class="col-xs-6 col-sm-6 col-md-6">
            <select class="form-control" name="day_id">
                <option value="">-- Choose Day --</option>
                @foreach ($users as $user)
                <option value="{{$user['id']}}" {{ (isset($inspection['user_id']) && $inspection['user_id']==$user->id)
                    ? ' selected' : '' }}>{{$user->fullName}}</option>
                @endforeach
            </select>
        </div>
        <br>
        <br>
    </div>
    <div class="row">
        <div class="col-xs-6 col-sm-6 col-md-6">
            <select class="form-control" name="subject_id">
                <option value="">-- Choose Subject --</option>
                @foreach ($subjects as $id => $name)
                <option value="{{$id}}" {{ (isset($inspection['subject_id']) && $inspection['subject_id']==$id)
                    ? ' selected' : '' }}>{{$name}}</option>
                @endforeach
            </select>
        </div>
        <br>
        <br>
    </div>
    <div class="row">
        <div class="col-xs-6 col-sm-6 col-md-6">
            <select class="form-control" name="lecture_hall_id">
                <option value="">-- Choose Hall --</option>
                @foreach ($halls as $id => $name)
                <option value="{{$id}}" {{ (isset($inspection['lecture_hall_id']) &&
                    $inspection['lecture_hall_id']==$id) ? ' selected' : '' }}>{{$name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <br>
    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Time From:</strong>
            <input type="text" name="time_from" class="form-control" value="{{ $inspection->time_from }}"
                placeholder="Time From">
        </div>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Time To:</strong>
            <input type="text" name="time_to" class="form-control" value="{{ $inspection->time_to }}"
                placeholder="Time To">
        </div>
    </div>
    <br>
    <br>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a class="btn btn-primary" href="{{ route('inspections.index') }}"> Back</a>
        </div>
    </div>

</form>
@endsection