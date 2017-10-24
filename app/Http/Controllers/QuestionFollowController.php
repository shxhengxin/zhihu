<?php

namespace App\Http\Controllers;

use App\Repositories\QuestionFollowRepository;
use Illuminate\Http\Request;

class QuestionFollowController extends Controller
{
    protected $questionFollow;

    /**
     * QuestionFollowController constructor.
     * @param $question
     */
    public function __construct(QuestionFollowRepository $questionFollow)
    {
        $this->middleware('auth');
        $this->questionFollow = $questionFollow;
    }

    //用户关注或取消问题
    public function follow($question)
    {
        $this->questionFollow->createFollow($question);
        return back();
    }
}
