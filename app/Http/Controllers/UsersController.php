<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UsersController extends Controller
{
    //用户头像
    public function avatar()
    {
        return view('users.avatar');
    }

    public function changeAvatar(Request $request)
    {
        $file = $request->file('img');

        $filename = 'images/avatars/'.md5(time().user()->id).'.'.$file->getClientOriginalExtension();
        Storage::disk('qiniu')->writeStream($filename,fopen($file->getRealPath(),'r'));
        user()->avatar = 'http://'.config('filesystems.disks.qiniu.domain').'/'.$filename;
        //$filename = md5(time().user()->id).'.'.$file->getClientOriginalExtension();
        //$file->move(public_path('avatars'),$filename);
        //user()->avatar = '/avatars/'.$filename;
        user()->save();
        return ['url' => user()->avatar];
    }
}
