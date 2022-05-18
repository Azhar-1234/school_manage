
@extends('backend.master')

@section('mainContent')
  <div class="content">
  <div class="row">
    <div class="col-md-8">
      <div class="row mb-2">
        <h1 class="col-md-10">Manage User</h1>
        <a href="{{route('add-user')}}"  type="button" class="btn btn-primary active col-md-2"><i class="fa fa-plus-circle"></i> Add User</a>
      </div>
      <table class="table">
          <thead>
             <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Code</th>
                <th scope="col">User Role</th>
                <th scope="col">Action</th>
              </tr>
        </thead>
          <tbody>
            @foreach($allUser as $key => $user)
            <tr>
               <th scope="row">{{++$key}}</th>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->code}}</td>
                <td>{{$user->role}}</td>
                <td>
                  <a href="{{route('edit-user',$user->id)}}" class="btn btn-secondary">Edit</a>
                  <a href="" class="btn btn-danger">Delete</a>
                </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection