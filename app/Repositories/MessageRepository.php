<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/20 0020
 * Time: 下午 11:44
 */

namespace App\Repositories;


use App\Models\Message;
use App\Notifications\NewMessageNotification;


class MessageRepository
{

    public function create(array $attributes)
    {
        return Message::create($attributes);
    }


    public function store($res)
    {
        $message = $this->create([
            'to_user_id' => $res->get('user'),
            'from_user_id' => user('api')->id,
            'body' => $res->get('body'),
            'dialog_id' => $res->get('user') . user('api')->id,
        ]);

        //回复私信的消息通知
        $message->toUser->notify(new NewMessageNotification($message));

        if ($message) {
            return response()->json(['status' => true]);
        }
        return response()->json(['status' => false]);
    }
}