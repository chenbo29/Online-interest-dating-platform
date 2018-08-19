<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2014 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: Tuolaji <479923197@qq.com>
// +----------------------------------------------------------------------
/**
 */
namespace Admin\Controller;
use Common\Controller\AdminbaseController;
class PublicController extends AdminbaseController {

    function _initialize() {}
    
    //后台登陆界面
    public function login() {

        $orgid=$_GET['orgid'];//传入组织id

    	if(isset($_SESSION['ADMIN_ID']) && !empty($orgid)){//已经登录
    		$this->success(L('LOGIN_SUCCESS'),U("Index/index",array('orgid'=>$orgid)));
    	}else{
    		/*if(empty($_SESSION['adminlogin'])){*/
    			redirect(__ROOT__."/");
/*    		}else{

                $this->assign("orgid",$orgid);
    			$this->display(":login");
                
    		}*/
    		
    	}
    }
    
    public function logout(){
    	session('ADMIN_ID',null); 
    	$this->redirect("public/login");
    }
    
    public function dologin(){

        $orgid=$_GET['orgid'];//传入组织id
        /*$orgid=2;*/
        if(empty($orgid)){
            $this->error(L('请通过合法途径登陆！'));/*如果没有组织id，不能登陆后台*/
        }
        if(sp_is_user_login()){
            $userid=sp_get_current_userid();
        }else{
             $this->error(L('您还没有登陆!'));
        }
        $where['user_id']=$userid;
        $where['ORG_ID']=$orgid;
        //$verrify = I("post.verify");
        //if(empty($verrify)){                     //前期调试阶段，禁用验证码
        //  $this->error(L('CAPTCHA_REQUIRED'));
        //}
        //验证码
        //if(!sp_check_verify_code()){
        //  $this->error(L('CAPTCHA_NOT_RIGHT'));  //前期调试阶段，禁用验证码
        //}
            $org_user_viewmodel=D('OrgUserView');
            $result=$org_user_viewmodel->where($where)->find();

            if(!empty($result) && $result['identify']!=3 ){
                /*判断是不是管理员,1,2为管理员,0为管理员禁用*/

                if($result['identify']==0){
                    $this->error(L('USE_DISABLED'));
                }
                if($result['identify']==2){
                $role_user_model=M("RoleUser");
                
                $role_user_join = C('DB_PREFIX').'role as b on a.role_id =b.id';
                /*获取在该组织的用户角色并检查角色是否被禁用*/
                $groups=$role_user_model->alias("a")->join($role_user_join)->where(array("user_id"=>$result["user_id"],"ORG_ID"=>$orgid,"status"=>1))->getField("role_id",true);//连接角色表和用户角色表，通过用户id查找该用户都有哪些权限
                /*角色切没有被禁用,且用户也没有被禁用*/
                /*if( $result["identify"]!=1 && ( empty($groups) || $result['status']!=1 ) ){
                    $this->error(L('USE_DISABLED'));
                }*/
                    if(empty($groups)){
                        $this->error('该管理员暂无可用权限！');
                    }
                }
                /*登入成功页面跳转，保存管理员用户名，id*/
                $_SESSION["ADMIN_ID"]=$result["user_id"];
                $_SESSION['Admin_Name']=$result["user_login"];
                $data['last_ip']=get_client_ip();
                $data['last_login_time']=time();
                /*date("Y-m-d H:i:s");*/
                /*$org_user_viewmodel->where($where)->save($data);*/
                $user_org_model=M("UserOrg");
                $where1['id']=$result['id'];
                $user_org_model->where($where1)->save($data);
                /*设置cookis*/
                setcookie("admin_username",$name,time()+30*24*3600,"/");
                //$this->assign("admin",$result);
                $this->success('登陆后台成功，正在跳转……',U('Index/index',array('orgid'=>$orgid)));
            }else{/*该组织不存在该管理员！*/
                $this->error(L('USERNAME_NOT_EXIST'));
            }

     //    $orgid=$_GET['orgid'];//传入组织id
     //    /*if($orgid==2){
     //        $this->success("good");
     //    }*/
    	// $name = I("post.username");
     //    if(empty($orgid)){
     //        $this->error(L('请通过合法途径登陆！'));/*如果没有组织id，不能登陆后台*/
     //    }
    	// if(empty($name)){
    	// 	$this->error(L('USERNAME_OR_EMAIL_EMPTY'));
    	// }
    	// $pass = I("post.password");
    	// if(empty($pass)){
    	// 	$this->error(L('PASSWORD_REQUIRED'));
    	// }
    	// $verrify = I("post.verify");
    	// //if(empty($verrify)){                     //前期调试阶段，禁用验证码
    	// //	$this->error(L('CAPTCHA_REQUIRED'));
    	// //}
    	// //验证码
    	// //if(!sp_check_verify_code()){
    	// //	$this->error(L('CAPTCHA_NOT_RIGHT'));  //前期调试阶段，禁用验证码
    	// //}else
     //    {
    	// 	$user = D("Common/Users");
    	// 	if(strpos($name,"@")>0){//邮箱登陆
    	// 		$where['user_email']=$name;//暂时没有邮箱登陆
     //            $where['ORG_ID']=$orgid;
    	// 	}else{
    	// 		$where['user_login']=$name;
     //            $where['ORG_ID']=$orgid;
    	// 	}

    	// 	//$result = $user->where($where)->find();
     //        /*
     //        $user_org_model=M("UserOrg");
        
     //        $org_user_join = C('DB_PREFIX').'users as b on a.user_id =b.id';
     //            //连接用户表和用户组织表
     //        $result=$user_org_model->field('user_login,user_pass,user_id,ORG_ID,identify,status')->alias("a")->join($org_user_join)->where($where)->find();
     //        */
     //        $org_user_viewmodel=D('OrgUserView');
     //        $result=$org_user_viewmodel->where($where)->find();

     //        /*if($result['identify']==1){

     //            $this->success($result['user_login']);

     //        }*/

    	// 	if(!empty($result) && $result['identify']!=3 ){
     //            /*判断是不是管理员,1,2为管理员,0为管理员禁用*/

    	// 		if($result['user_pass'] == sp_password($pass)){/*密码正确*/
     //                if($result['identify']==0){
     //                    $this->error(L('USE_DISABLED'));
     //                }
    	// 			if($result['identify']==2){
    	// 			$role_user_model=M("RoleUser");
    				
    	// 			$role_user_join = C('DB_PREFIX').'role as b on a.role_id =b.id';
    	// 			/*获取在该组织的用户角色并检查角色是否被禁用*/
    	// 			$groups=$role_user_model->alias("a")->join($role_user_join)->where(array("user_id"=>$result["user_id"],"ORG_ID"=>$orgid,"status"=>1))->getField("role_id",true);//连接角色表和用户角色表，通过用户id查找该用户都有哪些权限
    	// 			/*角色切没有被禁用,且用户也没有被禁用*/
    	// 			/*if( $result["identify"]!=1 && ( empty($groups) || $result['status']!=1 ) ){
    	// 				$this->error(L('USE_DISABLED'));
    	// 			}*/
     //                    if(empty($groups)){
     //                        $this->error('该管理员暂无可用权限！');
     //                    }
     //                }
    	// 			/*登入成功页面跳转，保存管理员用户名，id*/
    	// 			$_SESSION["ADMIN_ID"]=$result["user_id"];
    	// 			//$_SESSION['name']=$result["user_login"];
    	// 			$data['last_ip']=get_client_ip();
    	// 			$data['last_login_time']=time();
     //                /*date("Y-m-d H:i:s");*/
    	// 			/*$org_user_viewmodel->where($where)->save($data);*/
     //                $user_org_model=M("UserOrg");
     //                $where1['id']=$result['id'];
     //                $user_org_model->where($where1)->save($data);
     //                /*设置cookis*/
    	// 			setcookie("admin_username",$name,time()+30*24*3600,"/");
     //                /*传递组织id*/
    	// 			$this->success(L('LOGIN_SUCCESS'),U("Index/index",array("orgid"=>$orgid)));
    	// 		}else{

    	// 			    $this->error(L('PASSWORD_NOT_RIGHT'));
    	// 		}
    	// 	}else{/*该组织不存在该管理员！*/
    	// 		$this->error(L('USERNAME_NOT_EXIST'));
    	// 	}
    	// }
    }

}