<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['id' => 1,'name' => 'Admin', 'email' => 'admin@admin.com', 'password' => '123456','role_id' => 1], //admin
            ['id' => 2,'name' => 'Loan Seeker', 'email' => 'loanseeker@mailinator.com', 'password' => '123456','role_id' => 2] //user (loan seeker)
        ];

        foreach ($items as $item) {
            \App\Models\User::create($item);
        }
    }
}
