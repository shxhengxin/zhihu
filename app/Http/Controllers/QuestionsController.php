<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuestionRequest;
use App\Repositories\QuestionRepository;
use Illuminate\Support\Facades\Auth;

/**发布问题
 * Class QuestionsController
 * @package App\Http\Controllers
 */

class QuestionsController extends Controller
{
    /**
     * @var QuestionRepository
     */
    protected $questionRepository;


    /**
     * QuestionsController constructor.
     */
    public function __construct(QuestionRepository $questionRepository)
    {
        $this->middleware('auth')->except(['index', 'show']);
        $this->questionRepository = $questionRepository;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = $this->questionRepository->getQuestionsFeed();

        return view('questions.index',compact('questions'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('questions.make');
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreQuestionRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreQuestionRequest $request)
    {

        $id = $this->questionRepository->create($request);

        return redirect()->route('questions.show',[$id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

         $question = $this->questionRepository->byIdWithTopicsAnswers('id',$id,['topics','answers']);

         return view('questions.show',compact('question'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $question = $this->questionRepository->byId($id);
        if(!Auth::user()->owns($question)){
            flash()->overlay('你没有权限','用户权限');
            return back();
        }

        return view('questions.edit',compact('question'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreQuestionRequest $request, $id)
    {

       $id = $this->questionRepository->update($request,$id);

       return redirect()->route('questions.show',[$id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $question = $this->questionRepository->byId($id);

        if(!Auth::user()->owns($question)){
            flash()->overlay('你没有权限','用户权限');
            return back();
        }

        $question->delete();
        return redirect('/');
    }
}
