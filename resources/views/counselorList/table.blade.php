@php
use Carbon\Carbon;
@endphp
@section('content')
<div class="row">
    <div class="col-lg-6 margin-tb">
        <div class="pull-left">
            <h2>Counselors</h2>
        </div>
    </div>
</div>
<br>
@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif

<div class="form-group">
    <div class="row">
        @foreach ($counselors as $counselor)
        <div class="col-sm-4">
            <div class="card mb-3">
                <div class="card-body">
                    <img src="{{ !$counselor->imagePath ? Storage::url('images/default.jpg' ):Storage::url('images/' . $counselor->imagePath) }}"
                        class="img-circle " alt="{{ $counselor->imagePath }}"
                        style="object-fit: cover; width: 5rem; height:5rem;">
                    <p class="card-text mt-3">{{ $counselor->fullName }}</p>
                    <p class="card-text">{{ $counselor->email }}</p>
                    <p class="card-text">{{ $counselor->position }}</p>
                    <p class="card-text">{{ $counselor->faculty }}</p>
                    <p class="card-text">{{ $counselor->department }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<!-- Show the modal if the condition is true -->
@if (Session::get('appointment') && Session::get('success'))
<script>
    $(document).ready(function() {
            $('#appointment-modal').modal('show');
        });
</script>
@endif

<script>
    $(document).ready(function() {
        $('#client-appointments-table').DataTable();
    });
</script>