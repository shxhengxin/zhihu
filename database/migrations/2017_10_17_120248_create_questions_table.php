<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->comment('提问标题');
            $table->text('body')->comment('提问内容');
            $table->integer('user_id')->unsigned()->comment('用户id');
            $table->integer('comments_count')->default(0)->comment('评论数');
            $table->integer('followers_count')->default(1)->comment('关注数');
            $table->integer('answers_count')->default(0)->comment('回答数');
            $table->string('close_comment',8)->default('F')->comment('是否关闭评论');
            $table->string('is_hidden',8)->default('F')->comment('是否隐藏');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions');
    }
}
