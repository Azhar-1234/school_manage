<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\Designation;
class DesignationController extends Controller
{
    public function viewdesignation(){
    	$allData = Designation::all();
    	return view('backend.setup.designation.view-designation',compact('allData'));
    }
    public function adddesignation(){
    	return view('backend.setup.designation.add-designation');
    }
    public function storedesignation(Request $request){
    	$this->validate($request,[
    		'name' => 'required|unique:designations,name'
    	]);
    	$data = new Designation();
       	$data->name =  $request->name;
        $result = $data->save();
        if($result):
            return redirect('view-designation')->with('success','inserted sucessfully');
        else:
            return redirect()->back()->with('danger','inserted unsucessfull');
        endif;
     }
    public function editdesignation($id){
        $editData = Designation::find($id);
        return view('backend.setup.designation.add-designation',compact('editData'));
    }
    public function updatedesignation(Request $request,$id){
        $data = Designation::find($id);
        $this->validate($request,[
            'name' => 'required|unique:designations,name,'.$data->id
        ]);
        $data->name =  $request->name;
       	$result = $data->save();
        if($result):
            return redirect('view-designation')->with('success','updated sucessfully');
        else:
            return redirect()->back()->with('danger','updated unsucessfull');
        endif;
    }
    public function deletedesignation($id){
        $deleteData = Designation::destroy($id);
        if($deleteData):
            return redirect('view-designation')->with('success','deleted sucessfully');
        else:
            return redirect()->back()->with('danger','deleted unsucessfull');
        endif;
        
    }
    //
}
