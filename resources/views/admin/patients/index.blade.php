@extends('layouts.admin')



@section('content')

<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">View All Patients</h3>


<!-- /.Alert div for feedback -->
@if (Session::has('message'))
<div class="box alert alert-info" >

    <div class="box-tools pull-right">
      
      <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
        <i class="fa fa-times"></i></button>
    </div>
  
  <div class="box-body">

    {{ Session::get('message') }}

  </div>
@endif 

<div class="box alert alert-info" style="display:none">

    <div class="box-tools pull-right">
      
      <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
        <i class="fa fa-times"></i></button>
    </div>
  
  <div class="box-body">

	<div id="formSuccess"></div>
  </div>
  
  </div> 
<!-- /.Alert div for feedback end-->

  </div> <!-- /.first box-header end -->
  <div class="box-body">
  <table class="table table-striped table-responsive" id="myTable">
    <thead>
      <tr>
      <th>S/N</th>
        <th>Name</th>
        <th>email</th>
        <th>status</th>
      </tr>
    </thead>
    <tbody>
    @foreach ($patients as $key => $patient)
      <tr>
        <td>{{$key + 1}}</td>
        <td >{{$patient->name}}</td>
        <td>{{$patient->email}}</td>
        <td>
        @if($patient->bed_numbr == 0)
            Unadmitted
        @else
            Admitted
        @endif
        </td>
        <td>
        <a href="{{url('admin/patients/'.$patient->id)}}"><button class="btn btn-info">Patient Details</button></a>
        </td>
        <td>
        <a href="{{route('admin.patients.bill', ['id'=>$patient->id])}}"><button class="btn btn-info">Prepare Bill</button></a>
        </td>
      </tr>
      @endforeach 
    </tbody>
  </table>
  </div>
  <!-- /.box-body -->
  <div class="box-footer">
    This is a list of Patients admitted or out-patients
  </div>

  @stop