<?php

namespace App\Models\Backend\Employee;

use Illuminate\Database\Eloquent\Model;
use App\User;

class EmployeeSalaryAccount extends Model
{
	 public function user(){
	 	return $this->belongsTo(User::class,'employee_id','id');
	 }   
}
