<?php
namespace App\conn;
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/11/7
 * Time: 14:39
 */

/**
 * mysql连接池
 * Class DbPool
 */
class DbPool
{
    //连接池
    protected $dbConfig;
    private $db;
    private static $resource = [];
    public function __construct($db = 'db')
    {
        $this ->db = $db;
        global $config;
        $this->dbConfig = $config[$db];
    }

    /**
     * 获取连接
     * @return mixed
     * @throws ErrorException
     */
    public function getConnection()
    {
        $resource = self::$resource;
        $db = $this ->db;
        if(array_key_exists($db,$resource)){
            return $resource[$db];
        }

        $config = $this->dbConfig;
        $conn = new \PDO("mysql:host={$config['host']};dbname={$config['db']}", $config['username'], $config['password']);
        //开启持久连接
        //$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $resource[$this ->db] = $conn;
        self::$resource = $resource;
        return $conn;
    }
}