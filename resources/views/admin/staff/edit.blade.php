@extends('layouts.admin')



@section('content')


<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Edit Staff</h3>

  </div>
  <div class="box-body">
    
  <div class="form-group">
  {{ Form::model($user, array('route' => array('admin.staff.update', $user->id), 'method' => 'PATCH', 'files'=>true)) }}
       
     <div class="form-group">
        {!! Form::label('name', 'NAME') !!}
        {!! Form::text('name', null, ['class'=>'form-control']) !!}
     </div>
     <div class="form-group">
        {!! Form::label('email', 'EMAIL') !!}
        {!! Form::email('email', null, ['class'=>'form-control']) !!}
     </div>
     <div class="form-group">
        {!! Form::label('role_id', 'ROLE') !!}
        {!! Form::select('role_id', [ ''=> 'Choose Options' ] + $role, null, ['class'=>'form-control']) !!}
     </div>
     <div class="form-group">
        {!! Form::label('highest_qual', 'QUALIFICATION') !!}
        {!! Form::text('highest_qual', null, ['class'=>'form-control']) !!}
     </div>
     <div class="form-group">
        {!! Form::label('dept', 'DEPARTMENT') !!}
        {!! Form::select('dept_id', [ ''=> 'Choose Options' ] + $dept, null, ['class'=>'form-control']) !!}
     </div>
     <div class="form-group">
        {!! Form::label('file_name', 'PROFILE PICTURE') !!}
        {!! Form::file('file_name', null, ['class'=>'form-control']) !!}
     </div>
     <div class="form-group">
        {!! Form::label('password', 'PASSWORD') !!}
        {!! Form::password('password', ['class'=>'form-control']) !!}
     </div>
     
        {{csrf_field()}}
    <div class="form-group">
      {!! Form::submit('UPDATE', ['class'=>'btn btn-primary'])!!}
    </div>



  </div>
  @include('elements.errors')
</div>



@stop