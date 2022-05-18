@extends('backend.master')

@section('mainContent')
<div class="content row">
  <div class="card-header">
    <h1 >Manage Roll Generate</h1>
  </div>
     
  <div class="col-md-12">
     <div class="card-body">
        @if ($message = Session::get('success'))
          <span class="text-success">{{ $message }}</span>
      </div>
                    
      <div class="card-body card-block">
        @elseif ($message = Session::get('danger'))
        <span class="text-danger">{{ $message }}</span>
      </div>
        @endif
   	 <div class="card">
      	<div class="card-header">
        	<h3>Search Criteria</h3>
        </div>
      	<div class="card-body">
	      <form method="POST" id="myForm" action="{{route('store-roll')}}" id="myForm" enctype="multipart/form-data">
	      	@csrf
	        <div class="form-row">
	          <div class="form-group col-md-4">
	            <label for="exampleInputName2"  class="pr-1  form-control-label">Class Name <font style="color: red">*</font></label><br>
	              <select name="class_id" id="class_id" class="form-control form-control-sm">
	               <option>Class</option>
	                @foreach($classes as $Class)
	                  <option value="{{$Class->id}}">{{$Class->name}}</option>
	                @endforeach
	              </select>
	            <font style="color: red">{{($errors->has('class'))? ($errors->first('name')):''}}</font>
	          </div>
	          <div class="form-group col-md-4">
	            <label for="exampleInputName2"  class="pr-1  form-control-label">Year Name <font style="color: red">*</font></label><br>
	              <select name="year_id" id="year_id" class="form-control form-control-sm">
	               <option>Year</option>
	                @foreach($years as $year)
	                  <option value="{{$year->id}}">{{$year->name}}</option>
	                @endforeach
	              </select>
	            <font style="color: red">{{($errors->has('year'))? ($errors->first('name')):''}}</font>
	          </div>
	          <div class="form-group col-md-4" style="padding-top: 29px">
	            <a id="search" class="btn btn-sm btn-primary" name="search">Search</a>
	          </div>
	        </div></br>
	        <div class="row d-none" id="roll-generate">
	        	<div class="col-md-12">
	        		<table class="table table-bordered table-stripped dt-responsive" style="width: 100%">
	        			<thead>
	        				<tr>
	        					<th>ID NO</th>
	        					<th>Student Name</th>
	        					<th>Father's Name</th>
	        					<th>Gender</th>
	        					<th>Roll NO</th>
	        				</tr>
	        			</thead>
	        			<tbody id="roll-generate-tr">
	        				
	        			</tbody>
	        		</table>
	        	</div>
	        </div>
	       	<button type="submit" class="btn btn-success btn-sm">Roll Generate</button>
	      </form>
    	</div>
     </div>
  </div>
</div>

<script type="text/javascript">
	$(document).on('click','#search',function() {
		var year_id = $('#year_id').val();
		var class_id = $('#class_id').val();
		$('.notifyjs-corner').html('');
		if (year_id =='') {
			$.notify("year required",{globlaPosition: 'top right',className: 'error'});
			return false;
		}
		if (class_id =='') {
			$.notify("class required",{globlaPosition: 'top right',className: 'error'});
			return false;
		}
		$.ajax({
			url:"{{route('get-student')}}",
			type:"GET",
			data:{'year_id': year_id,'class_id':class_id},
			success: function(data){
				$('#roll-generate').removeClass('d-none');
				var html = '';
				$.each(data,function( key,v){
					html +=
					'<tr>'+
					'<td>'+v.student.id_no+'<input type="hidden" name="student_id[]" value="'+v.student_id+'"></td>'+
					'<td>'+v.student.name+'</td>'+
					'<td>'+v.student.fname+'</td>'+
					'<td>'+v.student.gender+'</td>'+
					'<td><input type="text" class="form-control form-control-sm" name="roll[]" value="'+v.roll+'"></td>'+
					'</tr>';
				});
				html = $('#roll-generate-tr').html(html);
			}
		});
	});
</script>
 <script type="text/javascript">
  $(document).ready(function() {
    $("#myForm").validate({
      rules: {
        "roll[]" : {
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