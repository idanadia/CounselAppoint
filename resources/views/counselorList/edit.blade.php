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

<form action="{{ route('appointments.update',$inspection->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="row">
        <div class="col-xs-6 col-sm-6 col-md-6">
            <select class="form-control" name="counselorId">
                <option value="">-- Choose Counselor --</option>
                {{ gettype($counselors) }}
                @foreach ($counselors as $counselor)
                <option value="{{$counselor->id}}" {{ (isset($inspection->counselorId) &&
                    $inspection->counselorId==$counselor->id)
                    ? ' selected' : '' }}>{{$counselor->fullName ." | ".$counselor->idNo." | ".$counselor->email}}
                </option>
                @endforeach
            </select>
        </div>
        <br>
        <br>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Symptoms :</strong>
            @foreach ($symptoms as $symptom)
            <div>
                <input type="checkbox" id="symptom{{ $symptom->id }}" name="symptom{{ $symptom->id }}" value="true" {{
                    $inspection->{'symptom'.$symptom->id} ? 'checked' : ''}} >
                <label id="symptom-label" for="symptom{{ $symptom->id }}">{{ $symptom->symptom_name }}</label>
            </div>
            @endforeach
        </div>
    </div>


    <br>
    <br>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a class="btn btn-primary" href="{{ route('appointments.index') }}"> Back</a>
        </div>
    </div>

</form>
@endsection