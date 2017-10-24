<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\VoteRepository;

class VotesController extends Controller
{
    protected $vote;

    /**
     * VotesController constructor.
     * @param $vote
     */
    public function __construct(VoteRepository $vote)
    {
        $this->vote = $vote;
    }

    public function isVoted($id)
    {
        return $this->vote->isVoted($id);
    }

    public function vote(Request $request)
    {
        return $this->vote->vote($request);
    }
}
