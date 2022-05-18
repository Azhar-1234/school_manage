@extends('backend.master')

@section('mainContent')
<div class="content row">
  <div class="card-header">
    <h1>Manage Assign subject</h1>
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
      <h3 class="col-md">Students subject List</h3>
      <a href="{{route('add-assign-subject')}}"  type="button" class="btn btn-primary active col-md-3">
        <i class="fa fa-plus-circle"></i> add Assign subject
      </a>
      <a href="{{route('view-subject')}}"  type="button" class="btn btn-primary active ml-1 col-md-3">
        <i class="fa fa-list"></i>  view subject
      </a>
    </div>
    <table class="table bg-info text-light" >
        <thead>
           <tr>
              <th scope="col">#</th>
              <th scope="col">Class Name</th>
              <th scope="col">Action</th>
           </tr>
        </thead>
        <tbody>
          @foreach($allData as $key => $value)
	          <tr class="{{$value->id}}">
	             <th scope="row">{{$key+1}}</th>
	              <td>{{$value['student_class']['name']}}</td>
	              <td>
	                <a href="{{route('edit-assign-subject',$value->class_id)}}" class="btn btn-secondary"><i class="fa fa-edit"></i></a>
                  <a href="{{route('detail-assign-subject',$value->class_id)}}" class="btn btn-secondary"><i class="fa fa-eye"></i></a>

	              </td>

	          </tr>
         @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection