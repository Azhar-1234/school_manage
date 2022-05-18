<?php

namespace App\Http\Controllers\BackEnd\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\Student\AssignStudent;
use App\Models\Backend\Student\DiscountStudent;
use App\Models\Backend\StudentClass;
use App\Models\Backend\StudentGroup;
use App\Models\Backend\StudentShift;
use App\Models\Backend\StudentYear; 
use App\Models\BackEnd\AssignSubject;
use App\User;
use DB;
use PDF;

class RegistrationController extends Controller
{
   	public  function viewregistration(){
       	$data['classes'] = StudentClass::all();
    	$data['years'] = StudentYear::orderBy('id','desc')->get();
    	$data['year_id'] = StudentYear::orderBy('id','desc')->first()->id;
    	$data['class_id'] = StudentClass::orderBy('id','asc')->first()->id;
    	$data['allData'] = AssignStudent::where('year_id',$data['year_id'])->where('class_id',$data['class_id'])->get();
    	return view('backend.student_reg.student-view',$data);
    }
    public function addregistration(){
    	$data['years'] = StudentYear::orderBy('id','desc')->get();
    	$data['classes'] = StudentClass::all();
    	$data['groups'] = StudentGroup::all();
    	$data['shifts'] = StudentShift::all();
	   	return view('backend.student_reg.student-add',$data);
    }
    public function storeregistration(Request $request){
		DB::transaction(function() use($request){
   			$checkYear = StudentYear::find($request->year_id)->name;
			$student = User::Where('usertype','student')->orderBy('id','DESC')->first();
			if ($student == null) {
				$firstReg = 0;
				$studentId = $firstReg+1;
				if ($studentId < 10) {
					$id_no = '000'.$studentId;	
				}elseif ($studentId < 100) {
					$id_no = '00'.$studentId;	
				}elseif ($studentId < 1000) {
					$id_no = '0'.$studentId;	
				}
    		}else{
    			$student = User::Where('usertype','student')->orderBy('id','DESC')->first()->id;
    			$studentId = $student+1;
    			if ($studentId < 10) {
					$id_no = '000'.$studentId;	
				}elseif ($studentId < 100) {
					$id_no = '00'.$studentId;	
				}elseif ($studentId < 1000) {
					$id_no = '0'.$studentId;	
				}	
    		}

       		$final_id_no = $checkYear.$id_no;
    		$user = new User();
    		$code = rand(0000,9999);
    		$user->id_no = $final_id_no;
    		$user->password = bcrypt($code);
    		$user->usertype = 'student';
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
    		if ($request->file('image')) {
    			$file = $request->file('image');
    			$filename = date('YmdHi').$file->getClientOriginalName();
    			$file->move(public_path('upload/student_images'),$filename);
    			$user['image'] = $filename;
    			# code...
    		}
    		$user->save();
    		$assign_student = new AssignStudent();
       		$assign_student->student_id = $user->id; 
    		$assign_student->year_id = $request->year_id;
    		$assign_student->class_id = $request->class_id;
       		$assign_student->shift_id = $request->shift_id;
       		$assign_student->group_id = $request->group_id;
       		$assign_student->save();
    		$discount_student = new DiscountStudent();
    		$discount_student->assign_student_id = $assign_student->id; 
    		$discount_student->fee_category_id = '1';      		
    		$discount_student->discount = $request->discount;
    		$discount_student->save();		        
		});
	    return redirect()->route('view-student')->with('success','inserted sucessfully');
    }
    public function editregistration($student_id){
    	$data['editData'] = AssignStudent::with(['student','discount'])->where('student_id',$student_id)->first();
    	$data['years'] = StudentYear::orderBy('id','desc')->get();
    	$data['classes'] = StudentClass::all();
    	$data['groups'] = StudentGroup::all();
    	$data['shifts'] = StudentShift::all();
	   	return view('backend.student_reg.student-add',$data);
   }
   public function updateregistration(Request $request,$student_id){
		DB::transaction(function() use($request,$student_id){
    		$user = User::where('id',$student_id)->first();
       		$user->name = $request->name;
    		$user->fname = $request->fname;
    		$user->mname = $request->mname;
    		$user->email = $request->email;
    		$user->mobile = $request->mobile;
    		$user->address = $request->address;
    		$user->religion = $request->religion;
    		$user->gender = $request->gender;
    		$user->dob = date('y-m-d',strtotime($request->dob));
    		if ($request->file('image')) {
    			$file = $request->file('image');
    			@unlink(public_path('upload/student_images/'.$user->image));
    			$filename = date('YmdHi').$file->getClientOriginalName();
    			$file->move(public_path('upload/student_images'),$filename);
    			$user['image'] = $filename;
    		}
    		$user->save();
    		$assign_student = AssignStudent::where('id',$request->id)->where('student_id',$student_id)->first();
       		$assign_student->year_id = $request->year_id;
    		$assign_student->class_id = $request->class_id;
       		$assign_student->shift_id = $request->shift_id;
       		$assign_student->group_id = $request->group_id;
       		$assign_student->save();
    		$discount_student = DiscountStudent::where('assign_student_id',$request->id)->first();
    		$discount_student->discount = $request->discount;
    		$discount_student->save();		        
		});
	    return redirect()->route('view-student')->with('success','updated sucessfully');


   }
    public function yearClassWise(Request $request){
       	$data['classes'] = StudentClass::all();
    	$data['years'] = StudentYear::orderBy('id','desc')->get();
    	$data['year_id'] = $request->year_id;
    	$data['class_id'] = $request->class_id;
    	$data['allData'] = AssignStudent::where('year_id',$request->year_id)->where('class_id',$request->class_id)->get();
    	return view('backend.student_reg.student-view',$data);
    }
    public function promotion($student_id){
    	$data['editData'] = AssignStudent::with(['student','discount'])->where('student_id',$student_id)->first();
    	$data['years'] = StudentYear::orderBy('id','desc')->get();
    	$data['classes'] = StudentClass::all();
    	$data['groups'] = StudentGroup::all();
    	$data['shifts'] = StudentShift::all();
	   	return view('backend.student_reg.student-promotion',$data);
    }
   public function updatepromotion(Request $request,$student_id){
		DB::transaction(function() use($request,$student_id){
    		$user = User::where('id',$student_id)->first();
       		$user->name = $request->name;
    		$user->fname = $request->fname;
    		$user->mname = $request->mname;
    		$user->email = $request->email;
    		$user->mobile = $request->mobile;
    		$user->address = $request->address;
    		$user->religion = $request->religion;
    		$user->gender = $request->gender;
    		$user->dob = date('y-m-d',strtotime($request->dob));
    		if ($request->file('image')) {
    			$file = $request->file('image');
    			@unlink(public_path('upload/student_images/'.$user->image));
    			$filename = date('YmdHi').$file->getClientOriginalName();
    			$file->move(public_path('upload/student_images'),$filename);
    			$user['image'] = $filename;
    		}
    		$user->save();
    		$assign_student = new AssignStudent();
       		$assign_student->student_id = $student_id;
       		$assign_student->year_id = $request->year_id;
    		$assign_student->class_id = $request->class_id;
       		$assign_student->shift_id = $request->shift_id;
       		$assign_student->group_id = $request->group_id;
       		$assign_student->save();
    		$discount_student = new DiscountStudent();
    		$discount_student->assign_student_id = $assign_student->id; 
    		$discount_student->fee_category_id = '1';
    		$discount_student->discount = $request->discount;
    		$discount_student->save();		        
		});
	    return redirect()->route('view-student')->with('success','promotion sucessfully');
   }
   public function details($student_id){
    $data['details'] = AssignStudent::with(['student','discount'])->where('student_id',$student_id)->first();
    $pdf = PDF::loadView('backend.student_reg.student-details-pdf', $data);
    $pdf->setOptions(['copy','print'],'','pass');
    return $pdf->stream('document.pdf');
   }
    

}
