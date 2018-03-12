@extends('layouts.admin')



@section('content')
<h1>Add beds Here</h1>
 <div class="col-lg-6">
 <div class="form-group">
       {!! Form::open(['method'=>'POST', 'action'=>'AdminBedsController@store'])!!}
     <div class="form-group">
        <select class="form-control" name="ward_id">
       @foreach($wards as $ward)
          <option value="{{ $ward->id }}">{{ $ward->name }}</option>
       @endforeach
        </select>
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
        <th>Ward</th>
        
      </tr>
    </thead>
    <tbody>
    @foreach ($beds as $key => $bed)
      <tr>
        <td>{{$key + 1}}</td>
        <td >{{$bed->name}}</td>
        <td>{{$bed->ward->name}}</td>
        <td>
        {!! Form::model($bed, ['route' => ['admin.beds.delete', $bed->id], 'method'=>'DELETE']) !!}
        {!! Form::submit('Delete', ['class'=>'btn btn-danger'])!!}
        {!! Form::close() !!}
        </td>
    @endforeach
  </table>
</div>


@stop