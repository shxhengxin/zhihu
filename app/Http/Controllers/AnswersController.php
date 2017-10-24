<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAnswerRequest;
use App\Repositories\AnswersRepository;
use Illuminate\Http\Request;

class AnswersController extends Controller
{
    protected $answer;

    /**
     * AnswersController constructor.
     * @param $answer
     */
    public function __construct(AnswersRepository $answer)
    {
        $this->answer = $answer;
    }

    public function store(StoreAnswerRequest $request,$question)
    {
        $this->answer->create($request,$question);
        return back();
    }
}
