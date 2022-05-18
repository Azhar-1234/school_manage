@extends('backend.master')

@section('mainContent')
<div class="content row">
  <div class="card-header">
    <h1 >Manage Marks Generate</h1>
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
	      <form method="POST" id="myForm" action="{{route('store-marks')}}" id="myForm" enctype="multipart/form-data">
	      	@csrf
	        <div class="form-row">
	          <div class="form-group col-md-3">
	            <label for="exampleInputName2"  class="pr-1  form-control-label">Year Name <font style="color: red">*</font></label><br>
	              <select name="year_id" id="year_id" class="form-control form-control-sm">
	               <option>Year</option>
	                @foreach($years as $year)
	                  <option value="{{$year->id}}">{{$year->name}}</option>
	                @endforeach
	              </select>
	            <font style="color: red">{{($errors->has('year'))? ($errors->first('name')):''}}</font>
	          </div>
	          <div class="form-group col-md-3">
	            <label for="exampleInputName2"  class="pr-1  form-control-label">Select Class Name <font style="color: red">*</font></label><br>
	              <select name="class_id" id="class_id" class="form-control form-control-sm">
	               <option>Class</option>
	                @foreach($classes as $Class)
	                  <option value="{{$Class->id}}">{{$Class->name}}</option>
	                @endforeach
	              </select>
	            <font style="color: red">{{($errors->has('class'))? ($errors->first('name')):''}}</font>
	          </div>
	          <div class="form-group col-md-3">
	            <label for="exampleInputName2"  class="pr-1  form-control-label">Assign Subject<font style="color: red">*</font></label><br>
	              <select name="assign_subject_id" id="assign_subject_id" class="form-control form-control-sm">
	               <option>Assign Subject</option>
	                
	              </select>
	            <font style="color: red">{{($errors->has('subject'))? ($errors->first('name')):''}}</font>
	          </div>
	          <div class="form-group col-md-3">
	            <label for="exampleInputName2"  class="pr-1  form-control-label">Exam Type<font style="color: red">*</font></label><br>
	              <select name="exam_type_id" id="exam_type_id" class="form-control form-control-sm">
	               <option>Exam Type</option>
	                @foreach($exam_types as $exam)
	                  <option value="{{$exam->id}}">{{$exam->name}}</option>
	                @endforeach
	              </select>
	            <font style="color: red">{{($errors->has('exam_type_id'))? ($errors->first('name')):''}}</font>
	          </div>
	          <div class="form-group col-md-2">
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
	        					<th>Marks</th>
	        				</tr>
	        			</thead>
	        			<tbody id="roll-generate-tr">
	        				
	        			</tbody>
	        		</table>
	        		<button type="submit" class="btn btn-success btn-sm">submit</button>
	        	</div>
	      	 	
	        </div>
	      </form>
    	</div>
     </div>
  </div>
</div>

<script type="text/javascript">
	$(document).on('click','#search',function() {
		var year_id = $('#year_id').val();
		var class_id = $('#class_id').val();
		var assign_subject_id = $('#assign_subject_id').val();
		var exam_type_id = $('#exam_type_id').val();

		$('.notifyjs-corner').html('');
		if (year_id == '') {
			$.notify("year required",{globlaPosition: 'top right',className: 'error'});
			return false;
		}
		if (class_id == '') {
			$.notify("class required",{globlaPosition: 'top right',className: 'error'});
			return false;
		}
		if (assign_subject_id == '') {
			$.notify("Subject required",{globlaPosition: 'top right',className: 'error'});
			return false;
		}
		if (exam_type_id == '') {
			$.notify("Exam Type required",{globlaPosition: 'top right',className: 'error'});
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
					'<td>'+v.student.id_no+'<input type="hidden" name="student_id[]" value="'+v.student_id+'"><input type="hidden" name="id_no[]" value="'+v.student.id_no+'"></td>'+
					'<td>'+v.student.name+'</td>'+
					'<td>'+v.student.fname+'</td>'+
					'<td>'+v.student.gender+'</td>'+
					'<td><input type="text" class="form-control form-control-sm" name="marks[]"></td>'+
					'</tr>';
				});
				html = $('#roll-generate-tr').html(html);
			}
		});
	});
</script>
<script type="text/javascript">
	$(function(){
		$(document).on('change','#class_id',function(){
		var class_id =$('#class_id').val();
		$.ajax({
			url:"{{route('get-subject')}}",
			type:"GET",
			data:{class_id:class_id},
			success:function(data){
				var html = '<option value="">Select Subject</option>';
				$.each(data,function(key,v){
					html +='<option value="'+v.id+'">'+v.subject.name+'</option>';
				});
				$('#assign_subject_id').html(html);
			}

			});

		});
	});

</script>
 <script type="text/javascript">
  $(document).ready(function() {
    $("#myForm").validate({
      rules: {
        "marks[]" : {
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