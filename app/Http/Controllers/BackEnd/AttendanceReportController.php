<?php

namespace App\Http\Controllers\backEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\Employee\EmployeeSalaryAccount;
use App\Models\Backend\Employee\EmployeeAttendance;
use PDF;
class AttendanceReportController extends Controller
{
  public function view(){
   	$data['employees'] = User::where('usertype','employee')->get();
   	return view('backend.report.attend-report',$data);
  }
  public function attendanceGet(Request $request) {
  	$employee_id = $request->employee_id;
  	if ($employee_id !='') {
  		$where[] = ['employee_id',$employee_id];
  	}
  	$date = date('Y-m',strtotime($request->date));
  	if ($date !='') {
  		$where[] = ['date','like',$date.'%'];
  	}
  	$singleAttendance = EmployeeAttendance::with(['user'])->where($where)->first();
   	if ($singleAttendance == true) {
  		$data['allData'] = EmployeeAttendance::with(['user'])->where($where)->get();
  		$data['absent'] = EmployeeAttendance::with(['user'])->where($where)->where('attend_user','Absent')->get()->count();
  		$data['leaves'] = EmployeeAttendance::with(['user'])->where($where)->where('attend_user','Leave')->get()->count();
  		$data['month'] = date('M Y',strtotime($request->date));
  		$pdf = PDF::loadView('backend.report.attend-report-pdf',$data);
  		$pdf->SetProtection(['copy','print','','pass']);
  		return $pdf->stream('document.pdf');
  	}else{
  		return redirect()->back()->with('error','sorry! These criteria does not match');
  	}
  }
}
