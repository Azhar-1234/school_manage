@extends('backend.master')
@section('mainContent')
<div class="content row">
  <div class="card-header">
    <h1>Manage Employee Salary</h1>
  </div>
     
  <div class="col-md-10">
    <div class="row mt-3 mb-2">
      <h3 class="col-md"> Employee Salary List     
          <a href="{{route('Accounts-employee-add')}}"  type="button" class="btn btn-primary active float-right "><i class="fa fa-plus-circle"></i>Add/Edit Employee Salary</a>
       </h3>
    </div>
    <table class="table text-center" id="example1" class="table table-bordered table-striped">
        <thead>
           <tr>
              <th scope="col">#</th>
              <th scope="col">ID NO.</th>  
              <th scope="col">Name</th> 
              <th scope="col">Amount</th>     
              <th scope="col">Date</th>       
            </tr>
        </thead>
        <tbody>
          @foreach($allData as $key => $data)
            <tr class="{{$data->id}}">
               <th scope="row">{{$key +1}}</th>
                <td>{{$data['user']['id_no']}}</td>
                <td>{{$data['user']['name']}}</td>
                <td>{{$data->amount}}</td>
                <td>{{date('M Y',strtotime($data->date))}}</td>
            </tr>
          @endforeach
        </tbody>
    </table>
  </div>
</div>
@endsection