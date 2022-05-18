<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\FeeCategory;


class FeeCategoryController extends Controller
{
   public function viewfeeCategory(){
    	$allData = FeeCategory::all();
    	return view('backend.setup.feeCategory.view-feeCategory',compact('allData'));
    }
    public function addfeeCategory(){
    	return view('backend.setup.feeCategory.add-feeCategory');
    }
    public function storefeeCategory(Request $request){
    	$this->validate($request,[
    		'name' => 'required|unique:fee_categories,name'
    	]);
    	$data = new FeeCategory();
       	$data->name =  $request->name;
        $result = $data->save();
        if($result):
            return redirect('view-feeCategory')->with('success','inserted sucessfully');
        else:
            return redirect()->back()->with('danger','insert unsucessfull');
        endif;
     }
    public function editfeeCategory($id){
        $editData = FeeCategory::find($id);
        return view('backend.setup.feeCategory.add-feeCategory',compact('editData'));
    }
    public function updatefeeCategory(Request $request,$id){
        $data = FeeCategory::find($id);
        $this->validate($request,[
            'name' => 'required|unique:fee_categories,name,'.$data->id
        ]);
        $data->name =  $request->name;
      	$result = $data->save();
		if($result):
            return redirect('view-feeCategory')->with('success','updated sucessfully');
        else:
            return redirect()->back()->with('danger','inserte unsucessfull');
        endif;   
     }
    public function deletefeeCategory($id){
        $deleteData = FeeCategory::destroy($id);

        if($deleteData):
            return redirect('view-feeCategory')->with('success','deleted sucessfully');
        else:
            return redirect()->back()->with('danger','delete unsucessfull');
        endif;

        
    }

    
}
