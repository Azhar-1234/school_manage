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
use App\User;
use DB;
use PDF; 
use Mpdf;

class EmployeeSalaryController extends Controller
{
   	public  function view(){
       	$data['allData'] = User::where('usertype','employee')->get();
    	return view('backend.employee.employee_salary.view-salary-employee',$data);
    }
    public function increment($id){
    	$data['editData'] = User::find($id);
   	   	return view('backend.employee.employee_salary.increment-salary-employee',$data);

   }
   public function store(Request $request,$id){
   		$user = User::find($id);
   		$previous_salary = $user->salary;
   		$present_salary = (float)$previous_salary+(float)$request->increment_salary;
   		$user->salary = $present_salary;
   		$user->save();
   		$salaryData = new EmployeeSalaryLog();
   		$salaryData->employee_id = $id;
   		$salaryData->previous_salary = $previous_salary;
   		$salaryData->increment_salary = $request->increment_salary;
   		$salaryData->present_salary = $present_salary;
   		$salaryData->effected_date = date('Y-m-d',strtotime($request->effected_date));
   		$salaryData->save();
   		return redirect()->route('view-salary-employee')->with('success','data successfully incremeneted');

   }
     public function details($id){
	    $data['details'] = User::find($id);
      $data['salary_log'] = EmployeeSalaryLog::where('employee_id',$data['details']->id)->get();
      return view('backend.employee.employee_salary.details-salary-employee',$data);


   }

	    
}
