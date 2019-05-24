<?php
namespace Home\Controller;

use Think\Controller;

class CodesystemController extends Controller
{
   public function Code_01()
   {
     $begin_num=0;
     $size_num=15;
     $Model=M('');
     $data=$Model->query('select id,name,sum from publish_name  where status=1  order by name desc limit '.$begin_num.','.$size_num);
     for($i=0;$i<sizeof($data);$i++)
     {
       $data[$i]['names']=$data[$i]['name'].'('.$data[$i]['sum'].')';
     }
     //  echo  json_encode($data);
     $this->assign('data',$data);
     $this->display();
   }
  
  
  public function phpaddCodeSub()
  {
  	$res=0;
  	
    $code_name=$_POST['code_name'];
    $code_note=$_POST['code_note'];
    $code_price=$_POST['price'];
    //$code_num=$_POST['code_num'];
    $publishid=$_POST['publishid'];
    $exerciseid=$_POST['exerciseid'];
    $free_test_arr=$_POST['free_test_arr'];
    $free_key_arr=$_POST['free_key_arr'];
    $codeid=$_POST['codeid'];
    
    //处理下字符串
    
    $data['price']=$code_price;
    $data['codename']=$code_name;
    $data['codenote']=$code_note;
    $data['kind']=0;
    $data['status']=0;
    $data['creattime']= date("Y-m-d h:i:s");
    $data['userednum']=0;
    $data['publishid']=$publishid;   
    $data['exercises_id']=$exerciseid;
    $data['free_test_arr']=$free_test_arr;
    $data['free_key_arr']=$free_key_arr;
     
    $Model=M('code_msg');
    
    $Model_publish_name=M('publish_name');
    
    $Model_publish_name->where('id='.$publishid)->setInc('sum');
    if($codeid) {
    	$data['id']=$codeid;
    	$Model->save($data);
    } else {
    	$Model->add($data);
    }
    echo 1;
  }
  
  //出版社无刷新加载列表和搜索
  public function php_publish_sql()
  {
  	$nowpage=$_POST['nowpage'];
  	$pagelength=$_POST['pagelength'];
  	$keywords=$_POST['keywords'];
  	
  	 
  	$beginnum=($nowpage-1)*$pagelength+1;
  	$beginpagenum=$beginnum-1;
  	
  	$model=M('publish_name');
  	 
  	$dataarr=array();
  	!empty($keywords) && $dataarr['name']=['like',"%".$keywords."%"];
  	$count=$model->where($dataarr)->count();
  	$data=$model->where($dataarr)->order('createtime desc')->limit($beginpagenum.','.$pagelength)->select();
  	foreach($data as $k=>&$v) {
  		$v['num']=$beginnum;
  		$beginnum=$beginnum+1;
  		!empty($v['createtime']) && $v['createtime']=date("Y-m-d H:i:s");
  		$v['status']==1 && $v['newstatus']=2;
  		$v['status']==2 && $v['newstatus']=1;
  	
  		$v['status']==1 && $v['nstatus']='冻结';
  		$v['status']==2 && $v['nstatus']='启动';
  		 
  		$v['status']==1 && $v['status']='启动';
  		$v['status']==2 && $v['status']='冻结';
  	}
  	
  	
  	$data['length']=sizeof($data);
  	$data['pagelength']=$pagelength;
  	$data['count']=$count;
  	 
  	$data['pagenum']=ceil($count/$pagelength);
  	echo json_encode($data);
  	
  }

  //试题列表
  public function php_exercise_sql()
  {
  	$nowpage=$_POST['nowpage'];
  	$pagelength=$_POST['pagelength'];
  	$keywords=$_POST['keywords'];
  	$publishid=$_POST['publishid'];
  	
  	 
  	$beginnum=($nowpage-1)*$pagelength+1;
  	$beginpagenum=$beginnum-1;
  	
  	$model=M('book_exercises');
  	$publish=M('publish_name');
  	
  	$paper=M('paper_msg_data');
  	$key=M('key_paper_msg_data');
  	 
  	$dataarr=array();
  	!empty($keywords) && $dataarr['name']=['like',"%".$keywords."%"];
  	 
  	//查找出版社的名字
  	if($publishid) {
  		$dataarr['publishid']=array('in',$publishid);
  	}  
  	
  	
  	$count=$model->where($dataarr)->count();
  	$data=$model->where($dataarr)->order('createtime desc')->limit($beginpagenum.','.$pagelength)->select();
  	foreach($data as $k=>&$v) {
  		$v['num']=$beginnum;
  		$beginnum=$beginnum+1;
  		
  		//计算各种的 试卷和知识点数量
  		$v['papernum']=$paper->where('exerciseid='.$v['id'])->count();
  		$v['keynum']=$key->where('exerciseid='.$v['id'])->count();
  		
  	}
  	
  	
  	$data['length']=sizeof($data);
  	$data['pagelength']=$pagelength;
  	$data['count']=$count;
  	
  	//获取出版社数据
  	if($publishid) {
  		$tmp=$publish->find($publishid);
  		$data['publishname']=$tmp['name'];
  	}
  	 
  	$data['pagenum']=ceil($count/$pagelength);
  	echo json_encode($data);
  }
  
  //普通二维码页面
  public function Code_02()
  {
  	$nowtime=date('Y-m-d');
  	
  	$this->assign('nowtime',$nowtime);
  	$this->display();
  }
  
  public function phpcodeList()
  {
    //$publishid=10;
    $publishid=$_POST['publishid'];
    $Model=M('');
    $data=$Model->query('select * from code_msg where publishid='.$publishid.' order by creattime desc');
    $data['count']=sizeof($data);
    echo json_encode($data);
  }
  //
    public function phpexerciseList()
  {
    //$publishid=10;
    $publishid=$_POST['publishid'];
    $Model=M('');
    $data=$Model->query('select * from book_exercises where publishid='.$publishid.' order by createtime desc');
    $data['count']=sizeof($data);
    echo json_encode($data);
  }
  
  
  //习题册对应的试卷和知识点
  public function detailexerciseinfo()
  {
  	$res=array();
  	$exerciseid=$_POST['exerciseid'];
  	
  	$paper=M('paper_msg_data');
  	$key=M('key_paper_msg_data');
  	
  	//计算各种的 试卷和知识点数量
  	$res['paperlist']=$paper->where('exerciseid='.$exerciseid)->select();
  	$res['papernum']=$paper->where('exerciseid='.$exerciseid)->count();
  	$res['keylist']=$key->where('exerciseid='.$exerciseid)->select();
  	$res['keynum']=$key->where('exerciseid='.$exerciseid)->count();
 
  	echo json_encode($res);
  }

  //二维码信息
  public function detailcodemsg()
  {
  	$res=array();
  	$publishid=$_POST['publishid'];
  	$exerciseid=$_POST['exerciseid'];
  	$code=M('code_msg');
  	
  	$res=$code->where('publishid='.$publishid.' and exercises_id='.$exerciseid)->find();
  	echo json_encode($res);
  }
  
  //单个选中试题信息
  public function phpChooseExercise()
  {
    $exerciseid=$_POST['exerciseid'];
    
   // $exerciseid=123;
    
    $paper=M('paper_msg_data');
  	$key=M('key_paper_msg_data');
    
   	$res['test_num']=$paper->where('exerciseid='.$exerciseid)->count();
  	$res['key_num']=$key->where('exerciseid='.$exerciseid)->count();
    
   echo json_encode($res);  
  }
  
  public function downloadcode()
  {
  	$id=$_GET['codeid'];
  	//然后更新二维码表
  	//校验下 是否已生成
  	$code=M('code_msg');
  	$codeinfo=$code->find($id);
  	if(empty($codeinfo['codemsg'])) {
  		//先生成规则的序列号
  		$str=$this->number();
  		
  		//然后生成图片
  		$imgstr=$this->qrcode($str);
  		
	  	$data['id']=$id;
	  	$data['codemsg']=$str;
	  	$code->save($data);
  	} else {
  		$imgstr='./uploads/code/'.$codeinfo['codemsg'].'.png';
  	}
  	//然后下载图片
  	
  	//获取要下载的文件名
  	$filename = $imgstr;
  	//设置头信息
  	header('Content-Disposition:attachment;filename='.basename($filename));
  	header('Content-Length:' . filesize($filename));
  	//读取文件并写入到输出缓冲
  	readfile($filename);
  }
  
  
  //号码生成算法
  public function number()
  {
  	$time=date('YmdHis');
  	$a=rand(0,9);
  	$b=rand(0,9);
  	$c=$a+$b;
  
  	if(($a+$b)>=10){
  		$c=$a+$b-10;
  	}
  
  	$str=$a.mt_rand(100,999).$b.mt_rand(10,99).$c.$time;
  	return $str;
  }
  
  //号码校验算法
  public function checknumber()
  {
  	$str="6986220820190522162949";
  	//获取第一位和第五位和第八位
  	$a=substr($str,0,1);
  	$b=substr($str,4,1);
  	$c=substr($str,7,1);
  	$res=0;
  	if($a+$b==$c) {
  		$res=1;
  	}
  
  	if(($a+$b-10)==$c) {
  		$res=1;
  	}
  	echo $res;
  }
  
  //图片二维码生成
  public function qrcode($str)
  {
  	require "./ThinkPHP/Library/Org/Util/phpqrcode.php";
  	\QRcode::png($str,'./uploads/code/'.$str.'.png');
  	
  	return './uploads/code/'.$str.'.png';
  }
}