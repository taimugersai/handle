<?php
namespace App\Addon\AliyunSms;

use AliyunMNS\Client;
use AliyunMNS\Exception\MnsException;
use AliyunMNS\Model\BatchSmsAttributes;
use AliyunMNS\Model\MessageAttributes;
use AliyunMNS\Requests\PublishMessageRequest;

class SendSms
{
    public function sendTo($mobile, $template, $sign_name, array $data)
    {
        $client =new Client(config('services.aliyunsms.endPoint'), config('services.aliyunsms.key'), config('services.aliyunsms.secret'));
        $topic = $client->getTopicRef(config('services.aliyunsms.topic'));
        $batchSmsAttributes = new BatchSmsAttributes($sign_name, $template);
        $batchSmsAttributes->addReceiver($mobile, $data);
        $messageAttributes = new MessageAttributes(array($batchSmsAttributes));
        $messageBody = "smsmessage";
        $request = new PublishMessageRequest($messageBody, $messageAttributes);
        try {
            //    ['Model'=>'', 'RequestId'=>'']
            $res = $topic->publishMessage($request);
            if($res->isSucceed() == 1&&$res->getStatusCode()=='201') {
                return ['error'=>0, 'message'=>'短信发送成功'];
            }else {
                return ['error'=>1, 'message'=>'短信发送失败'];
            }
        } catch (MnsException $e) {
            return ['error' => $e->getCode(), 'message' => $e->getMessage()];
        }
    }
}