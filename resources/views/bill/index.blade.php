@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <!-- <div class="card-header">Register</div> -->

                <div class="card-body">
<h3>Total Bill for {{$patient->name}} is N{{$patient->discharge_bill}}</h3> 

    {!! Form::open(['route' => 'pay', 'method'=>'POST']) !!}
    
    <input type="hidden" name="amount" value="{{$patient->discharge_bill * 100}}">
    <input type="hidden" name="email" value="{{$patient->email}}">
    <input type="hidden" name="name" value="{{$patient->name}}">
    <input type="hidden" name="id" value="{{$patient->id}}">
    <input type="hidden" name="patient_id" value="{{$patient->id}}">
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <input type="hidden" name="reference" value="{{ Paystack::genTranxRef() }}"> {{-- required --}}
    <input type="hidden" name="key" value="{{ config('paystack.secretKey') }}"> {{-- required --}}
    {!! Form::submit('Click Here to Pay', ['class'=>'btn btn-primary'])!!}
    {!! Form::close() !!}
    
              </div>
            </div>
        </div>
    </div>
</div>
@endsection
