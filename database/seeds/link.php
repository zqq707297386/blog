<?php

use Illuminate\Database\Seeder;

class link extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            $data = [
            ];
            DB::table('link')->insert($data);
    }
}
