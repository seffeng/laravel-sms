<?php  declare(strict_types=1);

namespace Seffeng\LaravelSms;

use PHPUnit\Framework\TestCase;
use Seffeng\Sms\Exceptions\SmsException;

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
            var_dump('sms-test-send');
        } catch (SmsException $e) {
            throw $e;
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
