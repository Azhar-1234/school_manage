<?php

namespace App\Models\Backend\Student;

use Illuminate\Database\Eloquent\Model;
use App\Models\Backend\Student\DiscountStudent;
use App\Models\Backend\StudentClass;
use App\Models\Backend\StudentGroup;
use App\Models\Backend\StudentShift;
use App\Models\Backend\StudentYear; 
use App\Models\BackEnd\AssignSubject;
use App\User;

class AssignStudent extends Model
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
    public function discount(){
		return $this->belongsTo(DiscountStudent::class,'id','assign_student_id');
	} 
}
