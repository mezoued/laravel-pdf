@extends('layouts.app')

@section('content')

 <h1> Nome: {{$employee->name}}</h1>
 <h2> Email: {{$employee->email}}</h2>
 <h3> Telephone: {{$employee->phone_number}}</h3>
 <h3> Dob: {{$employee->dob}}</h3>
 <a class="btn btn-primary" href="/employee/pdfclient/{{$employee->id}}">Export to PDF</a>
    
@endsection