<?php


namespace Wwb\Weather;


use GuzzleHttp\Client;
use Wwb\Weather\Exceptions\HttpException;
use Wwb\Weather\Exceptions\InvalidArgumentException;

class Weather
{
    protected $key;
    protected $guzzleOptions = [];

    public function __construct($key)
    {
        $this->key = $key;
    }

    public function getWeather($city,$type = 'base',$format = 'json')
    {
        $url = 'https://restapi.amap.com/v3/weather/weatherInfo';

        $type = strtolower($type);
        $format = strtolower($format);

        if (!in_array($format,['xml','json'])){
            throw new InvalidArgumentException("Invalid response format: ".$format);
        }

        if (!in_array($type,['base', 'all'])){
            throw new InvalidArgumentException("Invalid type value(base/all): ".$type);
        }

        $query = array_filter([
            'key' => $this->key,
            'city' => $city,
            'output' => $format,
            'extensions' =>  $type,
        ]);

        try {
            $response = $this->getHttpClient()->get($url,[
                'query' => $query,
            ])->getBody()->getContents();

            return 'json' == $format ? json_decode($response,true) : $response;
        }catch (\Exception $exception){
            throw new HttpException($exception->getMessage(),$exception->getCode(),$exception);
        }

    }

    public function getHttpClient(): Client
    {
        return new Client($this->guzzleOptions);
    }

    public function setGuzzleOptions(array $options)
    {
        $this->guzzleOptions = $options;
    }
}