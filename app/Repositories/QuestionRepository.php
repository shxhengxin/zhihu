<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/18 0018
 * Time: 下午 4:23
 */

namespace App\Repositories;

use App\Models\Question;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;

class QuestionRepository
{
    protected $http;

    /**
     * QuestionRepository constructor.
     * @param $http
     */
    public function __construct(Client $http)
    {
        $this->http = $http;
    }

    /**
     * 插入数据
     * @param array $attributes
     * @return mixed
     */
    public function create($res)
    {
        //内部请求接口
        $topics = $this->http->post(env('APP_URL') . '/api/topics', ['form_params' => $res->get('topics')]);
        $topics = json_decode((string)$topics->getBody(), true);

        $data = ['title' => $res->get('title'), 'body' => $res->get('body'), 'user_id' => Auth::id()];
        $question = Question::create($data);
        //写入第三方表
        $question->topics()->attach($topics);

        return $question->id;
    }


    /**
     * 查询数据
     * @param $filed 字段
     * @param $value 值
     * @param array $withValue 模型中定义关联关系的方法
     * @return mixed
     */
    public function byIdWithTopicsAnswers($filed, $value, $withValue = [])
    {
        return Question::where($filed, $value)->with($withValue)->first();

    }

    /**
     * 以id查询数据
     * @param $id
     * @return mixed
     */
    public function byId($id)
    {
        return Question::find($id);
    }

    /**
     * 更新
     * @param $res
     * @param $id
     * @return mixed
     */
    public function update($res, $id)
    {
        $question = $this->byId($id);
        //内部请求接口
        $topics = $this->http->post(env('APP_URL') . '/api/topics', ['form_params' => $res->get('topics')]);
        $topics = json_decode((string)$topics->getBody(), true);

        $question->update(['title' => $res->get('title'), 'body' => $res->get('body')]);

        $question->topics()->sync($topics);//同步第三方表

        return $question->id;
    }

    /**
     * 获取所有显示的问题及该用户的信息
     * @return mixed
     */
    public function getQuestionsFeed()
    {
        return Question::published()->latest('updated_at')->with('user')->get();
    }

    /**
     * 指定问题的评论
     * @param $id
     * @return mixed
     */
    public function getQuestionCommentsById($id)
    {
        $question = Question::with('comments', 'comments.user')->where('id', $id)->first();

        return $question->comments;
    }

    /**
     * 增问题的
     * @param $id
     */
    public function addCommentsCount($id)
    {
        $question = $this->byId($id);
        $question->increment('comments_count');
    }
}