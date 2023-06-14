<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
        }

        h2 {
            margin-top: 0;
            margin-bottom: 20px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #ddd;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h2>{{ $title }}</h2>
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Date :</strong>
                {{ $inspection->created_at }}
            </div><br>
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
                <strong>Symptoms detected:</strong>
                {{ $inspection-> noOfSymptoms }}/14
            </div>

        </div>
        <br>
        <div class="col-xs-12 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Symptoms :</strong>
                @foreach ($symptoms as $symptom)
                <div>
                    <input type="checkbox" id="symptom{{ $symptom->id }}" name="symptom{{ $symptom->id }}" value="true"
                        {{ $inspection->{'symptom'.$symptom->id} ? 'checked' : ''}} disabled>
                    <label id="symptom-label" for="symptom{{ $symptom->id }}">{{ $symptom->symptom_name }}</label>
                </div>
                @endforeach
            </div>
        </div><br>
        <div class="form-group">
            <strong>Result :</strong>
            {{ $inspection-> result }}<br>
            @if($inspection->result == "Positive")
            <p style="color:red">Intervention is required</p>
            @else
            <br>
            @endif
        </div>
    </div>
    {{-- <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Ic No</th>
                <th>Full Name</th>
                <th>Symptoms</th>
                <th>Result</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $inspection->id }}</td>
                <td>{{ $inspection->user->email }}</td>
                <td>{{ $inspection->user->fullName }}</td>
                <td>{{ $inspection->noOfSymptoms }}</td>
                <td>{{ $inspection->result }}</td>
            </tr>
        </tbody>
    </table> --}}
</body>

</html>