@extends('layouts.template')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2> Show inspection Details</h2>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Full Name :</strong>
            {{ $inspection->user->fullName }}
        </div>
        <div class="form-group">
            <strong>Identification No :</strong>
            {{ $inspection->user->idNo }}
        </div>
        <div class="form-group">
            <strong>Email :</strong>
            {{ $inspection->user->email }}
        </div>
        <div class="form-group">
            <strong>No of Symptoms:</strong>
            {{ $inspection-> noOfSymptoms }}/14
        </div>
        <div class="form-group">
            <strong>Result :</strong>
            {{ $inspection-> result }}
        </div>
    </div>

    <div class="col-xs-12 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Symptoms :</strong>
            @foreach ($symptoms as $symptom)
            <div>
                <input type="checkbox" id="symptom{{ $symptom->id }}" name="symptom{{ $symptom->id }}" value="true" {{
                    $inspection->{'symptom'.$symptom->id} ? 'checked' : ''}} disabled>
                <label id="symptom-label" for="symptom{{ $symptom->id }}">{{ $symptom->symptom_name }}</label>
            </div>
            @endforeach
        </div>
    </div>
    <div class="pull-right">
        <a class="btn btn-primary" href="{{ route('reports.index') }}"> Back</a>
    </div>
</div>
@endsection