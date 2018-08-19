<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2014 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: Dean <zxxjjforever@163.com>
// +----------------------------------------------------------------------
/**
 * 文章内页
 */
namespace Portal\Controller;
use Common\Controller\HomeBaseController;
class ArticleController extends HomeBaseController {
    //文章内页
   /* public function index() {
    	$id=intval($_GET['id']);
    	$article=sp_sql_post($id,'');
    	if(empty($article)){
    	    header('HTTP/1.1 404 Not Found');
    	    header('Status:404 Not Found');
    	    if(sp_template_file_exists(MODULE_NAME."/404")){
    	        $this->display(":404");
    	    }
    	    
    	    return ;
    	}
    	$termid=$article['term_id'];
    	$term_obj= M("Terms");
    	$term=$term_obj->where("term_id='$termid'")->find();
    	
    	$article_id=$article['object_id'];
    	
    	$should_change_post_hits=sp_check_user_action("posts$article_id",1,true);
    	if($should_change_post_hits){
    		$posts_model=M("Posts");
    		$posts_model->save(array("id"=>$article_id,"post_hits"=>array("exp","post_hits+1")));
    	}
    	
    	$article_date=$article['post_modified'];
    	
    	$join = "".C('DB_PREFIX').'posts as b on a.object_id =b.id';
    	$join2= "".C('DB_PREFIX').'users as c on b.post_author = c.id';
    	$rs= M("TermRelationships");
    	
    	$next=$rs->alias("a")->join($join)->join($join2)->where(array("post_modified"=>array("egt",$article_date), "tid"=>array('neq',$id), "status"=>1,'term_id'=>$termid))->order("post_modified asc")->find();
    	$prev=$rs->alias("a")->join($join)->join($join2)->where(array("post_modified"=>array("elt",$article_date), "tid"=>array('neq',$id), "status"=>1,'term_id'=>$termid))->order("post_modified desc")->find();
    	
    	 
    	$this->assign("next",$next);
    	$this->assign("prev",$prev);
    	
    	$smeta=json_decode($article['smeta'],true);
    	$content_data=sp_content_page($article['post_content']);
    	$article['post_content']=$content_data['content'];
    	$this->assign("page",$content_data['page']);
    	$this->assign($article);
    	$this->assign("smeta",$smeta);
    	$this->assign("term",$term);
    	$this->assign("article_id",$article_id);
    	
    	$tplname=$term["one_tpl"];
    	$tplname=sp_get_apphome_tpl($tplname, "article");
    	$this->display(":$tplname");
    }*/
      public function index() {
        /*获取组织id*/
        $stid=$_GET['stid'];
        if(empty($stid)){
            $this->error('组织参数传递失败!P-A-i');
        }
        $id=intval($_GET['id']);
        $article=sp_sql_post($id,'');

        if(empty($article)){
            header('HTTP/1.1 404 Not Found');
            header('Status:404 Not Found');
            if(sp_template_file_exists(MODULE_NAME."/404")){
                $this->display(":404");
            }
            return ;
        }

        $termid=$article['term_id'];
        $term_obj= M("Terms");
        $term=$term_obj->where("term_id='$termid'")->find();
        $article_id=$article['object_id'];
        
        $should_change_post_hits=sp_check_user_action("posts$article_id",1,true);
        if($should_change_post_hits){
            $posts_model=M("Posts");
            $posts_model->save(array("id"=>$article_id,"post_hits"=>array("exp","post_hits+1"),"org_id"=>$stid));
        }
        $article_date=$article['post_modified'];
        
        $join = "".C('DB_PREFIX').'posts as b on a.object_id =b.id';
        $join2= "".C('DB_PREFIX').'users as c on b.post_author = c.id';
        $rs= M("TermRelationships");
        /*组织限制已加 by liu*/
        $next=$rs->alias("a")->join($join)->join($join2)->where(array("post_modified"=>array("egt",$article_date),'ORG_ID'=>$stid, "tid"=>array('neq',$id), "status"=>1,'term_id'=>$termid))->order("post_modified asc")->find();
        $prev=$rs->alias("a")->join($join)->join($join2)->where(array("post_modified"=>array("elt",$article_date), 'ORG_ID'=>$stid, "tid"=>array('neq',$id), "status"=>1,'term_id'=>$termid))->order("post_modified desc")->find();

        $this->assign("next",$next);
        $this->assign("prev",$prev);

        $smeta=json_decode($article['smeta'],true);
        $content_data=sp_content_page($article['post_content']);
        $article['post_content']=$content_data['content'];
        $this->assign("page",$content_data['page']);
        $this->assign($article);
        $this->assign("smeta",$smeta);
        $this->assign("term",$term);
        $this->assign("article_id",$article_id);
        
        $tplname=$term["one_tpl"];
        $tplname=sp_get_apphome_tpl($tplname, "article");
        /*dump($article);die;*/
        $this->display(":$tplname");
    }
    
    public function do_like(){
    	$this->check_login();
    	
    	$id=intval($_GET['id']);//posts表中id
    	
    	$posts_model=M("Posts");
    	
    	$can_like=sp_check_user_action("posts$id",1);
    	
    	if($can_like){
    		$posts_model->save(array("id"=>$id,"post_like"=>array("exp","post_like+1")));
    		$this->success("赞好啦！");
    	}else{
    		$this->error("您已赞过啦！");
    	}
    }

    public function tiezi_do_like()
    {
        $this->check_login();
       
        $id=intval($_GET['id']);//tieba表中id
        
        $posts_model=M("Tieba");
        
        $can_like=sp_check_user_action("tieba$id",1);

        if($can_like){
            $posts_model->save(array("id"=>$id,"post_like"=>array("exp","post_like+1")));

            $this->success("赞好啦！");
        }else{
            $this->error("您已赞过啦！");
        }
    }

     public function tieziDetail() {
        
        $id=intval($_GET['id']);
        $stid=intval($_GET['stid']);
        $article= M('tiebaview')->where("id='{$id}' and ORG_ID='{$stid}'")->find();
        $article_id=$article['id'];
        $should_change_post_hits=sp_check_user_action("tieba$article_id",1,true);

        if($should_change_post_hits){
            $tieba_model=M("tieba");
            $tieba_model->save(array("id"=>$article_id,"post_hits"=>array("exp","post_hits+1")));
        }
        
        $article_date=$article['post_modified'];
        $this->assign($article);
        $this->assign("article_id",$article_id);
 
        $this->display(":tieba_article");
    }

    public function ybggDetail()
    {
        $id=intval($_GET['id']);
        $stid=intval($_GET['stid']);

        $article= M('ybggview')->where("id='{$id}' and ORG_ID='{$stid}'")->find();
        $article_id=$article['id'];
        $should_change_post_hits=sp_check_user_action("org_notice$article_id",1,true);

        if($should_change_post_hits){
            $tieba_model=M("org_notice");
            $tieba_model->save(array("id"=>$article_id,"hits"=>array("exp","hits+1")));
        }
        
        $this->assign($article);
       
        $this->assign("article_id",$article_id);
        $this->display(":ybgg_article");
    }


     public function hdggDetail() {

        if(IS_POST)
        {
            $where['user_id']=sp_get_current_userid();
            $activityid=$_GET['id'];
            $where['activity_id']=$_GET['id'];
        
            $enroll=M('activity_enroll');
            
            if($enroll->where($where)->find())
            {
                $this->error("您已报名！");
            }
            else {
                $launch_activity_model=M('LaunchActivity');
                /*报名人数加一*/
                $launch_activity_model->save(array("id"=>$activityid,"joined"=>array("exp","joined+1")));
                $where['ORG_ID']=$_REQUEST['stid'];
                $enroll->add($where);
                $this->success("报名成功！");
            }
        }
        else
        {
            $id=intval($_GET['id']);
            $stid=intval($_GET['stid']);
            //获取活动具体信息
            $article= M('launchactview')->where("id='{$id}' and ORG_ID='{$stid}'")->find();
            $article_id=$article['id'];

            //获取报名信息
            $enrolled=M('enrollview');
            $joinedList=$enrolled->where("ORG_ID='{$stid}' and activity_id='{$id}'")->select();
            $this->assign("joinedList",$joinedList);
            $article_date=$article['post_modified'];
            $this->assign($article);
            $this->assign("article_id",$article_id);
            
            $this->display(":hdgg_article");

        }
    }

    public function actShowDetail() {
        
        $id=intval($_GET['id']);
        $stid=intval($_GET['stid']);
        $article= M('actshowview')->where("id='{$id}' and ORG_ID='{$stid}'")->find();
        $article_id=$article['id'];
        $picSrc=explode('+',$article['picture']); 
        $should_change_post_hits=sp_check_user_action("activity_show$article_id",1,true);

        /*if($should_change_post_hits){
            $tieba_model=M("tieba");
            $tieba_model->save(array("id"=>$article_id,"post_hits"=>array("exp","post_hits+1")));
        }*/
        
        // $article_date=$article['post_modified'];
        $this->assign("article",$article);
        $this->assign("picSrc",$picSrc);
        // dump($article);
        // dump($picSrc);die;
        // $this->assign("article_id",$article_id);
        $this->display(":actshow");
    }
}
