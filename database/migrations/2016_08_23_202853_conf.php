<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Conf extends Migration
{
    /**
     * 网站配置项
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conf', function (Blueprint $table) {
            $table->engine = 'MyISAM';
            $table->increments('conf_id');
            $table->string('conf_title',50)->default('')->comment('配置项标题');
            $table->string('conf_name',50)->default('')->comment('变量名');
            $table->text('conf_content')->comment('内容');
            $table->integer('conf_order')->default(0)->comment('排序');
            $table->string('conf_tips')->default('')->comment('解释');
            $table->string('field_type',50)->default('')->comment('字段类型');
            $table->string('field_value')->default('')->comment('字段值');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('conf');
    }
}
