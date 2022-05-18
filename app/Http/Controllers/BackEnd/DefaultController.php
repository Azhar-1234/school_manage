<?php

namespace App\Http\Controllers\BackEnd;

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


class DefaultController extends Controller
{
    public function getStudent(Request $request){
 	   	$class_id = $request->class_id;
 	   	$year_id = $request->year_id;
 	   	$allData = AssignStudent::with(['student'])->where('year_id',$year_id)->where('class_id',$class_id)->get();  

    }
    public function getSubject(Request $request){
 	   	$class_id = $request->class_id;
 	   	$allData = AssignSubject::with(['subject'])->where('class_id',$class_id)->get();
 	   	return response()->json($allData);
     }

}
