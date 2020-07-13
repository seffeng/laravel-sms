<?php

namespace Seffeng\LaravelSms\Facades;

use Illuminate\Support\Facades\Facade;

/**
 *
 * @author zxf
 * @date    2020年4月18日
 * @method static \Seffeng\LaravelSms\Sms setTemplateParamsModel(TemplateParams $templateParamsModel)
 * @method static \Seffeng\LaravelSms\Sms setTemplateCode(string $templateCode)
 * @method static \Seffeng\LaravelSms\Sms loadClient(string $client)
 * @method static boolean send($phone, array $content)
 *
 * @see \Seffeng\LaravelSms\Sms
 */
class Sms extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'seffeng.laravel.sms';
    }
}
