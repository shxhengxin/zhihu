<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\MessageRepository;
use Illuminate\Http\Request;

class MessagesController extends Controller
{
    protected $message;

    /**
     * MessagesController constructor.
     * @param $message
     */
    public function __construct(MessageRepository $message)
    {
        $this->message = $message;
    }

    public function store(Request $request)
    {
        return $this->message->store($request);
    }
}
