<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BackEnd\Sub;
use APP\User;
class SubjectController extends Controller
{
   public function viewsubject(){
    	$allData = Sub::all();
    	return view('backend.setup.subject.view-subject',compact('allData'));
    }
    public function addsubject(){
    	return view('backend.setup.subject.add-subject');
    }
    public function storesubject(Request $request){
    	$this->validate($request,[
    		'name' => 'required|unique:subs,name'
    	]);
    	$data = new Sub();
       	$data->name =  $request->name;
        $result = $data->save();
        if($result):
            return redirect('view-subject')->with('success','inserted sucessfully');
        else:
            return redirect()->back()->with('danger','insert unsucessfull');
        endif;
     }
    public function editsubject($id){
        $editData = Sub::find($id);
        return view('backend.setup.subject.add-subject',compact('editData'));
    }
    public function updatesubject(Request $request,$id){
        $data = Sub::find($id);
        $this->validate($request,[
            'name' => 'required|unique:subs,name,'.$data->id
        ]);
        $data->name =  $request->name;
      	$result = $data->save();
		if($result):
            return redirect('view-subject')->with('success','updated sucessfully');
        else:
            return redirect()->back()->with('danger','inserte unsucessfull');
        endif;   
     }
    public function deletesubject($id){
        $deleteData = Sub::destroy($id);

        if($deleteData):
            return redirect('view-subject')->with('success','deleted sucessfully');
        else:
            return redirect()->back()->with('danger','delete unsucessfull');
        endif;   
    }
	
}
