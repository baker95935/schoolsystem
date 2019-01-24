<?php
namespace Home\Controller;

use Think\Controller;

class AdminindexController extends Controller
{
    public function index()
    {
        if (IS_POST) {
            $username = $_POST['username'];
            $pwd = $_POST['pwd'];
            $model = M('user_data');
            $data = $model->where(array('username' => $username, 'pwd' => $pwd))->find();


            $status=$data[status];
            if($status!=100)
            {
                $this->display();
                return;
            }


            $id = $data[id];
            $realname = $data[realname];

            if ($data[id] > 0) {

//                $test_list01='test_list01/id/'.$id.'/username/'.$username.'/realname/'.$realname;
//                session('srcframe',$test_list01);
//                session('usermsg', array('username' => $username, 'realname' => $realname, 'id' => $id));

                $systemset=$_POST['systemset'];

                echo $systemset;


                if($systemset=='system')
                {

                $this->redirect('Systemset/systemset_01','', 0, '页面跳转中...');
                }
                else
                {

                $this->redirect('Testpanel/test_list01','', 0, '页面跳转中...');
                }


            }
        }
        else{
            $username=$_POST['username'];
            $pwd=$_POST['pwd'];
            $model=M('user_data');
            $data=$model->where(array('username'=>$username,'pwd'=>$pwd))->find();

            $status=$data[status];

            if($status!=100)
            {
                $this->display();
                return;
            }
//            $id=$data[id];
//            $realname=$data[realname];
//            $test_list01='test_list01/id/'.$id.'/username/'.$username.'/realname/'.$realname;

            if($data[id]>0)
            {
//                echo $test_list01;
//                session('srcframe',$test_list01);
//                session('usermsg',array('username' => $username,'realname'=>$realname,'id'=>$id));
                $this->redirect('Testpanel/test_list01','', 0, '页面跳转中...');
            }
    }

     $this->display();

    }



}