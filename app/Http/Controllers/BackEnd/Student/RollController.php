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


class RollController extends Controller
{
   	public  function viewroll(){
       	$data['classes'] = StudentClass::all();
    	$data['years'] = StudentYear::orderBy('id','desc')->get();
    	return view('backend.roll_generate.view-roll',$data);
    }
    public function getStudent(Request $request){
    	$allData = AssignStudent::with(['student'])->where('year_id',$request->year_id)->where('class_id',$request->class_id)->get();
    	return response()->json($allData);

    }
    public function storeroll(Request $request){
        $year_id = $request->year_id;
        $class_id = $request->class_id;
        if ($request->student_id !== null)  {
            for ($i=0; $i < count($request->student_id); $i++) { 
               
                AssignStudent::where('year_id',$year_id)->where('class_id',$class_id)->where('student_id',$request->student_id[$i])->update(['roll' => $request->roll[$i]]);
            }
        }else{
            return redirect()->back()->with('error','this is not a student');
        }
        return redirect()->route('view-roll')->with('success','well done! successfully roll generated');

    }

 }
