<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/19 0019
 * Time: 下午 10:21
 */

namespace App\Repositories;


use App\Models\Answer;
use Illuminate\Support\Facades\Auth;

class AnswersRepository
{
    /**
     * @param $res
     * @param $question
     * @return mixed
     */
    public function create($res, $question)
    {
        $answer = Answer::create(['question_id' => $question, 'user_id' => Auth::id(), 'body' => $res->get('body')]);
        $answer->question()->increment('answers_count');
        return $answer;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function byId($id)
    {
        return Answer::find($id);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getAnswerCommentsById($id)
    {
        $answer = Answer::with('comments', 'comments.user')->where('id', $id)->first();

        return $answer->comments;
    }

    //增加答案的评论数
    public function addCommentsCount($id)
    {
        $answer = $this->byId($id);
        $answer->increment('comments_count');
    }
}