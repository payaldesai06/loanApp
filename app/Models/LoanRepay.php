<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoanRepay extends Model
{
    protected $table = "loan_repays";

    protected $fillable = [
		'loan_id','amount'
	];

    //loan relationship
    public function loan()
    {
      return $this->belongsTo('App\Models\Loan','loan_id');
    }

}
