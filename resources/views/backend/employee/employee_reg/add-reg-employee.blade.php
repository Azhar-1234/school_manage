@extends('backend.master')

@section('mainContent')
<div class="card col-md-10 m-3 pt-3">
    <div class="card-header">
        @if(isset($editData))
        <strong>Edit</strong> Employee  
        @else
        <strong>Add</strong> Employee  
        @endif

        <a href="{{route('view-reg-employee')}}"  type="button" class="btn btn-primary float-right active ">
          <i class="fa fa-list"></i>  Employee List</a>
    </div>
     
     <form action="{{@$editData?route('update-reg-employee',$editData->id):('store-reg-employee')}}" method="post" id="myForm" enctype="multipart/form-data" class="">
       	@csrf
   		    <div class="card-body card-block">
                <div class="form-row">
                  <div class="form-group col-md-4">
                    <label for="exampleInputName2"  class="pr-1  form-control-label">Employee Name <font style="color: red">*</font></label><br>
                    <input type="text" name="name" value="{{@$editData->name}}" id="exampleInputName2"  class="form-control form-control-sm">
                    <font style="color: red">{{($errors->has('name'))? ($errors->first('name')):''}}</font>
                  </div>
                  <div class="form-group col-md-4">
                    <label for="exampleInputName2"  class="pr-1  form-control-label">Father's Name <font style="color: red">*</font></label><br>
                    <input type="text" name="fname" value="{{@$editData->fname}}" id="exampleInputName2"  required="" class="form-control form-control-sm">
                    <font style="color: red">{{($errors->has('fname'))? ($errors->first('name')):''}}</font>
                  </div>
                  <div class="form-group col-md-4">
                    <label for="exampleInputName2"  class="pr-1  form-control-label">Mother's  Name <font style="color: red">*</font></label><br>
                    <input type="text" name="mname" value="{{@$editData->mname}}" id="exampleInputName2"  required="" class="form-control form-control-sm">
                    <font style="color: red">{{($errors->has('mname'))? ($errors->first('name')):''}}</font>
                  </div>
                  <div class="form-group col-md-4">
                    <label for="exampleInputName2"  class="pr-1  form-control-label">Email <font style="color: red">*</font></label><br>
                    <input type="mail" name="email" value="{{@$editData->email}}" id="exampleInputName2"  required="" class="form-control form-control-sm">
                    <font style="color: red">{{($errors->has('email'))? ($errors->first('name')):''}}</font>
                  </div>
                  <div class="form-group col-md-4">
                    <label for="exampleInputName2"  class="pr-1  form-control-label">Mobile Number <font style="color: red">*</font></label><br>
                    <input type="text" name="mobile" value="{{@$editData->mobile}}" id="exampleInputName2"  required="" class="form-control form-control-sm">
                    <font style="color: red">{{($errors->has('mobile'))? ($errors->first('name')):''}}</font>
                  </div>
                  <div class="form-group col-md-4">
                    <label for="exampleInputName2"  class="pr-1  form-control-label">Address <font style="color: red">*</font></label><br>
                    <input type="text" name="address" value="{{@$editData->address}}" id="exampleInputName2"  required="" class="form-control form-control-sm">
                    <font style="color: red">{{($errors->has('address'))? ($errors->first('name')):''}}</font>
                  </div>
                  <div class="form-group col-md-4">
                    <label for="exampleInputName2"  class="pr-1  form-control-label">Gender <font style="color: red">*</font></label><br>
                      <select name="gender" class="form-control form-control-sm">
                       <option value="">Select Gender</option>
                       <option value="Male"{{(@$editData->gender=='Male')?'selected':''}}>Male</option>
                       <option value="Female"{{(@$editData->gender=='Female')?'selected':''}}>Female</option>
                      </select>
                    <font style="color: red">{{($errors->has('gender'))? ($errors->first('name')):''}}</font>
                  </div>
                  <div class="form-group col-md-4">
                    <label for="exampleInputName2"  class="pr-1  form-control-label">Religion <font style="color: red">*</font></label><br>
                      <select name="religion" class="form-control form-control-sm">
                       <option value="">Select Gender</option>
                       <option value="islam"{{(@$editData->religion=='islam')?"selected":''}}>Islam</option>
                      </select>
                    <font style="color: red">{{($errors->has('religion'))? ($errors->first('name')):''}}</font>
                  </div>
                  <div class="form-group col-md-4">
                    <label for="exampleInputName2"  class="pr-1  form-control-label">Date Of Birth <font style="color: red">*</font></label><br>
                    <input type="text" name="dob" value="{{@$editData->dob}}" id="datetimepicker"  required="" class="form-control form-control-sm singledatepicker" autocomplete="off">
                    <font style="color: red">{{($errors->has('dob'))? ($errors->first('name')):''}}</font>
                  </div>
                  @if(!@$editData)
                  <div class="form-group col-md-4">
                    <label for="exampleInputName2"  class="pr-1  form-control-label">Salary </label><br>
                    <input type="text" name="salary" value="{{@$editData->salary}}" id="exampleInputName2"  required="" class="form-control form-control-sm" autocomplete="off">
                    <font style="color: red">{{($errors->has('discount'))? ($errors->first('name')):''}}</font>
                  </div>
                  @endif
                  <div class="form-group col-md-4">
                    <label for="exampleInputName2"  class="pr-1  form-control-label">Designation <font style="color: red">*</font></label><br>
                      <select name="designation_id" class="form-control form-control-sm">
                       <option value="">Select Designation</option>
                        @foreach($designations as $designation)
                          <option value="{{$designation->id}}"{{(@$editData->designation_id==$designation->id)?"selected":''}}>{{$designation->name}}</option>
                        @endforeach
                      </select>
                    <font style="color: red">{{($errors->has('designation_id'))? ($errors->first('name')):''}}</font>
                  </div>
                  @if(!@$editData)
                   <div class="form-group col-md-4">
                    <label for="exampleInputName2"  class="pr-1  form-control-label">Join Date <font style="color: red">*</font></label><br>
                    <input type="text" name="join_date" value="{{@$editData->join_date}}" id="datetimepicker"  required="" class="form-control form-control-sm singledatepicker" autocomplete="off">
                    <font style="color: red">{{($errors->has('join_date'))? ($errors->first('name')):''}}</font>
                  </div>   
                  @endif        
                  <div class="form-group col-md-4">
                    <label for="exampleInputName2"  class="pr-1  form-control-label">Image</label><br>
                       <input type="file" name="image" class="form-control form-control-sm" id="image">
                    <font style="color: red">{{($errors->has('image'))? ($errors->first('name')):''}}</font>
                  </div>
                  <div class="form-group col-md-4">
                     <image id="showImage"  src="{{(!empty($editData->image))?url('public/upload/employee_images/'.$editData->image):url('public/upload/no_image.png')}}" style="height:160px;width:150px;border:1px solid #000">
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
        "religion" : {
          required: true,
        }, 
        "dob" : {
          required: true,
        },
        "salary" : {
          required: true,
        }, 
        "designation_id" : {
          required: true,
        },
        "join_date" : {
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