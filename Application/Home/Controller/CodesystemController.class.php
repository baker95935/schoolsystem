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
     $data=$Model->query('select id,name,sum  from publish_name  where status=1  order by name desc limit '.$begin_num.','.$size_num);
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
    $code_name=$_POST['code_name'];
    $code_note=$_POST['code_note'];
    $code_price=$_POST['code_price'];
    $code_num=$_POST['code_num'];
    $publishid=$_POST['publishid'];
    
    //$code_name='测试二维码';
    //$code_note='问问我';
    //$code_price='12';
    //$code_num='58926311201942222951';
    //`id`, ``, `kind`, `exercises_id`, `status`, `publishid`, `creattime`, `endtime`, ``, ``, `free_test_arr`, `free_key_arr`, ``
    
    $data['codename']=$code_name;
    $data['codemsg']=$code_num;
    $data['codenote']=$code_note;
    $data['codemsg']=$code_num;
    $data['kind']=0;
    $data['status']=0;
    $data['creattime']= date("Y-m-d h:i:s");
    $data['userednum']=0;
    $data['publishid']=$publishid;
    
    
    
    $Model=M('code_msg');
    echo $Model->add($data);
    
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
    $publishid=10;
    //$publishid=$_POST['publishid'];
    $Model=M('');
    $data=$Model->query('select * from code_msg where publishid='.$publishid.' order by creattime desc');
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

}