<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * @resource 邮箱相关
 *
 * Class EmailController
 * @package App\Http\Controllers
 */
class EmailController extends Controller
{
    /**
     * 邮箱验证
     *
     * @param $token
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function verify($token)
    {
        $user = User::where('activation_token', $token)->first();
        if(is_null($user)) {
            flash('邮箱验证失败！', 'warning');
            return redirect('/');
        }
        $user->activated = 1;
        $user->activation_token = str_random('40');
        $user->save();
        Auth::login($user);
        flash('邮箱验证成功！', 'success');
        return redirect('/');
    }
}
