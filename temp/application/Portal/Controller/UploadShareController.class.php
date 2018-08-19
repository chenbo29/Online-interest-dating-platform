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
		$this->posts_model = D("Common/Posts");
		$this->terms_model = D("Common/Terms");
		$this->term_relationships_model = D("Common/TermRelationships");
	}
    //首页
	public function index() {
		$orgid=$_GET['orgid'];
		$orgid=2;
		if(empty($orgid)){
			$this->error('组织id传递失败！');
		}
		$terms = $this->terms_model->order(array("listorder"=>"asc"))->select();
		$term_id = intval(I("get.term"));
		$this->_getTermTree();
		$term=$this->terms_model->where("term_id=$term_id")->find();
		$this->assign("author","1");
		$this->assign("term",$term);
		$this->assign("terms",$terms);

		$userid=sp_get_current_userid();
		$this->assign('userid',$userid);
		$this->assign('orgid',$orgid);
    	$this->display("index");
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
			if(!empty($_POST['photos_alt']) && !empty($_POST['photos_url'])){
				foreach ($_POST['photos_url'] as $key=>$url){
					$photourl=sp_asset_relative_url($url);
					$_POST['smeta']['photo'][]=array("url"=>$photourl,"alt"=>$_POST['photos_alt'][$key]);
				}
			}
			$_POST['smeta']['thumb'] = sp_asset_relative_url($_POST['smeta']['thumb']);
			 
			$_POST['post']['post_date']=date("Y-m-d H:i:s",time());
			$_POST['post']['post_author']=get_current_admin_id();
			$article=I("post.post");
			$article['smeta']=json_encode($_POST['smeta']);
			$article['post_content']=htmlspecialchars_decode($article['post_content']);
			$article['permission']=I("post.permission");
			/*如果没有缩略图，选择编辑框中上传的第一张图片作为缩略图*/
			if(stripos($article['smeta'],"share/")===false){
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
			$key=$article[post_keywords];
			//dump(strlen($key));
			if(strlen($key)>50){
				$this->error("关键字过长！");
			}
			if(stripos($article['post_content'],"upload/share/")===false){
				$this->error("您还未添加图片、文档等资源文件！");
				
			}

			$article['org_id']=$orgid;
			$result=$this->posts_model->add($article);
			if ($result) {
				//
				foreach ($_POST['term'] as $mterm_id){
					$this->term_relationships_model->add(array("term_id"=>intval($mterm_id),"object_id"=>$result));
				}
				
				$this->success("添加成功！");
			} else {
				$this->error("添加失败！");
			}
			 
		}
	}

}


