@extends('backend.master')
@section('mainContent')
<div class="card col-md-10 m-3 pt-3">
    <div class="card-header">
        @if(isset($editData))    
            <strong>Edit</strong>Other Cost
        @else
            <strong>Add</strong>Other Cost
        @endif
        <a href="{{route('other-cost-add')}}"  type="button" class="btn btn-primary float-right active col-md-2">
          <i class="fa fa-list"></i>Other Cost List
         </a>
     </div>
     <div class="card-body">
         <form action="{{@$editData?route('other-cost-update',$editData->id):route('other-cost-store')}}" method="post" id="myForm" enctype="multipart/form-data" class="">
            @csrf
            <div  class="form-row">
                <div class="form-group col-md-2">
                    <label>Date</label>
                    <input type="date" name="date" value="{{date('d-m-Y',strtotime(@$editData->date))}}" class="form-control">
                </div>
                <div class="form-group" class="col-md-2">
                    <label>Amount</label>
                    <input type="text" name="amount" value="{{@$editData->amount}}" class="form-control">
                </div>
                <div class="form-group" class="col-md-2" style="margin-left: 10px">
                    <label>Image</label>
                    <input type="file" name="image" id="image" class="form-control">
                </div>
                <div class="form-group col-md-4" style="margin-left: 10px">
                    <img id="showImage" src="{{(!empty($editData->image))?url('pulic/upload/cost_images/'.@$editData->image):url('public/upload/no_image.png')}}" style="width: 300px;height: 100px;border:1px solid #000">
                </div>
                <div class="form-group" class="col-md-12">
                    <label>Description</label>
                    <textarea name="description" rows="4" class="form-control" style="width:600px">{{@$editData->description}}</textarea>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-dot-circle-o"></i> {{(@$editData?'Update':'Submit')}} </button> 
                <button type="reset" class="btn btn-danger btn-sm">  <i class="fa fa-ban"></i> Reset </button>
            </div>
         </form>
     </div>   
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('#myForm').validate({
            rules:{
                date:{
                    required:true,
                },
                amount:{
                    required:true,
                },
                description:{
                    required:true,
                },
            }
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