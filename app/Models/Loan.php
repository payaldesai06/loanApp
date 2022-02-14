<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    protected $table = "loan_applications";

    protected $fillable = [
        'user_id','amount','loan_terms','status'
    ];
    //status => 0->declined,1->approved,3->paid

    public static function boot() {
        parent::boot();
        static::creating(function($loan) { // before delete() method call this
            //$loan->user_id = \Auth::user()->id;
        });
    }

    //user relationship
    public function user(){
        return $this->belongsTo('App\Models\User','user_id');
    }

    //loan repays relationship
    public function repays(){
        return $this->hasMany('App\Models\LoanRepay');
    }

}
