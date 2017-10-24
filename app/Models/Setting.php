<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $allowd = ['city','site','github','bio'];
    protected $user;

    /**
     * Setting constructor.
     * @param $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function merge(array $attributes)
    {

        $settings = array_merge($this->user->settings,array_only($attributes,$this->allowd));

        return $this->user->update(['settings'=>$settings]);
    }
}
