<!DOCTYPE html>
<html>
<head>
	<title>Employee Attendance Report</title>
	<style type="text/css">
		table{
			border-collapse: collapse;
		}
		h2 h3{
			margin: 0;
			padding: 0;
		}
		.table{
			width: 100%;
			margin-bottom: 1rem;
			background-color: transparent;
		}
		.table th
		.table td{
			padding: 0.75rem;
			vertical-align: top;
			border-top: 1px solid #dee2e6;
		}
		.table thead th{
			vertical-align: bottom;
			border-bottom: 2px solid #dee2e6;
		}
		.table tbody + tbody{
			border-bottom: 2px solid #dee2e6;
		}
		.table .table{
			background-color: #fff;
		}
		.table-bordered{
			border: 1px solid #dee2e6;
		}
		.table-bordered th
		.table-bordered td{
			border: 1px solid #dee2e6;
		}
		.table-bordered th
		.table-bordered td{
			border: 1px solid #dee2e6;
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
		.table-bordered thead th,
		.table-bordered td,
		.table-bordered th{
			border: 1px solid #dee2e6;
		}
		.table-bordered thead th{
			background-color: #cacaca;
		}

	</style>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<table width="80%">
					<tr>
						<td width="33%" class="text-center">
              				<img src="{{url('public/backend/images/logo.jfif')}}" style="width: 70px;height: 70px;">
						</td>
						<td class="text-center" width="64%">
							<h4><strong>Darut Tawheed madania</strong></h4>	
							<h4><strong>Nazir road-1 feni</strong></h4>
						</td>
						<td class="text-center">
							<img src="{{(!empty($allData['0']['user']['image']))?url('public/assets/backend/upload/employees/'.$allData['0']['user']['image']):url('public/assets/backend/upload/default.png')}}" style="width: 70px; height: 70px;">
						</td>
					</tr>
				</table>
			</div>
			<div class="col-md-12 text-center">
				<h5 style="font-weight: bold; padding-top: -25px">Employee Monthly Salary</h5>
			</div>
			<div class="col-md-12">
				<strong>Employee Name :</strong> {{$allData['0']['user']['name']}}, <strong>ID No :</strong>
				{{$allData['0']['user']['id_no']}}, <strong>Month :</strong> {{$month}}
				<table border="1" width="100%">
					<thead>
						<tr>
							<th>Date</th>
							<th>Attend Status</th>
						</tr>
					</thead>
					<tbody>
						@foreach($allData as $value)
						<tr>
							<td style="width: 50%">{{date('d-m-Y',strtotime($value->date))}}</td>
							<td>{{$value->attend_status}}</td>
						</tr>
						@endforeach
						<tr>
						  <td colspan="2">
						  	<strong>Total Absent :</strong> {{$absents}}, <strong>Total Leave :</strong> {{$leaves}}
						  </td>
						</tr>
					</tbody>
				</table>
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