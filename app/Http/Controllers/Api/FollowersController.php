<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class FollowersController extends Controller
{
    protected $user;

    /**
     * FollowersController constructor.
     * @param $user
     */
    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }


    /**
     * 该用户是否关注了这个用户
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function index($id)
    {
        return $this->user->UserIsFollow($id);
    }

    public function follow(Request $request)
    {
        return $this->user->follow($request);
    }
}
