<link rel="stylesheet" href="https://cdn.datatables.net/1.11.0/css/dataTables.bootstrap4.min.css">
<script src="https://cdn.datatables.net/1.11.0/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.0/js/dataTables.bootstrap4.min.js"></script>

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>List of Counseatestlors</h2>
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
        @foreach ($users as $s)
        <tr>
            <td>{{ $s->id }}</td>
            <td>{{ $s->fullName }}</td>
            <td>{{ $s->email }}</td>
            <td>{{ $s->role }}</td>
            <td>{{ $s->created_at }}</td>
            <td>
                <form action="{{ route('supervisor.counselors.destroy',$s) }}" method="POST">

                    <a class="btn btn-info" href="{{ route('supervisor.counselors.show',$s) }}">Show</a>

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
    $(document).ready(function() {
        $('#counselors-table').DataTable();
    });
</script>