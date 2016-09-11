<?php

use Illuminate\Database\Seeder;

class user extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
                'user_name' =>'admin',
                'user_pass' => encrypt('123456')
        ];
        DB::table('user')->insert($data);
    }
}
