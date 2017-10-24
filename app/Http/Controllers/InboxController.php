<?php

namespace App\Http\Controllers;

use App\Notifications\NewMessageNotification;
use App\Repositories\InboxRepository;
use Illuminate\Http\Request;

class InboxController extends Controller
{

    protected $inbox;

    /**
     * InboxController constructor.
     */
    public function __construct(InboxRepository $inbox)
    {
        $this->middleware('auth');
        $this->inbox = $inbox;
    }

    /**
     * 显示私信列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $messages = $this->inbox->index();

        return view('inbox.index',compact('messages'));
    }

    public function show($dialogId)
    {
        $messages = $this->inbox->show($dialogId);

        $messages->markAsRead();
        return view('inbox.show',compact('messages','dialogId'));
    }

    public function store(Request $request,$dialogId)
    {
        $message = $this->inbox->store($dialogId);
        $toUserId = $this->inbox->ToUserId($message);
        $data = [
            'from_user_id' => user()->id,
            'to_user_id' => $toUserId,
            'body' => $request->get('body'),
            'dialog_id' => $dialogId
        ];

        $newMessage = $this->inbox->create($data);

        //回复私信的消息通知
        $newMessage->toUser->notify(new NewMessageNotification($newMessage));
        return back();
    }
}
