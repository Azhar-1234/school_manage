<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\StudentGroup;

class GroupController extends Controller
{
   public function viewGroup(){
    	$allData = StudentGroup::all();
    	return view('backend.setup.group.view-group',compact('allData'));
    }
    public function addGroup(){
    	return view('backend.setup.group.add-group');
    }
    public function storeGroup(Request $request){
    	$this->validate($request,[
    		'name' => 'required|unique:student_groups,name'
    	]);
    	$data = new StudentGroup();
       	$data->name =  $request->name;
        $result = $data->save();
        if($result):
            return redirect('view-group')->with('success','inserted sucessfully');
        else:
            return redirect()->back()->with('danger','insert unsucessfull');
        endif;
     }
    public function editGroup($id){
        $editData = StudentGroup::find($id);
        return view('backend.setup.group.add-group',compact('editData'));
    }
    public function updateGroup(Request $request,$id){
        $data = StudentGroup::find($id);
        $this->validate($request,[
            'name' => 'required|unique:student_groups,name,'.$data->id
        ]);
        $data->name =  $request->name;
      	$result = $data->save();
		if($result):
            return redirect('view-group')->with('success','updated sucessfully');
        else:
            return redirect()->back()->with('danger','inserte unsucessfull');
        endif;   
     }
    public function deleteGroup($id){
        $deleteData = StudentGroup::destroy($id);

        if($deleteData):
            return redirect('view-group')->with('success','deleted sucessfully');
        else:
            return redirect()->back()->with('danger','delete unsucessfull');
        endif;

        
    }

}
