<?php

namespace Seffeng\LaravelSms;

use Seffeng\Sms\SmsClient;
use Seffeng\Sms\Helpers\ArrayHelper;
use Seffeng\Sms\Clients\Aliyun\TemplateParams;
use Seffeng\Sms\Exceptions\SmsException;

class Sms
{
    /**
     *
     * @var boolean
     */
    private $debug = true;

    /**
     *
     * @var string
     */
    private $client;

    /**
     *
     * @var string
     */
    private $accessKeyId;

    /**
     *
     * @var string
     */
    private $accessKeySecret;

    /**
     *
     * @var string
     */
    private $sdkAppId;

    /**
     *
     * @var string
     */
    private $signname;

    /**
     *
     * @var TemplateParams
     */
    private $templateParamsModel;

    /**
     *
     * @var string
     */
    private $templateCode;

    /**
     *
     * @author zxf
     * @date    2020年4月18日
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->debug = ArrayHelper::getValue($config, 'debug');
        $this->client = ArrayHelper::getValue($config, 'client');
        $this->accessKeyId = ArrayHelper::getValue($config, 'accessKeyId');
        $this->accessKeySecret = ArrayHelper::getValue($config, 'accessKeySecret');
        $this->sdkAppId = ArrayHelper::getValue($config, 'sdkAppId');
        var_dump($this->sdkAppId);exit;
        $this->signname = ArrayHelper::getValue($config, 'signname');

        if (is_null($this->client) || is_null($this->accessKeyId) || is_null($this->accessKeySecret) || is_null($this->signname))
        {
            throw new \RuntimeException('Warning: client, accesskeyid, accesskeysecret, signname cannot be empty.');
        }
    }

    /**
     *
     * @author zxf
     * @date    2020年4月18日
     * @param TemplateParams $templateParamsModel
     * @return \Seffeng\LaravelSms\Sms
     */
    public function setTemplateParamsModel(TemplateParams $templateParamsModel)
    {
        $this->templateParamsModel = $templateParamsModel;
        return $this;
    }

    /**
     *
     * @author zxf
     * @date    2020年4月18日
     * @param string|array $phone
     * @param array $content
     */
    public function send($phone, array $content)
    {
        try {
            if ($this->getIsDebug()) {
                return true;
            }
            $client = new SmsClient($this->accessKeyId, $this->accessKeySecret, $this->sdkAppId);
            return $client->setClient($this->client, $this->templateParamsModel)
                    ->setSignName($this->signname)
                    ->setTemplateCode($this->getTemplateCode())
                    ->send($phone, $content);
        } catch (SmsException $e) {
            throw $e;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     *
     * @author zxf
     * @date    2020年4月18日
     * @param  string $templateCode
     * @return \Seffeng\LaravelSms\Sms
     */
    public function setTemplateCode(string $templateCode)
    {
        $this->templateCode = $templateCode;
        return $this;
    }

    /**
     *
     * @author zxf
     * @date    2019年11月21日
     * @return string
     */
    public function getTemplateCode()
    {
        return $this->templateCode;
    }

    /**
     *
     * @author zxf
     * @date    2020年4月18日
     * @return boolean
     */
    public function getIsDebug()
    {
        return $this->debug;
    }
}
