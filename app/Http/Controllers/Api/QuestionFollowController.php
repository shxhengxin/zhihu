<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\QuestionFollowRepository;
use Illuminate\Http\Request;

class QuestionFollowController extends Controller
{
    protected $questionFollow;

    /**
     * QuestionFollowController constructor.
     * @param $questionFollow
     */
    public function __construct(QuestionFollowRepository $questionFollow)
    {
        $this->questionFollow = $questionFollow;
    }

    public function isFollow(Request $request)
    {
        return $this->questionFollow->isFollow($request);
    }

    public function followThisQuestion(Request $request)
    {

        return $this->questionFollow->createFollow($request);
    }
}
