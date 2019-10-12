<?php


namespace XiaShuang\TouTiao\Common;


use XiaShuang\TouTiao\Exceptions\ApiRequestErrorException;
use XiaShuang\TouTiao\Exceptions\ApiRequestFailException;

trait Request
{
    private $apiUrl = 'https://developer.toutiao.com/api/';


    /**
     * @param $uri
     * @param array $data
     * @param string $method
     * @return Response
     * @throws ApiRequestErrorException
     * @throws ApiRequestFailException
     */
    public function request($uri, array $data, string $method = 'get')
    {
        $stream = stream_context_create([
            'https' => [
                'method' => strtoupper($method),
                'timeout' => 2,
                'content' => http_build_query($data),
            ],
        ]);
        $res = file_get_contents($this->apiUrl . $uri.'?'. http_build_query($data), false, $stream);
        return $this->handleData($res);
    }

    /**
     * @param $data
     * @throws ApiRequestErrorException
     * @throws ApiRequestFailException
     * @return  Response
     */
    private function handleData($data)
    {
        //接口请求失败
       if (!$data){
           throw new ApiRequestErrorException('api request error');
       }
       $data = json_decode($data,JSON_UNESCAPED_UNICODE);
       //接口返回错误
       if (isset($data['errcode'])  && $data['errcode'] > 0){
           throw new ApiRequestFailException($data['errmsg']);
       }
       return new Response((array)$data);
    }
}