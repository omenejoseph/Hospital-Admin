@extends('layouts.admin')



@section('content')

<div class="box">
  <div class="box-header with-border">
    

  </div> <!-- /.first box-header end -->
  <div class="box-body">
  <div class="row">
  <div class="col-sm-6 center-block">
   
    <h3 class="box-title">Prepare Bill for {{$patient->name}} <small>Bill prepared in NGN</small></h3>
            <div class="form-group col-xs-12">
            <div class="form-group">
       {!! Form::open(['method'=>'GET', 'action'=>'AdminPatientsController@calcBill'])!!}
       
     <div class="form-group">
        {!! Form::label('drugs', 'Prize of Drugs') !!}
        {!! Form::number('drugs', null, ['class'=>'form-control']) !!}
     </div>
     <input type="hidden" name="id" value="{{$patient->id}}">
     <div class="form-group">
        {!! Form::label('consult', 'Doctors Consultation') !!}
        {!! Form::number('consult', null, ['class'=>'form-control']) !!}
     </div>
     <div class="form-group">
        {!! Form::label('labs', 'Laboratory Test Ammount') !!}
        {!! Form::number('labs', null, ['class'=>'form-control']) !!}
     </div>
     <div class="form-group">
        {!! Form::label('anonymous', 'Anonymous') !!}
        {!! Form::number('anonymous', null, ['class'=>'form-control']) !!}
     </div>
     @if($patient->is_admitted == 1)
     <div class="form-group">
        {!! Form::label('bed', 'Bed Prize per night') !!}
        {!! Form::number('bed', null, ['class'=>'form-control']) !!}
     </div>
     @endif
     {{csrf_field()}}
    <div class="form-group">
      {!! Form::submit('Calculate', ['class'=>'btn btn-primary'])!!}
    </div>
    {!! Form::close() !!}
                            
                
   
  </div>
</div>
  </div>
  <!-- /.box-body -->
  <div class="box-footer">
   
  </div>

  @stop