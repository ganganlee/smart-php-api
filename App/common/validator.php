<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/11/13
 * Time: 10:56
 */

//公共验证函数库

/**
 * 参数验证入口
 * @param array $validates
 * @param array $tag
 * @param array $data
 * @return bool|string
 */
function validate(array $validates,array $tag,array $data){

    foreach ($validates as $index => $validate){

        //判断是否必须
        if(in_array('required',$validate)){
            if(empty($data[$index])){
                return putErr("不能为空",$index,$tag);
            }
        }

        //验证字符串类型
        if(in_array('string',$validate)){
            if(!is_string($data[$index]) && !empty($data[$index])){
                return putErr("期待字符串类型",$index,$tag);
            }
        }

        //验证int类型
        if(in_array('int',$validate)){
            if(!is_numeric($data[$index])){
                return putErr("期待整型",$index,$tag);
            }
        }

        //长度验证
        foreach ($validate as $item){
            //验证最大长度
            if(stripos($item,'maxLen') !== false){
                $rule = explode("=",$item);
                if(mb_strlen($data[$index]) > $rule[1]){
                    return putErr("长度不能大于{$rule[1]}个字符",$index,$tag);
                }
            }

            //验证最小长度
            if(stripos($item,'minLen') !== false){
                $rule = explode("=",$item);
                if(mb_strlen($data[$index]) < $rule[1]){
                    return putErr("长度不能小于{$rule[1]}个字符",$index,$tag);
                }
            }

            //最大值
            if(stripos($item,'max=') !== false){
                $rule   = explode("=",$item);
                $max    = (int)$rule[1];
                $tmp    = (int)$data[$index];
                if($tmp > $max){
                    return putErr("值不能大于{$max}",$index,$tag);
                }
            }

            //最小值
            if(stripos($item,'min=') !== false){
                $rule   = explode("=",$item);
                $min    = (int)$rule[1];
                $tmp    = (int)$data[$index];
                if($tmp < $min){
                    return putErr("值不能小于{$min}",$index,$tag);
                }
            }
        }

        //验证是否为数组
        if(in_array('array',$validate)){
            if(!is_array($data[$index]) || empty($data[$index])){
                return putErr("期待数组",$index,$tag);
            }
        }

        //验证float
        if(in_array('float',$validate)){
            if(!is_float($index)){
                return putErr("期待浮点型",$index,$tag);
            }
        }

        //验证url
        if(in_array('url',$validate)){
            if($data[$index] && !isURL($data[$index])){
                return putErr("期待url",$index,$tag);
            }
        }
    }

    return false;
}

/**
 * 验证url
 * @param $url
 * @param string $match
 * @return bool|false|int
 */
function isURL($url,$match='/^(http:\/\/)?(https:\/\/)?([\w\d-]+\.)+[\w-]+(\/[\d\w-.\/?%&=]*)?$/')
{
    $v = strtolower(trim($url));
    if(empty($v)){
        return false;
    }

    return preg_match($match,$v);
}

/**
 * 输出错误
 * @param $msg
 * @param $name
 * @param $tag
 * @return string
 */
function putErr($msg,$name,$tag){
    if(array_key_exists($name,$tag)){
        return $tag[$name].$msg;
    }else{
        return $name.$msg;
    }
}