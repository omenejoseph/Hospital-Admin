@extends('layouts.admin')



@section('content')

<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">{{$patient->name}} personal data information</h3>


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
        <th>Name</th>
        <th>email</th>
        <th>status</th>
        <th>Address</th>
        <th>Admitted By</th>
        <th>Discharged By</th>
        <th>Discharged At</th>
        <th>Bill</th>
        <th>Gender</th>
        <th>Marital Status</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td >{{$patient->name}}</td>
        <td>{{$patient->email}}</td>
        <td>
        @if($patient->bed_numbr == 0)
            Unadmitted
        @else
            Admitted
        @endif
        </td>
        <td>{{$patient->address}}</td>
        <td>{{$patient->admitted_by}}</td>
        <td>
            @if($patient->is_admitted == 1)
                Still on Admission
            @else
                {{$patient->discharged_by}}
            @endif
        </td>
        <td>
            @if($patient->is_admitted == 1)
                Still on Admission
            @else
                {{$patient->discharged_at}}
            @endif
        </td>
        <td>
            @if($patient->is_admitted == 1)
                0.00
            @else
                {{$patient->discharge_bill}}
            @endif
        </td>
        <td>{{$patient->sex}}</td>
        <td>{{$patient->marital_stat}}</td>
      </tr>
    </tbody>
  </table>
  </div>
  <!-- /.box-body -->
  <div class="box-footer">
    
  </div>

<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title"><i>Patient History</i></h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
        <i class="fa fa-minus"></i></button>
      <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
        <i class="fa fa-times"></i></button>
    </div>
  </div>
  <div class="box-body" id="historyField">{{$patient->history}}</div>
  <!-- /.box-body -->
  <div class="box-footer">
  <button class="btn btn-primary patientHistory" data-title='Patient History' data-url='{{url("admin/patients/update")}}' data-id='{{$patient->id}}'>Update Data</button>
  </div>
  <!-- /.box-footer-->
</div>

<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title"><i>Patient Presenting Conditions</i></h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
        <i class="fa fa-minus"></i></button>
      <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
        <i class="fa fa-times"></i></button>
    </div>
  </div>
  <div class="box-body" id="patientCondField">{{$patient->cond}}</div>
  <!-- /.box-body -->
  <div class="box-footer">
  <button class="btn btn-primary patientCond" data-title='Patient Condition' data-url='{{url("admin/patients/update")}}' data-id='{{$patient->id}}'>Update Data</button>
  </div>
  <!-- /.box-footer-->
</div>

<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title"><i>Patient Allergies</i></h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
        <i class="fa fa-minus"></i></button>
      <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
        <i class="fa fa-times"></i></button>
    </div>
  </div>
  <div class="box-body patientAllergyField">{{$patient->allergies}}</div>
  <!-- /.box-body -->
  <div class="box-footer">
  <button class="btn btn-primary patientAllerg" data-title='Patient Allergies' data-url='{{url("admin/patients/update")}}' data-id='{{$patient->id}}'>Update Data</button>

  </div>
  <!-- /.box-footer-->
</div>

<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title"><i>Patient Diagnosis</i></h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
        <i class="fa fa-minus"></i></button>
      <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
        <i class="fa fa-times"></i></button>
    </div>
  </div>
  <div class="box-body patientDiagField">{{$patient->diag}}</div>
  <!-- /.box-body -->
  <div class="box-footer">
  <button class="btn btn-primary patientDiag" data-title='Patient Diagnosis' data-url='{{url("admin/patients/update")}}' data-id='{{$patient->id}}'>Update Data</button>

  </div>
  <!-- /.box-footer-->
</div>

<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title"><i>Patient Vitals</i></h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
        <i class="fa fa-minus"></i></button>
      <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
        <i class="fa fa-times"></i></button>
    </div>
  </div>
  <div class="box-body patientVitalsField">{{$patient->vitals}}</div>
  <!-- /.box-body -->
  <div class="box-footer">
  <button class="btn btn-primary patientVitals" data-title='Patient Vitals' data-url='{{url("admin/patients/update")}}' data-id='{{$patient->id}}'>Update Data</button>
 
  </div>
  <!-- /.box-footer-->
</div>

<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title"><i> Patient Current Prescriptions </i></h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
        <i class="fa fa-minus"></i></button>
      <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
        <i class="fa fa-times"></i></button>
    </div>
  </div>
  <div class="box-body patientMedsField" >{{$patient->meds}}</div>
  <!-- /.box-body -->
  <div class="box-footer">
  <button class="btn btn-primary patientMeds" data-title='Patient Current Prescriptions' data-url='{{url("admin/patients/update")}}' data-id='{{$patient->id}}'>Update Data</button>

  </div>
  <!-- /.box-footer-->
</div>

<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title"><i>Patient Laboratory Test Results</i></h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
        <i class="fa fa-minus"></i></button>
      <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
        <i class="fa fa-times"></i></button>
    </div>
  </div>
  <div class="box-body patientLabsField">{{$patient->labs}}</div>
  <!-- /.box-body -->
  <div class="box-footer">
  <button class="btn btn-primary patientLabs" data-title='Patient Lab-Tests Results' data-url='{{url("admin/patients/update")}}' data-id='{{$patient->id}}'>Update Data</button>
  
  </div>
  <!-- /.box-footer-->
</div>
<!-- History Modal start-->
<div id="historyModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="modalTitle"></h4>
      </div>
      <div class="modal-body">
        <form id="patient-history-form" data-parsley-validate="" >
            <div class="form-group col-xs-12">
                            
                 <div class="col-xs-12">

                    <textarea name="Input" id="InputId" cols="70" rows="10"></textarea>
                     
                </div>
                <br><br>
                <div class="col-xs-12">
                    <div class="input-group pad-up pull-right">
                        <button type="button" class="btn btn-default margin-right" data-dismiss="modal">Cancel</button>
                         <button type="submit"  data-toggle-data='' id="patient-history-btn" class="btn btn-info"><i class="fa fa-delete"></i> Update</button>
        
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


  @stop
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"> </script>
  <script>
  if (typeof jQuery === "undefined") {
    throw new Error("admin requires jQuery");
}

console.log('hello');

    $(function (){
  
        $('.patientHistory').on('click', function (e) {
          e.preventDefault();
          // console.log('hello2');
          var getValueFromDiv = $('#historyField').text()
          var getIdFromBtn = $(this).data('id');
          var getUrlFromData = $(this).data('url');
          var getModalTitle = $(this).data('title'); 

           $("#InputId").val(getValueFromDiv);
           $("#modalTitle").text(getModalTitle);
          // console.log(getIdFromBtn);
          $('#historyModal').modal();

           var form = $('#patient-history-form');
            form.submit(function(e) {
                
            e.preventDefault();
            var id = getIdFromBtn;
            var url = getUrlFromData;
            var formData = form.serializeArray();
            formData.push({name: 'id', value: id});
            formData.push({name: '_method', value: 'PATCH'});
            formData.push({name: 'history', value: 'history'});
            console.log(formData);
            
            $('#patient-history-btn').html("<i class='fa fa-spinner fa-spin' aria-hidden='true'></i> Updating...");
            $('#patient-history-btn').attr('disabled', true);

             $.ajaxSetup({
                         headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    
        
                $.ajax({
                    url     : url,
                    type    : 'POST',
                    data    : formData,
                    dataType: 'json',
                  
                    success : function ( json )
                    {
                        // var message = json.responseJSON;
                            alert('successfully updated');
                        // Success
                        // Do something like redirect them to the dashboard...
                        
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
                    }
                
            });


            });

        });

         $('.patientCond').on('click', function (e) {
          e.preventDefault();
          // console.log('hello2');
          var getValueFromDiv = $('#patientCondField').text()
          var getIdFromBtn = $(this).data('id');
          var getUrlFromData = $(this).data('url');
          var getModalTitle = $(this).data('title'); 

           $("#InputId").val(getValueFromDiv);
           $("#modalTitle").text(getModalTitle);
          // console.log(getIdFromBtn);
          $('#historyModal').modal();

           var form = $('#patient-history-form');
            form.submit(function(e) {
                
            e.preventDefault();
            var id = getIdFromBtn;
            var url = getUrlFromData;
            var formData = form.serializeArray();
            formData.push({name: 'id', value: id});
            formData.push({name: '_method', value: 'PATCH'});
            formData.push({name: 'cond', value: 'cond'});
            console.log(formData);
            
            $('#patient-history-btn').html("<i class='fa fa-spinner fa-spin' aria-hidden='true'></i> Updating...");
            $('#patient-history-btn').attr('disabled', true);

             $.ajaxSetup({
                         headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    
        
                $.ajax({
                    url     : url,
                    type    : 'POST',
                    data    : formData,
                    dataType: 'json',
                  
                    success : function ( json )
                    {
                        // var message = json.responseJSON;
                            alert('successfully updated');
                        // Success
                        // Do something like redirect them to the dashboard...
                        
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
                    }
                
            });


            });

        });

         $('.patientAllerg').on('click', function (e) {
          e.preventDefault();
          // console.log('hello2');
          var getValueFromDiv = $('#patientAllergyField').text()
          var getIdFromBtn = $(this).data('id');
          var getUrlFromData = $(this).data('url');
          var getModalTitle = $(this).data('title'); 

           $("#InputId").val(getValueFromDiv);
           $("#modalTitle").text(getModalTitle);
          // console.log(getIdFromBtn);
          $('#historyModal').modal();

           var form = $('#patient-history-form');
            form.submit(function(e) {
                
            e.preventDefault();
            var id = getIdFromBtn;
            var url = getUrlFromData;
            var formData = form.serializeArray();
            formData.push({name: 'id', value: id});
            formData.push({name: '_method', value: 'PATCH'});
            formData.push({name: 'allergy', value: 'allergy'});
            console.log(formData);
            
            $('#patient-history-btn').html("<i class='fa fa-spinner fa-spin' aria-hidden='true'></i> Updating...");
            $('#patient-history-btn').attr('disabled', true);

             $.ajaxSetup({
                         headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    
        
                $.ajax({
                    url     : url,
                    type    : 'POST',
                    data    : formData,
                    dataType: 'json',
                  
                    success : function ( json )
                    {
                        // var message = json.responseJSON;
                            alert('successfully updated');
                        // Success
                        // Do something like redirect them to the dashboard...
                        
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
                    }
                
            });


            });

        });

         $('.patientDiag').on('click', function (e) {
          e.preventDefault();
          // console.log('hello2');
          var getValueFromDiv = $('#patientDiagField').text()
          var getIdFromBtn = $(this).data('id');
          var getUrlFromData = $(this).data('url');
          var getModalTitle = $(this).data('title'); 

           $("#InputId").val(getValueFromDiv);
           $("#modalTitle").text(getModalTitle);
          // console.log(getIdFromBtn);
          $('#historyModal').modal();

           var form = $('#patient-history-form');
            form.submit(function(e) {
                
            e.preventDefault();
            var id = getIdFromBtn;
            var url = getUrlFromData;
            var formData = form.serializeArray();
            formData.push({name: 'id', value: id});
            formData.push({name: '_method', value: 'PATCH'});
            formData.push({name: 'diag', value: 'diag'});
            console.log(formData);
            
            $('#patient-history-btn').html("<i class='fa fa-spinner fa-spin' aria-hidden='true'></i> Updating...");
            $('#patient-history-btn').attr('disabled', true);

             $.ajaxSetup({
                         headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    
        
                $.ajax({
                    url     : url,
                    type    : 'POST',
                    data    : formData,
                    dataType: 'json',
                  
                    success : function ( json )
                    {
                        // var message = json.responseJSON;
                            alert('successfully updated');
                        // Success
                        // Do something like redirect them to the dashboard...
                        
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
                    }
                
            });


            });

        });

         $('.patientVitals').on('click', function (e) {
          e.preventDefault();
          // console.log('hello2');
          var getValueFromDiv = $('#patientVitalsField').text()
          var getIdFromBtn = $(this).data('id');
          var getUrlFromData = $(this).data('url');
          var getModalTitle = $(this).data('title'); 

           $("#InputId").val(getValueFromDiv);
           $("#modalTitle").text(getModalTitle);
          // console.log(getIdFromBtn);
          $('#historyModal').modal();

           var form = $('#patient-history-form');
            form.submit(function(e) {
                
            e.preventDefault();
            var id = getIdFromBtn;
            var url = getUrlFromData;
            var formData = form.serializeArray();
            formData.push({name: 'id', value: id});
            formData.push({name: '_method', value: 'PATCH'});
            formData.push({name: 'vitals', value: 'vitals'});
            console.log(formData);
            
            $('#patient-history-btn').html("<i class='fa fa-spinner fa-spin' aria-hidden='true'></i> Updating...");
            $('#patient-history-btn').attr('disabled', true);

             $.ajaxSetup({
                         headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    
        
                $.ajax({
                    url     : url,
                    type    : 'POST',
                    data    : formData,
                    dataType: 'json',
                  
                    success : function ( json )
                    {
                        // var message = json.responseJSON;
                            alert('successfully updated');
                        // Success
                        // Do something like redirect them to the dashboard...
                        
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
                    }
                
            });


            });

        });

         $('.patientMeds').on('click', function (e) {
          e.preventDefault();
          // console.log('hello2');
          var getValueFromDiv = $('#patientMedsField').text()
          var getIdFromBtn = $(this).data('id');
          var getUrlFromData = $(this).data('url');
          var getModalTitle = $(this).data('title'); 

           $("#InputId").val(getValueFromDiv);
           $("#modalTitle").text(getModalTitle);
          // console.log(getIdFromBtn);
          $('#historyModal').modal();

           var form = $('#patient-history-form');
            form.submit(function(e) {
                
            e.preventDefault();
            var id = getIdFromBtn;
            var url = getUrlFromData;
            var formData = form.serializeArray();
            formData.push({name: 'id', value: id});
            formData.push({name: '_method', value: 'PATCH'});
            formData.push({name: 'meds', value: 'meds'});
            console.log(formData);
            
            $('#patient-history-btn').html("<i class='fa fa-spinner fa-spin' aria-hidden='true'></i> Updating...");
            $('#patient-history-btn').attr('disabled', true);

             $.ajaxSetup({
                         headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    
        
                $.ajax({
                    url     : url,
                    type    : 'POST',
                    data    : formData,
                    dataType: 'json',
                  
                    success : function ( json )
                    {
                        // var message = json.responseJSON;
                            alert('successfully updated');
                        // Success
                        // Do something like redirect them to the dashboard...
                        
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
                    }
                
            });


            });

        }); 

         $('.patientLabs').on('click', function (e) {
          e.preventDefault();
          // console.log('hello2');
          var getValueFromDiv = $('#patientLabsField').text()
          var getIdFromBtn = $(this).data('id');
          var getUrlFromData = $(this).data('url');
          var getModalTitle = $(this).data('title'); 

           $("#InputId").val(getValueFromDiv);
           $("#modalTitle").text(getModalTitle);
          // console.log(getIdFromBtn);
          $('#historyModal').modal();

           var form = $('#patient-history-form');
            form.submit(function(e) {
                
            e.preventDefault();
            var id = getIdFromBtn;
            var url = getUrlFromData;
            var formData = form.serializeArray();
            formData.push({name: 'id', value: id});
            formData.push({name: '_method', value: 'PATCH'});
            formData.push({name: 'labs', value: 'labs'});
            console.log(formData);
            
            $('#patient-history-btn').html("<i class='fa fa-spinner fa-spin' aria-hidden='true'></i> Updating...");
            $('#patient-history-btn').attr('disabled', true);

             $.ajaxSetup({
                         headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    
        
                $.ajax({
                    url     : url,
                    type    : 'POST',
                    data    : formData,
                    dataType: 'json',
                  
                    success : function ( json )
                    {
                        // var message = json.responseJSON;
                            alert('successfully updated');
                        // Success
                        // Do something like redirect them to the dashboard...
                        
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
                    }
                
            });


            });

        });

        
      }); 
  </script>