<link rel="stylesheet" href="https://cdn.datatables.net/1.11.0/css/dataTables.bootstrap4.min.css">
<script src="https://cdn.datatables.net/1.11.0/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.0/js/dataTables.bootstrap4.min.js"></script>

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>List of Clients</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('supervisor.clients.create') }}"> Create Client</a>
        </div>
        {{-- <div class="pull-right">
            <a class="btn btn-success" href="{{ route('supervisor.users.create') }}"> Add New User</a>
        </div> --}}
    </div>
</div>
<br>
@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif
@foreach ($clients as $client)
<div class="modal fade" id="client-modal-{{ $client->id }}" tabindex="-1" role="dialog"
    aria-labelledby="client-modal-{{ $client->id }}-label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="client-modal-{{ $client->id }}-label">{{ $client->fullName }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img src="{{! $client->imagePath ? Storage::url('images/default.jpg' ):Storage::url('images/' .  $client->imagePath) }}"
                    class="img-circle " alt="{{  $client->imagePath }}"
                    style="object-fit: cover; width: 70px; height:70px;">
                <table>
                    <tr>
                        <td width="100px">Name</td>
                        <td>{{$client->fullName}}</td>
                    </tr>
                    <tr>
                        <td>Matric ID</td>
                        <td>{{$client->matricId}}</td>
                    </tr>
                    <tr>
                        <td>Course</td>
                        <td>{{$client->course}}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>{{$client->email}}</td>
                    </tr>
                    <tr>
                        <td>Phone No</td>
                        <td>{{$client->phoneNo}}</td>
                    </tr>
                    <tr>
                        <td>Faculty</td>
                        <td>{{$client->faculty}}</td>
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
<table id="clients-table" class="table table-bordered">
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
        @foreach ($clients as $s)
        <tr>
            <td>{{ $s->id }}</td>
            <td>{{ $s->fullName }}</td>
            <td>{{ $s->email }}</td>
            <td>{{ $s->role }}</td>
            <td>{{ $s->created_at }}</td>
            <td>

                <form action="{{ route('supervisor.counselors.destroy',$s->id) }}" method="POST">

                    <a class="btn" data-toggle="modal" data-target="#client-modal-{{ $s->id }}">Show Profile</a>

                    {{-- <a class="btn btn-primary" href="{{ route('supervisor.users.edit',$s->id) }}">Edit</a> --}}

                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>

</table>

<script>
    $(document).ready(function () {
        $('a[data-toggle="modal"]').on('click', function () {
            var target = $(this).data('target');
            $(target).modal('show');
        });
    });
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.3/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function() {
        $('#clients-table').DataTable();
    });
</script>