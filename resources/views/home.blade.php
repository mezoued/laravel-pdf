@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-3">Laravel HTML to PDF Example</h2>

    <div class="d-flex justify-content-end mb-4">
        <a class="btn btn-primary" href="{{ URL::to('/employee/pdf') }}">Export to PDF</a>
    </div>

    <table class="table table-bordered mb-5">
        <thead>
            <tr class="table-danger">
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Phone</th>
                <th scope="col">DOB</th>
            </tr>
        </thead>
        <tbody>
            @foreach($employee ?? '' as $data)
            <tr>
            <th scope="row"><a href="/{{$data->id}}"> {{ $data->id }} </a> </th>
                <td>{{ $data->name }}</td>
                <td>{{ $data->email }}</td>
                <td>{{ $data->phone_number }}</td>
                <td>{{ $data->dob }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection
