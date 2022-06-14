@extends('backend.master')
@section('mainContent')
<div class="content row">
  <div class="card-header">
    <h1>Manage Other Cost</h1>
  </div>
     
  <div class="col-md-10">
    <div class="row mt-3 mb-2">
      <h3 class="col-md"> Employee Other Cost     
          <a href="{{route('other-cost-add')}}"  type="button" class="btn btn-primary active float-right "><i class="fa fa-plus-circle"></i>Add/Edit Other Cost</a>
       </h3>
    </div>
    <table class="table text-center" id="example1" class="table table-bordered table-striped">
        <thead>
           <tr>
              <th scope="col">#</th>
              <th scope="col">Date</th> 
              <th scope="col">Amount</th>
              <th scope="col">Description</th>
              <th scope="col">Image</th>
              <th scope="col">Action</th>                                                
            </tr>
        </thead>
        <tbody>
          @foreach($allData as $key => $data)
            <tr class="{{$data->id}}">
               <th scope="row">{{$key +1}}</th>
               <td>{{date('d-m-y',strtotime($data->date))}}</td>
               <td>{{$data->amount}}</td>
               <td>{{$data->description}}</td>
               <td>
                 <img src="{{(!empty($data->image))?url('public/upload/cost_images/'.$data->image):url('pulic/assets/backend/upload/default.png')}}" width="90px" height="60px">
               </td>
               <td>
                 <a href="{{route('other-cost-edit',$data->id)}}" class="btn btn-info btn-sm" title="Edit"><i class="fa fa-edit"></i></a>
               </td>
            </tr>
          @endforeach
        </tbody>
    </table>
  </div>
</div>
@endsection