<?php
namespace Home\Controller;
use Think\Controller;

class WechatController extends Controller
{
	public function index()
	{
		$data=array(
			1=>array('title'=>'1.初中物理练习册第一卷11','time'=>'* 2/23 2019-12-23 12:12'),
			2=>array('title'=>'2.初中物理练习册第一卷22','time'=>'* 2/23 2019-12-23 12:12'),
			3=>array('title'=>'3.初中物理练习册第一卷33','time'=>'* 2/23 2019-12-23 12:12'),
		);
		echo json_encode($data);
	}
	
	public function register()
	{
      
      
		$openid=$_GET['openid'];
		$nickName=$_GET['nickName'];
		$avatarUrl=$_GET['avatarUrl'];
      
     // $openid='oFSQR5ZwLmBNxsaF2s6V9End7eb0';
     // $nickName='Founder';
		
		$country=$_GET['country'];
		$city=$_GET['city'];
		$province=$_GET['province'];
		$gender=$_GET['gender'];
		
		$model=M('weixin_users');
		
		//$result=0;
		
		$data=array();
		$data['openid']=$openid;
		$data['nickName']=$nickName;
		$data['avatarUrl']=$avatarUrl;
		$data['gender']=$gender;
		$data['province']=$province;
		$data['city']=$city;
		$data['country']=$country;
		$data['create_time']=time();
		
		if($openid && $nickName) {
			//校验数据
			$count=$model->where("openid='".$openid."'")->count();
			if($count==0) {
				$result=$model->add($data);
			} else {
				$info=$model->where("openid='".$openid."'")->find();
   
				$result['id']=$info['id'];
              	$result['st']=$info['st'];
              	$result['nd']=$info['nd'];
              	$result['rd']=$info['rd'];
			}
		}
     
		echo json_encode($result);
	}
	
	public function task()
	{
		//mytest表内容分页
        $keyword=$_GET['keyword'];
		$pagesize=$_GET['pagesize'];
		$page=$_GET['page']?$_GET['page']:1;
      	$model_mytest=M('mytest');
		$model_paper=M('paper_msg_data');
		$model_exercise=M('book_exercises');
      	$newkeyword='%'.$keyword.'%';
		$begin=$page*$pagesize;
		$userid=$_GET['userid'];
      
     	//$userid=15;
      	//$begin=10;
      
      
		$datalist=array();
      	if($userid){  
          	$data_where['userid']=$userid;
         	$data_where['deleted']=0;
          if($keyword!='')
          {
           $data_where['name']= array('like',$newkeyword);
          }
			$page_item_data=$model_mytest->where($data_where)->field('exerciseid')->group('exerciseid')->select();
          	$datalist=$model_mytest->where($data_where)->field('exerciseid,creatime,kind,lastreadtime,name,keyornot')->limit(0,$begin)->group('exerciseid')->order('lastreadtime desc')->select();
        }    
      
      
      $itemcount=$page_item_data;
      $pagecount=sizeof($page_item_data);    
      $count=sizeof($datalist); 
      
      
      for($i=0;$i<$count;$i++)
      {
        $exerciseid_arr[$i]=$datalist[$i]['exerciseid'];

      }
      
      $new_exerciseid_arr=array_values(array_unique($exerciseid_arr, SORT_REGULAR));
      $count=sizeof($new_exerciseid_arr);
      
   
      $classnum=1;
      $k=0;
      for($i=0;$i<$count;$i++)
      {

        $data[$i]['classnum']=$classnum;  
      	$done_num=0;
      	$undo_num=0;
        $key_undo_num=0;
      	$test_undo_num=0;
        $lastreadtime=0;
        $creatime=0;
        
        $data_item_num['exerciseid']=$datalist[$i]['exerciseid'];
        $data_item_num['userid']=$userid;
        $data_item_num['keyornot']=0;
        $data_item_num['kind']=0;
        $data_item_num['deleted']=0;
        $lastreadtime=$datalist[$i]['lastreadtime'];
        $creatime=$datalist[$i]['creatime'];
        
        
        $test_undo_num=$model_mytest->where($data_item_num)->count();       
        $data_item_num['keyornot']=1;
        $key_undo_num=$model_mytest->where($data_item_num)->count();
        
        $data_item_all['exerciseid']=$datalist[$i]['exerciseid'];
        $data_item_all['userid']=$userid;
        $data_item_all['deleted']=0;
        
        $item_sum_num=$model_mytest->where($data_item_all)->count();
        
        $data[$i]['notemsg']='('.$test_undo_num.'+'.$key_undo_num.')'.'/'.($item_sum_num).' '.$lastreadtime;  

        
        if($creatime==$lastreadtime)
        {
           $data[$i]['notemsg']= '*'.$data[$i]['notemsg'];
        }
        
   
        $newdata[$k]['id']=$new_exerciseid_arr[$i];
        $newdata[$k]['name']=$datalist[$i]['name'];
        $newdata[$k]['classnum']=$data[$i]['classnum'];
        $newdata[$k]['notemsg']= $data[$i]['notemsg'];
        $k=$k+1;
          
        if($classnum==1)
        {
          $classnum=2;
        }
        else
        {
          $classnum=1;
        }
        
        
        
        $undo_num=0;
        $done_num=0;
        $test_undo_num=0;
        $key_undo_num=0;
        $lastreadtime=0;
        
       }  

  
      
  
     $intpagesize=floor($pagecount/$pagesize);
     $dotpagesize=$pagecount%$pagesize;
      
      if($dotpagesize>0)
      {
        $maxpage=$intpagesize+1;
      }
      else
      {
        $maxpage=$intpagesize;
      }
     
     $data['list']=$newdata;
     $data['maxpage']=$maxpage;
     $data['page']=$page;
     $data['itemcount']=$itemcount;
      
     
      
     echo json_encode($data);
      
	}
	
	//删除
	public function del_task()
	{
		$taskid=$_GET['taskid'];
      
		$res=0;
		$data=array();
		if($taskid) {
			$mytest=M('mytest');
			$data['deleted']=1;
			$res=$mytest->where("exerciseid=".$taskid)->save($data);
		}
		echo $res;	
	}
  
  //添加书籍
  public function add_book_exercises()
  {
    
    $model_code=M('code_msg');
    $model_mytest=M('mytest');
    $model_paper_msg_data=M('paper_msg_data');
    $model_key_paper_msg_data=M('key_paper_msg_data');
   // $codemsg='<exercises_id>12302</exercises_id><code>abc3</code><kind>1</kind><status>1</status><name>习题册8</name>';
    //$userid=15;
    
    $codemsg=$_GET['code'];
    $userid=$_GET['userid'];
    
    $exercises_id=msg_cut_mid_part('<exercises_id>','</exercises_id>',$codemsg);
    $code=msg_cut_mid_part('<code>','</code>',$codemsg);
    $kind=msg_cut_mid_part('<kind>','</kind>',$codemsg);
    $status=msg_cut_mid_part('<status>','</status>',$codemsg);
    $name=msg_cut_mid_part('<name>','</name>',$codemsg);
   
    //$return_num 0 无效二维码。1 可用二维码 2，已经存在二维码
    
    //kind 1 一对一码。2 一对多码（可以变换的）
    
    $return_num=0;
    //状态可用
    if($status==1)
    {
      $data_code['codemsg']=$code;
      $data_num=$model_code->where($data_code)->count();     
      if($data_num>=1)
      {
        
        $data_mytest['userid']=$userid;
        $data_mytest['exerciseid']=$exercises_id;
        $data_num=$model_mytest->where($data_mytest)->count();
        
        if($data_num>=1)
        {
          $return_num=2;
        }
        else
        {
          $data_paper_msg_data['exerciseid']=$exercises_id;
          $data_result_paper_msg=$model_paper_msg_data->where($data_paper_msg_data)->select();
          $count=sizeof($data_result_paper_msg);
          for($i=0;$i<$count;$i++)
          {
            $data_add['userid']=$userid;
            $data_add['testid']=$data_result_paper_msg[$i]['id'];
            $data_add['creatime']=date('y-m-d h:i:s',time());
            $data_add['lastreadtime']=date('y-m-d h:i:s',time());
            $data_add['exerciseid']=$exercises_id;
            $data_add['name']=$name;
            $data_add['kind']=0;
            $data_add['questionsum']=$data_result_paper_msg[$i]['questionsum'];
            $data_add['download']=1;
            $data_add['deleted']=0;    
            $data_add['orderid']=$data_result_paper_msg[$i]['orderid'];
            $data_add['keyornot']=0;
            $model_mytest->add($data_add);
          }
             
          $data_key_paper_msg_data['exerciseid']=$exercises_id;
          $data_result_key_paper_msg=$model_key_paper_msg_data->where($data_key_paper_msg_data)->select();
          $count=sizeof($data_result_key_paper_msg);
          for($i=0;$i<$count;$i++)
          {
            $data_key_add['userid']=$userid;
            $data_key_add['testid']=$data_result_key_paper_msg[$i]['id'];
            $data_key_add['creatime']=$data_add['creatime'];
            $data_key_add['lastreadtime']=$data_key_add['creatime'];
            $data_key_add['exerciseid']=$data_result_key_paper_msg[$i]['exerciseid'];
            $data_key_add['name']=$name;
            $data_key_add['kind']=0;
            $data_key_add['questionsum']=$data_result_key_paper_msg[$i]['questionsum'];
            $data_key_add['download']=1;
            $data_key_add['deleted']=0;    
            $data_key_add['orderid']=$data_result_key_paper_msg[$i]['orderid'];
            $data_key_add['keyornot']=1;
            $model_mytest->add($data_key_add);
          }
          $return_num=1;
        }
      }
      else
      {
         $return_num=0;
      }
    }
    else
    {
      $return_num=0;
    }
    $data_return['num']=$return_num;
    echo json_encode($data_return);
  }
  
  
  //图书详情
  public function task_detail_note()
  {
    $exerciseid=$_GET['exerciseid'];
    $userid=$_GET['userid'];
    $exerciseid=123;
    $userid=15;
    
    $model_book_exercises=M('book_exercises');
    $model_publish_name=M('publish_name');
    $model_mytest=M('mytest');

    
    $book_data['id']=$exerciseid;
    $data_book_exercises=$model_book_exercises->where($book_data)->find();
    $publishid=$data_book_exercises['publishid'];
    $data_publish=$model_publish_name->where('id='.$publishid)->find(); 
    $publishname=$data_publish['name'];
    $data_book_exercises['publishname']=$publishname;
    echo json_encode($data_book_exercises);
   // print_r($data_mytest);
    
   // echo $publishname;
   
    
  }
  
  //图书练习册
  
   public function task_detail_test()
  {
    $model_mytest=M('mytest');
    $model_paper_msg_data=M('paper_msg_data');
    $model_key_paper_msg_data=M('key_paper_msg_data');
    $model_onekeynote=M('onekeynote');
    $exerciseid=$_GET['exerciseid'];
    $userid=$_GET['userid'];
    $keyornot=$_GET['keyornot'];
    $page=$_GET['page'];
    $pagesize=$_GET['pagesize'];
    //$exerciseid=123;
    //$userid=15;
    //$keyornot=0;
    //$page=1;
    //$pagesize=4;
     
    $endnum=$page*$pagesize;
        
    $mytest_data['userid']=$userid;
    $mytest_data['exerciseid']=$exerciseid;
    $mytest_data['keyornot']=$keyornot;
    $mytest_data['deleted']=0;
    $mytest_data['kind']=0;
    $data_mytest=$model_mytest->where($mytest_data)->order("orderid asc")->limit(0,$endnum)->select();   
    $data_all_mytest=$model_mytest->where($mytest_data)->order("orderid asc")->select();   
     
    $count=sizeof($data_mytest);
    $all_count=sizeof($data_all_mytest);
      
    $intpagesize=floor($all_count/$pagesize);
    $dotpagesize=$all_count%$pagesize;
      
      if($dotpagesize>0)
      {
        $maxpage=$intpagesize+1;
      }
      else
      {
        $maxpage=$intpagesize;
      }
     
  
    $buymsg=0;

    for($i=0;$i<$count;$i++)
    {
      $buyornot=$data_mytest[$i]['buyornot'];
      
      if($buyornot==1)
      {
         $buymsg='已购买';
      }
      
      
         if($keyornot==0)
    	{
     		 $data_paper=$model_paper_msg_data->where('id='.$data_mytest[$i]['testid'])->find();
           	 $data[$i]['paper_name']=$data_paper['paper_name'];
           	 $data[$i]['keynote']='';
           	 $data[$i]['shareornot']=$data_paper['shareornot'];
             $data[$i]['testid']=$data_mytest[$i]['testid'];
           	 $data[$i]['num']=($i+1).'/'.$all_count;
           	 $data[$i]['id']=$data_mytest[$i]['id'];
           	 if($data[$i]['shareornot']==0 && $buyornot==0)
             {
               $data[$i]['lock']='bottom_view_lock';
             }
           else
           {
              $data[$i]['lock']='';
           }
           
           
           
           $bgnum=$i%3;
           if($bgnum==0)
           {
             $data[$i]['bgclass']='0'.'1';
           }
           if($bgnum==1)
           {
              $data[$i]['bgclass']='0'.'2';
           }
           if($bgnum==2)
           {
              $data[$i]['bgclass']='0'.'3';
           }
           
           
   		 }
    	else
    	{
       		$data_paper=$model_key_paper_msg_data->where('id='.$data_mytest[$i]['testid'])->find();
            $data[$i]['paper_name']=$data_paper['paper_name'];
            $data[$i]['shareornot']=$data_paper['shareornot'];
            $data[$i]['testid']=$data_mytest[$i]['testid'];
          	$keynote_id=$data_paper['keynote_id'];
          	$data_onekeynote=$model_onekeynote->where('id='.$keynote_id)->find();
          	$data[$i]['num']=($i+1).'/'.$all_count;
          	$data[$i]['paper_name']=$data_paper['paper_name'];
          	$data[$i]['keynote']='('.$data_onekeynote['keynotemsg'].')';
            $data[$i]['id']=$data_mytest[$i]['id'];
          
            if($data[$i]['shareornot']==0  && $buyornot==0)
             {
               $data[$i]['lock']='bottom_view_lock';
             }
           else
           {
              $data[$i]['lock']='';
           }
          
          // $data[$i]['lock']='bottom_view_lock';
          
          $bgnum=$i%3;
           if($bgnum==0)
           {
              $data[$i]['bgclass']='0'.'1';
           }
           if($bgnum==1)
           {
              $data[$i]['bgclass']='0'.'2';
           }
           if($bgnum==2)
           {
              $data[$i]['bgclass']='0'.'3';
           }
          
          
    	} 
    }
     
     $result_data['list']=$data;   
     $result_data['maxpage']=$maxpage;
     $result_data['all_count']=$all_count;
     $result_data['buymsg']=$buymsg;
       // echo $maxpage;
     //print_r($result_data);
     echo json_encode($result_data);
    
    
    //print_r($data);
   // print_r($data_mytest);
    
   // echo $publishname;
   
    
  }
  
 	public function testser()
    {

        $testid=$_GET['testid'];
       
     
        $model=M('mytest');
        $model1=M('paper_msg_data');
        $model2=M('test_public_data');

        $data=$model1->where('id='.$testid)->find();
        $filesernum1=$data[filesernum];
        $array['filesernum']=$filesernum1;
        $testdata=$model2->where($array)->order('in_ser asc')->select();
        $testcount=$model2->where($array)->order('in_ser asc')->count();
        $testdata['count']=$testcount;

        for($i=0;$i<$testcount;$i++)
        {
        	$j=$i+1;
            $testdata[$i]['inputval']=cuttitle($testdata[$i][inputval]);
            $testdata[$i]['div']='';
            
        	if($testdata[$i]['ctbname']=='t1' || $testdata[$i]['ctbname']=='t0')
			{
				$testdata[$i]['div']=$testdata[$i]['inputval'];
			}
			
        	if($testdata[$i]['ctbname']=='a' || $testdata[$i]['ctbname']=='t-a')
			{
				$testdata[$i]['mid']=$testdata[$i]['inputval'];
			}
 
        }
        
        var_dump($testdata);exit;
        
        
        echo json_encode($testdata);
       

    }
  
  
  public function sendsms()
  {
  	$appid = 1400202683; 
  	$appkey = "b5fabd6b2053e37c170746e184ce924f";
  	$templateId = 313778;
  	$smsSign = "爱上旅游网";
  	
  	//需要发送短信的手机号码
  	$phoneNumbers = $_GET['phone'];
  	$userid=$_GET['userid'];
 
    $num="";
	for($i=0;$i<4;$i++){
		$num .= rand(0,9);
	}
	
	$sms=M('phone_sms');
	$data=array();
	//校验手机号
	$count=$sms->where('phone='.$phoneNumbers)->count();
	if($count>0) {
		$data['num']=$num;
		$sms->where('phone='.$phoneNumbers)->save($data);
	} else {
		$data['phone']=$phoneNumbers;
		$data['num']=$num;
		$data['create_time']=time();
		$sms->add($data);
	}
	
	$res=array();
	//验证码到sesson
    if($phoneNumbers) {
    	
    	//校验是否有记录，如果有 那么返回验证码和提取码
    	$user=M('user_data');
    	$uinfo=$user->find($userid);
    	!empty($uinfo['ecode']) && $res=$uinfo['ecode'];
 
    	
		require "./ThinkPHP/Library/Org/Qcloud/Sms/index.php";
		    	 
	    $ssender = new \Qcloud\Sms\SmsSingleSender($appid, $appkey);
	    $params[] = $num;//数组具体的元素个数和模板中变量个数必须一致，例如事例中 templateId:5678对应一个变量，参数数组中元素个数也必须是一个
	    $result = $ssender->sendWithParam("86", $phoneNumbers, $templateId,$params, $smsSign, "", ""); 
	    $rsp = json_decode($result);
	    if($rsp->result==0) {
	    //if(1) {
	    	echo $res;
	    } else {
	    	echo 0;
	    }
    }
  }
  
  public function userdo()
  {
  	$phone=$_GET['phone'];
  	$ecode=$_GET['ecode'];
  	$userid=$_GET['userid'];
  	$phonenum=$_GET['phonenum'];
  	
  	$result=0;
  	//先校验验证码
  	$sms=M('phone_sms');
  	$info=$sms->where('phone='.$phone)->find();
 
  	if(!empty($info)) {
	  	if($phonenum==$info['num']) {
	  	
	  		$user=M('user_data');
	  		$data=array();
	  		$data['phone']=$phone;
	  		$data['ecode']=$ecode;
	  		$result=$user->where('id='.$userid)->save($data);
	  		$result==0 && $result=1;
	  	} 
  	}  
  	echo $result;
  }
  //列表详情页，原始习题展示,区分试卷类型 $testkind
   public function alltestdetail()
  {
    $testid=$_GET['testid'];
    $testkind=$_GET['testkind'];
    $ctbid=$_GET['ctbid'];
     
    $testid=1557;
    $ctbid=180;
    $testkind='testctb';
     
    $Model = M();
     
    if($testkind=='test')
    {
   	$data=$Model->query('SELECT a.paper_name,a.testimage,a.answerimage,a.font_size,a.filesernum,b.id as test_id,b.srcid,b.pic1,b.pic2,b.pic3,b.pic4,b.ctbname,b.inputval,b.typeid,c.src as test_src,d.id as answer_id,d.src as answer_src FROM ((paper_msg_data a INNER JOIN test_public_data b on a.filesernum=b.filesernum) INNER JOIN img_cuted_data c on b.srcid=c.id)  INNER JOIN img_cuted_data d ON c.answerid=d.id where a.id='.$testid.' order by in_ser asc');   
     }
     
    if($testkind=='key')
    {
   	$data=$Model->query('SELECT a.paper_name,a.testimage,a.answerimage,a.font_size,a.filesernum,b.id as test_id,b.srcid,b.pic1,b.pic2,b.pic3,b.pic4,b.ctbname,b.inputval,b.typeid,c.src as test_src,d.id as answer_id,d.src as answer_src FROM ((key_paper_msg_data a INNER JOIN test_public_data b on a.filesernum=b.filesernum) INNER JOIN img_cuted_data c on b.srcid=c.id)  INNER JOIN img_cuted_data d ON c.answerid=d.id where a.id='.$testid.' order by in_ser asc');   
    
    }
     
    if($testkind=='testctb')
    {
     // $testid_data=$Model->query('SELECT ctbtestid,typeidarr from mytest where id='.$ctbid);
     // $test_arr=$testid_data['ctbtestid'];
    //  select car_id from caridincarport where  not  EXISTS (select car_id from caridinccomment  where caridincarport.car_id =caridinccomment.car_id);
// select * from test_public_data where id in(select ctbtestid from mytest  where mytest.id ='.$ctbid.');
      //220,223,229,233,231,236,239,244
      $mytest_data=$Model->query('select * from test_public_data where id in (select ctbtestid from mytest where mytest.id ='.$ctbid.')');
      $mytest_data01=$Model->query('select * from test_public_data where id in (220,223,229,233,231,236,239,244)');
      
      $testid_data=$Model->query('SELECT ctbtestid from mytest where id='.$ctbid);
      
      
    }
     print_r($mytest_data01);
     print_r($mytest_data);
     print_r($testid_data);
     return;
     $newdata=mid_wechat_page_arr($data);
     
     echo json_encode($newdata);
  }
  
  
  //更新最后一次读取时间，下载使用
     public function updata_php_test()
    {
    
     $testid=$_GET['testid'];
     $userid=$_GET['userid'];
     $model_mytest=M('mytest');
      
     //$testid=1555;
     //$userid=15;
      
     $test_data['userid']=$userid;
     $test_data['testid']=$testid;   
     $data['lastreadtime']=date("Y-m-d H:i:s");

     $res=$model_mytest->where($test_data)->save($data);
     echo $res;      
    }
  //设定页面,区分试卷类型 $testkind
    public function setpage()
  {
     $testid=$_GET['testid'];
     $answerimage=$_GET['answerimage'];
     $testimage=$_GET['testimage'];
     $font_size=$_GET['font_size'];
     $testkind=$_GET['testkind'];
    
   // $testid=1555;
    //$answerimage=1745;
    //$testimage=1745;
    //$font_size=27;
    
     $model_paper_msg_data=M('paper_msg_data');
     $model_key_paper_msg_data=M('key_paper_msg_data');
     $test_data['font_size']=$font_size;
     $test_data['testimage']=$testimage;
     $test_data['answerimage']=$answerimage;
     $data['id']=$testid;
     if($testkind=='test')
      {
     $res=$model_paper_msg_data->where($data)->save($test_data);
      }
      
      if($testkind=='key')
      {
     $res=$model_key_paper_msg_data->where($data)->save($test_data);
      }
     echo $res;
  }
  //选择原始题错题,区分试卷类型 $testkind
  public function choose()
  {
    $testid=$_GET['testid'];
    $testkind=$_GET['testkind'];
    //$testid=1555;
    $model_paper_msg_data=M('paper_msg_data');
    $model_test_public_data=M('test_public_data');
    $model_img_cuted_data=M('img_cuted_data');//表B
    $Model = M();
    if($testkind=='test')
    {
      	$data=$Model->query('SELECT b.id as test_id,b.ctbname,b.inputval,b.typeid,c.typesmsg FROM (paper_msg_data a INNER JOIN test_public_data b on a.filesernum=b.filesernum) INNER JOIN questiontypes c on b.typeid=c.id where a.id='.$testid.' order by in_ser asc');   
    }
    if($testkind=='key')
    {
      	$data=$Model->query('SELECT b.id as test_id,b.ctbname,b.inputval,b.typeid,c.typesmsg FROM (key_paper_msg_data a INNER JOIN test_public_data b on a.filesernum=b.filesernum) INNER JOIN questiontypes c on b.typeid=c.id where a.id='.$testid.' order by in_ser asc');   
    }
    $newdata=mid_wechat_choose_arr($data);  
    echo json_encode($newdata);
  }
  
  //插入错题本
  public function submitdata()
  {
    $model_testtime=M('testtime');
    $testid=$_GET['testid'];
    $mytestid=$_GET['mytestid'];
    $testkind=$_GET['testkind'];
    $arr=$_GET['arr'];
    $userid=$_GET['userid'];
    $st='+'.$_GET['st'].' day';
    $nd='+'.$_GET['nd'].' day';
    $rd='+'.$_GET['rd'].' day';
    
    $model_mytest=M('mytest'); 
    $data = explode(",", $arr);
	$result=ctb_arr($data);
    $newdata['ctbtestid']=$result[0];
    $newdata['typeidarr']=$result[1];
    $newdata['lastreadtime']=$result[2];
    $newdata['kind']=1;
    $newdata['nowtestnum']=1;
    
    $count=$model_mytest->where('userid='.$userid.' and testid='.$testid.' and kind=1')->count();
    if($count==0)
    {
    $newdata['nowtesttime']=date('Y-m-d', strtotime ($st, strtotime(date("y-m-d",time()))));
    $msg=$model_mytest->where('userid='.$userid.' and testid='.$testid)->save($newdata);
      
      
    $tnewdata['testid']=$testid;
    $tnewdata['status']=1;
    $tnewdata['nowstatus']=1; 
    $tnewdata['testkind']=$testkind;
    $tnewdata['testtime']=date("y-m-d",time());
    $tnewdata['lastreadtime']=date("ymd",time());
    $tnewdata['testtime']=date('Y-m-d', strtotime ($st, strtotime($tnewdata['testtime'])));
    $model_testtime->add($tnewdata);
    $tnewdata['nowstatus']=0; 
    $tnewdata['status']=2;
    $tnewdata['testtime']=date('Y-m-d', strtotime ($nd, strtotime($tnewdata['testtime'])));
    $model_testtime->add($tnewdata);
    $tnewdata['nowstatus']=0; 
    $tnewdata['status']=3;
    $tnewdata['testtime']=date('Y-m-d', strtotime ($rd, strtotime($tnewdata['testtime'])));
    echo $model_testtime->add($tnewdata);
    }
    else
    {
      echo 0;
    }

  }
  //查询错题连表
  public function ctbdata_all()
  {
    $Model=M();
    $model_mytest=M('mytest'); 
    $model_stumytest=M('stumytest'); 
    $testkind='all';
    $userid=15;
    $startnum=0;
    $endnum=40;
    
    $arr['userid']=$userid;
    $arr['kind']=1;
    $test=0;$key=0;$testctb=0;$keyctb=0;
    //$arr['keyornot']=0;
    
    $data_mytest=$model_mytest->field('keyornot')->where($arr)->select();
    $data_stumytest=$model_stumytest->field('keyornot')->where($arr)->select();
    
    for($i=0;$i<sizeof($data_mytest);$i++)
    {
       if($data_mytest[$i]['keyornot']==0)
       {
         $test=$test+1;
       }
      else
      {
        $key=$key+1;
      }
    }
    
    for($i=0;$i<sizeof($data_stumytest);$i++)
    {
       if($data_stumytest[$i]['keyornot']==0)
       {
         $testctb=$testctb+1;
       }
      else
      {
        $keyctb=$keyctb+1;
      }
    }
    
    $data=$Model->query('Select id,testid,lastreadtime,keyornot,nowtesttime,nowtestnum, case keyornot  when 0 then (select paper_name from paper_msg_data where id=a.testid) when 1 then (select paper_name from key_paper_msg_data where id=a.testid) end as paper_name,1 testkindnum  From  mytest as a  where userid='.$userid.' and finishornot=0 and kind=1 union all select id,id as testid,lastreadtime,keyornot,nowtesttime,nowtestnum,paper_name,2 testkindnum from stumytest  where userid='.$userid.' and finishornot=0 and kind=1 order by lastreadtime desc LIMIT '.$startnum.','.$endnum);
    $count=sizeof($data);
    for($i=0;$i<$count;$i++)
    {
      $j=$i+1;
      if($data[$i]['testkindnum']==1 && $data[$i]['keyornot']==0)
      {
        $newdata[$i]['id']=$data[$i]['id'];
        $newdata[$i]['testid']=$data[$i]['testid'];
        $newdata[$i]['lastreadtime']=$data[$i]['lastreadtime'];
        $newdata[$i]['nowtesttime']=$data[$i]['nowtesttime'];
        $newdata[$i]['nowtestnum']=$data[$i]['nowtestnum'];
        $newdata[$i]['paper_name']=$j.'.'.$data[$i]['paper_name'];
        $newdata[$i]['testkind']='testctb';
        $newdata[$i]['thisclass']='square_view_01';         
      }
      if($data[$i]['testkindnum']==1 && $data[$i]['keyornot']==1)
      {
        $newdata[$i]['id']=$data[$i]['id'];
        $newdata[$i]['testid']=$data[$i]['testid'];
        $newdata[$i]['lastreadtime']=$data[$i]['lastreadtime'];
        $newdata[$i]['nowtesttime']=$data[$i]['nowtesttime'];
        $newdata[$i]['nowtestnum']=$data[$i]['nowtestnum'];
        $newdata[$i]['paper_name']=$j.'.'.$data[$i]['paper_name'];
        $newdata[$i]['testkind']='keyctb';
        $newdata[$i]['thisclass']='square_view_03';         
      }
      if($data[$i]['testkindnum']==2 && $data[$i]['keyornot']==0)
      {
        $newdata[$i]['id']=$data[$i]['id'];
        $newdata[$i]['testid']=$data[$i]['testid'];
        $newdata[$i]['lastreadtime']=$data[$i]['lastreadtime'];
        $newdata[$i]['nowtesttime']=$data[$i]['nowtesttime'];
        $newdata[$i]['nowtestnum']=$data[$i]['nowtestnum'];
        $newdata[$i]['paper_name']=$j.'.'.$data[$i]['paper_name'];
        $newdata[$i]['testkind']='sectestctb';
        $newdata[$i]['thisclass']='square_view_02';         
      }
      if($data[$i]['testkindnum']==2 && $data[$i]['keyornot']==1)
      {
        $newdata[$i]['id']=$data[$i]['id'];
        $newdata[$i]['testid']=$data[$i]['testid'];
        $newdata[$i]['lastreadtime']=$data[$i]['lastreadtime'];
        $newdata[$i]['nowtesttime']=$data[$i]['nowtesttime'];
        $newdata[$i]['nowtestnum']=$data[$i]['nowtestnum'];
        $newdata[$i]['paper_name']=$j.'.'.$data[$i]['paper_name'];
        $newdata[$i]['testkind']='seckeyctb';
        $newdata[$i]['thisclass']='square_view_04';           
      }   
        if($newdata[$i]['nowtestnum']==1)
        {
          $newdata[$i]['ser']='1st';
        }
       if($newdata[$i]['nowtestnum']==2)
        {
          $newdata[$i]['ser']='2nd';
        }
        if($newdata[$i]['nowtestnum']==3)
        {
          $newdata[$i]['ser']='3rd';
        }
    }
    
    $returndata['testctb']=$test;
    $returndata['keyctb']=$key;
    $returndata['sectestctb']=$testctb;
    $returndata['seckeyctb']=$keyctb;
    $returndata['list']=$newdata;
 
    echo json_encode($returndata); 
  }
  
 
 
}