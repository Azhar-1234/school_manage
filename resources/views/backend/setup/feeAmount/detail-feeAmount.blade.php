@extends('backend.master')

@section('mainContent')
<div class="content row">
  <div class="card-header">
    <h1>Manage Fee Category Amount</h1>
  </div>
  <div class="col-md-8">
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
      <h3 class="col-md-8">Students Fee Amount Details</h3>
       <a href="{{route('view-feeAmount')}}"  type="button" class="btn btn-primary float-right active col-md-3">
          <i class="fa fa-list"></i>  Fee Amount List
       </a>
    </div>
    <table class="table bg-info text-light" >
        <h4 class="bg-light">Fee Type:<strong>{{$editData[0]['fee_category']["name"]}}</strong></h4>
        <thead>
           <tr>
              <th scope="col">#</th>
              <th scope="col">Class Name</th>
              <th scope="col">Amount</th>
            </tr>
        </thead>
        <tbody>
          @foreach($editData as $key => $value)
	          <tr class="{{$value->id}}">
	             <th scope="row">{{$key+1}}</th>
	              <td>{{$value['student_class']['name']}}</td>
                <td>{{$value->amount}}</td>

	          </tr>
         @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection