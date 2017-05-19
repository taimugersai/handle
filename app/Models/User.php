<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Mail;
use Naux\Mail\SendCloudTemplate;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable,HasApiTokens;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'avatar', 'activation_token', 'activated'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * 发送重置密码链接到邮箱
     *
     * @param string $token
     */
    public function sendPasswordResetNotification($token)
    {
        // 模板变量
        $bind_data = ['url' => url('password/reset', $token)];
        $template = new SendCloudTemplate('reset_password_template', $bind_data);
        Mail::raw($template, function ($message) {
            $message->from('fnf_1993@163.com', config('app.name'));
            $message->to($this->email);
        });
    }
}
