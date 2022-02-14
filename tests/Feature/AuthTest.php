<?php

namespace Tests\Feature;

use Tests\TestCase;
use Auth;

class AuthTest extends TestCase
{
    /**
     * A loan feature test login.
     *
     * @return void
     */
    public function test_login()
    {
        $data = [
      	  'email' => 'loanseeker@mailinator.com',
          'password' => '123456'
        ];
        $response = $this->call('POST',"/api/login", $data);
        $response->assertStatus(200);
    }

    /**
     * A loan feature test login.
     *
     * @return void
     */
    public function test_signup()
    {
        $data = [
      	  'email' => 'loanseeker123@mailinator.com',
          'password' => '123456',
          'name' => 'Payal Desai'
        ];
        $response = $this->call('POST',"/api/signup", $data);
        $response->assertStatus(200);
    }

    /**
     * A loan feature test login.
     *
     * @return void
     */
    public function test_logout()
    {
        Auth::loginUsingId(2);
        $response = $this->call('POST',"/api/logout");
        $response->assertStatus(200);
    }
}
