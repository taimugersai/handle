<?php

namespace App\Addon\AliyunSms;

use App\Models\Order;
use Auth;
use Illuminate\Support\Facades\Cache;

/**
 * 用户相关短信通知及验证
 * Class UserSms
 * @package App\Addon\AliyunSms
 */
class UserSms extends SendSms
{

    /**
     * 发送短信验证码
     * @param $mobile
     * @return bool|mixed|\SimpleXMLElement
     */
    public function sendVerifyCode($mobile)
    {
        $code = (string)rand(100000, 999999);
        Cache::put($mobile, $code, 2);      //验证码缓存1分钟
        return $this->sendTo($mobile, 'SMS_63455007', '一简租', compact('code'));
    }

    /**
     * 验证短信验证码
     * @param $mobile
     * @param $code
     * @return bool
     */
    public static function verifyCode($mobile, $code)
    {
        if (Cache::has($mobile)) {
            return !!(Cache::pull($mobile) == $code);
        }else {
            return false;
        }
    }
}