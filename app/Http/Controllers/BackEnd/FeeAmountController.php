<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\StudentClass;
use App\Models\Backend\FeeCategory;
use App\Models\Backend\FeeAmount;
use App\User;


class FeeAmountController extends Controller
{
   public function viewfeeAmount(){
    	$data['allData'] = FeeAmount::select('fee_category_id')->groupBy('fee_category_id')->get();
    	return view('backend.setup.feeAmount.view-feeAmount',$data);
    }
    public function addfeeAmount(){
    	$data['fee_categories'] = FeeCategory::all();
    	$data['student_classes'] = StudentClass::all();
    	return view('backend.setup.feeAmount.add-feeAmount',$data);
    }
    public function storefeeAmount(Request $request){
   		$countClass = count($request->class_id);
   		if ($countClass != NULL) {
   			for ($i=0; $i < $countClass; $i++) { 
   				$fee_amount = new FeeAmount();
   				$fee_amount->fee_category_id = $request->fee_category_id;
   				$fee_amount->class_id = $request->class_id[$i];
   				$fee_amount->amount = $request->amount[$i];
       		$fee_amount->save();
   			}
   		}
        if($fee_amount):
            return redirect('view-feeAmount')->with('success','inserted sucessfully');
        else:
            return redirect()->back()->with('danger','insert unsucessfull');
        endif;
     }
    public function editfeeAmount($fee_category_id){
        $data['editData'] = FeeAmount::where('fee_category_id',$fee_category_id)->orderBy('class_id')->get();
    	$data['fee_categories'] = FeeCategory::all();
    	$data['student_classes'] = StudentClass::all();
        return view('backend.setup.feeAmount.edit-feeAmount',$data);
    }
    public function updatefeeAmount(Request $request,$fee_category_id){
        if ($request->class_id == NULL) {
          
        return redirect()->back()->with('danger','sorry! you dont select any item');

        }
        else{
           FeeAmount::where('fee_category_id',$fee_category_id)->delete();

            $countClass = count($request->class_id);            
              for ($i=0; $i < $countClass; $i++) { 
                $fee_amount = new FeeAmount();
                $fee_amount->fee_category_id = $request->fee_category_id;
                $fee_amount->class_id = $request->class_id[$i];
                $fee_amount->amount = $request->amount[$i];
                $result = $fee_amount->save();  
              }       
          }
      
		if($result):
            return redirect('view-feeAmount')->with('success','updated sucessfully');
        else:
            return redirect()->back()->with('danger','inserte unsucessfull');
        endif;   
     }
    public function detailfeeAmount($fee_category_id){
        $data['editData'] = FeeAmount::where('fee_category_id',$fee_category_id)->orderBy('class_id','asc')->get();

        return view('backend.setup.feeAmount.detail-feeAmount',$data);
    }

    
}
