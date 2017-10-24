<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    //关注问题模型
    /**
     * @var string
     */
    protected $table = 'user_question';

    /**
     * @var array
     */
    protected $fillable = ['user_id', 'question_id'];
}
