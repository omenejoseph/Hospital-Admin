@extends('layouts.admin')



@section('content')


<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Admit Patient</h3>

  </div>
  <div class="box-body">
    
  <div class="form-group">
       {!! Form::open(['method'=>'POST', 'action'=>'AdminPatientsController@store'])!!}
       
     <div class="form-group">
        {!! Form::label('name', 'NAME') !!}
        {!! Form::text('name', null, ['class'=>'form-control']) !!}
     </div>
     <div class="form-group">
        {!! Form::label('email', 'EMAIL') !!}
        {!! Form::email('email', null, ['class'=>'form-control']) !!}
     </div>
     <div class="form-group">
        {!! Form::label('address', 'ADDRESS') !!}
        {!! Form::textarea('address', null, ['class'=>'form-control']) !!}
     </div>
     <div class="form-group">
        {!! Form::label('history', 'HISTORY') !!}
        {!! Form::textarea('history', null, ['class'=>'form-control']) !!}
     </div>
     <div class="form-group">
        {!! Form::label('cond', 'CONDITION DESCRPTION') !!}
        {!! Form::textarea('cond', null, ['class'=>'form-control']) !!}
     </div>
     <div class="form-group">
        {!! Form::label('allergies', 'ALLERGIES') !!}
        {!! Form::textarea('allergies', null, ['class'=>'form-control']) !!}
     </div>
     <div class="form-group">
        {!! Form::label('marital_stat', 'MARITAL STATUS') !!}
        {!! Form::select('marital_stat', [ ''=> 'Choose Options', 'SINGLE'=> 'SINGLE', 'MARRIED'=> 'MARRIED' ], null, ['class'=>'form-control']) !!}
     </div>
     <div class="form-group">
        {!! Form::label('sex', 'GENDER') !!}
        {!! Form::select('sex', [ ''=> 'Choose Options', 'MALE'=> 'MALE', 'FEMALE'=> 'FEMALE' ], null, ['class'=>'form-control']) !!}
     </div>
     <div class="form-group">
        {!! Form::label('diag', 'DIAGNOSIS') !!}
        {!! Form::textarea('diag', null, ['class'=>'form-control']) !!}
     </div>
     <div class="form-group">
        {!! Form::label('vitals', 'VITALS') !!}
        {!! Form::textarea('vitals', null, ['class'=>'form-control']) !!}
     </div>
     <div class="form-group">
        {!! Form::label('meds', 'PRESCRIBED MEDS') !!}
        {!! Form::textarea('meds', null, ['class'=>'form-control']) !!}
     </div>
     <div class="form-group">
        {!! Form::label('labs', 'LABORATORY RESULTS') !!}
        {!! Form::textarea('labs', null, ['class'=>'form-control']) !!}
     </div>
     <div class="form-group">
     <select class="form-control" name="bed_numbr">
         <option value="">Choose Bed</option>
       @foreach($beds as $bed) 
          <option value="{{ $bed->id }}">{{ $bed->name }}</option>
       @endforeach
        </select>
     </div>
        {{csrf_field()}}
    <div class="form-group">
      {!! Form::submit('ADMIT', ['class'=>'btn btn-primary'])!!}
    </div>
    {!! Form::close() !!}


  </div>
  @include('elements.errors')
</div>



@stop