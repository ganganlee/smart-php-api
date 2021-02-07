<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2021/2/7
 * Time: 10:20
 */

namespace App\model;

use PDO;
class help extends basic
{
    public function all()
    {
        $SQL = 'SELECT * FROM `hdk_helper`';
        $result = $this -> conn -> prepare($SQL);
        $result -> execute();

        return $result -> fetchAll(PDO::FETCH_ASSOC);
    }
}