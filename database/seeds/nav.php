<?php

use Illuminate\Database\Seeder;

class nav extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
                'nav_name' =>'zqqblog',
                'nav_alias' => '郑启强博客',
                'nav_url' => 'http://www.zqqblog.com',
                'nav_order'=>1
        ];
        DB::table('nav')->insert($data);
    }
}
