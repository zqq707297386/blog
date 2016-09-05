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
                'user_pass' => 'eyJpdiI6IkkwaG50XC9tWTRPR1ZjWlZrUW1iSnlBPT0iLCJ2YWx1ZSI6ImlWZ21tRFRFVlRCdnA0cnpFRlZrZ1E9PSIsIm1hYyI6IjM4YTgzZmI5ZmExZjg3ZjIyMzJlY2Y0ZjUxZTY0ZDRhOWI5NzhkNTFlMzUzN2U0MTJkOWU3NDFjMTVmOWU1YTYifQ=='
        ];
        DB::table('user')->insert($data);
    }
}
