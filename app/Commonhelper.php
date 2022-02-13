<?php

namespace App;
use App\Models\LoanRepay;

class Commonhelper
{
    public static function checkLoanStatus($loan)
    {
        //check loan status by admin
        if($loan->status == null && $loan->status != 0)
        {
            return 'Loan is not approve yet. Please contact our team!';
        }
        //check loan status by admin
        if($loan->status == 0)
        {
            return 'Loan is declined. Please contact our team!';
        }
        //check loan status
        if($loan->status == 2)
        {
            return 'Loan already paid successfully. No need to pay anything!';
        }
        return;
    }

    public static function checkLoanStatusForAdmin($loan)
    {
        //check loan paid status
        if($loan->status == 2)
        {
            return "Loan already paid successfully.";
        }
        //check loan approve status
        if($loan->status == 1)
        {
            return "Loan already approved successfully.";
        }
        return;
    }

}
