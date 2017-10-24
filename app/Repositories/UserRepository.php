<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/20 0020
 * Time: 下午 9:49
 */

namespace App\Repositories;


use App\Notifications\NewUserFollowNotification;
use App\User;

use Illuminate\Support\Facades\Auth;

class UserRepository
{
    /**
     * 该用户是否关注了这个用户
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function UserIsFollow($id)
    {

        $followers = $this->byId($id)->followers()->pluck('follower_id')->toArray();
        if (in_array(user('api')->id, $followers)) {
            return response()->json(['followed' => true]);
        }
        return response()->json(['followed' => false]);
    }

    public function follow($res)
    {
        $userToFollow = $this->byId($res->get('user'));
        $followed = user('api')->followThisUser($userToFollow);
        if (count($followed['attached']) > 0) {
            //发送私信
            $userToFollow->notify(new NewUserFollowNotification());

            $userToFollow->increment('followers_count');
            //user('api')->increment('followings_count');
            return response()->json(['followed' => true]);
        }

        $userToFollow->decrement('followers_count');
        //user('api')->decrement('followings_count');
        return response()->json(['followed' => false]);
    }

    public function byId($id)
    {
        return User::find($id);
    }

    public function getUsersCount()
    {
        return User::get()->count();
    }
}