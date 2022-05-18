<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BackEnd\AssignSubject;
use App\Models\Backend\StudentClass;
use App\Models\Backend\FeeCategory;
use App\Models\Backend\FeeAmount;
use App\Models\Backend\Sub;
use App\User;
use Auth;

class AssignSubjectController extends Controller
{
   public function viewsubject(){
    	$data['allData'] = AssignSubject::select('class_id')->groupBy('class_id')->get();
    	return view('backend.setup.assignSubject.view-assign-subject',$data);
    }
    public function addsubject(){
    	$data['student_classes'] = StudentClass::all();
      $data['subs'] = Sub::all();
    	return view('backend.setup.assignSubject.add-assign-subject',$data);
    }
    public function storesubject(Request $request){
   		$subjectCount = count($request->subject_id);
   		if ($subjectCount != NULL) {
   			for ($i=0; $i < $subjectCount; $i++) { 
   				$assign_sub = new AssignSubject();
   				$assign_sub->class_id = $request->class_id;
   				$assign_sub->subject_id = $request->subject_id[$i];
   				$assign_sub->full_mark = $request->full_mark[$i];
          $assign_sub->pass_mark = $request->pass_mark[$i];
          $assign_sub->subjective_mark = $request->subjective_mark[$i];

       		$assign_sub->save();
   			}
   		}
        if($assign_sub):
            return redirect('view-assign-subject')->with('success','inserted sucessfully');
        else:
            return redirect()->back()->with('danger','insert unsucessfull');
        endif;
     }
    public function editsubject($class_id){
        $data['editData'] = AssignSubject::where('class_id',$class_id)->get();
      	$data['student_classes'] = StudentClass::all();
        $data['subs'] = Sub::all();
        return view('backend.setup.assignSubject.edit-assign-subject',$data);
    }
    public function updatesubject(Request $request,$class_id){

      // return $request->subject_id;


        if ($request->subject_id == NULL) {
          return redirect()->back()->with('danger','sorry! you dont select any item');
        }
        else{
                
           AssignSubject::whereNotIn('subject_id',$request->subject_id)->where('class_id',$request->$class_id)->delete();

              foreach ($request->subject_id as $key => $value) {
                $assign_subject_exist = AssignSubject::where('subject_id',$value)->where('class_id',$request->class_id)->first();

              }

              
                 if($assign_subject_exist){
                $assignSubjects = $assign_subject_exist;

              }else{
                $assignSubjects = new AssignSubject(); 
              }
                $assignSubjects->class_id = $request->class_id;
                $assignSubjects->subject_id = $request->subject_id[$key];
                $assignSubjects->full_mark = $request->full_mark[$key];
                $assignSubjects->pass_mark = $request->pass_mark[$key];
                $assignSubjects->subjective_mark = $request->subjective_mark[$key];
                // $assignSubjects->updated_by = Auth::user()->id;
                $result = $assignSubjects->save(); 

          }
      		if($result):
                  return redirect('view-assign-subject')->with('success','updated sucessfully');
              else:
                  return redirect()->back()->with('danger','inserte unsucessfull');
              endif;   
     }
    public function detailsubject($class_id){
        $data['editData'] = AssignSubject::where('class_id',$class_id)->orderBy('class_id','asc')->get();
        return view('backend.setup.assignSubject.detail-assign-subject',$data);
    }

}
