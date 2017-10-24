<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;
use App\Repositories\AnswersRepository;
use App\Repositories\CommentRepository;
use App\Repositories\QuestionRepository;
use Illuminate\Http\Request;


class CommentsController extends Controller
{
    protected $answer;
    protected $question;
    protected $comment;

    /**
     * CommentsController constructor.
     * @param $answer
     * @param $question
     * @param $comment
     */
    public function __construct(AnswersRepository $answer, QuestionRepository $question,CommentRepository $comment)
    {
        $this->answer = $answer;
        $this->question = $question;
        $this->comment = $comment;
    }

    /**
     * 答案的评论
     * @param $answer
     * @return mixed
     */
    public function answer($answer)
    {
        return $this->answer->getAnswerCommentsById($answer);
    }

    /**
     * 问题的评论
     * @param $question
     * @return mixed
     */
    public function question($question)
    {
        return $this->question->getQuestionCommentsById($question);
    }

    /**
     * 用户评论
     * @param StoreCommentRequest $request
     * @return mixed
     */
    public function store(StoreCommentRequest $request)
    {
        return $this->comment->create($request,$this->answer,$this->question);
    }




}
