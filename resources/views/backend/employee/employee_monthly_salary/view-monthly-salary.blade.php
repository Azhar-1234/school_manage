@extends('backend.master')

@section('mainContent')
<div class="content row">
  <div class="card-header">
    <h1>Manage Monthly Salary</h1>
  </div>
  <div class="col-md-8">
    <div class="row mt-3 mb-2">
      <h3 class="col-md"> Employee Monthly Salary List     
          <a href="{{route('add-attend-employee')}}"  type="button" class="btn btn-primary active float-right "><i class="fa fa-plus-circle"></i> Add Employee Attend</a>
       </h3>
    </div>
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="card-title"><h3>Select Date</h3></div>
        </div>
        <div class="card-body">
          <div class="form-row">
            <div class="form-group col-md-4">
              <label class="control-label">Date</label>
              <input type="text" name="date" id="date" class="form-control form-control-sm" autocomplete="off">
            </div>
            <div class="form-group col-md-2">
              <a class="btn btn-sm btn-success" id="search" style="margin-top: 29px;color: white;">Search</a>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div id="DocumentResults"></div>
          <script id="document-template" type="text/x-handlebars-template">
            <table class="table-sm table-bordered table-striped" style="width:100%">
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
</div>

<script type="text/javascript">
  $(document).on('click','#search',function(){
    var date = $('#date').val();
    $('.notifyjs-corner').html('');
    if(date ==''){
      $.notify("Date required",{globalPosition: 'top right',className: 'error'});
      return false;
    }
    $.ajax({
      url: "{{route('employee.monthly.salary.get')}}",
      type: "get",
      data: {'date':date},
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