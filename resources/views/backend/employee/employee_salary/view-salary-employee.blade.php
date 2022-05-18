@extends('backend.master')
@section('mainContent')
<div class="content row">
  <div class="card-header">
    <h1>Manage Employee Salary</h1>
  </div>
  <div class="col-md-10">
    <div class="row mt-3 mb-2">
      <h3 class="col-md "> Employee List</h3>
    </div>
    <table class="table">
        <thead>
           <tr>
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">ID No.</th>
              <th scope="col">Mobile NO.</th>
              <th scope="col">Address </th>
              <th scope="col">Gender </th>
              <th scope="col">Join Date</th>
              <th scope="col">Salary </th>            
              <th scope="col">Action</th> 
           </tr>
        </thead>
        <tbody>
          @foreach($allData as $key => $value)
            <tr class="{{$value->id}}">
               <th scope="row">{{++$key}}</th>
                <td>{{$value->name}}</td>
                <td>{{$value->id_no}}</td>
                <td>{{$value->mobile}}</td>
                <td>{{$value->address}}</td>
                <td>{{$value->gender}}</td>
                <td>{{date('d-m-Y',strtotime($value->join_date))}}</td>
                <td>{{$value->salary}}</td>
                <td>
                  <a title="Salary Increment" href="{{route('increment-salary-employee',$value->id)}}" class="btn btn-secondary"><i class="fa fa-plus-circle"></i></a>
                  <a title="details" target="" id="details" href="{{route('details-salary-employee',$value->id)}}" 
                    class="btn btn-warning"><i class="fa fa-eye"></i></a>
                </td>
            </tr>
          @endforeach
        </tbody>
    </table>
  </div>
</div>
@endsection