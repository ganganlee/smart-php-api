<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/11/9
 * Time: 10:05
 */

//框架全局方法

function getControllerParam(){
    $pattern = '/index.php(\/[a-zA-Z]*)?(\/[a-zA-Z0-9]*)?/';
    preg_match($pattern, $_SERVER['DOCUMENT_URI'], $match);
    $controller     = '/';

    if(isset($match[1])){
        $controller = $match[1];
    }
    if(isset($match[2])){
        $controller .= $match[2];
    }

    return $controller;
}

/**
 * 获取restful参数
 * @return array|string
 */
function getController(){

    $controller = getControllerParam();

    if($controller == '/'){
        $controller = 'index/index';
    }

    $controller     = trim($controller,'/');

    //访问控制器
    $controller     = explode('/',$controller);
    if(count($controller) == 1){
        $controller[1] = 'index';
    }

    return $controller;
}

/**
 * 视图渲染
 * @param string $template
 * @param array $data
 * @version 1.0
 */
function view(array $data = [],string $template=''){

    if(empty($template)){
        global $controller;
        $template = $controller[0].'/'.$controller[1];
    }

    //将数组展开
    extract($data);

    //判断模板是否存在
    $path = ROOT.'/view/'.$template.'.php';
    if (!file_exists($path)){
        handlerErr('模板不存在');
    }

    include $path;
    exit();
}

/**
 * 通用错误处理
 * @param string $msg
 */
function handlerErr($msg = 'Undefined error'){
    echo $msg;
    exit();
}

/**
 * 解析，如果为json就返回数组，反之返回字符串
 * @param $v
 * @return mixed
 */
function encodeJson($v){

    $data = json_decode($v,true);
    if(is_array($data) && !empty($data)){
        return $data;
    }

    return $v;
}

/**
 * 获取http类型
 * @return string
 */
function getHttp()
{
    if ( isset($_SERVER['HTTP_ALI_SWIFT_USE_UPSTREAM_TPROXY']) && $_SERVER['HTTP_X_CLIENT_SCHEME'] === 'https' ) {
        return 'https://';
    } elseif ( !empty($_SERVER['HTTP_FRONT_END_HTTPS']) && strtolower($_SERVER['HTTP_FRONT_END_HTTPS']) !== 'off') {
        return 'https://';
    }
    return 'http://';
}

/**
 * 调试函数
 * @param $data
 */
function debug($data){

    echo '<pre>';
    print_r($data);
    exit();
}

/**
 * 获取client IP
 * @return mixed
 */
function ip()
{
    if(isset($_SERVER)){
        if(isset($_SERVER["HTTP_X_FORWARDED_FOR"])){
            $realIp = $_SERVER["HTTP_X_FORWARDED_FOR"];
        }elseif(isset($_SERVER["HTTP_CLIENT_IP"])) {
            $realIp = $_SERVER["HTTP_CLIENT_IP"];
        }else{
            $realIp = $_SERVER["REMOTE_ADDR"];
        }
    }else{
        //不允许就使用getenv获取
        if(getenv("HTTP_X_FORWARDED_FOR"))
        {
            $realIp = getenv( "HTTP_X_FORWARDED_FOR");
        }elseif(getenv("HTTP_CLIENT_IP")) {
            $realIp = getenv("HTTP_CLIENT_IP");
        }else{
            $realIp = getenv("REMOTE_ADDR");
        }
    }

    $ip 			= 	explode(",", $realIp);
    preg_match("/[a-zA-Z0-9.:]{7,40}/i", $ip[0], $matches);
    $t 				= 	$matches[0];
    if(!$t)
    {
        $ip[0] 		= 	$ip[1];
    }

    return $ip[0];
}