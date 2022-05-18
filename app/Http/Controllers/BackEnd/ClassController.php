<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\StudentClass;

class ClassController extends Controller
{
    public function viewClass(){
    	$data['allData'] = StudentClass::all();
    	return view('backend.setup.class.view-class',$data);
    }
    public function addClass(){
    	return view('backend.setup.class.add-class');   
     }
    public function storeClass(Request $request){
    	$this->validate($request,[
    		'name' =>'required|unique:student_classes,name'
    	]);
    	$data = new StudentClass();
    	$data->name = $request->name;
    	$result = $data->save();

        if($result):
            return redirect('view-class')->with('success','inserted sucessfully');
        else:
            return redirect()->back()->with('danger','inserted unsucessfull');
        endif;   
     }

    public function editClass($id){
    	$editData = StudentClass::find($id);
    	return view('backend.setup.class.add-class',compact('editData'));
    }

    public function updateClass(Request $request,$id){
    	$data = StudentClass::find($id);
    	$this->validate($request,[
    		'name' =>'required|unique:student_classes,name,'.$data->id
    	]);
       	$data->name = $request->name;
    	$result = $data->save();

        if($result):
            return redirect('view-class')->with('success','update sucessfully');
        else:
            return redirect()->back()->with('danger','update unsucessfull');
        endif;       	
    }
    public function deleteClass($id){    	
    	$deleteData = StudentClass::destroy($id);

        if($deleteData):
            return redirect('view-class')->with('success','destroy sucessfully');
        else:
            return redirect()->back()->with('danger','destroy unsucessfull');
        endif;      
     }
}
