@extends('layouts.admin')

@section('content')
<div class="box">
  <div class="box-header with-border">
    

  </div> <!-- /.first box-header end -->
  <div class="box-body">
  <div class="row">
  <div class="col-sm-6 center-block">
<h3>Totabl Bill for {{$patient->name}}</h3> 
<table class="table table-bordered">        
      <tr>
        <td>
        Laboratory Test = N{{$labs}}
        </td>
        </tr>
       <tr>
        <td>
        Consultation = N{{$consult}}
        </td>
      </tr>
      <tr>
        <td>
        Drugs = N{{$drugs}}
        </td>
        </tr>
        <tr>
        <td>
        Payment for Bedspace = N{{$bed_prize}}
        </td>
        </tr>
       <tr>
        <td>
        Anonymous = N{{$anonymous}}
        </td>
        </tr>
       <tr>
        <td>
        Total Bill = N{{$totalBill}}
        </td>
      </tr>
    </table>
    {!! Form::open(['route' => 'admin.patients.emailBill', 'method'=>'GET']) !!}
    <input type="hidden" name="labs" value="{{$labs}}">
    <input type="hidden" name="consults" value="{{$consult}}">
    <input type="hidden" name="drugs" value="{{$drugs}}">
    <input type="hidden" name="bed_prize" value="{{$bed_prize}}">
    <input type="hidden" name="anonymous" value="{{$anonymous}}">
    <input type="hidden" name="totalBill" value="{{$totalBill}}">
    <input type="hidden" name="email" value="{{$patient->email}}">
    <input type="hidden" name="name" value="{{$patient->name}}">
    <input type="hidden" name="id" value="{{$patient->id}}">
    <input type="hidden" name="token" value="{{csrf_token()}}">
    {!! Form::submit('Email Bill', ['class'=>'btn btn-primary'])!!}
    {!! Form::close() !!}
    

     </div>
</div>
  </div>
  <!-- /.box-body -->
  <div class="box-footer">
   
  </div>

@stop