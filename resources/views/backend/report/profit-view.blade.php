@extends('backend.master')
@section('mainContent')
<div class="content row">
  <div class="card-header">
    <h1>Manage Monthly/Yearly Profit</h1>
  </div>    
  <div class="col-md-10">
    <div class="card pt-1">
      <div class="card-header">
        <h3>Search Criteria</h3>
      </div>
      <div class="card-body">
          <div class="form-row">
            <div class="form-group col-md-4">
                <label>Start date</label>
                <input type="date" name="start_date" id="start_date" class="form-control form-control-sm"> 
            </div>
            <div class="form-group col-md-4">
                <label>End date</label>
                <input type="date" name="end_date" id="end_date" class="form-control form-control-sm"> 
            </div>
            <div class="form-group col-md-2">
              <a id="search" class="btn btn-primary" name="search" style="margin-top: 30px;color: white">Search</a>
            </div>
          </div>
      </div>
      <div class="card-body">
        <div id="DocumentResults"></div>
            <script id="document-template" type="text/x-handlebars-template">
              <table class="table-sm table-bordered table-striped" style="width: 100%">
                <thead>
                  <tr>
                    @{{{thsource}}}
                  </tr>
                </thead>
                <tbody>                  
                  <tr>
                    @{{{tdsource}}}
                  </tr>
                </tbody>
              </table>
            </script>
        </div>   
    </div>
  </div>
</div>
<script type="text/javascript">
  $(document).on('click','#search',function() {
    var start_date = $('#start_date').val();
    var end_date = $('#end_date').val();
    $('.notifyjs-corner').html('');

    if (start_date =='') {
      $.notify("start date required",{globlaPosition: 'top right',className: 'error'});
      return false;
    }
    if (end_date =='') {
      $.notify("end date required",{globlaPosition: 'top right',className: 'error'});
      return false;
    }

    $.ajax({
      url:"{{route('profit-get')}}",
      type:"GET",
      data:{'start_date': start_date,'end_date':end_date},
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