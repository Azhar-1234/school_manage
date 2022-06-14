@extends('backend.master')
@section('mainContent')
<div class="card col-md-8 m-3 pt-3">
    <div class="card-header">    
        <strong>Add</strong>Stuents Fee  
        <a href="{{route('view-marks-grade')}}"  type="button" class="btn btn-primary float-right active col-md-4">
          <i class="fa fa-list"></i> Student Fee List
         </a>
     </div>
     <div class="card-body">
     	<div class="form-row">
     		<div class="form-group col-md-4">
     			<label for="year_id">Select Year</label>
     			<select name="year_id" id="year_id" class="form-control select2bs4">
     				<option value="">Select Year</option>
     				@foreach($years as $year)
     					<option value="{{$year->id}}">{{$year->name}}</option>
     				@endforeach
     			</select>
     		</div>
     		<div class="form-group col-md-4">
     			<label for="class_id">Select Class</label>
     			<select name="class_id" id="class_id" class="form-control select2bs4">
     				<option value="">Select Class</option>
     				@foreach($classes as $class)
     					<option value="{{$class->id}}">{{$class->name}}</option>
     				@endforeach
     			</select>
     		</div>
     		<div class="form-group col-md-4">
     			<label for="exam_type">Fee Category</label>
     			<select name="fee_category_id" id="fee_category_id" class="form-control select2bs4">
     				<option value="">Select Fee Category</option>
     				@foreach($fee_categories as $fee_category)
     					<option value="{{$fee_category->id}}">{{$fee_category->name}}</option>
     				@endforeach
     			</select>
     		</div>
     		<div class="form-group col-md-3">
     			<label>Date</label>
     			<input type="date" name="date" id="date" class="form-control" placeholder="DD-MM-YY">
     		</div>
     		<div class="form-group col-md-3">
     			<a id="search" class="btn btn-primary" name="search" style="margin-top: 30px">Search</a>
     		</div>
       	</div>
     </div>  
     <div class="card-body">
     	<div id="DocumentResults"></div>
     	<script id="document-template" type="text/x-handlebars-template">
	     	<form action="{{route('Accounts-fee-store')}}" method="post">
	     		@csrf
	     		<table class="table table-bordered table-striped" style="width: 100%">
	     			<thead>
	     				<tr>
	     					@{{{thsource}}}
	     				</tr>
	     			</thead>
	     			<tbody>
	     				@{{#each this}}
	     				<tr>
	     					@{{{tdsource}}}
	     				</tr>
	     				@{{/each}}
	     			</tbody>
	     		</table>
	     		<button type="submit" class="btn btn-primary" style="margin-top: 10px;">Submit</button>
	     	</form>
     	</script>
     </div>   
 </div>
<script type="text/javascript">
	$(document).on('click','#search',function() {
		var year_id = $('#year_id').val();
		var class_id = $('#class_id').val();
		var fee_category_id = $('#fee_category_id').val();
		var date = $('#date').val();
		$('.notifyjs-corner').html('');
		if (year_id =='') {
			$.notify("year required",{globlaPosition: 'top right',className: 'error'});
			return false;
		}
		if (class_id =='') {
			$.notify("class required",{globlaPosition: 'top right',className: 'error'});
			return false;
		}
		if (fee_category_id =='') {
			$.notify("Fee Category Id required",{globlaPosition: 'top right',className: 'error'});
			return false;
		}
		if (date =='') {
			$.notify("Date required",{globlaPosition: 'top right',className: 'error'});
			return false;
		}

		$.ajax({
			url:"{{route('get-student')}}",
			type:"GET",
			data:{'year_id': year_id,'class_id':class_id,'fee_category_id':fee_category_id,'date':date},
			beforeSend: function(){

			},
			success: function(data){
				var source = $("#document-template").html();
				var template = Handlebars.compile(source);
				var html = template(data);
				$('#DocumentResults').html(html);
				$('[data-toggle="tooltip"]').tooltip();
			}
		});
	});
</script>

 @endsection