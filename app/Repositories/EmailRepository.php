<?php
/**
 * 邮箱验证
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/17 0017
 * Time: 下午 9:57
 */

namespace App\Repositories;


use App\User;
use Illuminate\Support\Facades\Auth;

class EmailRepository
{
    public function verify($token)
    {

        $user = User::where('confirmation_token',$token)->first();

        if( is_null( $user ) ){
            flash('邮箱验证失败')->error();
            return redirect('/');
        }
        $data = ['is_active'=>1,'confirmation_token'=>str_random(40)];
        User::where('id',$user->id)->update($data);
        Auth::login($user);
    }
}