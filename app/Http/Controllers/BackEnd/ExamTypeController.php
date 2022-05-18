<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BackEnd\ExamType;

class ExamTypeController extends Controller
{
   public function viewexam(){
    	$allData = ExamType::all();
    	return view('backend.setup.exam.view-exam',compact('allData'));
    }
    public function addexam(){
    	return view('backend.setup.exam.add-exam');
    }
    public function storeexam(Request $request){
    	$this->validate($request,[
    		'name' => 'required|unique:exam_types,name'
    	]);
    	$data = new ExamType();
       	$data->name =  $request->name;
        $result = $data->save();
        if($result):
            return redirect('view-exam')->with('success','inserted sucessfully');
        else:
            return redirect()->back()->with('danger','insert unsucessfull');
        endif;
     }
    public function editexam($id){
        $editData = ExamType::find($id);
        return view('backend.setup.exam.add-exam',compact('editData'));
    }
    public function updateexam(Request $request,$id){
        $data = ExamType::find($id);
        $this->validate($request,[
            'name' => 'required|unique:exam_types,name,'.$data->id
        ]);
        $data->name =  $request->name;
      	$result = $data->save();
		if($result):
            return redirect('view-exam')->with('success','updated sucessfully');
        else:
            return redirect()->back()->with('danger','inserte unsucessfull');
        endif;   
     }
    public function deleteexam($id){
        $deleteData = ExamType::destroy($id);

        if($deleteData):
            return redirect('view-exam')->with('success','deleted sucessfully');
        else:
            return redirect()->back()->with('danger','delete unsucessfull');
        endif;
        
    }
    
}
