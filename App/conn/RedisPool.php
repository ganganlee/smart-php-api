<?php
namespace App\conn;

/**
 * redis 连接池
 */

use Redis;
class RedisPool
{
    private static $connections = array(); //定义一个对象池
    private static $servers = array(); //定义redis配置文件
    private static $alias;
    private static $db;

    /**
     * @param $conf
     */
    private static function addServer($conf) //定义添加redis配置方法
    {
        foreach ($conf as $alias => $data){
            self::$servers[$alias]=$data;
        }
    }

    /**
     * 获取连接池对象
     * @param string $alias
     * @param int $db
     * @return RedisPool
     */
    public static function initRedis($alias='',$db=0)
    {
        //如果没有使用别名，默认使用本地配置
        if(empty($alias)){
            $alias = 'local';
        }

        self::$alias    = $alias;
        self::$db       = $db;

        global $config;
        $redisConfig = $config['redis'];

        //判断配置是否存在
        if(empty($redisConfig[$alias])){
            exit("redis 配置不存在");
        }

        self::addServer($redisConfig[$alias]);

        if(!array_key_exists(self::$alias,self::$connections)){  //判断连接池中是否存在
            $redis  = new Redis();

            $redis -> connect(self::$servers['host'],self::$servers['port']);

            self::$connections[$alias]=$redis;



            //判断是否需要密码
            if(isset(self::$servers['password']) && self::$servers['password']!=""){
                self::$connections[$alias]->auth(self::$servers['password']);
            }
        }

        self::$connections[$alias]->select($db);

        return new RedisPool();
    }

    /**
     * 获取缓存
     * @param $key
     * @return mixed
     */
    public function get($key)
    {
        $redis  = self::$connections[self::$alias];
        $val    = $redis -> get($key);
        if(self::$alias === 'rds'){
            return unserialize($val);
        }
        return $val;
    }

    /**
     * 设置缓存
     * @param $key
     * @param string $val
     * @param int $expire
     * @return bool
     */
    public function set($key,$val='',$expire=0)
    {
        //当key不存在时，直接返回
        if(empty($key)){
            return false;
        }

        //设置默认过期时间
        if($expire < 1){
            $expire = 30*24*60*60;
        }

        //获取redis实例
        $redis  = self::$connections[self::$alias];

        //判断当值不存在时，直接删除缓存
        if(empty($val)){
            return $redis -> del($key);
        }

        //容错，防止传入数组
        if(is_array($val)){
            $val = json_encode($val,256);
        }

        return $redis -> setex($key,$expire,$val);
    }
}