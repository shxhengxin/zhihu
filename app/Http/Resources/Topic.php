<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class Topic extends Resource
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
            'name' => $this->name,
        ];
    }

    public function with($request)
{
    return [
        'code' => 0,
        'message' => 'ok'
    ];
}
}
