<?php

/**
 * 后台首页
 */
namespace Admin\Controller;
use Common\Controller\AdminbaseController;
class IndexController extends AdminbaseController {
	
	
	function _initialize() {

		parent::_initialize();

        
		$this->initMenu();
	}


    //后台框架首页
    public function index() {
    	$orgid=$_GET['orgid'];//从前台传递过来组织id
        if(empty($orgid)){
            $this->error('组织参数传递失败！');
        }
        $Admin_Name=session('Admin_Name');
        $this->assign('Admin_Name',$Admin_Name);
    	$organization_model=M('Organization');
    	$orginfo=$organization_model->where(array('id'=>$orgid))->find();
    	$this->assign('orginfo',$orginfo);
    	$this->assign('orgid',$orgid);
    	//验证管理员有哪些可用后台模块时，必须将组织id传递过去
        $this->assign("SUBMENU_CONFIG", json_encode(D("Common/Menu")->menu_json($orgid)));

       	$this->display();
        
    }

    

}

