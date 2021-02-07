<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/11/11
 * Time: 17:08
 */

/**
 * 通用响应处理
 * @param string $msg
 * @param $data
 * @param int $code
 */
function ResponseSuccess($msg = 'ok',$data = [],$code = 200){

    //容错，防止忘记传入msg,直接传入数据
    if(is_array($msg)){
        $data   = $msg;
        $msg    = 'ok';
    }

    $response = [
        'code'      => $code,
        'msg'       => $msg,
        'result'    => $data,
        'time'      => date("Y-m-d H:i:s")
    ];
    exit(json_encode($response,256));
}

/**
 * 通用错误处理
 * @param string $msg
 * @param array $data
 * @param int $code
 */
function ResponseError($msg = 'error',$data=[],$code = 400){
    $response = [
        'code'      => $code,
        'msg'       => $msg,
        'result'    => $data,
        'time'      => date("Y-m-d H:i:s")
    ];
    exit(json_encode($response,256));
}