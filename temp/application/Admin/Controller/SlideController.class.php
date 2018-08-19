<?php
namespace Admin\Controller;
use Common\Controller\AdminbaseController;
class SlideController extends AdminbaseController{
	
	protected $slide_model;
	protected $slidecat_model;
	
	function _initialize() {
		parent::_initialize();
		$this->slide_model = D("Common/Slide");
		$this->slidecat_model = D("Common/SlideCat");
		
	}
	
	function index(){

		$orgid=$_GET['orgid'];
		//$orgid=2;
		if(empty($orgid)){
			$this->error("组织id传递失败！!");
		}
		//dump($orgid);
		/*
		$cates=array(
				array("cid"=>"0","cat_name"=>"默认分类"),
		);
		$categorys=$this->slidecat_model->field("cid,cat_name")->where("cat_status!=0")->select();
		if($categorys){
			$categorys=array_merge($cates,$categorys);
		}else{
			$categorys=$cates;
		}*/
		$categorys=$this->slidecat_model->field("cid,cat_name")->where("cat_status!=0")->select();
		$this->assign("categorys",$categorys);
		$this->assign('orgid',$orgid);
		
		$cid=1;
		$where="ORG_ID=$orgid AND slide_cid=$cid";/*本组织图片,不是视频cid=0*/
		if(isset($_POST['cid']) && $_POST['cid']!=""){
			$cid=$_POST['cid'];
			$where="slide_cid=$cid AND ORG_ID=$orgid";
		}
		//$where['ORG_ID']=$orgid;
		$this->assign("slide_cid",$cid);
		$slides=$this->slide_model->where($where)->order("listorder ASC")->select();
		$this->assign('slides',$slides);
		//视频
		$where="slide_cid=0 AND ORG_ID=$orgid";
		$video=$this->slide_model->where($where)->find();
		$this->assign('video',$video);
		$this->display();
	}
	
	function add(){
		//$path='__ROOT__/data/upload/stppt';
		//session('stppt',$path);
		$orgid=$_GET['orgid'];
		if(empty($orgid)){
			$this->error('组织id传递失败！');
		}
		$categorys=$this->slidecat_model->field("cid,cat_name")->where("cat_status!=0")->select();
		$this->assign("categorys",$categorys);
		$this->assign('orgid',$orgid);
		$this->display();
	}
	
	function add_post(){
		if(IS_POST){
			$orgid=$_GET['orgid'];
			if(empty($orgid)){
			$this->error('组织id传递失败！');
			}

			$upload = new \Think\Upload();// 实例化上传类    
            $upload->maxSize   =     3145728 ;// 设置附件上传大小
            $upload->rootPath ='data/upload/';//设置根目录
            $upload->savePath = 'stppt/'.$orgid.'/';//设置保存目录，相对根目录
            $upload->autoSub = false;//不生成子目录
            $upload->exts     = array('jpg', 'gif', 'png', 'bmp','jpeg');
            $upload->saveName = array('uniqid','');// 采用GUID序列命名，确保同一秒提交也可以
            $info=$upload->uploadOne($_FILES['picload']);
            if(!$info){

                    $this->error($upload->getError());
            }else{
             	$Abspath='data/upload/'.$info['savepath'].$info['savename'];//获取图片绝对路径
                $relpath=$info['savepath'].$info['savename'];

                $image = new \Think\Image();
                $image->open($Abspath);
                $image->thumb(2000,800,\Think\Image::IMAGE_THUMB_FIXED)->save($Abspath);  
            }
			if ($this->slide_model->create()) {
				//$_POST['slide_pic']=sp_asset_relative_url($_POST['slide_pic']);

				//$_POST['slide_pic']=$info['savepath'].$info['savename'];
				//dump($_POST['slide_pic']);
				$this->slide_model->slide_pic=$relpath;//相对于upload的路径
				if ($this->slide_model->add()!==false) {
					$this->success("添加成功！", U("slide/index"));
				} else {
					$this->error("添加失败！");
				}
			} else {
				$this->error($this->slide_model->getError());
			}
		}
	}
	
	function edit(){
		$orgid=$_GET['orgid'];
		if(empty($orgid)){
		$this->error('组织id传递失败！');
		}
		$categorys=$this->slidecat_model->field("cid,cat_name")->where("cat_status!=0")->select();
		$id= intval(I("get.id"));
		$slide=$this->slide_model->where("slide_id=$id")->find();
		$this->assign($slide);
		$this->assign('orgid',$orgid);
		$this->assign("categorys",$categorys);
		$this->display();
	}
	
	function edit_post(){
		if(IS_POST){
			$orgid=$_GET['orgid'];
			if(empty($orgid)){
			$this->error('组织id传递失败！');
			}
			$slide_id=I('post.slide_id');
			$slide_pic=I('post.slide_pic');
			$oldpic=$this->slide_model->where("slide_id=$slide_id")->getField('slide_pic');

			if(strpos($slide_pic,'stppt/')!==false){
				if ($this->slide_model->create()){
					//$_POST['slide_pic']=sp_asset_relative_url($_POST['slide_pic']);
					if ($this->slide_model->save()!==false) {
						$this->success("保存成功！", U("slide/index"));
					} else {
						$this->error("保存失败！");
					}
				} else {
					$this->error($this->slide_model->getError());
				}

			}else{
/*					$begin=strripos($oldpic,'/',0);
					$end=strpos($oldpic,'.',0);
					$newname=substr($oldpic,$begin,$end-$begin+1);*/
					$Abspath="data/upload/".$oldpic;
					unlink($Abspath);
					//dump($newname);
					$upload = new \Think\Upload();// 实例化上传类
					$upload->replace=true;//覆盖同名文件    
		            $upload->maxSize   =     3145728 ;// 设置附件上传大小
		            $upload->rootPath ='data/upload/';//设置根目录
		            $upload->savePath = 'stppt/'.$orgid.'/';//设置保存目录，相对根目录
		            $upload->autoSub = false;///不生成子目录
		            $upload->exts     = array('jpg', 'gif', 'png', 'bmp','jpeg');
		            $upload->saveName = array('uniqid','');// 采用GUID序列命名，确保同一秒提交也可以
		            $info=$upload->uploadOne($_FILES['picload']);
		            if(!$info){

		                    $this->error($upload->getError());
		            }else{
		             	$Abspath='data/upload/'.$info['savepath'].$info['savename'];//获取图片绝对路径
		                $relpath=$info['savepath'].$info['savename'];

		                $image = new \Think\Image();
		                $image->open($Abspath);
		                $image->thumb(2000,800,\Think\Image::IMAGE_THUMB_FIXED)->save($Abspath);  
		            }
						if ($this->slide_model->create()) {
							//$_POST['slide_pic']=sp_asset_relative_url($_POST['slide_pic']);

							//$_POST['slide_pic']=$info['savepath'].$info['savename'];
							//dump($_POST['slide_pic']);
							$this->slide_model->slide_pic=$relpath;//相对于upload的路径
							if ($this->slide_model->save()!==false) {
								$this->success("添加成功！", U("slide/index",array('orgid'=>$orgid)));
							} else {
								$this->error("添加失败！");
							}
						} else {
							$this->error($this->slide_model->getError());
						}


			}

		}
	}
	
	function delete(){
		if(isset($_POST['ids'])){
			$ids = implode(",", $_POST['ids']);
			$data['slide_status']=0;
			/*增加对图片文件的删除*/
			$allpic=$this->slide_model->where("slide_id in ($ids)")->select();
			
			if ($this->slide_model->where("slide_id in ($ids)")->delete()!==false) {
				foreach ($allpic as $value) {
					$Abspath="data/upload/".$value['slide_pic'];
					//dump($value['slide_pic']);
					unlink($Abspath);
				}
				$this->success("删除成功!");
			} else {
				$this->error("删除失败！");
			}
		}else{
			$id = intval(I("get.id"));
			/*增加对图片文件的删除*/
			$pic=$this->slide_model->where("slide_id=$id")->getField('slide_pic');
			if ($this->slide_model->delete($id)!==false) {
				$Abspath="data/upload/".$pic;
				unlink($Abspath);
				$this->success("删除成功！");
			} else {
				$this->error("删除失败！");
			}
		}
		
	}

	function addvideo(){/*添加视频*/
			$orgid=$_GET['orgid'];
			if(empty($orgid)){
				$this->error('组织id传递失败！');
			}
			$result=$this->slide_model->where("ORG_ID=$orgid AND slide_cid=0")->find();
       		if(!empty($result)){
            	$this->error('您已经上传过视频了，请勿重复上传！
            		您可以先删除之前上传的视频，再到这里上传！');
        	}
			$categorys=$this->slidecat_model->field("cid,cat_name")->where("cat_status!=0")->select();
			$this->assign("categorys",$categorys);
			$this->assign('orgid',$orgid);
			$this->display();

	}
	function uploadvideo(){
		$orgid=$_GET['orgid'];
		if(empty($orgid)){
			$this->error('组织id传递失败！');
		}
		$result=$this->slide_model->where("ORG_ID=$orgid AND slide_cid=0")->find();
        if(!empty($result)){
        		echo 2;
            	$this->error('您已经上传过视频了，请勿重复上传！');
        }
		$upload = new \Think\Upload();// 实例化上传类  
        $upload->maxSize   = 314572800;// 设置附件上传大小300M
        $upload->rootPath ='data/upload/';//设置根目录
        $upload->savePath = 'stppt/'.$orgid.'/';//设置保存目录，相对根目录
        $upload->autoSub = false;///不生成子目录
        $upload->exts     = array('mp4','mkv');
        $upload->saveName = array('uniqid','');// 采用GUID序列命名，确保同一秒提交也可以
        $info=$upload->uploadOne($_FILES['Filedata']);
        if(!$info){
        	echo 0;
                $this->error($upload->getError());
        }else{
         	$Abspath='data/upload/'.$info['savepath'].$info['savename'];//获取图片绝对路径
            $relpath=$info['savepath'].$info['savename'];

	            $data['slide_video']=$relpath;
	            $data['slide_des']="video";
	            $data['slide_name']="video";
	        	$data['ORG_ID']=$orgid;
	        	$data['slide_cid']=0;//0代表视频，视频隐藏，不显示
	        	$data['slide_content']="video";
	        	$data['slide_status']=1;
	        	$this->slide_model->add($data);   
            echo 1;
        }
/*		$targetFolder = '/uploads'; // Relative to the root

		$verifyToken = md5('unique_salt' . $_POST['timestamp']);

		if (!empty($_FILES) && $_POST['token'] == $verifyToken) {
			$tempFile = $_FILES['Filedata']['tmp_name'];
			$targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
			//var_dump($targetPath);
			$targetFile = rtrim($targetPath,'/') . '/' . $_FILES['Filedata']['name'];
			//var_dump($tempFile);
			//var_dump($targetPath);
			// Validate the file type
			$fileTypes = array('jpg','jpeg','gif','png','avi','3gp','mp4','flv','mkv'); // File extensions
			$fileParts = pathinfo($_FILES['Filedata']['name']);
			
			if (in_array($fileParts['extension'],$fileTypes)) {
				move_uploaded_file($tempFile,$targetFile);
				echo 'success';
				//return "success";
			} else {
				echo 'Invalid file type.';
			}
		}*/
	}
	function deletevideo(){
		$orgid=$_GET['orgid'];
		if(empty($orgid)){
			$this->error('组织id传递失败！');
		}
		$id=$_GET['id'];
		$result=$this->slide_model->where("slide_id=$id")->find();
		$Abspath="data/upload/".$result['slide_video'];
		unlink($Abspath);//删除视频
		$info=$this->slide_model->where("slide_id=$id")->delete();
		if(!empty($info)){
			$this->success("删除视频成功！");
		}
	}
	function toggle(){
		if(isset($_POST['ids']) && $_GET["display"]){
			$ids = implode(",", $_POST['ids']);
			$data['slide_status']=1;
			if ($this->slide_model->where("slide_id in ($ids)")->save($data)!==false) {
				$this->success("显示成功！");
			} else {
				$this->error("显示失败！");
			}
		}
		if(isset($_POST['ids']) && $_GET["hide"]){
			$ids = implode(",", $_POST['ids']);
			$data['slide_status']=0;
			if ($this->slide_model->where("slide_id in ($ids)")->save($data)!==false) {
				$this->success("隐藏成功！");
			} else {
				$this->error("隐藏失败！");
			}
		}
	}
	    //隐藏
	function ban(){
		
    	$id=intval($_GET['id']);
			$data['slide_status']=0;
    	if ($id) {
    		$rst = $this->slide_model->where("slide_id in ($id)")->save($data);
    		if ($rst) {
    			$this->success("幻灯片隐藏成功！");
    		} else {
    			$this->error('幻灯片隐藏失败！');
    		}
    	} else {
    		$this->error('数据传入失败！');
    	}
    }
    //显示
    function cancelban(){
    	$id=intval($_GET['id']);
		$data['slide_status']=1;
    	if ($id) {
    		$result = $this->slide_model->where("slide_id in ($id)")->save($data);
    		if ($result) {
    			$this->success("幻灯片启用成功！");
    		} else {
    			$this->error('幻灯片启用失败！');
    		}
    	} else {
    		$this->error('数据传入失败！');
    	}
    }
	//排序
	public function listorders() {
		$status = parent::_listorders($this->slide_model);
		if ($status) {
			$this->success("排序更新成功！");
		} else {
			$this->error("排序更新失败！");
		}
	}
	
}