<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class Question extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->body,
            'userId' => $this->user_id,
            'topics' => new TopicCollection($this->topics)
        ];
    }

    public function with($request)
    {
        return [
            'code' => 0,
            'mssage' => 'sussecc',
        ];
    }
}
