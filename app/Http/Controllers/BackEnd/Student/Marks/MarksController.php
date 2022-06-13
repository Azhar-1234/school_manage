<?php

namespace App\Http\Controllers\BackEnd\Student\Marks;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Backend\Student\AssignStudent;
use App\Models\Backend\Student\DiscountStudent;
use App\Models\Backend\StudentClass;
use App\Models\Backend\StudentGroup;
use App\Models\Backend\StudentShift;
use App\Models\Backend\StudentYear; 
use App\Models\BackEnd\AssignSubject;
use App\Models\BackEnd\ExamType;
use App\Models\BackEnd\Designation;
use DB;
use PDF;
use App\Models\Backend\StudentMarks;

class MarksController extends Controller
{    public function add(){
       	$data['classes'] = StudentClass::all();
    	$data['years'] = StudentYear::orderBy('id','desc')->get();
       	$data['subjects'] = AssignSubject::all();
       	$data['exam_types'] = ExamType::all();
       	
    	return view('backend.marks.add-marks',$data);
    }
    public function store(Request $request){
        $studentcount = $request->student_id;
        if ($studentcount) {
        	for ($i=0; $i < count($request->student_id); $i++) { 
        		$data = new StudentMarks();
        		$data->year_id = $request->year_id;
        		$data->class_id = $request->class_id;
        		$data->assign_subject_id = $request->assign_subject_id;
        		$data->exam_type_id = $request->exam_type_id;
        		$data->student_id = $request->student_id[$i];
        		$data->id_no = $request->id_no[$i];
        		$data->marks = $request->marks[$i];
        		$data->save();
        	}
        }
        return redirect()->back()->with('success','well done! successfully marks entry');

    }
    public function edit(){
        $data['classes'] = StudentClass::all();
        $data['years'] = StudentYear::orderBy('id','desc')->get();
        $data['subjects'] = AssignSubject::all();
        $data['exam_types'] = ExamType::all();
        return view('backend.marks.edit-marks',$data);
    }
    public function getMarks(Request $request){
        $year_id = $request->year_id;
        $class_id = $request->class_id;
        $assign_subject_id = $request->assign_subject_id;
        $exam_type_id = $request->exam_type_id;
        $getStudent = StudentMarks::with(['student'])->where('year_id',$year_id)->where('class_id',$class_id)->where('assign_subject_id',$assign_subject_id)->where('exam_type_id',$exam_type_id)->get();
        return response()->json($getStudent);
    }
    public function update(Request $request){
        StudentMarks::where('year_id',$request->year_id)->where('class_id',$request->class_id)->where('assign_subject_id',$request->assign_subject_id)->where('exam_type_id',$request->exam_type_id)->delete();
        $studentcount = $request->student_id;
        if ($studentcount) {
            for ($i=0; $i < count($request->student_id); $i++) { 
                $data = new StudentMarks();
                $data->year_id = $request->year_id;
                $data->class_id = $request->class_id;
                $data->assign_subject_id = $request->assign_subject_id;
                $data->exam_type_id = $request->exam_type_id;
                $data->student_id = $request->student_id[$i];
                $data->id_no = $request->id_no[$i];
                $data->marks = $request->marks[$i];
                $data->save();
            }
        }
        return redirect()->back()->with('success','well done! successfully updated');

    }
}
