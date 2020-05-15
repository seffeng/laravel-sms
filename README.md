## Laravel Sms

### 安装

```shell
# 1、暂时支持 阿里云 和 腾讯云 发送短信
$ composer require seffeng/laravel-sms
```

##### Laravel

```shell
# 1、生成配置文件
$ php artisan vendor:publish --provider="Seffeng\LaravelSms\SmsServiceProvider"

# 2、修改配置文件 /config/sms.php 或 /.env，建议通过修改 .env 实现配置，
SMS_DEBUG=true
SMS_APPID=
SMS_APPSECRET=
SMS_SIGNNAME=
SMS_TEMPLATE_CAPTCHA=
#/config/sms.php中添加其他模板
```

##### Lumen

```php
# 1、将以下代码段添加到 /bootstrap/app.php 文件中的 Providers 部分
$app->register(Seffeng\LaravelSms\SmsServiceProvider::class);

# 2、参考扩展包内 config/sms.php 在 .env 文件中添加配置
SMS_DEBUG=true
SMS_APPID=
SMS_APPSECRET=
SMS_SIGNNAME=
SMS_TEMPLATE_CAPTCHA=
#......
```

### 目录说明

```
├───config
│       sms.php
├───src
│   │   Sms.php
│   │   SmsServiceProvider.php
│   └───Facades
│           Sms.php
└───tests
        SmsTest.php
```

### 示例

```php
/**
 * 参考 tests/SmsTest.php
 */
use Seffeng\Sms\Exceptions\SmsException;
use Seffeng\LaravelSms\Facades\Sms;

class SiteController extends Controller
{
    public function send()
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
    
```

```php
/**
 * TemplateParams
 * @see Seffeng\Sms\Clients\Aliyun\TemplateParams
 */
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
```

## 项目依赖

| 依赖        | 仓库地址                       | 备注 |
| :---------- | :----------------------------- | :--- |
| seffeng/sms | https://github.com/seffeng/sms | 无   |

### 备注

1、测试脚本 tests/SmsTest.php 仅作为示例供参考。