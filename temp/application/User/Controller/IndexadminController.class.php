<?php

/**
 * 会员
 */
namespace User\Controller;
use Common\Controller\AdminbaseController;
class IndexadminController extends AdminbaseController {
    function index(){

		$orgid=$_GET['orgid'];

        $org_user_viewmodel=D("OrgUserView");
        $where['ORG_ID']=$orgid;
        $where['identify']=3;       //普通用户
        $count=$org_user_viewmodel->where($where)->count();
        $page = $this->page($count, 9);
        $lists=$org_user_viewmodel
        ->where($where)
    	->order("createtime DESC")
        ->limit($page->firstRow.','.$page->listRows)
        ->select();
        $this->assign('lists',$lists);
        $this->assign("page",$page->show('Admin'));
        $this->assign('orgid',$orgid);
        /*$users_model=M("Users");
    	$count=$users_model->where(array("user_type"=>2))->count();
    	$page = $this->page($count, 9);
    	$lists = $users_model
    	->where(array("user_type"=>2))
    	->order("create_time DESC")
    	->limit($page->firstRow . ',' . $page->listRows)
    	->select();
    	$this->assign('lists', $lists);
    	$this->assign("page", $page->show('Admin'));*/
    	/*if($_GET['menuid']!=134)//测试by liu */
    	$this->display(":index");

    }
    
    function ban(){

        $orgid=$_GET['orgid'];//传入组织id
    	$id=intval($_GET['id']);
    	if ($id) {
    		$rst = M("UserOrg")->where(array("id"=>$id,"identify"=>3))->setField('status','0');
    		if ($rst) {
    			$this->success("会员拉黑成功！", U("indexadmin/index",array("orgid"=>$orgid)));
    		} else {
    			$this->error('会员拉黑失败！');
    		}
    	} else {
    		$this->error('数据传入失败！');
    	}
    }
    
    function cancelban(){

        $orgid=$_GET['orgid'];//传入组织id
    	$id=intval($_GET['id']);
    	if ($id) {
    		$rst = M("UserOrg")->where(array("id"=>$id,"identify"=>3))->setField('status','1');
    		if ($rst) {
    			$this->success("会员启用成功！", U("indexadmin/index",array("orgid"=>$orgid)));
    		} else {
    			$this->error('会员启用失败！');
    		}
    	} else {
    		$this->error('数据传入失败！');
    	}
    }
}
