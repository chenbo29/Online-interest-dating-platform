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
class UploadShareController extends HomeBaseController {

		protected $posts_model;
		protected $term_relationships_model;
		protected $terms_model;
	function _initialize(){
		parent::_initialize();
		$this->check_login();/*检查是否登陆*/
		$this->check_user();/*检查用户身份禁用（一般不会）或未激活（邮箱注册）*/


		$this->posts_model = D("Common/Posts");
		$this->terms_model = D("Common/Terms");
		$this->term_relationships_model = D("Common/TermRelationships");
	}
    //首页
	public function uploadshare() {
		$stid=$_GET['stid'];
		$typeid=$_GET['typeid'];
		if(empty($typeid)){
			$this->error('获取分类失败！');
		}
		/*$orgid=2;*//*暂时保留组织id接口*/
		if(empty($stid)){
			$this->error('组织id传递失败！');
		}
		/***********判断该用户是否在这个组织里**********************************************/
		$userid=sp_get_current_userid();
		if(sp_in_current_org($userid,$stid)===false){
			$this->error('您还不是该组织成员，请您先申请加入！');
		}
		if(sp_orguser_forbidden($userid,$stid)===true){
			$this->error('该您在本组织已被管理员禁用，请联系管理员！');
		}

		/***************************************************************/
		/*没有子分类，所以改为无需调用_getTermTree 直接获取分类*/
		$result = $this->terms_model->where("term_id=$typeid")->find();
		$typename=$result['name'];
		$str="<option value=".$typeid." selected>".$typename."</option>";
		$taxonomys = $str;
		$this->assign("taxonomys", $taxonomys);
		/***************************************************************/
		$this->assign('userid',$userid);
		$this->assign('stid',$stid);
		$this->assign('typeid',$typeid);
    	$this->display();
    }

    private function _getTermTree($term=array()){

		$result = $this->terms_model->order(array("listorder"=>"asc"))->select();
		
		$tree = new \Tree();
		$tree->icon = array('&nbsp;&nbsp;&nbsp;│ ', '&nbsp;&nbsp;&nbsp;├─ ', '&nbsp;&nbsp;&nbsp;└─ ');
		$tree->nbsp = '&nbsp;&nbsp;&nbsp;';
		foreach ($result as $r) {
			$r['str_manage'] = '<a href="' . U("AdminTerm/add", array("parent" => $r['term_id'])) . '">添加子类</a> | <a href="' . U("AdminTerm/edit", array("id" => $r['term_id'])) . '">修改</a> | <a class="J_ajax_del" href="' . U("AdminTerm/delete", array("id" => $r['term_id'])) . '">删除</a> ';
			$r['visit'] = "<a href='#'>访问</a>";
			$r['taxonomys'] = $this->taxonomys[$r['taxonomy']];
			$r['id']=$r['term_id'];
			$r['parentid']=$r['parent'];
			$r['selected']=in_array($r['term_id'], $term)?"selected":"";
			$r['checked'] =in_array($r['term_id'], $term)?"checked":"";
			$array[] = $r;
		}
		
		$tree->init($array);

		$str="<option value='\$id' \$selected>\$spacer\$name</option>";
		$taxonomys = $tree->get_tree(0, $str);
		$this->assign("taxonomys", $taxonomys);
	}
	public function share_post(){
		if (IS_POST) {
			$orgid=$_GET['orgid'];
			//dump($orgid);
			if(empty($orgid)){
				$this->error('组织id传递失败！');
			}
			if(empty($_POST['term'])){
				$this->error("请至少选择一个分类栏目！");
			}

			/*暂时未用*/
/*			if(!empty($_POST['photos_alt']) && !empty($_POST['photos_url'])){
				foreach ($_POST['photos_url'] as $key=>$url){
					$photourl=sp_asset_relative_url($url);
					$_POST['smeta']['photo'][]=array("url"=>$photourl,"alt"=>$_POST['photos_alt'][$key]);
				}
			}*/
			$_POST['smeta']['thumb'] = sp_asset_relative_url($_POST['smeta']['thumb']);
			 
			$_POST['post']['post_date']=date("Y-m-d H:i:s",time());
			$_POST['post']['post_author']=sp_get_current_userid();
			$article=I("post.post");
			$article['smeta']=json_encode($_POST['smeta']);
			$article['post_content']=htmlspecialchars_decode($article['post_content']);
			$article['permission']=I("post.permission");
			$article['org_id']=$orgid;
			if(strlen($article['post_title'])>30){
				$this->error("您输入的标题过长！");
			}
			$key=$article[post_keywords];
			if(strlen($article[post_source])>250){
				$this->error("您输入的资源来源过长！");
			}
			if(strlen($key)>50){
				$this->error("您输入的关键字过长！");
			}
			if(strlen($article['post_content'])>5000){
				$this->error("您输入的内容说明过长！");
			}

			if(stripos($article['post_content'],"upload/share/")===false && stripos($article['post_content'],"http://")===false){
				$this->error("您还未添加图片、文档等资源文件！");
				
			}
			/*如果没有缩略图，选择编辑框中上传的第一张图片作为缩略图*/
			if($_POST['term']==2){
			    $stripChar = 'jpg|jpeg|bmp|png';
				if(!preg_match('/'.$stripChar.'/', $article['post_content'])){
					$this->error("您还未添加图片！");
				}
				$target="share/picture/".$orgid.'/';
				/*找到第一张图片的位置*/
				$first=stripos($article['post_content'],$target);
				/*编辑器中插入了图片*/
				if($first!==false){
					/*第一张图片路径结束的位置*/
					$tail=stripos($article['post_content'],'"',$first);
					/*截取图片有效路径*/
					$result=substr($article['post_content'], $first,$tail-$first);
					$_POST['smeta']['thumb'] = sp_asset_relative_url($result);
					$article['smeta']=json_encode($_POST['smeta']);
					/*dump($result);
					dump($_POST['smeta']['thumb']);
					dump($_POST['smeta']);*/
				}
				
			}
			//dump(I("post.post[post_keywords]"));
			$result=$this->posts_model->add($article);
			if ($result) {
				//
				/*foreach ($_POST['term'] as $mterm_id){}*/
				$mterm_id=$_POST['term'];
				$this->term_relationships_model->add(array("term_id"=>intval($mterm_id),"object_id"=>$result));
				
				
				$this->success("上传资源成功！",U('list/index',array('id'=>$mterm_id,'stid'=>$orgid)));
			} else {
				$this->error("上传资源失败！");
			}
			 
		}
	}

}


