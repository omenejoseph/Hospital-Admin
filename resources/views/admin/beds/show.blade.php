@extends('layouts.admin')


@section('content')
<h2>Beds in the {{$wardName}} Ward</h2>
<table class="table table-striped table-responsive" id="myTable">
    <thead>
      <tr>
      <th>S/N</th>
        <th>Name</th>
        <th>occupant</th>
        
      </tr>
    </thead>
    <tbody>
    @foreach ($beds as $key => $bed)
      <tr>
        <td>{{$key + 1}}</td>
        <td >{{$bed->name}}</td>
        <td>None</td>
    @endforeach
  </table>


@stop