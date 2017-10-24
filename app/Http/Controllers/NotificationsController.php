<?php

namespace App\Http\Controllers;

use App\Repositories\MessageRepository;
use Illuminate\Notifications\DatabaseNotification;

class NotificationsController extends Controller
{
    protected $message;

    /**
     * NotificationsController constructor.
     * @param $message
     */
    public function __construct(MessageRepository $message)
    {
        $this->message = $message;
    }

    public function index()
    {
        $user = user();

        return view('notifications.index',compact('user'));
    }

    public function show(DatabaseNotification $message)
    {

        $message->markAsRead();

        return redirect(\Request::query('redirect_url'));
    }

    public function read()
    {
        
    }
}
