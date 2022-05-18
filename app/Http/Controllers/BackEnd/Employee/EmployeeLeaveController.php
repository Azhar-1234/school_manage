<?php

namespace App\Http\Controllers\BackEnd\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\Student\AssignStudent;
use App\Models\Backend\Student\DiscountStudent;
use App\Models\Backend\StudentClass;
use App\Models\Backend\StudentGroup;
use App\Models\Backend\StudentShift;
use App\Models\Backend\StudentYear; 
use App\Models\BackEnd\AssignSubject;
use App\Models\BackEnd\FeeAmount;
use App\Models\BackEnd\FeeCategory;
use App\Models\BackEnd\ExamType;
use App\Models\BackEnd\Designation;
use App\Models\BackEnd\Employee\EmployeeSalaryLog;
use App\Models\BackEnd\Employee\LeavePurpose;
use App\Models\BackEnd\Employee\EmployeeLeave;
use App\User;
use DB;

class EmployeeLeaveController extends Controller
{
   	public  function view(){
       	$data['allData'] = EmployeeLeave::orderBy('id','desc')->get();
    	return view('backend.employee.employee_leave.view-leave-employee',$data);
    }
    public function add(){
       	$data['employees'] = User::where('usertype','employee')->get();
       	$data['leave_purpose'] = LeavePurpose::all();
	   	return view('backend.employee.employee_leave.add-leave-employee',$data);
    }
    public function store(Request $request){
		  if($request->leave_purpose_id == "0"){
        $leavepurpose = new LeavePurpose();
        $leavepurpose->name = $request->name;
        $leavepurpose->save();
        $leave_purpose_id = $leavepurpose->id;
      }else{
        $leave_purpose_id = $request->leave_purpose_id;
      }
      $employee_leave = new EmployeeLeave();
      $employee_leave->employee_id = $request->employee_id;
      $employee_leave->start_date  = date('Y-m-d',strtotime($request->start_date));
      $employee_leave->end_date    = date('Y-m-d',strtotime($request->end_date));
      $employee_leave->leave_purpose_id = $leave_purpose_id;
      $employee_leave->save();
	    return redirect()->route('view-leave-employee')->with('success','inserted sucessfully');
    }
    public function edit($id){
        $data['editData'] = EmployeeLeave::find($id);
        $data['employees'] = User::where('usertype','employee')->get();
        $data['leave_purpose'] = LeavePurpose::all();
      return view('backend.employee.employee_leave.add-leave-employee',$data);
   }
   public function update(Request $request,$id){
      if($request->leave_purpose_id == "0"){
        $leavepurpose = new LeavePurpose();
        $leavepurpose->name = $request->name;
        $leavepurpose->save();
        $leave_purpose_id = $leavepurpose->id;
      }else{
        $leave_purpose_id = $request->leave_purpose_id;
      }
      $employee_leave = EmployeeLeave::find($id);
      $employee_leave->employee_id = $request->employee_id;
      $employee_leave->start_date  = date('Y-m-d',strtotime($request->start_date));
      $employee_leave->end_date    = date('Y-m-d',strtotime($request->end_date));
      $employee_leave->leave_purpose_id = $leave_purpose_id;
      $employee_leave->save();
      return redirect()->route('view-leave-employee')->with('success','updated sucessfully');

   }

    
}
