<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/23 0023
 * Time: 下午 10:01
 */

namespace App\Repositories;


use App\Models\Message;

class InboxRepository
{
    public function index()
    {
        $messages = Message::where('to_user_id', user()->id)
            ->orWhere('from_user_id', user()->id)
            ->with(['fromUser' => function ($query) {
                return $query->select(['id', 'name', 'avatar']);
            }, 'toUser' => function ($query) {
                return $query->select(['id', 'name', 'avatar']);
            }])->latest()->get();
        return $messages->unique('dialog_id')->groupBy('to_user_id');
    }

    public function show($id)
    {
        return Message::where('dialog_id', $id)
            ->with(['fromUser' => function ($query) {
                return $query->select(['id', 'name', 'avatar']);
            }, 'toUser' => function ($query) {
                return $query->select(['id', 'name', 'avatar']);
            }])->latest()->get();
    }

    public function store($id)
    {
        return Message::where('dialog_id', $id)->first();

    }

    public function ToUserId($message)
    {
        return $message->from_user_id === user()->id ? $message->to_user_id : $message->from_user_id;
    }

    public function create(array $attributes)
    {
        return Message::create($attributes);
    }
}