<?php

namespace App;

use App\Mailer\UserMailer;
use App\Models\Answer;
use App\Models\Message;
use App\Models\Question;
use App\Models\Setting;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','avatar', 'confirmation_token','api_token','settings'
    ];

    protected $casts = [
        'settings'=>'array'
    ];

    public function settings()
    {
        return new Setting($this);
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * 判断是否是用户本身
     * @param Model $model
     * @return bool
     */
    public function owns(Model $model)
    {
        return $this->id == $model->user_id;
    }

    /**
     * 用户表----回答表(一对多)
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    /**
     * 用户----关注---问题
     * @param $question
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function follows()
    {
        return $this->belongsToMany(Question::class,'user_question')->withTimestamps();
    }

    /**
     * 用户关注的问题
     * @param $question
     * @return array
     */
    public function followThis($question)
    {
        return $this->follows()->toggle($question);
    }

    /**
     * 该问题是否被关注//show.blade.php
     * @param $question
     * @return bool
     */
    public function followed($question)
    {
        return !!$this->follows()->where('question_id',$question)->count();//1\false 0\true
    }

    /**
     *用户----用户 用户的粉丝
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function followers()
    {
        return $this->belongsToMany(self::class,'followers','followed_id', 'follower_id')->withTimestamps();
    }

    /**
     * 用户---用户 用户关注的人
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function followings()
    {
        return $this->belongsToMany(self::class,'followers','follower_id','followed_id')->withTimestamps();
    }

    /**
     * 用户关注其它用户
     * @param $user
     * @return array
     */
    public function followThisUser($user)
    {
        return $this->followings()->toggle($user);
    }

    //用户点赞答案多对多关系
    public function votes()
    {
        return $this->belongsToMany(Answer::class,'votes')->withTimestamps();
    }

    //用户点赞一个答案
    public function voteFor($answer)
    {
        return $this->votes()->toggle($answer);
    }
    //用户是否已经对一个答案进行点赞
    public function hasVotedFor($answer)
    {
        return !! $this->votes()->where('answer_id',$answer)->count();
    }

    /**
     * 用户的私信 用户---消息
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messages()
    {
        return $this->hasMany(Message::class,'to_user_id');
    }

    /**
     * 重置密码发送邮件
     * @param string $token
     */
    public function sendPasswordResetNotification($token)
    {
        /*$data = [
            'url' => url('password/reset',$token)
        ];
        $template = new SendCloudTemplate('zhihu_app_reset', $data);

        Mail::raw($template, function ($message) {
            $message->from('laravelcode@sina.com', 'Laravel');

            $message->to($this->email);
        });*/
        (new UserMailer())->passwordReset($this->email, $token);
    }


}
