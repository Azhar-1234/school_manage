@extends('backend.master')

@section('mainContent')
<div class="content row">
  <div class="card-header">
    <h1>Manage  Assign Subject</h1>
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
      <h3 class="col-md-8">Students Assign Subject Details</h3>
       <a href="{{route('view-assign-subject')}}"  type="button" class="btn btn-primary float-right active col-md-3">
          <i class="fa fa-list"></i> Assign Subject List
       </a>
    </div>
    <table class="table bg-info text-light" >
        <h4 class="bg-light">Class Name:<strong>{{$editData[0]['student_class']["name"]}}</strong></h4>
        <thead>
           <tr>
              <th scope="col">#</th>
              <th scope="col">Subject Name</th>
              <th scope="col">Full Mark</th>
              <th scope="col">Pass Mark</th>
              <th scope="col">Subjective Mark</th>
            </tr>
        </thead>
        <tbody>
          @foreach($editData as $key => $value)
	          <tr class="{{$value->id}}">
	              <th scope="row">{{$key+1}}</th>
	              <td>{{$value['subject']['name']}}</td>
                <td>{{$value->full_mark}}</td>
                <td>{{$value->pass_mark}}</td>
                <td>{{$value->subjective_mark}}</td>
	          </tr>
         @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection