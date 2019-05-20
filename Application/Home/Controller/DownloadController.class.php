<?php
namespace Home\Controller;
use Think\Controller;
use Think\Image;
require 'Public/tcpdf/tcpdf.php';
//use vendor\crop;

class DownloadController extends Controller
{
   public function index()
   {
   	/*
	班级原始错题 `mytest
	个人班级错题 stumytest
	知识点习题，知识点错题：key_stumytest
	个人知识点错题：stumytest
	我想想加上未处理的总数
	paper_msg_data
	*/
     $userid=cookie('userid');
     $nickName=cookie('nickName');
     
     $model=M('mytest');
     
   	if(!empty($userid)) {
       
     
	     //未完成习题数和总数
		 $undownload=$model->where('download=1 and userid='.$userid.' and kind=1')->count();
		 $downloadcont=$model->where('download=2 and userid='.$userid.' and kind=1')->count();
		 $mytesttotalInfo="(".$undownload."|".$downloadcont.")";
	 
		 //个人班级错题
		 $stu=M('stumytest');
		 $stuun=$stu->where('download=1 and userid='.$userid.' and testkind=0')->count();
		 $studo=$stu->where('download=2 and userid='.$userid.' and testkind=0')->count();
		 $stutotalInfo="(".$stuun."|".$studo.")";
		 
		 //知识点习题
		 $stumy=M('key_stumytest');
		 $stumyun=$stumy->where('download=1 and userid='.$userid.' and kind=0')->count();
		 $stumydo=$stumy->where('download=2 and userid='.$userid.' and kind=0')->count();
		 $stumytotalInfo="(".$stumyun."|".$stumydo.")";
		 
		 //知识点错题
		 $stumy=M('key_stumytest');
		 $unmistakes=$stumy->where('download=1 and userid='.$userid.' and kind=1')->count();
		 $mistakesdo=$stumy->where('download=2 and userid='.$userid.' and kind=1')->count();
		 $mistakestotalInfo="(".$unmistakes."|".$mistakesdo.")";
		 
		 //个人知识点错题
		 $stu=M('stumytest');
		 $peryun=$stu->where('download=1 and userid='.$userid.' and testkind=1')->count();
		 $perydo=$stu->where('download=2 and userid='.$userid.' and testkind=1')->count();
		 $pertotalInfo="(".$peryun."|".$perydo.")";
   	 }
     $this->assign('userid',$userid);
     $this->assign('$nickName',$nickName);
     $this->assign('mytesttotalInfo',$mytesttotalInfo);
     $this->assign('stutotalInfo',$stutotalInfo);
     $this->assign('stumytotalInfo',$stumytotalInfo);
     $this->assign('mistakestotalInfo',$mistakestotalInfo);
     $this->assign('pertotalInfo',$pertotalInfo);
     $this->display();
   }
  
   public function phpdata()
   {
   	  $userid=$_POST['userid'];
      $nowpage=$_POST['nowpage'];
      $pagelength=$_POST['pagelength'];
      $kind=$_POST['kind'];
      $newsubjectid=$_POST['subjectid'];
      $grade=$_POST['grade'];
      $download=$_POST['download'];
        
      $beginnum=($nowpage-1)*$pagelength+1;
      $beginpagenum=$beginnum-1;
      
      if(empty($userid)) {
      	echo 0;exit;
      }
      
      //班级原始错题
      if($kind==1) {
	      $model=M('mytest');
	      $paper=M('paper_msg_data');
	      
	      $dataarr=array();
	      $dataarr['userid']=$userid;
	      $dataarr['kind']=1;
	      !empty($download)  && $dataarr['download']=$download;
	
	      $count=$model->where($dataarr)->count();
	      
	      if(!empty($newsubjectid) || !empty($grade)) {
	      	$list=$model->where($dataarr)->order('creatime desc')->select();
	      	foreach($list as $k=>&$v) {
	      		$info=$paper->find($v['testid']);
		      	if(!empty($grade) && $info['gradeid']!=$grade) {
		      		unset($list[$k]);
		      		continue;
		      	}
		        if(!empty($newsubjectid) && $info['subjectid']!=$newsubjectid) {
		      		unset($list[$k]);
		      		continue;
		      	 
		      	}
	      	}
	      	$count=sizeof($list);
	      }
	      $data=$model->where($dataarr)->order('creatime desc')->limit($beginpagenum.','.$pagelength)->select();
	 
	      foreach($data as $k=>&$v) {
	      	$info=$paper->find($v['testid']);
	      	if(!empty($grade) && $info['gradeid']!=$grade) {
	      		unset($data[$k]);
	      		//$count=$count-1;
	      		continue;
	      	}
	        if(!empty($newsubjectid) && $info['subjectid']!=$newsubjectid) {
	      		unset($data[$k]);
	      		//$count=$count-1;
	      		continue;
	      	 
	      	}
	      	$v['wrongsum']=substr_count($v['ctbtestid'],',')+1;
	      	$v['paper_name']=$info['paper_name']."(".$v['wrongsum'].")";
	      	$v['num']=$beginnum;
	      	$beginnum=$beginnum+1;
	      }
	      
	       $data=array_slice($data, 0);
	      
      }
      
       //个人班级错题
      if($kind==2) { 
      	$stu=M('stumytest');
      	
      	$dataarr=array();
	    $dataarr['userid']=$userid;
	    $dataarr['testkind']=0;
	    !empty($download)  && $dataarr['download']=$download;
	    !empty($newsubjectid) && $dataarr['subjectid']=$newsubjectid;
		$count=$stu->where($dataarr)->count();
		$data=$stu->where($dataarr)->order('creatime desc')->limit($beginpagenum.','.$pagelength)->select();
		foreach($data as $k=>&$v) {
		 	$v['num']=$beginnum;
	      	$beginnum=$beginnum+1;
	    }
      }
      
     //知识点习题
      if($kind==3) {
	  	$model=M('key_stumytest');
	    $note=M('onekeynote');
	      
	    $dataarr=array();
	    $dataarr['userid']=$userid;
	    $dataarr['kind']=0;
	    !empty($download)  && $dataarr['download']=$download;
	
	    $count=$model->where($dataarr)->count();
	      
	    if(!empty($newsubjectid) || !empty($grade)) {
	    	$list=$model->where($dataarr)->order('creatime desc')->select();
	    	foreach($list as $k=>&$v) {
		    	$info=$note->find($v['keynote_id']);
				if(!empty($grade) && $info['gradeid']!=$grade) {
					unset($list[$k]);
					continue;
				}
				if(!empty($newsubjectid) && $info['subjectid']!=$newsubjectid) {
				unset($list[$k]);
				continue;
				}
	    	}
	    	$count=sizeof($list);
	    }
	    
	    $data=$model->where($dataarr)->order('creatime desc')->limit($beginpagenum.','.$pagelength)->select();
	 
	    foreach($data as $k=>&$v) {
	    	$info=$note->find($v['keynote_id']);
	    	if(!empty($grade) && $info['gradeid']!=$grade) {
	    		unset($data[$k]);
	    		continue;
	    	}
	    	if(!empty($newsubjectid) && $info['subjectid']!=$newsubjectid) {
	    		unset($data[$k]);
	    		continue;
	    	}
	    $v['num']=$beginnum;
	    $beginnum=$beginnum+1;
	    }
	      
	    $data=array_slice($data, 0);
	      
      }
      
    //知识点错题
      if($kind==4) {
	  	$model=M('key_stumytest');
	    $note=M('onekeynote');
	      
	    $dataarr=array();
	    $dataarr['userid']=$userid;
	    $dataarr['kind']=1;
	    !empty($download)  && $dataarr['download']=$download;
	
	    $count=$model->where($dataarr)->count();
	      
	    if(!empty($newsubjectid) || !empty($grade)) {
	    	$list=$model->where($dataarr)->order('creatime desc')->select();
	    	foreach($list as $k=>&$v) {
		    	$info=$note->find($v['keynote_id']);
				if(!empty($grade) && $info['gradeid']!=$grade) {
					unset($list[$k]);
					continue;
				}
				if(!empty($newsubjectid) && $info['subjectid']!=$newsubjectid) {
				unset($list[$k]);
				continue;
				}
	    	}
	    	$count=sizeof($list);
	    }
	    
	    $data=$model->where($dataarr)->order('creatime desc')->limit($beginpagenum.','.$pagelength)->select();
	 
	    foreach($data as $k=>&$v) {
	    	$info=$note->find($v['keynote_id']);
	    	if(!empty($grade) && $info['gradeid']!=$grade) {
	    		unset($data[$k]);
	    		continue;
	    	}
	    	if(!empty($newsubjectid) && $info['subjectid']!=$newsubjectid) {
	    		unset($data[$k]);
	    		continue;
	    	}
	    $v['num']=$beginnum;
	    $beginnum=$beginnum+1;
	    }
	      
	    $data=array_slice($data, 0);
	      
      }
      
      //个人知识点错题
      if($kind==5) { 
      	$stu=M('stumytest');
      	
      	$dataarr=array();
	    $dataarr['userid']=$userid;
	    $dataarr['testkind']=1;
	    !empty($download)  && $dataarr['download']=$download;
	    !empty($newsubjectid) && $dataarr['subjectid']=$newsubjectid;
		$count=$stu->where($dataarr)->count();
		$data=$stu->where($dataarr)->order('creatime desc')->limit($beginpagenum.','.$pagelength)->select();
		foreach($data as $k=>&$v) {
		 	$v['num']=$beginnum;
	      	$beginnum=$beginnum+1;
	    }
      }
  	 
      $data['length']=sizeof($data);
      $data['pagelength']=$pagelength;
      $data['count']=$count;
   
      $data['pagenum']=ceil($count/$pagelength);
           // $data['kind']=$kind;
      echo json_encode($data);
   }
   
   public function logout()
   {
   		cookie('userid',null);
   		cookie('nickName',null);
	 	echo 1;
   }
   
  public function loadsubphp()
  {

    // $username=$_POST['phone'];
    // $seccode=$_POST['seccode'];
    
   	$phone=18902182280;
    $seccode=1234;
    
     $model=M('weixin_users');
     $data=$model->where(array('phone'=>$phone,'seccode'=>$seccode))->find();

     if($data[id]>0)
     {
	 	cookie('userid',$data[id],60*60*24*7);
	 	cookie('nickName',$data[nickame],60*60*24*7);
		echo json_encode($data);
     }else{
       echo 0;
    }
    
  }
  
  public function phpdata1()
  {
 
    $userid=$_POST['userid'];
    $userid=15;
    $nowpage=$_POST['nowpage'];
    $pagelength=$_POST['pagelength'];
    $printnum=$_POST['printnum'];
    $paperkind=$_POST['paperkind'];
    
    $beginnum=($nowpage-1)*$pagelength+1;
    $beginpagenum=$beginnum-1;
    
    $datakind='test';//$datakind='data';
    $Model=M('');
    //$data=$Model->query('Select id,testid,lastreadtime,keyornot,nowtesttime,nowtestnum,printnum, case keyornot  when 0 then (select paper_name from paper_msg_data where id=a.testid) when 1 then (select paper_name from key_paper_msg_data where id=a.testid) end as paper_name,1 testkindnum  From  mytest as a  where userid='.$userid.' and printnum='.$printnum.'  union all select id,id as testid,lastreadtime,keyornot,nowtesttime,nowtestnum,paper_name,2 testkindnum,printnum from stumytest  where userid='.$userid.' and printnum='.$printnum.'  order by nowtesttime asc LIMIT '.$startnum.','.$endnum);
   	//错题本
   	if($paperkind=='ctb') {
    	$sql='Select id,testid,lastreadtime,keyornot,nowtesttime,nowtestnum,printnum, case keyornot  when 0 then (select paper_name from paper_msg_data where id=a.testid) when 1 then (select paper_name from key_paper_msg_data where id=a.testid) end as paper_name,1 testkindnum  From  mytest as a  where userid='.$userid;
    	$printnum!=3 && $sql=$sql.' and printnum='.$printnum;
   	}
   	//原始习题
   	if($paperkind=='init') {
   		$sql1='Select id,testid,lastreadtime,keyornot,nowtesttime,nowtestnum,printnum, case keyornot  when 0 then (select paper_name from paper_msg_data where id=a.testid) when 1 then (select paper_name from key_paper_msg_data where id=a.testid) end as paper_name,1 testkindnum  From  mytest as a  where userid='.$userid;
   		$sql2=' union all select id,id as testid,lastreadtime,keyornot,nowtesttime,nowtestnum,paper_name,printnum ,2 testkindnum from stumytest  where userid='.$userid;
   		$printnum!=3 && $sql1=$sql1.' and printnum='.$printnum;
   		$printnum!=3 && $sql2=$sql2.' and printnum='.$printnum;
   		$sql=$sql1.$sql2;
   	}
 
   	$data=$Model->query($sql.' order by nowtesttime asc LIMIT '.$beginnum.','.$pagelength);
   	$countdata=$Model->query($sql);
    $count=sizeof($countdata);
    
    $j=$beginnum;
    for($i=0;$i<sizeof($data);$i++)
    {
      $newdata[$i]['id']=$data[$i]['id'];
      $newdata[$i]['testid']=$data[$i]['testid'];
      $newdata[$i]['lastreadtime']=date('Y-m-d',strtotime($data[$i]['lastreadtime']));
      $newdata[$i]['nowtesttime']=$data[$i]['nowtesttime'];
      if($data[$i]['nowtesttime']==null)
      {
        $data[$i]['nowtesttime']='--';
      }
      $newdata[$i]['printnum']=$data[$i]['printnum'];
      $newdata[$i]['paper_name']=$data[$i]['paper_name'];
      $newdata[$i]['num']=$j;
  
      if($data[$i]['nowtestnum']=='')
      {
        $newdata[$i]['nowtestnummsg']='--';
      }
      if($data[$i]['nowtestnum']==1)
      {
        $newdata[$i]['nowtestnummsg']='1st：';
      }
      if($data[$i]['nowtestnum']==2)
      {
        $newdata[$i]['nowtestnummsg']='2nd：';
      }
      if($data[$i]['nowtestnum']==3)
      {
        $newdata[$i]['nowtestnummsg']='3rd：';
      }
      
      
      if($data[$i]['printnum']==0)
      {
        $newdata[$i]['printmsg']='未进入打印';
      }
      
      if($data[$i]['printnum']==1)
      {
        $newdata[$i]['printmsg']='待打印';
      }
      
       if($data[$i]['printnum']==2)
      {
        $newdata[$i]['printmsg']='打印完成';
      }
      
      if($data[$i]['testkindnum']==1)
      {
        if($data[$i]['keyornot']==0)
        {
          $newdata[$i]['testkind']='testctb';
          if($datakind=='test')
          {
             $newdata[$i]['testkindmsg']='习题册原题';
          }
          else
          {
             $newdata[$i]['testkindmsg']='习题册错题';
          }

        }
        else
        {
          $newdata[$i]['testkind']='keyctb';
          if($datakind=='test')
          {
             $newdata[$i]['testkindmsg']='知识点原题';
          }
          else
          {
             $newdata[$i]['testkindmsg']='知识点错题';
          }
        }
      }
      
      if($data[$i]['testkindnum']==2)
      {
        if($data[$i]['keyornot']==0)
        {
          $newdata[$i]['testkind']='sectestctb';
          $newdata[$i]['testkindmsg']='个人习题册';
        }
        else
        {
         $newdata[$i]['testkind']='seckeyctb';
         $newdata[$i]['testkindmsg']='个人知识点';
        }
      }
      
       $j=$j+1;
    }
    
   
    $data=$newdata;
    $data['length']=sizeof($data);
    $data['pagelength']=$pagelength;
    $data['count']=$count;
     
    $data['pagenum']=ceil($count/$pagelength);
    // $data['kind']=$kind;
    echo json_encode($data);
   // echo json_encode($newdata);
 }
  
  
  //个人试卷生成pdf
    public function phpmanagepaperdetailpdf()
    {
        $testid=$_GET['testid'];
        $outkind=$_GET['outkind'];
        $paper_name=$_GET['paper_name'];
        $testkind=$_GET['testkind'];
        $testtime=$_GET['$testtime'];//试卷种类
      	$paperkind=$_GET['paperkind'];
      	$inittestid=$_GET['inittestid'];
        $testtime='生成时间：'.date('Y-m-d h:i:s',time());

            
     // testid 181;outkind I papername 和平区2017-2018年度第二学期九年级节课质量调查数学考试；testkind:testctb;paperkind ctb;
      
      $testid=182;
      $outkind='I';
      $paper_name='和平区2017-2018年度第二学期九年级节课质量调查数学考试';
      $testkind='testctb';
      $paperkind='init';
      $inittestid=1559;
      
      /*
   
      echo $testid;
            echo $outkind.'<hr>';
            echo $paper_name.'<hr>';
            echo $testkind.'<hr>';
            echo $testtime.'<hr>';
            echo $paperkind.'<hr>';
            echo $inittestid.'<hr>';

      return;
      
     */
      if($paperkind=='init')
      {
         if($testkind=='testctb')
          {
           $Model=M('');
           $newtestdata=$Model->query('SELECT b.id,b.in_ser,b.typeid,b.srcid,b.pic1,b.pic2,b.pic3,b.pic4,b.ctbname,b.inputval,b.typeid,b.tsernum,b.ctbname,b.kind,b.picsum,b.inputname,b.inputval,b.filesernum,b.align,b.imgdisplay,b.questionscore FROM paper_msg_data a INNER JOIN test_public_data b on a.filesernum=b.filesernum where a.id='.$inittestid.' order by in_ser asc');   
              
         	for($i=0;$i<sizeof($newtestdata);$i++)
        	 {
           		$newtestdata[$i]['inputval']=cuttitle($newtestdata[$i]['inputval']);
         	 }
         
         }
        
          if($testkind=='keyctb')
          {
             $model_key_test_public=M('key_test_public_data');
              
          }
        
        
        
       // print_r($newtestdata);
        
      //  return;



   // $data=$model->where('id='.$testid)->find();
//
  //		$newtestdata=persontest_to_standtest($inittestid,'public');

      }

      
      if($paperkind=='ctb')
      {
         if($testkind=='testctb' || $testkind=='keyctb')
        	{
           		$newtestdata=persontest_to_standtest($testid,'public');
        	}
        	else
        	{
       	   		$newtestdata=persontest_to_standtest($testid);
        	}
      }
           
      persontestpdf($outkind,$paper_name,$testtime,$newtestdata);
    }
  //个人答案生成pdf
      public function php_managepaperanswerpdf()
    {
        $testid=$_GET['testid'];
        $outkind=$_GET['outkind'];
        $testkind=$_GET['testkind'];
        $paper_name=$_GET['paper_name'].'答案';
        $testtime=$_GET['$testtime'];//试卷种类
        $testtime='生成时间：'.date('Y-m-d h:i:s',time());
      
      //	$testid=179;
     // 	$testkind=0;
      //	$outkind='I'; 
     // 	$paper_name='123';
     
        //$newtestdata=persontest_to_standtest($testid);
        
        if($testkind=='testctb' || $testkind=='keyctb')
        {
           $newtestdata=persontest_to_standtest($testid,'public');
        }
        else
        {
        $newtestdata=persontest_to_standtest($testid);
        }
      	persontest_to_answerpdf($newtestdata,$paper_name,$outkind);
    }
  
}