@extends('layouts.admin')



@section('content')

<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">View All Staff</h3>


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
  
  </div>
@endif  
<!-- /.Alert div for feedback end-->

  </div> <!-- /.first box-header end -->
  <div class="box-body">
  <table class="table table-striped">
    <thead>
      <tr>
      <th>S/N</th>
        <th>Name</th>
        <th>email</th>
        <th>Qualification</th>
        <th>Has Query</th>
        <th>Department</th>
        <th>Photo</th>
      </tr>
    </thead>
    <tbody>
    @foreach ($users as $key => $user)
      <tr>
        <td>{{$key + 1}}</td>
        <td>{{$user->name}}</td>
        <td>{{$user->email}}</td>
        <td>{{$user->highest_qual}}</td>
        
        @if($user->has_query == 0)
          <td>Yes</td>
        @else
          <td>No</td>
        @endif
        
        <td>{{$user->dept->name}}</td>
        <td>
        @if($user->photo())
        <img src="{{  URL::to('/') }}/images/{{ $user->photo['file_name']  }}" alt="profile picture" class="img-responsive img-rounded" height="60" width="60"/>
        @else
        <img src="{{  URL::to('/') }}/images/default.png" alt="profile picture" class="img-responsive img-rounded" height="60" width="60"/>
        </td>
        @endif
        <td>
        {{ Form::model($user, array('route' => array('admin.staff.edit', $user->id), 'method' => 'GET')) }}            
                    {{ Form::submit('Edit Info', array('class' => 'btn btn-info')) }}
        {{ Form::close() }}
        </td>
      </tr>
@endforeach      
    </tbody>
  </table>
  </div>
  <!-- /.box-body -->
  <div class="box-footer">
    This is a list of staff of the hospital
  </div>
  <!-- /.box-footer-->
</div>


@stop