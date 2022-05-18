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

class EmployeeRegController extends Controller
{
   	public  function view(){
       	$data['allData'] = User::where('usertype','employee')->get();
    	return view('backend.employee.employee_reg.view-reg-employee',$data);
    }
    public function add(){
       	$data['designations'] = Designation::all();
	   	return view('backend.employee.employee_reg.add-reg-employee',$data);
    }
    public function store(Request $request){
		DB::transaction(function() use($request){
   			$checkYear = date('Ym',strtotime($request->joindate));
			$employee = User::Where('usertype','employee')->orderBy('id','DESC')->first();
			if ($employee == null) {
				$firstReg = 0;
				$employeeId = $firstReg+1;
				if ($employeeId < 10) {
					$id_no = '000'.$employeeId;	
				}elseif ($employeeId < 100) {
					$id_no = '00'.$employeeId;	
				}elseif ($employeeId < 1000) {
					$id_no = '0'.$employeeId;	
				}
    		}else{
    			$employee = User::Where('usertype','employee')->orderBy('id','DESC')->first()->id;
    			$employeeId = $employee+1;
    			if ($employeeId < 10) {
					$id_no = '000'.$employeeId;	
				}elseif ($employeeId < 100) {
					$id_no = '00'.$employeeId;	
				}elseif ($employeeId < 1000) {
					$id_no = '0'.$employeeId;	
				}	
    		}

       		$final_id_no = $checkYear.$id_no;
    		$user = new User();
    		$code = rand(0000,9999);
    		$user->id_no = $final_id_no;
    		$user->password = bcrypt($code);
    		$user->usertype = 'employee';
    		$user->code = $code;
    		$user->name = $request->name;
    		$user->fname = $request->fname;
    		$user->mname = $request->mname;
    		$user->email = $request->email;
    		$user->mobile = $request->mobile;
    		$user->address = $request->address;
    		$user->religion = $request->religion;
    		$user->gender = $request->gender;
    		$user->dob = date('y-m-d',strtotime($request->dob));
    		$user->join_date = date('y-m-d',strtotime($request->join_date));
    		$user->salary = $request->salary;
    		$user->designation_id = $request->designation_id;

    		if ($request->file('image')) {
    			$file = $request->file('image');
    			$filename = date('YmdHi').$file->getClientOriginalName();
    			$file->move(public_path('upload/employee_images'),$filename);
    			$user['image'] = $filename;
    			# code...
    		}
    		$user->save();
    		$employee_salary = new EmployeeSalaryLog();
       		$employee_salary->employee_id = $user->id; 
       		$employee_salary->effected_date = date('y-m-d',strtotime($request->join_date));
       		$employee_salary->previous_salary = $request->salary; 
       		$employee_salary->present_salary = $request->salary; 
       		$employee_salary->increment_salary = '0'; 
		});
	    return redirect()->route('view-reg-employee')->with('success','inserted sucessfully');
    }
    public function edit($id){
    	$data['editData'] = User::find($id);
       	$data['designations'] = Designation::all();
	   	return view('backend.employee.employee_reg.add-reg-employee',$data);

   }
   public function update(Request $request,$id){
   		$user =  User::find($id);
   		$user->name = $request->name;
		$user->fname = $request->fname;
		$user->mname = $request->mname;
		$user->email = $request->email;
		$user->mobile = $request->mobile;
		$user->address = $request->address;
		$user->religion = $request->religion;
		$user->gender = $request->gender;
		$user->dob = date('y-m-d',strtotime($request->dob));
		$user->designation_id = $request->designation_id;

		if ($request->file('image')) {
			$file = $request->file('image');
			@unlink(public_path('upload/employee_images/'.$user->image));
			$filename = date('YmdHi').$file->getClientOriginalName();
			$file->move(public_path('upload/employee_images'),$filename);
			$user['image'] = $filename;
   		}
		$user->save();

   	    return redirect()->route('view-reg-employee')->with('success','updated sucessfully');

   }
     public function details($id){
    $data['details'] = User::find($id);


    $pdf = PDF::loadView('backend.employee.employee_reg.employee-details-pdf', $data);
        $pdf->SetDisplayMode('default','continuous'); // continuous not documented, although should work.

    $pdf->setOptions(['copy','print'],'','pass');

    return $pdf->stream('document.pdf');
   }

	    
}
