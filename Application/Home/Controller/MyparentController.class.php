<?php
/**
 * Created by PhpStorm.
 * User: fangzheng
 * Date: 2018/1/29
 * Time: 下午7:24
 */

namespace Home\Controller;


use Think\Controller;

class MyParentController extends Controller
{
    public function index()
    {
        echo "myparent!!";
    }
    public function home()
    {
        $this->display();
    }
}
?>