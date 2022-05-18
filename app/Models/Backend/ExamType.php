<?php

namespace App\Models\BackEnd;

use Illuminate\Database\Eloquent\Model;

class ExamType extends Model
{
	public function amount(){
		return $this->belongsTo(FeeCategory::class,'fee_category_id','id');
	}
}
