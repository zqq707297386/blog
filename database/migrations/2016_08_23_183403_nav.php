<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Nav extends Migration
{
    /**
     * 导航栏
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nav', function (Blueprint $table) {
            $table->engine = 'MyISAM';
            $table->increments('nav_id');
            $table->string('nav_name',50)->default('')->comment('导航栏名称');
            $table->string('nav_alias',50)->default('')->comment('别名');
            $table->string('nav_url',50)->default('')->comment('URL');
            $table->integer('nav_order')->default(0)->comment('排序');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('nav');
    }
}
