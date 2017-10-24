<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/18 0018
 * Time: 下午 10:42
 */

namespace App\Repositories;


use App\Models\Topic;
use Illuminate\Http\Request;

class TopicRepository
{
    /**
     * 获取话题标签
     * @param Request $request
     * @return mixed
     */
    public function getTopicsForTagging(Request $request)
    {
        return Topic::select(['id','name'])
            ->where('name','like','%'.$request->query('q').'%')
            ->get();
    }

    /**
     * 创建话题,存在提问答数加1,不存在,则创建并提问数默认为1
     * @param array $topics
     * @return array
     */
    public function normalizeTopic(array $topics)
    {
        return collect($topics)->map(function($topic){
           if( is_numeric($topic) ) {
               Topic::find($topic)->increment('questions_count');
               return (int) $topic;
           }
           $newTopic = Topic::create([
               'name' => $topic,
               'questions_count' => 1
           ]);
           return $newTopic->id;
        })->toArray();
    }
}