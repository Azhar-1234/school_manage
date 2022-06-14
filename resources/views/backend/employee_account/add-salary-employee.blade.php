@extends('backend.master')
@section('mainContent')
<div class="card col-md-8 m-3 pt-3">
    <div class="card-header">    
        <strong>Add</strong>Employee Salary  
        <a href="{{route('Accounts-employee-view')}}"  type="button" class="btn btn-primary float-right active col-md-4">
          <i class="fa fa-list"></i> Employee Salary List
         </a>
     </div>
     <div class="card-body">
     	<div class="form-row">
     		<div class="form-group col-md-4">
     			<label class="control-label">Date</label>
     			<input type="date" name="date" id="date" class="form-control form-control-sm">
     		</div>
     		<div class="form-group col-md-2">
     			<a class="btn btn-sm btn-success" id="search" style="margin-top: 29px;color: white">Search</a>
     		</div>
     	</div>
     </div> 
     <div class="card-body">
     	<div id="DocumentResults"></div>
     	<script id="document-template" type="text/x-handlebars-template">
	     	<form action="{{route('Accounts-employee-store')}}" method="post">
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
        var date = $('#date').val();
        $('.notifyjs-corner').html('');
        if (date =='') {
            $.notify("Date required",{globlaPosition: 'top right',className: 'error'});
            return false;
        }

        $.ajax({
            url:"{{route('get-employee')}}",
            type:"GET",
            data:{'date':date},
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