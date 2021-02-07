<?php
/**
 * 设置跨域
 * User: Administrator
 * Date: 2021/2/5
 * Time: 16:56
 */

header('Access-Control-Allow-Origin:*'); // *代表允许任何网址请求
header('Access-Control-Allow-Methods:POST,GET,OPTIONS'); // 允许请求的类型
header('Access-Control-Allow-Credentials: true'); // 设置是否允许发送 cookies
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');// 设置允许自定义请求头的字段

if($_SERVER['REQUEST_METHOD'] === 'OPTIONS'){
    $response = [
        'code'=>200
    ];
    die(json_encode($response,256));
}