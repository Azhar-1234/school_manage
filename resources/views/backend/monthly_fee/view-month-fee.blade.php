@extends('backend.master')

@section('mainContent')
<div class="content row">
  <div class="card-header">
    <h1 >Manage Monthly Fee</h1>
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
	        <div class="form-row">
	          <div class="form-group col-md-3">
	            <label for="exampleInputName2"  class="pr-1  form-control-label">Class Name <font style="color: red">*</font></label><br>
	              <select name="class_id" id="class_id" class="form-control form-control-sm">
	               <option>Class</option>
	                @foreach($classes as $Class)
	                  <option value="{{$Class->id}}">{{$Class->name}}</option>
	                @endforeach
	              </select>
	            <font style="color: red">{{($errors->has('class'))? ($errors->first('name')):''}}</font>
	          </div>
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
	          <div class="form-group col-md-4">
	            <label for="exampleInputName2"  class="pr-1  form-control-label">Month <font style="color: red">*</font></label><br>
	              <select name="month" id="month" class="form-control form-control-sm">
	               <option>Month</option>
	                  <option value="January">January</option>
	                  <option value="February">February</option>
	                  <option value="March">March</option>
	                  <option value="April">April</option>
	                  <option value="May">May</option>
	                  <option value="June">June</option>
	                  <option value="July">July</option>
	                  <option value="August">August</option>
	                  <option value="Septembar">Septembar</option>
	                  <option value="October">October</option>
	                  <option value="November">November</option>
	                  <option value="December">December</option>
	              </select>
	            <font style="color: red">{{($errors->has('year'))? ($errors->first('name')):''}}</font>
	          </div>

	          <div class="form-group col-md-2" style="padding-top: 29px">
	            <a id="search" class="btn btn-sm btn-primary" name="search">Search</a>
	          </div>
	        </div>
	    </div>
	    <div class="card-body">
	    	<div id="DocumentResults"></div>
	    	<script id="document-template" type="text/x-handlebars-template" >
	    		<table class="table-sm table-bordered table-striped" style="width: 100%">
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
	    	</script>
	    </div>
     </div>
  </div>
</div>

<script>
  $(document).on('click','#search',function(){
    var year_id = $('#year_id').val();
    var class_id = $('#class_id').val();
    var month = $('#month').val();

    $('.notifyjs-corner').html('');
    if(year_id == ''){
      $.notify("year Required", {globalPosition: 'top right', className: 'error'});
      return false;
    }
    if(class_id == ''){
      $.notify("Class Required", {globalPosition: 'top right', className: 'error'});
      return false;
    }
    if(month == ''){
      $.notify("Month Required", {globalPosition: 'top right', className: 'error'});
      return false;
    }



    $.ajax({
      url: "{{route('month-get-student')}}",
      type: "GET",
      data: {'year_id': year_id,'class_id': class_id,'month': month},
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
</script
@endsection