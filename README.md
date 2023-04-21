## 天气查询

### 需求分析
- 按地名查询实时天气；
- 获取最近的天气预报。

### 功能设计
- **主要业务**，获取天气信息；
- **异常处理**，提供统一的异常类，方便调用方定位异常；
- **自定义参数**，需要支持自定义参数，比如超时时间等；
- **提供 Laravel Service Provider**，为 Laravel 框架提供专属封装的入口。

### Laravel 使用方法

1、在 config 目录下新建 services.php 配置文件，输入

```php
return [
     'weather' => [
        'key' => env('WEATHER_API_KEY'),
    ],
];
```

2、在env中配置参数
```env
WEATHER_API_KEY=xxxxxxxxxxxxxxxxx
```

3、使用
```php
app('weather')->getWeather('广州');
```