<?php


namespace XiaShuang\TouTiao;


use XiaShuang\TouTiao\Common\Request;

class BaseClient
{
     use Request{
         request as doRequest;
     }

     protected $config = [];

    /**
     * BaseClient constructor.
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->config = $config;
    }



}