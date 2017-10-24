<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique()->comment('用户名');
            $table->string('email')->unique()->comment('邮箱');
            $table->string('password')->comment('密码');
            $table->string('avatar')->comment('头像');
            $table->string('confirmation_token');
            $table->smallInteger('is_active')->default(0)->comment('是否激活邮箱');
            $table->integer('questions_count')->default(0)->comment('发表问题数');
            $table->integer('answers_count')->default(0)->comment('回答数');
            $table->integer('comments_count')->default(0)->comment('评论数');
            $table->integer('favorites_count')->default(0)->comment('收藏数');
            $table->integer('likes_count')->default(0)->comment('点赞数');
            $table->integer('followers_count')->default(0)->comment('关注数');
            $table->integer('followings_count')->default(0)->comment('被关注数');
            $table->json('settings')->nullable()->comment('个人资料');
            $table->string('api_token',64)->unique();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
