@extends('backend.master')
@section('mainContent')
<div class="content row">
  <div class="col-md-10">
    <div class="row">
      <div class="col-lg-8">
        <h1>Manage Attendance Report</h1>
      </div>
      <div class="col-lg-4">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
          <li class="breadcrumb-item active">Attendance Report</li>
        </ol>
      </div>
    </div>
  </div>    
  <div class="col-md-10">
    <div class="card pt-1">
      <div class="card-header">
        <h3>Search Criteria</h3>
      </div>
      <div class="card-body">
       <form action="{{route('attendance-get')}}" id="myForm" method="get" target="_blank">
         <div class="form-row">
           <div class="form-group col-md-3">
              <label for="year_id">Employee Name</label>
               <select name="employee_id" id="employee_id" class="form-control select2bs4">
                  <option value="">Select Employee</option>
                  @foreach($employees as $employee)
                    <option class="form-control" value="employee_id">{{$employee->name}}</option>
                  @endforeach
               </select>
           </div>
           <div class="form-group col-md-3">
              <label for="class_id">Date</label>
              <input type="date" name="date" class="form-control" placeholder="DD-MM-YY">
           </div>
           <div class="form-group col-md-3" style="padding-top: 30px">
              <button type="submit" class="btn btn-primary" name="search">Submit</button>
           </div>
         </div>
       </form>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function() {
    $('#myForm').validate({
      rules: {
        "employee_id" : {
          required: true,
        }, 
        "date" : {
          required: true,
        }, 
        
      },
      messages : {

      },
      errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
        element.closest('.form-group').append(error);
      },
      highlight: function(element, errorClass, validClass) {
          $(element).addClass('is-invalid');
        },
      unhighlight: function(element, errorClass, validClass) {
          $(element).removeClass('is-invalid');
        }

    });
  });
 </script>
@endsection