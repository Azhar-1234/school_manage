<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="{{asset('backend/assets/css/bootstrap.min.css')}}">
	<title>student exam Fee</title>
	<style type="text/css">
		table{
			border-collapse: collapse;
		}
		h2,h3{
			margin: 0;
			padding: 0;
		}
		.table{
			width: 100%;
			margin-bottom: 1rem;
			border-color: transparent;
		}
		.table th,
		.table td{
			padding: 0.75rem;
			vertical-align: top;
			border-top: 1px solid #dee2ed;
		}
		.table thead th{
			vertical-align: bottom;
			border-bottom: 2px solid #dee2ed;

		}
		.table-bordered thead th,
		.table-bordered thead td{
			border-bottom-width: 2px;
		}
		.text-center{
			text-align: center;
		}
		.text-right{
			text-align: right;
		}
		table tr td{
			padding: 5px;
		}
		.table-bordered thead th, .table-bordered td, .table-bordered  th{
			border:1px solid black !important;
		}
		.table-bordered thead th{
			background-color: #cacac;
		}

	</style>
</head>
<body>
	<div class="container">
		<div class="row" id="myForm" enctype="multipart/form-data" >
			<div class="col-md-12 text-center">
				<table width="100%">
					<tr>
						<td width="33%" class="text-center"><img src="{{url('public/upload/student_images/sample.png')}}" style="width: 60px,height:60px"></td>
						<td class="text-center" width="33%">
							<div>Darut Tawheed Madania</div>
							<div>Nazir Road Feni</div>
							<div>www.daruttawheed.madania.com</div>
						</td>
						<td width="33%" class="text-center"><img src="{{url('public/upload/student_images/'.$details['student']['image'])}}" style="width:60px,height:60px"></td>
					</tr>
				</table>
			</div>
			<div class="col-md-12 text-center">
				<h3 style="font-weight: bold;padding-top: -10px;padding-bottom: 10px">Student Exam Fee</h3>
			</div>
			<div class="col-md-12">
				@php 
					 $registrationfee = App\Models\BackEnd\FeeAmount::where('fee_category_id','3')->where('class_id',$details->class_id)->first();
			    	 $originalfee = $registrationfee->amount;
			    	 $discount = $details['discount']['discount'];
			    	 $discountablefee = $discount/100*$originalfee;
			    	 $finalfee = (float)$originalfee-(float)$discountablefee;
				@endphp
				<table border="1" width="100%">
					<tbody>
						<tr>
							<td style="width: 50%">ID No.</td>
							<td>{{$details['student']['id_no']}}</td>
						</tr>
						<tr>
							<td style="width: 50%">Roll</td>
							<td>{{$details->roll}}</td>
						</tr>
						<tr>
							<td style="width: 50%">Student Name</td>
							<td>{{$details['student']['name']}}</td>
						</tr>
						<tr>
							<td style="width: 50%">Father's Name</td>
							<td>{{$details['student']['fname']}}</td>
						</tr>
						<tr>
							<td style="width: 50%">Mother's Name</td>
							<td>{{$details['student']['mname']}}</td>
						</tr>
						<tr>
							<td style="width: 50%">Year</td>
							<td>{{$details['year']['name']}}</td>
						</tr>
						<tr>
							<td style="width: 50%">Class</td>
							<td>{{$details['student_class']['name']}}</td>
						</tr>
						<tr>
							<td style="width: 50%">Exam Fee</td>
							<td>{{$originalfee}} TK</td>
						</tr>
						<tr>
							<td style="width: 50%">Discount Fee</td>
							<td>{{$discount}}%</td>
						</tr>
						<tr>
							<td style="width: 50%">Fee (This Student) of {{$exam_name}}</td>
							<td>{{$finalfee}} TK</td>
						</tr>
					</tbody>
				</table>
				<i style="font-size:10px;float:left;">Print Date: {{date("d M Y")}}</i>
			</div>
			<div class="col-md-12">
				<table border="0" width="100%">
					<tbody>
						<tr>
							<td width="30%"></td>
							<td width="30%"></td>
							<td width="40%" style="text-align: center;"></td>
							<p style="text-align: center;">Principal</p>
						</tr>
					</tbody>
				</table>
			</div>
		</div><br>
		<hr class="" style="border: dashed 1px;color: #DDD; margin-bottom: 10px;">
		<div class="row" id="myForm" enctype="multipart/form-data" >
			<div class="col-md-12 text-center">
				<table width="100%">
					<tr>
						<td width="33%" class="text-center"><img src="{{url('public/upload/student_images/sample.png')}}" style="width: 60px,height:60px"></td>
						<td class="text-center" width="33%">
							<div>Darut Tawheed Madania</div>
							<div>Nazir Road Feni</div>
							<div>www.daruttawheed.madania.com</div>
						</td>
						<td width="33%" class="text-center"><img src="{{url('public/upload/student_images/'.$details['student']['image'])}}" style="width: 70px,height:70px"></td>
					</tr>
				</table>
			</div>
			<div class="col-md-12 text-center">
				<h3 style="font-weight: bold;padding-top: -10px;padding-bottom: 10px;">Student Exam Fee</h3>
			</div>
			<div class="col-md-12">
				@php 
					 $registrationfee = App\Models\BackEnd\FeeAmount::where('fee_category_id','1')->where('class_id',$details->class_id)->first();
			    	 $originalfee = $registrationfee->amount;
			    	 $discount = $details['discount']['discount'];
			    	 $discountablefee = $discount/100*$originalfee;
			    	 $finalfee = (float)$originalfee-(float)$discountablefee;
				@endphp
				<table border="1" width="100%">
					<tbody>
						<tr>
							<td style="width: 50%">ID No.</td>
							<td>{{$details['student']['id_no']}}</td>
						</tr>
						<tr>
							<td style="width: 50%">Roll</td>
							<td>{{$details->roll}}</td>
						</tr>
						<tr>
							<td style="width: 50%">Student Name</td>
							<td>{{$details['student']['name']}}</td>
						</tr>
						<tr>
							<td style="width: 50%">Father's Name</td>
							<td>{{$details['student']['fname']}}</td>
						</tr>
						<tr>
							<td style="width: 50%">Mother's Name</td>
							<td>{{$details['student']['mname']}}</td>
						</tr>
						<tr>
							<td style="width: 50%">Year</td>
							<td>{{$details['year']['name']}}</td>
						</tr>
						<tr>
							<td style="width: 50%">Class</td>
							<td>{{$details['student_class']['name']}}</td>
						</tr>
						<tr>
							<td style="width: 50%">Exam Fee</td>
							<td>{{$originalfee}} TK</td>
						</tr>
						<tr>
							<td style="width: 50%">Discount Fee</td>
							<td>{{$discount}}%</td>
						</tr>
						<tr>
							<td style="width: 50%">Fee (This Student) of {{$exam_name}}</td>
							<td>{{$finalfee}} TK</td>
						</tr>
					</tbody>
				</table>
				<i style="font-size:10px;float:left; margin-bottom: 10px;margin-top: 10px">Print Date: {{date("d M Y")}}</i>
			</div>
			<div class="col-md-12">
				<table border="0" width="100%">
					<tbody>
						<tr>
							<td width="30%"></td>
							<td width="30%"></td>
							<td width="40%" style="text-align: center;"></td>
							<p style="text-align: center;margin-top:0">Principal</p>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>

</body>
</html>