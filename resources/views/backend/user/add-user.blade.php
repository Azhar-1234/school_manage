@extends('backend.master')

@section('mainContent')
<div class="card col-md-6 m-3 pt-3">
    <div class="card-header">
       @if(isset($editData))
        <strong>Edit</strong> user 
       @else
        <strong>Add</strong> user 
       @endif
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
     <form action="{{route('store-user')}}" method="post" id="myForm" enctype="multipart/form-data" class="">
          @csrf
   		  <div class="card-body card-block">
            <div class="form-group">
                <label for="exampleInputName2"  class="pr-1  form-control-label">Role</label>
                <select name="role" class="form-control">
                    <option value="">Slect Role</option>
                    <option value="admin">Admin</option>
                    <option value="oparetor">Oparetor</option>
               </select>
            </div>
            @error('usertype')
              <span class="text-danger">{{$message}}</span>
            @enderror
              <div class="form-group"><label for="exampleInputName2" class="pr-1  form-control-label">Name</label><input type="text" name="name" id="exampleInputName2" placeholder="" required="" class="form-control"></div>
            @error('name')
             <span class="text-danger">{{$message}}</span>
            @enderror
           	<div class="form-group"><label for="exampleInputEmail2" class="px-1  form-control-label">Email</label><input type="email"  name="email" id="exampleInputEmail2" placeholder="" required="" class="form-control"></div>
            @error('email')
            <span class="text-danger">{{$message}}</span>
            @enderror
          </div>
      		<div class="card-footer">
          	  <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-dot-circle-o"></i>Submit</button> 
             	<button type="reset" class="btn btn-danger btn-sm"><i class="fa fa-ban"></i> Reset </button>
       		</div>
     </form>
 </div>
 <script type="text/javascript">
  $(document).ready(function() {
    $("#myForm").validate({
      rules: {
        "role" : {
          required: true,
        },
        "name" : {
          required: true,
        },
        "email" : {
          required: true,
        },
        "password" : {
          required: true,
        },
        "password2" : {
          required: true,
          equalTO: '#password'
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