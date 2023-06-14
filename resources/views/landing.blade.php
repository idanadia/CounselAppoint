{{-- @extends('layouts.app')

@section('content')

<div class="jumbotron">
    <div class="container my-5">
        <h1 class="display-4">Drug Abuse in Malaysia</h1>
        <hr class="my-4">
        <p class="lead">Learn about the latest statistics on drug abuse in Malaysia and the different types of drugs
            that
            are commonly abused.</p>
        <a class="btn btn-primary btn-lg" href="#statistics" role="button">View Statistics</a>
        <a class="btn btn-secondary btn-lg" href="#drug-types" role="button">View Drug Types</a>


    </div>
</div>

<div class="container my-5" id="statistics">
    <h2>Current Malaysia Statistics</h2>
    <hr class="my-4">
    <p>According to the National Anti-Drug Agency (NADA), there were a total of 20,313 drug addicts in Malaysia in 2020.
        The majority of these addicts were male (95.3%) and aged between 19 and 39 years old.</p>
    <p>The most commonly abused drugs in Malaysia are methamphetamine (also known as syabu), heroin, and cannabis.</p>
</div>

<div class="container my-5" id="drug-types">
    <h2>Types of Drugs</h2>
    <hr class="my-4">
    <p>There are many different types of drugs that are abused in Malaysia, including:</p>
    <ul>
        <li>Methamphetamine (syabu)</li>
        <li>Heroin</li>
        <li>Cannabis (marijuana)</li>
        <li>Cocaine</li>
        <li>Ecstasy (MDMA)</li>
    </ul>
</div>

<div class="container my-5">
    <h2>Contact Us</h2>
    <hr class="my-4">
    <p>If you or someone you know is struggling with drug addiction, please contact us for help.</p>
    <p>Phone: 03-8911-2200</p>
    <p>Email: webmaster@adk.gov.my</p>
</div>
@endsection --}}

@extends('layouts.app')
<style>
    hr {
        height: 1px;
        color: white;
        background-color: white;
        border: none;
    }

    .jumbotron {
        background-color: #5c001f !important;
    }
</style>
@section('content')

<div class="jumbotron">
    <div class="container my-5 test">
        <img src="{{ asset('admin/dist/img/utmlogowhite.png')}}" alt="UTM Logo" style="width:8rem" class="mb-3">
        <h1 class="display-4 text-white">Counseling Appointments</h1>
        <hr class="my-4 text-white">
        <p class="lead text-white">Welcome to UTM Skudai's counseling appointment page. Our trained counselors are
            available
            to
            meet with you face-to-face, over the phone, or through video call to help you with any topic you may be
            struggling with.</p>
        <a class="btn btn-primary btn-lg" href="#services" role="button">View Our Services</a>
        <a class="btn btn-secondary btn-lg" href="#counselors" role="button">View Our Counselors</a>
    </div>
</div>
<div class="container my-5" id="services">
    <h2>Our Services</h2>
    <hr class="my-4">
    <p>Our counselors are experienced in a wide range of topics and can provide support for:</p>
    <ul>
        <li>Stress and anxiety</li>
        <li>Depression and mood disorders</li>
        <li>Relationship and family issues</li>
        <li>Substance abuse and addiction</li>
        <li>Academic and career concerns</li>
    </ul>
    <p>We offer counseling sessions in three formats:</p>
    <ul>
        <li>Face-to-face</li>
        <li>Phone call</li>
        <li>Video call</li>
    </ul>
</div>
<div class="container my-5" id="counselors">
    <h2>Our Counselors</h2>
    <hr class="my-4">
    <p>We have a team of trained and qualified counselors who are here to support you. Our counselors have experience
        working with a variety of clients and can provide support for a wide range of issues. To learn more about our
        counselors and their areas of expertise, please visit our <a href="#">Counselors
            Page</a>.</p>
</div>
<div class="container my-5">
    <h2>Contact Us</h2>
    <hr class="my-4">
    <p>If you are interested in scheduling a counseling appointment or have any questions, please contact us at:</p>
    <p>Phone: 012-345-6789</p>
    <p>Email: counseling@utm.my</p>
</div>
@endsection