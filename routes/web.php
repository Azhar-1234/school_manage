<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\frontend\SiteController;
use App\Http\Controllers\BackEnd\DashboardController;
use App\Http\Controllers\BackEnd\UserController;
use App\Http\Controllers\BackEnd\ClassController;
use App\Http\Controllers\BackEnd\YearController;
use App\Http\Controllers\BackEnd\GroupController;
use App\Http\Controllers\BackEnd\ShiftController;
use App\Http\Controllers\BackEnd\FeeCategoryController;
use App\Http\Controllers\BackEnd\FeeAmountController;
use App\Http\Controllers\BackEnd\ExamTypeController;
use App\Http\Controllers\BackEnd\SubjectController;
use App\Http\Controllers\BackEnd\AssignSubjectController;
use App\Http\Controllers\BackEnd\DesignationController;
use App\Http\Controllers\BackEnd\Student\RegistrationController;
use App\Http\Controllers\BackEnd\Student\RollController;
use App\Http\Controllers\BackEnd\Student\RegistrationFeeController;
use App\Http\Controllers\BackEnd\Student\MonthlyFeeController;
use App\Http\Controllers\BackEnd\Student\ExamFeeController;
use App\Http\Controllers\BackEnd\Employee\EmployeeRegController;
use App\Http\Controllers\BackEnd\Employee\EmployeeSalaryController;
use App\Http\Controllers\BackEnd\Employee\EmployeeLeaveController;
use App\Http\Controllers\BackEnd\Employee\EmployeeAttendController;
use App\Http\Controllers\BackEnd\Employee\EmployeeMonthlySalary;
use App\Http\Controllers\BackEnd\Student\Marks\MarksController;
use App\Http\Controllers\BackEnd\DefaultController;
use App\Http\Controllers\BackEnd\Student\GradeController;
use App\Http\Controllers\BackEnd\Student\AccountsFeeController;
use App\Http\Controllers\BackEnd\Employee\SalaryController;
use App\Http\Controllers\BackEnd\OtherCostController;
use App\Http\Controllers\BackEnd\ProfitController;
use App\Http\Controllers\BackEnd\MarkSheetController;
use App\Http\Controllers\BackEnd\AttendanceReportController;






/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [SiteController::class,'home']);

Auth::routes();

Route::get('/home', [DashboardController::class,'dashboard'])->name('home');
Route::get('view-user', [UserController::class,'view'])->name('view-user');
Route::get('add-user', [UserController::class,'addUser'])->name('add-user');
Route::post('store-user', [UserController::class,'storeUser'])->name('store-user');
Route::get('edit-user/{id}', [UserController::class,'editUser'])->name('edit-user');
Route::post('update-user/{id}', [UserController::class,'updateUser'])->name('update-user');
Route::get('delete-user/{id}', [UserController::class,'deleteUser'])->name('delete-user');


//class Route
Route::get('view-class', [ClassController::class,'viewClass'])->name('view-class');
Route::get('add-class', [ClassController::class,'addClass'])->name('add-class');
Route::post('store-class', [ClassController::class,'storeClass'])->name('store-class');
Route::get('edit-class/{id}', [ClassController::class,'editClass'])->name('edit-class');
Route::post('update-class/{id}', [ClassController::class,'updateClass'])->name('update-class');
Route::get('delete-class/{id}', [ClassController::class,'deleteClass'])->name('delete-class');

//Year Route
Route::get('view-year',[YearController::class,'viewYear'])->name('view-year');
Route::get('add-year',[YearController::class,'addYear'])->name('add-year');
Route::post('store-year',[YearController::class,'storeYear'])->name('store-year');
Route::get('edit-year/{id}',[YearController::class,'editYear'])->name('edit-year');
Route::post('update-year/{id}',[YearController::class,'updateYear'])->name('update-year');
Route::get('delete-year/{id}',[YearController::class,'deleteYear'])->name('delete-year');

//Group Route
Route::get('view-group',[GroupController::class,'viewgroup'])->name('view-group');
Route::get('add-group',[GroupController::class,'addgroup'])->name('add-group');
Route::post('store-group',[GroupController::class,'storegroup'])->name('store-group');
Route::get('edit-group/{id}',[GroupController::class,'editgroup'])->name('edit-group');
Route::post('update-group/{id}',[GroupController::class,'updategroup'])->name('update-group');
Route::get('delete-group/{id}',[GroupController::class,'deletegroup'])->name('delete-group');

//shift Route
Route::get('view-shift',[ShiftController::class,'viewshift'])->name('view-shift');
Route::get('add-shift',[ShiftController::class,'addshift'])->name('add-shift');
Route::post('store-shift',[ShiftController::class,'storeshift'])->name('store-shift');
Route::get('edit-shift/{id}',[ShiftController::class,'editshift'])->name('edit-shift');
Route::post('update-shift/{id}',[ShiftController::class,'updateshift'])->name('update-shift');
Route::get('delete-shift/{id}',[ShiftController::class,'deleteshift'])->name('delete-shift');
//Fee Category Route
Route::get('view-feeCategory',[FeeCategoryController::class,'viewfeeCategory'])->name('view-feeCategory');
Route::get('add-feeCategory',[FeeCategoryController::class,'addfeeCategory'])->name('add-feeCategory');
Route::post('store-feeCategory',[FeeCategoryController::class,'storefeeCategory'])->name('store-feeCategory');
Route::get('edit-feeCategory/{id}',[FeeCategoryController::class,'editfeeCategory'])->name('edit-feeCategory');
Route::post('update-feeCategory/{id}',[FeeCategoryController::class,'updatefeeCategory'])->name('update-feeCategory');
Route::get('delete-feeCategory/{id}',[FeeCategoryController::class,'deletefeeCategory'])->name('delete-feeCategory');
//Fee Amount Route
Route::get('view-feeAmount',[FeeAmountController::class,'viewfeeAmount'])->name('view-feeAmount');
Route::get('add-feeAmount',[FeeAmountController::class,'addfeeAmount'])->name('add-feeAmount');
Route::post('store-feeAmount',[FeeAmountController::class,'storefeeAmount'])->name('store-feeAmount');
Route::get('edit-feeAmount/{fee_category_id}',[FeeAmountController::class,'editfeeAmount'])->name('edit-feeAmount');
Route::post('update-feeAmount/{fee_category_id}',[FeeAmountController::class,'updatefeeAmount'])->name('update-feeAmount');
Route::get('detail-feeAmount/{fee_category_id}',[FeeAmountController::class,'detailfeeAmount'])->name('detail-feeAmount');
//Exam Type Route
Route::get('view-exam',[ExamTypeController::class,'viewexam'])->name('view-exam');
Route::get('add-exam',[ExamTypeController::class,'addexam'])->name('add-exam');
Route::post('store-exam',[ExamTypeController::class,'storeexam'])->name('store-exam');
Route::get('edit-exam/{id}',[ExamTypeController::class,'editexam'])->name('edit-exam');
Route::post('update-exam/{id}',[ExamTypeController::class,'updateexam'])->name('update-exam');
Route::get('delete-exam/{id}',[ExamTypeController::class,'deleteexam'])->name('delete-exam');

//Exam Type Route
Route::get('view-subject',[SubjectController::class,'viewsubject'])->name('view-subject');
Route::get('add-subject',[SubjectController::class,'addsubject'])->name('add-subject');
Route::post('store-subject',[SubjectController::class,'storesubject'])->name('store-subject');
Route::get('edit-subject/{id}',[SubjectController::class,'editsubject'])->name('edit-subject');
Route::post('update-subject/{id}',[SubjectController::class,'updatesubject'])->name('update-subject');
Route::get('delete-subject/{id}',[SubjectController::class,'deletesubject'])->name('delete-subject');

//Assign Subject  Route
Route::get('view-assign-subject',[AssignSubjectController::class,'viewsubject'])->name('view-assign-subject');
Route::get('add-assign-subject',[AssignSubjectController::class,'addsubject'])->name('add-assign-subject');
Route::post('store-assign-subject',[AssignSubjectController::class,'storesubject'])->name('store-assign-subject');
Route::get('edit-assign-subject/{class_id}',[AssignSubjectController::class,'editsubject'])->name('edit-assign-subject');
Route::post('update-assign-subject/{class_id}',[AssignSubjectController::class,'updatesubject'])->name('update-assign-subject');
Route::get('detail-assign-subject/{class_id}',[AssignSubjectController::class,'detailsubject'])->name('detail-assign-subject');
//designation Route
Route::get('view-designation',[DesignationController::class,'viewdesignation'])->name('view-designation');
Route::get('add-designation',[DesignationController::class,'adddesignation'])->name('add-designation');
Route::post('store-designation',[DesignationController::class,'storedesignation'])->name('store-designation');
Route::get('edit-designation/{id}',[DesignationController::class,'editdesignation'])->name('edit-designation');
Route::post('update-designation/{id}',[DesignationController::class,'updatedesignation'])->name('update-designation');
Route::get('delete-designation/{id}',[DesignationController::class,'deletedesignation'])->name('delete-designation');
//registration Route
Route::get('view-student',[RegistrationController::class,'viewregistration'])->name('view-student');
Route::get('add-student',[RegistrationController::class,'addregistration'])->name('add-student');
Route::post('store-student',[RegistrationController::class,'storeregistration'])->name('store-student');
Route::get('edit-student/{student_id}',[RegistrationController::class,'editregistration'])->name('edit-student');
Route::post('update-student/{student_id}',[RegistrationController::class,'updateregistration'])->name('update-student');
Route::get('promotion-student/{student_id}',[RegistrationController::class,'promotion'])->name('promotion-student');
Route::post('update-promotion/{student_id}',[RegistrationController::class,'updatepromotion'])->name('update-promotion');
Route::get('details-student/{student_id}',[RegistrationController::class,'details'])->name('details-student');

Route::get('year-class-wise',[RegistrationController::class,'yearClassWise'])->name('year-class-wise');
//Roll Generate Route
Route::get('view-roll',[RollController::class,'viewroll'])->name('view-roll');
Route::get('get-student',[RollController::class,'getStudent'])->name('get-student');
Route::post('store-roll',[RollController::class,'storeroll'])->name('store-roll');
//Registration Fee 
Route::get('view-reg-fee',[RegistrationFeeController::class,'viewregistration'])->name('view-reg-fee');
Route::get('reg-get-student',[RegistrationFeeController::class,'regGetStudent'])->name('reg-get-student');
Route::get('reg-fee-payslip',[RegistrationFeeController::class,'regFeePayslip'])->name('reg-fee-payslip');
//Month Fee 
Route::get('view-month-fee',[MonthlyFeeController::class,'view'])->name('view-month-fee');
Route::get('month-get-student',[MonthlyFeeController::class,'GetStudent'])->name('month-get-student');
Route::get('month-fee-payslip',[MonthlyFeeController::class,'FeePayslip'])->name('month-fee-payslip');
//exam Fee 
Route::get('view-exam-fee',[ExamFeeController::class,'view'])->name('view-exam-fee');
Route::get('exam-get-student',[ExamFeeController::class,'GetStudent'])->name('exam-get-student');
Route::get('exam-fee-payslip',[ExamFeeController::class,'FeePayslip'])->name('exam-fee-payslip');
//Employee Registration  
Route::get('view-reg-employee',[EmployeeRegController::class,'view'])->name('view-reg-employee');
Route::get('add-reg-employee',[EmployeeRegController::class,'add'])->name('add-reg-employee');
Route::post('store-reg-employee',[EmployeeRegController::class,'store'])->name('store-reg-employee');
Route::get('edit-reg-employee/{id}',[EmployeeRegController::class,'edit'])->name('edit-reg-employee');
Route::post('update-reg-employee/{id}',[EmployeeRegController::class,'update'])->name('update-reg-employee');
Route::get('details-reg-employee/{id}',[EmployeeRegController::class,'details'])->name('details-reg-employee');
//Employee salary
Route::get('view-salary-employee',[EmployeeSalaryController::class,'view'])->name('view-salary-employee');
Route::get('increment-salary-employee/{id}',[EmployeeSalaryController::class,'increment'])->name('increment-salary-employee');
Route::post('store-salary-employee/{id}',[EmployeeSalaryController::class,'store'])->name('store-salary-employee');
Route::post('update-salary-employee/{id}',[EmployeeSalaryController::class,'update'])->name('update-salary-employee');
Route::get('details-salary-employee/{id}',[EmployeeSalaryController::class,'details'])->name('details-salary-employee');
//Employee Leave
Route::get('view-leave-employee',[EmployeeLeaveController::class,'view'])->name('view-leave-employee');
Route::get('add-leave-employee',[EmployeeLeaveController::class,'add'])->name('add-leave-employee');
Route::post('store-leave-employee',[EmployeeLeaveController::class,'store'])->name('store-leave-employee');
Route::get('edit-leave-employee/{id}',[EmployeeLeaveController::class,'edit'])->name('edit-leave-employee');
Route::post('update-leave-employee/{id}',[EmployeeLeaveController::class,'update'])->name('update-leave-employee');
//Employee Attendace
Route::get('view-attend-employee',[EmployeeAttendController::class,'view'])->name('view-attend-employee');
Route::get('add-attend-employee',[EmployeeAttendController::class,'add'])->name('add-attend-employee');
Route::post('store-attend-employee',[EmployeeLeaveController::class,'store'])->name('store-attend-employee');
Route::get('edit-attend-employee/{date}',[EmployeeAttendController::class,'edit'])->name('edit-attend-employee');
Route::post('update-attend-employee/{id}',[EmployeeAttendController::class,'update'])->name('update-attend-employee');
Route::get('details-attend-employee/{id}',[EmployeeAttendController::class,'details'])->name('details-attend-employee');
//Employee monthly salary
Route::get('view-monthly-salary',[EmployeeMonthlySalary::class,'view'])->name('view-monthly-salary');
Route::get('get-monthly-salary',[EmployeeMonthlySalary::class,'get'])->name('employee.monthly.salary.get');

Route::get('add-monthly-salary',[EmployeeMonthlySalary::class,'add'])->name('add-monthly-salary');
Route::post('store-monthly-salary',[EmployeeMonthlySalary::class,'store'])->name('store-monthly-salary');
Route::get('edit-monthly-salary/{date}',[EmployeeMonthlySalary::class,'edit'])->name('edit-monthly-salary');
Route::post('update-monthly-salary/{id}',[EmployeeMonthlySalary::class,'update'])->name('update-monthly-salary');
Route::get('details-monthly-salary/{id}',[EmployeeMonthlySalary::class,'details'])->name('details-monthly-salary');

//Student Marks Entry
Route::get('add-marks',[MarksController::class,'add'])->name('add-marks');
Route::post('store-marks',[MarksController::class,'store'])->name('store-marks');
Route::get('edit-marks',[MarksController::class,'edit'])->name('edit-marks');
Route::get('get-student-marks',[MarksController::class,'getMarks'])->name('get-student-marks');
Route::post('update-marks',[MarksController::class,'update'])->name('update-marks');

//grade point
Route::get('view-marks-grade',[GradeController::class,'view'])->name('view-marks-grade');
Route::get('add-marks-grade',[GradeController::class,'add'])->name('add-marks-grade');
Route::post('store-marks-grade',[GradeController::class,'store'])->name('store-marks-grade');
Route::get('edit-marks-grade/{id}',[GradeController::class,'edit'])->name('edit-marks-grade');
Route::post('update-marks-grade/{id}',[GradeController::class,'update'])->name('update-marks-grade');

//Student Accounts
Route::get('Accounts-fee-view',[AccountsFeeController::class,'view'])->name('Accounts-fee-view');
Route::get('Accounts-fee-add',[AccountsFeeController::class,'add'])->name('Accounts-fee-add');
Route::post('Accounts-fee-store',[AccountsFeeController::class,'store'])->name('Accounts-fee-store');
Route::get('get-student',[AccountsFeeController::class,'getStudent'])->name('get-student');

//Employee Salary
Route::get('Accounts-employee-view',[SalaryController::class,'view'])->name('Accounts-employee-view');
Route::get('Accounts-employee-add',[SalaryController::class,'add'])->name('Accounts-employee-add');
Route::post('Accounts-employee-store',[SalaryController::class,'store'])->name('Accounts-employee-store');
Route::get('get-employee',[SalaryController::class,'getEmployee'])->name('get-employee');
//other cost
Route::get('other-cost-view',[OtherCostController::class,'view'])->name('other-cost-view');
Route::get('other-cost-add',[OtherCostController::class,'add'])->name('other-cost-add');
Route::post('other-cost-store',[OtherCostController::class,'store'])->name('other-cost-store');
Route::get('other-cost-edit/{id}',[OtherCostController::class,'edit'])->name('other-cost-edit');
Route::post('other-cost-update/{id}',[OtherCostController::class,'update'])->name('other-cost-update');
//Profit 
Route::get('profit-view',[ProfitController::class,'view'])->name('profit-view');
Route::get('profit-get',[ProfitController::class,'getProfit'])->name('profit-get');
Route::get('profit-pdf',[ProfitController::class,'ProfitPayslip'])->name('profit-pdf');

//marksheet
Route::get('marksheet-view',[MarkSheetController::class,'view'])->name('marksheet-view');
Route::get('marksheet-get',[MarkSheetController::class,'marksheetGet'])->name('marksheet-get');
//marksheet
Route::get('attendance-report',[AttendanceReportController::class,'view'])->name('attendance-report');
Route::get('attendance-get',[AttendanceReportController::class,'attendanceGet'])->name('attendance-get');

//result
Route::get('result-view',[MarkSheetController::class,'viewResult'])->name('result-view');
Route::get('result-get',[MarkSheetController::class,'resultGet'])->name('result-get');


//default controller
Route::get('student-get-student',[DefaultController::class,'getStudent'])->name('student-get-student');
Route::get('get-subject',[DefaultController::class,'getSubject'])->name('get-subject');

