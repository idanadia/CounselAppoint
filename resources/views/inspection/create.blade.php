@extends('layouts.template')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Add New Inspection</h2>
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

<form action="{{ route('inspections.store') }}" method="POST">
    @csrf

    <div class="row">
        <div class="col-xs-6 col-sm-6 col-md-6">
            <select class="form-control" name="user_id">
                <option value="">-- Choose User --</option>
                @foreach ($users as $user)
                <option value="{{$user->id}}" {{ (isset($inspection['user_id']) && $inspection['user_id']==$id)
                    ? ' selected' : '' }}>{{$user['fullName']. " | ". $user['email']." | ". $user['idNo']}}</option>
                @endforeach
            </select>
        </div>
        <br>
        <br>
    </div>
    @foreach ($symptoms as $symptom)
    <div>
        <input type="checkbox" id="symptom{{ $symptom->id }}" name="symptom{{ $symptom->id }}" value="true">
        <label for="symptom{{ $symptom->id }}">{{ $symptom->symptom_name }}</label>
    </div>
    @endforeach


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