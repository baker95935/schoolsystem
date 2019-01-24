<?php
/**
 * Created by PhpStorm.
 * User: fangzheng
 * Date: 2018/1/29
 * Time: 下午7:22
 */

namespace Home\Controller;
use Think\Controller;

class TeacherController extends Controller
{

    public function index()
    {
        echo "teacher!!";
    }
    public function home()
    {
        $this->display();
    }

}
?>