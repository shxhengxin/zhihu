<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/20 0020
 * Time: 下午 2:40
 */

namespace App\Repositories;

use App\Models\Question;
use Illuminate\Support\Facades\Auth;

class QuestionFollowRepository
{
    /**
     * 创建或者取消关注
     * @param $question
     * @return mixed
     */
    public function createFollow($res)
    {
        $question = $this->byId($res->get('question'));
        $followed = user('api')->followThis($question->id);

        if (count($followed['detached']) > 0) {//如果是取消关注
            $question->decrement('followers_count');
            return response()->json(['followed' => false]);
        }
        $question->increment('followers_count');
        return response()->json(['followed' => true]);

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
     * 判断用户是否关注
     * @param $res
     * @return \Illuminate\Http\JsonResponse
     */
    public function isFollow($res)
    {

        $followed = user('api')->followed($res->get('question'));

        if ($followed) {
            return response()->json(['followed' => true]);
        }
        return response()->json(['followed' => false]);

    }

    public function followThisQuestion($res)
    {

    }

}