@extends('backend.master')

@section('mainContent')
<div class="content row">
  <div class="card-header">
    <h1>Manage Employee Leave</h1>
  </div>
     
  <div class="col-md-8">
    <div class="row mt-3 mb-2">
      <h3 class="col-md"> Employee List Leave    
          <a href="{{route('add-leave-employee')}}"  type="button" class="btn btn-primary active float-right "><i class="fa fa-plus-circle"></i> Add Employee Leave</a>
       </h3>
    </div>
    <table class="table">
        <thead>
           <tr>
              <th scope="col">#</th>
              <th scope="col">Name </th>
              <th scope="col">ID No </th> 
              <th scope="col">Leave Purpose</th> 
              <th scope="col">Start Date</th>  
              <th scope="col">Action</th> 
            </tr>
        </thead>
        <tbody>
          @foreach($allData as $key => $value)
            <tr class="{{$value->id}}">
               <th scope="row">{{++$key}}</th>
                <td>{{$value['user']['name']}}</td>
                <td>{{$value['user']['id_no']}}</td>
                <td>{{$value['purpose']['name']}}</td>
                <td>{{date('Y-m-d',strtotime($value->start_date))}} to {{date('Y-m-d',strtotime($value->end_date))}}</td>
                <td>
                  <a title="edit" href="{{route('edit-leave-employee',$value->id)}}" class="btn btn-secondary"><i class="fa fa-edit"></i></a>
                </td>
            </tr>
          @endforeach
        </tbody>
    </table>
  </div>
</div>
@endsection