<?php
namespace App\model;
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/11/16
 * Time: 16:31
 */

use App\conn\DbPool;
class basic
{
    protected $conn;

    /**
     * basic constructor.
     * @param string $bd
     */
    public function __construct($db = 'db')
    {
        try{
            $conn = new DbPool($db);
            $this -> conn   = $conn -> getConnection();
        }catch (\Exception $exception){
            putLog('获取数据库资源失败:'.$exception->getMessage(),'',LOG_ERR);
            exit();
        }
    }
}