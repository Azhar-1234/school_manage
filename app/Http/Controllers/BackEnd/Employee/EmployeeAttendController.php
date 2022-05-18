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
use App\Models\BackEnd\Employee\EmployeeAttendance;
use App\User;
use DB;

class EmployeeAttendController extends Controller
{
   	public  function view(){
       	$data['allData'] = EmployeeAttendance::select('date')->groupBy('date')->orderBy('id','DESC')->get();
		return view('backend.employee.employee_attend.view-attend-employee',$data);
    }
    public function add(){
       	$data['employees'] = User::where('usertype','employee')->get();
	   	return view('backend.employee.employee_attend.add-attend-employee',$data);
    }
    public function store(Request $request){
    	EmployeeAttendance::where('date',date('Y-m-d',strtotime($request->date)))->delete();
    	$countemployee = count($request->employee_id);
    	for ($i=0; $i <$countemployee ; $i++) { 
    		$attend_status = 'attend_status'.$i;
    		$attend = new EmployeeAttendance();
    		$attend->date = date('Y-m-d',strtotime($request->date));
    		$attend->employee_id = $request->employee_id[$i];
    		$attend->attend_status = $request->$attend_status;
    		$attend->save();
    	}
	    return redirect()->route('view-attend-employee')->with('success','inserted sucessfully');
    }
    public function edit($date){
        $data['editData'] = EmployeeAttendance::where('date',$date)->get();
       	$data['employees'] = User::where('usertype','employee')->get();
	   	return view('backend.employee.employee_attend.add-attend-employee',$data);
   }
   public function update(Request $request,$id){
      if($request->leave_purpose_id == "0"){
        $leavepurpose = new LeavePurpose();
        $leavepurpose->name = $request->name;
        $leavepurpose->save();
        $leave_purpose_id = $leavepurpose->id;
      }
      else{
        $leave_purpose_id = $request->leave_purpose_id;
      }
      $employee_leave = EmployeeLeave::find($id);
      $employee_leave->employee_id = $request->employee_id;
      $employee_leave->start_date  = date('Y-m-d',strtotime($request->start_date));
      $employee_leave->end_date    = date('Y-m-d',strtotime($request->end_date));
      $employee_leave->leave_purpose_id = $leave_purpose_id;
      $employee_leave->save();
      return redirect()->route('view-attend-employee')->with('success','updated sucessfully');

   }
    public function details($id){
	    $data['details'] = User::find($id);
	    $pdf = PDF::loadView('backend.employee.employee_reg.employee-details-pdf', $data);
	        $pdf->SetDisplayMode('default','continuous'); // continuous not documented, although should work.

	    $pdf->setOptions(['copy','print'],'','pass');

	    return $pdf->stream('document.pdf');
   }
}

 