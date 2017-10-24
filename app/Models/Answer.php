<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['user_id', 'question_id', 'body'];

    /**
     * 获取答案所属的问题
     * 回答表 ---- 提问表
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    /**
     * 获取答案的所有用户
     * 回答----用户表
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * 答案---评论 (多态关联)
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function comments()
    {
        return $this->morphMany(Comment::class,'commentable');
    }
}
