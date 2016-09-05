<?php

use Illuminate\Database\Seeder;

class category extends Seeder
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
            'cate_name' =>'新闻',
            'cate_title' => '成龙无视习大大，先与他国领导人握手',
            'cate_keywords' => '',
            'cate_description' => '',
            'cate_view' => '',
            'cate_order' => '2',
            'cate_pid' => '0'
            ],
            [
                'cate_name' =>'体育新闻',
                'cate_title' => '今天不烦',
                'cate_keywords' => '开心',
                'cate_description' => '666',
                'cate_view' => '',
                'cate_order' => '1',
                'cate_pid' => '0'
            ],
            [
                'cate_name' =>'军事新闻',
                'cate_title' => '美国打伊拉克',
                'cate_keywords' => '666',
                'cate_description' => '简直不要太6',
                'cate_view' => '',
                'cate_order' => '3',
                'cate_pid' => '0'
            ],
        ];
        DB::table('category')->insert($data);
    }
}
