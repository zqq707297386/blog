<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class About extends Migration
{
    /**
     * about me
     *
     * @return void
     */
    public function up()
    {
        Schema::create('about', function (Blueprint $table) {
            $table->engine = 'MyISAM';
            $table->increments('about_id');
            $table->string('about_thumb')->nullable()->comment('头像');
            $table->string('about_name',10)->nullable()->comment('姓名');
            $table->string('about_region',30)->nullable()->comment('地区');
            $table->string('about_description',100)->nullable()->comment('个人简介');
            $table->string('about_autograph',100)->nullable()->comment('个性签名');
            $table->string('about_title',100)->nullable()->comment('标题');
            $table->text('about_content')->nullable()->comment('关于我的内容');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('about');
    }
}
