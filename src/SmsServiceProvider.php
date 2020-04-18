<?php

namespace Seffeng\LaravelSms;

use Illuminate\Foundation\Application as LaravelApplication;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Seffeng\Sms\Exceptions\SmsException;

class SmsServiceProvider extends BaseServiceProvider
{
    /**
     *
     * {@inheritDoc}
     * @see \Illuminate\Support\ServiceProvider::register()
     */
    public function register()
    {
        $this->registerAliases();

        $this->app->singleton('seffeng.laravel.sms', function ($app) {
            $config = $app['config']->get('sms');

            if ($config && is_array($config)) {
                return new Sms($config);
            } else {
                throw new SmsException('Please execute the command `php artisan vendor:publish --provider="Seffeng\LaravelSms\SmsServiceProvider"` first to  generate sms configuration file.');
            }
        });
    }

    /**
     *
     * @author zxf
     * @date    2020年4月17日
     */
    public function boot()
    {
        if ($this->app->runningInConsole() && $this->app instanceof LaravelApplication) {
            $this->publishes([$this->configPath() => config_path('sms.php')]);
        }
    }

    /**
     *
     * @author zxf
     * @date    2020年4月18日
     */
    protected function registerAliases()
    {
        $this->app->alias('seffeng.laravel.sms', Sms::class);
    }

    /**
     *
     * @author zxf
     * @date    2020年4月17日
     * @return string
     */
    protected function configPath()
    {
        return dirname(__DIR__) . '/config/sms.php';
    }
}
