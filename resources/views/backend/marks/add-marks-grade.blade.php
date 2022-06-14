z@extends('backend.master')
@section('mainContent')
<div class="card col-md-6 m-3 pt-3">
    <div class="card-header">
        @if(isset($editData))
        <strong>Edit</strong> Grade Point 
        @else
        <strong>Add</strong> Grade Point 
        @endif
        <a href="{{route('view-marks-grade')}}"  type="button" class="btn btn-primary float-right active col-md-4">
          <i class="fa fa-list"></i> Grade Point  List
         </a>
     </div>
     
     <form action="{{(@$editData)?route('update-marks-grade',$editData->id):route('store-marks-grade')}}" method="post" id="myForm">
        @csrf
        <div class="card-body">
          <div class="form-row">
            <div class="form-group col-md-4">
              <label>Grade Name</label>
              <input type="text" name="grade_name" value="{{@$editData->grade_name}}" class="form-control">
            </div>
            <div class="form-group col-md-4">
              <label>Grade Point</label>
              <input type="text" name="grade_point" value="{{@$editData->grade_point}}" class="form-control">
            </div>
            <div class="form-group col-md-4">
              <label>Start Marks</label>
              <input type="text" name="start_marks" value="{{@$editData->start_marks}}" class="form-control">
            </div>
            <div class="form-group col-md-4">
              <label>End Marks</label>
              <input type="text" name="end_marks" value="{{@$editData->end_marks}}" class="form-control">
            </div>
            <div class="form-group col-md-4">
              <label>Start Point</label>
              <input type="text" name="start_point" value="{{@$editData->start_point}}" class="form-control">
            </div>
            <div class="form-group col-md-4">
              <label>End Point</label>
              <input type="text" name="end_point" value="{{@$editData->end_point}}" class="form-control">
            </div>
            <div class="form-group col-md-4">
              <label>Remarks</label>
              <input type="text" name="remarks" value="{{@$editData->remarks}}" class="form-control">
            </div>
            <div class="form-group col-md-4" style="padding-top: 30px">
               <button type="submit"  class="btn btn-success">{{(@$editData) ? 'Update' : 'Submit'}}</button>
            </div>
          </div>
        </div>
     </form>
 </div>
<script type="text/javascript">
  $(document).ready(function() {
    $('#myForm').validate({
      rules: {
        "grade_name" : {
          required: true,
        },
        "grade_point" : {
          required: true,
        }, 
        "start_marks" : {
          required: true,
        },  
        "end_marks" : {
          required: true,
        }, 
        "start_point" : {
          required: true,
        }, 
        "end_point" : {
          required: true,
        },  
        "remarks" : {
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