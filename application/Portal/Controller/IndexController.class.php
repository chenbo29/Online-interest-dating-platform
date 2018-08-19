<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2014 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: Dean <zxxjjforever@163.com>
// +----------------------------------------------------------------------
namespace Portal\Controller;
use Common\Controller\HomeBaseController; 
/**
 * 首页
 */
class IndexController extends HomeBaseController {
	
    //首页
  /*并非首页,更改配置文件，网站起始重定向*/
	public function index() {
	if(sp_is_user_login()){
      $stid=$_GET['stid'];
      // $orgid=$_GET['orgid'];
      $orgid=$stid;
      /*$orgid=2;保留组织id接口*/
      if(empty($orgid)){
        $this->error('未能获取组织参数！');
      }
      /*********读取该组织留言板内容********************************************************/
      $guestbook_model=D("Common/Guestbook");
      $count=$guestbook_model->where(array("status"=>1,"ORG_ID"=>$orgid,"public"=>1))->count();
      $page = $this->page($count, 6);
      $guestmsgs=$guestbook_model
      ->where(array("status"=>1,"ORG_ID"=>$orgid,"public"=>1))
      ->order(array("createtime"=>"DESC"))
      ->limit($page->firstRow . ',' . $page->listRows)->select();
      $this->assign("Page", $page->show('Admin'));
      $this->assign("guestmsgs",$guestmsgs);
      
      /**********人物风采展示内容********************************************************************/
      $org_user_viewmodel=D("OrgUserView");//用户组织视图
      $map['ORG_ID']=array('eq',$orgid);
      //$map['identify']=array('in','1,2,0');//禁用，管理，超级管理员都显示
      $count=$orgusers=$org_user_viewmodel->where($map)->count();
          $orgusers=$org_user_viewmodel
          ->where($map)
          ->order("createtime DESC")
          ->select();
          $this->assign('orgusercount',$count);
          $this->assign('orguser',$orgusers);
        // $this->display(":index");
        /*****************判断该用户是否是该组织成员******************************************/
/*        $userid=sp_get_current_userid();
        $is_in_this_org=false;
        if(sp_in_current_org($userid,$orgid)==true){
          $is_in_this_org=true;
        }
*/        $this->assign('orgid',$orgid);/*将组织id传递前台*/
        $this->assign('is_in_this_org',$is_in_this_org);
        /****************获取组织申请加入该组织时回答的问题*********************************/
        $org_model=M('Organization');
        $orgdata=$org_model->where(array("id"=>$orgid))->find();
        $this->assign('orgdata',$orgdata);
        /*-----------------------------*/

        
        // $stid=$_GET['stid'];
        $hdgg=M('launchactview');
        $latestHdgg=$hdgg->where("ORG_ID='{$stid}'")->order('begin_time desc')->find();
        $this->assign("latestHdgg",$latestHdgg);

        /*************************初始化5条帖子***********************************/
        $tieba = M('tiebaview'); // 实例化User对象
        $tiebaList = $tieba->where("ORG_ID='{$stid}'")->order('post_date desc')->limit(5)->select();
        $this->assign('tiebaList',$tiebaList);//赋值数据集

        /************************往期活动**********************************/
        $actShow=M('actshowview');

        $actShowList=$actShow->where("ORG_ID='{$stid}'")->order('begin_time desc')->limit(6)->select();
        $first=$actShowList[0];//最新一条
        $this->assign("first",$first);

        /************************一般公告***********************************/
         $ybgg=M('ybggview');
         $ybggList=$ybgg->where("ORG_ID='{$stid}'")->order('time desc')->limit(6)->select();
         $this->assign("ybggList",$ybggList);
      // dump($ybggList);die;
       /* dump($actShowList);
        dump($first);
        die;*/
        /*************************初始化4条置顶分享************************************/
        $share=M('shareview');
        $con['org_id']=$stid;
        $con['term_id']=array(1,2,14,15);
        foreach ( $con['term_id']as $key => $value)
        {
            $shareList[$key]=$share->where("org_id='{$stid}' AND term_id='{$value}'")->order("post_date desc")->find();
            $shareList[$key]['post_content']=sp_content_page($shareList[$key]['post_content']);
        }
        $this->assign("shareList",$shareList);
        $this->assign("actShowList",$actShowList);

        // $this->display(":timeline");
        $this->display(":stindex");
      }else
     	{
        /*未登陆重定向网站登录页*/
     		$this->display(":index");
     	}
   }   

}


