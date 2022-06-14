@extends('backend.master')
@section('mainContent')
<div class="content row">
  <div class="col-md-10">
    <div class="row">
      <div class="col-lg-8">
        <h1>Manage Result</h1>
      </div>
      <div class="col-lg-4">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
          <li class="breadcrumb-item active">Result</li>
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
       <form action="{{route('result-get')}}" id="myForm" method="get" target="_blank">
         <div class="form-row">
           <div class="form-group col-md-3">
              <label for="year_id">Year</label>
               <select name="year_id" id="year_id" class="form-control select2bs4">
                  <option value="">Select years name</option>
                  @foreach($years as $year)
                    <option class="form-control">{{$year->name}}</option>
                  @endforeach
               </select>
           </div>
           <div class="form-group col-md-3">
              <label for="class_id">Class</label>
               <select name="class_id" id="class_id" class="form-control select2bs4">
                  <option value="">Select Class</option>
                  @foreach($classes as $class)
                    <option class="form-control">{{$class->name}}</option>
                  @endforeach
               </select>
           </div>
           <div class="form-group col-md-3">
              <label for="exam_type_id">Exam Type</label>
               <select name="exam_type_id" id="exam_type_id" class="form-control select2bs4">
                  <option value="">Select Exam Type</option>
                  @foreach($exam_types as $exam_type)
                    <option class="form-control">{{$exam_type->name}}</option>
                  @endforeach
               </select>
           </div>
           
           <div class="form-group col-md-3" style="margin-top: 30px">
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
        "year_id" : {
          required: true,
        }, 
        "class_id" : {
          required: true,
        },
        "exam_type_id" : {
          required: true,
        },  
        "id_no" : {
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