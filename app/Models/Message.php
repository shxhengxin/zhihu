<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'messages';
    protected $fillable = ['from_user_id', 'to_user_id', 'body', 'has_read','dialog_id'];

    /**
     * 发送私信的用户
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public  function fromUser()
    {
        return $this->belongsTo(User::class,'from_user_id');
    }

    /**
     * 接受私信的用户
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public  function toUser()
    {
        return  $this->belongsTo(User::class,'to_user_id');
    }

    /**
     * 标志私信已读
     */
    public function markAsRead()
    {
        if(is_null($this->read_at)){
            $this->forceFill(['has_read'=>'T','read_at'=>$this->freshTimestamp()])->save();
        }
    }

    /**
     * 重写collection
     * @param array $models
     * @return MessageCollection
     */
    public function newCollection(array $models = [])
    {
        //定义了这个方法，$messages->markAsRead()
        return new MessageCollection($models);
    }

    //判断消息是否是已读
    public function read()
    {
        return $this->has_read === 'T';
    }
    public function unRead()
    {
        return $this->has_read === 'F';
    }

    /**
     *显示私信未读已读的样式
     * @return bool
     */
    public function shouldAddUnreadClass()
    {
        if(user()->id === $this->from_user_id){
            return false;
        }
        return $this->unRead();
    }

    /**
     * 私信未读消息个数
     * @return mixed
     */
    public function unReadCount()
    {
        return  Message::where('dialog_id',$this->dialog_id)->where('has_read','F')->count();
    }
}
