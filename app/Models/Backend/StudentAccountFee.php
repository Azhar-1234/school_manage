<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;
use App\User;
class StudentAccountFee extends Model
{
    
    public function student(){
		return $this->belongsTo(User::class,'student_id','id');
	}   
	public function student_class(){
		return $this->belongsTo(StudentClass::class,'class_id','id');
	}

    public function year(){
		return $this->belongsTo(StudentYear::class,'year_id','id');
	}
    public function fee_category(){
		return $this->belongsTo(FeeCategory::class,'fee_category_id','id');
	}

}
