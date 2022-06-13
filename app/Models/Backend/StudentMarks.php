<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;
use App\User;
class StudentMarks extends Model
{
    public function student(){
    	return $this->belongsTO(User::class,'student_id','id');
    }
    public function student_class(){
    	return $this->belongsTO(StudentClass::class,'class_id','id');
    }
    public function year(){
    	return $this->belongsTO(StudentYear::class,'year_id','id');
    }
    public function assign_subject(){
    	return $this->belongsTO(StudentYear::class,'assign_subject_id','id');
    }
    public function exam_type(){
    	return $this->belongsTO(StudentYear::class,'exam_type_id','id');
    }



}
