@extends('backend.master')

@section('mainContent')
<div class="content row">
  <div class="card-header">
    <h1>Manage Employee</h1>
  </div>
     
  <div class="col-md-10">
     <div class="card-body">
        @if ($message = Session::get('success'))
          <span class="text-success">{{ $message }}</span>
      </div>
                    
      <div class="card-body card-block">
        @elseif ($message = Session::get('danger'))
        <span class="text-danger">{{ $message }}</span>
     </div>
        @endif
    <div class="row mt-3 mb-2">
      <h3 class="col-md"> Employee List     
          <a href="{{route('add-reg-employee')}}"  type="button" class="btn btn-primary active float-right "><i class="fa fa-plus-circle"></i> Add Employee</a>
       </h3>
    </div>
    <table class="table">
        <thead>
           <tr>
              <th scope="col">#</th>
              <th scope="col">Name </th>
              <th scope="col">ID No </th>
              <th scope="col">Mobile NO. </th>
              <th scope="col">Address </th>
              <th scope="col">Gender </th>
              <th scope="col">Join Date</th>
              <th scope="col">Salary </th>
              <th scope="col">Code</th>             
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
                <td>{{$value->code}}</td>
                <td>
                  <a title="edit" href="{{route('edit-reg-employee',$value->id)}}" class="btn btn-secondary"><i class="fa fa-edit"></i></a>
                  <a title="details" target="_blank" id="details" href="{{route('details-reg-employee',$value->id)}}" 
                    class="btn btn-warning"><i class="fa fa-eye"></i></a>
                </td>
            </tr>
          @endforeach
        </tbody>
    </table>
  </div>
</div>
@endsection