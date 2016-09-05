<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Category extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category', function (Blueprint $table) {
            $table->engine = 'MyISAM';
            $table->increments('cate_id');
            $table->string('cate_name',55)->nullable()->comment('//栏目名称');
            $table->string('cate_title')->nullable()->comment('//栏目标题');
            $table->string('cate_keywords')->nullable()->comment('//关键词');
            $table->string('cate_description')->nullable()->comment('//描述');
            $table->integer('cate_view')->default(0)->comment('//查看次数');
            $table->tinyInteger('cate_order')->default(0)->comment('//排序');
            $table->integer('cate_pid')->default(0)->comment('//父级ID');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('category');
    }
}
