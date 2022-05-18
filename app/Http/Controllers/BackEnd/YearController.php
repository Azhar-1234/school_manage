<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\StudentYear;
class YearController extends Controller
{
    public function viewYear(){
    	$allData = StudentYear::all();
    	return view('backend.setup.year.view-year',compact('allData'));
    }
    public function addYear(){
    	return view('backend.setup.year.add-year');
    }
    public function storeYear(Request $request){
    	$this->validate($request,[
    		'name' => 'required|unique:student_years,name'
    	]);
    	$data = new StudentYear();
       	$data->name =  $request->name;
        $result = $data->save();
        if($result):
            return redirect('view-year')->with('success','inserted sucessfully');
        else:
            return redirect()->back()->with('danger','inserted unsucessfull');
        endif;
     }
    public function editYear($id){
        $editData = StudentYear::find($id);
        return view('backend.setup.year.add-year',compact('editData'));
    }
    public function updateYear(Request $request,$id){
        $data = StudentYear::find($id);
        $this->validate($request,[
            'name' => 'required|unique:student_years,name,'.$data->id
        ]);
        $data->name =  $request->name;
        $result = $data->save();
        if($result):
            return redirect('view-year')->with('success','updated sucessfully');
        else:
            return redirect()->back()->with('danger','updated unsucessfull');
        endif;
    }
    public function deleteYear($id){
        $deleteData = StudentYear::destroy($id);
        if($deleteData):
            return redirect('view-year')->with('success','deleted sucessfully');
        else:
            return redirect()->back()->with('danger','deleted unsucessfull');
        endif;
        
    }

}
