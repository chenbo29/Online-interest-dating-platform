<?php

/**
 * 会员注册登录
 */
namespace User\Controller;
use Common\Controller\HomeBaseController;
class IndexController extends HomeBaseController {
    //登录
	public function index() {
		$id=I("get.id");
		if(empty($id)){
            $this->error("获取用户参数失败U-I-i!");
        }
		$users_model=M("Users");
		
		$user=$users_model->where(array("id"=>$id))->find();
		
		if(empty($user)){
			$this->error("查无此人U-I-i！");
		}
		$this->assign($user);
		$this->display(":index");

    }
    
    function is_login(){
        /**/
        $orgid=$_GET['orgid'];
        //var_dump($orgid);
        $userid=sp_get_current_userid();
        if(sp_is_user_login()){
            if(sp_is_org_admin($userid,$orgid)){
                $this->ajaxReturn(array("status"=>1,"isadmin"=>1,"user"=>sp_get_current_user()));
            }else{
                $this->ajaxReturn(array("status"=>1,"isadmin"=>0,"user"=>sp_get_current_user()));
            }
            
        }else{
            $this->ajaxReturn(array("status"=>0,"info"=>"此用户未登录！"));
        }
    }

    //退出
    public function logout(){
    	$ucenter_syn=C("UCENTER_ENABLED");
    	$login_success=false;
    	if($ucenter_syn){
    		include UC_CLIENT_ROOT."client.php";
    		echo uc_user_synlogout();
    	}
    	session("user",null);//只有前台用户退出
    	redirect(__ROOT__."/");
    }
	
	public function logout2(){
    	$ucenter_syn=C("UCENTER_ENABLED");
    	$login_success=false;
    	if($ucenter_syn){
    		include UC_CLIENT_ROOT."client.php";
    		echo uc_user_synlogout();
    	}
		if(isset($_SESSION["user"])){
		$referer=$_SERVER["HTTP_REFERER"];
			session("user",null);//只有前台用户退出
			$_SESSION['login_http_referer']=$referer;
			$this->success("退出成功！",__ROOT__."/");
		}else{
			redirect(__ROOT__."/");
		}
    }

}
