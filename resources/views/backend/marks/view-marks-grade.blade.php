@extends('backend.master')

@section('mainContent')
<div class="content row">
  <div class="card-header">
    <h1>Manage Grade Point</h1>
  </div>
     
  <div class="col-md-10">
    <div class="row mt-3 mb-2">
      <h3 class="col-md"> Grade Point List     
          <a href="{{route('add-marks-grade')}}"  type="button" class="btn btn-primary active float-right "><i class="fa fa-plus-circle"></i>Add Grade Point</a>
       </h3>
    </div>
    <table class="table text-center">
        <thead>
           <tr>
              <th scope="col">#</th>
              <th scope="col">Grade Name</th> 
              <th scope="col">Grade Point</th> 
              <th scope="col">Start Marks</th> 
              <th scope="col">End Marks</th>
              <th scope="col">Point Range</th>  
              <th scope="col">Remarks</th> 
              <th scope="col">Action</th> 
            </tr>
        </thead>
        <tbody>
          @foreach($allData as $key => $value)
            <tr class="{{$value->id}}">
               <th scope="row">{{$key +1}}</th>
                <td>{{$value->grade_name}}</td>
                <td>{{number_format((float)$value->grade_point,2)}}</td>
                <td>{{$value->start_marks}}</td>
                <td>{{$value->end_marks}}</td>
                <td>
                  {{number_format((float)$value->grade_point,2) }} - {{($value->grade_point == 5)? (number_format( (float) $value->grade_point,2):(number_format ((float)$value->grade_point+1,2)}} - (float)0.01)}}
                </td>
                <td>{{$value->remarks}}</td>
                <td>
                  <a title="edit" href="{{route('edit-marks-grade',$value->id)}}" class="btn btn-secondary"><i class="fa fa-edit"></i></a>
                </td>
            </tr>
          @endforeach
        </tbody>
    </table>
  </div>
</div>

@endsection