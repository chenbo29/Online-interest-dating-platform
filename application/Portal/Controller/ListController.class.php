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
 * 文章列表
*/
class ListController extends HomeBaseController {


	function _initialize() {
		parent::_initialize();
		
	}

	//文章内页
	/*public function index() {
		$term=sp_get_term($_GET['id']);
		
		if(empty($term)){
		    header('HTTP/1.1 404 Not Found');
		    header('Status:404 Not Found');
		    if(sp_template_file_exists(MODULE_NAME."/404")){
		        $this->display(":404");
		    }
		    	
		    return ;
		}
		$tplname=$term["list_tpl"];
    	$tplname=sp_get_apphome_tpl($tplname, "list");
    	$this->assign($term);
    	$this->assign('cat_id', intval($_GET['id']));
    	$this->display(":$tplname");
	}
*/
	public function index() {
        $stid=I('get.stid','','int');
		$term=sp_get_term($_GET['id']);

		if(empty($term)){
		    header('HTTP/1.1 404 Not Found');
		    header('Status:404 Not Found');
		    if(sp_template_file_exists(MODULE_NAME."/404")){
		        $this->display(":404");
		    }
		    return ;
		}
		$tplname=$term["list_tpl"];
    	$tplname=sp_get_apphome_tpl($tplname, "list");
    	$this->assign($term);
        $this->assign('stid',$stid);
		$this->assign('cat_id', intval($_GET['id']));

    	$this->display(":$tplname");
	}
	//公告列表页
	public function hdggList() {
		$launch = M('launchactview'); // 实例化User对象
		$stid=$_GET['stid'];
		// 进行分页数据查询 注意page方法的参数的前面部分是当前的页数使用 $_GET[p]获取
		$list = $launch->where("ORG_ID='{$stid}'")->order('begin_time desc')->page($_GET['p'].',20')->select();
		$this->assign('list',$list);// 赋值数据集
		// dump($list);die;
		//$launch_activity_model=M('LaunchActivity');
		//$activity_enroll=M('ActivityEnroll');
		/****************动态更新报名人数*******************************/
		// foreach ($list as  $value) {
		// 	$actid=$value['id'];
		// 	/*获取该活动当前报名人数*/
		// 	$count=$activity_enroll->where("activity_id=$actid")->count();
		// 	/*人数变化时才更新,防止多个客户端同时写入*/
		// 	if($value['joined']<$count){
		// 		$launch->where("id=$actid")->setField('joined',$count);		
		// 	}				
		// }
		$count      = $launch->where("ORG_ID='{$stid}'")->count();// 查询满足要求的总记录数
		$Page       = new \Think\Page($count,20);// 实例化分页类 传入总记录数和每页显示的记录数
		$show       = $Page->show();// 分页显示输出
		$this->assign('page',$show);// 赋值分页输出
		$this->display(":hdgg_masonry"); // 输出模板
	}
	//贴吧列表页
	public function tiebaList()
	{	

		$tieba = M('tieba'); // 实例化User对象
		$stid=$_GET['stid'];
		// 进行分页数据查询 注意page方法的参数的前面部分是当前的页数使用 $_GET[p]获取
		$list = $tieba->where("ORG_ID='{$stid}'")->order('post_date desc')->page($_GET['p'].',20')->select();
		$this->assign('list',$list);// 赋值数据集
		$count      = $tieba->where("ORG_ID='{$stid}'")->count();// 查询满足要求的总记录数
		$Page       = new \Think\Page($count,20);// 实例化分页类 传入总记录数和每页显示的记录数
		$show       = $Page->show();// 分页显示输出
		
		$this->assign('page',$show);// 赋值分页输出
		$this->display(":tieba_list"); // 输出模板

	}

	public function ybggList()
	{

		$ybgg=M('ybggview');
		$stid=$_GET['stid'];
		// 进行分页数据查询 注意page方法的参数的前面部分是当前的页数使用 $_GET[p]获取
		$list = $ybgg->where("ORG_ID='{$stid}'")->order('time desc')->page($_GET['p'].',20')->select();
		/*echo $ybgg->_sql();
		dump($list);die;*/
		$this->assign('list',$list);// 赋值数据集

		$count      = $ybgg->where("ORG_ID='{$stid}'")->count();// 查询满足要求的总记录数
		$Page       = new \Think\Page($count,20);// 实例化分页类 传入总记录数和每页显示的记录数
		$show       = $Page->show();// 分页显示输出
		
		$this->assign('page',$show);// 赋值分页输出
		// dump($list);die;
		$this->display(":ybgg_list"); // 输出模板
	}

	public function nav_index(){
		$navcatname="文章分类";
		$datas=sp_get_terms("field:term_id,name");
		$navrule=array(
				"action"=>"List/index",
				"param"=>array(
						"id"=>"term_id"
				),
				"label"=>"name");
		exit(sp_get_nav4admin($navcatname,$datas,$navrule));
		
	}

	public function launchPost()
	{
		$this->display(":launchPost");
		
	}

	public function actShowList()
	{
		$actShow = M('actshowview'); // 实例化User对象
		$stid=$_GET['stid'];
		// 进行分页数据查询 注意page方法的参数的前面部分是当前的页数使用 $_GET[p]获取

		$list = $actShow->where("ORG_ID='{$stid}'")->order('begin_time desc')->page($_GET['p'].',20')->select();
		$this->assign('list',$list);// 赋值数据集
		$count      = $actShow->where("ORG_ID='{$stid}'")->count();// 查询满足要求的总记录数
		$Page       = new \Think\Page($count,20);// 实例化分页类 传入总记录数和每页显示的记录数
		$show       = $Page->show();// 分页显示输出
		
		$this->assign('page',$show);// 赋值分页输出
		$this->display(":actshow_masonry"); // 输出模板	

	}
	
}
