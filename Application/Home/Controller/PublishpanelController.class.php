<?php
namespace Home\Controller;

use Think\Controller;
require 'Public/tcpdf/tcpdf.php';

class PublishpanelController extends Controller
{
    public $usermsg;
    public function _initialize(){
        $this->usermsg=session('usermsg');

    }
    public function index()
    {
       $this->display();
    }
    public function systemframe()
    {
        $srcframe=session('srcframe');
        if($srcframe=="")
        {

            session('srcframe','test_list01.html');
        }
        $srcframe=session('srcframe');
        $this->assign('userdata',session('usermsg'));
        $this->assign('srcframe',$srcframe);
        $this->display();
    }
    public function test_list01()
    {

        $nowtime=date('Y-m-d');
        $this->assign('nowtime',$nowtime);// 赋值数据集
        


        $model_key = M('key_paper_msg_data'); // 实例化Data数据对象
        $key_count= $model_key->where('statusmsg=0')->count();// 查询满足要求的总记录数
        $key_page = new \Think\Page($key_count,12);// 实例化分页类 传入总记录数并且每页显示5条记录
        $key_nowPage = isset($_GET['p'])?$_GET['p']:1;
        $key_data = $model_key->where('statusmsg=0')->order('creat_time desc')->page($key_nowPage.','.$key_page->listRows)->select();
        $key_show = $key_page->show();// 分页显示输出
        $this->assign('key_page',$key_show);// 赋值分页输出
        $this->assign('key_data',$key_data);// 赋值数据集

        $key_fcount= $model_key->where('statusmsg=1 or statusmsg=3')->count();// 查询满足要求的总记录数
        $key_fpage = new \Think\Page($key_fcount,12);// 实例化分页类 传入总记录数并且每页显示5条记录
        $key_fnowPage = isset($_GET['p'])?$_GET['p']:1;
        $key_fdata = $model_key->where('statusmsg=1 or statusmsg=3')->order('creat_time desc')->page($key_fnowPage.','.$key_fpage->listRows)->select();
        $key_fshow = $key_fpage->show();// 分页显示输出
        $this->assign('key_fpage',$key_fshow);// 赋值分页输出
        $this->assign('key_fdata',$key_fdata);// 赋值数据集

        $this->display();
    }
    
    //ajax分页
    public function php_test_list01()
    {
    	$kind=$_POST['kind'];
    	$publishname=$_POST['publishname'];
    	$keywords=$_POST['keywords'];
    	
    	$nowpage=$_POST['nowpage'];
    	$pagelength=$_POST['pagelength'];
    	
    	$exercisename=$_POST['exercisename'];
    	
    	!empty($_POST['statusid']) && $statusid=$_POST['statusid'];
    	
    	 
    	$beginnum=($nowpage-1)*$pagelength+1;
    	$beginpagenum=$beginnum-1;
    	
    	//习题册
    	if($kind==1)
    	{
    		$dataarr=array();
    		$model = M('book_exercises'); // 实例化Data数据对象
    		$publish=M('publish_name');
    		$paper=M('paper_msg_data');
		  	!empty($keywords) && $dataarr['name']=['like',"%".$keywords."%"];
		  	
		  	//查找出版社的名字
		  	$publishinfo=array();
		  	if($publishname) {
		  		$publishlist=$publish->where("name like '%".$publishname."%'")->field('id')->select();
		  		if(!empty($publishlist)) {
		  			foreach($publishlist as $k=>$v) {
		  				$publishinfo[]=$v['id'];
		  			}
		  		}
		  	
		  		if(!empty($publishinfo)){
		  			$dataarr['publishid']=array('in',$publishinfo);
		  		} else {
		  			$dataarr['publishid']=0;
		  		}
		  	}
		  	
			$count=$model->where($dataarr)->count();
			$data=$model->where($dataarr)->order('createtime desc')->limit($beginpagenum.','.$pagelength)->select();
			
			foreach($data as $k=>&$v) {
				$v['num']=$beginnum;
				$beginnum=$beginnum+1;
				
		 
				//获取下 未完成的数量
				$v['uncount']=$paper->where('exerciseid='.$v['id'].' and statusmsg=0')->count();
				$v['count']=$paper->where('exerciseid='.$v['id'])->count();
				
				//已完成
				if($statusid==2) {
					if($v['uncount']!=0) {
						unset($data[$k]);
					}
				}
				
				//未完成
				if($statusid==1) {
					if($v['uncount']==0) {
						unset($data[$k]);
					}
				}
				
				//获取出版社数据
				$v['publishname']=0;
				if($v['publishid']) {
					$tmp=$publish->find($v['publishid']);
					$v['publishname']=$tmp['name'];
				}
				$v['createtime']=date('Y年m月d日',$v['createtime']);
			}
			
			$data=array_slice($data, 0);
			
			$count=count($data);
			$data=array_slice($data,$beginpagenum,$pagelength);
    	}
    	
    	//知识点
    	if($kind==2)
    	{
	    	$model=M('onekeynote');
	    	$publish=M('publish_name');
	    	$exercise=M('book_exercises');
	    	$keynote=M('key_paper_msg_data');
	    	 
	    	$dataarr=array();
	    	!empty($keywords) && $dataarr['keynotemsg']=['like',"%".$keywords."%"];
	    	 
	    	//查找出版社的名字
	    	$publishinfo=array();
	    	if($publishname) {
	    		$publishlist=$publish->where("name like '%".$publishname."%'")->field('id')->select();
	    		if(!empty($publishlist)) {
	    			foreach($publishlist as $k=>$v) {
	    				$publishinfo[]=$v['id'];
	    			}
	    		}
	    
	    		if(!empty($publishinfo)){
	    			$dataarr['publishid']=array('in',$publishinfo);
	    		}  
	    	}
	    	
	    	//查找习题册的名字
	    	$exerciseinfo=array();
	    	if($exercisename) {
	    		$exerciselist=$exercise->where("name like '%".$exercisename."%'")->field('id')->select();
	    		if(!empty($exerciselist)) {
	    			foreach($exerciselist as $k=>$v) {
	    				$exerciseinfo[]=$v['id'];
	    			}
	    		}
	    	
	    		if(!empty($exerciseinfo)){
	    			$dataarr['exerciseid']=array('in',$exerciseinfo);
	    		}  
	    	}
	    
	    
	    	
	    
	    	$data=$model->where($dataarr)->order('createtime desc')->select();
	    	foreach($data as $k=>&$v) {
	    		$v['num']=$beginnum;
	    		$beginnum=$beginnum+1;
	    	 
	    		//获取下 未完成的数量
	    		$v['uncount']=$keynote->where('keynote_id='.$v['id'].' and statusmsg=0')->count();
	    		$v['count']=$keynote->where('keynote_id='.$v['id'])->count();
	    		
	    		//已完成
	    		if($statusid==2) {
	    		 
	    			if($v['uncount']!=0) {
	    				unset($data[$k]);
	    			}
	    		}
	    		
	    		//未完成
	    		if($statusid==1) {
	    			if($v['uncount']==0) {
	    				unset($data[$k]);
	    			}
	    		}
	    
	    		//获取出版社数据
	    		if($v['publishid']) {
	    			$tmp=$publish->find($v['publishid']);
	    			$v['publishname']=$tmp['name'];
	    		}
	    		//获取习题册的数据
	    		if($v['exerciseid']) {
	    			$tmp=$exercise->find($v['exerciseid']);
	    			$v['exercisename']=$tmp['name'];
	    		}
	    		
	    
	    	}
	    	 
	    	$data=array_slice($data, 0);
	    	
	    	$count=count($data);
	    	$data=array_slice($data,$beginpagenum,$pagelength);
    
    	}
    	
    	$data['length']=sizeof($data);
    	$data['pagelength']=$pagelength;
    	$data['count']=$count;
    	 
    	$data['pagenum']=ceil($count/$pagelength);
    	echo json_encode($data);
    	
    }
    
    public function detailexercise()
    {
    	$model=M('book_exercises');
    	$publish=M('publish_name');
    	$msg['id']=$_POST[id];
    	$status=$_POST['status'];
    
    	$info=$model->find($msg['id']);
    	if($info['publishid']) {
    		$tmp=$publish->find($info['publishid']);
    		$info['publishname']=$tmp['name'];
    	}
    	 
    	!empty($info['starttime']) && $info['starttime']=date('Y-m-d',$info['starttime']);
    	!empty($info['endtime']) && $info['endtime']=date('Y-m-d',$info['endtime']);
    	 
    
    	//获取知识点对应的试卷
    	$paper=M('paper_msg_data');
    	$img=M("paper_img_data");
    	//获取下 未完成的数量
    	$uncount=0;
    	$uncount=$paper->where('exerciseid='.$msg['id'].' and statusmsg=0')->count();
    	$info['uncount']=$uncount;
    	$list=$paper->where('exerciseid='.$msg['id'])->order('orderid asc,creat_time asc')->select();
    	foreach($list as  $k=>&$v) {
    		//已完成
	    	if($status==2) {
	    		if($v['statusmsg']==0) {
	    			unset($list[$k]);
	    		}
	    	}
	    		
	    	//未完成
	    	if($status==1) {
	    		if($v['statusmsg']!=0) {
	    			unset($list[$k]);
	    		}
	    	}
	    	
	    	$v['statusmsg']==0 && $v['statusmsg']='未完成';
	    	$v['statusmsg']>0 && $v['statusmsg']='已完成';
    	}
    
    	!empty($list) && $info['list']=$list;
    	$info['count']=0;
    	!empty($list) && $info['count']=count($list);
    	 
    	echo json_encode($info);
    }
    
    public function detailkpoint()
    {
    	$model=M('onekeynote');
    	$publish=M('publish_name');
    	$exercise=M('book_exercises');
    	$msg['id']=$_POST[id];
    	$status=$_POST['status'];
    	$info=$model->find($msg['id']);
    	 
    	//获取出版社和习题册的名字
    	if(!empty($info['publishid'])) {
    		$tmp=$publish->find($info['publishid']);
    		$info['publishname']=$tmp['name'];
    	}
    	 
    	if(!empty($info['exerciseid'])) {
    		$tmp=$exercise->find($info['exerciseid']);
    		$info['exercisename']=$tmp['name'];
    	}
    	 
    	//获取知识点对应的试卷
    	$keynote=M('key_paper_msg_data');
    	$img=M('paper_img_data');
    	
    	//获取下 未完成的数量
    	$uncount=0;
    	$uncount=$keynote->where('keynote_id='.$msg['id'].' and statusmsg=0')->count();
    	$info['uncount']=$uncount;
    	$list=$keynote->where('keynote_id='.$msg['id'])->order('orderid asc,creat_time asc')->select();
    	foreach($list as  $k=>&$v) {
    		$v['statusmsg']==0 && $v['statusmsg']='未完成';
    		$v['statusmsg']>0 && $v['statusmsg']='已完成';
    		
    		//已完成
	    	if($status==2) {
	    		if($v['statusmsg']==0) {
	    			unset($list[$k]);
	    		}
	    	}
	    		
	    	//未完成
	    	if($status==1) {
	    		if($v['statusmsg']!=0) {
	    			unset($list[$k]);
	    		}
	    	}
    	}
    	
    	!empty($list) && $info['list']=$list;
    	$info['count']=0;
    	!empty($list) && $info['count']=count($list);
    	echo json_encode($info);
    }
    
    //删除
    public function deletepaper()
    {
    	$id=$_POST['id'];
    	$kind=$_POST['kind'];
    	 
    	$paper=M('paper_msg_data');
    	$keypaper=M('key_paper_msg_data');
    	 
    	if($kind==1) {
    		$paper->where('id='.$id)->delete();
    	}
    	 
    	if($kind==2) {
    		$keypaper->where('id='.$id)->delete();
    	}
    	echo 1;
    }
    
    public function test_whole02()
    {
        $srcframe=session('srcframe.html');
        if($srcframe!="test_whole02")
        {
            session('srcframe','test_whole02');
        }

        $filesernum=$_GET['filesernum'];
        $mykind=$_GET['kind'];
        $oldstatus=$_GET['oldstatus'];


        $model = M('paper_img_data');
        $array['filesernum'] = $filesernum;
        $array['img_kind'] = 1;
        $array['idel'] = 0;
        $tdata = $model->where($array)->order('in_ser asc')->select();
        $count = $model->where($array)->count();
        for($i=0;$i<=$count-1;$i++)
        {
            $imgxy=imgxy($tdata[$i][src_pic]);
            $tdata[$i]['itop']=0;
            $tdata[$i]['ileft']=0;
            $tdata[$i]['x']=$imgxy[x];
            $tdata[$i]['y']=$imgxy[y];
            $tdata[$i]['x_ratio']=round((int)$imgxy[x]/420,2);
            $tdata[$i]['y_ratio']=round((int)$imgxy[y]/610,2);
            $tdata[$i]['src_pic']=usersrc($tdata[$i][src_pic])."?".mt_rand();
        }
        $this->assign('filesernum',$filesernum);
        $this->assign('tdata',$tdata);
        $array['filesernum'] = $filesernum;
        $array['img_kind'] = 2;
        $array['idel'] = 0;
        $adata = $model->where($array)->order('in_ser asc')->select();
        $count = $model->where($array)->count();
        for($i=0;$i<=$count-1;$i++)
        {
           $imgxy=imgxy($adata[$i][src_pic]);
           $adata[$i]['itop']=0;
           $adata[$i]['ileft']=0;
           $adata[$i]['x']=$imgxy[x];
           $adata[$i]['y']=$imgxy[y];
           $adata[$i]['x_ratio']=round((int)$imgxy[x]/420,2);
           $adata[$i]['y_ratio']=round((int)$imgxy[y]/610,2);
           $adata[$i]['src_pic']=usersrc($adata[$i][src_pic])."?".mt_rand();
        }
        $this->assign('filesernum', $filesernum);
        $this->assign('adata',$adata);
        $this->assign('kind',$mykind);
        $this->assign('oldstatus',$oldstatus);
        $this->display();
}
    public function testcutsub()
    {

        if ($_POST['kind'] == "cut") {
            $msg = json_encode(cutsub(1, $_POST['x'], $_POST['y'], $_POST['width'], $_POST['height'], $_POST['src'], $_POST['reg']));
            $id = $_POST['name'];
            $model = M('paper_img_data');
            $array['id'] = $id;
            $imgreg['img_reg'] = 0;
            $model->where($array)->save($imgreg);
            echo $msg;
        }
        if ($_POST['kind'] == "cut2") {
            $msg = cutsub(2, $_POST['x'], $_POST['y'], $_POST['width'], $_POST['height'], $_POST['src'], $_POST['reg']);
            $id = $_POST['name'];
            $model = M('paper_img_data');
            $array['id'] = $id;
            $nowin_ser = $model->where($array)->Find();
            $nowarray['in_ser'] = array('gt', $nowin_ser['in_ser']);
            $nowarray['img_kind'] = $nowin_ser['img_kind'];
            $nowarray['filesernum'] = $nowin_ser['filesernum'];
            $imgdata = $model->where($nowarray)->order('in_ser asc')->select();
            $src1 = trsrc($nowin_ser['src_pic'], 2);
            $src_pic['src_pic'] = $src1[1];
            $model->where($array)->save($src_pic);
            foreach ($imgdata as $key => $value) {
                $nowid['id'] = $value['id'];
                $in_ser['in_ser'] = (int)$value['in_ser'] + 1;
                $model->where($nowid)->save($in_ser);
            }
            $newimage['in_ser'] = (int)$nowin_ser['in_ser'] + 1;
            $src2 = trsrc($nowin_ser['src_pic'], 2);
            $src_pic['src_pic'] = $src2[2];

            $newimage['filesernum'] = $nowin_ser['filesernum'];
            $newimage['img_kind'] = $nowin_ser['img_kind'];
            $newimage['img_reg'] = 0;
            $newimage['src_pic'] = $src2[2];
            $newimage['img_status'] = $nowin_ser['img_status'];
            $msg[2]['id'] = D('paper_img_data')->add($newimage);
            echo $msg = json_encode($msg);
        }

        if ($_POST['kind'] == "cutpart2") {

           $msg = cutsub(4, $_POST['x'], $_POST['y'], $_POST['width'], $_POST['height'], $_POST['src'], $_POST['reg']);
            $id = $_POST['name'];
            $model = M('paper_img_data');
            $array['id'] = $id;
            $nowin_ser = $model->where($array)->Find();
            $nowarray['in_ser'] = array('gt', $nowin_ser['in_ser']);
            $nowarray['img_kind'] = $nowin_ser['img_kind'];
            $nowarray['filesernum'] = $nowin_ser['filesernum'];
            $imgdata = $model->where($nowarray)->order('in_ser asc')->select();
            $src1 = trsrc($nowin_ser['src_pic'], 2);
            $src_pic['src_pic'] = $src1[1];
            $model->where($array)->save($src_pic);
            foreach ($imgdata as $key => $value) {
                $nowid['id'] = $value['id'];
                $in_ser['in_ser'] = (int)$value['in_ser'] + 1;
                $model->where($nowid)->save($in_ser);
            }
            $newimage['in_ser'] = (int)$nowin_ser['in_ser'] + 1;
            $src2 = trsrc($nowin_ser['src_pic'], 2);
            $src_pic['src_pic'] = $src2[2];

            $newimage['filesernum'] = $nowin_ser['filesernum'];
            $newimage['img_kind'] = $nowin_ser['img_kind'];
            $newimage['img_reg'] = 0;
            $newimage['src_pic'] = $src2[2];
            $newimage['img_status'] = $nowin_ser['img_status'];
            $msg[2]['id'] = D('paper_img_data')->add($newimage);
            echo $msg = json_encode($msg);


        }

        if ($_POST['kind'] == "cut3") {
            $msg = cutsub(3, $_POST['x'], $_POST['y'], $_POST['width'], $_POST['height'], $_POST['src'], $_POST['reg']);
            $id = $_POST['name'];
            $model = M('paper_img_data');
            $array['id'] = $id;
            $nowin_ser = $model->where($array)->Find();
            $nowarray['in_ser'] = array('gt', $nowin_ser['in_ser']);
            $nowarray['img_kind'] = $nowin_ser['img_kind'];
            $nowarray['filesernum'] = $nowin_ser['filesernum'];
            $imgdata = $model->where($nowarray)->order('in_ser asc')->select();
            $src1 = trsrc($nowin_ser['src_pic'], 3);
            $src_pic['src_pic'] = $src1[1];
            $model->where($array)->save($src_pic);
            foreach ($imgdata as $key => $value) {
                $nowid['id'] = $value['id'];
                $in_ser['in_ser'] = (int)$value['in_ser'] + 2;
                $model->where($nowid)->save($in_ser);
            }
            $newimage['in_ser'] = (int)$nowin_ser['in_ser'] + 1;
            $newimage['src_pic'] = $src1[2];
            $newimage['filesernum'] = $nowin_ser['filesernum'];
            $newimage['img_kind'] = $nowin_ser['img_kind'];
            $newimage['img_reg'] = 0;
            $newimage['img_status'] = $nowin_ser['img_status'];
            $msg[2]['id'] = D('paper_img_data')->add($newimage);
            $newimage['in_ser'] = (int)$nowin_ser['in_ser'] + 2;
            $newimage['src_pic'] = $src1[3];
            $newimage['filesernum'] = $nowin_ser['filesernum'];
            $newimage['img_kind'] = $nowin_ser['img_kind'];
            $newimage['img_reg'] = 0;
            $newimage['img_status'] = $nowin_ser['img_status'];
            $msg[3]['id'] = D('paper_img_data')->add($newimage);
            echo $msg = json_encode($msg);
        }
    }
    public function delsub()
    {
        unlink($_POST[src]);
        $model = M('paper_img_data');
        $msg['id']=$_POST[id];
        $mm=$model->where($msg)->delete();
        echo $mm;
    }

    public function delpublicsub()
    {
        $id=$_GET[id];
        $model = M('paper_msg_data');
        $model1 = M('paper_img_data');
        $model2 = M('test_public_data');
        echo $id;
    }

    public function addupload(){
        $filemsg = $_FILES[addimg];
        $filepath='.'.$_POST[addfilepath];
        $filesernum=$_POST[addfilesernum];
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize = 3145728;// 设置附件上传大小
        $upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath = $filepath; // 设置附件上传根目录
        $upload->autoSub=false;
        $info = $upload->uploadOne($filemsg);

        if(!$info)
        {
            $addimg['status']=0;
            echo json_encode($addimg);
        }
        else{
            $filesrc=$filepath .$info['savename'];
            $imgxy=imgxy($filesrc);
            $addimg['x_ratio']=round((int)$imgxy[x]/420,2);
            $addimg['y_ratio']=round((int)$imgxy[y]/610,2);
            $addimg['img_reg']=0;
            $addimg['src']=usersrc($filesrc)."?".mt_rand();
// 添加后修改排序
            $model = M('paper_img_data');
            $array['id'] = $_POST[addpreid];
            $nowin_ser = $model->where($array)->Find();
            $nowarray['in_ser'] = array('gt', $nowin_ser['in_ser']);
            $nowarray['img_kind'] = $nowin_ser['img_kind'];
            $nowarray['filesernum'] = $nowin_ser['filesernum'];
            $imgdata = $model->where($nowarray)->order('in_ser asc')->select();

            foreach ($imgdata as $key => $value) {
                $nowid['id'] = $value['id'];
                $in_ser['in_ser'] = (int)$value['in_ser'] + 1;
                $model->where($nowid)->save($in_ser);
            }
            ///
            $adddata['filesernum']=$_POST[addfilesernum];
            $adddata['src_pic']=$filesrc;
            $adddata['in_ser']=(int)$nowin_ser['in_ser']+1;
            $adddata['img_kind']=$nowin_ser['img_kind'];
            $adddata['img_reg']=0;
            $adddata['img_status']=1;
///

            $addimg['id']=D('paper_img_data')->add($adddata);


            $addimg['status']=1;

            echo json_encode($addimg);
        }

    }
    public function reupload(){

        $filemsg = $_FILES[replaceimg];
        $filepath='.'.$_POST[replacefilepath];

        $presrc='.'.$_POST[presrc];


        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize = 3145728;// 设置附件上传大小
        $upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath = $filepath; // 设置附件上传根目录
        $upload->autoSub=false;
        $info = $upload->uploadOne($filemsg);
        $filesrc=$filepath .$info['savename'];


        $imgxy=imgxy($filesrc);
        $addimg['x_ratio']=round((int)$imgxy[x]/420,2);
        $addimg['y_ratio']=round((int)$imgxy[y]/610,2);
        $addimg['img_reg']=0;
        $addimg['src']=usersrc($filesrc)."?".mt_rand();

        if(!$info)
        {
            $addimg['status']=0;
             echo json_encode($addimg);
        }
        else{
            unlink($presrc);
            $array[id]=$_POST[replaceid];
            $redata['src_pic']=$filesrc;
            $info1=M('paper_img_data')->where($array)->save($redata);

            $addimg['status']=1;

            echo json_encode($addimg);
        }

    }
    public function test_del03()
    {
        $id=$_GET[id];
        $username=$_GET[username];
        $realname=$_GET[realname];
        $mykind=$_GET[kind];
        $filesernum=$_GET[filesernum];
        $oldstatus=$_GET['oldstatus'];

//        $filesernum="a18902182280201852792041";
        $array['filesernum'] = $filesernum;
      
      if($mykind=='key')
      {
         $model1 = M('key_paper_msg_data');
      }
      else
      {
         $model1 = M('paper_msg_data');
      }

       
        $nomsg = $model1->where($array)->find();

        $nolevel=$nomsg;
        $no1=$nomsg['no1'];
        $no2=$nomsg['no2'];
        $no3=$nomsg['no3'];
        $no4=$nomsg['no4'];
        $no5=$nomsg['no5'];
        $mynolevel=$nomsg['nolevel'];


        $title=$nomsg[paper_name];
        $this->assign('nolevel',$mynolevel);
        $this->assign('no1',$no1);
        $this->assign('no2',$no2);
        $this->assign('no3',$no3);
        $this->assign('no4',$no4);
        $this->assign('no5',$no5);


        $this->assign('title',$title);


        //初始化原始图片

        $arrayimg['filesernum']=$filesernum;
        $arrayimg['img_kind']=1;
        $model = M('paper_img_data');
        $tdata = $model->where($arrayimg)->order('in_ser asc')->select();
        $count = $model->where($arrayimg)->count();

        for($i=0;$i<=$count-1;$i++)
        {
            $imgxy=imgxy($tdata[$i][src_pic]);
            $tdata[$i]['x']=$imgxy[x];
            $tdata[$i]['y']=$imgxy[y];
            $tdata[$i]['x_ratio']=round((int)$imgxy[x]/470,2);
            $tdata[$i]['y_ratio']=round((int)$imgxy[y]/660,2);
            $tdata[$i]['src_pic']=usersrc($tdata[$i][src_pic]);

          //  echo $tdata[$i][src_pic];

        }
       $this->assign('filesernum',$filesernum);
       $this->assign('tdata',$tdata);

        //初始化剪切后的习题
        $model = M('test_public_data');
        $model1 = M('img_cuted_data');
        //试卷种类
        $array['kind'] = 'test';
        $imgdata = $model->where($array)->order('in_ser asc')->select();
        $imgcount = $model->where($array)->count();

        for($j=0;$j<=$imgcount-1;$j++)
        {
            $srcid=$imgdata[$j][srcid];
            $imgarray['id']=$srcid;
            $result = $model1->where($imgarray)->field('src')->find();
            $result=$result['src'];
            $imgdata[$j]['src']=usersrc($result)."?".mt_rand();;

            $picsum=$imgdata[$j][picsum];
            $picsum=(int)$picsum-1;
            $testid=$imgdata[$j][id];

            if($picsum>0){
                $title=$imgdata[$j][inputval];
                $pic1=$imgdata[$j][pic1];
                $pic2=$imgdata[$j][pic2];
                $pic3=$imgdata[$j][pic3];
                $pic4=$imgdata[$j][pic4];
                $in_ser=$imgdata[$j][in_ser];
                $imgdata[$j][html]=htmlpic($testid,$picsum,$pic1,$pic2,$pic3,$pic4,$title,$in_ser);
            }
            $imgdata[$j][inputpic]='<input id="inputpic'.$imgdata[$j][in_ser].'" type="hidden"  name="'.$imgdata[$j][id].'"  value="'.$imgdata[$j][picsum].'">';
        }
        $this->assign('imgdata',$imgdata);
        $imgcount=(int)$imgcount+1;
        $this->assign('imgcount',$imgcount);
        $this->assign('kind',$mykind);
        $this->assign('oldstatus',$oldstatus);

        $this->display();

       // printf($tdata);
    }
    public function answer_del04(){
        $filesernum=$_GET[filesernum];
        $mykind=$_GET[kind];
        $oldstatus=$_GET['oldstatus'];
        $model = M('test_public_data');
        $model1= M('img_cuted_data');

        $array[filesernum]=$filesernum;
        $array[kind]='test';
        $data= $model->where($array)->order('in_ser asc')->select();
        $count=$model->where($array)->count();

        for($i=0;$i<$count;$i++)
        {
            $data[$i][title]=cuttitlemsg($data[$i][inputval]);
            $data[$i][kind]=savetitlemsg($data[$i][inputval]);
            $ta=$model1->where('id='.$data[$i][srcid])->find();
            $data[$i][answerid]=$ta[answerid];


            $fcount = $model->where('tsernum='.$data[$i][tsernum])->count();



            if($fcount==1)
            {
                $newtsernum[tsernum]=0;
                $model->where('id='.$data[$i][id])->save($newtsernum);
            }

        }

        $this->assign('data',$data);


        //初始化原始图片

        $arrayimg['filesernum']=$filesernum;
        $arrayimg['img_kind']=2;
        $model = M('paper_img_data');
        $adata = $model->where($arrayimg)->order('in_ser asc')->select();
        $count = $model->where($arrayimg)->count();

        for($i=0;$i<=$count-1;$i++)
        {
            $imgxy=imgxy($adata[$i][src_pic]);
            $adata[$i]['x']=$imgxy[x];
            $adata[$i]['y']=$imgxy[y];
            $adata[$i]['x_ratio']=round($imgxy[x]/420,4);
            $adata[$i]['x_ratio']=round(floor($adata[$i]['x_ratio']*1000)/1000,3);
            $adata[$i]['y_ratio']=round($imgxy[y]/610,4);
            $adata[$i]['y_ratio']=round(floor($adata[$i]['y_ratio']*1000)/1000,3);
            $adata[$i]['src_pic']=usersrc($adata[$i][src_pic]);

        }
        $this->assign('filesernum',$filesernum);
        $this->assign('adata',$adata);
        $this->assign('kind',$mykind);
        $this->assign('oldstatus',$oldstatus);


        $this->display();
    }
    public function cutandsql()
    {
        $y=$_POST[y];
        $height=$_POST[height];
        $src=$_POST[src];
      
     // 0,558.18,./uploads/inittestimg/2019-01-03/5c2d92f300d5a.jpg
      
    //  $y=0;
     // $height=558.18;
     // $src='./uploads/inittestimg/2019-01-03/5c2d92f300d5a.jpg';
      
        echo cut03sub($y,$height,$src);

    }
    public function cutrectanglesql()
    {
        $x=$_POST[x];
        $y=$_POST[y];
        $width=$_POST[width];
        $height=$_POST[height];
        $src=$_POST[src];
      //echo $msg='X:'.$x.',Y:'.$y.',Widht:'.$width.',Height:'.$height.',Src:'.$src;
       echo cutrectangle($x,$y,$width,$height,$src);

    }
    public function recutandsql()
    {
        $y=$_POST[y];
        $height=$_POST[height];
        $src=$_POST[src];
        $nowsrc=$_POST[nowsrc];
        echo recut03sub($y,$height,$src,$nowsrc);
    }
    public function addcutimg(){
        $src1=$_POST[src1];
        $src2=$_POST[src2];
        $result= addcutimgto($src1,$src2);
        unlink($src2);
       echo 1;
    }
    public function thistest()
    {

       $src1=$_POST[src1];
       $src2=$_POST[src2];
      
      $src1='./uploads/questionanswer/2019-01-08/15E4c695N9701.jpg';
      $src2='./uploads/questionanswer/2019-01-08/1Q5469597D0j6.jpg';
       echo  $result= addcutimgto($src1,$src2);
      
      echo 123;

    }
    public function test03(){
//实例化
        //array(209.97,295.74);

          $pdf = new \TCPDF('P', 'mm', array(209.97,295.74), true, 'UTF-8', false);
      // $pdf = new \TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

//        $pdf = new \TCPDF('L', 'mm', array(209.97,295.74));

// 设置文档信息
        $pdf->SetCreator('Helloweba');
        $pdf->SetAuthor('yueguangguang');
        $pdf->SetTitle('Welcome to helloweba.com!');
        $pdf->SetSubject('TCPDF Tutorial');
        $pdf->SetKeywords('TCPDF, PDF, PHP');

// 设置页眉和页脚信息
        $pdf->SetHeaderData('logo.png', 10, '好好错题本——好好学习，天天向上', array(0,64,255), array(0,64,128));
        $pdf->setFooterData(array(0,64,0), array(0,64,128));

// 设置页眉和页脚字体
        $pdf->setHeaderFont(Array('stsongstdlight', '', '10'));
        $pdf->setFooterFont(Array('helvetica', '', '8'));

// 设置默认等宽字体
        $pdf->SetDefaultMonospacedFont('courier');

// 设置间距
        $pdf->SetMargins(15, 27, 15);
        $pdf->SetHeaderMargin(5);
        $pdf->SetFooterMargin(10);

// 设置分页
        $pdf->SetAutoPageBreak(TRUE, 25);

// set image scale factor
        $pdf->setImageScale(1.25);

// set default font subsetting mode
        $pdf->setFontSubsetting(true);
//writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=false,  $reseth=true, $align='', $autopadding=true)
//设置字体
        $pdf->SetFont('stsongstdlight', '', 14);

        $pdf->AddPage();

        $pdf->Write(0,"          这个很不错",'', 0, 'L', true, 0, false, false, 0);

//输出PDF
//for($i=1;$i<400;$i++)
//{

    //    $pdf->Image('./uploads/questionanswer/2018-05-31/15jj27757a150.jpg', 100, 100,0,0, '', '', '', false, 300, '', false, false, 1, false, false, false);
        $pdf->writeHTMLCell(00, 40, '', '', "标题很好啊", 0, 0, 0, true, 'L', true);
//        $pdf->writeHTMLCell(00, 100, '', '', "牛粪有都是", 0, 0, 0, true, 'L', true);

//}

       // $pdf->Image('./uploads/questionanswer/2018-05-31/15jj27757a150.jpg', 10,10, '88.2', '102.7', '', '', '', false, 300, '', false, false, 1, false, false, false);

        $html='123';

        //$html='<img id="textimg19" style="width: 100%" class="1929" src="./uploads/questionanswer/2018-05-27/J15274DE28694.jpg">';
        //$html = file_get_contents('http://test:85/index.php/Home/Testpanel/test');
//
//        $html ="http://www.baidu.com";
       // $pdf->writeHTML($html, true, false, true, true, '');
        $pdf->Output('output.pdf', 'I');
      //  $pdf->Output($_SERVER['DOCUMENT_ROOT'] .'/public/' .'output.pdf', 'F');

        //PDF输出   I：在浏览器中打开，D：下载，F：在服务器生成pdf ，S：只返回pdf的字符串

       // echo $html;
    }
    public function finishstep02(){
//        $timgsrcarray=$_POST[timgsrcarray];
//        $aimgsrcarray=$_POST[aimgsrcarray];
//        $timgreg=$_POST[timgreg];
//        $aimgreg=$_POST[aimgreg];

      $start = microtime(true);

        $timgsrcarray='./uploads/inittestimg/2018-03-24/1.png,./uploads/inittestimg/2018-03-24/2.png,./uploads/inittestimg/2018-03-24/3.png,./uploads/inittestimg/2018-03-24/4.png,./uploads/inittestimg/2018-03-24/5.png,./uploads/inittestimg/2018-03-24/6.png';

        $timgsrcarray1=',./uploads/inittestimg/2018-03-24/7.png,./uploads/inittestimg/2018-03-24/8.png,./uploads/inittestimg/2018-03-24/9.png,./uploads/inittestimg/2018-03-24/10.png,./uploads/inittestimg/2018-03-24/11.png,./uploads/inittestimg/2018-03-24/12.png';

        $timgsrcarray=$timgsrcarray.$timgsrcarray1;

        $timgreg='10,10,10,20,10,10,10,10,10,20,10,10';

        $aimgsrcarray='./uploads/inittestimg/2018-03-24/7.png,./uploads/inittestimg/2018-03-24/8.png,./uploads/inittestimg/2018-03-24/9.png';
        $aimgreg='30,20,-23';




//        $filesernum=$_POST[filesernum];
        //$tsum=(int)$_POST[tsum];
       // $tsum=$tsum-1;
        $tsum=11;
//        $asum=(int)$_POST[asum];
//        $asum=$asum-1;
        $asum=2;

        $timgsrc=explode(',', $timgsrcarray);
        $aimgsrc=explode(',', $aimgsrcarray);
        $timgreg=explode(',', $timgreg);
        $aimgreg=explode(',', $aimgreg);

        print_r($timgsrc);

//        $model = M('paper_img_data');
//
//        echo 't'.'<br><br>';
//
//        for($i=0;$i<=$tsum;$i++){
//
//
////            $image_size = getimagesize($timgsrc[$i]);
////            $m=$image_size[2];
////
////            echo $timgsrc[$i].'<br>'.$timgreg[$i].'<br>'.$m.'<br>';
//
//            if($timgreg[$i]!=0)
//            {
//               echo rotateimg($timgsrc[$i],$timgreg[$i])."<br>";
//            }
//
//
////           echo imgcutimg($timgsrc[$i],$timgreg[$i])."<br>";
//
////            $img_msg['src_pic'] =$timgsrc[$i];
////            $img_msg['filesernum'] = $filesernum;
////            $imgreg['imgreg']=0;
////            $model->where($img_msg)->save($imgreg);
//
//        }
//
//
//
//        echo 'a'.'<br><br>';
//
//        for($j=0;$j<=$asum;$j++){
////
//            if($aimgreg[$j]!=0)
//            {
//                echo rotateimg($aimgsrc[$j],$aimgreg[$j])."<br>";
//            }
//
////           echo imgcutimg($aimgsrc[$j],$aimgreg[$j])."<br>";
//
////            $img_msg['src_pic'] = $aimgsrc[$i];
////            $img_msg['filesernum'] = $filesernum;
////            $imgreg['imgreg']=0;
////            $model->where($img_msg)->save($imgreg);
//        }
////
//        $elapsed = microtime(true) - $start;
//
//        echo $elapsed;



       // $this->display();
    }
    public function myrotateimg(){
        $src=$_POST[src];
        $reg=$_POST[reg];
        $id=$_POST[name];


        if(rotateimg($src,$reg)==1){
            $model = M('paper_img_data');
            $array['id'] = $id;
            $imgreg['img_reg'] = 0;
            $model->where($array)->save($imgreg);
            $html=usersrc($src)."?".mt_rand();
            $imgxy=imgxy($src);
            $data['x_ratio']=round((int)$imgxy[x]/420,2);
            $data['y_ratio']=round((int)$imgxy[y]/610,2);
            $data['src']=$html;

            echo json_encode($data);

        }
        else{
            echo 0;
        }

    }
    public function addtitleser(){
        $nolevel=$_POST[nolevel];
        $no1=$_POST[no1];
        $no2=$_POST[no2];
        $no3=$_POST[no3];
        $no4=$_POST[no4];
        $no5=$_POST[no5];
      	$kind=$_POST[kind];
      
        $filesernum=$_POST[filesernum];

        $array['no1']=$no1;
        $array['no2']=$no2;
        $array['no3']=$no3;
        $array['no4']=$no4;
        $array['no5']=$no5;
        $array['nolevel']=$nolevel;

        $sernum['filesernum']=$filesernum;
      
      if($kind=='key')
      {
        $model = M('key_paper_msg_data');
      }else
      {
        $model = M('paper_msg_data');
      }
        
        $result=$model->where($sernum)->save($array);
        if($result!== false) {
            echo 1;
        }else{
            echo 0;
        }
    }
    public function addimgsql(){
        $src='.'.$_POST[src];
        $kind=$_POST[kind];
        $img_x=(int)$_POST[img_x];
        $img_y=(int)$_POST[img_y];
        $img_width=(int)$_POST[img_width];
        $img_height=(int)$_POST[img_height];
        $tsernum=$_POST[tsernum];
        $inputname=$_POST[inputname];
        $ctbname=$_POST[ctbname];
        $in_ser=$_POST[in_ser];
        $picsum=(int)$_POST[picsum];
        $pic1=(int)$_POST[pic1];
        $pic2=(int)$_POST[pic2];
        $pic3=(int)$_POST[pic3];
        $pic4=(int)$_POST[pic4];
        $inputval=$_POST[inputval];
        $filesernum=$_POST[filesernum];
        $align=$_POST[align];
        $imgdisplay=$_POST[imgdisplay];
        $pagenum=(int)$_POST[pagenum];

        $data1array['src']=$src;
        $data1array['kind']=$kind;
        $data1array['img_x']=$img_x;
        $data1array['img_y']=$img_y;
        $data1array['img_width']=$img_width;
        $data1array['img_height']=$img_height;
        $id = D('img_cuted_data')->add($data1array);
        $data2array['srcid']=$id;
        $data2array['in_ser']=$in_ser;
        $data2array['tsernum']=$tsernum;
        $data2array['inputname']=$inputname;
        $data2array['ctbname']=$ctbname;
        $data2array['kind']=$kind;
        $data2array['picsum']=$picsum;
        $data2array['kind']=$kind;
        $data2array['pic1']=$pic1;
        $data2array['pic2']=$pic2;
        $data2array['pic3']=$pic3;
        $data2array['pic4']=$pic4;
        $data2array['inputval']=$inputval;
        $data2array['filesernum']=$filesernum;
        $data2array['align']=$align;
        $data2array['imgdisplay']=$imgdisplay;
        $data2array['pagenum']=$pagenum;

        $finishid = D('test_public_data')->add($data2array);

        echo $finishid;
    }
    public function addpicsql(){
        $src='.'.$_POST[src];
        $testid=(int)$_POST[testid];
        $picsum=(int)$_POST[picsum];

        $kind='pic';
        $img_x=0;
        $img_y=0;
        $img_width=0;
        $img_height=0;


        $model = M('test_public_data');
        $data1array['src']=$src;
        $data1array['kind']=$kind;
        $data1array['img_x']=$img_x;
        $data1array['img_y']=$img_y;
        $data1array['img_width']=$img_width;
        $data1array['img_height']=$img_height;

        $picid = D('img_cuted_data')->add($data1array);
        $picid =(int)$picid;

        if($picsum==2)
        {
            $data2array['pic1']=$picid;
        }
        if($picsum==3)
        {
            $data2array['pic2']=$picid;
        }
        if($picsum==4)
        {
            $data2array['pic3']=$picid;
        }
        if($picsum==5)
        {
            $data2array['pic4']=$picid;
        }

        $dataid['id'] = $testid;
        $data2array['picsum'] = $picsum;


        $result=$model->where($dataid)->save($data2array);
        if($result!== false) {
            echo 1;
        }else{
            echo 0;
        }
    }
    public function phpdelsqldata(){
        $id=(int)$_POST[id];
        $kind=$_POST[kind];
        $leng=$_POST[leng];

        $array1['id']=$id;
        $model1 = M('test_public_data');
        $model2 = M('img_cuted_data');

        $pic_inser=$leng;

        if($kind=='pic'){
            $ta=$model1->where($array1)->find();

            if($pic_inser==1){
                $pic1id=(int)$ta[pic1];
                $pic1arr=$model2->where("id=".$pic1id)->select();
                $pic1src=$pic1arr[0][src];

                $pic2id=(int)$ta[pic2];
                if($pic2id!==0){
                    $newpic1[pic1]=$pic2id;
                    $model1->where($array1)->save($newpic1);
                }
                else{
                    $newpic1[pic1]=0;
                    $model1->where($array1)->save($newpic1);
                }


                $pic3id=(int)$ta[pic3];
                if($pic3id!==0){
                    $newpic2[pic2]=$pic3id;
                    $model1->where($array1)->save($newpic2);
                }
                else{
                    $newpic2[pic2]=0;
                    $model1->where($array1)->save($newpic2);
                }


                $pic4id=(int)$ta[pic4];
                if($pic4id!==0){
                    $newpic3[pic3]=$pic4id;
                    $newpic3[pic4]=0;
                    $model1->where($array1)->save($newpic3);
                }else{
                    $newpic3[pic3]=0;
                    $model1->where($array1)->save($newpic3);
                }

                $ta=$model1->where($array1)->find();
                if($ta[pic1]!=0)
                {
                    $picsum[picsum]=2;
                }
                if($ta[pic2]!=0)
                {
                    $picsum[picsum]=3;
                }
                if($ta[pic3]!=0)
                {
                    $picsum[picsum]=4;
                }
                if($ta[pic4]!=0)
                {
                    $picsum[picsum]=5;
                }
                if($ta[pic1]==0)
                {
                    $picsum[picsum]=1;
                }
                $model1->where($array1)->save($picsum);

               unlink($pic1src);
               echo $result4=$model2->delete($pic1id);

            }
            if($pic_inser==2){
            $pic2id=(int)$ta[pic2];
            $pic2arr=$model2->where("id=".$pic2id)->select();
            $pic2src=$pic2arr[0][src];


            $pic3id=(int)$ta[pic3];
            if($pic3id!==0){
                $newpic2[pic2]=$pic3id;
                $model1->where($array1)->save($newpic2);
            }
            else{
                $newpic2[pic2]=0;
                $model1->where($array1)->save($newpic2);
            }

            $pic4id=(int)$ta[pic4];
            if($pic4id!==0){
                $newpic3[pic3]=$pic4id;
                $newpic3[pic4]=0;
                $model1->where($array1)->save($newpic3);
            }else{
                $newpic3[pic3]=0;
                $model1->where($array1)->save($newpic3);
            }

            $ta=$model1->where($array1)->find();
            if($ta[pic1]!=0)
            {
                $picsum[picsum]=2;
            }
            if($ta[pic2]!=0)
            {
                $picsum[picsum]=3;
            }
            if($ta[pic3]!=0)
            {
                $picsum[picsum]=4;
            }
            if($ta[pic4]!=0)
            {
                $picsum[picsum]=5;
            }
            if($ta[pic1]==0)
            {
                $picsum[picsum]=1;
            }
            $model1->where($array1)->save($picsum);

            unlink($pic2src);
            $result4=$model2->delete($pic2id);
            echo $result4;
            }
            if($pic_inser==3){
                $pic3id=(int)$ta[pic3];
                $pic3arr=$model2->where("id=".$pic3id)->select();
                $pic3src=$pic3arr[0][src];


                $pic4id=(int)$ta[pic4];
                if($pic4id!==0){
                    $newpic3[pic3]=$pic4id;
                    $newpic3[pic4]=0;
                    $model1->where($array1)->save($newpic3);
                }else{
                    $newpic3[pic3]=0;
                    $model1->where($array1)->save($newpic3);
                }

                $ta=$model1->where($array1)->find();
                if($ta[pic1]!=0)
                {
                    $picsum[picsum]=2;
                }
                if($ta[pic2]!=0)
                {
                    $picsum[picsum]=3;
                }
                if($ta[pic3]!=0)
                {
                    $picsum[picsum]=4;
                }
                if($ta[pic4]!=0)
                {
                    $picsum[picsum]=5;
                }
                if($ta[pic1]==0)
                {
                    $picsum[picsum]=1;
                }
                $model1->where($array1)->save($picsum);
                unlink($pic3src);
                $result4=$model2->delete($pic3id);
                echo $result4;
            }
            if($pic_inser==4){
                $pic4id=(int)$ta[pic4];
                $pic4arr=$model2->where("id=".$pic4id)->select();
                $pic4src=$pic4arr[0][src];
                unlink($pic4src);

                $newpic4[pic4]=0;
                $newpic4[picsum]=4;
                $model1->where($array1)->save($newpic4);

                echo $model2->delete($pic4id);
            }



        }
        if($kind=='t0'){
            $ta=$model1->where($array1)->find();
            $tsernum=$ta[tsernum];
            $arrays[tsernum]=$tsernum;
            $ta=$model1->where($arrays)->select();
            for($i=0;$i<$leng;$i++)
            {
                 no1testsernum($ta[$i][id],$ta[$i][picsum]);
            }
        }
        if($kind=='t1'){
            $ta=$model1->where($array1)->find();
            $tsernum=$ta[tsernum];
            $arrays[tsernum]=$tsernum;
            $ta=$model1->where($arrays)->select();
            for($i=0;$i<$leng;$i++)
            {
                  no1testsernum($ta[$i][id],$ta[$i][picsum]);
            }

        }
        if($kind=='a'){
            if($leng==1)
            {
                $ta=$model1->where($array1)->find();
                no1testsernum((int)$ta[id],(int)$ta[picsum]);
            }
            if($leng==2){
                $ta=$model1->where($array1)->find();
                $tsernum=$ta[tsernum];
                $arrays[tsernum]=$tsernum;
                $ta=$model1->where($arrays)->select();
                for($i=0;$i<$leng;$i++)
                {
                    no1testsernum($ta[$i][id],$ta[$i][picsum]);
                }
            }
        }
        if($kind=='t-a'){
            $ta=$model1->where($array1)->find();
            $in_ser=$ta[in_ser];
            $picsum=$ta[picsum];
            $filesernum=$ta[filesernum];

            if($picsum==5){
              $pic1=(int)$ta[pic1];
              $pic2=(int)$ta[pic2];
              $pic3=(int)$ta[pic3];
              $pic4=(int)$ta[pic4];
              $srcid=(int)$ta[srcid];

              $result=$model2->where("id=".$srcid)->select();
              $src=$result[0][src];
              unlink($src);

              $pic1arr=$model2->where("id=".$pic1)->select();
              $pic1src=$pic1arr[0][src];
              unlink($pic1src);
              $pic2arr=$model2->where("id=".$pic2)->select();
              $pic2src=$pic2arr[0][src];
              unlink($pic2src);
              $pic3arr=$model2->where("id=".$pic3)->select();
              $pic3src=$pic3arr[0][src];
              unlink($pic3src);
              $pic4arr=$model2->where("id=".$pic4)->select();
              $pic4src=$pic4arr[0][src];
              unlink($pic4src);

               $model2->delete($pic1);
               $model2->delete($pic2);
               $model2->delete($pic3);
               $model2->delete($pic4);
               $model2->delete($srcid);
               retestsernum($in_ser,$leng,$filesernum);
               echo $model1->delete($id);

            }
            if($picsum==4){
                $pic1=(int)$ta[pic1];
                $pic2=(int)$ta[pic2];
                $pic3=(int)$ta[pic3];
                $srcid=(int)$ta[srcid];


                $result=$model2->where("id=".$srcid)->select();
                $src=$result[0][src];
                unlink($src);

                $pic1arr=$model2->where("id=".$pic1)->select();
                $pic1src=$pic1arr[0][src];
                unlink($pic1src);
                $pic2arr=$model2->where("id=".$pic2)->select();
                $pic2src=$pic2arr[0][src];
                unlink($pic2src);
                $pic3arr=$model2->where("id=".$pic3)->select();
                $pic3src=$pic3arr[0][src];
                unlink($pic3src);


                $model2->delete($pic1);
                $model2->delete($pic2);
                $model2->delete($pic3);
                $model2->delete($srcid);
                retestsernum($in_ser,$leng,$filesernum);
                echo $model1->delete($id);
            }
            if($picsum==3){
                $pic1=(int)$ta[pic1];
                $pic2=(int)$ta[pic2];
                $srcid=(int)$ta[srcid];

                $result=$model2->where("id=".$srcid)->select();
                $src=$result[0][src];
                unlink($src);

                $pic1arr=$model2->where("id=".$pic1)->select();
                $pic1src=$pic1arr[0][src];
                unlink($pic1src);
                $pic2arr=$model2->where("id=".$pic2)->select();
                $pic2src=$pic2arr[0][src];
                unlink($pic2src);


                $model2->delete($pic1);
                $model2->delete($pic2);
                $model2->delete($srcid);
                retestsernum($in_ser,$leng,$filesernum);
                echo $model1->delete($id);
            }
            if($picsum==2){
                $pic1=(int)$ta[pic1];
                $srcid=(int)$ta[srcid];

                $result=$model2->where("id=".$srcid)->select();
                $src=$result[0][src];
                unlink($src);

                $pic1arr=$model2->where("id=".$pic1)->select();
                $pic1src=$pic1arr[0][src];
                unlink($pic1src);

                $model2->delete($pic1);
                $model2->delete($srcid);
                retestsernum($in_ser,$leng,$filesernum);
                echo $model1->delete($id);
            }

            if($picsum==1)
            {
                $srcid=(int)$ta[srcid];
                retestsernum($in_ser,$leng,$filesernum);

                $result=$model2->where("id=".$srcid)->select();
                $src=$result[0][src];
                unlink($src);

                $model2->delete($srcid);
               echo  $model1->delete($id);
            }



        }

    }
    public function addnewimgsql(){
        $src='.'.$_POST[src];
        $kind=$_POST[kind];
        $img_x=(int)$_POST[img_x];
        $img_y=(int)$_POST[img_y];
        $img_width=(int)$_POST[img_width];
        $img_height=(int)$_POST[img_height];
        $tsernum=$_POST[tsernum];
        $inputname=$_POST[inputname];
        $ctbname=$_POST[ctbname];
        $in_ser=$_POST[in_ser];
        $upordown=$_POST[upordown];
        $picsum=(int)$_POST[picsum];
        $inputval=$_POST[inputval];
        $filesernum=$_POST[filesernum];
        $align=$_POST[align];
        $imgdisplay=$_POST[imgdisplay];
        $pagenum=(int)$_POST[pagenum];
        $nowid=(int)$_POST[nowid];
      
      //,test,0,0,0,0,1546938578516,title,,1,up,1,一、  (T),a18902182280201913175216,left,block,1,208
      
     // 	$src='.';$kind='test';$img_x=0;$img_y=0;$img_width=0;$img_height=0;$tsernum='1546938578516';$inputname='title';$ctbname='';$in_ser=1;$upordown='up';$picsum=1;
     //	$inputval='一、  (T)';$filesernum='a18902182280201913175216';$align='left';$imgdisplay='block';$pagenum=1;$nowid='208';

        $model = M('test_public_data');
        $array1['id']=$nowid;
        $model1 = M('test_public_data');
        $model2 = M('img_cuted_data');


        if($ctbname=='t0' || $ctbname=='t1'){
            updowntestsernum($in_ser,$upordown,$filesernum);
            $data1array['src']=$src;
            $data1array['kind']=$kind;
            $data1array['img_x']=$img_x;
            $data1array['img_y']=$img_y;
            $data1array['img_width']=$img_width;
            $data1array['img_height']=$img_height;
            $id = D('img_cuted_data')->add($data1array);

            $data2array['srcid']=$id;

            if($upordown=='down')
            {
                $in_ser=(int)$in_ser+1;
            }

            $data2array['in_ser']=$in_ser;
            $data2array['tsernum']=$tsernum;
            $data2array['inputname']=$inputname;
            $data2array['ctbname']=$ctbname;
            $data2array['kind']=$kind;
            $data2array['upordown']=$upordown;

            $data2array['pic1']=0;
            $data2array['pic2']=0;
            $data2array['pic3']=0;
            $data2array['pic4']=0;

            $data2array['picsum']=$picsum;
            $data2array['inputval']=$inputval;
            $data2array['filesernum']=$filesernum;
            $data2array['align']=$align;
            $data2array['imgdisplay']=$imgdisplay;
            $data2array['pagenum']=$pagenum;

            $finishid = D('test_public_data')->add($data2array);


            $model = M('test_public_data');

            $oldfilesernum=$model->where("id=".$nowid)->field('tsernum')->find();

            if($oldfilesernum[tsernum]!=0){
                $arraym[tsernum]=$oldfilesernum[tsernum];
                $arraym[kind]=$kind;
                $arraym[filesernum]=$filesernum;
                $max=$model->where($arraym)->max('in_ser');
                //相关A标题进行排序
                $arraym[in_ser]=array('gt',$in_ser);
                $resultm=$model->where($arraym)->select();
                $countm=$model->where($arraym)->count();

                if($countm>0)
                {
                    for($i=0;$i<$countm;$i++)
                    {
                        $newarrayt[tsernum]=$tsernum;
                        $model->where('id='.(int)$resultm[$i][id])->save($newarrayt);
                    }
                }
            }

            echo 1;

        }
        if($ctbname=='a'){
            updowntestsernum($in_ser,$upordown,$filesernum);
            $data1array['src']=$src;
            $data1array['kind']=$kind;
            $data1array['img_x']=$img_x;
            $data1array['img_y']=$img_y;
            $data1array['img_width']=$img_width;
            $data1array['img_height']=$img_height;
            $id = D('img_cuted_data')->add($data1array);

            $data2array['srcid']=$id;

            if($upordown=='down')
            {
                $in_ser=(int)$in_ser+1;
            }

            $data2array['in_ser']=$in_ser;
            $data2array['tsernum']=$tsernum;
            $data2array['inputname']=$inputname;
            $data2array['ctbname']=$ctbname;
            $data2array['kind']=$kind;
            $data2array['upordown']=$upordown;

            $data2array['pic1']=0;
            $data2array['pic2']=0;
            $data2array['pic3']=0;
            $data2array['pic4']=0;

            $data2array['picsum']=$picsum;
            $data2array['inputval']=$inputval;
            $data2array['filesernum']=$filesernum;
            $data2array['align']=$align;
            $data2array['imgdisplay']=$imgdisplay;
            $data2array['pagenum']=$pagenum;

            echo $finishid = D('test_public_data')->add($data2array);
        }
        if($ctbname=='t-a'){
            updowntestsernum($in_ser,$upordown,$filesernum);
            $data1array['src']=$src;
            $data1array['kind']=$kind;
            $data1array['img_x']=$img_x;
            $data1array['img_y']=$img_y;
            $data1array['img_width']=$img_width;
            $data1array['img_height']=$img_height;
            $id = D('img_cuted_data')->add($data1array);

            $data2array['srcid']=$id;

            if($upordown=='down')
            {
                $in_ser=(int)$in_ser+1;
            }
            $data2array['in_ser']=$in_ser;
            $data2array['tsernum']=$tsernum;
            $data2array['inputname']=$inputname;
            $data2array['ctbname']=$ctbname;
            $data2array['kind']=$kind;
            $data2array['upordown']=$upordown;

            $data2array['pic1']=0;
            $data2array['pic2']=0;
            $data2array['pic3']=0;
            $data2array['pic4']=0;

            $data2array['picsum']=$picsum;
            $data2array['inputval']=$inputval;
            $data2array['filesernum']=$filesernum;
            $data2array['align']=$align;
            $data2array['imgdisplay']=$imgdisplay;
            $data2array['pagenum']=$pagenum;

            echo $finishid = D('test_public_data')->add($data2array);
        }



    }
    public function movedatasql(){
        $id=$_POST[id];
        $num1=(int)$_POST[num1];
        $num2=(int)$_POST[num2];

        $picnum1='pic'.$num1;
        $picnum2='pic'.$num2;



        $array1['id']=$id;
        $model1 = M('test_public_data');
        $ta=$model1->where($array1)->find();
        $pic1val=$ta[$picnum1];
        $pic2val=$ta[$picnum2];

        $arrayimg[$picnum1]=$pic2val;
        $arrayimg[$picnum2]=$pic1val;


       echo $model1->where($array1)->save($arrayimg);

    }
    public function imgidtosrcsql(){
        $id=$_POST[id];
        $model = M('img_cuted_data');
        $data= $model->where("id=".$id)->find();
        echo usersrc($data[src]);
    }
    public function addanswersql(){
      $model=M('img_cuted_data');
      $nowanswerid=$_POST[nowanswerid];
      if($nowanswerid!=0){
         $answerdata=$model->where('id='.$nowanswerid)->find();
          $src=$answerdata['src'];
          unlink($src);
          $model->where('id='.$nowanswerid)->delete();
      }

      $src1 = cutanswersub($_POST['x'], $_POST['y'], $_POST['width'], $_POST['height'], $_POST['src']);

      $newanswer['src']='.'.$src1;
      $newanswer['kind']='answer';
      $newanswer['img_x']=0;
      $newanswer['img_y']=0;
      $newanswer['img_width']=0;
      $newanswer['img_height']=0;
      $id=D('img_cuted_data')->add($newanswer);
      $answerid['answerid']=(int)$id;

      $array['id']=(int)$_POST[nowtestid];
      $result=$model->where($array)->save($answerid);

      $data['answerid']=$id;
      $data['src']=$src1;

      echo json_encode($data);

    }
    public function jsanswereditsub()
    {
        $id=$_POST[id];
        $answerid=$_POST[answerid];
        $model=M('img_cuted_data');
        $result=$model->where('id='.$answerid)->find();
        $model->where('id='.$answerid)->delete();
        $array['answerid']=0;
        $model->where('id='.$id)->save($array);
        unlink($result[src]);
        echo 1;
    }
    public function addotheranswersql(){
        $model=M('img_cuted_data');
        $x=$_POST[x];
        $y=$_POST[y];
        $width=$_POST[width];
        $height=$_POST[height];
        $src=$_POST[src];
        $id=(int)$_POST[nowanswerid];
        $result=$model->where('id='.$id)->find();
        $src1=$result[src];
        $src2 = cutanswersub($_POST['x'], $_POST['y'], $_POST['width'], $_POST['height'], $_POST['src']);
        $src2 = '.'.$src2;
        addanswerimgto($src1,$src2);
        echo usersrc($src1)."?".mt_rand();
    }
    public function erase_del05(){
        $filesernum=$_GET[filesernum];
        $mykind=$_GET[kind];
        $oldstatus=$_GET[oldstatus];


        //$filesernum='system20181211104511';
        //$mykind="key";
		//$oldstatus=0;
      
      
        $model = M('test_public_data');
        $model1= M('img_cuted_data');
      
        
      

      
      if($mykind=="key")
      {
         $model2=M('key_paper_msg_data');
      }
      else
      {
         $model2=M('paper_msg_data');
      }
      
        $model3=M('questiontypes');

        $array[filesernum]=$filesernum;
        $array[kind]='test';
        $data= $model->where($array)->order('in_ser asc')->select();
        $count=$model->where($array)->count();

        $array12['filesernum'] =$filesernum;
        $nomsg = $model2->where($array12)->find();
      
        $title=$nomsg['paper_name'];
        $subjectid=$nomsg['subjectid'];
      



        $questionarr['subjectid']=$subjectid;

        $questiontype= $model3->where($questionarr)->select();



        for($i=0;$i<$count;$i++)
        {
            $ta=$model1->where('id='.$data[$i][srcid])->find();
            $img[$i][src]=usersrc($ta[src]);
            $img[$i][title]=cuttitlemsg($data[$i][inputval]);
            $imgxy=imgxy($ta[src]);
            $img[$i][imgx]=$imgxy[x];


            $pic1=$model1->where('id='.$data[$i][pic1])->find();
            $pic2=$model1->where('id='.$data[$i][pic2])->find();
            $pic3=$model1->where('id='.$data[$i][pic3])->find();
            $pic4=$model1->where('id='.$data[$i][pic4])->find();

            $img[$i][pic1src]=usersrc($pic1[src]);
            $imgxy1=imgxy($pic1[src]);
            $img[$i][pic1x]=$imgxy1[x];

            $img[$i][pic2src]=usersrc($pic2[src]);
            $imgxy2=imgxy($pic2[src]);
            $img[$i][pic2x]=$imgxy2[x];


            $img[$i][pic3src]=usersrc($pic3[src]);
            $imgxy3=imgxy($pic3[src]);
            $img[$i][pic3x]=$imgxy3[x];


            $img[$i][pic4src]=usersrc($pic4[src]);
            $imgxy4=imgxy($pic4[src]);
            $img[$i][pic4x]=$imgxy4[x];
            $tdata[$i][myid]=$data[$i][id];
            $tdata[$i][id]=$data[$i][srcid];
            $tdata[$i][src]=usersrc($ta[src]);
            $tdata[$i][x]=$ta[img_x];
            $tdata[$i][y]=$ta[img_y];
            $tdata[$i][width]=$ta[img_width];
            $tdata[$i][height]=$ta[img_height];
            $tdata[$i][questionnum]=$data[$i][questionnum];
            $typeid=$data[$i][typeid];







            if($typeid!='' || $typeid!=0)
            {
               // echo $typeid.'<br>';
               $datatype= $model3->where('id='.$typeid)->find();
               $tdata[$i][typesmsg]=$datatype[typesmsg];
            }
            else
            {
                $tdata[$i][typesmsg]='未选择';
            }
            $tdata[$i][title]=cuttitlemsg($data[$i][inputval]);

            $imgxy=imgxy($ta[src]);
            $tdata[$i]['rationa']=round((int)$imgxy[x]/1200,3);
            $tdata[$i]['rationb']=round((int)$imgxy[x]/150,3);
            if($ta[answerid]=='' || $ta[answerid]==0)
            {

            }
            else
            {
                $aa=$model1->where('id='.$ta[answerid])->find();
                $adata[$i][id]=$ta[answerid];
                $adata[$i][src]=usersrc($aa[src]);
                $adata[$i][x]=$aa[img_x];
                $adata[$i][y]=$aa[img_y];
                $adata[$i][width]=$aa[img_width];
                $adata[$i][height]=$aa[img_height];


                $adata[$i][questiontype]=$aa[questiontype];

                if($adata[$i][questiontype]=='')
                {
                    $adata[$i][questiontype]=0;
                }


                $adata[$i][title]=cuttitlemsg($data[$i][inputval]);
                $imgxy=imgxy($aa[src]);

                $adata[$i]['rationa']=round($imgxy[x]/1200,3);
                $adata[$i]['rationb']=round($imgxy[x]/150,3);

            }
        }
        
        $subject=M('subject_data');
        $subjectid=$subject->select();
        $this->assign('subjectid',$subjectid);
        
        $questiontypes=$model3->select();
        $this->assign('questiontypes',$questiontypes);
 
        $this->assign('questiontype',$questiontype);
        $this->assign('title',$title);
        $this->assign('filesernum',$filesernum);
        $this->assign('timg',$img);
        $this->assign('tdata',$tdata);
        $this->assign('adata',$adata);
        $this->assign('oldstatus',$oldstatus);
        $this->assign('kind',$mykind);


       $this->display();


    }
    public function erasetestsql()
    {
        $kind=$_POST[kind];
        $id=$_POST[id];
        $x=$_POST[x];
        $y=$_POST[y];
        $width=$_POST[width];
        $height=$_POST[height];
        $src='.'.$_POST[src];
        $r=255;
        $g=255;
        $b=255;


        $model= M('img_cuted_data');
        if($kind=='title')
        {
            $myid['id']=(int)$id;
//            $img['img_x']=(int)$x;
//            $img['img_y']=(int)$y;
//            $img['img_width']=(int)$width;
//            $img['img_height']=(int)$height;
//            $model->where($myid)->save($img);
        }else
        {
//            $img['img_x']=0;
//            $img['img_y']=0;
//            $img['img_width']=0;
//            $img['img_height']=0;
        }
        erasesub($x,$y,$width,$height,$src,$r,$g,$b);
        echo 1;
    }
    public function test12()
    {

        $model2=M('paper_msg_data');
        $array['filesernum'] = 'a189021822802018527115631';
        $nomsg = $model2->where($array)->find();
       $title=$nomsg[paper_name];
        print_r($title);
    }
    public function noisesub(){
        $src=$_POST[src];
        publicnoisesub($src);
        $src=usersrc($src);
        echo $src."?".mt_rand();
    }
    public function titledatasql(){
        $arrid=$_POST[arrid];
        $arrtitle=$_POST[arrtitle];
        $sum=$_POST[sum];
        $sum=$sum-1;

        $iarrid = explode(",", $arrid);
        $iarrtitle = explode(",", $arrtitle);

        $model=M('test_public_data');
        for($i=0;$i<$sum;$i++)
        {
            $id['id']=$iarrid[$i];
            $title['inputval']=$iarrtitle[$i];
            $model->where($id)->save($title);

        }
    }
    public function finish06(){

        $filesernum=$_GET['filesernum'];
        $mykind=$_GET['kind'];
        $oldstatus=$_GET['oldstatus'];
      
      
		//$filesernum='system201913201423';$mykind='key';$oldstatus='1';
      

        $nowfilesernum['filesernum']=$filesernum;

        $model_public=M('test_public_data');
        $model_onekeynote=M('onekeynote');
      
        $arr['filesernum']=$filesernum;
        $arr['ctbname']=array('in','t-a,a');
        $count=$model_public->where($arr)->count();

        //一会修改

        $nowstatusmsg['submittime']=date('y-m-d h:i:s',time());
        $nowstatusmsg['questionsum']=$count;
      
        if($oldstatus==0 || $oldstatus==0)
        {
           $nowstatusmsg['statusmsg']=$_GET['statusmsg'];
          
        }
      



        if($mykind=='school')
        {
            $model = M("paper_msg_data");
            $data_sum=$model->where($nowfilesernum)->find();
          	$old_questionsum=$data_sum['questionsum'];
            $model->where($nowfilesernum)->save($nowstatusmsg);
          
           
          
        }else{
            $model = M("key_paper_msg_data");   
            $data_sum=$model->where($nowfilesernum)->find();
            $old_questionsum=$data_sum['questionsum'];
            $model->where($nowfilesernum)->save($nowstatusmsg); 

          
   
      //在数据库中进行习题总数相加
        $testdata=$model->where($nowfilesernum)->find();      
        $keynote_id=explode(',',$testdata['keynote_id']);
      
        for($i=0;$i<sizeof($keynote_id);$i++)
        {
             $onekeynote_data=$model_onekeynote->where('id='.$keynote_id[$i])->find();
             $nowquestion_sum=$onekeynote_data['question_sum'];
          	 $nowquestion_sum=$nowquestion_sum+$count;
             $nowquestion_arr['question_sum']=$nowquestion_sum;    
             $model_onekeynote->where('id='.$keynote_id[$i])->save($nowquestion_arr);

         
        }

      
      //如果，习题已经存在，则把多加的总数减去
        if($oldstatus==1)
        {
           $nowstatusmsg['statusmsg']=$_GET['statusmsg'];
          
           $testdata=$model->where($nowfilesernum)->find();      
           $keynote_id=explode(',',$testdata['keynote_id']); 
          
          
       		 for($i=0;$i<sizeof($keynote_id);$i++)
       		 {
             $onekeynote_data1=$model_onekeynote->where('id='.$keynote_id[$i])->find();
             $nowquestion_sum=$onekeynote_data1['question_sum'];
               
               
          	 $nowquestion_sum=$nowquestion_sum-$old_questionsum;
             $old_nowquestion_arr['question_sum']=$nowquestion_sum;    
               
        
               
             $model_onekeynote->where('id='.$keynote_id[$i])->save($old_nowquestion_arr);
       		}
        }
      }


        $this->redirect('Publishpanel/test_list01','', 0, '页面跳转中...');
    }
    public function test_preview_06(){
        $filesernum=$_GET['filesernum'];
        $imgscale=0.371;

        $model = M('test_public_data');
        $model1= M('img_cuted_data');
        $model2=M('paper_msg_data');
        $model3=M('questiontypes');

        $array[kind]='test';
        $array[filesernum]=$filesernum;
        $data= $model->where($array)->order('in_ser asc')->select();
        $count=$model->where($array)->count();

        $array12['filesernum'] =$filesernum;
        $nomsg = $model2->where($array12)->find();
        $title=$nomsg[paper_name];

        for($i=0;$i<$count;$i++)
        {
            $ta=$model1->where('id='.$data[$i][srcid])->find();

            $typemsg=$model3->where('id='.$data[$i]['typeid'])->find();

            $test[$i]['typesmsg']=$typemsg['typesmsg'];

            $sum=0;
            if($data[$i][pic1]!=0)
            {
                $picta=$model1->where('id='.$data[$i][pic1])->find();
                $test[$i]['pic1']=$picta[src];


                $test[$i]['pic1_img_x']=imgxy($picta[src])[x]*$imgscale;
                $test[$i]['pic1_img_y']=imgxy($picta[src])[y]*$imgscale;


                $test[$i]['pic1_o_img_x']=imgxy($picta[src])[x];
                $test[$i]['pic1_o_img_y']=imgxy($picta[src])[y];

                $sum=$sum+1;
            }
            else{
                $test[$i]['pic1']=0;
            }
            if($data[$i][pic2]!=0)
            {
                $picta=$model1->where('id='.$data[$i][pic2])->find();
                $test[$i]['pic2']=$picta[src];


                $test[$i]['pic2_img_x']=imgxy($picta[src])[x]*$imgscale;
                $test[$i]['pic2_img_y']=imgxy($picta[src])[y]*$imgscale;

                $test[$i]['pic2_o_img_x']=imgxy($picta[src])[x];
                $test[$i]['pic2_o_img_y']=imgxy($picta[src])[y];

                $sum=$sum+1;
            }
            else{
                $test[$i]['pic2']=0;
            }
            if($data[$i][pic3]!=0)
            {
                $picta=$model1->where('id='.$data[$i][pic3])->find();
                $test[$i]['pic3']=$picta[src];
                $sum=$sum+1;

                $test[$i]['pic3_img_x']=imgxy($picta[src])[x]*$imgscale;
                $test[$i]['pic3_img_y']=imgxy($picta[src])[y]*$imgscale;

                $test[$i]['pic3_o_img_x']=imgxy($picta[src])[x];
                $test[$i]['pic3_o_img_y']=imgxy($picta[src])[y];
            }
            else{
                $test[$i]['pic3']=0;
            }
            if($data[$i][pic4]!=0)
            {
                $picta=$model1->where('id='.$data[$i][pic4])->find();
                $test[$i]['pic4']=$picta[src];

                $test[$i]['pic4_img_x']=imgxy($picta[src])[x]*$imgscale;
                $test[$i]['pic4_img_y']=imgxy($picta[src])[y]*$imgscale;

                $test[$i]['pic4_o_img_x']=imgxy($picta[src])[x];
                $test[$i]['pic4_o_img_y']=imgxy($picta[src])[y];
                $sum=$sum+1;
            }
            else{
                $test[$i]['pic4']=0;
            }


            $test[$i]['title']=cuttitlemsg($data[$i][inputval]);
            $test[$i]['src']=$ta[src];
            $test[$i]['picsum']=$sum;
            $test[$i]['kind']=$data[$i][inputname];
            $test[$i]['img_x']=imgxy($ta[src])[x]*$imgscale;
            $test[$i]['img_y']=imgxy($ta[src])[y]*$imgscale;


        }
      //  print_r($test);

        $pdf = new \TCPDF('P', 'mm', array(874.89,1232.25), true, 'UTF-8', false);

        //页眉：43，页面高度：1160

// 设置文档信息
        $pdf->SetCreator('haohaoCtb');
        $pdf->SetAuthor('haohaoCtb');
        $pdf->SetTitle('好好学习，天天向上！');
        $pdf->SetSubject('错题本');
        $pdf->SetKeywords('错题本');

// 设置页眉和页脚信息
        $pdf->SetHeaderData('', '0', '好好错题本——好好学习，天天向上', array(0,64,255), array(0,64,128));
        $pdf->setFooterData(array(0,64,0), array(0,64,128));
// 设置页眉和页脚字体
        $pdf->setHeaderFont(Array('stsongstdlight', '', '30'));

// 设置默认等宽字体
        $pdf->SetDefaultMonospacedFont('stsongstdlight');
        $pdf->setFontSubsetting(true);

// 设置间距,中间80表示到页面顶端的距离
        $pdf->SetMargins(35, 80, 35);
        $pdf->SetHeaderMargin(5);
        $pdf->SetFooterMargin(20);


        $pdf->setFooterFont(Array('stsongstdlight', '100', 30));
// 设置分页
        $pdf->SetAutoPageBreak(TRUE, 25);

// set image scale factor
        $pdf->setImageScale(0.95);

//设置字体
        $pdf->SetFont('stsongstdlight', '', 80);
        $pdf->AddPage();
        $pdf->Write(0,$title,'', 0, 'C', true, 0, false, false, 0);
        $pdf->SetFont('stsongstdlight', '', 45);

        $height=148;
        $leaveheight=1180;

        $between_test_height=10;


        for($j=0;$j<$count;$j++)
        {

            if($test[$j]['img_x']!=0)
            {

                if(((int)$test[$j]['img_y']+(int)$height)>$leaveheight)
                {
                    $pdf->AddPage();
                    $height=80;
                }

                $pdf->Image($test[$j][src], 70,$height, '', '', '', '', '', false, 72, '', false, false, 0, false, false, false);
                $pdf->MultiCell(60, 20,$test[$j][title], $border=0, $align='R',$fill=false, $ln=1, $x='10', $y=(int)$height+5,  $reseth=true, $stretch=0,$ishtml=false, $autopadding=true, $maxh=0, $valign='T', $fitcell=false);
                $height=(int)$height+(int)$test[$j]['img_y']+$between_test_height;


                if($test[$j]['picsum']>0)
                {
                    if($test[$j]['picsum']==1)
                    {
                        if(((int)$test[$j]['pic1_img_y']+(int)$height)>$leaveheight)
                        {
                            $pdf->AddPage();
                            $height=80;
                        }

                        $x=$test[$j]['img_x']-$test[$j]['pic1_img_x'];

                        $pdf->Image($test[$j][pic1],$x,$height, '', '', '', '', '', false, 72, '', false, false, 0, false, false, false);
                       // $picmsg='题'+$test[$j][title]+'图';

                        $pdf->SetFont('stsongstdlight', '', 30);

                        $picmsg='题 '.$test[$j][title].'图';


                        $picmsg=str_replace(".","",$picmsg);
                        $picmsg=str_replace("、","",$picmsg);


                        $height=(int)$height+(int)$test[$j]['pic1_img_y']+5;

                        $pdf->MultiCell(100, 20,$picmsg, $border=0, $align='R',$fill=false, $ln=1, $x-20, $y=(int)$height,  $reseth=true, $stretch=0,$ishtml=false, $autopadding=true, $maxh=0, $valign='T', $fitcell=false);

                        $pdf->SetFont('stsongstdlight', '', 45);
                        $height=(int)$height+20;

                    }
                    if($test[$j]['picsum']==2)
                    {
                        if((int)$test[$j]['pic1_img_x']+(int)$test[$j]['pic2_img_x']>850)
                        {
                            if(((int)$test[$j]['pic1_img_y']+(int)$height)>$leaveheight)
                            {
                                $pdf->AddPage();
                                $height=80;
                            }


                            $x=$test[$j]['img_x']-$test[$j]['pic1_img_x'];
                            $pdf->Image($test[$j][pic1],$x,$height, '', '', '', '', '', false, 72, '', false, false, 0, false, false, false);
                            $height=(int)$height+(int)$test[$j]['pic1_img_y']+5;



                            if(((int)$test[$j]['pic2_img_y']+(int)$height)>$leaveheight)
                            {
                                $pdf->AddPage();
                                $height=80;
                            }

                            $x=$test[$j]['img_x']-$test[$j]['pic2_img_x'];

                            if($x<50)
                            {
                                $x=50;
                            }
                            $pdf->Image($test[$j][pic2],$x,$height, '', '', '', '', '', false, 72, '', false, false, 0, false, false, false);
                            $height=(int)$height+(int)$test[$j]['pic2_img_y']+5;



                            $picmsg='题 '.$test[$j][title].'图';
                            $pdf->SetFont('stsongstdlight', '', 30);
                            $pdf->MultiCell(100, 20,$picmsg, $border=0, $align='R',$fill=false, $ln=1,  $x-20, $y=(int)$height,  $reseth=true, $stretch=0,$ishtml=false, $autopadding=true, $maxh=0, $valign='T', $fitcell=false);
                            $pdf->SetFont('stsongstdlight', '', 45);
                            $height=(int)$height+20;

                        }
                        if((int)$test[$j]['pic1_img_x']+(int)$test[$j]['pic2_img_x']<=850)
                        {

                            if($test[$j]['pic1_img_y']>=$test[$j]['pic2_img_y'])
                            {
                                if(((int)$test[$j]['pic1_img_y']+(int)$height)>$leaveheight)
                                {
                                    $pdf->AddPage();
                                    $height=80;
                                }
                            }
                            else{
                                if(((int)$test[$j]['pic2_img_y']+(int)$height)>$leaveheight)
                                {
                                    $pdf->AddPage();
                                    $height=80;
                                }
                            }



                            $x=$test[$j]['img_x']-$test[$j]['pic1_img_x']-$test[$j]['pic2_img_x']-5;
                            $pdf->Image($test[$j][pic1],$x,$height, '', '', '', '', '', false, 72, '', false, false, 0, false, false, false);

                            $x=$test[$j]['img_x']-$test[$j]['pic2_img_x'];
                            $pdf->Image($test[$j][pic2],$x,$height, '', '', '', '', '', false, 72, '', false, false, 0, false, false, false);


                            if($test[$j]['pic1_img_y']>$test[$j]['pic2_img_y'])
                            {
                                $height=(int)$height+(int)$test[$j]['pic1_img_y']+5;
                            }
                            else
                            {
                                $height=(int)$height+(int)$test[$j]['pic2_img_y']+5;
                            }

                            $picmsg='题 '.$test[$j][title].'图';
                            $pdf->SetFont('stsongstdlight', '', 30);
                            $pdf->MultiCell(100, 20,$picmsg, $border=0, $align='R',$fill=false, $ln=1, $x-20, $y=(int)$height,  $reseth=true, $stretch=0,$ishtml=false, $autopadding=true, $maxh=0, $valign='T', $fitcell=false);
                            $pdf->SetFont('stsongstdlight', '', 45);
                            $height=(int)$height+20;

                        }


                    }
                    if($test[$j]['picsum']==3)
                    {
                           if((int)$test[$j]['pic1_img_x']+(int)$test[$j]['pic2_img_x']+(int)$test[$j]['pic3_img_x']>850)
                           {

                               $img1_y=$test[$j]['pic1_img_y']/($test[$j]['pic1_img_x']/120);
                               $img2_y=$test[$j]['pic2_img_y']/($test[$j]['pic2_img_x']/120);
                               $img3_y=$test[$j]['pic3_img_y']/($test[$j]['pic3_img_x']/120);


                               $myheight=$img1_y;


                               if($img2_y>$myheight)
                               {
                                   $myheight=$img2_y;
                               }

                               if($img3_y>$myheight)
                               {
                                   $myheight=$img3_y;
                               }


                               if (((int)$myheight + (int)$height) > $leaveheight) {
                                   $pdf->AddPage();
                                   $height = 80;
                               }

                                $x=300;
                                $pdf->Image($test[$j][pic1],$x,$height, '120', '', '', '', '', false, 72, '', false, false, 0, false, false, false);
                                $x=430;
                                $pdf->Image($test[$j][pic2],$x,$height, '120', '', '', '', '', false, 72, '', false, false, 0, false, false, false);
                                $x=560;
                                $pdf->Image($test[$j][pic3],$x,$height, '120', '', '', '', '', false, 72, '', false, false, 0, false, false, false);

                                $img1_y=$test[$j]['pic1_img_y']/($test[$j]['pic1_img_x']/120);
                                $img2_y=$test[$j]['pic2_img_y']/($test[$j]['pic2_img_x']/120);
                                $img3_y=$test[$j]['pic3_img_y']/($test[$j]['pic3_img_x']/120);


                               $myheight=$img1_y;


                                if($img2_y>$myheight)
                                {
                                    $myheight=$img2_y;
                                }

                               if($img3_y>$myheight)
                               {
                                   $myheight=$img3_y;
                               }

                               $height=(int)$height+$myheight+5;
                               $picmsg='题 '.$test[$j][title].'图';
                               $pdf->SetFont('stsongstdlight', '', 30);
                               $pdf->MultiCell(100, 20,$picmsg, $border=0, $align='R',$fill=false, $ln=1,  430,$height,  $reseth=true, $stretch=0,$ishtml=false, $autopadding=true, $maxh=0, $valign='T', $fitcell=false);



                               $pdf->SetFont('stsongstdlight', '', 45);
                               $height=(int)$height+20;

                               $height=300;

                           }

                           else
                           {

                               if($test[$j]['pic1_img_y']>=$test[$j]['pic2_img_y'])
                               {
                                   $myheight=$test[$j]['pic1_img_y'];
                               }
                               else
                               {
                                   $myheight=$test[$j]['pic2_img_y'];
                               }

                               if($myheight<$test[$j]['pic3_img_y'])
                               {
                                   $myheight=$test[$j]['pic3_img_y'];
                               }

                               if (((int)$myheight + (int)$height) > $leaveheight) {
                                       $pdf->AddPage();
                                       $height = 80;
                               }

                               $x=$test[$j]['img_x']-$test[$j]['pic1_img_x']-$test[$j]['pic2_img_x']-$test[$j]['pic3_img_x']-10;
                               $pdf->Image($test[$j][pic1],$x,$height, '', '', '', '', '', false, 72, '', false, false, 0, false, false, false);

                               $x=$test[$j]['img_x']-$test[$j]['pic2_img_x']-$test[$j]['pic3_img_x']-5;
                               $pdf->Image($test[$j][pic2],$x,$height, '', '', '', '', '', false, 72, '', false, false, 0, false, false, false);

                               $x=$test[$j]['img_x']-$test[$j]['pic3_img_x'];
                               $pdf->Image($test[$j][pic3],$x,$height, '', '', '', '', '', false, 72, '', false, false, 0, false, false, false);

                               $height=(int)$height+(int)$myheight+5;

                               $x=$test[$j]['img_x']-$test[$j]['pic2_img_x']-$test[$j]['pic3_img_x']-5;

                               $picmsg='题 '.$test[$j][title].'图';
                               $pdf->SetFont('stsongstdlight', '', 30);
                               $pdf->MultiCell(100, 20,$picmsg, $border=0, $align='R',$fill=false, $ln=1,  $x-20, $y=(int)$height,  $reseth=true, $stretch=0,$ishtml=false, $autopadding=true, $maxh=0, $valign='T', $fitcell=false);

                               $pdf->SetFont('stsongstdlight', '', 45);
                               $height=(int)$height+20;
                           }

                    }
                    if($test[$j]['picsum']==4)
                    {
                        if((int)$test[$j]['pic1_img_x']+(int)$test[$j]['pic2_img_x']+(int)$test[$j]['pic3_img_x']+(int)$test[$j]['pic4_img_x']>850)
                        {

                            $img1_y=$test[$j]['pic1_img_y']/($test[$j]['pic1_img_x']/120);
                            $img2_y=$test[$j]['pic2_img_y']/($test[$j]['pic2_img_x']/120);
                            $img3_y=$test[$j]['pic3_img_y']/($test[$j]['pic3_img_x']/120);
                            $img4_y=$test[$j]['pic4_img_y']/($test[$j]['pic4_img_x']/120);


                            $myheight=$img1_y;


                            if($img2_y>$myheight)
                            {
                                $myheight=$img2_y;
                            }

                            if($img3_y>$myheight)
                            {
                                $myheight=$img3_y;
                            }

                            if($img4_y>$myheight)
                            {
                                $myheight=$img4_y;
                            }


                            if (((int)$myheight + (int)$height) > $leaveheight) {
                                $pdf->AddPage();
                                $height = 80;
                            }

                            $x=200;
                            $pdf->Image($test[$j][pic1],$x,$height, '120', '', '', '', '', false, 72, '', false, false, 0, false, false, false);
                            $x=325;
                            $pdf->Image($test[$j][pic2],$x,$height, '120', '', '', '', '', false, 72, '', false, false, 0, false, false, false);
                            $x=450;
                            $pdf->Image($test[$j][pic3],$x,$height, '120', '', '', '', '', false, 72, '', false, false, 0, false, false, false);
                            $x=575;
                            $pdf->Image($test[$j][pic4],$x,$height, '120', '', '', '', '', false, 72, '', false, false, 0, false, false, false);

                            $img1_y=$test[$j]['pic1_img_y']/($test[$j]['pic1_img_x']/120);
                            $img2_y=$test[$j]['pic2_img_y']/($test[$j]['pic2_img_x']/120);
                            $img3_y=$test[$j]['pic3_img_y']/($test[$j]['pic3_img_x']/120);
                            $img4_y=$test[$j]['pic4_img_y']/($test[$j]['pic4_img_x']/120);


                            $myheight=$img1_y;


                            if($img2_y>$myheight)
                            {
                                $myheight=$img2_y;
                            }

                            if($img3_y>$myheight)
                            {
                                $myheight=$img3_y;
                            }

                            if($img4_y>$myheight)
                            {
                                $myheight=$img4_y;
                            }

                            $height=(int)$height+$myheight+5;
                            $picmsg='题 '.$test[$j][title].'图';
                            $pdf->SetFont('stsongstdlight', '', 30);
                            $pdf->MultiCell(100, 20,$picmsg, $border=0, $align='R',$fill=false, $ln=1,  400,$height,  $reseth=true, $stretch=0,$ishtml=false, $autopadding=true, $maxh=0, $valign='T', $fitcell=false);

                            $pdf->SetFont('stsongstdlight', '', 45);
                            $height=(int)$height+20;

                            $height=300;

                        }
                        else
                        {
                            $myheight=$test[$j]['pic1_img_y'];

                            if($myheight<$test[$j]['pic2_img_y'])
                            {
                                $myheight=$test[$j]['pic2_img_y'];
                            }

                            if($myheight<$test[$j]['pic3_img_y'])
                            {
                                $myheight=$test[$j]['pic3_img_y'];
                            }

                            if($myheight<$test[$j]['pic4_img_y'])
                            {
                                $myheight=$test[$j]['pic4_img_y'];
                            }


                            if (((int)$myheight + (int)$height) > $leaveheight) {
                                $pdf->AddPage();
                                $height = 80;
                            }

                            $x=$test[$j]['img_x']-$test[$j]['pic1_img_x']-$test[$j]['pic2_img_x']-$test[$j]['pic3_img_x']-$test[$j]['pic4_img_x']-15;
                            $pdf->Image($test[$j][pic1],$x,$height, '', '', '', '', '', false, 72, '', false, false, 0, false, false, false);

                            $x=$test[$j]['img_x']-$test[$j]['pic2_img_x']-$test[$j]['pic3_img_x']-$test[$j]['pic4_img_x']-10;
                            $pdf->Image($test[$j][pic2],$x,$height, '', '', '', '', '', false, 72, '', false, false, 0, false, false, false);

                            $x=$test[$j]['img_x']-$test[$j]['pic3_img_x']-$test[$j]['pic4_img_x']-5;
                            $pdf->Image($test[$j][pic3],$x,$height, '', '', '', '', '', false, 72, '', false, false, 0, false, false, false);

                            $x=$test[$j]['img_x']-$test[$j]['pic4_img_x'];
                            $pdf->Image($test[$j][pic4],$x,$height, '', '', '', '', '', false, 72, '', false, false, 0, false, false, false);

                            $height=(int)$height+(int)$myheight+5;

                            $x=$test[$j]['pic1_img_x']+$test[$j]['pic2_img_x']+$test[$j]['pic3_img_x']+$test[$j]['pic4_img_x'];
                            $x=$x/2;

                            $picmsg='题 '.$test[$j][title].'图';
                            $pdf->SetFont('stsongstdlight', '', 30);
                            $pdf->MultiCell(100, 20,$picmsg, $border=0, $align='R',$fill=false, $ln=1,  $x-20, $y=(int)$height,  $reseth=true, $stretch=0,$ishtml=false, $autopadding=true, $maxh=0, $valign='T', $fitcell=false);

                            $pdf->SetFont('stsongstdlight', '', 45);
                            $height=(int)$height+20;
                        }
                    }

                }
            }
            else
            {
                if((20+(int)$height)>1232.25)
                {

                    $pdf->AddPage();
                    $height=80;
                }

//                echo  $j.'='.$test[$j][title].$test[$i][typesmsg]."<br>";
                $pdf->MultiCell(200,20, $test[$j][title].$test[$j][typesmsg], $border=0, $align='L',$fill=false, $ln=1, $x='20', $y=(int)$height+5,  $reseth=true, $stretch=0,$ishtml=false, $autopadding=true, $maxh=0, $valign='T', $fitcell=false);
                $height=(int)$height+30;

            }


            }

       $pdf->Output('ctbtest.pdf', 'D');
     //     $pdf->Output('testctb.pdf', 'D');
        //  $pdf->Output($_SERVER['DOCUMENT_ROOT'] .'/public/' .'output.pdf', 'F');

        //PDF输出   I：在浏览器中打开，D：下载，F：在服务器生成pdf ，S：只返回pdf的字符串


        $this->display();
    }



    public function answer_preview_06(){
        $filesernum=$_GET[filesernum];
      //  $filesernum='a189021822802018618115520';
        $imgscale=0.371;

        $model = M('test_public_data');
        $model1= M('img_cuted_data');
        $model2=M('paper_msg_data');

        $array[kind]='test';
        $array[filesernum]=$filesernum;
        $data= $model->where($array)->order('in_ser asc')->select();
        $count=$model->where($array)->count();

        $array12['filesernum'] =$filesernum;
        $nomsg = $model2->where($array12)->find();
        $title=$nomsg[paper_name];

        for($i=0;$i<$count;$i++)
        {
            $ta=$model1->where('id='.$data[$i][srcid])->find();
            $answerid=$ta[answerid];

            if($answerid!=0)
            {
                $aa=$model1->where('id='.$answerid)->find();
                $answer[$i][src]=$aa[src];
            }
            else
            {
                $answer[$i][src]=0;
            }

            if(strpos($answer[$i][src],'uploads')==true) {

                $answer[$i]['kind']=1;
            }
            else
            {
                $answer[$i]['kind']=0;
            }

            $answer[$i]['title']=cuttitlemsg($data[$i][inputval]);
            $answer[$i]['src']=$aa[src];
            $answer[$i]['img_x']=imgxy($aa[src])[x]*$imgscale;
            $answer[$i]['img_y']=imgxy($aa[src])[y]*$imgscale;

        }

        $pdf = new \TCPDF('P', 'mm', array(874.89,1232.25), true, 'UTF-8', false);
// 设置文档信息
        $pdf->SetCreator('haohaoCtb');
        $pdf->SetAuthor('haohaoCtb');
        $pdf->SetTitle('好好学习，天天向上！');
        $pdf->SetSubject('错题本');
        $pdf->SetKeywords('错题本答案');

// 设置页眉和页脚信息
        $pdf->SetHeaderData('', '0', '好好错题本——好好学习，天天向上', array(0,64,255), array(0,64,128));
        $pdf->setFooterData(array(0,64,0), array(0,64,128));
// 设置页眉和页脚字体
        $pdf->setHeaderFont(Array('stsongstdlight', '', '30'));

// 设置默认等宽字体
        $pdf->SetDefaultMonospacedFont('stsongstdlight');
        $pdf->setFontSubsetting(true);

// 设置间距,中间80表示到页面顶端的距离
        $pdf->SetMargins(35, 80, 35);
        $pdf->SetHeaderMargin(5);
        $pdf->SetFooterMargin(20);
        $pdf->setFooterFont(Array('stsongstdlight', '100', 30));
// 设置分页
        $pdf->SetAutoPageBreak(TRUE, 25);

// set image scale factor
        $pdf->setImageScale(0.95);
//设置字体
        $pdf->SetFont('stsongstdlight', '', 80);
        $pdf->AddPage();
        $pdf->Write(0,$title.'答案','', 0, 'C', true, 0, false, false, 0);
        $pdf->SetFont('stsongstdlight', '', 40);

        $height=148;

        $leaveheight=1180;
        $levelwidth=780;

        $between_test_height=10;
        $bottom=0;
        $left=10;


        for($j=0;$j<$count;$j++)
        {


            if($answer[$j][kind]==1)
            {
                $text_img_leng=font_img_size_sub($answer[$j][title],7,(int)$answer[$j]['img_x']);
                $text_leng=fontsizesub($answer[$j][title],6);

                //宽度大于行宽的时候，进行换行

                if($left+$text_img_leng>$levelwidth)
                {
                    $left=10;
                    $height=$height+$bottom+35;
                }
//总体高度高于整个页面的时候，需要插入下一页
                if($height+(int)$answer[$j]['img_y']>$leaveheight)
                {
                    $pdf->AddPage();
                    $left=10;
                    $height=30;
                    $bottom=0;
                }

                $pdf->MultiCell(60, 20,$answer[$j][title], $border=0, $align='R',$fill=false, $ln=1, $x=$left, $y=(int)$height,  $reseth=true, $stretch=0,$ishtml=false, $autopadding=true, $maxh=0, $valign='T', $fitcell=false);

                $img_left=$left+$text_leng;

                $pdf->Image($answer[$j][src], $img_left,$height+1, '', '', '', '', '', false, 300, '', false, false, 0, false, false, false);

                $left=$left+$text_img_leng;

                if($bottom<(int)$answer[$j]['img_y'])
                {
                    $bottom=(int)$answer[$j]['img_y'];
                }
                if($bottom<14)
                {
                    $bottom=14;
                }


            }

            else
            {
                $text_leng=fontsizesub($answer[$j][title],7);

                if($left+$text_leng>$levelwidth)
                {
                    $left=10;
                    $height=$height+$bottom+35;
                }

                if($height+14>$leaveheight)
                {
                    $pdf->AddPage();
                    $left=10;
                    $height=30;
                    $bottom=0;
                }


                $pdf->MultiCell(60, 20,$answer[$j][title], $border=0, $align='R',$fill=false, $ln=1, $x=$left, $y=(int)$height,  $reseth=true, $stretch=0,$ishtml=false, $autopadding=true, $maxh=0, $valign='T', $fitcell=false);

                $left=$left+$text_leng;


                if($bottom<14)
                {
                    $bottom=14;
                }


            }



        }




       $pdf->Output('answerctb.pdf', 'D');
        //$this->display();
    }
    public function test_06(){
        $filesernum=$_POST[filesernum];
        $filesernum='a189021822802018527115631';

        $model = M('test_public_data');
        $model1= M('img_cuted_data');
        $model2=M('paper_msg_data');

        $pdf = new \TCPDF('P', 'px', array(400,600), true, 'UTF-8', false);

        //页眉：43，页面高度：1160

// 设置文档信息
        $pdf->SetCreator('haohaoCtb');
        $pdf->SetAuthor('haohaoCtb');
        $pdf->SetTitle('好好学习，天天向上！');
        $pdf->SetSubject('错题本');
        $pdf->SetKeywords('错题本');

// 设置页眉和页脚信息
      //  $pdf->SetHeaderData('', '0', '好好错题本——好好学习，天天向上', array(0,64,255), array(0,64,128));
        $pdf->setFooterData(array(0,64,0), array(0,64,128));
// 设置页眉和页脚字体
        $pdf->setHeaderFont(Array('stsongstdlight', '', '15'));

// 设置默认等宽字体
        $pdf->SetDefaultMonospacedFont('stsongstdlight');
        $pdf->setFontSubsetting(true);

// 设置间距,中间80表示到页面顶端的距离
        $pdf->SetMargins(15, 20, 15);
        $pdf->SetHeaderMargin(5);
        $pdf->SetFooterMargin(20);
       // $pdf->Ln($h='90', $cell=true);


      //  $pdf->setFooterFont(Array('stsongstdlight', '100', 30));
// 设置分页
        $pdf->SetAutoPageBreak(TRUE, 25);

// set image scale factor
        $pdf->setImageScale(0.95);

// t default font subsetting mode
        //  $pdf->setFontSubsetting(true);
//writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=false,  $reseth=true, $align='', $autopadding=true)
//设置字体

        $pdf->SetFont('stsongstdlight', '', 20);

        $pdf->AddPage();

        $pdf->Write(0,"河北高中初中物理试卷",'', 0, 'C', true, 0, false, false, 0);

        $pdf->SetFont('stsongstdlight', '', 20);
//1标题
        $pdf->Write(40,"1.国",'', 0, 'L', true, 0, false, false, 0);

        //   $pdf->writeHTMLCell(00, 100, '', '', "1.", 0, 0, 0, true, 'L', true);

      //  $pdf->Image('./uploads/questionanswer/2018-05-27/4321.jpg', 50,140, '', '', '', '', '', false, 72, '', false, false, 0, false, false, false);

///2标题
        $pdf->Write(40,"2.国",'', 0, 'L', true, 0, false, false, 0);

      //  $pdf->Image('./uploads/questionanswer/2018-05-27/1234.jpg', 50,275, '', '', '', '', '', false, 72, '', false, false, 0, false, false, false);


//3标题
        $pdf->Write(90,"3.国9",'', 0, 'L', true, 0, false, false, 0);

      //  $pdf->Image('./uploads/questionanswer/2018-05-27/1234.jpg', 50,625, '', '', '', '', '', false, 72, '', false, false, 0, false, false, false);


//4标题
        $pdf->Write(80,"4.国8m",'', 0, 'L', true, 0, false, false, 0);

        $pdf->Write(40,"5.国",'', 0, 'L', true, 0, false, false, 0);

       // $pdf->Image('./uploads/questionanswer/2018-05-27/4321.jpg', 50,980, '', '', '', '', '', false, 72, '', false, false, 0, false, false, false);





        $height=165;


        //  $pdf->Image('./uploads/questionanswer/2018-05-31/line.jpg', 35,$height, '', '', '', '', '', false, 300, '', false, false, 0, false, false, false);

        $height=80+80*0.353+30*0.353-5;

      //  $pdf->Image('./uploads/questionanswer/2018-05-31/line.jpg', 35,$height, '', '', '', '', '', false, 300, '', false, false, 0, false, false, false);

        //$pdf->Image('./uploads/questionanswer/2018-05-31/line.jpg', 35,1203, '', '', '', '', '', false, 300, '', false, false, 0, false, false, false);


//        http://test:85/uploads/questionanswer/2018-05-27/15x2K74182j47.jpg?1725409864

        // http://test:85/uploads/questionanswer/2018-05-27/152741m82Qz40.jpg?467415220

//输出PDF
//for($i=1;$i<400;$i++)
//{

        //    $pdf->Image('./uploads/questionanswer/2018-05-31/15jj27757a150.jpg', 100, 100,0,0, '', '', '', false, 300, '', false, false, 1, false, false, false);
        // $pdf->writeHTMLCell(00, 40, '', '', "标题很好啊", 0, 0, 0, true, 'L', true);
//        $pdf->writeHTMLCell(00, 100, '', '', "牛粪有都是", 0, 0, 0, true, 'L', true);

//}

        // $pdf->Image('./uploads/questionanswer/2018-05-31/15jj27757a150.jpg', 10,10, '88.2', '102.7', '', '', '', false, 300, '', false, false, 1, false, false, false);

        $html='123';

        //$html='<img id="textimg19" style="width: 100%" class="1929" src="./uploads/questionanswer/2018-05-27/J15274DE28694.jpg">';
        //$html = file_get_contents('http://test:85/index.php/Home/Testpanel/test');
//
//        $html ="http://www.baidu.com";
        // $pdf->writeHTML($html, true, false, true, true, '');
        $pdf->Output('output.pdf', 'I');
        //  $pdf->Output($_SERVER['DOCUMENT_ROOT'] .'/public/' .'output.pdf', 'F');

        //PDF输出   I：在浏览器中打开，D：下载，F：在服务器生成pdf ，S：只返回pdf的字符串

        // echo $html;



        $this->display();
    }
    public function cutlinesql(){
        $x=$_POST[x];
        $y=$_POST[y];
        $src=$_POST[src];
        $kind=$_POST[kind];
        cutsidesub($x,$y,$src,$kind);
        $imgxy=imgxy($src);
        $data['rationa']=round((int)$imgxy[x]/1200,3);
        $data['rationb']=round((int)$imgxy[x]/150,3);
        $data['src']=usersrc($src).'?'.mt_rand();
        $msg = json_encode($data);
        echo $msg;
    }

    public function typesql(){
   $id=$_POST[id];
   $typeid=$_POST[typeid];
   $kind=$_POST[kind];
   $filesernum=$_POST[filesernum];

//    $filesernum='a189021822802018529175822';
    $model = M('test_public_data');
    $data=$model->where('srcid='.$id)->find();
    $in_ser=$data[in_ser];

    $arr['in_ser']= array('egt',$in_ser);
    $arr['filesernum']=$filesernum;
//    $arr['ctbname']  = array('neq','a');
    $result['typeid']=$typeid;

    $model->where($arr)->save($result);

   echo 1;



}
public function test_re(){
   // echo  $filesernum=$_GET[filesernum];
    $model = M('paper_img_data');
    $modelre = M('paper_img_data_re');

    $filesernum=$_GET[filesernum];


    $array['filesernum']=$filesernum;
    $data=$model->where($array)->select();
    $count= count($data, 0);


    for($i=0;$i<$count;$i++)
    {
        unlink($data[$i]['src_pic']);

    }

    $model->where($array)->delete();
    $datare=$modelre->where($array)->select();
    $countre= count($datare, 0);

   // print_r($datare);

    for($j=0;$j<$countre;$j++)
    {
        $newdatare[$j]['new_src_pic']=str_replace('inittestimgre','inittestimg',$datare[$j]['src_pic']);
        adminsaveasfile($datare[$j]['src_pic'],$newdatare[$j]['new_src_pic']);


        $arrmsg['filesernum']=$filesernum;
        $arrmsg['src_pic']=$newdatare[$j]['new_src_pic'];
        $arrmsg['in_ser']=$datare[$j]['in_ser'];
        $arrmsg['img_kind']=$datare[$j]['img_kind'];
        $arrmsg['img_reg']=$datare[$j]['img_reg'];
        $arrmsg['img_status']=$datare[$j]['img_status'];
        $arrmsg['itop']=$datare[$j]['itop'];
        $arrmsg['ileft']=$datare[$j]['ileft'];
        $arrmsg['x']=$datare[$j]['x'];
        $arrmsg['y']=$datare[$j]['y'];
        $arrmsg['idel']=$datare[$j]['idel'];

        D('paper_img_data')->add($arrmsg);

    }
    $this->redirect('testpanel/test_whole02',array('filesernum' => $filesernum),0, '页面跳转中...');
}


public function questionnum(){
    $myval=$_POST[myval];
    $myid=$_POST[myid];

    $model = M('test_public_data');
    $iarr['id']=$myid;
    $arr['questionnum']=$myval;

    echo $model->where($iarr)->save($arr);



}

 public function testcfile(){
   
   echo 'hello12';
   
   $src1='./Public/testpic/test01.png';
   $src2='./Public/testpic/test02.png';
	
   $command = './Public/cfile/myaddcutimgto '.$src1.' '.$src2;
   echo $result = exec($command);

 }
  
}

