<?php
namespace App\model;
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/11/18
 * Time: 18:19
 */
use PDO;
class cases extends basic{

    /**
     * 获取所有数据
     * @return mixed
     */
    public function all()
    {
        $sql = 'SELECT * FROM hdk_case';
        $result = $this -> conn -> prepare($sql);
        $result -> execute();

        return $result -> fetchAll(PDO::FETCH_ASSOC);
    }
}