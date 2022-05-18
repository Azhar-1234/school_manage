@extends('backend.master')
@section('mainContent')
<div class="card col-md-6 m-3 pt-3">
    <div class="card-header">
        @if(isset($editData))
        <strong>Edit</strong> Employee Leave 
        @else
        <strong>Add</strong> Employee Leave
        @endif

        <a href="{{route('view-group')}}"  type="button" class="btn btn-primary float-right active col-md-4">
          <i class="fa fa-list"></i> Employee Leave List
         </a>
     </div>
     <form action="{{@$editData?route('update-leave-employee',$editData->id):('store-leave-employee')}}" method="post" id="myForm" enctype="multipart/form-data" class="">
        @csrf
          <div class="card-body card-block">
            <div class="form-group">
              <label for="exampleInputName2"  class="pr-1  form-control-label">Employee Name</label>                 
              <font style="color: red">{{($errors->has('name'))? ($errors->first('name')):''}}</font>
              <label for="exampleInputName2"  class="pr-1  form-control-label">Designation <font style="color: red">*</font></label><br>
                <select name="employee_id" class="form-control form-control-sm">
                 <option value="">Select Employee</option>
                  @foreach($employees as $employee)
                    <option value="{{$employee->id}}"{{(@$editData->employee_id ==$employee->id)?"selected":''}}> {{$employee->name}}</option>
                  @endforeach
                </select>
              <font style="color: red">{{($errors->has('designation_id'))? ($errors->first('name')):''}}</font>
            </div>
            <div class="form-group">
              <label>Start Date</label>
              <input type="text" name="start_date" value="{{@$editData->start_date}}" placeholder="start date" class="form-control form-control-sm singledatepicker">
            </div>
            <div class="form-group">
              <label>End Date</label>
              <input type="text" name="end_date" value="{{@$editData->end_date}}" placeholder="end date" class="form-control form-control-sm">
            </div>
            <div class="form-group">
              <label for="exampleInputName2"  class="pr-1  form-control-label">Leave purpose Name</label>                 
              <font style="color: red">{{($errors->has('name'))? ($errors->first('name')):''}}</font>
              <font style="color: red">*</font></label><br>
                <select name="leave_purpose_id" id="leave_purpose_id" class="form-control form-control-sm">
                 <option value="">purpose name</option>
                  @foreach($leave_purpose as $purpose)
                    <option value="{{$purpose->id}}"{{(@$editData->leave_purpose_id==$purpose->id)?"selected":''}}> {{$purpose->name}}</option>
                  @endforeach
                    <option value="0">New Purpose</option>
                </select>
                <input type="text" placeholder="Enter Purpose" id="add_others" class="form-control 
                  form-control-sm" name="name" style="display: none">
                  <font style="color: red">{{($errors->has('designation_id'))? ($errors->first('name')):''}}</font>
            </div>
          </div>
          <div class="card-footer">
              <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-dot-circle-o"></i> {{(@$editData?'Update':'Submit')}} </button> 
              <button type="reset" class="btn btn-danger btn-sm">  <i class="fa fa-ban"></i> Reset </button>
          </div>
     </form>
 </div>
 <script type="text/javascript">
  $(document).ready(function(){
     $(document).on('change','#leave_purpose_id',function(){
        var leave_purpose_id = $(this).val();
        if (leave_purpose_id== '0') {
          $('#add_others').show();
        }else{
          $('#add_others').hide();
        }

     });
  });
 </script>
@endsection