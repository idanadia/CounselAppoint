@extends('layouts.template')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show Lecture Hall Details</h2>
            </div>
        </div>
    </div>
   
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Lecture Hall Name:</strong>
                {{ $hall->lecture_hall_name }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Lecture Hall Place:</strong>
                {{ $hall->lecture_hall_place }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
                <strong>Joined On:</strong>
                {{ $hall->created_at }}
            </div>
        </div>
        <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('halls.index') }}"> Back</a>
        </div>
    </div>
@endsection