<?php

return [

    /**
     * 调试模式[true-不发送短信]
     */
    'debug' => env('SMS_DEBUG', true),

    /**
     *  短信服务商，支持[aliyun-阿里云, qcloud-腾讯云]
     */
    'client' => env('SMS_CLIENT', 'aliyun'),

    /**
     * 腾讯云SecretId 或 阿里云 AccessKeyId
     */
    'accessKeyId' => env('SMS_ACCESS_KEY_ID', 'AccessKeyID'),

    /**
     * 腾讯云SecretKey 或 阿里云 AccessKeySecret
     */
    'accessKeySecret' => env('SMS_ACCESS_KEY_SECRET', 'AccessKeySecret'),

    /**
     * 腾讯云SDKAppID  阿里云不需要
     */
    'sdkAppId' => env('SMS_SDK_APPID', ''),

    /**
     * 签名内容
     */
    'signname' => env('SMS_SIGNNAME', '签名'),

    /**
     * 腾讯云 templateId[1234] 或 阿里云 TemplateCode[SMS_153055065]
     */
    'template' => [
        'captcha' => env('SMS_TEMPLATE_CAPTCHA', 'captchaTemplate'),
    ]
];
