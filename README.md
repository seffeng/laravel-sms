## Laravel Sms

### 安装

```shell
# 暂时支持 阿里云 和 腾讯云 发送短信
$ composer require seffeng/laravel-sms

# 生成配置文件
$ php artisan vendor:publish --provider="Seffeng\LaravelSms\SmsServiceProvider"

# 修改配置文件 /config/sms.php 或 /.env，建议通过修改 .env 实现配置
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
            $service = Sms::setTemplateCode(config('sms.template.captcha'))->setTemplateParamsModel(new TemplateParams());
            $result = $service->send('13800138000', ['111111']);
            var_dump($result);
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



### 备注

暂不可用

