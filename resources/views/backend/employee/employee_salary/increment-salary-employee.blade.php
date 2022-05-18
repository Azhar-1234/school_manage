@extends('backend.master')

@section('mainContent')
<div class="card col-md-6 m-3 pt-3">
    <div class="card-header ">
        <strong>Increment</strong> Salary Employee
          <a href="{{route('view-salary-employee')}}"  type="button" class="btn btn-primary float-right active"><i class="fa fa-list"></i> Increment Salary List</a>
     </div>
     <form action="{{route('store-salary-employee',$editData->id)}}" method="post" id="myForm" enctype="multipart/form-data" class="">
        @csrf
          <div class="card-body card-block row">
                <div class="form-exam col-md-6">
                  <label for="exampleInputName2"  class="pr-1  form-control-label">Salary Amount</label>
                  <input type="number" name="increment_salary" class="form-control">
                  <font style="color: red">{{($errors->has('name'))? ($errors->first('name')):''}}</font>
                </div>
                <div class="form-exam col-md-6">
                  <label for="exampleInputName2"  class="pr-1  form-control-label">Effected Date</label>
                  <input type="text" name="effected_date" class="form-control singledatepicker">
                  <font style="color: red">{{($errors->has('name'))? ($errors->first('name')):''}}</font>
                </div>
           </div>
          <div class="card-footer">
              <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-dot-circle-o"></i>Submit</button> 
              <button type="reset" class="btn btn-danger btn-sm">  <i class="fa fa-ban"></i> Reset </button>
          </div>
     </form>
 </div>
 <script type="text/javascript">
  $(document).ready(function() {
    $('#myForm').validate({
      rules: {
        "increment_salary" : {
          required: true,
        },
        "effected_date" : {
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