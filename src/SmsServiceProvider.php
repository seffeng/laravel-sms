<?php

namespace Seffeng\LaravelSms;

use Illuminate\Foundation\Application as LaravelApplication;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class SmsServiceProvider extends BaseServiceProvider
{
    /**
     *
     * {@inheritDoc}
     * @see \Illuminate\Support\ServiceProvider::register()
     */
    public function register()
    {
        $this->mergeConfigFrom($this->configPath(), 'sms1');
    }

    /**
     *
     * @author zxf
     * @date    2020年4月17日
     */
    public function boot()
    {
        if ($this->app instanceof LaravelApplication && $this->app->runningInConsole()) {
            $this->publishes([$this->configPath() => config_path('sms.php')]);
        }
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
