<?php


namespace XiaShuang\TouTiao\User;


use XiaShuang\TouTiao\BaseClient;
use XiaShuang\TouTiao\Common\Response;
use XiaShuang\TouTiao\Exceptions\ApiRequestErrorException;
use XiaShuang\TouTiao\Exceptions\ApiRequestFailException;

class Session  extends BaseClient
{
    /**
     *
     * 通过小程序端的code获取用户的session_key
     *
     * @param $code
     * @param string $anonymous_code
     * @return Response
     * @throws ApiRequestErrorException
     * @throws ApiRequestFailException
     */
   public function get($code,$anonymous_code = '')
   {
       return  $this->doRequest('apps/jscode2session', [
           'appid' => $this->config['app_id'],
           'code' => $code,
           'anonymous_code' => $anonymous_code,
       ]);
   }

}