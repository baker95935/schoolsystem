<?php
namespace Home\Controller;
use Think\Controller;
use Think\Image;
//use vendor\crop;

class IndexController extends Controller
{
    public function index()
    {

        //$model->select();

        if(IS_POST)
            {
                $username=$_POST['username'];
                $pwd=$_POST['pwd'];
                $model=M('user_data');
                $data=$model->where(array('username'=>$username,'pwd'=>$pwd,'kind'=>'1'))->find();
                $id=$data[id];
                $realname=$data[realname];
                if($data[id]>0)
                {
                    session('usermsg',array('username' => $username,'realname'=>$realname,'id'=>$id));
                    cookie('username',$username,60*60*24*7);
                    cookie('pwd',$pwd,60*60*24*7);
                  // echo $data[status];
                  switch ($data[status])
                    {
                      case 0:
                          $this->redirect('Student/home',array('username' => $username,'realname'=>$realname,'userid'=>$id), 0, '页面跳转中...');
                      case 2:
                          $this->redirect('Headteacher/home',array('username' => $username,'realname'=>$realname,'userid'=>$id), 0, '页面跳转中...');
                      case 3:
                          $this->redirect('Teacher/home',array('username' => $username,'realname'=>$realname,'userid'=>$id), 0, '页面跳转中...');
                      case 1:
                          $this->redirect('Myparent/home',array('username' => $username,'realname'=>$realname,'userid'=>$id),0, '页面跳转中...');
                    }
                }
            }
            else{

                $username=$_GET['username'];
                $pwd=$_GET['pwd'];
                $model=M('user_data');
                $data=$model->where(array('username'=>$username,'pwd'=>$pwd,'kind'=>'1'))->find();
                $id=$data[id];
                $realname=$data[realname];
                if($data[id]>0)
                {
                    session('usermsg',array('username' => $username,'realname'=>$realname,'id'=>$id));
                    switch ($data[status])
                    {
                        case 0:
                            $this->redirect('Student/home',array('username' => $username,'realname'=>$realname,'userid'=>$id), 0, '页面跳转中...');
                        case 2:
                            $this->redirect('Headteacher/home',array('username' => $username,'realname'=>$realname,'userid'=>$id), 0, '页面跳转中...');
                           // $this->redirect('HeadTeacher/home','', 0, '页面跳转中...');
                        case 3:
                            $this->redirect('Teacher/home',array('username' => $username,'realname'=>$realname,'userid'=>$id), 0, '页面跳转中...');
                        case 1:
                            $this->redirect('Myparent/home',array('username' => $username,'realname'=>$realname,'userid'=>$id), 0, '页面跳转中...');
                    }
                }

            }
         $cookieusername=$cookiepwd='';
         $cookieusername=cookie('username');
         $cookiepwd=cookie('pwd');
         $this->assign('cookieusername',$cookieusername);
          $this->assign('cookiepwd',$cookiepwd);
        $this->display();

    }

    public function registermsg()
    {
        $data="";
        $imgsrc="";
        $area=M('school_data')->select();
        $this->assign('area',$area);

        $subjectmsg=M('subject_data')->select();
        $this->assign('subjectmsgn',$subjectmsg);

        $this->display();
    }

    public function addmsg()
    {
        $username=$_POST[input_name];
        $pwd=$_POST[pwd];
        $pwd1=$_POST[pwd1];
        $status=$_POST[status];
        // echo $status;
        $schoolmsg=$_POST[schoolmsg];
        $classmsg=$_POST[classmsg];
        $subject=$_POST[subject];
        $checkboxmsg = array();

        $checkboxmsg=$_POST[class1];
        $arraymsg=implode(",",$checkboxmsg);
        $realname=$_POST[realname];

        $datetime = new \DateTime;

        $data["imgsrc"] = 1;
        $data["pwd"] = 1;
        $data["realname"] =1;
        $data["regtime"] = $datetime->format('Y-m-d H:i:s');
        $data["schoolid"] =1;
        $data["status"] =1;
        $data["username"] = 1;

        $model = M("user_data");
       echo $model->add($data);

    }




    public function test()
    {
        echo "hello";
    }


    public function justsub()
    {
       // header('Content-Type:text/json');
        $username=$_POST[username];
      //  $classmsg=M('user_data')->where('username='.$username)->select();

        $ret = M('user_data')->where('username='.$username)->field('pwd')->find();

        if($ret!="")
        {

            echo 0;

        }
        else
        {
            echo 1;
        }

       // $this->ajaxReturn($classmsg);
      // echo $ret;
    }



    public function crop() {

       // print_r($_FILES[avatar_file]);
        $data=$_POST[avatar_data];
        $data="";
        //print_r($_POST[avatar_data]);
        echo"<hr>";

        $model=$_POST[avatar_data];
        $data=json_decode($model);
        $degrees=$data->rotate;
        //$data = json_decode($_POST[avatar_data], true);
        //print_r($data-> rotate);

        //echo $degrees;
        //echo"<hr>";
        //  print_r($model);

        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     3145728 ;// 设置附件上传大小
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath  =      './uploads/temp/'; // 设置附件上传根目录
        $info=$upload->uploadOne($_FILES['avatar_file']);
        $src='./uploads/temp/'.$info['savepath'].$info['savename'];




        //echo $src;
        //$src_img = imagecreatefromjpeg($src);

        //$new_img = imagerotate($src_img, -$degrees, imagecolorallocatealpha($src_img, 0, 0, 0, 127) );

        //imagepng($new_img,'./uploads/2018-02-14/thumb1.png');



      // $croped=imagecreatetruecolor($data->height+1,$data->height+1);


       // imagecolorallocatealpha($croped, 0, 0, 0, 127);

        //imagecopyresampled ($croped,$new_img , 0,0, $data->x ,$data->y, 192 , 192 ,$data->width, $data->height); //原图包含新图

       // echo "当前文件宽度".imagesx($new_img)."<hr>";
        //echo "当前文件高度".imagesy($new_img);

     //  imagecopyresampled ($croped,$new_img ,-$data->x,-$data->y, 0 ,0,$data->height+1, $data->height+1 ,imagesx($new_img), imagesx($new_img));



      /*
        $dst_image：新建的图片
        $src_image：需要载入的图片
        $dst_x：设定需要载入的图片在新图中的x坐标
        $dst_y：设定需要载入的图片在新图中的y坐标
        $src_x：设定载入图片要载入的区域x坐标
        $src_y：设定载入图片要载入的区域y坐标
        $dst_w：设定载入的原图的宽度（在此设置缩放）
        $dst_h：设定载入的原图的高度（在此设置缩放）
        $src_w：原图要载入的宽度
        $src_h：原图要载入的高度
      */

      //  imagepng($croped,'./uploads/2018-02-14/thumb2.png');

        //imagedestroy($src_img);
        //$src_img = $new_img;

       //imagepng($new_img,'./uploads/2018-02-14/thumb15a1.png');



//        if($info) {
//            echo "success";
//            echo "<hr>";
//            echo './uploads/temp/'.$info['savepath'].$info['savename'];
//        }
//        else{
//            echo "question";
//        }

        //redirect("registermsg.html");
       // echo $_POST[avatarInput];
//         vendor("crop");

//        $crop = new \CropAvatar($_POST['avatar_src'],$data, $_FILES['avatar_file']);
//        $response = array(
//          'state' => 200,
//          'message' => $crop->getMsg(),
//          'result' => $crop->getResult()
//         );
//
//      echo json_encode($response);
    }


    public function schoolandclass()
    {
        $ParentId=I('post.ParentId');
        $classmsg=M('class_data')->where('school_id='.$ParentId)->select();
        $classdata['data']=$classmsg;

       // $this->redirect("http://www.baidu.com");

        $this->ajaxReturn($classdata);
    }


    public function imagesub(){
        $img = new Image();
        $img->load('./public/testpic/bg.jpg')
            //->width(200)	//设置生成图片的宽度，高度将按照宽度等比例缩放
            //->height(200)	//设置生成图片的高度，宽度将按照高度等比例缩放
            ->size(300, 300)	//设置生成图片的宽度和高度
            ->fixed_given_size(true)	//生成的图片是否以给定的宽度和高度为准
            ->keep_ratio(true)		//是否保持原图片的原比例
            ->bgcolor("#ffffff")	//设置背景颜色，按照rgb格式
            ->rotate(20)	//指定旋转的角度
            ->quality(50)	//设置生成图片的质量 0-100，如果生成的图片格式为png格式，数字越大，压缩越大，如果是其他格式，如jpg，gif，数组越小，压缩越大
            ->save('./public/testpic/bg12.jpg');	//保存生成图片的路径
    }
  
  
  
      public function registeruser()
    {
        
        $username = $_POST[username];
        $pwd = $_POST[pwd];
        $status = $_POST[status];
        $schoolid = $_POST[schoolmsg];
        $classid = $_POST[classmsg];
        $subjectid = $_POST[subjectmsg];
        $classes = $_POST[classes];
        $realname = $_POST[realname];


        //判断是否是重名

        $user_model = M("user_data");

        //判断是否已经存在用户名
        $user_arr['username']=$username;
            $id = $user_model->where($user_arr)->find();
            $id=sizeof($id);

            if ($id > 0) {
                echo 1;
            } else {
//                //进行userdata插入
//
//                // `username`, `realname`, `pwd`, `status`, `schoolid`, `regtime`, `imgsrc`, `kind`
//
                if ($status == 0 || $status == 3)//学生及家长
                {
                    $datetime = new \DateTime;
                    $data["username"] = $username;
                    $data["realname"] = $realname;
                    $data["pwd"] = $pwd;
                    $data["status"] = $status;
                    $data["schoolid"] = $schoolid;
                    $data["regtime"] = $datetime->format('Y-m-d H:i:s');
                    $data["imgsrc"] = '';
                    $data["kind"] = 0;
                    $id = $user_model->add($data);

                    $model_user_studentparent_addation = M("user_studentparent_addation_data");
                    $data_stu_add["userid"] = $id;
                    $data_stu_add["classid"] = $classid;
                    $data_stu_add["groupid"] = 3;
                    $data_stu_add["enrollmenyear"] ='2000';
                    $data_stu_add["childid"] = 0;
                    $model_user_studentparent_addation->add($data_stu_add);

                    echo 100;
                  //  `userid`, `classid`, `groupid`, `enrollmenyear`, `childid`
                }
                else {
                    $datetime = new \DateTime;
                    $data["username"] = $username;
                    $data["realname"] = $realname;
                    $data["pwd"] = $pwd;
                    $data["status"] = $status;
                    $data["schoolid"] = $schoolid;
                    $data["regtime"] = $datetime->format('Y-m-d H:i:s');
                    $data["imgsrc"] = '';
                    $data["kind"] = 1;
                    $id = $user_model->add($data);

                    $model_user_teacher_addation_data = M("user_teacher_addation_data");

                    // `userid`, `classid`, `subjectid`, `classarray
                    $data_tec_add["userid"] = $id;
                    $data_tec_add["classid"] = $classid;
                    $data_tec_add["subjectid"] = $subjectid;
                    $data_tec_add["classarray"] = $classes;
                    $model_user_teacher_addation_data->add($data_tec_add);

                    echo 101;
                }


            }
    }
  
  
}