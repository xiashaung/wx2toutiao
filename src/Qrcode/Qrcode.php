<?php


namespace XiaShuang\TouTiao\Qrcode;


use XiaShuang\TouTiao\AccessToken\Client;
use XiaShuang\TouTiao\BaseClient;
use XiaShuang\TouTiao\Common\Response;
use XiaShuang\TouTiao\Exceptions\ApiRequestErrorException;
use XiaShuang\TouTiao\Exceptions\ApiRequestFailException;

class Qrcode  extends BaseClient
{
    /**
     * 获取小程序二维码
     *
     * @param $access_token
     * @param $appname
     * @param $path
     * @param int $with
     * @param string $line_color
     * @param string $background
     * @param bool $set_icon
     * @return Response
     * @throws ApiRequestErrorException
     * @throws ApiRequestFailException
     */
    public function  create($access_token,$appname,$path, $with = 430,$line_color = '{“r”:0,“g”:0,“b”:0}',$background = '',bool $set_icon = false)
    {
        $response = $this->doRequest('apps/qrcode',func_get_args(),'post');
        return $response;
    }
}