<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Loan;
use App\Models\LoanRepay;
use Auth;

class LoanTest extends TestCase
{
    /**
     * A loan unit test loan application.
     *
     * @return void
     */
    public function test_loan_application()
    {
        $data = [
      	  'amount' => 10,
          'loan_terms' => 'test',
          'user_id' => 2
        ];
        if($loan = Loan::create($data)){
            $this->assertEquals($data['amount'],$loan->amount);
        }
    }

    /**
     * A loan unit test loan repay.
     *
     * @return void
     */
    public function test_loan_repay()
    {
        $data = [
      	  'loan_id' => 1,
          'amount' => 10
        ];
        if($repay = LoanRepay::create($data))
        {
            $this->assertEquals($data['amount'],$repay->amount);
        }
    }

    /**
     * A loan unit test loan list for admin.
     *
     * @return void
     */
    public function test_loan_list()
    {
        if($loans = Loan::all())
        {
            $this->assertEquals(1,$loans[0]->id);
        }
    }

    /**
     * A loan unit test loan action accept/reject for admin.
     *
     * @return void
     */
    public function test_loan_action()
    {
        $data = [
      	  'loan_id' => 1,
          'status' => 1
        ];
        $loan = Loan::find($data['loan_id']);
        if(isset($loan)){
            $loan->status = $data['status'];
            $loan->save();
            $this->assertEquals(1,Loan::where('id',$data['loan_id'])->value('status'));
        }
    }

}
