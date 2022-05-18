<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="{{asset('backend/assets/css/bootstrap.min.css')}}">
	<title>student Registration with pdf</title>
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
						<td width="33%" class="text-center"><img src="{{url('public/upload/student_images/sample.png')}}" style="width: 100px,height:100px"></td>
						<td class="text-center" width="33%">
							<h4><strong>Darut Tawheed Madania</strong></h4>
							<h5><strong>Nazir Road Feni</strong></h5>
							<h6><strong>www.daruttawheed.madania.com</strong></h6>
						</td>
						<td width="33%" class="text-center"><img src="{{url('public/upload/employee_images/'.$details->image)}}" style="width: 100px,height:100px"></td>
					</tr>
				</table>
			</div>
			<div class="col-md-12 text-center">
				<h5 style="font-weight: bold;padding-top: -25px">Emmployee Registration Card</h5>
			</div>
			<div class="col-md-12">
				<table border="1" width="100%">
					<tbody>
						<tr>
							<td style="width: 50%">Student Name</td>
							<td>{{$details->name}}</td>
						</tr>
						<tr>
							<td style="width: 50%">Father's Name</td>
							<td>{{$details->fname}}</td>
						</tr>
						<tr>
							<td style="width: 50%">Mother's Name</td>
							<td>{{$details->mname}}</td>
						</tr>
						<tr>
							<td style="width: 50%">Email</td>
							<td>{{$details->email}}</td>
						</tr>
						<tr>
							<td style="width: 50%">ID NO.</td>
							<td>{{$details->id_no}}</td>
						</tr>
						<tr>
							<td style="width: 50%">Designation</td>
							<td>{{$details['designation']['name']}}</td>
						</tr>
						<tr>
							<td style="width: 50%">Salary</td>
							<td>{{$details->salary}}</td>
						</tr>
						<tr>
							<td style="width: 50%">Mobile NO.</td>
							<td>{{$details->mobile}}</td>
						</tr>
						<tr>
							<td style="width: 50%">Address</td>
							<td>{{$details->address}}</td>
						</tr>
						<tr>
							<td style="width: 50%">Gender</td>
							<td>{{$details->gender}}</td>
						</tr>
						<tr>
							<td style="width: 50%">Address</td>
							<td>{{$details->address}}</td>
						</tr>
						<tr>
							<td style="width: 50%">Religion</td>
							<td>{{$details->religion}}</td>
						</tr>
						<tr>
							<td style="width: 50%">Date Of Birth</td>
							<td>{{date('d-m-Y',strtotime($details->dob))}}</td>
						</tr>
						<tr>
							<td style="width: 50%">Date Of Join</td>
							<td>{{date('d-m-Y',strtotime($details->join_date))}}</td>
						</tr>
					</tbody>
				</table>
				<i style="font-size:10px;float:right;">Print Date: {{date("d M Y")}}</i>
			</div>
		</div><br>
		<div class="col-md-12">
			<table border="0" width="100%">
				<tbody>
					<tr>
						<td width="30%"></td>
						<td width="30%"></td>
						<td width="40%" style="text-align: center;"></td>
						<hr style="border:solid 1px;width: 60px;color: #000;margin-bottom: 0px">
						<p style="text-align: center;">Principal</p>
					</tr>
				</tbody>
			</table>
		</div>
	</div>

</body>
</html>