@extends('backend.master')
@section('mainContent')
<style type="text/css">
  .switch-toggle{
      width: auto;
    } 
  .switch-toggle label:not(.disabled){
      cursor: pointer;
    } 
   .switch-candy{
      border:1px solid #333;
      border-radius: 3px;
      box-shadow: 0 1px 1px rgba(0,0,0,0.2), inset  0 1px 1px rgba(255,255,255,245);
      background-color: white;
      background-image: -webkit-linear-gradient(top,rgba(255,255,255,0.2),transparent),
      background-image: linear-gradient(to bottom,rgba(255,255,255,0.2),transparent),
   }
   .switch-toggle.switch-candy, .switch-light.switch-light.switch-candy > span {
      background-color: #5a6268;
      border-radius: 3px;
      box-shadow: inset 0 2px 6px rgba(0,0,0,0.3), 0 1px 0 rgba(255,255,255,0.2);
   }
   .footer-inner.bg-white {
    display: none;
}
</style>
<div class="card col-md-6 m-3 pt-3">
    <div class="card-header">
        @if(isset($editData))
        <strong>Edit</strong> Employee Attend 
        @else
        <strong>Add</strong> Employee Attend
        @endif
        <a href="{{route('view-attend-employee')}}"  type="button" class="btn btn-primary float-right active col-md-4">
          <i class="fa fa-list"></i> Employee Attend List
         </a>
     </div>
     
     <form action="{{route('store-attend-employee')}}" method="post" id="myForm">
        @csrf
          @if(isset($editData))
            <div class="card-body card-block">
              <div class="form-group">
                <label class="pr-1  form-control-label">Attendance Date</label>    
                <input type="text" type="hidden" value="{{$editData[0]['date']}}" name="date" id="date" placeholder="Attendance date" 
                  class="checkdate form-control form-control-sm singledatepicker">                 
              </div>
              <table class="table table-striped dt-responsive" style="width: 100%">
                <thead>
                   <tr>
                      <th rowspan="2" class="text-center" style="vertical-align: middle;">#</th>
                      <th rowspan="2" class="text-center" style="vertical-align: middle;">Name </th>
                      <th rowspan="3" class="text-center" style="vertical-align: middle;width:30%;">
                        Attendance Status </th> 
                    </tr>
                   <tr>
                      <th class="text-center btn present_all" style="display: table-cell;background-color: #dee2e6;color: #495057">present</th>
                      <th class="text-center btn leave_all" style="display: table-cell;background-color: green;color:white">Leave</th>
                      <th class="text-center btn absent_all" style="display: table-cell;background-color: yellow;color:black">Absent</th> 
                   </tr>
                </thead>
                <tbody>
                  @foreach($employees as $key => $data)
                    <tr id="div{{$data->id}}" class="text-center">
                      <input type="hidden" name="employee_id[]" value="{{$data->employee_id}}" class="employee_id">
                      <td>{{$key+1}}</td>
                      <td>{{$data->name}}</td>
                      <td colspan="6">
                        <div class="switch-toggle switch-3 switch-candy">
                          <input class="present" id="present{{$key}}" type="radio" value="Present" name="attend_status{{$key}}"{{$data->attend_status=='Present'?'checked':''}}/>
                          <label for="present{{$key}}">Present</label>

                          <input class="leave" id="leave{{$key}}" type="radio" value="Leave" name="attend_status{{$key}}"{{$data->attend_status=='Leave'?'checked':''}}/>
                          <label for="leave{{$key}}">Leave</label>

                          <input class="absent" id="absent{{$key}}" type="radio" value="Absent" name="attend_status{{$key}}" type="radio" {{$data->attend_status=='Absent'?'checked':''}}/>
                          <label for="absent{{$key}}">Absent</label>
                        </div>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          @else
            <div class="card-body card-block">
              <div class="form-group">
                <label class="pr-1  form-control-label">Attendance Date</label>    
                <input type="text" value="" name="date" id="date" placeholder="Attendance date" class=" form-control form-control-sm">                 
              </div>
              <table class="table table-striped dt-responsive" style="width: 100%">
                <thead>
                   <tr>
                      <th rowspan="2" class="text-center" style="vertical-align: middle;">#</th>
                      <th rowspan="2" class="text-center" style="vertical-align: middle;">Name </th>
                      <th rowspan="3" class="text-center" style="vertical-align: middle;width:30%;">
                        Attendance Status </th> 
                    </tr>
                   <tr>
                      <th class="text-center btn present_all" style="display: table-cell;background-color: #dee2e6;color: #495057">present</th>
                      <th class="text-center btn leave_all" style="display: table-cell;background-color: green;color:white">Leave</th>
                      <th class="text-center btn absent_all" style="display: table-cell;background-color: yellow;color:black">Absent</th> 
                   </tr>
                </thead>
                <tbody>
                  @foreach($employees as $key => $data)
                    <tr id="div{{$data->id}}" class="text-center">
                      <input type="hidden" name="employee_id[]" value="{{$data->id}}" class="employee_id">
                      <td>{{$key+1}}</td>
                      <td>{{$data->name}}</td>
                      <td colspan="6">
                        <div class="switch-toggle switch-3 switch-candy">
                          <input class="present" id="present{{$key}}" type="radio" value="Present" name="attend_status{{$key}}" checked="checked"/>
                          <label for="present{{$key}}">Present</label>

                          <input class="leave" id="leave{{$key}}" type="radio" value="Leave" name="attend_status{{$key}}"/>
                          <label for="leave{{$key}}">Leave</label>

                          <input class="absent" id="absent{{$key}}" type="radio" value="Absent" name="attend_status{{$key}}" type="radio"/>
                          <label for="absent{{$key}}">Absent</label>
                        </div>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          @endif
          <div class="card-footer">
              <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-dot-circle-o"></i> 
              {{(@$editData?'Update':'Submit')}}</button> 
              <button type="reset" class="btn btn-danger btn-sm"><i class="fa fa-ban"></i> Reset </button>
          </div>
     </form>
 </div>
 <script type="text/javascript">
   $(document).on('click','.present',function(){
       $(this).parents('tr').find('.datetime').css('pointer-events','none').css('background-color','#dee2e6').css('color','#495057');

   });
   $(document).on('click','.leave',function(){
       $(this).parents('tr').find('.datetime').css('pointer-events','none').css('background-color','white').css('color','#495057');

   });
   $(document).on('click','.absent',function(){
       $(this).parents('tr').find('.datetime').css('pointer-events','none').css('background-color','#dee2e6').css('color','#dee2e6');

   });
 </script>
 <script type="text/javascript">
   $(document).on('click','.present_all',function(){
    $("input[value=Present]").prop('checked',true);
    $('.datetime').css('pointer-events','none').css('background-color','#dee2e6').css('color','#495057');
   }); 
   $(document).on('click','.leave_all',function(){
    $("input[value=Leave]").prop('checked',true);
    $('.datetime').css('pointer-events','none').css('background-color','white').css('color','#495057');
   });
   $(document).on('click','.absent_all',function(){
    $("input[value=Absent]").prop('checked',true);
    $('.datetime').css('pointer-events','none').css('background-color','#dee2e6').css('color','#dee2e6');
   });

 </script>
 <script type="text/javascript">
  $(document).ready(function() {
    $('#myForm').validate({
      rules: {
        "date" : {
          required: true,
        },
        "fname" : {
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