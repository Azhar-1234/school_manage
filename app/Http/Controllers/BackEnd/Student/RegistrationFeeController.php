<?php

namespace App\Http\Controllers\BackEnd\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\Student\AssignStudent;
use App\Models\Backend\Student\DiscountStudent;
use App\Models\Backend\StudentClass;
use App\Models\Backend\StudentGroup;
use App\Models\Backend\StudentShift;
use App\Models\Backend\StudentYear; 
use App\Models\BackEnd\AssignSubject;
use App\Models\BackEnd\FeeAmount;
use App\Models\BackEnd\FeeCategory;
use App\User;
use DB;
use PDF;

class RegistrationFeeController extends Controller
{
   	public  function viewregistration(){
       	$data['classes'] = StudentClass::all();
    	$data['years'] = StudentYear::orderBy('id','desc')->get();
    	return view('backend.registration_fee.view-reg-fee',$data);
    }
    public function regGetStudent(Request $request){
        $year_id = $request->year_id;
        $class_id = $request->class_id;
        if($year_id !=''){
        	$where[] = ['year_id','like',$year_id.'%'];
        }
        if($class_id !=''){
        	$where[] = ['class_id','like',$class_id.'%'];
        }
        $allStudent = AssignStudent::with(['discount'])->where($where)->get();
        $html['thsource'] = '<th>SL</th>';
        $html['thsource'] .= '<th>ID NO </th>';
        $html['thsource'] .= '<th>Student Name</th>';
        $html['thsource'] .= '<th>Roll NO </th>';
        $html['thsource'] .= '<th>Registration Fee</th>';
        $html['thsource'] .= '<th>Discount Fee(This Student)</th>';
        $html['thsource'] .= '<th>Action</th>';
        foreach ($allStudent as $key => $v) {
        	$registrationfee = FeeAmount::where('fee_category_id','1')->where('class_id',$v->class_id)->first();
        	$color = 'success';
        	 $html[$key]['tdsource'] = '<td>'.($key+1).'</td>';
        	 $html[$key]['tdsource'] .= '<td>'.$v['student']['id_no'].'</td>';
        	 $html[$key]['tdsource'] .= '<td>'.$v['student']['name'].'</td>';
        	 $html[$key]['tdsource'] .= '<td>'.$v->roll.'</td>';
        	 $html[$key]['tdsource'] .= '<td>'.$registrationfee->amount.'TK'.'</td>';
        	 $html[$key]['tdsource'] .= '<td>'.$v['discount']['discount'].'%'.'</td>';

        	 $originalfee = $registrationfee->amount;
        	 $discount = $v['discount']['discount'];
        	 $discountablefee = $discount/100*$originalfee;
        	 $finalfee = (float)$originalfee-(float)$discountablefee;

        	 $html[$key]['tdsource'] .= '<td>'.$finalfee.'TK'.'</td>';
        	 $html[$key]['tdsource'] .= '<td>';
        	 $html[$key]['tdsource'] .= '<a class="btn btn-sm btn-'.$color.'" title="Payslip" target="_blank" href="'.route("reg-fee-payslip").'?class_id='.$v->class_id.'&student_id='.$v->student_id.'">Fee Slip</a>';
        	 $html[$key]['tdsource'] .= '</td>';

        }
        return response()->json(@$html);

    }
    public function regFeePayslip(Request $request){
            $student_id = $request->student_id;  
            $class_id = $request->class_id;
            $allStudent['details'] = AssignStudent::with(['discount','student'])->where('student_id',$student_id)->where('class_id',$class_id)->first();
            $pdf = PDF::loadView('backend.registration_fee.reg-fee-pdf', $allStudent);
            $pdf->setOptions(['copy','print'],'','pass');
            return $pdf->stream('document.pdf');                       
    }
    public function storeroll(Request $request){
        $year_id = $request->year_id;
        $class_id = $request->class_id;
        if ($request->student_id !== null)  {
            for ($i=0; $i < count($request->student_id); $i++) { 
                AssignStudent::where('year_id',$year_id)->where('class_id',$class_id)->where('student_id',$request->student_id[$i])->update(['roll' => $request->roll[$i]]);
            }
        }
        else{
            return redirect()->back()->with('error','this is not a student');
        }
        return redirect()->route('view-roll')->with('success','well done! successfully roll generated');
    }    
}
