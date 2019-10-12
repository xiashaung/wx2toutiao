<?php


namespace XiaShuang\TouTiao\AccessToken;


use XiaShuang\TouTiao\BaseClient;
use XiaShuang\TouTiao\Exceptions\ApiRequestErrorException;
use XiaShuang\TouTiao\Exceptions\ApiRequestFailException;

/**
 * 获取access_token;
 *
 * Class Client
 * @package XiaShuang\TouTiao\AccessToken
 */
class Client extends  BaseClient
{
     protected $token;

     protected $cacheKey = '';

     protected $accessToken = '';

     public function handle()
     {
        $this->cacheKey = $this->generalCacheKey();
        $token = $this->getCacheToken();
        if (!$token){
            $token = $this->requestToken();
        }
        $this->accessToken = $token;
        return $token;
     }

    /**
     * @return mixed
     * @throws ApiRequestErrorException
     * @throws ApiRequestFailException
     */
     protected function requestToken()
     {
         $response = $this->doRequest('apps/token',[
             'appid' => $this->config['app_id'],
             'secret' => $this->config['app_secret'],
             'grant_type' => 'client_credential',
         ]);
         $this->cacheToken($response->access_token,$response->expires_in);
         return $response->access_token;
     }

    /**
     * 缓存token
     *
     * @param $token
     * @param int $expireTime
     */
     protected function cacheToken($token,int $expireTime)
     {
         if (isset($this->config['cache'])){
             $this->config['cache']->set($this->cacheKey ,$token, $expireTime);
         }
     }

    /**
     * 获取被缓存的token
     *
     * @return |null
     */
    public function getCacheToken()
    {
        if (isset($this->config['cache'])) {
           return  $this->config['cache']->get($this->cacheKey);
        }
        return null;
     }

    /**
     * 生成缓存的key
     * @return string
     */
     protected function generalCacheKey()
     {
         return md5($this->config['app_id'].$this->config['app_secret'].'toutiao_access_token');
     }

    /**
     * @return string
     */
    public function getAccessToken(): ?string
    {
        return $this->accessToken;
    }
}
