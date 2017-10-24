<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 话题模型
 * Class Topic
 * @package App\Models
 */
class Topic extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name', 'questions_count', 'bio'];

    /**
     * 表topic跟question表多对多关联
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function questions()
    {
        return $this->belongsToMany(Question::class)->withTimestamps();
    }
}
