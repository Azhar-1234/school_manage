<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\StudentShift;


class ShiftController extends Controller
{
   public function viewshift(){
    	$allData = StudentShift::all();
    	return view('backend.setup.shift.view-shift',compact('allData'));
    }
    public function addshift(){
    	return view('backend.setup.shift.add-shift');
    }
    public function storeshift(Request $request){
    	$this->validate($request,[
    		'name' => 'required|unique:student_shifts,name'
    	]);
    	$data = new Studentshift();
       	$data->name =  $request->name;
        $result = $data->save();
        if($result):
            return redirect('view-shift')->with('success','inserted sucessfully');
        else:
            return redirect()->back()->with('danger','insert unsucessfull');
        endif;
     }
    public function editshift($id){
        $editData = StudentShift::find($id);
        return view('backend.setup.shift.add-shift',compact('editData'));
    }
    public function updateshift(Request $request,$id){
        $data = StudentShift::find($id);
        $this->validate($request,[
            'name' => 'required|unique:student_shifts,name,'.$data->id
        ]);
        $data->name =  $request->name;
      	$result = $data->save();
		if($result):
            return redirect('view-shift')->with('success','updated sucessfully');
        else:
            return redirect()->back()->with('danger','inserte unsucessfull');
        endif;   
     }
    public function deleteshift($id){
        $deleteData = StudentShift::destroy($id);

        if($deleteData):
            return redirect('view-shift')->with('success','deleted sucessfully');
        else:
            return redirect()->back()->with('danger','delete unsucessfull');
        endif;

        
    }

    //
}
