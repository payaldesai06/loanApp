<?php

namespace Tests\Feature;

use Tests\TestCase;
use Auth;

class LoanTest extends TestCase
{
    /**
     * A loan feature test loan application.
     *
     * @return void
     */
    public function test_loan_application()
    {
        Auth::loginUsingId(2);
        $data = [
      	  'amount' => 10,
          'loan_terms' => 'test',
          'user_id' => 2
        ];
        $response = $this->call('POST',"/api/loan/application", $data);
        $response->assertStatus(200);
    }

    /**
     * A loan feature test loan repay.
     *
     * @return void
     */
    public function test_loan_repay()
    {
        $data = [
      	  'loan_id' => 1,
          'amount' => 10
        ];
        $response = $this->call('POST',"/api/loan/repay", $data);
        $response->assertStatus(200);
    }

    /**
     * A loan feature test loan list for admin.
     *
     * @return void
     */
    public function test_loan_list()
    {
        Auth::loginUsingId(1);
        $response = $this->call('POST',"/api/loans");
        $response->assertStatus(200);
    }

    /**
     * A loan feature test loan action accept/reject for admin.
     *
     * @return void
     */
    public function test_loan_action()
    {
        $data = [
      	  'loan_id' => 1,
          'status' => 1
        ];
        $response = $this->call('POST',"/api/loan/action", $data);
        $response->assertStatus(200);
    }

}
