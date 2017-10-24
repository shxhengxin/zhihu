<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\EmailRepository;

class EmailController extends Controller
{
    /**
     * @var EmailRepository
     */
    protected  $email;

    /**
     * EmailController constructor.
     * @param $email
     */
    public function __construct(EmailRepository $email)
    {
        $this->email = $email;
    }

    /**
     * 邮箱验证
     * @param $token
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function verify($token)
    {

        $this->email->verify($token);
        flash('邮箱验证成功')->success();
        return redirect('/home');
    }
}
