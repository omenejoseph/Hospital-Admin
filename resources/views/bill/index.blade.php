@extends('layouts.login')

@section('content')
<div class="box">
  <div class="box-header with-border">
    

  </div> <!-- /.first box-header end -->
  <div class="box-body">
  <div class="row">
  <div class="col-sm-6 center-block">
<h3>Total Bill for {{$patient->name}} is N{{$patient->discharge_bill}}</h3> 

    {!! Form::open(['route' => 'pay', 'method'=>'POST']) !!}
    
    <input type="hidden" name="amount" value="{{$patient->discharge_bill}}">
    <input type="hidden" name="email" value="{{$patient->email}}">
    <input type="hidden" name="name" value="{{$patient->name}}">
    <input type="hidden" name="id" value="{{$patient->id}}">
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <input type="hidden" name="reference" value="{{ Paystack::genTranxRef() }}"> {{-- required --}}
    <input type="hidden" name="key" value="{{ config('paystack.secretKey') }}"> {{-- required --}}
    {!! Form::submit('Click Here to Pay', ['class'=>'btn btn-primary'])!!}
    {!! Form::close() !!}
    

     </div>
</div>
  </div>
  <!-- /.box-body -->
  <div class="box-footer">
   
  </div>

@stop