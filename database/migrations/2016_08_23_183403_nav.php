<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Nav extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nav', function (Blueprint $table) {
            $table->engine = 'MyISAM';
            $table->increments('nav_id');
            $table->string('nav_name',50)->default('');
            $table->string('nav_alias',50)->default('')->comment('//别名');
            $table->string('nav_url',50)->default('');
            $table->integer('nav_order')->default(0);
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
