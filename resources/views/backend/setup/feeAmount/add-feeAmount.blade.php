@extends('backend.master')

@section('mainContent')
<div class="card col-md-6 m-3 pt-3">
    <div class="card-header">
        @if(isset($editData))
        <strong>Edit</strong> Student Fee Amount 
        @else
        <strong>Add</strong> Student Fee Amount 
        @endif

        <a href="{{route('view-feeAmount')}}"  type="button" class="btn btn-primary float-right active col-md-4">
          <i class="fa fa-list"></i>  Fee Amount List
      	 </a>
     </div>
     <form action="{{route('store-feeAmount')}}"
     	 method="post" id="myForm" enctype="multipart/form-data" class="">
       	@csrf
	    <div class="card-body col-md-12 pt-3 mt-3 mb-3 btn-info">
	     	<div class="add_item pt-3">
	     		<div class="form-row">
			        <div class="form-group col-md-10">
			          <label for="exampleInputName2"  class="pr-1  form-control-label">Fee Category Name</label>
			          <select name="fee_category_id" class="form-control">
			          	<option value="">Select Fee Category</option>
			          	@foreach($fee_categories as $category)
			    	      	<option value="{{$category->id}}">{{$category->name}}</option>
			    	    @endforeach
			          </select>
			        </div>
			    </div>
		        <div class="form-row">
				    <div class="form-group col-md-5">
			          <label for="exampleInputName2"  class="pr-1  form-control-label">Class Name</label>
			          <select name="class_id[]" class="form-control">
		          		<option value="">Select Class</option>
			          	@foreach($student_classes as $class)
			          	<option value="{{$class->id}}">{{$class->name}}</option>
			          	@endforeach
			          </select>
			        </div>				    
			        <div class="form-group col-md-5">
			          <label for="exampleInputName2"  class="pr-1  form-control-label">Fee Amount</label>
			          <input type="text" name="amount[]" class="form-control">
			          <font style="color: red">{{($errors->has('name'))? ($errors->first('name')):''}}</font>
			        </div>
			       <div class="form-group col-md-1">
			       		<span class="btn btn-info addeventmore" style="margin-top:32px"><i class="fa fa-plus-circle"></i></span>
			       </div>
			    </div>
		    </div>
	    </div>
   		<div class="card-footer">
    	  	<button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-dot-circle-o"></i> {{(@$editData?'Update':'Submit')}} </button> 
         	<button type="reset" class="btn btn-danger btn-sm">  <i class="fa fa-ban"></i> Reset </button>
   		</div>
     </form>
	 <div style="visibility: hidden; height: 0" class="hidden-style">
	 	<div class="whole_extra_item_add" id="whole_extra_item_add">
		 	<div class="delete_whole_extra_item_add" id="delete_whole_extra_item_add">
		        <div class="form-row">
				    <div class="form-group col-md-5">
			          <label for="exampleInputName2"  class="pr-1  form-control-label">Class Name</label>
			          <select name="class_id[]" class="form-control">
			          	<option value="">Select Class</option>
			          	@foreach($student_classes as $class)
			          	<option value="{{$class->id}}">{{$class->name}}</option>
			          	@endforeach
			          </select>
			        </div>				    
			        <div class="form-group col-md-5">
			          <label for="exampleInputName2"  class="pr-1 form-control-label">Fee Amount</label>
			          <input type="text" name="amount[]" class="form-control">
			          <font style="color: red">{{($errors->has('name'))? ($errors->first('name')):''}}</font>
			        </div>
			       <div class="form-group col-md-2">
			       		<div class="form-row">
			       			<span class="btn btn-info addeventmore" style="margin-top:32px"><i class="fa fa-plus-circle"></i></span>
			       			<span class="btn btn-danger removeeventmore" style="margin-top:32px"><i class="fa fa-minus-circle"></i></span>
			       		</div>
			       </div>
			    </div>
		 	</div>	
	 	</div>
	 </div>


 </div>
 <script type="text/javascript">
 	$(document).ready(function(){
 		var counter = 0;
 		$(document).on("click",".addeventmore",function(){
 			var whole_extra_item_add = $("#whole_extra_item_add").html();
 			$(this).closest(".add_item").append(whole_extra_item_add);
 			counter++;
 		});
 		$(document).on("click",".removeeventmore",function(event){
 			
 			$(this).closest(".delete_whole_extra_item_add").remove();
 			counter -= 1
 		});
 	});
 </script>

 <script type="text/javascript">
 	$(document).ready(function() {
		$("#myForm").validate({
			rules: {
				"fee_category_id" : {
					required: true,
				},
				"class_id[]" : {
					required: true,
				},
				"amount[]" : {
					required: true,
				}
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