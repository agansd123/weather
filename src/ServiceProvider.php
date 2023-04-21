<?php


namespace Wwb\Weather;


class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * 标记着提供器是延迟加载的
     * 调用时才会加载
     * @var bool
     */

    protected $defer = true;

    /**
     * 注册服务提供者
     *
     * @return void
     */
    public function register(){
        $this->app->singleton(Weather::class,function (){
            return new Weather(config('services.weather.key'));
        });
        $this->app->alias(Weather::class,'weather');
    }

    /**
     * 取得提供者提供的服务
     *
     * @return array
     */
    public function provides()
    {
        return [Weather::class, 'weather'];
    }
}