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
	<div id="formSuccess"></div>
  </div>
  
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
        <th>Qualification</th>
        <th>Status</th>
        <th>Department</th>
        <th>Photo</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
    @foreach ($users as $key => $user)
      <tr>
        <td>{{$key + 1}}</td>
        <td >{{$user->name}}</td>
        <td>{{$user->email}}</td>
        <td>{{$user->highest_qual}}</td>
        
        @if($user->is_approved == 1)
          <td>Approved</td>
        @else
          <td>Unapproved</td>
        @endif
        
        <td>{{$user->dept->name}}</td>
        <td>
        @if($user->photo())
        <img src="{{  URL::to('/') }}/images/{{ $user->photo['file_name']  }}" alt="profile picture" class="img-responsive img-rounded" height="60" width="60"/>
        @else
        <img src="{{  URL::to('/') }}/images/default.png" alt="profile picture" class="img-responsive img-rounded" height="60" width="60"/>
        </td>
        @endif
      
        <td class="text-center">
        
             <div class="dropdown">
                 <i class="dropdown-toggle fa fa-gears" data-toggle="dropdown"></i>
                    <ul class="dropdown-menu dropdown-menu-left">
                    <li><a href="javascript:void(0);" 
                    data-id="{{$user->id}}"
                    data-name="{{$user->name}}" 
                    data-email= "{{$user->email}}"
                    data-qual= "{{$user->highest_qual}}"
                    data-dept= "{{$user->dept->name}}"
                    data-url='{{url("admin/staff/update")}}'
                    class="edit-modal"><i class="fa fa-edit"></i> Edit User</a></li>
                        <li><a href="javascript:void(0);" class="status-modal" data-id="{{$user->id}}" data-url="{{url('status/approve')}}"><i class="fa fa-edit"></i> Approve/Unapprove </a></li>
                        <li><a href="javascript:void(0);" class="delete-modal" data-id="{{$user->id}}" data-url='{{url("admin/staff/delete")}}'><i class="fa fa-trash"></i> Delete User</a></li>
                    </ul>
               </div>
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
<!-- /.myModal starts-->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
        <form id="edit-user-form" data-parsley-validate="" enctype="multipart/form-data">
             <div class="form-group col-xs-12">
                <label for="input-edit-name">NAME <i class="text-danger">*</i> :</label>
                <input name="name" type="text" class="form-control" id="input-edit-name" placeholder="Full Name" required/>
            </div>
            <div class="form-group col-xs-12">
                <label for="input-edit-email">EMAIL <i class="text-danger">*</i> :</label>
                <input name="email" type="text" class="form-control" id="input-edit-email" placeholder="Email" required/>
            </div>
            <div class="form-group col-xs-12">
                <label for="input-edit-role">ROLE <i class="text-danger">*</i> :</label>
                <select class="form-control" name="role_id" id="input-edit-role">
                @foreach($roles as $role)
                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                @endforeach
                </select>
            </div> 
            <div class="form-group col-xs-12">
                <label for="input-edit-qual">QUALIFICATIONS <i class="text-danger">*</i> :</label>
                <input name="highest_qual" type="text" class="form-control" id="input-edit-qual" placeholder="Qualification" required/>
            </div>
            <div class="form-group col-xs-12">
                <label for="input-edit-dept">DEPARTMENT <i class="text-danger">*</i> :</label>
                 <select class="form-control" name="dept_id" id="input-edit-dept">
                 @foreach($depts as $dept)
                         <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-xs-12">
                <label for="input-edit-pic">PICTURE <i class="text-danger">*</i> :</label>
                <input name="file" type="file" class="form-control" id="input-edit-pic"/>
            </div>
            <div class="col-xs-12">
                <div class="input-group pad-up pull-right">
                     <button type="button" class="btn btn-default margin-right" data-dismiss="modal">Cancel</button>
                     <button type="submit" data-id='' data-toggle-data='' id="user-edit-send-btn" class="btn btn-primary"><i class="fa fa-edit"></i> Edit</button>
                </div>
            </div>
        </form>
                             
        </div>
      <div class="modal-footer">
    <div class="alert-danger" id="myErrors"></div>
      
        <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
      </div>
    </div>
    
  </div>
</div> <!-- /.myModal ends-->
<!-- /.status modal starts-->
<div id="statusModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Hello {{auth()->user()->name}}</h4>
      </div>
      <div class="modal-body">
        <form id="user-status-form" data-parsley-validate="" >
            <div class="form-group col-xs-12">
                            
                 <div class="col-xs-12">
                        <select name="status" id="statusId">
                            <option value="1">Approve</option>
                            <option value="0">Unapprove</option>
                        </select>
                    
                </div>
                <div class="col-xs-12">
                    <div class="input-group pad-up pull-right">
                        <button type="button" class="btn btn-default margin-right" data-dismiss="modal">Cancel</button>
                         <button type="submit" data-id='' data-toggle-data='' id="user-status-btn" class="btn btn-info"><i class="fa fa-edit"></i> Submit </button>
        
                     </div>
           </div>
                    
         </form>
                            
      </div>
      <div class="modal-footer">
      <div class="alert-danger" id="myErrors"></div>
      
        <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
      </div>
    </div>
    
  </div>
</div>
</div>
<!-- /.status modal ends-->
<!-- /.delete modal starts-->
<div id="deleteModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Hello {{auth()->user()->name}}</h4>
      </div>
      <div class="modal-body">
        <form id="user-delete-form" data-parsley-validate="" >
            <div class="form-group col-xs-12">
                            
                 <div class="col-xs-12">
                        Are you Sure you want to delete <span class="title"></span> ?
                    
                </div>
                <div class="col-xs-12">
                    <div class="input-group pad-up pull-right">
                        <button type="button" class="btn btn-default margin-right" data-dismiss="modal">Cancel</button>
                         <button type="submit" data-id='' data-toggle-data='' id="user-delete-btn" class="btn btn-danger"><i class="fa fa-delete"></i> Delete</button>
        
                     </div>
           </div>
                    
         </form>
                            
      </div>
      <div class="modal-footer">
      <div class="alert-danger" id="myErrors"></div>
      
        <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
      </div>
    </div>
    
  </div>
</div>
</div>





@stop
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"> </script>
<script>
if (typeof jQuery === "undefined") {
    throw new Error("admin requires jQuery");
}


    $(document).on('click', '.edit-modal', function() {
            var getIdFromRow = $(this).data('id');
            var getNameFromRow = $(this).data('name');
            var getEmailFromRow = $(this).data('email');
            var getRoleIdFromRow = $(this).data('role_id');
            var getQualFromRow = $(this).data('qual');
            var getDeptFromRow = $(this).data('dept');
            var getUrlFromRow = $(this).data('url');
            
            
            $("#input-edit-name").val(getNameFromRow);
            $("#input-edit-email").val(getEmailFromRow);
            $("#input-edit-qual").val(getQualFromRow);
            // $("#input-edit-qual").val(getQualFromRow);
            // $("#input-edit-dept").val(getDeptFromRow);
        
        $('#myModal').modal('show');
        
        var form = $('#edit-user-form');
            form.submit(function(e) {
                e.preventDefault();                
                var id = getIdFromRow;
                var url = getUrlFromRow;
                var formData = form.serializeArray();
                    formData.push({name: '_method', value:'PUT'});
                    formData.push({name: 'id', value: id});                
                console.log(formData);              

                $('#edit-user-form #user-edit-send-btn').html("<i class='fa fa-spinner fa-spin' aria-hidden='true'></i> Updating...");
                $('#user-edit-send-btn').attr('disabled', true);
                    $.ajaxSetup({
                         headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                 $.ajax({
                    url     :  url,
                    type    : 'POST',
                    data    : formData,
                    dataType: 'json',
                    success : function ( json )
                    {
                            var message = '';
                            $.each(json.responseJSON, function (key, value) {
                                message += '<li>' + value + '</li>';
                            });
                            $('#formSuccess').html(message);
                            $('#formSuccess').css("display", "block");;
                        // Success
                        // Do something like redirect them to the dashboard...
                        alert('User Updated');
                        window.location.reload();
                    },
                    error: function( json )
                    {
                        if(json.status === 422) {
                            var errors = json.responseJSON;
                            var errorString = '';
                            $.each(json.responseJSON, function (key, value) {
                                errorString += '<li>' + value + '</li>';
                            });
                            $('#myErrors').html(errorString);
                        }
                        else {
                            // Error
                            // Incorrect credentials
                            alert('Please try again.');
                        }
                    }
                });//end of ajax call 
            });//end of edit from submit event
      //end of edit-modal click event              
    });

    $(document).on('click', '.status-modal', function() {
            var getIdFromRow = $(this).data('id');
            var getUrlFromRow = $(this).data('url');
        $('#statusModal').modal('show');
        
        var form = $('#user-status-form');
            form.submit(function(e) {
                e.preventDefault();                
                var id = getIdFromRow;
                var url = getUrlFromRow;
                var formData = form.serializeArray();
                    formData.push({name: '_method', value:'PUT'});
                    formData.push({name: 'id', value: id});                
                console.log(formData); 
                console.log(url);             

                $('#user-status-btn').html("<i class='fa fa-spinner fa-spin' aria-hidden='true'></i> Updating...");
                $('#user-status-btn').attr('disabled', true);
                    $.ajaxSetup({
                         headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                 $.ajax({
                    url     :  url,
                    type    : 'POST',
                    data    : formData,
                    dataType: 'json',
                    success : function ( json )
                    {
                            var message = '';
                            $.each(json.responseJSON, function (key, value) {
                                message += '<li>' + value + '</li>';
                            });
                            $('#formSuccess').html(message);
                            $('#formSuccess').css("display", "block");;
                        // Success
                        // Do something like redirect them to the dashboard...
                        alert('User Updated');
                        window.location.reload();
                    },
                    error: function( json )
                    {
                        if(json.status === 422) {
                            var errors = json.responseJSON;
                            var errorString = '';
                            $.each(json.responseJSON, function (key, value) {
                                errorString += '<li>' + value + '</li>';
                            });
                            $('#myErrors').html(errorString);
                        }
                        else {
                            // Error
                            // Incorrect credentials
                            alert('Please try again.');
                        }
                    }
                });//end of ajax call 
            });//end of edit from submit event
      //end of edit-modal click event              
    });

    $(document).on('click', '.delete-modal', function() {
            var getIdFromRow = $(this).data('id');
            var getUrlFromRow = $(this).data('url');

        $('#deleteModal').modal('show');
 
            var form = $('#user-delete-form');
            form.submit(function(e) {
                e.preventDefault()
            var id = getIdFromRow;
            var url = getUrlFromRow;
            var formData = form.serializeArray();
                formData.push({name: '_method', value:'DELETE'});
                formData.push({name: 'id', value: id});

        $('#user-delete-btn').html("<i class='fa fa-spinner fa-spin' aria-hidden='true'></i> Deleting...");
        $('#user-delete-btn').attr('disabled', true);
         $.ajaxSetup({
                         headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                 $.ajax({
                    url     :  url,
                    type    : 'POST',
                    data    : formData,
                    dataType: 'json',
                    success : function ( json )
                    {
                            var message = '';
                            $.each(json.responseJSON, function (key, value) {
                                message += '<li>' + value + '</li>';
                            });
                            $('#formSuccess').html(message);
                            $('#formSuccess').css("display", "block");;
                        // Success
                        // Do something like redirect them to the dashboard...
                        alert('User Deleted');
                        window.location.reload();
                    },
                    error: function( json )
                    {
                        if(json.status === 422) {
                            var errors = json.responseJSON;
                            var errorString = '';
                            $.each(json.responseJSON, function (key, value) {
                                errorString += '<li>' + value + '</li>';
                            });
                            $('#myErrors').html(errorString);
                        }
                        else {
                            // Error
                            // Incorrect credentials
                            alert('Please try again.');
                        }
                    }
                });//end of ajax call 
            });//end of delete form submit event
      //end of delete-modal click event              
    });

 
       
        
</script>