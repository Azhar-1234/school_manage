<?php

namespace App\Models\BackEnd\Employee;

use Illuminate\Database\Eloquent\Model;
use App\User;
class EmployeeLeave extends Model
{
    public function user(){
    	return $this->belongsTo(User::class,'employee_id','id');
    }
    public function purpose(){
    	return $this->belongsTo(User::class,'employee_id','id');
    }

}
