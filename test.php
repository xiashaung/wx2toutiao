<?php

use XiaShuang\TouTiao\AccessToken\Client;

require 'vendor/autoload.php';

$redis = new \Redis();
$redis->connect('127.0.0.1');
$redis->auth('123456');
 $client = new Client([
     'app_id' => 'tt999def2006b760ff',
     'app_secret' => '46802201fcb1a1f9aa3042cf140a693923c785fb',
     'cache' => $redis
 ]);
$client->handle();
var_dump($client->getAccessToken());

