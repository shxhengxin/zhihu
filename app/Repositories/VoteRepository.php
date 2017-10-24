<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/21 0021
 * Time: 上午 1:14
 */

namespace App\Repositories;


use App\Models\Answer;
use Illuminate\Support\Facades\Auth;

class VoteRepository
{

    /**
     * @param $id
     * @return mixed
     */
    public function byId($id)
    {
        return Answer::find($id);
    }

    public function isVoted($id)
    {
        if(user('api')->hasVotedFor($id)){
            return response()->json(['voted'=>true]);
        }
        return response()->json(['voted'=>false]);
    }

    public function vote($res)
    {
        $answer = $this->byId($res->get('answer'));
        $voted = user('api')->voteFor($res->get('answer'));
        if(count($voted['attached'])>0){
            $answer->increment('votes_count');
            return response()->json(['voted' => true]);
        }
        $answer->decrement('votes_count');
        return response()->json(['voted' => false]);
    }
}