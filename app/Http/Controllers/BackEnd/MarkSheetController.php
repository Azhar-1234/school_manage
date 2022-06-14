<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\Marksheet;
use App\Models\Backend\ExamType;
use App\Models\Backend\MarksGrade;
use App\Models\Backend\StudentYear;
use App\Models\Backend\StudentClass;
use App\Models\Backend\StudentMarks;
use App\User;

class MarkSheetController extends Controller
{
    public function view(){
    	$data['years'] = StudentYear::orderBy('id','DESC')->get();
    	$data['classes'] = StudentClass::all();
    	$data['exam_types'] = ExamType::all();
    	return view('backend.marksheet.marksheet-view',$data);
    }
    public function marksheetGet(Request $request){
    	$year_id = $request->year_id;
    	$class_id = $request->class_id;
    	$exam_type_id = $request->exam_type_id;
    	$id_no = $request->id_no;

    	$count_fail = StudentMarks::where('year_id',$year_id)->where('class_id',$class_id)->
    				  where('exam_type_id',$exam_type_id)->where('id_no',$id_no)->where('marks','<','33')->count();

    	$singleStudent = StudentMarks::where('year_id',$year_id)->where('class_id',$class_id)->
    				  where('exam_type_id',$exam_type_id)->where('id_no',$id_no)->first();
    	if ($singleStudent == true) {
    		$allMarks = StudentMarks::with(['assign_subject','year'])->where('year_id',$year_id)->where('class_id',$class_id)->where('exam_type_id',$exam_type_id)->where('id_no',$id_no)->get();
    		$allGrades = MarksGrade::all();

    		return view('backend.marksheet.marksheet-pdf',compact('allMarks','allGrades','count_fail'));
    	}else{
    		return redirect()->back()->with('error','sorry caiteria not matched');
    	}
    }
    public function viewResult(){
        $data['years'] = StudentYear::orderBy('id','DESC')->get();
        $data['classes'] = StudentClass::all();
        $data['exam_types'] = ExamType::all();
        return view('backend.result.result-view',$data);
    }
    public function resultGet(Request $request){

        $year_id = $request->year_id;
        $class_id = $request->class_id;    
        $exam_type_id = $request->exam_type_id;
        $singleResult = StudentMarks::where('year_id',$year_id)->where('class_id',$class_id)->
                      where('exam_type_id',$exam_type_id)->first();
        if ($singleResult == true) {
            $data['allData'] = StudentMarks::select('year_id','class_id','exam_type_id','student_id')->where('year_id',$year_id)->where('class_id',$class_id)->where('exam_type_id',$exam_type_id)->groupBy('class_id')->groupBy('exam_type_id')->groupBy('student_id')->get();
            $pdf = PDF::loadView('backend.result.result-pdf',$data);
            return $pdf->stream('document.pdf');
        }else{
            return redirect()->back()->with('error','sorr! caiteria not matched');
        }

    }
}

