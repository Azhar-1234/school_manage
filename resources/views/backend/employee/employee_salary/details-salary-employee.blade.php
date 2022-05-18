@extends('backend.master')

@section('mainContent')
<div class="card col-md-8 m-3 pt-3">
  <div class="card-header ">
    <strong>Details</strong> Salary Employee Information
      <a href="{{route('view-salary-employee')}}"  type="button" class="btn btn-primary float-right active"><i class="fa fa-list"></i>Employee List</a>
   </div>
   <div class="card-body">
    <strong>Employee Name: </strong>{{$details->name}},ID NO: {{$details->id_no}}
     <table class="table">
        <thead>
           <tr>
              <th scope="col">SL.</th>
              <th scope="col">Previous Salary</th>
              <th scope="col">Increment Salary</th>
              <th scope="col">Present Salary</th>
              <th scope="col">Effected Date</th>
           </tr>
        </thead>
        <tbody>
          @foreach($salary_log as $key => $value)
          <tr>
            @if($key=='0')
            <td class="text-center" colspan="5">joining salary: {{$value->previous_salary}}</td>
            @else
            <td>{{++$key}}</td>
            <td>{{$value->previous_salary}}</td>
            <td>{{$value->increment_salary}}</td>
            <td>{{$value->present_salary}}</td>
            <td>{{date('Y-m-d',strtotime($value->effected_date))}}</td>
            @endif
          </tr>
          @endforeach
        </tbody>
     </table>
   </div>
</div>
 @endsection