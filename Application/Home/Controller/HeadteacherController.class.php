<?php
/**
 * Created by PhpStorm.
 * User: fangzheng
 * Date: 2018/1/29
 * Time: 下午7:22
 */

namespace Home\Controller;
use Think\Controller;

class HeadTeacherController extends Controller
{

    public $usermsg;

    public function _initialize(){
        $this->usermsg=session('usermsg');
    }

    public function index()
    {

        echo "headteacher!!";
    }


    public function home()
    {
        $this->assign('realname', $_GET[realname]);
        $this->assign('username', $_GET[username]);
      	$this->assign('datemsg',date("Y-m-d"));
        $this->assign('userid', $_GET[userid]);
      
        $model = M('paper_msg_data');
        $array['userid']=$_GET[userid];
        $array['statusmsg']=array('in','1,2');
        $datacount=$model->where($array)->order('creat_time desc')->count();
      
        $this->assign('count',$datacount);
      
      
        $this->display();
    }

    public function setpage0101()
    {

        $this->assign('realname', $_GET[realname]);
        $this->assign('username', $_GET[username]);
        $this->assign('userid', $_GET[userid]);
        $id =$_GET[userid];
        if ($id > 0) {
            $model1 = M('user_data');
            $data1 = $model1->where('id='.$id)->find();
            $schoolid = $data1[schoolid];//找到学校idq
            $model2 = M('school_data');
            $data2 = $model2->where('school_id=' . $schoolid)->find();
            $levelnum = $data2[levelnum];//找到学校级别（小学，初中，高中）
            $model3 = M('user_teacher_addation_data');
            $data3 = $model3->where('userid=' . $id)->find();
            $subjectid = $data3[subjectid];//老师所教授的学科
            $model4 = M('subject_data');
            $data4 = $model4->where('id=' . $subjectid)->find();
            $this->assign('subjectid',$subjectid);
            $subjectmsg = $data4[subjectmsg];//老师所教授的学科
            $model5=M('grade_data');
            $data5=$model5->where('levelnum='.$levelnum)->select();//通过级别找到这个级别对应的年级，比如初中包含初一，初二，初三
            $i=1;
            $arraytest[0]['val']='all';//年级ID
            $arraytest[0]['msg']=$subjectmsg;//年级信息+学科信息
            foreach ($data5 as $key => $value) {
                $arraytest[$i]['val']=$value[id];//年级ID
                $arraytest[$i]['msg']=$value[grademsg].$subjectmsg;//年级信息+学科信息
                $i=$i+1;
            }

           $this->assign('data1',$arraytest);
        }
        $this->assign('subjectid',$subjectid);
      $this->display();
    }

   public function managestu_addkey0404()
   {
     //选中的习题
      $checktestid=$_POST['checktestid'];
     //习题类型id
      $checktestkind=$_POST['checktestkind'];
     //习题类型信息
      $checktestmsg=$_POST['checktestmsg'];
      $subject_id=$_POST['subject_id'];
      $subject_msg=$_POST['subject_msg'];
      $userid=$_POST['userid'];
      $username=$_POST['username'];
      $realname=$_POST['realname'];
      $stu_id=$_POST['stu_id'];
      $stu_name=$_POST['stu_name'];
     
     
       $this->assign('userid',$userid);
       $this->assign('username',$username);
       $this->assign('realname',$realname);
       $this->assign('subject_id',$subject_id);
       $this->assign('subject_msg',$subject_msg);
       $this->assign('stu_id',$stu_id);
       $this->assign('stu_name',$stu_name);
       $this->assign('checktestmsg',$checktestmsg);
       $this->assign('checktestkind',$checktestkind);
       $this->assign('checktestid',$checktestid);
     
     
     
      $model_mytest=M('mytest');
      $model_test_public_data=M('test_public_data');
      $model_img_cuted_data=M('img_cuted_data');
     
      $checktestid_arr=explode(',',$checktestid);
     
      $count=sizeof($checktestid_arr);
     
      $test_arr='';
     
      for($i=0;$i<$count;$i++)
      {
         $test_data=$model_mytest->where('testid='.$checktestid_arr[$i])->find();
         $test_arr=$test_arr.','.$test_data['ctbtestid'];
      }
      
     $testidarr=ltrim($test_arr, ",");
     $testidarr=explode(',',$testidarr);   
     $count=sizeof($testidarr);


        for($i=0;$i<$count;$i++)
        {
            $test_public_data=$model_test_public_data->where('id='.$testidarr[$i])->find();
            $srcid=$test_public_data[srcid];
            $img_cuted_data=$model_img_cuted_data->where('id='.$srcid)->find();
            $src=$img_cuted_data[src];

            $pic1id=$test_public_data[pic1];
            $img_cuted_data=$model_img_cuted_data->where('id='.$pic1id)->find();
            $pic1src=$img_cuted_data[src];

            $pic2id=$test_public_data[pic2];
            $img_cuted_data=$model_img_cuted_data->where('id='.$pic2id)->find();
            $pic2src=$img_cuted_data[src];

            $pic3id=$test_public_data[pic3];
            $img_cuted_data=$model_img_cuted_data->where('id='.$pic3id)->find();
            $pic3src=$img_cuted_data[src];

            $pic4id=$test_public_data[pic4];
            $img_cuted_data=$model_img_cuted_data->where('id='.$pic4id)->find();
            $pic4src=$img_cuted_data[src];

            $test[$i][title]=cuttitlemsg($test_public_data[inputval]);
            $test[$i][id]=$test_public_data[id];
          	$test[$i][typeid]=$test_public_data[typeid];
            $test[$i][src]=usersrc($src);
            $test[$i][tsernum]=$test_public_data[tsernum];
            $test[$i][ctbname]=$test_public_data[ctbname];
            $test[$i][filesernum]=$test_public_data[filesernum];
            $test[$i][pic1]=usersrc($pic1src);
            $test[$i][pic2]=usersrc($pic2src);
            $test[$i][pic3]=usersrc($pic3src);
            $test[$i][pic4]=usersrc($pic4src);

            $sum=0;
            if($pic1src!='')
            {
                $sum=$sum+1;
            }
            if($pic2src!='')
            {
                $sum=$sum+1;
            }
            if($pic3src!='')
            {
                $sum=$sum+1;
            }
            if($pic4src!='')
            {
                $sum=$sum+1;
            }

            $test[$i][sum]=$sum;

            if($sum!=0)
            {
                //$test[$i][picnote]='题 '.str_replace(array("\r\n", "\r", "\n",".","&nbps;"), '',$test[$i]['newtitle']).'图';
                $test[$i][picnote]='';
            }
            else
            {
                $test[$i][picnote]='';
            }
        }


        $mycount=count($test);
        $tsernum=0;
        $m=0;
        $no1=1;
        $no2=1;


        for($j=0;$j<$mycount;$j++)
        {

            if($test[$j][tsernum]!=$tsernum && $test[$j][tsernum]!='0')//为第一个A的标题
            {
                $no2=1;
                $testarr['ctbname']='t1';
                $testarr['tsernum']=$test[$j][tsernum];
                $testarr['filesernum']=$test[$j][filesernum];
                $tdata=$model_test_public_data->where($testarr)->find();


                $srcid=$tdata[srcid];
                $img_cuted_data=$model_img_cuted_data->where('id='.$srcid)->find();
                $src=$img_cuted_data[src];

                $pic1id=$tdata[pic1];
                $img_cuted_data=$model_img_cuted_data->where('id='.$pic1id)->find();
                $pic1src=$img_cuted_data[src];

                $pic2id=$tdata[pic2];
                $img_cuted_data=$model_img_cuted_data->where('id='.$pic2id)->find();
                $pic2src=$img_cuted_data[src];

                $pic3id=$tdata[pic3];
                $img_cuted_data=$model_img_cuted_data->where('id='.$pic3id)->find();
                $pic3src=$img_cuted_data[src];

                $pic4id=$tdata[pic4];
                $img_cuted_data=$model_img_cuted_data->where('id='.$pic4id)->find();
                $pic4src=$img_cuted_data[src];

                $newtest[$m][title]=cuttitlemsg($tdata[inputval]);
                $newtest[$m][src]=usersrc($src);
                $newtest[$m][tsernum]=$tdata[tsernum];
                $newtest[$m][ctbname]=$tdata[ctbname];
                $newtest[$m][filesernum]=$tdata[filesernum];
                $newtest[$m][pic1]=usersrc($pic1src);
                $newtest[$m][pic2]=usersrc($pic2src);
                $newtest[$m][pic3]=usersrc($pic3src);
                $newtest[$m][pic4]=usersrc($pic4src);
                $newtest[$m][id]=$tdata[id];

                $sum=0;
                if($pic1src!='')
                {
                    $sum=$sum+1;
                }
                if($pic2src!='')
                {
                    $sum=$sum+1;
                }
                if($pic3src!='')
                {
                    $sum=$sum+1;
                }
                if($pic4src!='')
                {
                    $sum=$sum+1;
                }

                $newtest[$m][sum]=$sum;

                if($sum!=0)
                {
                    //$newtest[$m][picnote]='题 '.str_replace(array("\r\n", "\r", "\n",".","&nbps;"), '',$newtest[$m]['newtitle']).'图';
                   $newtest[$m][picnote]='';
                }
                else{
                    $newtest[$m][picnote]='';
                }


                $newtest[$m][title]=cuttitlemsg($tdata[inputval]);
                $newtest[$m][src]=usersrc($src);
                $newtest[$m][newtitle]=$no1;
                $no1=$no1+1;


                $m=$m+1;
                $newtest[$m][title]= $test[$j][title];
                $newtest[$m][src]=$test[$j][src];
                $newtest[$m][newtitle]=$no2.'）';
                $newtest[$m][typeid]=$test[$j][typeid];
                $newtest[$m][pic1]=$test[$j][pic1];
                $newtest[$m][pic2]=$test[$j][pic2];
                $newtest[$m][pic3]=$test[$j][pic3];
                $newtest[$m][pic4]=$test[$j][pic4];
                $newtest[$m][sum]=$test[$j][sum];
                $newtest[$m][picnote]=$test[$j][picnote];
                $newtest[$m][id]=$test[$j][id];


                $tsernum=$test[$m][tsernum];
                $no2=$no2+1;
                $m=$m+1;
            }
            else
            {
                $newtest[$m][title]= $test[$j][title];
                $newtest[$m][src]=$test[$j][src];
                $newtest[$m][ctbname]=$test[$j][ctbname];
                $newtest[$m][tsernum]=$test[$j][tsernum];
                $newtest[$m][filesernum]=$test[$j][filesernum];
                $newtest[$m][newtitle]=$no2.'）';
              	$newtest[$m][typeid]=$test[$j][typeid];
                $newtest[$m][pic1]=$test[$j][pic1];
                $newtest[$m][pic2]=$test[$j][pic2];
                $newtest[$m][pic3]=$test[$j][pic3];
                $newtest[$m][pic4]=$test[$j][pic4];
                $newtest[$m][sum]=$test[$j][sum];
                $newtest[$m][picnote]=$test[$j][picnote];
                $newtest[$m][id]=$test[$j][id];



                if($test[$j][ctbname]=='t-a')
                {
                    $newtest[$m][newtitle]= $no1;
                    $no1=$no1+1;
                }

                if($test[$j][ctbname]=='a')
                {
                    $newtest[$m][newtitle]= $no2.'）';
                    $no2=$no2+1;
                }
                $m=$m+1;
            }
        }
     
     
       	$count=sizeof($newtest);
     	$m=0;
     	for($i=0;$i<$count;$i++)
        {
          
          if($checktestkind==0)
          {
                $choosenewtest[$m][title]=$newtest[$i][title];
                $choosenewtest[$m][src]=$newtest[$i][src];
                $choosenewtest[$m][ctbname]=$newtest[$i][ctbname];
                $choosenewtest[$m][tsernum]=$newtest[$i][tsernum];
                $choosenewtest[$m][filesernum]=$newtest[$i][filesernum];
                $choosenewtest[$m][newtitle]=($m+1).'）';
              	$choosenewtest[$m][typeid]=$newtest[$i][typeid];
                $choosenewtest[$m][pic1]=$newtest[$i][pic1];
                $choosenewtest[$m][pic2]=$newtest[$i][pic2];
                $choosenewtest[$m][pic3]=$newtest[$i][pic3];
                $choosenewtest[$m][pic4]=$newtest[$i][pic4];
                $choosenewtest[$m][sum]=$newtest[$i][sum];
                $choosenewtest[$m][picnote]=$newtest[$i][picnote];
                $choosenewtest[$m][id]=$newtest[$i][id];
            	$m=$m+1;
          }
          else
          {
              if($newtest[$i][typeid]==$checktestkind)
          		{
                	$choosenewtest[$m][title]=$newtest[$i][title];
                	$choosenewtest[$m][src]=$newtest[$i][src];
                	$choosenewtest[$m][ctbname]=$newtest[$i][ctbname];
                	$choosenewtest[$m][tsernum]=$newtest[$i][tsernum];
                	$choosenewtest[$m][filesernum]=$newtest[$i][filesernum];
               		$choosenewtest[$m][newtitle]=($m+1).'）';
              		$choosenewtest[$m][typeid]=$newtest[$i][typeid];
                	$choosenewtest[$m][pic1]=$newtest[$i][pic1];
                	$choosenewtest[$m][pic2]=$newtest[$i][pic2];
                	$choosenewtest[$m][pic3]=$newtest[$i][pic3];
                	$choosenewtest[$m][pic4]=$newtest[$i][pic4];
                	$choosenewtest[$m][sum]=$newtest[$i][sum];
                	$choosenewtest[$m][picnote]=$newtest[$i][picnote];
                	$choosenewtest[$m][id]=$newtest[$i][id];
            		$m=$m+1;
          		}
          }
        

        }
     
     

        $testarr=$data['ctbtestid'];
        $this->assign('paper_name',$paper_name);
        $this->assign('testarr',$testarr);
        $this->assign('testdata',$choosenewtest);
        $this->assign('testid',$testid);
     

     
   
    
     
        $this->display();
   }
  
    public function tupload()
    {

        $filesernum='a'.$_POST['tfilesernum'];
        $upload = new \Think\Upload();// 实例化上传类


        $modelmsg = M("paper_msg_data");
        $upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型

        $datetime = new \DateTime;

        $num=(int)$_POST['test_sum'];
        $reg=$_POST['reg2'];

        $msgdata['kind'] =(int)$_POST['paperkind'];
        $msgdata['publisher'] =$_POST['publishname'];



        $msgdata['chapterid'] =$_POST['chapterid'];

        $msgdata['publish_time'] =$_POST['publishtime'];
        $msgdata['paper_name'] = $_POST['papername'];
        $msgdata['keynote_id'] =$_POST['arraymsg'];
        $msgdata['statusmsg'] =0;
        $msgdata['creat_time'] =$datetime->format('Y-m-d H:i:s');
        $msgdata['filesernum'] =$filesernum;
      //  $msgdata['userid'] = $this->usermsg['id'];
        $msgdata['userid'] =$_POST['userid'];


        $msgdata['gradeid'] =$_POST['gradeid'];
        $msgdata['subjectid'] =$_POST['subjectid'];

        if(!empty($_FILES['tupload1']['tmp_name'])) {
           $msg = $modelmsg->add($msgdata);
        }
        for($i=1;$i<$num;$i++)
        {
                $filetitle="tupload".$i;
                $filemsg = $_FILES[$filetitle];
                $imgreg=$_POST["treg".$i];

            if(!empty(filemsg['tmp_name']))
            {
                $modelimg = M("paper_img_data");
                $modelimgre = M("paper_img_data_re");
                $upload->rootPath = './uploads/inittestimg/'; // 设置附件上传根目录
                $info = $upload->uploadOne($filemsg);
                $filesrc='./uploads/inittestimg/'. $info['savepath'] .$info['savename'];

                  $imgdata['filesernum'] =$filesernum;
                  $imgdata['src_pic'] =$filesrc;
                  $imgdata['img_reg'] =(int)$imgreg;
                  $imgdata['img_status']=0;
                  $imgdata['in_ser'] =(int)$i;
                  $imgdata['img_kind'] = 1;
                  $msg=$modelimg->add($imgdata);


                $newfilesrc='./uploads/inittestimgre/'. $info['savepath'] .$info['savename'];
                $imgdata['filesernum'] =$filesernum;
                $imgdata['src_pic'] =$newfilesrc;
                $imgdata['img_reg'] =(int)$imgreg;
                $imgdata['img_status']=0;
                $imgdata['in_ser'] =(int)$i;
                $imgdata['img_kind'] = 1;
                $msg=$modelimgre->add($imgdata);

                $filepath="./uploads/inittestimgre/".date("Y-m-d");

                saveasfile($filesrc,$newfilesrc,$filepath);
            }
        }


        if(!empty($info))
        {
            echo 1;
        }
        else
        {
            echo 0;
        }

    }


    public function aupload()
    {
        $filesernum='a'.$_POST['afilesernum'];
        $upload = new \Think\Upload();// 实例化上传类
//
//
        $modelmsg = M("paper_msg_data");
        $modelimg = M("paper_img_data");
        $modelimgre = M("paper_img_data_re");
        $upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型

        $datetime = new \DateTime;
//
          $num=$_POST['answer_sum'];

        for($i=1;$i<$num;$i++)
        {
            $filetitle="aupload".$i;
            $filemsg = $_FILES[$filetitle];
            $imgreg=$_POST["areg".$i];

            if(!empty(filemsg['tmp_name']))
            {
                //$modelimg = M("paper_img_data");
                $upload->rootPath = './uploads/inittestimg/'; // 设置附件上传根目录
                $info = $upload->uploadOne($filemsg);
                $filesrc='./uploads/inittestimg/'. $info['savepath'] .$info['savename'];

                $imgdata['filesernum'] =$filesernum;
                $imgdata['src_pic'] =$filesrc;
                $imgdata['img_reg'] =(int)$imgreg;
                $imgdata['img_status']=0;
                $imgdata['in_ser'] =(int)$i;
                $imgdata['img_kind'] = 2;
                $msg=$modelimg->add($imgdata);

                $newfilesrc='./uploads/inittestimgre/'. $info['savepath'] .$info['savename'];
                $imgdatare['filesernum'] =$filesernum;
                $imgdatare['src_pic'] =$newfilesrc;
                $imgdatare['img_reg'] =(int)$imgreg;
                $imgdatare['img_status']=0;
                $imgdatare['in_ser'] =(int)$i;
                $imgdatare['img_kind'] = 2;
                $msg=$modelimgre->add($imgdatare);

                $filepath="./uploads/inittestimgre/".date("Y-m-d");

                saveasfile($filesrc,$newfilesrc,$filepath);
            }
        }


        if($info!=false)
        {
            echo 1;
        }
        else
        {
            echo 0;
        }

    }


    public function pagemsg01()
    {
        $checkboxmsg=$_POST[keynotemsg];
        $arraymsg=implode(",",$checkboxmsg);
        $paperkind=$_POST[paperkind];
        $gradeid=$_POST[gradeid];
        $publishname=$_POST[publishname];
        $publishtime=$_POST[publishtime];
        $papername=$_POST[papername];

    }

    public function pagepanel0102()
    {

        $this->assign('realname', $_GET[realname]);
        $this->assign('username', $_GET[username]);
        $this->assign('userid', $_GET[userid]);
    

        $checkboxmsg=array_unique($_POST[keynotemsg]);
        $arraymsg=implode(",",$checkboxmsg);
        $paperkind=$_POST[paperkind];
        $gradeid=$_POST[gradeid_subject];

        $chapter=$_POST['chapter'];
      
       // echo $chapter;

        $publishtime=$_POST[publishtime];
        $papername=$_POST[papername];
        $subjectid=$_POST[subjectid];

        if($gradeid=='all' && $chapter=='subject')
        {
            $gradeid=0;
            $chapter=0;
        }

        if($chapter=='chapter')
        {
            $chapter=0;
        }



        $testmsg['arraymsg']=$arraymsg;
        $testmsg['paperkind']=$paperkind;
        $testmsg['gradeid']=$gradeid;

        $testmsg['chapterid']=$chapter;
        $testmsg['subjectid']=$subjectid;

        $testmsg['publishtime']=$publishtime;
        $testmsg['papername']=$papername;


        $this->assign('subjectid',$subjectid);
        $this->assign('testdata',$testmsg);
        $this->assign('userdata',$_GET[username]);
        $this->display();
    }

    public function testlist0103()
    {
        $model = M('paper_msg_data');
        $userid=$_GET[userid];
        $username=$_GET[username];
        $realname=$_GET[realname];

//        $userid=79;

        $array[userid]=$userid;
        $array[statusmsg]=0;

        $beginnum=0;
        $length=8;

        $limitmsg=$beginnum.','.$length;

        $msgnum=$length-1;

        $data=$model->where($array)->limit($limitmsg)->order('creat_time desc')->select();
        $datacount=$model->where($array)->order('creat_time desc')->count();
        $this->assign('username',$username);
        $this->assign('realname',$realname);
        $this->assign('userid',$userid);
        $this->assign('data',$data);
        $this->assign('datacount',$datacount);
        $this->assign('msgnum',$msgnum);





        $this->display();
        
    }

    public function test1()
    {
        $gradeid="5";
        $subjectid="1";
        $model=M('keynote_data');
        $data=$model->where(array('gradeid'=>$gradeid,'subjectid'=>$subjectid))->select();
        $model1=M('subject_data');
        $data1=$model1->where('subjectnum='.$subjectid)->find();
        $i=0;
        $j=0;
        foreach ($data as $key => $value) {
            $mun=$value;
            $valuenum=explode(",",$value['akeynote_id']);
            $valuemsg=explode(",",$value['akeynotemsg']);
            $valueser=$value['chapter'].$value['part'];
            $asubject[$i]['ser']=$valueser;
            foreach($valuenum as $key=>$valuenum)
            {
                $asubject[$i]['msg'][$j]['val']=$valuenum;
                $asubject[$i]['msg'][$j]['name']=$valuemsg[$key];
                $j=$j+1;
            }
            $j=0;
            $i=$i+1;
        }
    }

    public function selectmsg()
    {
        $gradeid=$_POST['gradeid'];
        $subjectid=$_POST['subjectid'];
        $subjecttext=$_POST['subjecttext'];


        $model=M('chapter_msg');

        if($gradeid=='all')
        {
            //$data=$model->where('subjectid='.$subjectid)->order('gradeid,orderid asc')->select();
            $data['count']=1;
            $data['id']='subject';
            $data['chaptermsg']=$subjecttext;
            echo json_encode($data);
        }
        else
        {
            if($gradeid!=0)
            {
                $data=$model->where(array('gradeid'=>$gradeid,'subjectid'=>$subjectid))->order('orderid asc')->select();
                $data['count']=sizeof($data);
                $data['top']['id']='chapter';
                $data['top']['chaptermsg']='全部';
                echo json_encode($data);
            }
            else
            {
                $data['count']=0;
                echo json_encode($data);
            }

        }

    }

    public function publishpaper0201()
   {


//       $model = M('paper_msg_data');
//       $model1=M('test_public_data');
       $userid=$_GET[userid];
       $username=$_GET[username];
       $realname=$_GET[realname];

       $this->assign('userid',$userid);
       $this->assign('username',$username);
       $this->assign('realname',$realname);


//       $array['userid']=$userid;
//       $array['statusmsg']=array('in','1,2');
//
//       $datacount=$model->where($array)->order('creat_time desc')->count();
//       $beginnum=0;
//       $length=8;
//
//       if($beginnum+$length>$datacount)
//       {
//           $length=$datacount-$beginnum;
//       }
//
//
//
//        $limitmsg=$beginnum.','.$length;
//
//        $msgnum=$length-1;
//
//        $data=$model->where($array)->limit($limitmsg)->order('creat_time desc')->select();
//
//
//       for($i=0;$i<$length;$i++)
//       {
//           $data[$i][userid]=$userid;
//           $data[$i][id]=$data[$i][id];
//           $filesernum=$data[$i][filesernum];
//           $publicarray['filesernum']=$filesernum;
//           $publicarray['ctbname']  = array('neq','t0');
//           $publicarray['ctbname']  = array('neq','t1');
//           $testcount=$model1->where($publicarray)->count();
//           $data[$i][questionsum]=$testcount;
//       }
//
//        $this->assign('username',$username);
//        $this->assign('realname',$realname);
//        $this->assign('userid',$userid);
//        $this->assign('testdata',$data);
//        $this->assign('datacount',$datacount);
//        $this->assign('msgnum',$msgnum);
//        $this->assign('sum',$datacount);


       $this->display();

   }

   public function publicpaper_class0202()
   {
       $this->assign('testid',$_GET['testid']);
       $this->assign('userid',$_GET['userid']);
       $this->assign('username',$_GET['username']);
       $this->assign('realname',$_GET['realname']);
       $this->assign('paper_name',$_GET['paper_name']);
     
       $userid=$_GET['userid'];
     
       //$userid=4;
     
     
     

       $model=M('user_teacher_addation_data');
       $model1=M('class_data');
       $model_class=M('test_send_class');
     
  
     
       $user_arr['userid']=$userid;

       $classmsg=$model->where($user_arr)->find();

       $classarray=explode(',',$classmsg['classarray']);
       $i=0;
       $maxsize=0;
       foreach ($classarray as $value) {
           $classmsg=$model1->where('id='.$value)->field('classname,groupidarr,g1_sum,g2_sum,g3_sum')->find();
         
         //  print_r($classmsg);
         
           $class[$i]['classname']=$classmsg['classname'];
           $class[$i]['classid']=$value;
         
           $g1_sum=$g1_sum+$classmsg['g1_sum'];
           $g2_sum=$g2_sum+$classmsg['g2_sum'];
           $g3_sum=$g3_sum+$classmsg['g3_sum'];
         
         //  $mysize=sizeof(explode(',',$classmsg['groupidarr']));
          // if($mysize>$maxsize)
          // {
           //    $maxsize=$mysize;
          // }
           $i=$i+1;
       }
     
     $j=1;
     if($g1_sum>0)
     {
       $groupid[$j]=1;
       $j=$j+1;
     }
     
     if($g2_sum>0)
     {
       $groupid[$j]=2;
       $j=$j+1;
     }
     
      if($g3_sum>0)
     {
       $groupid[$j]=3;
       $j=$j+1;
     }


     
   //  print_r($class);
       $this->assign('myclass',$class);
       $this->assign('groupid',$groupid);
     


     $this->display();
   }

   public function phpclassgroup()
   {
       $testid=$_POST['testid'];
     //1559
     $testid=1559;
       $model=M('test_send_class');
       $data=$model->where('testid='.$testid)->find();
       if($data['id']>0)
       {
           $data['kind']=1;
           echo json_encode($data);
       }
       else
       {
           $data['kind']=0;
           echo json_encode($data);
       }

   }


   public function publicpapersql()
   {

       $userid = $_POST['userid'];
       $testid = $_POST['testid'];
       $classarray=$_POST['classarray'];
       $grouparray=$_POST['grouparray'];
       $objectarray=$_POST['objectarray'];

//       $userid = 135;
//       $testid = 150;
//       $classarray='65,66,67';
//       $grouparray='1,2,3';
//       $objectarray='0,1';



       $myuserid = $userid;
       $mytestid = $testid;
       $myclassarray=$classarray;
       $mygrouparray=$grouparray;
       $myobjectarray=$objectarray;


       $class_userid=$myuserid;
       $class_mytestid=$mytestid;
       $class_myclassarray=$myclassarray;
       $class_mygrouparray=$mygrouparray;
       $class_myobjectarray=$myobjectarray;


       $statisticmodel=M('test_statistic');
       $papermodel=M('paper_msg_data');
       $usermodel=M('user_data');
       $test_class_model=M('test_send_class');

       if(substr($grouparray,0,3)==100)
       {
           $grouparray='1,2,3';
       };


       //判断是否classgroup中是否有数据，如果没有，进行插入
       $classgroup['testid']=$testid;

       $classgroupdata=$test_class_model->where($classgroup)->find();

       if($classgroupdata['id']>0)
       {

       }
       else
       {
           $classgroup['classid_arr']=$classarray;
           $classgroup['groupid_arr']=$grouparray;
           $classgroup['kind']=1;
           $test_class_model->add($classgroup);
       }

        //进入统计以test为核心的部分数据



       $statisticarr['testid']=$testid;
       $statisticarr['userid']=$userid;

       $msg=$statisticmodel->where($statisticarr)->find();

       $num=sizeof($msg);

       if($num>0)
       {

           $igrouparray=$grouparray;

           $paperdata=$papermodel->where('id='.$testid)->find();
           $userdata=$usermodel->where('id='.$userid)->find();

           $filesernum=$paperdata['filesernum'];
           $subjectid=$paperdata['subjectid'];
           $keynote_msg=$paperdata['keynote_id'];
           $chapterarr=$paperdata['chapterid'];
           $testkind=$paperdata['kind'];
           $testtime=$paperdata['publish_time'];
           $paper_name=$paperdata['paper_name'];
           $gradeid=$paperdata['gradeid'];
           $schoolid=$userdata['schoolid'];

           $newdata['testid']=$testid;
           $newdata['classidarr']=$msg['classidarr'].','.str_replace(",","-",$classarray);
           $newdata['userid']=$userid;
           $newdata['filesernum']=$filesernum;
           $newdata['subjectid']=$subjectid;
           $newdata['keynote_msg']=$keynote_msg;
           $newdata['chapterarr']=$chapterarr;
           $newdata['testkind']=$testkind;
           $newdata['testtime']=$msg['testtime'].','.$testtime;
           $newdata['paper_name']=$paper_name;
           $newdata['schoolid']=$schoolid;
           $newdata['gradeid']=$gradeid;
           $newdata['groupidarr']=$msg['groupidarr'].','.str_replace(",","-",$igrouparray);

           $statisticmodel->where('testid='.$testid)->save($newdata);

       }
       else
       {


            $igrouparray=$grouparray;

            $paperdata=$papermodel->where('id='.$testid)->find();
            $userdata=$usermodel->where('id='.$userid)->find();

            $filesernum=$paperdata['filesernum'];
            $subjectid=$paperdata['subjectid'];
            $keynote_msg=$paperdata['keynote_id'];
            $chapterarr=$paperdata['chapterid'];
            $testkind=$paperdata['kind'];
            $testtime=$paperdata['publish_time'];
            $paper_name=$paperdata['paper_name'];
            $gradeid=$paperdata['gradeid'];
            $schoolid=$userdata['schoolid'];


            $newdata['testid']=$testid;
            $newdata['classidarr']=str_replace(",","-",$classarray);
            $newdata['userid']=$userid;
            $newdata['filesernum']=$filesernum;
            $newdata['subjectid']=$subjectid;
            $newdata['keynote_msg']=$keynote_msg;
            $newdata['chapterarr']=$chapterarr;
            $newdata['testkind']=$testkind;
            $newdata['testtime']=$testtime;
            $newdata['paper_name']=$paper_name;
            $newdata['schoolid']=$schoolid;
            $newdata['gradeid']=$gradeid;
            $newdata['groupidarr']=str_replace(",","-",$igrouparray);

            $statisticmodel->add($newdata);

       }



       //testid:152,userid:135,classarray:65,66,67,grouparray:100,1,objectarray:0,1

       //进入插入学生部分数据


       $userid = $myuserid;
       $testid = $mytestid;
       $classarray=$myclassarray;
       $grouparray=$mygrouparray;
       $objectarray=$myobjectarray;


       $model=M('user_studentparent_addation_data');
       $model1=M('mytest');
       $model2=M('user_data');

       $groupmsg='in('.$grouparray.')';
       $classmsg='in('.$classarray.')';

       if(strstr($groupmsg,"100"))
       {
           $grouparr['groupid'] = array('neq',1000);

       }
       else
       {
           $grouparr['groupid'] = array('exp',$groupmsg);

       }

       $classarr['classid'] = array('exp',$classmsg);


      $data=$model->where($grouparr)->where($classarr)->select();

//       print_r($data);



       if($objectarray=='0')
       {
           foreach ($data as $value) {

             $userid=$value[userid];
             $userdata=$model2->where('id='.$userid)->find();
             $status=$userdata[status];
               if($status==0)
               {
                   $testdata[userid]=$value[userid];
                   $testdata[testid]=$testid;
                   $testdata[userkind]=0;
                   $testdata[kind]=0;
                   $testdata[creatime]=date('y-m-d H:i:s',time());;
                   $model1->add($testdata);
               }
           }
       }
       if($objectarray=='1')
       {
           foreach ($data as $value) {
               $userid = $value[userid];
               $userdata = $model2->where('id=' . $userid)->find();
               $status = $userdata[status];
               if ($status == 1) {
                   $testdata[userid] = $value[userid];
                   $testdata[testid] = $testid;
                   $testdata[userkind] = 1;
                   $testdata[kind]=0;
                   $testdata[creatime] = date('y-m-d H:i:s', time());;
                   $model1->add($testdata);
               }
           }
       }
       if($objectarray=='0,1') {

           foreach ($data as $value) {


               $userid = $value[userid];
               $userdata = $model2->where('id='.$userid)->find();
               $status = $userdata[status];
               if ($status == 1) {
                   $testdata[userkind] = 1;
                   $testdata[userid]=$value[userid];
                   $testdata[testid]=$testid;
                   $testdata[kind]=0;
                   $testdata[creatime]=date('y-m-d H:i:s',time());
                   $model1->add($testdata);
               }

               if ($status == 0){
                   $testdata[userkind] = 0;
                   $testdata[userid]=$value[userid];
                   $testdata[testid]=$testid;
                   $testdata[kind]=0;
                   $testdata[creatime]=date('y-m-d H:i:s',time());
                   $model1->add($testdata);
               }
           }
       }

       //修改当前试题的状态，修改为3，表示已经发布。同时，对于class和group进行修改。

       $paperarray['settime']=date('y-m-d H:i:s',time());;
       $paperarray['statusmsg']=3;
       $papermodel->where('id='.$testid)->save($paperarray);


       //修改class为基准的统计数据，进行插入
       $papermodel=M('paper_msg_data');
       $class_model=M('class_data');
       $class_statistic_model=M('class_statistic');
       $testdata=$papermodel->where('id='.$class_mytestid)->find();
       $subjectid=$testdata['subjectid'];
       $test_time=$testdata['publish_time'];
       $year_time= date("Y");
       $class_data=explode(',',$class_myclassarray);
       $count=sizeof($class_data);

       for($i=0;$i<$count;$i++)
       {
           $data['classid']=$class_data[$i];

           $class_count=$class_statistic_model->where('classid='.$data['classid'])->count();

           if($class_count==0)
           {
               $classmsg_data=$class_model->where('id='.$data['classid'])->find();
               $data['classnum']=$classmsg_data['classnum'];
               $data['g1_num']=0;
               $data['g2_num']=0;
               $data['g3_num']=0;

               $data['g1_wrong_ratio_arr']=0;
               $data['g2_wrong_ratio_arr']=0;
               $data['g3_wrong_ratio_arr']=0;

               $data['wrong_ratio_arr']=0;

               //g1_wrong_ratio_arr
               $data['group_arr']=$class_mygrouparray;
               $data['testidarr']=$class_mytestid;
               $data['time_arr']=$test_time;
               $data['subject_arr']=$subjectid;
               $data['year_time']=$year_time;
               $class_statistic_model->add($data);
           }else
           {
               $classmsg_data=$class_model->where('id='.$data['classid'])->find();
               $class_old_data=$class_statistic_model->where('classid='.$data['classid'])->find();

               if($class_old_data['year_time']!=date("Y"))
               {
                   $data['classnum']=$classmsg_data['classnum'];

                   $data['g1_sum']=0;
                   $data['g2_sum']=0;
                   $data['g3_sum']=0;

                   $data['g1_wrong_ratio_arr']=0;
                   $data['g2_wrong_ratio_arr']=0;
                   $data['g3_wrong_ratio_arr']=0;

                   $data['wrong_ratio_arr']=0;

                   $data['group_arr']=$class_mygrouparray;
                   $data['testidarr']=$class_mytestid;
                   $data['time_arr']=$test_time;
                   $data['subject_arr']=$subjectid;
                   $data['year_time']=$year_time;
                   $class_statistic_model->add($data);
               }else{
                   $data['classnum']=$class_old_data['classnum'].','.$classmsg_data['classnum'];

                   $data['g1_num']=$class_old_data['g1_num'].',0';
                   $data['g2_num']=$class_old_data['g2_num'].',0';
                   $data['g3_num']=$class_old_data['g3_num'].',0';

                   $data['g1_wrong_ratio_arr']=$class_old_data['g1_wrong_ratio_arr'].',0';
                   $data['g2_wrong_ratio_arr']=$class_old_data['g2_wrong_ratio_arr'].',0';
                   $data['g3_wrong_ratio_arr']=$class_old_data['g3_wrong_ratio_arr'].',0';

                   $data['wrong_ratio_arr']=$class_old_data['wrong_ratio_arr'].',0';



                   $data['group_arr']=$class_old_data['group_arr'].'+'.$class_mygrouparray;
                   $data['testidarr']=$class_old_data['testidarr'].','.$class_mytestid;
                   $data['time_arr']=$class_old_data['time_arr'].','.$test_time;
                   $data['subject_arr']=$class_old_data['subject_arr'].','.$subjectid;
                   $data['year_time']=$year_time;
                   $class_statistic_model->where('classid='.$data['classid'])->save($data);
               }

           }


       }







       echo 1;

   }


   public function test()
   {
       $msg='11ass中国.(T+A)';

       $leng=mb_strpos($msg,'.');

       echo   $msg=mb_substr($msg,0,$leng+1);

       //echo cuttitle($msg);

   }

   public function keynotearr()
   {
       $subjectid=$_POST['subjectid'];
       $kind=$_POST['kind'];
       $chapter=$_POST['chapter'];
       $gradeid=$_POST['gradeid'];


       $keynote_model=M('keynote_data');
       $grade_model=M('grade_data');
       $chapter_model=M('chapter_msg');
       $subject_model=M('subject_data');
       $subjectmsg='';

       if($kind==1)
       {
           $data=$keynote_model->where('subjectid='.$subjectid)->order('gradeid,chapter,chapterkind asc')->select();
           $count=sizeof($data);

           for($i=0;$i<$count;$i++)
           {
               $subjectid=$data[$i]['subjectid'];
               $gradeid=$data[$i]['gradeid'];
               $chapterid=$data[$i]['chapter'];

               $subjectdata=$subject_model->where('id='.$subjectid)->find();
               $gradedata=$grade_model->where('id='.$gradeid)->find();
               $chapterdata=$chapter_model->where('id='.$chapterid)->find();



               $data[$i]['subjectmsg']=$subjectdata['subjectmsg'];
               $data[$i]['grademsg']=$gradedata['grademsg'];
               $data[$i]['chaptermsg']=$chapterdata['chaptermsg'];
           }

           $grademsg='';
           $j=0;
           for($i=0;$i<$count;$i++)
           {
               if($data[$i]['chapterkind']==3)
               {
                   if($data[$i]['grademsg']!=$grademsg)
                   {
                       $newdata[$j]['grademsg']=$data[$i]['grademsg'];
                       $newdata[$j]['subjectmsg']=$data[$i]['subjectmsg'];
                       $newdata[$j]['chapterkind']=2;
                       $j=$j+1;
                       $grademsg=$data[$i]['grademsg'];
                   }


                   $newdata[$j]['chaptermsg']=$data[$i]['chaptermsg'];
                   $newdata[$j]['chapterkind']=3;
                   $j=$j+1;


               }


               if($data[$i]['chapterkind']==4) {
                   $newdata[$j]['id']= $data[$i]['id'];
                   $newdata[$j]['subjectmsg']= $data[$i]['subjectmsg'];
                   $newdata[$j]['grademsg']= $data[$i]['grademsg'];
                   $newdata[$j]['chaptermsg']= $data[$i]['chaptermsg'];
                   $newdata[$j]['part']= $data[$i]['part'];
                   $newdata[$j]['akeynote_id']= $data[$i]['akeynote_id'];
                   $newdata[$j]['akeynotemsg']= $data[$i]['akeynotemsg'];
                   $newdata[$j]['chapterkind']= $data[$i]['chapterkind'];
                   $newdata[$j]['orderid']= $data[$i]['orderid'];

                   $newdata[$j]['akeynote_id']=preg_replace("/(\s|\&nbsp\;|　|\xc2\xa0)/","",$newdata[$j]['akeynote_id']);


                   if($newdata[$j]['akeynote_id']!='')
                   {
                       $newdata[$j]['akeynote_isnot']=1;
                       $akeynoteid=$data[$i]['akeynote_id'];
                       $akeynotemsg=$data[$i]['akeynotemsg'];

                       $akeynoteid_arr=(explode(",",$akeynoteid));
                       $akeynotemsg_arr=(explode(",",$akeynotemsg));

                       $arr_id=sizeof($akeynoteid_arr);
                       $arr_val=sizeof($akeynotemsg_arr);


                       $newdata[$j]['arr_count']=$arr_id;

                       for($m=0;$m<$arr_id;$m++)
                       {
                           $newdata[$j]['arr_id'][$m]=$akeynoteid_arr[$m];
                           $newdata[$j]['arr_val'][$m]=$akeynotemsg_arr[$m];
                       }
                   }
                   else
                   {
                       $newdata[$j]['akeynote_isnot']=0;
                   }
                   $j=$j+1;
               }
           }

           $newdata['count']=sizeof($newdata);
           echo json_encode($newdata);
       }
       if($kind==2)
       {
           $arr_msg['subjectid']=$subjectid;
//           $arr_msg['chapter']=$chapter;
           $arr_msg['gradeid']=$gradeid;

           $data=$keynote_model->where($arr_msg)->order('gradeid,chapter,chapterkind asc')->select();

           $count=sizeof($data);

           for($i=0;$i<$count;$i++)
           {
               $subjectid=$data[$i]['subjectid'];
               $gradeid=$data[$i]['gradeid'];
               $chapterid=$data[$i]['chapter'];

               $subjectdata=$subject_model->where('id='.$subjectid)->find();
               $gradedata=$grade_model->where('id='.$gradeid)->find();
               $chapterdata=$chapter_model->where('id='.$chapterid)->find();

               $data[$i]['subjectmsg']=$subjectdata['subjectmsg'];
               $data[$i]['grademsg']=$gradedata['grademsg'];
               $data[$i]['chaptermsg']=$chapterdata['chaptermsg'];

               $data[$i]['akeynote_id']=preg_replace("/(\s|\&nbsp\;|　|\xc2\xa0)/","",$data[$i]['akeynote_id']);

               if($data[$i]['akeynote_id']!='')
               {
                       $data[$i]['akeynote_isnot']=1;
                       $akeynoteid=$data[$i]['akeynote_id'];
                       $akeynotemsg=$data[$i]['akeynotemsg'];

                       $akeynoteid_arr=(explode(",",$akeynoteid));
                       $akeynotemsg_arr=(explode(",",$akeynotemsg));

                       $arr_id=sizeof($akeynoteid_arr);
                       $arr_val=sizeof($akeynotemsg_arr);

                       $data[$i]['arr_count']=$arr_id;
                       for($m=0;$m<$arr_id;$m++)
                       {
                           $data[$i]['arr_id'][$m]=$akeynoteid_arr[$m];
                           $data[$i]['arr_val'][$m]=$akeynotemsg_arr[$m];
                       }
               }
                else
                {
                       $data[$i]['akeynote_isnot']=0;
                }


           }
           $data['count']=sizeof($data);

//           print_r($data);
           echo json_encode($data);
       }
       if($kind==3)
       {

           $arr_msg['subjectid']=$subjectid;
           $arr_msg['chapter']=$chapter;
           $arr_msg['gradeid']=$gradeid;

           $data=$keynote_model->where($arr_msg)->order('gradeid,chapter,chapterkind asc')->select();

           $count=sizeof($data);

           for($i=0;$i<$count;$i++)
           {
               $subjectid=$data[$i]['subjectid'];
               $gradeid=$data[$i]['gradeid'];
               $chapterid=$data[$i]['chapter'];

               $subjectdata=$subject_model->where('id='.$subjectid)->find();
               $gradedata=$grade_model->where('id='.$gradeid)->find();
               $chapterdata=$chapter_model->where('id='.$chapterid)->find();

               $data[$i]['subjectmsg']=$subjectdata['subjectmsg'];
               $data[$i]['grademsg']=$gradedata['grademsg'];
               $data[$i]['chaptermsg']=$chapterdata['chaptermsg'];

               $data[$i]['akeynote_id']=preg_replace("/(\s|\&nbsp\;|　|\xc2\xa0)/","",$data[$i]['akeynote_id']);

               if($data[$i]['akeynote_id']!='')
               {
                   $data[$i]['akeynote_isnot']=1;
                   $akeynoteid=$data[$i]['akeynote_id'];
                   $akeynotemsg=$data[$i]['akeynotemsg'];

                   $akeynoteid_arr=(explode(",",$akeynoteid));
                   $akeynotemsg_arr=(explode(",",$akeynotemsg));

                   $arr_id=sizeof($akeynoteid_arr);
                   $arr_val=sizeof($akeynotemsg_arr);

                   $data[$i]['arr_count']=$arr_id;
                   for($m=0;$m<$arr_id;$m++)
                   {
                       $data[$i]['arr_id'][$m]=$akeynoteid_arr[$m];
                       $data[$i]['arr_val'][$m]=$akeynotemsg_arr[$m];
                   }
               }
               else
               {
                   $data[$i]['akeynote_isnot']=0;
               }


           }


           $data['count']=sizeof($data);
           echo json_encode($data);
         //  print_r($data);
       }

   }


   public function dataphpsql()
   {
       $model = M('paper_msg_data');
       $userid=$_GET[userid];
     //  $userid=79;
       $datacount=$_POST[datacount];
       $datacount=$datacount-1;
       $beginnum=(int)$_POST[beginnum];
       $length=(int)$_POST[tlength];
       $maxnum=(int)$beginnum+(int)$length-1;


       if($maxnum>$datacount)
       {
           $maxnum=$datacount;
       }
       $length=$maxnum-(int)$beginnum+1;
       $limitmsg=$beginnum.','.$length;

       $array[userid]=$userid;
       $array[statusmsg]=0;


       $data=$model->where($array)->limit($limitmsg)->order('creat_time desc')->select();
       $newdata[beginnum]=$beginnum;
       $newdata[length]=$length;
       for($i=0;$i<$length;$i++)
       {
           $newdata[$beginnum][paper_name]=$data[$i][paper_name];
           $newdata[$beginnum][creat_time]=$data[$i][creat_time];
           if($data[$i][statusmsg]==0)
           {
               $newdata[$beginnum][statusmsg]='未处理';
           }
           else
           {
               $newdata[$beginnum][statusmsg]='处理完成';
           }
           $beginnum=$beginnum+1;
       }
      echo json_encode($newdata);
   }


   public function dataphpsql0201()
   {


    
       $userid=$_POST['userid'];
       $nowpage=$_POST['nowpage'];
       $pagelength=$_POST['pagelength'];
       $beginnum=($nowpage-1)*$pagelength+1;
       $beginpagenum=$beginnum-1;

       $model=M('paper_msg_data');
       $model_test_public=M('test_public_data');

      //这里添加时间和关键词搜索条件
       $keywords=$_POST['keywords'];
       $startDate=$_POST['startDate'];
       $endDate=$_POST['endDate'];
       
       $array['userid']=$userid;
       $array['statusmsg']=array('in','1,2');
       !empty($keywords) && $array['paper_name']=array('like','%'.$keywords.'%');
       !empty($startDate) && $array['publish_time']=array('gt',$startDate);
       !empty($endDate) && $array['publish_time']=array('lt',$endDate);
       if(!empty($startDate) && !empty($endDate) ) {
       	 	$array['publish_time']  = array(array('EGT',$startDate),array('ELT',$endDate),'and'); 
       }
     
       $count=$model->where($array)->count();
 
       $data = $model->where($array)->order('publish_time desc')->limit($beginpagenum.','.$pagelength)->select();
     
      

       for($i=0;$i<sizeof($data);$i++)
       {
           $data[$i]['num']=$beginnum;
           $beginnum=$beginnum+1;
       }

       $data['userid']=$userid;
       $data['length']=$beginnum-1;
       $data['pagelength']=$pagelength;
       $data['count']=$count;
       $data['pagenum']=ceil($count/$pagelength);

      echo json_encode($data);
   }


   public function selectchaptermsg()
   {
       $subjectid=$_POST[subjectid];
       $gradeid=$_POST[gradeid];


       $array['subjectid']=$subjectid;
       $array['gradeid']=$gradeid;

       $model = M('keynote_data');
       $array['subjectid']=$subjectid;
       $array['gradeid']=array('in',$gradeid.',','0');


       $chaptermsg=$model->where($array)->field('id,chapter,part,orderid,akeynote_id')->order('orderid asc')->select();
       $chaptercount=count($chaptermsg,0);


       $j=0;
       for($i=0;$i<$chaptercount;$i++)
       {
           if($chaptermsg[$i]['akeynote_id']==0 ||$chaptermsg[$i]['akeynote_id']=='subject' || $chaptermsg[$i]['akeynote_id']=='all')
           {
               $cmsg[$j]['id']=$chaptermsg[$i]['id'];
               $cmsg[$j]['msg']=$chaptermsg[$i]['chapter'];
               $cmsg[$j]['name']=0;
               $j=$j+1;
           }
           else
           {
               $cmsg[$j]['id']=$chaptermsg[$i]['id'];
               $cmsg[$j]['msg']='-'.$chaptermsg[$i]['part'];
               $cmsg[$j]['name']=$chaptermsg[$i]['akeynote_id'];
               $j=$j+1;
           }
       }

       $cmsg['count']=$chaptercount;

       echo json_encode($cmsg);
   }

//插入习题统计信息
    public function teststatic0202()
    {
        $testid = 149;
        $thisgroupidarr = 'g1-g2-g3';
        $classidarr = '123-234-244';
        $testtime = '2018-09-12';
        $testkind = 2;
        $userid = 135;
        $papername = '测试试卷';
        $subjectid = 2;

        $filesernum = 'a1001201885224431';
        $keynote_msg = '23,34,23';
        $schoolid = 123;
        $gradeid = 234;


        $model_test = M('test_statistic');
        $all_arr['userid'] = $userid;
        $all_arr['subjectid'] = $subjectid;
        $all_data = $model_test->where($all_arr)->field('id,testid,classidarr,groupidarr,testtime,testkind,chapterarr,paper_name,filesernum')->select();

        $all_count = sizeof($all_data);


        $m = 0;
        for ($i = 0; $i < $all_count; $i++) {

            $classidarr = explode(',', $all_data[$i]['classidarr']);
            $groupidarr = explode(',', $all_data[$i]['groupidarr']);
            $testtime = explode(',', $all_data[$i]['testtime']);
            $testkind = explode(',', $all_data[$i]['testkind']);
            $chapterarr = explode(',', $all_data[$i]['chapterarr']);

            $class_count = sizeof($classidarr);

            for ($n = 0; $n < $class_count; $n++) {

                $inewdata[$m]['id'] = $all_data[$i]['id'];
                $inewdata[$m]['testid'] = $all_data[$i]['testid'];
                $inewdata[$m]['paper_name'] = $all_data[$i]['paper_name'];
                $inewdata[$m]['filesernum'] = $all_data[$i]['filesernum'];

                $inewdata[$m]['testtime'] = $testtime[$n];
                $inewdata[$m]['testkind'] = $testkind[$n];
                $inewdata[$m]['chapterarr'] = $chapterarr[$n];
                $inewdata[$m]['classidarr'] = '-' . $classidarr[$n] . '-';
                $inewdata[$m]['groupidarr'] = '-' . $groupidarr[$n] . '-';
                $m = $m + 1;
            }
        }
    }

        //试卷信息

        public  function testmsg0201()
        {
          
       $userid=$_GET[userid];
       $username=$_GET[username];
       $realname=$_GET[realname];

       //查询数据获取
        $group=M('group_data');
        $subject=M('subject_data');
        $class=M('class_data');
        
        $groupList=$group->order('id asc')->limit(3)->select();
        $subjectList=$subject->select();
        
        //获取老师对应的班级
        $teach=M('user_teacher_addation_data');
        $teacherInfo=$teach->where('userid='.$userid)->find();
        $classList=$class->where('id in ('.$teacherInfo['classarray'].')')->select();
        
        $this->assign('groupList',$groupList);
        $this->assign('subjectList',$subjectList);
        $this->assign('classList',$classList);
       
       
       $this->assign('userid',$userid);
       $this->assign('username',$username);
       $this->assign('realname',$realname);


          
          
            $this->display();
        }

        //分解成群组，每个试卷单次发布的班级集合，群主集合等。



    //相应的习题
    public function phptestmsg0201()
    {
        $userid=$_POST['userid'];
        $nowpage=$_POST['nowpage'];
        $pagelength=$_POST['pagelength'];

//        $userid=135;
//        $nowpage=1;
//        $pagelength=3;
 
		$classinfo=$_POST['classinfo'];
		$group=$_POST['group'];


        $beginnum=($nowpage-1)*$pagelength+1;
        $beginpagenum=$beginnum-1;
        $model=M('mytest');
        $model_paper_msg=M('paper_msg_data');
        $model2=M('grade_data');
        $model3=M('subject_data');
        $model4=M('test_public_data');
        $model_class_statistic=M('class_statistic');



        $dataarr['userid']=$userid;
        $model_tec_add=M('user_teacher_addation_data');
        $tec_msg_data=$model_tec_add->where('userid='.$userid)->find();

        $main_class_id=$tec_msg_data['classid'];
        $all_class_id_arr=$tec_msg_data['classid'];
        $subjectid=$tec_msg_data['subjectid'];

        $classid=$main_class_id;
        $testdata=$model_class_statistic->where('classid='.$main_class_id)->find();

        //

        $testid_data=explode(',',$testdata['testidarr']);
        $time_data=explode(',',$testdata['time_arr']);
        $wrong_ratio_data=explode(',',$testdata['wrong_ratio_arr']);
        $subject_data=explode(',',$testdata['subject_arr']);
        $classnum_data=explode(',',$testdata['classnum']);
        $group_data=explode(',',$testdata['group_arr']);
        $year_time=$testdata['year_time'];
        $g1_num_data=explode(',',$testdata['g1_num']);
        $g2_num_data=explode(',',$testdata['g2_num']);
        $g3_num_data=explode(',',$testdata['g3_num']);
        $g1_wrong_ratio_data=explode(',',$testdata['g1_wrong_ratio_arr']);
        $g2_wrong_ratio_data=explode(',',$testdata['g2_wrong_ratio_arr']);
        $g3_wrong_ratio_data=explode(',',$testdata['g3_wrong_ratio_arr']);

        $count=sizeof($testid_data);
        
        //查询条件获取
        $ndata=array();
        I('subject') && $ndata['subjectid']=I('subject');
       
 		//$data['gradeid']=I('grade');
  		//$data['kind']=I('subject');
  
        $sendclass=M('test_send_class');
        
        $beginnum=($nowpage-1)*$pagelength;
        $endnum=$beginnum+$pagelength;
        for($i=0;$i<sizeof($testid_data);$i++)
        {
            if($i>=$beginnum && $i<$endnum)
            {
                $data[$i]['num']=$i+1;
                $data[$i]['testid']=$testid_data[$i];

                $paperdata=$model_paper_msg->where('id='.$testid_data[$i])->where($ndata)->find();
                
                //学科搜索
                if(empty($paperdata)) {
                	unset($data[$i]);
                	$count=$count-1;
                	continue;
                }
                
                //群组和班级
                $sendclassInfo=$sendclass->where('testid='.$paperdata['id'])->find();
                  //群组和班级
                if(!empty($classinfo) && empty($sendclassInfo)) {
                	unset($data[$i]);
                	$count=$count-1;
                	continue;
                }
                 if(!empty($group) && empty($sendclassInfo)) {
                	unset($data[$i]);
                	$count=$count-1;
                	continue;
                }
                
                if(!empty($sendclassInfo)) {
                	$classidAry=explode(',',$sendclassInfo['classid_arr']);
                	$groupAry=explode(',',$sendclassInfo['groupid_arr']);
     
                	if(!empty($classinfo) && !in_array($classinfo,$classidAry)) {
                		unset($data[$i]);
	                	$count=$count-1;
	                	continue;
                	}
                    if(!empty($group) && !in_array($group,$groupAry)) {
                 
                		unset($data[$i]);
	                	$count=$count-1;
	                	continue;
                	}
                }
                
     
                $data[$i]['paper_name']=$paperdata['paper_name'];
                $data[$i]['time']=$time_data[$i];
                $data[$i]['wrong_ratio']=$wrong_ratio_data[$i];
                $data[$i]['classnum']=$classnum_data[$i];
                
                
                $data[$i]['year_time']=$year_time;
                $data[$i]['g1_num']=$g1_num_data[$i];
                $data[$i]['g2_num']=$g2_num_data[$i];
                $data[$i]['g3_num']=$g3_num_data[$i];
                $data[$i]['g1_wrong_ratio']=$g1_wrong_ratio_data[$i];
                $data[$i]['g2_wrong_ratio']=$g2_wrong_ratio_data[$i];
                $data[$i]['g3_wrong_ratio']=$g3_wrong_ratio_data[$i];
                $data[$i]['person_sum']=$g1_num_data[$i]+$g2_num_data[$i]+$g3_num_data[$i];

            }
        }

        $data=array_slice($data, 0);

        $data['length']=sizeof($data);
        $data['pagelength']=$pagelength;
        $data['count']=$count;
        $data['classid']=$classid;
        $data['pagenum']=ceil($count/$pagelength);

        echo json_encode($data);
    }


    //试卷信息

    public  function testmsg0202()
    {
        $userid=$_GET['userid'];
      	$username=$_GET['username'];
      	$realname=$_GET['realname'];
      
        $paper_name=$_GET['paper_name'];
        $classid=$_GET['classid'];
        $testid=$_GET['testid'];
        
       
            //查询数据获取
        $group=M('group_data');
        $subject=M('subject_data');
        $class=M('class_data');
        
        $groupList=$group->order('id asc')->limit(3)->select();
        $subjectList=$subject->select();
        
        //获取老师对应的班级
        $teach=M('user_teacher_addation_data');
        $teacherInfo=$teach->where('userid='.$userid)->find();
        $classList=$class->where('id in ('.$teacherInfo['classarray'].')')->select();
        
        $this->assign('groupList',$groupList);
        $this->assign('subjectList',$subjectList);
        $this->assign('classList',$classList);

        $this->assign('testid',$testid);
        $this->assign('userid',$userid);
        $this->assign('username',$username);
        $this->assign('realname',$realname);
        $this->assign('classid',$classid);
        $this->assign('paper_name',$paper_name);
 
        $this->display();
    }

 	public  function phptestmsg0202()
    {
        $userid=$_POST['userid'];
      	//$username=$_POST['username'];
      	//$realname=$_POST['realname'];
      
        //$paper_name=$_POST['paper_name'];
        $classid=$_POST['classinfo'];
        $testid=$_POST['testid'];
        $group=$_POST['group'];
        
        $pagelength=$_POST['pagelength'];
        $nowpage=$_POST['nowpage'];
        
        $model_stu_add=M('user_studentparent_addation_data');
        $model_mytest=M('mytest');
        $model_user_data=M('user_data');
        $model_group=M('group_data');
        
        
        $beginnum=($nowpage-1)*$pagelength+1;
        $beginpagenum=$beginnum-1;
        
        !empty($classid) && $class_add_arr['classid']=$classid;
        !empty($group) && $class_add_arr['groupid']=$group;
         
        $count=$model_stu_add->where($class_add_arr)->count();
        $stu_data=$model_stu_add->where($class_add_arr)->limit($beginpagenum.','.$pagelength)->select();
        
        
        //$count=sizeof($stu_data);

        for($i=0;$i<sizeof($stu_data);$i++)
        {
            $data[$i]['userid']=$stu_data[$i]['userid'];
            $stu_main_data=$model_user_data->where('id='.$data[$i]['userid'])->find();
            $data[$i]['realname']=$stu_main_data['realname'];
            $data[$i]['groupid']=$stu_data[$i]['groupid'];
            
            $group_data=$model_group->where('id='.$stu_data[$i]['groupid'])->find();
            $data[$i]['groupname']=$group_data['groupname'];
            
            $arr['userid']=$data[$i]['userid'];
            $arr['testid']=$testid;
            $arr['kind']=1;
            $testdata=$model_mytest->where($arr)->find();
   
 
            if($testdata['ctbtestid']!='')
            {
                $ctbtestid_data=explode(',',$testdata['ctbtestid']);
                $questionsum=$testdata['questionsum'];
                $questionnum=sizeof($ctbtestid_data);
                $data[$i]['ratio']=(round(($questionnum/$questionsum),3)*100).'%';
            }
            else
            {
                $data[$i]['ratio']=0;
            }

        }
        
        //根据ratio 排序
        $data=array_sort($data, 'ratio', 0);
        
        $data['length']=sizeof($stu_data);
        $data['pagelength']=$pagelength;
        $data['count']=$count;
        $data['pagenum']=ceil($count/$pagelength);
         
        $data=array_slice($data, 0);

     	echo json_encode($data);
    }
    
    public  function testmsg0203()
    {
        $userid=$_GET['userid'];
        $paper_name=$_GET['paper_name'];
        $classid=$_GET['classid'];
        $testid=$_GET['testid'];
      
      	$username=$_GET['username'];
      	$realname=$_GET['realname'];

      	//查询数据获取
      	$group=M('group_data');
      	$subject=M('subject_data');
      	$class=M('class_data');
      	
      	$groupList=$group->order('id asc')->limit(3)->select();
      	$subjectList=$subject->select();
      	
      	//获取老师对应的班级
      	$teach=M('user_teacher_addation_data');
      	$teacherInfo=$teach->where('userid='.$userid)->find();
      	$classList=$class->where('id in ('.$teacherInfo['classarray'].')')->select();
      	
      	$this->assign('groupList',$groupList);
      	$this->assign('subjectList',$subjectList);
      	$this->assign('classList',$classList);

        $this->assign('testid',$testid);
        $this->assign('userid',$userid);
        $this->assign('username',$username);
        $this->assign('realname',$realname);
        $this->assign('classid',$classid);
        $this->assign('paper_name',$paper_name);
 
        $this->display();

    }
    
    public  function phptestmsg0203()
    {
    	$userid=$_POST['userid'];
    	$paper_name=$_POST['paper_name'];
    	$classid=$_POST['classinfo'];
    	$testid=$_POST['testid'];
    
    	$username=$_POST['username'];
    	$realname=$_POST['realname'];
    	
    	$pagelength=$_POST['pagelength'];
    	$nowpage=$_POST['nowpage'];
    	
    	$beginnum=($nowpage-1)*$pagelength+1;
    	$beginpagenum=$beginnum-1;
    
    	$model_stu_add=M('user_studentparent_addation_data');
    	$model_mytest=M('mytest');
    	$model_user_data=M('user_data');
    	$model_paper_msg_data=M('paper_msg_data');
    	$model_test_public_data=M('test_public_data');
    
    	$arr['classid']=$classid;
    	$arr['testid']=$testid;
    	$arr['kind']=1;
    
    	$testdata=$model_mytest->where($arr)->select();
    	$count=sizeof($testdata);
    
    	$testarr='';
    
    	for($i=0;$i<$count;$i++)
    	{
    		$testarr=$testarr.','.$testdata[$i]['ctbtestid'];
    	}
    	$alltestarr=substr($testarr,1);
    	$alltestarr=explode(',',$alltestarr);
    	$uniquearr=uniquearr($alltestarr);
    	$uniquer_count=sizeof($uniquearr);
    	for($i=0;$i<$uniquer_count;$i++)
    	{
	    	$data[$i]['id']=$uniquearr[$i];
	    	$data[$i]['time']=elenum($uniquearr[$i],$alltestarr).'/'.$count;
    	}
    
    
    	$data=array_sort($data,'time',1);
    	$data=array_values($data);
    
    	for($i=0;$i<sizeof($data);$i++)
    	{
    		$data[$i]['num']=$i+1;
    	}
    
	    $paper_data=$model_paper_msg_data->where('id='.$testid)->find();
 
	    $filesernum=$paper_data['filesernum'];
	    $paperarr['filesernum']=$filesernum;
	    $alltestdata=$model_test_public_data->where($paperarr)->order('in_ser asc')->select();
	    $allcount=sizeof($alltestdata);
    
    
    	$newtestdata=linatob($alltestdata,$data);
    	$count=count($newtestdata);
    	$newtestdata=array_slice($newtestdata,$beginpagenum,$pagelength);
    	
    	$newtestdata['length']=count($newtestdata);
    	$newtestdata['pagelength']=$pagelength;
    	$newtestdata['count']=$count;
    	$newtestdata['pagenum']=ceil($count/$pagelength);
    	
    	echo json_encode($newtestdata);
    
    }

    public function managestu0301(){
        $userid=$_GET['userid'];
        $username=$_GET['username'];
        $userrealname=$_GET['realname'];
      
        $model_teacher_addation=M('user_teacher_addation_data');
        $model_class=M('class_data');
        $tec_add_data=$model_teacher_addation->where('userid='.$userid)->find();
        $classid=$tec_add_data['classid'];
        $class_data=$model_class->where('id='.$classid)->find();
        $class_name=$class_data['classname'];

        $model_stu_addation=M('user_studentparent_addation_data');
        $stu_add_data=$model_stu_addation->where('classid='.$classid)->select();


        $model_user=M('user_data');

        $count=sizeof($stu_add_data);
        for($i=0;$i<$count;$i++)
        {
            $stu_userid=$stu_add_data[$i]['userid'];
            $groupid=$stu_add_data[$i]['groupid'];

            $user_data=$model_user->where('id='.$stu_userid)->find();

            $realname=$user_data['realname'];
            $regtime=$user_data['regtime'];
            $kind=$user_data['kind'];

            $data[$i]['realname']=$user_data['realname'];
            $data[$i]['regtime']=$user_data['regtime'];
            $data[$i]['kind']=$user_data['kind'];
            $data[$i]['userid']=$user_data['userid'];

            $regtime=date('Y-m-d',strtotime($regtime));
            $j=$i+1;

            $group_option='';
            $kind_option='';

            if($groupid==1)
            {
                $group_option='<option value="1" selected = "selected" >G1</option><option  value="2" >G2</option><option  value="3" >G3</option>';
            }
            if($groupid==2)
            {
                $group_option='<option value="1"  >G1</option><option selected = "selected"  value="2" >G2</option><option  value="3" >G3</option>';
            }
            if($groupid==3)
            {
                $group_option='<option value="1"  >G1</option><option value="2" >G2</option><option  selected = "selected"  value="3" >G3</option>';
            }

            if($kind==0)
            {
                $kind_option='<option value="0"  selected = "selected"  >冻结</option><option value="1" >通过</option><option value="100" >删除</option>';
            }

            if($kind==1)
            {
                $kind_option='<option value="0" >冻结</option><option value="1"   selected = "selected" >通过</option><option value="100" >删除</option>';
            }

            $newdata[$i]['msg']='<span>'.$j.'</span><span style="margin-left: 16px;">'.$realname.'</span><span  style="margin-left: 20px;">'.$regtime.'</span><select name="'.$stu_userid.'" onchange="groupsub(this)" style="margin-left: 8px;" class="pageblackselect">'.$group_option.'</select><select  name="'.$stu_userid.'" onchange="kindsub(this)"  style="margin-left:5px;" class="pageblackselect">'.$kind_option.'</select><hr>';
        }


        $this->assign('userid',$userid);
        $this->assign('username',$username);
        $this->assign('realname',$userrealname);
        $this->assign('data',$newdata);
        $this->assign('class_name',$class_name);
      
     // print_r($realname);
      
       $this->display();

    }

    public function phpgroupsub()
    {
        $userid=$_POST['userid'];
        $groupval=$_POST['groupval'];

//        $userid=149;
//        $groupval=3;


        $model=M('user_data');
        $model_add=M('user_studentparent_addation_data');
        $model_class=M('class_data');

        $userdata=$model->where('id='.$userid)->find();
        $kind=$userdata['kind'];
        $user_add_data=$model_add->where('userid='.$userid)->find();

        //当前用户的群组
        $oldgroupid=$user_add_data['groupid'];
        $classid=$user_add_data['classid'];

        $class_data=$model_class->where('id='.$classid)->find();


        $g1_sum=$class_data['g1_sum'];
        $g2_sum=$class_data['g2_sum'];
        $g3_sum=$class_data['g3_sum'];


        if($kind==1)
        {
            if($oldgroupid==1)
            {
                $g1_sum=$g1_sum-1;
            }
            if($oldgroupid==2)
            {
                $g2_sum=$g2_sum-1;
            }
            if($oldgroupid==3)
            {
                $g3_sum=$g3_sum-1;
            }


            if($groupval==1)
            {
                $g1_sum=$g1_sum+1;
            }
            if($groupval==2)
            {
                $g2_sum=$g2_sum+1;
            }
            if($groupval==3)
            {
                $g3_sum=$g3_sum+1;
            }
            $class_arr['g1_sum']=$g1_sum;
            $class_arr['g2_sum']=$g2_sum;
            $class_arr['g3_sum']=$g3_sum;


            $model_class->where('id='.$classid)->save($class_arr);

        }

        $arr['groupid']=$groupval;
        $model_add->where('userid='.$userid)->save($arr);

        echo 1;
    }

    public function phpkindsub()
    {
        $userid=$_POST['userid'];
        $val=(int)$_POST['val'];

        $model=M('user_data');
        $model_add=M('user_studentparent_addation_data');
        $model_class=M('class_data');

        $userdata=$model->where('id='.$userid)->find();
        $kind=$userdata['kind'];

        $user_add_data=$model_add->where('userid='.$userid)->find();



        //当前用户的群组
        $oldgroupid=$user_add_data['groupid'];
        $classid=$user_add_data['classid'];



        $class_data=$model_class->where('id='.$classid)->find();

        $classnum=$class_data['classnum'];
        $g1_sum=$class_data['g1_sum'];
        $g2_sum=$class_data['g2_sum'];
        $g3_sum=$class_data['g3_sum'];



        if($kind==0)
        {
            if($val==100)
            {
                $arr['kind']=$val;
                $model->where('id='.$userid)->delete();
                $model_add->where('userid='.$userid)->delete();
                echo 1;
            }else
            {
                $arr['kind']=$val;
                $data=$model->where('id='.$userid)->save($arr);


                if($oldgroupid==1)
                {
                    $g1_sum=$g1_sum+1;
                }
                if($oldgroupid==2)
                {
                    $g2_sum=$g2_sum+1;
                }
                if($oldgroupid==3)
                {
                    $g3_sum=$g3_sum+1;
                }

                $classnum=$classnum+1;

                $class_arr['g1_sum']=$g1_sum;
                $class_arr['g2_sum']=$g2_sum;
                $class_arr['g3_sum']=$g3_sum;
                $class_arr['classnum']=$classnum;

                $model_class->where('id='.$classid)->save($class_arr);


                echo 2;
            }
        }





        if($kind==1)
        {
            if($val==100)
            {

                $arr['kind']=$val;
                $model->where('id='.$userid)->delete();
                $model_add->where('userid='.$userid)->delete();



                if($oldgroupid==1)
                {
                    $g1_sum=$g1_sum-1;
                }
                if($oldgroupid==2)
                {
                    $g2_sum=$g2_sum-1;
                }
                if($oldgroupid==3)
                {
                    $g3_sum=$g3_sum-1;
                }

                $classnum=$classnum-1;

                $class_arr['g1_sum']=$g1_sum;
                $class_arr['g2_sum']=$g2_sum;
                $class_arr['g3_sum']=$g3_sum;
                $class_arr['classnum']=$classnum;

                $model_class->where('id='.$classid)->save($class_arr);


                echo 1;
            }else
            {
                $arr['kind']=$val;
                $data=$model->where('id='.$userid)->save($arr);

                if($val==0)
                {
                    if($oldgroupid==1)
                    {
                        $g1_sum=$g1_sum-1;
                    }
                    if($oldgroupid==2)
                    {
                        $g2_sum=$g2_sum-1;
                    }
                    if($oldgroupid==3)
                    {
                        $g3_sum=$g3_sum-1;
                    }

                    $classnum=$classnum-1;

                    $class_arr['g1_sum']=$g1_sum;
                    $class_arr['g2_sum']=$g2_sum;
                    $class_arr['g3_sum']=$g3_sum;
                    $class_arr['classnum']=$classnum;


                    $model_class->where('id='.$classid)->save($class_arr);
                }





                echo 2;
            }
        }






    }

    public function publicpaper_list0202()
    {
        $userid=$_GET['userid'];
        $realname=$_GET['realname'];
        $username=$_GET['username'];

        $this->assign('userid',$userid);
        $this->assign('realname',$realname);
        $this->assign('username',$username);

                     //获取老师对应的班级
        $class=M('class_data');
        $teach=M('user_teacher_addation_data');
        $teacherInfo=$teach->where('userid='.$userid)->find();
        $classList=$class->where('id in ('.$teacherInfo['classarray'].')')->select();
         $this->assign('classList',$classList);
         
         
        $this->display();
    }

  public function managestuscore0401()
  {
        $userid=$_GET['userid'];
        $realname=$_GET['realname'];
        $username=$_GET['username'];
    	$model=M('user_data');
 
 
    	//查询数据获取
        $group=M('group_data');
        $subject=M('subject_data');
        $class=M('class_data');
        
        //默认数学2
        $subjectid=1;
        $groupList=$group->order('id asc')->limit(3)->select();
        $subjectList=$subject->select();
        
        //获取老师对应的班级
        $teach=M('user_teacher_addation_data');
        $teacherInfo=$teach->where('userid='.$userid)->find();
        $classList=$class->where('id in ('.$teacherInfo['classarray'].')')->select();
        
        $this->assign('groupList',$groupList);
        $this->assign('subjectList',$subjectList);
        $this->assign('classList',$classList);
     
        $this->assign('userid',$userid);
        $this->assign('realname',$realname);
        $this->assign('username',$username);
         $this->assign('subjectid',$subjectid);
    
 
        $this->display();
  }
  
 public function phpmanagestuscore0401()
  {
        $userid=$_POST['userid'];
        $realname=$_POST['realname'];
        $username=$_POST['username'];
        $pagelength=$_POST['pagelength'];
        
        $nowpage=$_POST['nowpage'];
        
        $classinfo=$_POST['classinfo'];
        $group=$_POST['group'];
        $newsubjectid=$_POST['subjectid'];
        
    	$model=M('user_data');
    	$model_group=M('group_data');
        $model_add=M('user_teacher_addation_data');
    	$model_class=M('class_data');
        $model_add_stu=M('user_studentparent_addation_data');
    	$model_mytest=M('mytest');
    	$model_subject_data=M('subject_data');
    
 
    	$user_arr['userid']=$userid;
    	$userdata=$model_add->where($user_arr)->find();
 
    	$classid=$userdata['classid'];
        $subjectid=$userdata['subjectid'];
    	$subjectdata=$model_subject_data->where('id='.$subjectid)->find();
        $this->assign('subjectdata',$subjectdata);
    
        $classarray=explode(',',$userdata['classarray']);
    	$count=sizeof($classarray);
    
    	for($i=0;$i<$count;$i++)
       	{
        	if($classarray[$i]==$classid)
            {
              $m=$i;
            }
        }
    	
    	$midvalue=$classarray[0];
    	$classarray[0]=$classarray[$m];
    	$classarray[$m]=$midvalue;
    	
   	 	for($i=0;$i<$count;$i++)
       	{
          $class_arr['id']=$classarray[$i];
          $class_data=$model_class->where($class_arr)->find();
          $thisclassdata[$i]['classval']=$classarray[$i];
          $thisclassdata[$i]['classname']=$class_data['classname'];
      	}
    

      	$beginnum=($nowpage-1)*$pagelength+1;
        $beginpagenum=$beginnum-1;
    
    	//$class_add_arr['classid']=$classid;
    	!empty($classinfo) && $class_add_arr['classid']=$classinfo;
    	!empty($group) && $class_add_arr['groupid']=$group;
    	
    	
    	$count=$model_add_stu->where($class_add_arr)->count();
    	$stu_data=$model_add_stu->where($class_add_arr)->select();
    
    	$m=0;
    	for($j=0;$j<sizeof($stu_data);$j++)
        {
          if($stu_data[$j]['childid']==0)
          {
           $stu_new_data[$m]['userid']=$stu_data[$j]['userid'];
           $this_user_arr['id']=$stu_new_data[$m]['userid'];
           $user_data=$model->where($this_user_arr)->find();
           $stu_new_data[$m]['realname']=$user_data['realname'];
           $stu_new_data[$m]['groupid']=$stu_data[$j]['groupid'];
           $group_arr['id']=$stu_new_data[$m]['groupid'];
           $group_data=$model_group->where($group_arr)->find();
           $stu_new_data[$m]['groupname']=$group_data['groupname'];
          
          
            
           $this_user_id=$stu_new_data[$m]['userid'];
           $test_arr['userid']=$this_user_id;
           !empty($newsubjectid) && $test_arr['subjectid']=$newsubjectid;
           $test_data=$model_mytest->where($test_arr)->limit('0,2')->select();
           $test_count=sizeof($test_data);
           $ctb_sum=0;
           $test_sum=0;
            
           for($k=0;$k<$test_count;$k++)
           {
              $ctbtestid=$test_data[$k]['ctbtestid'];
              $questionsum=$test_data[$k]['questionsum'];
              $test_sum=$test_sum+$questionsum;
              if($ctbtestid!='')
              {
                 $ctbtestarr=explode(',',$ctbtestid);
                 $ctb_count=sizeof($ctbtestarr);
                 $ctb_sum=$ctb_sum+$ctb_count;
              }
             else
             {
                 $ctb_sum=$ctb_sum+0;
             }
           }
            
            $stu_ave_ratio=round(($ctb_sum/$test_sum),2);
            $stu_new_data[$m]['test_ave_ratio']=$stu_ave_ratio;
            $stu_new_data[$m]['test_ave']=$ctb_sum.'/'.$test_sum;
            
             $m=$m+1;
          }
        }
        
        $stu_new_data=array_sort($stu_new_data, 'test_ave_ratio', 1);
    
        $stu_new_data=array_slice($stu_new_data, $beginpagenum,$pagelength);
        $stu_new_data['length']=sizeof($stu_new_data);
        $stu_new_data['pagelength']=$pagelength;
        $stu_new_data['count']=$count;
        $stu_new_data['pagenum']=ceil($count/$pagelength);
    	
        $stu_new_data=array_slice($stu_new_data, 0);
        
		echo json_encode($stu_new_data);
  }
  
  //managestu_test0403
  
  	public function managestu_test0403()
  	{
        $userid=$_GET['userid'];
        $realname=$_GET['realname'];
        $username=$_GET['username'];
        $stu_id=$_GET['stu_id'];
        $stu_name=$_GET['stu_name'];
        $subject_msg=$_GET['subject_msg'];
        $subject_id=$_GET['subject_id'];
      
        $model_subject_data=M('subject_data');
        $subject_data=$model_subject_data->select();
        $this->assign('subject_data',$subject_data);
      
        $model_questiontypes=M('questiontypes');
      	$questiontypesdata=$model_questiontypes->where('subjectid='.$subject_id)->select();     
      	$this->assign('questiontypes',$questiontypesdata); 
   
      	$this->assign('subject_msg',$subject_msg);
        $this->assign('subject_id',$subject_id);
      
 
        $this->assign('stu_id',$stu_id);
        $this->assign('stu_name',$stu_name);
        $this->assign('userid',$userid);
        $this->assign('realname',$realname);
        $this->assign('username',$username);
      
        $this->display();
  	}
  	
	public function phpmanagestutest0403()
  	{
        $userid=$_POST['userid'];
  
        $nowpage=$_POST['nowpage'];
        $pagelength=$_POST['pagelength'];
        
        
   
       $gradeid=$_POST['gradeid'];
       $subjectid=$_POST['subjectid'];
       $order=$_POST['order'];
       $order=$_POST['order']?$_POST['order']:'asc';
    

     	$beginnum=($nowpage-1)*$pagelength;
     	$beginpagenum=$beginnum-1;
      
      //$subject_id=2;
     // $subject_msg='数学';
     // $stu_id=6;
     // $stu_name='张峰';
   
        $model_mytest=M('mytest');
        $model_paper_msg_data=M('paper_msg_data');
        $model_key_paper_msg_data=M('key_paper_msg_data');
        $model_key_statistic=M('key_statistic');
      	$model_onekeynote=M('onekeynote');
      
      
        $test_arr['userid']=$userid;
        $test_arr['kind']=1;
        $count=$model_mytest->where($test_arr)->count();
 
        $test_data=$model_mytest->where($test_arr)->order('creatime '.$order)->limit($beginnum,$pagelength)->select();
 
      //进入单个习题，进行单个习题数据进行分析
      
      	for($i=0;$i<sizeof($test_data);$i++)
        {
            $keynote_num=0;
          //如果不是知识点
            if($test_data[$i]['keyornot']==0)
            {
               $paper_arr['id']=$test_data[$i]['testid'];
               $paperdata=$model_paper_msg_data->where($paper_arr)->find();
               
               //年级和学科进行判断
               if(!empty($paperdata)) {
               	
               		if(!empty($gradeid) && $paperdata['gradeid']!=$gradeid) {
               			unset($test_data[$i]);
               			$count=$count-1;
               			continue;
               		}
               		
               		if(!empty($subjectid) && $paperdata['subjectid']!=$subjectid) {
               			unset($test_data[$i]);
               			$count=$count-1;
               			continue;
               		}
               }
               
               $papername=$paperdata['paper_name'];
               $test_data[$i]['paper_name']=$papername;
               $test_data[$i]['paper_kind']='school';
               $questionsum=$test_data[$i]['questionsum'];              
              
              //对于知识点进行统计
              if($test_data[$i]['keynote_id']=='')
              {
                  $test_data[$i]['keynotename']='none';
              }
              else
              {
                
                 $key_note_arr=explode(',',$test_data[$i]['keynote_id']);
                 $key_note_count=sizeof($key_note_arr);
                
                 $thiskeynote_msg='';
                //求出知识点的统计信息
                 for($p=0;$p<$key_note_count;$p++)
                 {
                    $thiskeynote_arr['keynote_id']=$key_note_arr[$p];
                    $thiskeynote_arr['userid']=$stu_id;
                    $thiskeynote_data=$model_key_statistic->where($thiskeynote_arr)->find();
                   
                    $onekeynote_data=$model_onekeynote->where('id='.$key_note_arr[$p])->find();
                   	$thiskeynote_name=$onekeynote_data['keynotemsg'];
                   
                    $thiskeynote_msg=$thiskeynote_msg.' '.$thiskeynote_name.'（'.$thiskeynote_data['question_sum'].'）';
                    
                 } 
                 $test_data[$i]['keynotename']=$thiskeynote_msg;
               
                
              }
              
              //统计错题比例
              if($test_data[$i]['ctbtestid']=='')
              {
                 $keynote_num=0;
              }
              else
              {
                $ctbtestid=explode(',',$test_data[$i]['ctbtestid']);
                $ctbnum=sizeof($ctbtestid);
              }
              
               $test_data[$i]['w_ratio']=round(($ctbnum/$questionsum),2);
               $test_data[$i]['paper_ratio']=$ctbnum.'/'.$questionsum;
              
              
            }
          //当是知识点测试的情况下
          else
          {
               $key_paper_arr['id']=$test_data[$i]['testid'];
               $keypaperdata=$model_key_paper_msg_data->where($key_paper_arr)->find();
               $keypapername=$keypaperdata['paper_name'];
               $test_data[$i]['paper_kind']='key';
              
               $questionsum=$test_data[$i]['questionsum'];
              //进行错题统计
              if($test_data[$i]['ctbtestid']=='')
              {
                 $ctbnum=0;
              }
              else
              {
                $ctbtestid=explode(',',$test_data[$i]['ctbtestid']);
                $ctbnum=sizeof($ctbtestid);
              }
              
              
              //进行知识点统计
    		 if($test_data[$i]['keynote_id']=='')
              {
                  $test_data[$i]['keynotename']='none';
              }
              else
              {
                
                 $key_note_arr=explode(',',$test_data[$i]['keynote_id']);
                 $key_note_count=sizeof($key_note_arr);
                
                 $thiskeynote_msg='';
                 for($p=0;$p<$key_note_count;$p++)
                 {
                    $thiskeynote_arr['keynote_id']=$key_note_arr[$p];
                    $thiskeynote_arr['userid']=$stu_id;
                    $thiskeynote_data=$model_key_statistic->where($thiskeynote_arr)->find();
                   
                    $onekeynote_data=$model_onekeynote->where('id='.$key_note_arr[$p])->find();
                   	$thiskeynote_name=$onekeynote_data['keynotemsg'];
                   
                    $thiskeynote_msg=$thiskeynote_msg.' '.$thiskeynote_name.'（'.$thiskeynote_data['question_sum'].'）';
                    
                 } 
                
                 $test_data[$i]['keynotename']=$thiskeynote_msg;           
                
              }
              
                 
               $test_data[$i]['w_ratio']=round(($ctbnum/$questionsum),2);
               $test_data[$i]['paper_ratio']=$ctbnum.'/'.$questionsum;
            }
         }
       
      $test_data['length']=sizeof($test_data);
      $test_data['pagelength']=$pagelength;
      $test_data['count']=$count;
      $test_data['pagenum']=ceil($count/$pagelength);
 
        echo json_encode($test_data);
  	}

    public function dataphpsql0202()
    {
       $userid=$_POST['userid'];
        $nowpage=$_POST['nowpage'];
        $pagelength=$_POST['pagelength'];

        $keywords=$_POST['keywords'];
        $classid=$_POST['classid'];
        $groupid=$_POST['groupid'];
        $gradeid=$_POST['gradeid'];
        


        $beginnum=($nowpage-1)*$pagelength+1;
        $beginpagenum=$beginnum-1;

        $model=M('paper_msg_data');
        $model_test_public=M('test_public_data');
        $model_test_statistic=M('test_statistic');
        $model_class=M('class_data');
        $model_group=M('group_data');

        $array['userid']=$userid;
        $array['statusmsg']=3;
		!empty($keywords) && $array['paper_name']=array('like', "%".$keywords."%");
		!empty($gradeid) && $array['gradeid']=$gradeid;

		//通过试卷数据库查询

        $count=$model->where($array)->count();
       $data = $model->where($array)->order('settime desc')->limit($beginpagenum.','.$pagelength)->select();
      
     // $data = $model->where($array)->order('settime desc')->select();

        for($i=0;$i<sizeof($data);$i++)
        {
            $data[$i]['num']=$beginnum;
            $beginnum=$beginnum+1;

            $test_statistic_data=$model_test_statistic->where('testid='.$data[$i]['id'])->find();

            $classidarr=$test_statistic_data['classidarr'];
            $groupidarr=$test_statistic_data['groupidarr'];


            $classidarr=explode('-',$classidarr);
            $groupidarr=explode('-',$groupidarr);
            $classname='';
            $groupname='';


            if(!empty($classid) && !in_array($classid,$classidarr)) {
            	 unset($data[$i]);
            	 $count=$count-1;
            	 continue;
            }
            
            if(!empty($groupid) && !in_array($groupid,$groupidarr)) {
            	 unset($data[$i]);
            	 $count=$count-1;
            	 continue;
            }
            
            for($j=0;$j<sizeof($classidarr);$j++)
            {
//                echo $classidarr[$j].'<hr>';
               $class_data= $model_class->where('id='.$classidarr[$j])->find();
               $classname=$classname.','.$class_data['classname'];
            }
            $classname=substr($classname,1);
            $data[$i]['class']=$classname;
            

            for($j=0;$j<sizeof($groupidarr);$j++)
            {
                $group_data= $model_group->where('id='.$groupidarr[$j])->find();
                $groupname=$groupname.','.$group_data['groupname'];
            }

            $groupname=substr($groupname,1);
            $data[$i]['group']=$groupname;
            $data[$i]['class']=$classname;

        }
      
      //这里修改群主查询和班级查询

      
      //这里修改群主查询和班级查询

        $data['userid']=$userid;
        $data['length']=$beginnum-1;
        $data['pagelength']=$pagelength;
        $data['count']=$count;
        $data['pagenum']=ceil($count/$pagelength);

       //print_r($data);
        echo json_encode($data);
    }

    public function republicsub()
    {
        $id=$_POST['testid'];
//        $id=1538;

        $model_test_statistic=M('test_statistic');
        $model_mytest=M('mytest');
        $model_class_statistic=M('class_statistic');

        $model_test_send_class=M('test_send_class');
        $model_question_statistic=M('question_statistic');
        $model_paper_msg_data=M('paper_msg_data');

        //修改试卷信息，把状态修改成1，试卷处理完成，待提交状态。
        $paper_arr['statusmsg']=2;

        $model_paper_msg_data->where('id='.$id)->save($paper_arr);


        //提取统计数据，清理试题统计表
        $test_data=$model_test_statistic->where('testid='.$id)->find();
        $model_test_statistic->where('testid='.$id)->delete();


        // 通过个人习题，提出来错题的数组
        $mytest_data=$model_mytest->where('testid='.$id)->select();


        $ctbtestid_msg='';
        for($i=0;$i<sizeof($mytest_data);$i++)
        {
            if($mytest_data[$i]['ctbtestid']!='')
            {
                $ctbtestid_msg=$ctbtestid_msg.','.$mytest_data[$i]['ctbtestid'];
            }
        }
        $ctbtestid_msg=substr($ctbtestid_msg,1);
        $ctbtestid_arr=explode(',',$ctbtestid_msg);
        $ctbtestid_arr=uniquearr($ctbtestid_arr);




        //删除掉个人习题中的部分，修改成删除
        $model_mytest->where('testid='.$id)->delete();


        //清理班级统计表
        $classidarr=explode('-',$test_data['classidarr']);



        for($i=0;$i<sizeof($classidarr);$i++)
        {
            $classid=$classidarr[$i];
            $testid=$id;
            $class_data=$model_class_statistic->where('classid='.$classid)->find();

            $testidarr=explode(',',$class_data['testidarr']);

            $testidarr_msg='';


            $time_arr_msg='';
            $time_arr=explode(',',$class_data['time_arr']);
            $wrong_ratio_arr_msg='';
            $wrong_ratio_arr=explode(',',$class_data['wrong_ratio_arr']);
            $subject_arr_msg='';
            $subject_arr=explode(',',$class_data['subject_arr']);
            $classnum_msg='';
            $classnum=explode(',',$class_data['classnum']);
            $group_arr_msg='';//+
            $group_arr=explode('+',$class_data['group_arr']);

            $g1_num_msg='';
            $g1_num=explode(',',$class_data['g1_num']);
            $g2_num_msg='';
            $g2_num=explode(',',$class_data['g2_num']);
            $g3_num_msg='';
            $g3_num=explode(',',$class_data['g3_num']);

            $g1_wrong_ratio_arr_msg='';
            $g1_wrong_ratio_arr=explode(',',$class_data['g1_wrong_ratio_arr']);
            $g2_wrong_ratio_arr_msg='';
            $g2_wrong_ratio_arr=explode(',',$class_data['g2_wrong_ratio_arr']);
            $g3_wrong_ratio_arr_msg='';
            $g3_wrong_ratio_arr=explode(',',$class_data['g3_wrong_ratio_arr']);


            for($m=0;$m<sizeof($testidarr);$m++)
            {


                if($testidarr[$m]!=$testid)
                {
                    $testidarr_msg=$testidarr_msg.','.$testidarr[$m];
                    $time_arr_msg=$time_arr_msg.','.$time_arr[$m];

                    $wrong_ratio_arr_msg=$wrong_ratio_arr_msg.','.$wrong_ratio_arr[$m];
                    $subject_arr_msg=$subject_arr_msg.','.$subject_arr[$m];

                    $classnum_msg=$classnum_msg.','.$classnum[$m];
                    $group_arr_msg=$group_arr_msg.'+'.$group_arr[$m];


                    $g1_num_msg=$g1_num_msg.','.$g1_num[$m];
                    $g2_num_msg=$g2_num_msg.','.$g2_num[$m];
                    $g3_num_msg=$g3_num_msg.','.$g3_num[$m];

                    $g1_wrong_ratio_arr_msg=$g1_wrong_ratio_arr_msg.','.$g1_wrong_ratio_arr[$m];
                    $g2_wrong_ratio_arr_msg=$g2_wrong_ratio_arr_msg.','.$g2_wrong_ratio_arr[$m];
                    $g3_wrong_ratio_arr_msg=$g3_wrong_ratio_arr_msg.','.$g3_wrong_ratio_arr[$m];


                }
            }

            $class_statistic_arr['testidarr']=substr($testidarr_msg,1);
            $class_statistic_arr['time_arr']=substr($time_arr_msg,1);

            $class_statistic_arr['wrong_ratio_arr']=substr($wrong_ratio_arr_msg,1);
            $class_statistic_arr['subject_arr']=substr($subject_arr_msg,1);

            $class_statistic_arr['classnum']=substr($classnum_msg,1);
            $class_statistic_arr['group_arr']=substr($group_arr_msg,1);

            $class_statistic_arr['g1_num']=substr($g1_num_msg,1);
            $class_statistic_arr['g2_num']=substr($g2_num_msg,1);
            $class_statistic_arr['g3_num']=substr($g3_num_msg,1);

            $class_statistic_arr['g1_wrong_ratio_arr']=substr($g1_wrong_ratio_arr_msg,1);
            $class_statistic_arr['g2_wrong_ratio_arr']=substr($g2_wrong_ratio_arr_msg,1);
            $class_statistic_arr['g3_wrong_ratio_arr']=substr($g3_wrong_ratio_arr_msg,1);


            if($class_statistic_arr['testidarr']=='')
            {
                //删除，修改班级统计数据
                $model_class_statistic->where('classid='.$classid)->delete();
            }else
            {
                $model_class_statistic->where('classid='.$classid)->save($class_statistic_arr);
            }
        }




        //清除掉习题发送统计的数据
       $model_test_send_class->where('testid='.$id)->delete();

        //处理习题统计的部分


        if($ctbtestid_arr[0]=='')
        {
            echo 1;
            return;
        }

        $testid=$id;



        for($i=0;$i<sizeof($ctbtestid_arr);$i++)
        {
            $question_data=$model_question_statistic->where('question_id='.$ctbtestid_arr[$i])->find();

            $testidarr=explode(',',$question_data['testidarr']);
            $classidarr=explode(',',$question_data['classidarr']);


            $g1_w_num_arr=explode(',',$question_data['g1_w_num_arr']);
            $g2_w_num_arr=explode(',',$question_data['g2_w_num_arr']);
            $g3_w_num_arr=explode(',',$question_data['g3_w_num_arr']);
            $other_w_num_arr=explode(',',$question_data['other_w_num_arr']);
            $all_w_num_arr=explode(',',$question_data['all_w_num_arr']);

            $g1_sum_arr=explode(',',$question_data['g1_sum_arr']);
            $g2_sum_arr=explode(',',$question_data['g2_sum_arr']);
            $g3_sum_arr=explode(',',$question_data['g3_sum_arr']);
            $other_sum_arr=explode(',',$question_data['other_sum_arr']);
            $all_sum_arr=explode(',',$question_data['all_sum_arr']);

            $testtimearr=explode('+',$question_data['testtimearr']);
            $useridarr=explode(',',$question_data['useridarr']);
            $schoolidarr=explode(',',$question_data['schoolidarr']);




            $testidarr_msg='';
            $classidarr_msg='';

            $g1_w_num_arr_msg='';
            $g2_w_num_arr_msg='';
            $g3_w_num_arr_msg='';
            $other_w_num_arr_msg='';
            $all_w_num_arr_msg='';

            $g1_sum_arr_msg='';
            $g2_sum_arr_msg='';
            $g3_sum_arr_msg='';
            $other_sum_arr_msg='';
            $all_sum_arr_msg='';

            $testtimearr_msg='';
            $useridarr_msg='';
            $schoolidarr_msg='';

            for($j=0;$j<sizeof($testidarr);$j++)
            {

                if($testid!=$testidarr[$j])
                {
                    $testidarr_msg=$testidarr_msg.','.$testidarr[$j];
                    $classidarr_msg=$classidarr_msg.','.$classidarr[$j];

                    $g1_w_num_arr_msg=$g1_w_num_arr_msg.','.$g1_w_num_arr[$j];
                    $g2_w_num_arr_msg=$g2_w_num_arr_msg.','.$g2_w_num_arr[$j];
                    $g3_w_num_arr_msg=$g3_w_num_arr_msg.','.$g3_w_num_arr[$j];
                    $other_w_num_arr_msg=$other_w_num_arr_msg.','.$other_w_num_arr[$j];
                    $all_w_num_arr_msg=$all_w_num_arr_msg.','.$all_w_num_arr[$j];


                    $g1_sum_arr_msg=$g1_sum_arr_msg.','.$g1_sum_arr[$j];
                    $g2_sum_arr_msg=$g2_sum_arr_msg.','.$g2_sum_arr[$j];
                    $g3_sum_arr_msg=$g3_sum_arr_msg.','.$g3_sum_arr[$j];
                    $other_sum_arr_msg=$other_sum_arr_msg.','.$other_sum_arr[$j];
                    $all_sum_arr_msg=$all_sum_arr_msg.','.$all_sum_arr[$j];

                    $testtimearr_msg=$testtimearr_msg.'+'.$testtimearr[$j];
                    $useridarr_msg=$useridarr_msg.','.$useridarr[$j];
                    $schoolidarr_msg=$schoolidarr_msg.','.$schoolidarr[$j];
                }

            }

            $questioinarr['testidarr']=substr($testidarr_msg,1);
            $questioinarr['classidarr']=substr($classidarr_msg,1);

            $questioinarr['g1_w_num_arr']=substr($g1_w_num_arr_msg,1);
            $questioinarr['g2_w_num_arr']=substr($g2_w_num_arr_msg,1);
            $questioinarr['g3_w_num_arr']=substr($g3_w_num_arr_msg,1);
            $questioinarr['other_w_num_arr']=substr($other_w_num_arr_msg,1);
            $questioinarr['all_w_num_arr']=substr($all_w_num_arr_msg,1);

            $questioinarr['g1_sum_arr']=substr($g1_sum_arr_msg,1);
            $questioinarr['g2_sum_arr']=substr($g2_sum_arr_msg,1);
            $questioinarr['g3_sum_arr']=substr($g3_sum_arr_msg,1);
            $questioinarr['other_sum_arr']=substr($other_sum_arr_msg,1);
            $questioinarr['all_sum_arr']=substr($all_sum_arr_msg,1);

            $questioinarr['testtimearr']=substr($testtimearr_msg,1);
            $questioinarr['useridarr']=substr($useridarr_msg,1);
            $questioinarr['schoolidarr']=substr($schoolidarr_msg,1);


//清楚或修改试题统计数据
            if($testidarr_msg=='')
            {
                $question_data=$model_question_statistic->where('question_id='.$ctbtestid_arr[$i])->find();
            }
            else
            {
                $model_question_statistic->where('question_id='.$ctbtestid_arr[$i])->save($questioinarr);
            }

        }

        echo 1;


    }
  
  public function keynote_data_php()
  {
     $subject_id=$_POST['subject_id'];
     $model_onekeynote=M('onekeynote');
     $onekeynote_arr['subjectid']=$subject_id;
     $onekeynote_arr['delornot']=1;
     $onekeynote_data=$model_onekeynote->where($onekeynote_arr)->select();
     $onekeynote_data=turnArray($onekeynote_data);
     $onekeynote_data['count']=sizeof($onekeynote_data);
     echo json_encode($onekeynote_data);
    
  }
  
  public function my_keynote_data_php()
  {
       $subject_id=$_POST['subject_id'];
       $stu_id=$_POST['stu_id'];
    
      // $subject_id=2;
      // $stu_id=152;
    
       $key_statistic_arr['subject_id']=$subject_id;
       $key_statistic_arr['userid']=$stu_id;
    
       $model_key_statistic=M('key_statistic');
       $model_onekeynote=M('onekeynote');
    
       $key_statistic_data=$model_key_statistic->where($key_statistic_arr)->select();
    
       $count=sizeof($key_statistic_data);
    
       for($i=0;$i<$count;$i++)
       {
          $onekeynotedata=$model_onekeynote->where('id='.$key_statistic_data[$i]['keynote_id'])->find();
          $key_statistic_data[$i]['keynotemsg']=$onekeynotedata['keynotemsg'];
       }
    
      $key_statistic_data['count']=sizeof($key_statistic_data);
      echo json_encode($key_statistic_data);
  }
  
  public function inputkeynotesub()
  {
     $subject_id=$_POST['subject_id'];
     $stu_id=$_POST['stu_id'];
     $keynote_arr=$_POST['keynote_arr'];
     $checktestid=$_POST['checktestid'];
    
     //$subject_id=2;
     //$stu_id=152;
     //$keynote_arr='44,45,42,43,000';
     //$checktestid='1543,1545,1544';
    
     $model_mytest=M('mytest');
     $model_key_statistic=M('key_statistic');
     $checktest_arr=explode(',',$checktestid);
    
    
    //更新mytest的keynote_id
     for($i=0;$i<sizeof($checktest_arr);$i++)
     {
         $mytest_arr['testid']=$checktest_arr[$i];
         $mytest_arr['userid']=$stu_id;
       
         $mytest_data=$model_mytest->where($mytest_arr)->find();
       
         $mytest_id=$mytest_data['id'];
       
        if($mytest_data['keynote_id']=='')
        {
          $newmytest_data['keynote_id']=$keynote_arr;
        }
         else
        {
         $midtest=$mytest_data['keynote_id'].','.$keynote_arr; 
         $midtest=explode(',',$midtest);
   		 $midtest=array_unique($midtest);
    	 $midtest=implode(',',$midtest);
         $newmytest_data['keynote_id']=$midtest;   
           
        }
       $model_mytest->where('id='.$mytest_id)->save($newmytest_data);
     }
    
    //插入知识点统计信息
    $keynote_arr=explode(',',$keynote_arr);
    for($i=0;$i<sizeof($keynote_arr);$i++)
    {
       $key_arr['keynote_id']=$keynote_arr[$i];
       $key_arr['userid']=$stu_id;
      
      
       $datetime=new\DateTime;
	   $creattime=$datetime->format('Y-m-d H:i:s');
      
       $key_static_data=$model_key_statistic->where($key_arr)->find();
       if($key_static_data['id']<=0)
       {
        $key_arr['creattime']=$creattime;
        $key_arr['subject_id']=$subject_id;
        $key_static_data=$model_key_statistic->add($key_arr);
       }
      else
      {
        $newkey_arr['keynote_id']=$keynote_arr[$i];
        $newkey_arr['userid']=$stu_id;
        $newkey_arr['creattime']=$creattime;
        $newkey_arr['subject_id']=$subject_id;
        $model_key_statistic->where($key_arr)->save($newkey_arr);
      }
    }
    
    
    
    
  }
  
  public function phpkeymsg0405()
  {
     $subject_id=$_POST['subjectid'];
     $stu_id=$_POST['stu_id'];
     $nowpage=$_POST['nowpage'];
     $pagelength=$_POST['pagelength'];
     $kind=$_POST['kind'];
     $gradeid=$_POST['gradeid'];
    

     $beginnum=($nowpage-1)*$pagelength+1;
     $beginpagenum=$beginnum-1;
    
    
     $model_key_statistic=M('key_statistic');
     $model_onekeynote=M('onekeynote');
     $model_key_stumytest=M('key_stumytest');
    
     !empty($subject_id) && $key_arr['subject_id']=$subject_id;
     $key_arr['userid']=$stu_id;
     $key_arr['kind']=$kind;
    
     $count=$model_key_statistic->where($key_arr)->count();
     $key_data=$model_key_statistic->where($key_arr)->order('creattime desc')->limit($beginpagenum.','.$pagelength)->select();
    
      
    
     for($i=0;$i<sizeof($key_data);$i++)
     {
       $id=$key_data[$i]['keynote_id'];

       $wrong_key_arr['kind']=1;
       $wrong_key_arr['keynote_id']=$id;
       $wrong_key_arr['userid']=$stu_id;
       
       
       $wrong_key_data=$model_key_stumytest->where($wrong_key_arr)->order('lastreadtime desc')->select();     
       
         
       $ctb_key_data=explode(',',$wrong_key_data[0]['ctbtestid']);
       
       if($ctb_key_data[0]['ctbtestid']=='')
       {
         $question_w=0;
       }
       else
       {
          $question_w=sizeof($ctb_key_data);
         
       }
         
       $question_sum=$wrong_key_data[0]['questionsum'];
       
       if($question_sum==0)
       {
         $key_data[$i]['ratio']=0;
       }
       else
       {
         $key_data[$i]['ratio']=round(($question_w/$question_sum)*100);
       }
       
     //  echo $key_data[$i]['ratio'].'<br>';
       
       
       $onekeydata=$model_onekeynote->where('id='.$id)->find();
       $key_data[$i]['keynotemsg']=$onekeydata['keynotemsg'];
       
       //年级判断
       if(!empty($gradeid) && $gradeid!=$onekeydata['gradeid']) {
       		unset($key_data[$i]);
       		$count=$count-1;
       		continue;
       }
       
       if($key_data[$i]['creattime']!='')
       {
          $timestrap=strtotime($key_data[$i]['creattime']);
          $key_data[$i]['creattime']=date("Y-m-d",$timestrap);
       }
       
       if($key_data[$i]['lasttime']!='')
       {
          $timestrap=strtotime($key_data[$i]['lasttime']);
          $key_data[$i]['lasttime']=date("Y-m-d",$timestrap);
       }
       

     
       //$key_data[$i]['lasttime']=date("Y-m-d",$key_data[$i]['lasttime']);
       
  
       
        $key_data[$i]['num']=$beginnum;
        $beginnum=$beginnum+1;
       
       
     }
    
      $key_data['length']=sizeof($key_data);
      $key_data['pagelength']=$pagelength;
      $key_data['count']=$count;
      $key_data['pagenum']=ceil($count/$pagelength);
    
     echo json_encode($key_data);
    
    //print_r($key_data);
    

  }
  
  
  public function managestu_keylist0405() 
  {
   
     $subject_id=$_GET['subject_id'];
     $stu_id=$_GET['stu_id'];
     $stu_name=$_GET['stu_name'];
    
     $model_subject_data=M('subject_data');
     $subject_data=$model_subject_data->select();
    
     $this->assign('userid',$_GET['userid']); 
     $this->assign('stu_id',$_GET['stu_id']); 
     $this->assign('stu_name',$_GET['stu_name']); 
     $this->assign('username',$_GET['username']); 
     $this->assign('realname',$_GET['realname']); 
     $this->assign('subject_id',$_GET['subject_id']); 
     $this->assign('subject_data',$subject_data); 
 
    
    //print_r($key_data);
     $this->display();
  }
  
 
  
  public function statistic()
  {

    $data = array(
 	array('times'=>'3','wrong'=>'12'),
 	array('times'=>'5','wrong'=>'13'),
 	array('times'=>'6','wrong'=>'14')
 	);
    
    $data=json_encode($data);
    $this->assign('data',$data);
    $this->display();
  }
  
  public function phpcanceltestdata()
  {
     $keynote_id=$_POST['keynote_id'];
     $stu_id=$_POST['stu_id'];  
     $kind=$_POST['kind']; 
     $model_key_statistic=M('key_statistic');
    
     $key_arr['keynote_id']=$keynote_id;
     $key_arr['userid']=$stu_id;
    
   if($kind==1)
   {
     $result['kind']=0;
   }
    else
    {
       $result['kind']=1;
    }
     echo $model_key_statistic->where($key_arr)->save($result);

  }
  
  public function keystatistic()
  {
     $keynote_id=$_GET['keynote_id'];
     $stu_id=$_GET['stu_id']; 
     $kind=1;
      
    $userid=$_GET['userid'];
    $username=$_GET['username'];
    $realname=$_GET['realname'];
    $keynote_id=$_GET['keynote_id'];
    $stu_id=$_GET['stu_id'];
    $stu_name=$_GET['stu_name'];
    $subject_id=$_GET['subject_id'];
    $keynotemsg=$_GET['keynotemsg'];
    
    $this->assign('userid',$userid);
    $this->assign('username',$username);
    $this->assign('realname',$realname);
    $this->assign('keynote_id',$keynote_id);
    $this->assign('stu_id',$stu_id);
    $this->assign('stu_name',$stu_name);
    $this->assign('subject_id',$subject_id);
    $this->assign('keynotemsg',$keynotemsg);
    
    $year=$_GET['year'];
    $min=$_GET['min'];
    $max=$_GET['max'];
 
    
    
    $this->assign('year',$year);
 
    $key_arr['keynote_id']=$keynote_id;
    $key_arr['userid']=$stu_id;
    $key_arr['kind']=$kind;
    !empty($year) && $key_arr["DATE_FORMAT(creatime,'%Y')"]=$year;
    
    $model_key_stumytest=M('key_stumytest');
    
    
    //时间获取
    $yearAry=array();
    $timeData=$model_key_stumytest->select();
    for($i=0;$i<sizeof($timeData);$i++)
    {
	    if(!in_array(date('Y',strtotime($timeData[$i]['creatime'])),$yearAry)) {
	    	$yearAry[]=date('Y',strtotime($timeData[$i]['creatime']));
	    }
    }
    
    $key_data=$model_key_stumytest->where($key_arr)->order('lastreadtime asc')->select();
    
    $count=sizeof($key_data);
    
    
    
    for($i=0;$i<$count;$i++)
    {
      $new_key_data[$i]['num']=$i+1;
      
       $new_key_data[$i]['year']=date('y',strtotime($key_data[$i]['lastreadtime']));
       
      
       $new_key_data[$i]['month']=date('m',strtotime($key_data[$i]['lastreadtime']));
       $new_key_data[$i]['lastreadtime']=date('y-m-d',strtotime($key_data[$i]['lastreadtime']));
      
      if($key_data[$i]['questionsum']=='')
      {
         $new_key_data[$i]['ratio']=0;
      }
      else
      {
        if($key_data[$i]['ctbtestid']=='')
        {
           $new_key_data[$i]['ratio']=0;
        }
        else
        {
          $questionsum=$key_data[$i]['questionsum'];
          $questionw=sizeof(explode(',',$key_data[$i]['ctbtestid']));
          $new_key_data[$i]['ratio']=(round(($questionw/$questionsum),3));

        }
      }
    }
    
    
    
    //num（序号） 为横轴，ratio（错题率） 为纵轴，纵轴0-100区间，month为考试月份，year为考试年份，lastreadtime为考试时间
    //弹出对话框
    
    $charData=array();
    foreach($new_key_data as $k=>$v)
    {
    	$charData[$k]['num']=$v['num'];
    	$charData[$k]['ratio']=$v['ratio'];
    }
    
    $premin=1;
    if(!empty($min) && !empty($max)) {
    	$charData=array_slice($charData, 0,$max-$min+1);
    	$countTotal=$max;
    	$premin=$min;
    }
    rsort($yearAry);
    $data=json_encode($charData);
    $this->assign('data',$data);
    $this->assign('countTotal',$countTotal);
    $this->assign('count',$count);
    $this->assign('premin',$premin);
    $this->assign('yearAry',$yearAry);
   
    $this->display();
  }
  
  
}
?>