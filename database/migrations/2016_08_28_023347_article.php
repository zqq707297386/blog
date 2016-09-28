<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Article extends Migration
{
    /**
     * 文章表
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article', function (Blueprint $table) {
            $table->engine = 'MyISAM';
            $table->increments('art_id')->comment('主键');
            $table->string('art_title',100)->nullable()->comment('标题');
            $table->string('art_tag',100)->nullable()->comment('关键词');
            $table->string('art_description')->nullable()->comment('描述');
            $table->string('art_thumb')->nullable()->comment('缩略图');
            $table->string('art_editor',50)->nullable()->comment('编辑者');
            $table->string('art_time',100)->nullable()->comment('编辑时间');
            $table->text('art_content')->nullable()->comment('内容');
            $table->integer('art_view')->default(0)->comment('查看次数');
            $table->integer('cate_id')->nullable()->comment('栏目id');
            $table->tinyInteger('r_pic_id')->nullable()->comment('推荐图片id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('article');
    }
}
