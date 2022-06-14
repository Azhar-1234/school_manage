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
					</tr>
				</table>
			</div>
			<div class="col-md-12 text-center">
				<h5 style="font-weight: bold; padding-top: -25px">Results< of {{@$allData[0]['exam_type']['name']}}}</h5>
			</div>
			<div class="col-md-12">
				<hr style="border: solid 1px; width: 100%; color: #DDD;margin-bottom: 0px;">
				<table>
					<tr>
						<td><strong>Year/Session : </strong>{{@$allData[0]['year']['name']}}</td>
						<td></td>
						<td></td>
						<td><strong>Class:</strong>{{@$allData[0]['student_class']['name']}}}</td>
					</tr>
				</table>
			</div>
			<div class="col-md-12">
				<table border="1" width="100%">
					<thead>
						<tr>
							<th width="5%">SL.</th>
							<th>Student Name</th>
							<th>ID No</th>
							<th width="10%">Letter Grade</th>
							<th width="10%">Grade Point</th>
							<th width="15%">Remarks</th>
						</tr>
					</thead>
					<tbody>
						@foreach($allData as $key => $data)
						$allMarks = App\Models\backEnd\StudentMarks::where('year_id',$data->year_id)->where('class_id',$data->class_id)->
    				  where('exam_type_id',$data->exam_type_id)->where('student_id',$data->student_id)->get();
    				  $total_marks = 0;
    				  $total_point = 0;
    				  foreach($allMarks as $value){
    				  	$count_fail = App\Models\backEnd\StudentMarks::where('year_id',$value->year_id)->where('class_id',$value->class_id)->
    				  where('exam_type_id',$value->exam_type_id)->where('student_id',$value->student_id)->where('marks','<','33')->get()->count();
    				  $get_mark = $value->marks;
    				  $grade_marks = App\Models\backEnd\MarksGrade::where([['start_marks','<=',(int)$get_mark],['end_marks','>=',(int)$get_mark]])->first();
    				  $grade_name = $grade_marks->grade_name;
    				  $grade_point = number_format((float)$grade_marks->grade_point,2);
    				  $total_point = (float)$total_point+(float)$grade_point;
    				}
    				@endphp
						<tr>
							<td>{{$key+1}}</td>
							<td>{{$data['student']['name']}}</td>
							<td>{{$data['student']['id_no']}}</td>
							@php 
								$total_subject = App\Models\backEnd\StudentMarks::where('year_id',$data->year_id)->where('class_id',$data->class_id)->
    							where('exam_type_id',$data->exam_type_id)->where('student_id',$data->student_id)->get()->count();
    				  			$total_grade = 0;
    				  			$point_for_letter_grade = (float)$total_point/(float)$total_subject;
                    			$total_grade = App\Models\Backend\MarksGrade::where(['start_point','<=',$point_for_letter_grade],['end_point','>=',$point_for_letter_grade])->first();
                    			$grade_point_avg = (float)$total_point/(float)$total_subject;
                  			@endphp
							<td>
								@if($count_fail > 0)
								Fail
								@else
								{{$total_grade->grade_name}}
								@endif
							</td>
							<td>
								@if($count_fail > 0)
								0.00
								@else
								{{number_format((float)$grade_point_avg,2)}}
								@endif
							</td>
						</tr>
						@endforeach
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