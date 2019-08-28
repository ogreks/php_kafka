<?php
/**
 * Created By.
 * @describe:
 * @author:Higanbana
 * @Date:2019/8/27
 * @Time:16:49
 */
namespace Kafka\Sms;

use Qcloud\Sms\SmsSingleSender;
use Qcloud\Sms\SmsMultiSender;
use Qcloud\Sms\SmsVoiceVerifyCodeSender;
use Qcloud\Sms\SmsVoicePromptSender;
use Qcloud\Sms\SmsStatusPuller;
use Qcloud\Sms\SmsMobileStatusPuller;
use Qcloud\Sms\VoiceFileUploader;
use Qcloud\Sms\FileVoiceSender;
use Qcloud\Sms\TtsVoiceSender;

class SmsendTx
{
    public $phone = [];

    /**
     * 发送单条短信
     */
    private function SendSingleMessage()
    {

    }

}