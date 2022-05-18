@extends('backend.master')

@section('mainContent')
<div class="card col-md-6 m-3 pt-3">
    <div class="card-header">
        @if(isset($editData))
        <strong>Edit</strong> Student shift 
        @else
        <strong>Add</strong> Student shift 
        @endif

        <a href="{{route('view-shift')}}"  type="button" class="btn btn-primary float-right active col-md-4">
          <i class="fa fa-list"></i>  shift List
      	 </a>
     </div>
     <form action="{{@$editData?route('update-shift',$editData->id):('store-shift')}}" method="post" id="myForm" enctype="multipart/form-data" class="">
       	@csrf
   		    <div class="card-body card-block">
                <div class="form-shift">
                  <label for="exampleInputName2"  class="pr-1  form-control-label">shift Name</label>
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