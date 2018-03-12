@extends('layouts.admin')



@section('content')

 <div class="col-lg-6">
 <div class="form-group">
       {!! Form::open(['method'=>'POST', 'action'=>'AdminWardController@store'])!!}
       
     <div class="form-group">
        {!! Form::label('name', 'NAME') !!}
        {!! Form::text('name', null, ['class'=>'form-control']) !!}
     </div>
        {{csrf_field()}}
    <div class="form-group">
      {!! Form::submit('submit', ['class'=>'btn btn-primary'])!!}
    </div>
    {!! Form::close() !!}
</div>

<div class="col-lg-6">
<table class="table table-striped table-responsive" id="myTable">
    <thead>
      <tr>
      <th>S/N</th>
        <th>Name</th>
        
      </tr>
    </thead>
    <tbody>
    @foreach ($wards as $key => $ward)
      <tr>
        <td>{{$key + 1}}</td>
        <td >{{$ward->name}}</td>
        <td>
        {!! Form::model($ward, ['route' => ['admin.ward.delete', $ward->id], 'method'=>'DELETE']) !!}
        {!! Form::submit('Delete', ['class'=>'btn btn-danger'])!!}
        {!! Form::close() !!}
        </td>
    @endforeach
  </table>
</div>


@stop