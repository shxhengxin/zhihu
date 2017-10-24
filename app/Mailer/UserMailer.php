<?php


namespace App\Mailer;

use App\User;
use Auth;
class UserMailer extends Mailer
{
    //新用户关注
    public function followNotifyEmail($email)
    {
        $data = [
            'url' => env('APP_URL'),
            'name'=> Auth::guard('api')->user()->name,
        ];

        $this->sendTo('zhihu_app_new_user_follow',$email,$data);
    }

    //密码重置
    public function passwordReset($email,$token)
    {
        $data = [
            'url' => url('password/reset', $token)
        ];

        $this->sendTo('zhihu_app_reset',$email,$data);
    }

    //用户注册
    public function welcome(User $user)
    {
        $data = [
            'url' => route('email.verify',['token'=>$user->confirmation_token]),
            'name'=>$user->name
        ];

        $this->sendTo('zhihu_app_register',$user->email,$data);
    }
}