<?php

namespace App\Http\Controllers\BackEnd\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BackEnd\Designation;
use App\Models\BackEnd\Employee\EmployeeSalaryLog;
use App\Models\BackEnd\Employee\LeavePurpose;
use App\Models\BackEnd\Employee\EmployeeLeave;
use App\Models\BackEnd\Employee\EmployeeAttendance;
use App\User;
use DB;
use Auth;


class EmployeeMonthlySalary extends Controller
{
    public function view(){
    	return view('backend.employee.employee_monthly_salary.view-monthly-salary');
    }
    public function get(Request $request){
    	$data = date('Y-m',strtotime($request->date));
    	if ($date !='') {
    		$where[] = ['date','like',$date.'%'];
    	}
    	$data = EmployeeAttendance::select('employee_id')->groupBy('employee_id')->with(['user'])->where($where)->get();
    	$html['thsource']  = '<th>SL<th>';
    	$html['thsource'] .= '<th>Employee Name</th>';
		$html['thsource'] .= '<th>Basic Salary</th>';
		$html['thsource'] .= '<th>Salary(this month)</th>';
		$html['thsource'] .= '<th>Action</th>';
		foreach ($data as $key => $attend) 
		{
			$totalattend = EmployeeAttendance::whith(['user'])->where($where)->where('employee_id',$attend->employee_id)->get();
			$absentcount = count($totalattend->where('attend_status','Absent'));
			$color = 'success';
			$html[$key]['tdsource']  = '<td>'.($key+1).'</td>';
			$html[$key]['tdsource'] .= '<td>'.$attend['user']['name'].'</td>';
			$html[$key]['tdsource'] .= '<td>'.$attend['user']['salary'].'</td>';
			$salary = (float)$attend['user']['salary'];
			$salaryperday = (float)$salary/30;
			$totalsalaryminus = (float)$absentcount*(float)$salaryperday;
			$totalsalary = (float)$salary-(float)$totalsalaryminus;
			$html[$key]['tdsource'] .= '<td>'.$totalsalary.'</td>';
			$html[$key]['tdsource'] .= '<td>';
			$html[$key]['tdsource'] .= '<a class="btn btn-sm btn-'.$color.'" title="Payslip" targer="_blank" href="'.route("employee.monthly.salary.payslip",$attend->employee_id).'">Pay Slip</td>';
			$html[$key]['tdsource'] = '</td>';
			return response()->json(@$html);
		}
    }
}
