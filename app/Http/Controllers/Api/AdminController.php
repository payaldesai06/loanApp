<?php

namespace App\Http\Controllers\Api;

use Commonhelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Loan;
use Validator;
use App\Http\Controllers\Api\ApiresponseController;

class AdminController extends Controller
{
    //loan applications
    public static function loans()
    {
        try{
            $loans = Loan::whereNull('status')->get(); //get requested loans
            if($loans)
            {
                return ApiresponseController::apiresponse(1,'Get loans successfully.',ApiresponseController::mergeWithKey($loans->toArray()));
            }
            else
            {
                return ApiresponseController::apiresponse(0,'No data found!');
            }
        }catch(\Exception $e){
            return ApiresponseController::apiresponse(0,$e->getMessage());
        }
    }

    //take loan application action to accept/decline
    public static function loanAction(Request $request)
    {
        $rules = [
        	'status'  => 'required|in:1,0',
            'loan_id' => 'required'
        ];
    	$validator = Validator::make($request->all(),$rules);
        if (@$validator->fails()) {
            return ApiresponseController::apiresponse(0,$validator->errors()->first());
        }
        else
        {
            try{
                $loan = Loan::find($request->loan_id);
                if(isset($loan)){
                    //check loan status
                    if($message = Commonhelper::checkLoanStatusForAdmin($loan))
                    {
                        return ApiresponseController::apiresponse(0,$message);
                    }
                    $status = ($request->status == 1) ? 1 : 0;
                    $message = ($status == 1) ? 'Loan approved successfully.' : 'Loan declined successfully.';
                    $loan->status = $status; //update loan status
                    $loan->save();
                    return ApiresponseController::apiresponse(1,$message);
                }
                return ApiresponseController::apiresponse(0,'Loan application not found.');
            }catch(\Exception $e){
                return ApiresponseController::apiresponse(0,$e->getMessage());
            }
        }
    }

}
