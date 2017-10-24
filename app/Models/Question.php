<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['title', 'body', 'user_id'];

    /**
     * 获取该问题下所有的话题
     * question表跟topic表多对多关联,如果中间表不是question_topic形式，需要在第二个参数中定义
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function topics()
    {
        return $this->belongsToMany(Topic::class)->withTimestamps();
    }

    /**
     * 问题---用户
     * 获取该问题所属的用户
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * 提问表----回答表(一对多)
     * 获取该问题下所有的答案
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }


    /**
     * 问题---关注---用户
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function followers()
    {
        return $this->belongsToMany(User::class,'user_question')->withTimestamps();
    }

    /**
     * 判断提问是否是隐藏
     * @param $query
     * @return mixed
     * 使用方式Model::published
     */
    public function scopePublished($query)
    {
        return $query->where('is_hidden','F');
    }

    /**
     * 问题---评论(多态关联)
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function comments()
    {
        return $this->morphMany(Comment::class,'commentable');
    }
}
