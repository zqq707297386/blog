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
                [
                    'link_name' =>'百度',
                    'link_title' => 'baidu',
                    'link_url' => 'http://www.baidu.com',
                    'link_order'=>1
                ],
                [
                    'link_name' =>'腾讯QQ',
                    'link_title' => '腾讯网',
                    'link_url' => 'http://www.qq.com/',
                    'link_order'=>2
                ]
            ];
            DB::table('link')->insert($data);
    }
}
