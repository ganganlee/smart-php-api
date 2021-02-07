<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/12/7
 * Time: 16:36
 */

namespace App\controller;

use App\model\cases;
use App\model\help;

class indexController extends baseController
{
    public function index()
    {
        //获取数据
        ResponseSuccess();
    }

    public function test()
    {
        $model  = new cases();
        $list   = $model ->all();
        print_r($list);

        echo '<br>';
        echo '<br>';
        echo '<br>';

        $model = new help();
        $list = $model ->all();
        print_r($list);

        ResponseSuccess($list);
    }
}