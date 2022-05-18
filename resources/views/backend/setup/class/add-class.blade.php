@extends('backend.master')

@section('mainContent')
<div class="card col-md-6 m-3 pt-3">
    <div class="card-header">
        @if(isset($editData))
        <strong>Edit</strong> Student Class 
        @else
        <strong>Add</strong> Student Class 
        @endif

        <a href="{{route('view-class')}}"  type="button" class="btn btn-primary float-right active col-md-4"><i class="fa fa-list"></i> student class List</a>
     </div>
      <div class="card-body">
          @if ($message = Session::get('success'))
          <span class="text-success">{{ $message }}</span>
      </div>
                    
      <div class="card-body card-block">
        @elseif ($message = Session::get('danger'))
        <span class="text-danger">{{ $message }}</span>
     </div>
            @endif
     <form action="{{(@$editData)?route('update-class',$editData->id):route('store-class')}}" 
        method="post" id="myForm" enctype="multipart/form-data" class="">
       	@csrf
   		    <div class="card-body card-block">
                <div class="form-group">
                  <label for="exampleInputName2"  class="pr-1  form-control-label">Class Name</label>
                  <input type="text" name="name" value="{{@$editData->name}}" id="exampleInputName2" placeholder="Jane Doe" required="" class="form-control">
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