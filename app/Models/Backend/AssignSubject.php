<?php

namespace App\Models\BackEnd;

use Illuminate\Database\Eloquent\Model;

class AssignSubject extends Model
{
    
	public function student_class(){
		return $this->belongsTo(StudentClass::class,'class_id','id');
	} 
	public function subject(){
		return $this->belongsTo(Sub::class,'subject_id','id');
	}
	 public function users()
    {
        return $this->belongsTo('App\User');
    }
}
