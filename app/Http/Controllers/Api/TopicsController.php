<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TopicCollection;
use App\Repositories\TopicRepository;
use Illuminate\Http\Request;

/**
 * 话题
 * Class TopicsController
 * @package App\Http\Controllers
 */
class TopicsController extends Controller
{
    protected $topic;

    /**
     * TopicsController constructor.
     * @param $topic
     */
    public function __construct(TopicRepository $topic)
    {
        $this->topic = $topic;
    }

    /**
     * ajax获取话题标签
     * @param Request $request
     * @return TopicCollection
     */
    public function index(Request $request)
    {
        $topics = $this->topic->getTopicsForTagging($request);
        return new TopicCollection($topics);
    }

    /**
     * 创建话题,话题不存在,创建
     * @param $topics
     * @return TopicCollection
     */
    public function store(Request $request)
    {
        return $this->topic->normalizeTopic($request->all());
    }
}
