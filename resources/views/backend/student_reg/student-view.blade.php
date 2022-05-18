@extends('backend.master')

@section('mainContent')
<div class="content row">
  <div class="card-header">
    <h1 >Manage Student</h1>
  </div>
     
  <div class="col-md-12">
     <div class="card-body">
        @if ($message = Session::get('success'))
          <span class="text-success">{{ $message }}</span>
      </div>
                    
      <div class="card-body card-block">
        @elseif ($message = Session::get('danger'))
        <span class="text-danger">{{ $message }}</span>
      </div>
        @endif
    <div class="card">
      <div class="card-header">
        <h3>Student List <a href="{{route('add-student')}}" type="button" class="btn btn-primary btn-sm float-right active">
          <i class="fa fa-plus-circle"></i> add student </a>
        </h3>
      </div>
      <div class="card-body">
        <form method="GET" id="myForm" enctype="multipart/form-data"  action="{{route('year-class-wise')}}">
          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="exampleInputName2"  class="pr-1  form-control-label">Class Name <font style="color: red">*</font></label><br>
                <select name="class_id" class="form-control form-control-sm">
                 <option>Class</option>
                  @foreach($classes as $Class)
                    <option value="{{$Class->id}}"{{(@$class_id==$Class->id)?"selected":" "}}>{{$Class->name}}</option>
                  @endforeach
                </select>
              <font style="color: red">{{($errors->has('class'))? ($errors->first('name')):''}}</font>
            </div>
            <div class="form-group col-md-4">
              <label for="exampleInputName2"  class="pr-1  form-control-label">Year Name <font style="color: red">*</font></label><br>
                <select name="year_id" class="form-control form-control-sm">
                 <option>Year</option>
                  @foreach($years as $year)
                    <option value="{{$year->id}}"{{(@$year_id==$year->id)?"selected":" "}}>{{$year->name}}</option>
                  @endforeach
                </select>
              <font style="color: red">{{($errors->has('year'))? ($errors->first('name')):''}}</font>
            </div>
            <div class="form-group col-md-4">
              <button class="btn btn-sm btn-primary" style="margin-top: 29px" name="search">Search</button>
            </div>
          </div>
        </form>
      </div>
      @if(!@search)
      <div class="table-responsive-sm">
        <table class="table">
            <thead>
               <tr>
                  <th scope="col">#</th>
                  <th scope="col"> student Name</th>
                  <th scope="col">ID NO.</th>
                  <th scope="col">Roll</th>
                  <th scope="col">Image</th>
                  <th scope="col">Class</th>
                  <th scope="col">Year</th>
                  <th scope="col">Code</th>
                  <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
              @foreach($allData as $key => $value)
              <tr class="{{$value->id}}">
                  <th scope="row">{{++$key}}</th>
                  <td>{{$value['student']['name']}}</td>
                  <td>{{$value['student']['id_no']}}</td>
                  <td>{{$value['student']['roll']}}</td>
                  <td>{{$value['student']['code']}}</td>
                  <td>
                    <image id="showImage"  src="{{url(!empty($value['student']['image']))?url('public/upload/student_images/'.$value['student']['image']):url('public/upload/no_image.png')}}" 
                      style="height:70;width:80px;">
                  <td>{{$value['student_class']['name']}}</td>
                  <td>{{$value['year']['name']}}</td>
                  <td>
                    <a href="{{route('edit-student',$value->student_id)}}" class="btn btn-secondary btn-sm">
                    <i class="fa fa-edit"></i></a> 
                    <a href="{{route('promotion-student',$value->student_id)}}" class="btn btn-primary">
                    <i class="fa fa-check"></i></a>
                    <a href="{{route('details-student',$value->student_id)}}" class="btn btn-info">
                    <i class="fa fa-eye"></i></a> 
     

                  </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      @else
      <div class="table-responsive-sm">
        <table class="table">
            <thead>
               <tr>
                  <th scope="col">#</th>
                  <th scope="col"> student Name</th>
                  <th scope="col">ID NO.</th>
                  <th scope="col">Roll</th>
                  <th scope="col">Code</th>
                  <th scope="col">Image</th>
                  <th scope="col">Class</th>
                  <th scope="col">Year</th>
                  <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
              @foreach($allData as $key => $value)
              <tr class="{{$value->id}}">
                  <th scope="row">{{++$key}}</th>
                  <td>{{$value['student']['name']}}</td>
                  <td>{{$value['student']['id_no']}}</td>
                  <td>{{$value['student']['roll']}}</td>
                  <td>{{$value['student']['code']}}</td>
                  <td>
                    <image id="showImage"  src="{{url(!empty($value['student']['image']))?url('public/upload/student_images/'.$value['student']['image']):('public/upload/no_image.png')}}" style="height:70;width:80px;"> <td>{{$value['student_class']['name']}}</td>
                  <td>{{$value['year']['name']}}</td>
                  <td>
                    <a href="{{route('edit-student',$value->student_id)}}" title="edit" class="btn btn-secondary">
                    <i class="fa fa-edit"></i></a> 
                    <a href="{{route('promotion-student',$value->student_id)}}" title="promotion" class="btn btn-primary">
                    <i class="fa fa-check"></i></a> 
                    <a target="_blank" href="{{route('details-student',$value->student_id)}}" class="btn btn-info">
                    <i class="fa fa-eye"></i></a> 
                  </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      @endif
    </div>
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function() {
    $("#myForm").validate({
      rules: {
        "class_id" : {
          required: true,
        },
        "year_id" : {
          required: true,
        }, 
      },
      messages : {

      },
      errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
        element.closest('.form-group').append(error);
      },
      highlight: function(element, errorClass, validClass) {
          $(element).addClass('is-invalid');
        },
      unhighlight: function(element, errorClass, validClass) {
          $(element).removeClass('is-invalid');
        }

    });
  });
 </script>
@endsection