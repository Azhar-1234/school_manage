@extends('backend.master')

@section('mainContent')
<div class="content row">
  <div class="card-header">
    <h1>Manage Student Classs</h1>
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
      <h3 class="col-md-9">Student Class List</h3>
      <a href="{{route('add-class')}}"  type="button" class="btn btn-primary active col-md-3"><i class="fa fa-plus-circle"></i> add student class</a>
    </div>
    <table class="table">
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
             <th scope="row">{{++$key}}</th>
              <td>{{$value->name}}</td>
              <td>
                <a href="{{route('edit-class',$value->id)}}" class="btn btn-secondary"><i class="fa fa-edit"></i></a>
                <a title="delete" id="delete" href="{{route('delete-class',$value->id)}}" onclick="return confirm('are you sure?')" 
                  class="btn btn-danger" data-id="{{$value->id}}"><i class="fa fa-trash"></i></a>
              </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection