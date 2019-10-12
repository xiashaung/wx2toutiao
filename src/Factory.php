<?php


namespace XiaShuang\TouTiao;


class Factory
{
     protected $providers = [
         'token' => "XiaShuang\TouTiao\AccessToken\Client",
         'session' => "XiaShuang\TouTiao\User\Session",
         'qrcode' => "XiaShuang\TouTiao\Qrcode\Qrcode",
     ];

     protected $cache = [];

     protected $config = [];

    /**
     * Factory constructor.
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        $this->config = $config;
    }

    public function __get($name)
    {
        if (!isset($this->providers[$name])){
            throw new \Exception(sprintf("%s not support by this sdk"));
        }
        $class = $this->providers[$name];
        $object = new $class($this->config);
        if (is_callable($object,'handle')){
            $object->handle();
        }
        return $object;
    }


}