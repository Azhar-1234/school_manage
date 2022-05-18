@extends('backend.master')

@section('mainContent')
<div class="content row">
  <div class="card-header">
    <h1>Manage Student Fee Amount</h1>
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
      <h3 class="col-md-5">Students Fee Amount List</h3>
      <a href="{{route('add-feeAmount')}}"  type="button" class="btn btn-primary active ">
        <i class="fa fa-plus"></i> Add  Fee Amount
      </a>
      <a href="{{route('view-feeCategory')}}"  type="button" class="btn btn-primary active ml-1">
        <i class="fa fa-list"></i> View  Fee Category
      </a>
    </div>
    <table class="table bg-info text-light" >
        <thead>
           <tr>
              <th scope="col">#</th>
              <th scope="col"> Fee Category Name</th>
              <th scope="col">Action</th>
           </tr>
        </thead>
        <tbody>
          @foreach($allData as $key => $value)
	          <tr class="{{$value->id}}">
	             <th scope="row">{{$key+1}}</th>
	              <td>{{$value['fee_category']['name']}}</td>
	              <td>
	                <a href="{{route('edit-feeAmount',$value->fee_category_id)}}" class="btn btn-secondary"><i class="fa fa-edit"></i></a>
	              </td>
	              <td>
	                <a href="{{route('detail-feeAmount',$value->fee_category_id)}}" class="btn btn-secondary"><i class="fa fa-eye"></i></a>
	              </td>

	          </tr>
         @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection