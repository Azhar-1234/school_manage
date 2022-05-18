@extends('backend.master')

@section('mainContent')
<div class="card col-md-6 m-3 pt-3">
    <div class="card-header">
        @if(isset($editData))
        <strong>Edit</strong> Student subject 
        @else
        <strong>Add</strong> Student subject 
        @endif

        <a href="{{route('view-subject')}}"  type="button" class="btn btn-primary float-right active col-md-4">
          <i class="fa fa-list"></i>  subject List
      	 </a>
     </div>
     <form action="{{@$editData?route('update-subject',$editData->id):('store-subject')}}" method="post" id="myForm" enctype="multipart/form-data" class="">
       	@csrf
   		    <div class="card-body card-block">
                <div class="form-subject">
                  <label for="exampleInputName2"  class="pr-1  form-control-label">subject Name</label>
                  <input type="text" name="name" value="{{@$editData->name}}" id="exampleInputName2"  required="" class="form-control">
                  <font style="color: red">{{($errors->has('name'))? ($errors->first('name')):''}}</font>
                </div>
           </div>
      		<div class="card-footer">
        	  	<button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-dot-circle-o"></i> {{(@$editData?'Update':'Submit')}} </button> 
             	<button type="reset" class="btn btn-danger btn-sm">  <i class="fa fa-ban"></i> Reset </button>
       		</div>
     </form>
 </div>
@endsection