@extends('layouts.template')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Add New User</h2>
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

<form action="{{ route('users.store') }}" method="POST">
    @csrf

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Full Name :</strong>
                <input type="text" name="fullName" class="form-control" placeholder="Name">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong>Email :</strong>
                <input type="text" class="form-control" name="email" placeholder="Email">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong>Password :</strong>
                <input type="password" class="form-control" name="password" placeholder="Password">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong>Identification No :</strong>
                <input type="text" class="form-control" name="icNo" placeholder="Identification No">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong>Phone No :</strong>
                <input type="text" class="form-control" name="phoneNo" placeholder="Phone No">
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-12">
            <div class="form-group">
                <strong>Date of Birth :</strong>
                <input type="date" name="dateOfBirth" class="form-control" placeholder="Date of Birth">
            </div>
        </div>

        <div class="col-xs-6 col-sm-6 col-md-12">
            <div class="form-group">
                <strong>Address :</strong>
                <input type="text" class="form-control" name="address" placeholder="Address">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong>Nationality :</strong>
                <input type="text" class="form-control" name="nationality" placeholder="Nationality">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong>Qualification :</strong>
                <input type="text" class="form-control" name="qualification" placeholder="Qualification">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong>Room Location :</strong>
                <input type="text" class="form-control" name="roomLocation" placeholder="Room Location">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong>Position :</strong>
                <input type="text" class="form-control" name="position" placeholder="Position">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong>Faculty :</strong>
                <input type="text" class="form-control" name="faculty" placeholder="Faculty">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="form-group">
                <strong>Department :</strong>
                <input type="text" class="form-control" name="department" placeholder="Department">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Submit</button>

            <a class="btn btn-primary" href="{{ route('users.index') }}"> Back</a>
        </div>
    </div>

</form>
@endsection