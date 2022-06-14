<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\OtherCost;
class OtherCostController extends Controller
{
    public function view(){
    	$data['allData'] = OtherCost::orderBy('id','desc')->get();
    	return view('backend.other_cost.other-cost-view',$data);
    }
    public function add(){
    	return view('backend.other_cost.other-cost-add');
    }
    public function store(Request $requst){
    	$cost = new OtherCost();
    	$cost->date = date('Y-m-d',strtotime($requst->date));
    	$cost->amount = $requst->amount;
    	if ($requst->file('image')) {
    		$file = $requst->file('image');
    		$filename =date('YmdHi').$file->getClientOriginalName();
    		$file->move(public_path('upload/cost_images'),$filename);
    		$cost['image'] = $filename;
    	}
    	$cost->description = $requst->description;
    	$cost->save();
    	
    	return redirect()->route('other-cost-view')->with('success','Data saved successfully');
    }
    public function edit($id){
    	$data['editData'] = OtherCost::find($id);
    	return view('backend.other_cost.other-cost-add',$data);
    }
    public function update(Request $requst,$id){
    	$cost = OtherCost::find($id);
    	$cost->date = date('Y-m-d',strtotime($requst->date));
    	$cost->amount = $requst->amount;
    	if ($requst->file('image')) {
    		$file = $requst->file('image');
    		@unlink(public_path('upload/cost_images'),$data->image);
    		$filename =date('YmdHi').$file->getClientOriginalName();
    		$file->move(public_path('upload/cost_images'),$filename);
    		$cost['image'] = $filename;
    	}
    	$cost->description = $requst->description;
    	$cost->save();

    	return redirect()->route('other-cost-view')->with('success','Data updated successfully');
    }

}
