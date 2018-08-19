<?php
namespace Organization\Controller;
use Common\Controller\HomeBaseController;
class OrganizationController extends HomeBaseController{
	
	//coded by liu
	
	function _initialize() {
		parent::_initialize();
		$this->_model=D("Organization");
	}
	
	function index(){

        
		
	}
	function create(){//创建组织，涉及到的表：user_org    user
		if(!empty($_SESSION['user'])){ //创建组织前判断是否登陆

			$this->display();

		}
		else{
           // $this->error("您还未登录！！！");
            $this->display();
        }

	}
	function docreate(){
        //if(!sp_check_verify_code()){
        //  $this->error("验证码错误！"); //by liuyang 开发阶段省去验证码输入
        //}
        if(IS_POST)
        {
           //$this->error("提交成功！！！");
           //$this->error("提交成功！！！");
            $upload = new \Think\Upload();// 实例化上传类    
            $upload->maxSize   =     3145728 ;// 设置附件上传大小
            $upload->rootPath ='Uploads';//设置根目录
            $upload->savePath = '/organization/';//设置保存目录，相对根目录
            $upload->autoSub = false;//不生成子目录
            $upload->exts     = array('jpg', 'gif', 'png', 'bmp','jpeg');
            $upload->saveName = 'com_create_guid';// 采用GUID序列命名，确保同一秒提交也可以
            $info=$upload->uploadOne($_FILES['picload']);
            if(!$info){

                    $this->error($upload->getError());
                }


            else{


                    
                    $Abspath='Uploads'.$info['savepath'].$info['savename'];//获取图片绝对路径
                    
                    $image = new \Think\Image();
                    $image->open($Abspath);
                    $image->thumb(150,150,\Think\Image::IMAGE_THUMB_FIXED)->save($Abspath);
                    //session('abspath',$Abspath);
                    $reback=D('Organization')->tocreate($Abspath);

                   // $this->error($Abspath);
                    $this->error($reback);
            }
            

        }
        else{




            $this->error('未成功提交！');
        }

		
	}

	
}