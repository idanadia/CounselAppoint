@section('content')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.0/css/dataTables.bootstrap4.min.css">
<script src="https://cdn.datatables.net/1.11.0/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.0/js/dataTables.bootstrap4.min.js"></script>
<div class="row">
    <div class="col-lg-6 margin-tb">
        <div class="pull-left">
            counselor/timeslots/table/index
            <h2>Timeslots</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('counselor.timeslots.create') }}">Create Timeslot</a>
        </div>
    </div>
</div>
<br>
@if (Session::get('success'))
<div class="alert alert-success">
    <p>{{ Session::get('success') }}</p>
</div>
@endif
<style>
    .dot {
        margin-left: 1rem;
        display: inline-block;
        width: 10px;
        height: 10px;
        border-radius: 50%;
    }

    .dot-green {
        background-color: green;
    }

    .dot-red {
        background-color: red;
    }
</style>
<table id="counselor-appointments-table" class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Start Time</th>
            <th>End Time</th>
            <th>Duration</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($timeslots as $t)
        <tr>
            <td>{{ $loop->index + 1 }}
                @if ($t->isActive)
                <span class="dot dot-green"></span>
                @else
                <span class="dot dot-red"></span>
                @endif
            </td>
            {{-- <td>{{ \Carbon\Carbon::parse($t->appointmentDateTime)->format('d/m/Y (h:iA)')}}</td> --}}
            <td>{{ Carbon\Carbon::parse($t->startTime)->format('g:i A')
                }}</td>
            <td>{{ Carbon\Carbon::parse($t->endTime)->format('g:i A') }}
            </td>
            <td>
                @php
                $startTime = Carbon\Carbon::parse($t->startTime);
                $endTime = Carbon\Carbon::parse($t->endTime);
                $duration = $startTime->diff($endTime);
                $formattedDuration = '';

                if ($duration->h > 0) {
                $formattedDuration .= $duration->h . ' hour' . ($duration->h > 1 ? 's' : '');
                }

                if ($duration->i > 0) {
                $formattedDuration .= ($formattedDuration !== '' ? ' ' : '') . $duration->i . ' minute' . ($duration->i
                > 1 ? 's' : '');
                }
                @endphp

                {{ $formattedDuration }}</td>
            {{-- <td>{{$statusLabels[$t->status]}}</td> --}}
            <td>
                <form action="{{ route('counselor.timeslots.switchActive', ['timeslotId' => $t->id]) }}" method="POST">
                    @method('PUT')
                    @csrf

                    @if ($t->isActive)
                    <button type="submit" class="btn btn-danger">Deactivate</button>
                    @else
                    <button type="submit" class="btn btn-success">Activate</button>
                    @endif
                </form>
                <form action="{{ route('counselor.timeslots.destroy',$t->id) }}" method="POST">


                    {{-- <a class="btn btn-info" href="{{ route('counselor.appointments.show',$t->id) }}">Show</a> --}}

                    <a class="btn btn-primary" href="{{ route('counselor.timeslots.edit',$t->id) }}">Edit</a>

                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<!-- Load jQuery and Bootstrap JS libraries -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.3/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>

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
        $('#counselor-appointments-table').DataTable();
    });
</script>