<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Loan;
use App\Models\LoanRepay;
use Validator;
use App\Http\Controllers\Api\ApiresponseController;
use Commonhelper;

class LoanController extends Controller
{
    //loan application
    public static function loanApplication(Request $request)
    {
        $rules = [
        	'amount'  => 'required|integer|min:0|not_in:0',
            'loan_terms' => 'required'
        ];
    	$validator = Validator::make($request->all(),$rules);
        if (@$validator->fails()) {
            return ApiresponseController::apiresponse(0,$validator->errors()->first());
        }
        else
        {
            try{
                $data = $request->only('amount','loan_terms');
                //insert loan application
                if($loan = Loan::create($data))
                {
                    return ApiresponseController::apiresponse(1,'Loan applied successfully.',ApiresponseController::mergeWithKey($loan->toArray()));
                }
                else
                {
                    return ApiresponseController::apiresponse(0,'Error in process. Try again!');
                }
            }catch(\Exception $e){
                return ApiresponseController::apiresponse(0,$e->getMessage());
            }
        }
    }

    //loan weekly repayment
    public static function loanRepay(Request $request)
    {
        $rules = [
            'loan_id' => 'required',
        	'amount'  => 'required|integer|min:0|not_in:0'
        ];
    	$validator = Validator::make($request->all(),$rules);
        if (@$validator->fails()) {
            return ApiresponseController::apiresponse(0,$validator->errors()->first());
        }
        else
        {
            try{
                $data = $request->only('loan_id','amount');
                //check loan
                $loan = Loan::find($request->loan_id);
                if(isset($loan)){
                    //check loan status
                    if($message = Commonhelper::checkLoanStatus($loan))
                    {
                        return ApiresponseController::apiresponse(0,$message);
                    }
                    //check loan amount
                    $totalloanamount = $loan->amount; //total loan amount
                    $paidloanamount = LoanRepay::where('loan_id',$request->loan_id)->sum('amount'); //total repaid amount
                    $debtloanamount = $totalloanamount - $paidloanamount; //debt amount for repay
                    //check repay amount with total loan amount
                    if($request->amount > $totalloanamount)
                    {
                        return ApiresponseController::apiresponse(0,'Amount should not be greater than total loan amount. Your total debt amount to pay is : '.$debtloanamount);
                    }
                    //check debt loan amount for repay
                    if($request->amount > $debtloanamount)
                    {
                        return ApiresponseController::apiresponse(0,'Amount should not be greater than debt amount to pay. Your total debt amount to pay is : '.$debtloanamount);
                    }
                    //insert loan repay installment
                    if(LoanRepay::create($data))
                    {
                        //change loan status to paid if all repayments done
                        if(($paidloanamount + $request->amount) == $totalloanamount){
                            $loan->status = 2;
                            $loan->save();
                            return ApiresponseController::apiresponse(1,'Loan repaid successfully.');
                        }
                        return ApiresponseController::apiresponse(1,'Loan weekly repayment done successfully.');
                    }
                }
                return ApiresponseController::apiresponse(0,'Loan application not found.');
            }catch(\Exception $e){
                return ApiresponseController::apiresponse(0,$e->getMessage());
            }
        }
    }

}
