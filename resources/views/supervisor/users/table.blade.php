<link rel="stylesheet" href="https://cdn.datatables.net/1.11.0/css/dataTables.bootstrap4.min.css">
<script src="https://cdn.datatables.net/1.11.0/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.0/js/dataTables.bootstrap4.min.js"></script>

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>List of Counselors</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('supervisor.counselors.create') }}"> Create Counselor</a>
        </div>
    </div>
</div>
<br>
@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif
@foreach ($counselors as $counselor)
<div class="modal fade" id="counselor-modal-{{ $counselor->id }}" tabindex="-1" role="dialog"
    aria-labelledby="counselor-modal-{{ $counselor->id }}-label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="counselor-modal-{{ $counselor->id }}-label">{{ $counselor->fullName }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img src="{{! $counselor->imagePath ? asset('admin/dist/img/default.jpg') :Storage::url('images/' .  $counselor->imagePath) }}"
                    class="img-circle " alt="{{  $counselor->imagePath }}"
                    style="object-fit: cover; width: 70px; height:70px;">
                <table>
                    <tr>
                        <td width="100px">Name</td>
                        <td>{{$counselor->fullName}}</td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td>{{$counselor->address}}</td>
                    </tr>
                    <tr>
                        <td>Identification No</td>
                        <td>{{$counselor->icNo}}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>{{$counselor->email}}</td>
                    </tr>
                    <tr>
                        <td>Phone No</td>
                        <td>{{$counselor->phoneNo}}</td>
                    </tr>
                    <tr>
                        <td>Faculty</td>
                        <td>{{$counselor->faculty}}</td>
                    </tr>
                    <tr>
                        <td>Nationality</td>
                        <td>{{$counselor->nationality}}</td>
                    </tr>
                    <tr>
                        <td>Qualification</td>
                        <td>{{$counselor->qualification}}</td>
                    </tr>
                    <tr>
                        <td>Room Location</td>
                        <td>{{$counselor->roomLocation}}</td>
                    </tr>
                    <tr>
                        <td>Position</td>
                        <td>{{$counselor->position}}</td>
                    </tr>
                    <tr>
                        <td>Department</td>
                        <td>{{$counselor->department}}</td>
                    </tr>
                </table>

                <!-- Add any other information you want to display here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endforeach
<table id="counselors-table" class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Joined On</th>
            <th width="280px">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($counselors as $s)
        <tr>
            <td>{{ $s->id }}</td>
            <td>{{ $s->fullName }}</td>
            <td>{{ $s->email }}</td>
            <td>{{ $s->role }}</td>
            <td>{{ $s->created_at }}</td>
            <td>
                <form action="{{ route('supervisor.counselors.destroy',$s) }}" method="POST">

                    {{-- <a class="btn btn-info" href="{{ route('supervisor.counselors.show',$s) }}">Show</a> --}}
                    <a class="btn" data-toggle="modal" data-target="#counselor-modal-{{ $s->id }}">Show Profile</a>

                    <a class="btn btn-primary" href="{{ route('supervisor.counselors.edit',$s->id) }}">Edit</a>

                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.3/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function () {
        $('a[data-toggle="modal"]').on('click', function () {
            var target = $(this).data('target');
            $(target).modal('show');
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#counselors-table').DataTable();
    });
</script>