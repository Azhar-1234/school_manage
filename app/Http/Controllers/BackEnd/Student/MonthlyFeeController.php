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


class MonthlyFeeController extends Controller
{
    public  function view(){
        $data['classes'] = StudentClass::all();
        $data['years'] = StudentYear::orderBy('id','desc')->get();
        return view('backend.monthly_fee.view-month-fee',$data);
    }
    public function GetStudent(Request $request){
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
        $html['thsource'] .= '<th>Monthly Fee</th>';
        $html['thsource'] .= '<th>Discount Amount</th>';
        $html['thsource'] .= '<th>Fee(This Student)</th>';
        $html['thsource'] .= '<th>Action</th>';
        foreach ($allStudent as $key => $v) {
            $registrationfee = FeeAmount::where('fee_category_id','2')->where('class_id',$v->class_id)->first();
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
             $html[$key]['tdsource'] .= '<a class="btn btn-sm btn-'.$color.'" title="Payslip" target="_blank" href="'.route("month-fee-payslip").'?class_id='.$v->class_id.'&student_id='.$v->student_id.'&month='.$request->month.'">Fee Slip</a>';
             $html[$key]['tdsource'] .= '</td>';

        }
        return response()->json(@$html);

    }
    public function FeePayslip(Request $request){
            $student_id = $request->student_id;  
            $class_id = $request->class_id;
            $data['month'] = $request->month;
            $data['details'] = AssignStudent::with(['discount','student'])->where('student_id',$student_id)->where('class_id',$class_id)->first();
            $pdf = PDF::loadView('backend.monthly_fee.month-fee-pdf', $data);
            $pdf->setOptions(['copy','print'],'','pass');
            return $pdf->stream('document.pdf');                       
    }
}
