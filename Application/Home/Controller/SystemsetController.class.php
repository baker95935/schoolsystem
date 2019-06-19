<?php
namespace Home\Controller;

use Think\Controller;

class SystemsetController extends Controller
{
    public function systemset_01()
    {
        $model_school = M('school_data');
        $model = M('user_data');
        if (IS_POST) {


        } else {
//管理员
            $arr['status'] = array('eq', '100');

            import('ORG.Util.Page');// 导入分页类

            $count = $model->where($arr)->order('regtime desc')->count();
            $page = new \Think\Page($count, 1);// 实例化分页类 传入总记录数并且每页显示5条记录
            $nowPage = isset($_GET['p']) ? $_GET['p'] : 1;
            $admindata = $model->where($arr)->order('regtime desc')->page($nowPage . ',' . $page->listRows)->select();
 
            $show = $page->show();// 分页显示输出
 
            $this->assign('adminpage', $show);// 赋值分页输出
            $this->assign('admindata', $admindata);// 赋值分页输出
 
//教师
            $arr['status'] = array('eq', '1');

            import('ORG.Util.Page');// 导入分页类

            $count = $model->where($arr)->order('regtime desc')->count();
            $tec_page = new \Think\Page($count, 6);// 实例化分页类 传入总记录数并且每页显示5条记录
            $tec_nowPage = isset($_GET['p']) ? $_GET['p'] : 1;
            $tecdata = $model->where($arr)->order('regtime desc')->page($tec_nowPage . ',' . $tec_page->listRows)->select();
            $tec_show = $tec_page->show();// 分页显示输出

            $this->assign('tecpage', $tec_show);// 赋值分页输出
            $this->assign('tecdata', $tecdata);// 赋值分页输出

        }


        $this->display();

    }

    public function php_person_sql()
    {
        $begin = $_POST[begin];
        $length = $_POST[length];
        $kind = $_POST[kind];
      
      //  $begin=1;
        //$length=6;
       // $kind='admin';


        $begin = ($begin - 1) * $length;


        $model_school = M('school_data');
        $model = M('user_data');

        switch ($kind) {
            case 'admin':
                $arr['status'] = array('eq', '100');
                $kindmsg = '管理员';
                break;
            case 'tec':
                $arr['status'] = array('in', '2,3');
                $kindmsg = '教师';
                break;
            case 'stu':
                $arr['status'] = array('eq', '0');
                $kindmsg = '学生';
                break;
            case 'pare':
                $arr['status'] = array('eq', '1');
                $kindmsg = '家长';
                break;

        }

        $admin_all_count = $model->where($arr)->order('regtime desc')->count();

        $admin_page_sum = ceil($admin_all_count / $length);
        $admin_begin_page = ceil(($begin + 1) / 6);
        $admindata = $model->where($arr)->limit($begin, $length)->order('regtime desc')->select();

        $admin_count = sizeof($admindata);
      
      
        for ($i = 0; $i < $admin_count; $i++) {
            $admindata[$i]['regtime'] = date('Y-m-d', strtotime($admindata[$i]['regtime']));
          
           if($admindata[$i]['schoolid']!='')
           {
            	$schoolmsg = $model_school->where('school_id='.$admindata[$i]['schoolid'])->find();
            	$admindata[$i]['schoolname'] = $schoolmsg['schoolname'];
           }
          else
          {
            $admindata[$i]['schoolname'] ='System';
          }
          

            $admindata[$i]['status'] = $kindmsg;
        }
        $admindata['admin_begin_page'] = $admin_begin_page;
        $admindata['admin_page_sum'] = $admin_page_sum;
        $admindata['admin_count'] = $admin_count;
        echo json_encode($admindata);

    }

    public function php_newdata_sql()
    {
        $admin_username = $_POST[admin_username];
        $admin_realname = $_POST[admin_realname];
        $admin_status = $_POST[admin_status];
        $admin_pwd = $_POST[admin_pwd];
        //$model=M('user_data');
        $userdata['username'] = $admin_username;
        $userdata['realname'] = $admin_realname;
        $userdata['status'] = $admin_status;
        $userdata['pwd'] = $admin_pwd;
        $userdata['schoolid'] = '';
        $userdata['regtime'] = date("Y-m-d h:i:s");
        $userdata['imgsrc'] = '';
        echo D('user_data')->add($userdata);

    }


    public function php_newschool_data_sql()
    {

       // 测试学校,1212,1212,2018-02-02,2018-02-03,0,1,3,4

        $schoolname = $_POST[schoolname];
        $linkman = $_POST[linkman];
        $phone = $_POST[phone];
        $starttime = $_POST[starttime];
        $endtime = $_POST[endtime];
        $areaid = $_POST[areaid];
        $levelnum = $_POST[levelnum];
        $gradecount = $_POST[gradecount];
        $classcount = $_POST[classcount];
		
        $school_id=$_POST['school_id'];


        //$model=M('user_data');
        $schooldata['schoolname'] = $schoolname;
        $schooldata['linkman'] = $linkman;
        $schooldata['phone'] = $phone;
        $schooldata['starttime'] = $starttime;
        $schooldata['endtime'] = $endtime;
        $schooldata['areaid'] = $areaid;
        $schooldata['levelnum'] = $levelnum;
        $schooldata['gradecount'] = $gradecount;
        $schooldata['classcount'] = $classcount;


        $res=0;
        if($school_id) {
        	$res=1;
        	$school_id=D('school_data')->where('school_id='.$school_id)->save($schooldata);
        } else {
        	$school_id=D('school_data')->add($schooldata);
        }



//
        $y = Date("Y");
        $begin_y = $y - $gradecount +1;
        $end_y = $y;
        $j = 1;

        for ($i = $begin_y; $i <= $end_y; $i++) {
            for ($m = 1; $m <= $classcount; $m++) {
                if ($m < 10) {
                    $m = '0' . $m;
                }
                $class_y[$j][$m] = ($i % 100) . $m;
            }
            $j = $j + 1;
        }

        foreach ($class_y as $key => $value) {
            foreach ($value as $keym => $valuem) {
                $class_data['classname']=$valuem;
                $class_data['school_id']=$school_id;

                $class_year=intval($valuem/100);
                if($class_year<10)
                {
                    $class_year='0'.$class_year;
                }

                $class_year='20'.$class_year;


               $class_data['TimeofEnrollment']=$class_year;

                D('class_data')->add($class_data);
            }

        }
        
        echo $res;

    }

    public function php_school_sql()
    {
        $begin = $_POST[begin];
        $length = $_POST[length];
//        $begin=1;
//        $length=6;

        $begin = ($begin - 1) * $length;


        $model_school = M('school_data');
        $model_class = M('class_data');

        $schooldata = $model_school->limit($begin, $length)->order('endtime desc')->select();
        $school_count = sizeof($schooldata);

        $school_all_count = $model_school->count();

        $school_page_sum = ceil($school_all_count / $length);
        $school_begin_page = ceil(($begin + 1) / 6);


        for ($i = 0; $i < $school_count; $i++) {

            $schooldata[$i]['endtime'] = substr($schooldata[$i]['endtime'],0,10);

            $schoollevel = $schooldata[$i]['levelnum'];

            $classarray['school_id'] = $schooldata[$i]['school_id'];

            $classcount = $model_class->where($classarray)->count();

            $schooldata[$i]['classcount'] = $classcount;


            switch ($schoollevel) {
                case 1:
                    $schooldata[$i]['levelmsg'] = '小学';
                    break;
                case 2:
                    $schooldata[$i]['levelmsg'] = '初中';
                    break;
                case 3:
                    $schooldata[$i]['levelmsg'] = '高中';
                    break;
            }
        }

        $schooldata['school_begin_page'] = $school_begin_page;
        $schooldata['school_page_sum'] = $school_page_sum;
        $schooldata['school_count'] = $school_count;

//        print_r($schooldata);

      echo json_encode($schooldata);

    }


    public function test()
    {

        //php_keynote_sql
    }

    public function php_chaptermsg_sql()
    {
        $begin = $_POST[begin];
        $length = $_POST[length];


        $begin = ($begin - 1) * $length;


        $model_keynote = M('keynote_data');
        $model_subject = M('subject_data');
        $model_grade = M('grade_data');
        $model_chapter=M('chapter_msg');

        $chapterdata = $model_chapter->limit($begin, $length)->order('subjectid,gradeid,orderid asc')->select();
        $chapter_count = sizeof($chapterdata);

        $chapter_all_count = $model_chapter->count();

        $chapter_page_sum = ceil($chapter_all_count / $length);
        $chapter_begin_page = ceil(($begin + 1) / 6);

        for ($i = 0; $i < $chapter_count; $i++) {
            $subjectid= $chapterdata[$i]['subjectid'];
            $gradeid=$chapterdata[$i]['gradeid'];

            $grade=$model_grade->where('id='.$gradeid)->find();
            $subject=$model_subject->where('id='.$subjectid)->find();

            $chapterdata[$i]['subjectmsg']=$subject['subjectmsg'];

            $chapterdata[$i]['grademsg']=$grade['grademsg'];


        }
//
        $chapterdata['chaptermsg_begin_page'] = $chapter_begin_page;
        $chapterdata['chaptermsg_page_sum'] = $chapter_page_sum;
        $chapterdata['chaptermsg_count'] = $chapter_count;

//         print_r($chapterdata);
//
         echo json_encode($chapterdata);
//
    }


    public function php_part_sql()
    {
        $begin = $_POST[begin];
        $length = $_POST[length];

        $begin = ($begin - 1) * $length;


        $model_keynote = M('keynote_data');
        $model_subject = M('subject_data');
        $model_grade = M('grade_data');
        $model_chapter=M('chapter_msg');

//gradeid
        $keynotedata = $model_keynote->limit($begin, $length)->order('subjectid,gradeid,chapter,orderid asc')->select();
        $keynote_count = sizeof($keynotedata);

        $keynote_all_count = $model_keynote->count();

        $keynote_page_sum = ceil($keynote_all_count / $length);
        $keynote_begin_page = ceil(($begin + 1) / 6);


        for ($i = 0; $i < $keynote_count; $i++) {
             $subjectid= $keynotedata[$i]['subjectid'];
             $gradeid=$keynotedata[$i]['gradeid'];
             $chapterid=$keynotedata[$i]['chapter'];

             $grade=$model_grade->where('id='.$gradeid)->find();
             $subject=$model_subject->where('id='.$subjectid)->find();
             $chapter=$model_chapter->where('id='.$chapterid)->find();


             $keynotedata[$i]['subjectmsg']=$subject['subjectmsg'];
             $keynotedata[$i]['levelmsg']=$grade['levelmsg'];
             $keynotedata[$i]['grademsg']=$grade['grademsg'];
             $keynotedata[$i]['chapter']=$chapter['chaptermsg'];



                if($keynotedata[$i]['akeynotemsg']!=''|| $keynotedata[$i]['akeynotemsg']!='NULL')
                {
                    if($keynotedata[$i]['akeynote_id']=='subject')
                    {
                        $keynotedata[$i]['keynoteornot']='subject';
                    }

                    if($keynotedata[$i]['akeynote_id']=='all')
                    {
                        $keynotedata[$i]['keynoteornot']='all';
                    }

                    if($keynotedata[$i]['akeynote_id']!='all' && $keynotedata[$i]['akeynote_id']!='subject')
                    {
                        $keynotedata[$i]['keynoteornot']='知识点';
                    }
                }
                else
                {
                    $keynotedata[$i]['keynoteornot']='';
                }
        }

        $keynotedata['part_begin_page'] = $keynote_begin_page;
        $keynotedata['part_page_sum'] = $keynote_page_sum;
        $keynotedata['part_count'] = $keynote_count;


      echo json_encode($keynotedata);

    }

    public function php_onekeynote_sql()
    {
        $begin = $_POST[begin];
        $length = $_POST[length];

        $begin = ($begin - 1) * $length;


        $model_keynote = M('onekeynote');
        $model_subject = M('subject_data');
        $model_grade = M('grade_data');

        $keynotedata = $model_keynote->where('delornot=1')->limit($begin, $length)->order('subjectid,gradeid,orderid asc')->select();

       // $keynotedata = $model_keynote->limit($begin, $length)->order('orderid asc')->select();
        $keynote_count = sizeof($keynotedata);

        $keynote_all_count = $model_keynote->where('delornot=1')->count();

        $keynote_page_sum = ceil($keynote_all_count / $length);
        $keynote_begin_page = ceil(($begin + 1) / 4);


        for ($i = 0; $i < $keynote_count; $i++) {
            $subjectid = $keynotedata[$i]['subjectid'];
            $gradeid = $keynotedata[$i]['gradeid'];

            !empty($gradeid) && $grade = $model_grade->where('id=' . $gradeid)->find();

            !empty($subjectid) && $subject = $model_subject->where('id=' . $subjectid)->find();
            
            !empty($subject) && $keynotedata[$i]['subjectmsg'] = $subject['subjectmsg'];
            !empty($grade) && $keynotedata[$i]['grademsg'] = $grade['grademsg'];
            !empty($grade) && $keynotedata[$i]['levelmsg'] = $grade['levelmsg'];

        }
        $keynotedata['onekeynote_begin_page'] = $keynote_begin_page;
        $keynotedata['onekeynote_page_sum'] = $keynote_page_sum;
        $keynotedata['onekeynote_count'] = $keynote_count;


        echo json_encode($keynotedata);


    }

    public function php_questiontypes_sql()
    {
        $begin = $_POST[begin];
        $length = $_POST[length];
        $subjectid = $_POST[subject];


        $begin = ($begin - 1) * $length;


        $model_keynote = M('onekeynote');
        $model_subject = M('subject_data');
        $model_questiontypes = M('questiontypes');


        if($subjectid==1000)
        {
            $questiontypesdata = $model_questiontypes->limit($begin, $length)->order('orderid asc')->select();
            $questiontypes_count = sizeof($questiontypesdata);
            $questiontypes_all_count = $model_questiontypes->count();
        }
        else
        {
            $questiontypesdata = $model_questiontypes->where('subjectid='.$subjectid)->limit($begin, $length)->order('orderid asc')->select();
            $questiontypes_count = sizeof($questiontypesdata);
            $questiontypes_all_count = $model_questiontypes->where('subjectid='.$subjectid)->count();
        }



        $questiontypes_page_sum = ceil($questiontypes_all_count / $length);
        $questiontypes_begin_page = ceil(($begin + 1) / 4);


        for ($i = 0; $i < $questiontypes_count; $i++) {
            $subjectid = $questiontypesdata[$i]['subjectid'];
            $subject = $model_subject->where('id=' . $subjectid)->find();
            $questiontypesdata[$i]['subjectmsg'] = $subject['subjectmsg'];
//
        }
        $questiontypesdata['questiontypes_begin_page'] = $questiontypes_begin_page;
        $questiontypesdata['questiontypes_page_sum'] = $questiontypes_page_sum;
        $questiontypesdata['questiontypes_count'] = $questiontypes_count;

      //  print_r($questiontypesdata);

        echo json_encode($questiontypesdata);


    }

    public function systemset_03()
    {
        $model_subject = M('subject_data');

        $questiontypesdata=$model_subject->select();


        $this->assign('questiontypes',$questiontypesdata);
      // print_r($questiontypesdata);

        $this->display();



    }


    public function php_newkeynote_data_sql(){

        //2,化学方程式
        $subjectid=$_POST['subjectid'];
        $typesmsg=$_POST['typesmsg'];


        $model=M('questiontypes');

        $max=$model->max('orderid');
        $max=$max+1;

        $questiontypesdata['subjectid']=$subjectid;
        $questiontypesdata['typesmsg']=$typesmsg;
        $questiontypesdata['orderid']=$max;
        echo D('questiontypes')->add($questiontypesdata);
    }

    public function php_del_data_sql(){
        $id=$_POST['id'];
        D('questiontypes')->where('id='.$id)->delete();
        echo 1;
    }
    public function php_level_grade_sql(){
        $levelnum=$_POST['levelnum'];

        if($levelnum==1000)
        {
            $gradedata['count']=0;
            echo json_encode($gradedata);
        }
        else
        {
            $model=M('grade_data');
            $gradedata=$model->where('levelnum='.$levelnum)->select();
            $count=sizeof($gradedata);
            $gradedata['count']=$count;

            echo json_encode($gradedata);
        }

    }

    public function php_chapter_msg_sql()
    {
        $gradeid=$_POST[gradeid];
        $subjectid=$_POST[subjectid];
        $chaptermodel=M('chapter_msg');


//        $model=M('keynote_data');

        $arraydata['subjectid']=$subjectid;
        $arraydata['gradeid']= $gradeid;
        $arraydata['displayornot']=1;


        $chapterdata=$chaptermodel->where($arraydata)->order('orderid asc')->select();
        $count=sizeof($chapterdata);
        $chapterdata['count']=$count;
        echo json_encode($chapterdata);


    }

    public function php_newonekeynote_sql()
        {
            $onekeynote_subject=$_POST[onekeynote_subject];
            $grade_select=$_POST[grade_select];
            $onekeynotemsg=$_POST[onekeynotemsg];
            $model=M('onekeynote');
            $max=$model->where('subjectid='.$onekeynote_subject)->where('gradeid='.$grade_select)->max('orderid');
            $max=$max+1;
            $onekeynotedata['subjectid']=$onekeynote_subject;
            $onekeynotedata['gradeid']=$grade_select;
            $onekeynotedata['keynotemsg']=$onekeynotemsg;
            $onekeynotedata['orderid']=$max;
            echo D('onekeynote')->add($onekeynotedata);
        }

        public function php_onekeynotedel_data_sql()
        {
            $id=$_POST[id];
            $model=M('onekeynote');
            $data['delornot']=0;
             $model->where('id='.$id)->save($data);
            echo $id;

        }

        public function php_newchapterdata_sql()
        {
            $kind=$_POST[kind];
            $gradeid=$_POST[gradeid];
            $subjectid=$_POST[subjectid];
            $newchapter=$_POST[newchapter];
            $chapter=$_POST[chapter];
            $part=$_POST[part];
            $keynoteid=$_POST[akeynoteid];
            $akeynotemsg=$_POST[akeynotemsg];



            $model=M('keynote_data');
            $chaptermodel=M('chapter_msg');

            if($kind=='chapter')
            {
                $chapterarr['chaptermsg']=$newchapter;
                $chapterarr['gradeid']=$gradeid;
                $chapterarr['subjectid']=$subjectid;

                $data=$chaptermodel->where($chapterarr)->find();

                if($data['id']>0)
                {
                    echo 0;
                }
                else
                {
                    $chapterarr1['gradeid']=$gradeid;
                    $chapterarr1['subjectid']=$subjectid;
                    $max=$chaptermodel->where($chapterarr1)->max('orderid');
                    $max=$max+1;
                    $chapterarr['chaptermsg']=$newchapter;
                    $chapterarr['subjectid']=$subjectid;
                    $chapterarr['gradeid']=$gradeid;
                    $chapterarr['orderid']=$max;
                    $chapterarr['displayornot']=1;
                    $id=D('chapter_msg')->add($chapterarr);



                    $partarr['akeynote_id']="";
                    $partarr['akeynotemsg']="";

                    $partarr['chapter']=$id;
                    $partarr['chapterkind']=3;
                    $partarr['gradeid']=$gradeid;
                    $partarr['subjectid']=$subjectid;
                    $partarr['orderid']=0;
                    $partarr['part']='';
//
                    D('keynote_data')->add($partarr);

                    echo 1;


                }
            }

            if($kind=='part')
            {
                $partarr['chapter']=$chapter;
                $partarr['chapterkind']=4;
                $partarr['gradeid']=$gradeid;
                $partarr['subjectid']=$subjectid;
                $partarr['part']=$part;

              //  print_r($partarr);

                $data=$model->where($partarr)->find();

               // print_r($data);

                if($data['id']>0)
                {
                    echo 0;
                }
                else
                {
                    $partarr1['gradeid']=$gradeid;
                    $partarr1['subjectid']=$subjectid;
                    $max=$model->where($partarr1)->max('orderid');
                    $max=$max+1;



                    $partarr['akeynote_id']=$keynoteid;
                    $partarr['akeynotemsg']=$akeynotemsg;

                    $partarr['chapter']=$chapter;
                    $partarr['chapterkind']=4;
                    $partarr['gradeid']=$gradeid;
                    $partarr['subjectid']=$subjectid;
                    $partarr['orderid']=$max;
                    $partarr['part']=$part;

                    D('keynote_data')->add($partarr);

                    echo 1;


                }
            }
        }

        public function php_keyarr_sql()
        {
            $gradeid=$_POST[gradeid];
            $subjectid=$_POST[subjectid];
//            $gradeid=5;
//            $subjectid=1;
            $model=M('onekeynote');
            $keynotearr['delornot']=1;
            $keynotearr['subjectid']=$subjectid;
            $keynotearr['gradeid']=$gradeid;
            $keynotearrdata=$model->where($keynotearr)->order('orderid asc')->select();
            $count=sizeof($keynotearrdata);
            $keynotearrdata['count']=$count;
            echo json_encode($keynotearrdata);

           // echo 11;
        }

    public function php_delsub_data_sql(){
        $id=$_POST['id'];
        $kind=$_POST['kind'];

        if($kind=='part')
        {
            D('keynote_data')->where('id='.$id)->delete();
        }

        if($kind=='chapter')
        {
            D('keynote_data')->where('chapter='.$id)->delete();
            D('chapter_msg')->where('id='.$id)->delete();
        }

        echo 1;
    }

    public function systemset_04(){
        $model_subject_data=M('subject_data');
        $model_grade_data=M('grade_data');
        $model_school_data=M('school_data');
        $model_questiontypes=M('questiontypes');


        $subject_data=$model_subject_data->select();
        $grade_data=$model_grade_data->where('levelnum=2')->select();
        $school_data=$model_school_data->select();
        $questiontypes=$model_questiontypes->select();


        $this->assign('subject_data',$subject_data);
        $this->assign('grade_data',$grade_data);
        $this->assign('school_data',$school_data);
        $this->assign('questiontypes',$questiontypes);
        $this->assign('datetime',date("Y-m-d"));

        $this->display();
    }

    public function php_selectkeynote(){
        $subjectid=$_POST[subjectid];
        $gradeid=$_POST[gradeid];
        $keynote=$_POST[keynote];

//        $subjectid=2;
//        $gradeid=24;
//        $keynote='三角形';

//        2,24,

        $model_keynote_data=M('onekeynote');
        $keynote_data=$model_keynote_data->where('gradeid='.$gradeid.' and subjectid='.$subjectid.' and delornot=1')->order('orderid asc')->select();
        $keynote_data['count']=sizeof($keynote_data);
        $count=$keynote_data['count'];
        $m=0;

        if($keynote!='')
        {
            for($i=0;$i<$count;$i++)
            {
                if(strpos($keynote_data[$i]['keynotemsg'],$keynote))
                {
                    $data[$m]['id']=$keynote_data[$i]['id'];
                    $data[$m]['keynotemsg']=$keynote_data[$i]['keynotemsg'];
                    $m=$m+1;
                }
            }
            $data['count']=$m;

//            print_r($data);

            echo json_encode($data);

        }else{

//            print_r($keynote_data);

            echo json_encode($keynote_data);
        }


    }

    public function upload()
    {


        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize=3145728 ;// 设置附件上传大小
        $upload->exts=array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath='./uploads/inittestimg/'; // 设置附件上传根目录

        $upload->savePath=''; // 设置附件上传（子）目录
        // 上传文件
        $info=$upload->upload();
 
        $paper_name=$_POST["paper_name"];
        $test_kind=$_POST["test_kind"];
        $keynote_id=$_POST["keynote_id"];
        $subjectid=$_POST["subjectid"];
        $schoolname=$_POST["schoolname"];
        $filesernum=$_POST["filesernum"];
        $gradeid=$_POST["gradeid"];
 
        $model_key_paper=M('key_paper_msg_data');
        $model_paper_img_data=M('paper_img_data');

        $key_arr['paper_name']=$paper_name;
        $data=$model_key_paper->where($key_arr)->find();
        $count=sizeof($data);
      
        $keynote_arr=explode(',',$keynote_id);
        $keynote_count=sizeof($keynote_arr);
 
        if($count==0)
        {
            $key_arr['keynote_id']=$keynote_id;
            $key_arr['subjectid']=$subjectid;
            $key_arr['gradeid']=$gradeid;
            $key_arr['filesernum']=$filesernum;
            $key_arr['userid']=$schoolname;
//            $key_arr['kind']=$test_kind;
            $paper_id=$model_key_paper->add($key_arr);   
			$max_in_ser=0;
        }else{
            $filesernum=$data['filesernum'];
            $arr['filesernum']=$filesernum;
            $max_in_ser=$model_paper_img_data->where($arr)->max('in_ser');
            $max_in_ser=$max_in_ser+1;
            $paper_id=$data['id'];
        }



        $model_onekeynote=M('onekeynote');
        for($i=0;$i<$keynote_count;$i++)
        {
            $onkey_arr['id']=$keynote_arr[$i];
            $onekeynote_data=$model_onekeynote->where($onkey_arr)->find();
            $paper_id_msg=$onekeynote_data['testid_arr'];
            $paper_id_arr=explode(',',$paper_id_msg);

            if(ctb_in_array($paper_id,$paper_id_arr)==-1)
            {
                if($paper_id_msg=='')
                {
                    $paper_id_msg=$paper_id;
                }else
                {
                    $paper_id_msg=$paper_id_msg.','.$paper_id;
                }

                $newdata['testid_arr']=$paper_id_msg;

                $model_onekeynote->where($onkey_arr)->save($newdata);
            }
           // 进行修改
        }
        //paper_name+'|'+test_kind_select+'|'+keynote_id+'|'+subjectid+'|'+schoolname+'|'+keynote_input+'|'+filesernum+'|'+gradeid
        if(!$info) {// 上传错误提示错误信息
            $this->error($upload->getError());
        }else{// 上传成功 获取上传文件信息
            foreach($info as $file){
                $model_paper_img_data = M('paper_img_data');
                $paper_arr['paper_name']=$_POST['paper_name'];
                $paper_arr['filesernum']=$filesernum;
                $paper_arr['src_pic']='./uploads/inittestimg/'.$file['savepath'].$file['savename'];
                $paper_arr['img_kind']=1;
                if($file['key']=='file_answer') {
                	$paper_arr['img_kind']=2;
                }
                //$paper_arr['img_kind']=$test_kind;
                $paper_arr['in_ser']=$max_in_ser;
                $paper_arr['img_reg']=0;
                $paper_arr['img_status']=0;
                $max_in_ser=$max_in_ser+1;
                $model_paper_img_data->add($paper_arr);
            }
          
            echo 1;
        }
    }

    public function test12()
    {
        $model_key_paper=M('key_paper_msg_data');
        $data=$model_key_paper->where('paper_name=1')->find();

        echo sizeof($data);

        print_r($data);

    }
    
    //重置管理员密码
    public function editUserInfo($id)
    {
    	$res=0;
    	if($id) {
	    	$model = M('user_data');
	    	$data['pwd']='123456';
	    	$res=$model->where('id='.$id)->save($data);
    	}
    	echo $res;
    }
    
    //管理员删除
    public function delUserInfo($id)
    {
    	$res=0;
    	$model = M('user_data');
        if($id) {
	    	$res=$model->where('id='.$id)->delete();
    	}
    	echo $res;
    }
    
    //获取school信息
    public function editSchoolData($id)
    {
    	$mode=M('school_data');
    	$info=array();
    	$info=$mode->find($id);
    	echo json_encode($info);
    }
    
    //学校删除
    public function delSchoolInfo($id)
    {
    	$res=0;
    	$model = M('school_data');
        if($id) {
        	//删除学校数据
	    	$res=$model->where('school_id='.$id)->delete();
	    	//删除班级数据
	    	M('class_data')->where('school_id='.$id)->delete();
    	}
    	echo $res;
    }
    
    
    //数据获取分页知识点题库
    public function php_pointpaper_sql()
    {
    	$nowpage=$_POST['nowpage'];
    	$pagelength=$_POST['pagelength'];
    	$keywords=$_POST['keywords'];
 
    
    	$beginnum=($nowpage-1)*$pagelength+1;
    	$beginpagenum=$beginnum-1;
    
    	$model=M('onekeynote');
    	$paperpoint=M('key_paper_msg_data');
    
    	$dataarr=array();
    	
    	//查找出版社的名字
    	$publishinfo=array();
    	if($keywords) {
    		$pointlist=$model->where("keynotemsg like '%".$keywords."%'")->field('id')->select();
    		if(!empty($pointlist)) {
    			foreach($pointlist as $k=>$v) {
    				$pointinfo[]=$v['id'];
    			}
    		}
    	
    		if(!empty($pointinfo)){
    			$dataarr['keynote_id']=array('in',$pointinfo);
    		}  
    	}
    
    	$count=$model->where($dataarr)->count();
    	$data=$model->where($dataarr)->order('orderid desc')->limit($beginpagenum.','.$pagelength)->select();
    	foreach($data as $k=>&$v) {
    		$v['num']=$beginnum;
    		$beginnum=$beginnum+1;
    		!empty($v['createtime']) && $v['createtime']=date("Y-m-d H:i:s",$v['createtime']);
    	 	if($v['keynote_id']) {
    	 		$tmp=$model->find($v['keynote_id']);
    	 		$v['keynote_name']=$tmp['keynotemsg'];
    	 	}
    	}
    
    
    	$data['length']=sizeof($data);
    	$data['pagelength']=$pagelength;
    	$data['count']=$count;
    
    	$data['pagenum']=ceil($count/$pagelength);
    	echo json_encode($data);
    }
}