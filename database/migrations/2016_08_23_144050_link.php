<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Link extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('link', function (Blueprint $table) {
            $table->engine = 'MyISAM';
            $table->increments('link_id');
            $table->string('link_name')->default('');
            $table->string('link_title')->default('');
            $table->string('link_url')->default('');
            $table->integer('link_order')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('link');
    }
}
