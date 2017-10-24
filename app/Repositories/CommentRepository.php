<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/21 0021
 * Time: 下午 3:25
 */

namespace App\Repositories;

use App\Models\Answer;
use App\Models\Comment;
use App\Models\Question;

class CommentRepository
{
    public function create($res,$answer,$question)
    {

        $model = $this->getModelNameFromType($res->get('type'));

        $comment = Comment::create([
            'commentable_id' => $res->get('model'),
            'commentable_type' => $model,
            'user_id' => user('api')->id,
            'body' => $res->get('body')
        ]);

        return $comment;
    }



    public function byId($id)
    {
        return Comment::find($id);
    }

    /**
     * 判断评论类型
     * @param $type
     * @return string
     */
    public function getModelNameFromType($type)
    {
        return $type === 'question' ? Question::class : Answer::class;
    }



}