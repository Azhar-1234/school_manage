<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

class FeeCategory extends Model
{
	public function amount(){
		return $this->belongsTo(FeeCategory::class,'fee_category_id','id');
	}
    //
}
