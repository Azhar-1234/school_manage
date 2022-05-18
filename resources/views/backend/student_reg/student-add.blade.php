@extends('backend.master')

@section('mainContent')
<div class="card col-md-10 m-3 pt-3">
    <div class="card-header">
        @if(isset($editData))
        <strong>Edit</strong> Student  
        @else
        <strong>Add</strong> Student  
        @endif

        <a href="{{route('view-student')}}"  type="button" class="btn btn-primary float-right active col-md-4">
          <i class="fa fa-list"></i>  student List</a>
    </div>
     
     <form action="{{@$editData?route('update-student',$editData->student_id):('store-student')}}" method="post" id="myForm" enctype="multipart/form-data" class="">
       	@csrf
          <input type="hidden" name="id" value="{{@$editData->id}}">
   		    <div class="card-body card-block">
             <div class="form-row">
                  <div class="form-group col-md-4">
                    <label for="exampleInputName2"  class="pr-1  form-control-label">student Name <font style="color: red">*</font></label><br>
                    <input type="text" name="name" value="{{@$editData['student']['name']}}" id="exampleInputName2"  class="form-control form-control-sm">
                    <font style="color: red">{{($errors->has('name'))? ($errors->first('name')):''}}</font>
                  </div>
                  <div class="form-group col-md-4">
                    <label for="exampleInputName2"  class="pr-1  form-control-label">Father's Name <font style="color: red">*</font></label><br>
                    <input type="text" name="fname" value="{{@$editData['student']['fname']}}" id="exampleInputName2"  required="" class="form-control form-control-sm">
                    <font style="color: red">{{($errors->has('fname'))? ($errors->first('name')):''}}</font>
                  </div>
                  <div class="form-group col-md-4">
                    <label for="exampleInputName2"  class="pr-1  form-control-label">Mother's  Name <font style="color: red">*</font></label><br>
                    <input type="text" name="mname" value="{{@$editData['student']['mname']}}" id="exampleInputName2"  required="" class="form-control form-control-sm">
                    <font style="color: red">{{($errors->has('mname'))? ($errors->first('name')):''}}</font>
                  </div>
                  <div class="form-group col-md-4">
                    <label for="exampleInputName2"  class="pr-1  form-control-label">Email <font style="color: red">*</font></label><br>
                    <input type="mail" name="email" value="{{@$editData['student']['email']}}" id="exampleInputName2"  required="" class="form-control form-control-sm">
                    <font style="color: red">{{($errors->has('email'))? ($errors->first('name')):''}}</font>
                  </div>

                  <div class="form-group col-md-4">
                    <label for="exampleInputName2"  class="pr-1  form-control-label">Mobile Number <font style="color: red">*</font></label><br>
                    <input type="text" name="mobile" value="{{@$editData['student']['mobile']}}" id="exampleInputName2"  required="" class="form-control form-control-sm">
                    <font style="color: red">{{($errors->has('mobile'))? ($errors->first('name')):''}}</font>
                  </div>
                  <div class="form-group col-md-4">
                    <label for="exampleInputName2"  class="pr-1  form-control-label">Address <font style="color: red">*</font></label><br>
                    <input type="text" name="address" value="{{@$editData['student']['address']}}" id="exampleInputName2"  required="" class="form-control form-control-sm">
                    <font style="color: red">{{($errors->has('address'))? ($errors->first('name')):''}}</font>
                  </div>
                  <div class="form-group col-md-4">
                    <label for="exampleInputName2"  class="pr-1  form-control-label">Gender <font style="color: red">*</font></label><br>
                      <select name="gender" class="form-control form-control-sm">
                       <option>Select Gender</option>
                       <option value="Male"{{(@$editData['student']['gender']=='Male')?'selected':''}}>Male</option>
                       <option value="female"{{(@$editData['student']['gender']=='female')?'selected':''}}>Female</option>
                      </select>
                    <font style="color: red">{{($errors->has('gender'))? ($errors->first('name')):''}}</font>
                  </div>
                  <div class="form-group col-md-4">
                    <label for="exampleInputName2"  class="pr-1  form-control-label">Religion <font style="color: red">*</font></label><br>
                      <select name="religion" class="form-control form-control-sm">
                       <option value="islam"{{(@$editData['student']['religion']=="islam")?"selected":''}}>Islam</option>
                      </select>
                    <font style="color: red">{{($errors->has('religion'))? ($errors->first('name')):''}}</font>
                  </div>
                  <div class="form-group col-md-4">
                    <label for="exampleInputName2"  class="pr-1  form-control-label">Date Of Birth <font style="color: red">*</font></label><br>
                    <input type="text" name="dob" value="{{@$editData['student']['dob']}}" id="datetimepicker"  required="" class="form-control form-control-sm singledatepicker" autocomplete="off">

                    <font style="color: red">{{($errors->has('dob'))? ($errors->first('name')):''}}</font>
                  </div>
                  <div class="form-group col-md-4">
                    <label for="exampleInputName2"  class="pr-1  form-control-label">Discount <font style="color: red">*</font></label><br>
                    <input type="text" name="discount" value="{{@$editData['discount']['discount']}}" id="exampleInputName2"  required="" class="form-control form-control-sm" autocomplete="off">
                    <font style="color: red">{{($errors->has('discount'))? ($errors->first('name')):''}}</font>
                  </div>
                  <div class="form-group col-md-4">
                    <label for="exampleInputName2"  class="pr-1  form-control-label">Year <font style="color: red">*</font></label><br>
                      <select name="year_id" class="form-control form-control-sm">
                       <option>Select Year</option>
                        @foreach($years as $year)
                          <option value="{{$year->id}}"{{(@$editData->year_id==$year->id)?"selected":''}}>{{$year->name}}</option>
                        @endforeach
                      </select>
                    <font style="color: red">{{($errors->has('year'))? ($errors->first('name')):''}}</font>
                  </div>
                  <div class="form-group col-md-4">
                    <label for="exampleInputName2"  class="pr-1  form-control-label">Group Name <font style="color: red"></font></label><br>
                      <select name="group_id" class="form-control form-control-sm">
                       <option>Select Group</option>
                        @foreach($groups as $group)
                          <option value="{{$group->id}}"{{(@$editData->group_id==$group->id)?"selected":""}}>{{$group->name}}</option>
                        @endforeach
                      </select>
                    <font style="color: red">{{($errors->has('group'))? ($errors->first('name')):''}}</font>
                  </div>
                  <div class="form-group col-md-4">
                    <label for="exampleInputName2"  class="pr-1  form-control-label">Shift Name <font style="color: red"></font></label><br>
                      <select name="shift_id" class="form-control form-control-sm">
                       <option>Select shift</option>
                        @foreach($shifts as $shift)
                          <option value="{{$shift->id}}"{{(@$editData->shift_id==$shift->id)?"selected":''}}>{{$shift->name}}</option>
                        @endforeach
                      </select>
                    <font style="color: red">{{($errors->has('shift'))? ($errors->first('name')):''}}</font>
                  </div>
                  <div class="form-group col-md-4">
                    <label for="exampleInputName2"  class="pr-1  form-control-label">Class Name <font style="color: red">*</font></label><br>
                      <select name="class_id" class="form-control form-control-sm">
                       <option>Select Class</option>
                        @foreach($classes as $Class)
                          <option value="{{$Class->id}}"{{(@$editData->class_id==$Class->id)?"selected":''}}>{{$Class->name}}</option>
                        @endforeach
                      </select>
                    <font style="color: red">{{($errors->has('class'))? ($errors->first('name')):''}}</font>
                  </div>
                  <div class="form-group col-md-4">
                    <label for="exampleInputName2"  class="pr-1  form-control-label">Image <font style="color: red">*</font></label><br>
                       <input type="file" name="image" class="form-control form-control-sm" id="image">
                    <font style="color: red">{{($errors->has('image'))? ($errors->first('name')):''}}</font>
                  </div>
                  <div class="form-group col-md-4">
                     <image id="showImage"  src="{{url('public/upload/no_image.png')}}" style="height:160px;width:150px;border:1px solid #000">
                  </div>
           </div>
      		<div class="card-footer">
        	  	<button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-dot-circle-o"></i> {{(@$editData?'Update':'Submit')}} 
              </button> 
             	<button type="reset" class="btn btn-danger btn-sm"><i class="fa fa-ban"></i> Reset </button>
       		</div>
     </form>
 </div>
 <script type="text/javascript">
  $(document).ready(function() {
    $('#myForm').validate({
      rules: {
        "name" : {
          required: true,
        },
        "fname" : {
          required: true,
        }, 
        "mname" : {
          required: true,
        }, 
        "mname" : {
          required: true,
        },    
        "email" : {
          required: true,
        }, 
        "address" : {
          required: true,
        }, 
        "gender" : {
          required: true,
        }, 
        "dob" : {
          required: true,
        },      
        "year_id" : {
          required: true,
        },      
        "discount" : {
          required: true,
        },      
        "class_id" : {
          required: true,
        },            
        "image" : {
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