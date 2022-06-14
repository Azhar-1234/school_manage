<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\Profit;
use App\Models\Backend\Employee\EmployeeSalaryAccount;
use App\Models\Backend\StudentAccountFee;
use App\Models\Backend\OtherCost;
use pdf;
class ProfitController extends Controller
{
    public function view(){
    	return view('backend.report.profit-view');
    }
    public function getProfit(Request $request){
    	$start_date		 = date('Y-m',strtotime($request->start_date));
    	$end_date		 = date('Y-m',strtotime($request->end_date));
    	$sdate           = date('Y-m-d',strtotime($request->start_date));
    	$edate 			 = date('Y-m-d',strtotime($request->end_date));
    	$student_fee 	 = StudentAccountFee::whereBetween('date',[$start_date,$end_date])->sum('amount');
    	$other_cost 	 = StudentAccountFee::whereBetween('date',[$sdate,$edate])->sum('amount');
    	$emp_salary 	 = EmployeeSalaryAccount::whereBetween('date',[$start_date,$end_date])->sum('amount');
    	$total_cost		 = $other_cost + $emp_salary;
    	$profit 		 = $total_cost - $emp_salary;
    	$html['thsource'] = '<th>Student Fee</th>';
    	$html['thsource'] .= '<th>Other Cost</th>';
    	$html['thsource'] .= '<th>Employee Salary</th>';
    	$html['thsource'] .= '<th>Total Cost</th>';
    	$html['thsource'] .= '<th>Profit</th>';
    	$html['thsource'] .= '<th>Action</th>';
    	$color = 'success';
    	$html['tdsource']  = '<td>'.$student_fee.'</td>';
    	$html['tdsource'] .= '<td>'.$other_cost.'</td>';
    	$html['tdsource'] .= '<td>'.$emp_salary.'</td>';
    	$html['tdsource'] .= '<td>'.$total_cost.'</td>';
    	$html['tdsource'] .= '<td>'.$profit.'</td>';
    	$html['tdsource'] .= '<td>';
    	$html['tdsource'] .= '<a class="btn btn-sm btn-'.$color.'" title="pdf" target="_blank" href="'.route("profit-pdf").'?start_date='.$sdate.'&end_date='.$edate.'"><i class="fa fa-file"></i></a>';
    	$html['tdsource'] .='</td>';

    	return response()->json(@$html);
    }
    public function pdf(Request $request){
    	$data['sdate']		 = date('Y-m',strtotime($request->start_date));
    	$data['edate']	     = date('Y-m',strtotime($request->end_date));
    	$date['start_date'] = date('Y-m-d',strtotime($request->start_date));
    	$date['end_date'] 	 = date('Y-m-d',strtotime($request->end_date));

    	$pdf = PDF::loadView('profit-pdf',$data);
        $pdf->setOptions(['copy','print'],'','pass');
        return $pdf->stream('document.pdf');
        
    }
}
