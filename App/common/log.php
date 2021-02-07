<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/11/13
 * Time: 15:41
 */

//定义错误日志级别
define("LOG_INFO", '正常日志');
define("LOG_ERR", '错误日志');
define("LOG_DEBUG", '调试日志');

/**
 * 日志处理常用方法
 * @param $file
 * @param $log
 * @param string $level
 */
function putLog($log, $file = '', $level = LOG_INFO)
{
    if (empty($file)) {
        $file = 'log.txt';
    }

    $data = [
        'level' => $level,
        'log' => $log,
        'date' => date("Y-m-d H:i:s")
    ];

    $path = ROOT.'/log/' . $file;

    file_put_contents($path, json_encode($data, 256) . PHP_EOL, FILE_APPEND);
}