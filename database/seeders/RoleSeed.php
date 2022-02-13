<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RoleSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['id' => 1, 'title' => 'Administrator',],
            ['id' => 2, 'title' => 'User',], 
        ];

        foreach($items as $item){
            \App\Models\Role::create($item);
        }
    }
}