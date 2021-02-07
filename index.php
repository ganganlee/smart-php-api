<?php

include_once './core/crossDomain.php';//设置跨域
include_once './core/constant.php';//设置系统常量

// 引入配置文件
include_once ROOT . '/App/config/config.php';

//注册全局方法
include_once ROOT . '/App/common/public.php';

//引入日志处理文件
include_once ROOT . '/App/common/log.php';

//引入api响应函数
include_once ROOT."/App/common/response.php";

//定义网站主域
define("HTTP_HOST",getHttp().$_SERVER["HTTP_HOST"]);

//引入自动加载类
require ROOT.'/vendor/autoload.php';

//开启session
session_start();

//接管全局路由,设计restful风格路由
$controller     = getController();

$operationObj   = $controller[0].'Controller';
$method         = $controller[1];

//判断控制器是否存在
$path           = ROOT."/App/controller/{$operationObj}.php";

//判断方法是否存在
if(!file_exists($path)){
    ResponseError('控制器不存在');
    exit();
}

//引入控制器
include_once $path;

//判断方法是否存在
$operationObj = "\App\controller\\".$operationObj;

$APP = new $operationObj();
if(!method_exists($APP,$method)){
    ResponseError('控制器方法不存在');
    exit();
}

//程序入口
$APP -> $method();