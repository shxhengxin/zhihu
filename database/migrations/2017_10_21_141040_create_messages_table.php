<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('from_user_id')->comment('发送私信用户id');
            $table->unsignedInteger('to_user_id')->comment('接收私信用户id');
            $table->text('body')->comment('私信内容');
            $table->string('has_read',8)->default('F')->comment('已读状态');
            $table->timestamp('read_at')->nullable()->comment('已读时间');
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
        Schema::dropIfExists('messages');
    }
}
