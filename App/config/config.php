<?php
/**
 * 配置文件
 * User: Administrator
 * Date: 2020/11/7
 * Time: 15:29
 */
$config = [

    //数据库配置
    'db' => [
        'host'          => '127.0.0.1',
        'username'      => 'root',
        'password'      => '123456',
        'db'            => 'v2.hdk.net',
    ],

    //RDB数据库
    'rdb' => [
        'host'          => 'rm-.aliyuncs.com',
        'username'      => 'hdk_2021_net',
        'password'      => 'PEFeH2$A0pD$r#%wqKjie2021NPL',
        'db'            => 'hdk',
    ],

    'redis' => [
        //rds配置
        'rds' =>[
            'host'          => 'r-.aliyuncs.com',
            'port'          => 6379,
            'password'      => '',
        ],

        //本地配置
        'local'=>[
            'host'          => '127.0.0.1',
            'port'          => 6379,
            'password'      => '',
        ]
    ],
];