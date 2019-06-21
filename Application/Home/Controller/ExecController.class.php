<?php
namespace Home\Controller;

use Think\Controller;

class ExecController extends Controller
{
    
	//每日
    public function dayly()
    {
    	$this->inputday();
    }
    
    //每月
    public function monthly()
    {
    	//上学期期中
    	$this->last_semester_a();
    	
    	//下学期期中
    	$this->last_semester_b();
    	
    	//上学习期末
    	$this->next_semester_a();
    	
    	//下学期期末
    	$this->next_semester_b();
    }
    
    
    //习题日
    public function inputday()
    {
    	
    	$title="您的习题上新了";
    	$content="登录个人账户查看新的系统内容";
    	
    	$weixin=M('weixin_users');
    	//获取当日
    	$day=date('d');
    	//获取库中当日的用户
    	$userList=$weixin->where('input_day='.$day)->select();
    	foreach($userList as $k=>$v) {
    		if($v['email']) {
    			email($v['email'],$title,$content);
    		}
    	}
    }
    
    //上学期期中
    public function last_semester_a()
    {
    	$title="上学期期中考试复习";
    	$content="登录个人账户查看新的系统内容";
    	 
    	$weixin=M('weixin_users');
    	//获取当日
    	$month=date('m');
    	//获取库中当日的用户
    	$userList=$weixin->where('last_semester_a='.$month)->select();
    	foreach($userList as $k=>$v) {
    		if($v['email']) {
    			email($v['email'],$title,$content);
    		}
    	}
    }
    
    //下学期期中
    public function last_semester_b()
    {
    	$title="下学期期中考试复习";
    	$content="登录个人账户查看新的系统内容";
    	
    	$weixin=M('weixin_users');
    	//获取当日
    	$month=date('m');
    	//获取库中当日的用户
    	$userList=$weixin->where('last_semester_b='.$month)->select();
    	foreach($userList as $k=>$v) {
    		if($v['email']) {
    			email($v['email'],$title,$content);
    		}
    	}
    }

    //上学期期末
    public function next_semester_a()
    {
    	$title="上学期期末考试复习";
    	$content="登录个人账户查看新的系统内容";
    	 
    	$weixin=M('weixin_users');
    	//获取当日
    	$month=date('m');
    	//获取库中当日的用户
    	$userList=$weixin->where('next_semester_a='.$month)->select();
    	foreach($userList as $k=>$v) {
    		if($v['email']) {
    			email($v['email'],$title,$content);
    		}
    	}
    }
    
    //下学期期末
    public function next_semester_b()
    {
    	$title="上学期期末考试复习";
    	$content="登录个人账户查看新的系统内容";
    	
    	$weixin=M('weixin_users');
    	//获取当日
    	$month=date('m');
    	//获取库中当日的用户
    	$userList=$weixin->where('next_semester_b='.$month)->select();
    	foreach($userList as $k=>$v) {
    		if($v['email']) {
    			email($v['email'],$title,$content);
    		}
    	}
    }

}