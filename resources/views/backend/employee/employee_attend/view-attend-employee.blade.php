@extends('backend.master')

@section('mainContent')
<div class="content row">
  <div class="card-header">
    <h1>Manage Employee Attend</h1>
  </div>
     
  <div class="col-md-8">
    <div class="row mt-3 mb-2">
      <h3 class="col-md"> Employee Attend List     
          <a href="{{route('add-attend-employee')}}"  type="button" class="btn btn-primary active float-right "><i class="fa fa-plus-circle"></i> Add Employee Attend</a>
       </h3>
    </div>
    <table class="table">
        <thead>
           <tr>
              <th scope="col">#</th>
              <th scope="col">name</th> 
              <th scope="col">Date</th>   
              <th scope="col">Action</th> 
            </tr>
        </thead>
        <tbody>
          @foreach($allData as $key => $value)
            <tr class="{{$value->id}}">
               <th scope="row">{{++$key}}</th>
                <td>{{$value->name}}</td>
                <td>{{date('Y-m-d',strtotime($value->date))}}</td>
                <td>
                  <a title="edit" href="{{route('edit-attend-employee',$value->date)}}" class="btn btn-secondary"><i class="fa fa-edit"></i></a>
                </td>
            </tr>
          @endforeach
        </tbody>
    </table>
  </div>
</div>
@endsection