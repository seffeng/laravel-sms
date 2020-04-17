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
            // $service = Sms::setTemplateCode(config('sms.template.captcha'))->setTemplateParamsModel(new TemplateParams());
            // $result = $service->send('13800138000', ['111111']);
            // var_dump($result);
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