<?php  declare(strict_types=1);

namespace Seffeng\LaravelSms\Tests;

use PHPUnit\Framework\TestCase;
use Seffeng\Sms\Exceptions\SmsException;
use Seffeng\LaravelSms\Facades\Sms;

class SmsTest extends TestCase
{
    /**
     *
     * @author zxf
     * @date    2020年4月17日
     * @throws SmsException
     * @throws \Exception
     */
    public function testSend()
    {
        try {
            // 腾讯云 templateId[1234] 或 阿里云 TemplateCode[SMS_153055065]
            $tempCode = config('sms.template.captcha');

            // 腾讯云 ['111111'] 或 阿里云 ['code' => '111111']
            // 阿里云 ['111111'] 可通过匹配 TemplateParams::fetchNameItems()  实现发送
            $content = ['111111'];

            // 相同内容可批量发送['13800138000', '13800138001']
            $phone = '13800138000';

            // 因阿里云与腾讯云的内容参数结构不一致，参考 $content；可通过 TemplateParams 实现以腾讯云结构发送
            $templateParamsModel = new TemplateParams();
            $service = Sms::setTemplateCode($tempCode)->setTemplateParamsModel($templateParamsModel);
            $result = $service->send($phone, $content);

            if ($result) {
                echo '发送成功！';
            } else {
                echo '发送失败！';
            }
        } catch (SmsException $e) {
            throw $e;
        } catch (\Exception $e) {
            throw $e;
        }
    }
}

class TemplateParams extends \Seffeng\Sms\Clients\Aliyun\TemplateParams
{
    /**
     * 重写模板对应参数
     * @return array
     */
    public static function fetchNameItems()
    {
        return [
            'SMS_153055065' => ['code'],
            'SMS_153055066' => ['code', 'address'],
        ];
    }
}