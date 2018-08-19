<?php
namespace Organization\Controller;
use Common\Controller\AdminbaseController;
class ActivityAdminController extends AdminbaseController{
	
	//coded by liu
	
	function _initialize() {
		parent::_initialize();
	}

	public function currentactivity(){
		$orgid=$_GET['orgid'];
		//$orgid=2;//调试期间指定id 
		/*2级菜单，自动获取组织id，并在与此页面关联页面间相互传递*/
		if(empty($orgid)){
			
			$this->error("组织id传递失败！");
		}		
		$launch_actmodel=M('LaunchActivity');
		$map['ORG_ID']=array('eq',$orgid);
        $count=$launch_actmodel->where($map)->count();
        $page = $this->page($count, 9);
        $result=$launch_actmodel
        ->where($map)
    	->order("createtime ASC")
        ->limit($page->firstRow.','.$page->listRows)
        ->select();
        //dump($result);
        $this->assign('data',$result);
        $this->assign("page",$page->show("Admin"));
        $this->assign('orgid',$orgid);
        $this->display();

	}
	 public function launchactivity(){

	 	if(IS_POST){
	 		if(session('lhayispost')==1){//避免多次重复提交
		 		session('lhayispost',null);
		 		$relpath="";
		 		$orgid=$_GET['orgid'];
		 		if(empty($orgid)){
					
					$this->error("组织id传递失败！");
				}	
	            if(!empty($_FILES['picload']['name'])){//判断是否有上传文件
	            $upload = new \Think\Upload();// 实例化上传类    
	            $upload->maxSize   =     1048576 ;// 设置附件上传大小
	            $upload->rootPath ='data/upload/';//设置根目录
	            $upload->savePath = 'launchactivity/'.$orgid.'/';//设置保存目录，相对根目录
	            $upload->autoSub = false;//不生成子目录
	            $upload->exts     = array('jpg', 'gif', 'png', 'bmp','jpeg');
	            $upload->saveName = array('uniqid','');// 唯一字符串
	           	$info=$upload->uploadOne($_FILES['picload']);
	            if(!$info){
	                    $this->error($upload->getError());
	                }else{
	                	
	                    $Abspath='data/upload/'.$info['savepath'].$info['savename'];//获取图片绝对路径
	                    $relpath=$info['savepath'].$info['savename'];//相对路径
	                    $image = new \Think\Image();
	                    $image->open($Abspath);
	                    $image->thumb(500,700,\Think\Image::IMAGE_THUMB_FIXED)->save($Abspath);
	                    //session('abspath',$Abspath);
	            	}
	            }
		        $reback=D('LaunchActivity')->tolaunch($relpath);
	            if($reback['status']==1){
	            	$this->success("发布成功！",U('ActivityAdmin/lookactivity',array('orgid'=>$orgid)));
	            }else{
	            	if(isset($Abspath)){
	            		unlink($Abspath);
	            	}
	            	//$this->ajaxReturn($reback);
	            	$this->error($reback);
	            }
	           // $this->error($Abspath);
	        }else{//避免重复提交页面的方法
	        	$orgid=$_GET['orgid'];
	        	if($reback['status']==1){
	            	$this->success("发布成功！",U('ActivityAdmin/lookactivity',array('orgid'=>$orgid)));
	            }else{
	            	$this->error("您的操作过于频繁,您可以在当前活动里查看活动是否发布成功！",U('ActivityAdmin/lookactivity',array('orgid'=>$orgid)));
	            }
	        }            
	 	}else{
	 		session('lhayispost',1);
	 		$orgid=$_GET['orgid'];
	 		$orgid=2;
			$adminid=sp_get_current_admin_id();
			if(empty($adminid)){

				$nologin="您已经退出后台,请通过合法途径进入后台！";
				$this->error($nologin,__ROOT__."/");
			}
			if(empty($orgid)){
				$this->error("组织id传递失败！");
			}
	 		$adminid=session('ADMIN_ID');
	 		//dump($adminid);
	 		
	 		$this->assign('adminid',$adminid);
	 		$this->assign('orgid',$orgid);
	 		$this->display();
	 	}

	 } 
	public function lookactivity(){
		$orgid=$_GET['orgid'];//大U的参数
		$id=$_GET['id'];//大U的参数
		if(empty($orgid)){
			$this->error('组织id传递失败！');
		}
		$launch_actmodel=M('LaunchActivity');
		if(!empty($id)){

			$result=$launch_actmodel->where("id=$id")->find();
			$this->assign('data',$result);

		}else{
			$launch_actmodel=M('LaunchActivity');
			//主键自增，因此可以获取最近也就是主键最大的活动
			$max=$launch_actmodel->where("ORG_ID=$orgid")->max('id');
			if(!empty($max)){
				$result=$launch_actmodel->where("id=$max")->find();
				$this->assign('data',$result);
				$new_activity="这是您最新发布的活动";
				$this->assign('new_activity',$new_activity);
			}else{
				$this->error("暂无未完成活动！");
			}
		}
		$this->assign('orgid',$orgid);//传递组织id
		$this->display();
	}

	public function edit(){
		$id=$_GET['id'];
		$orgid=$_GET['orgid'];
		if(empty($orgid)){
			$this->error('组织id传递失败！');
		}
		if(!empty($id)){
			$launch_actmodel=M('LaunchActivity');
			$result=$launch_actmodel->where("id=$id")->find();
			if(!empty($result)){
				$this->assign('orgid',$orgid);
				$this->assign('data',$result);
				$this->display();
			}else{
				$this->error("查询有误或不存在该记录！");
			}
		}else{
			$this->error("获取活动编号失败！");
		}

	}

	public function postedit(){
		if(IS_POST){
			$orgid=$_GET['orgid'];
			$launch_actmodel=D('LaunchActivity');
			if (!$launch_actmodel->create()){
				//dump('sadf');
				 $this->error($launch_actmodel->getError());
			}else{
				if(!empty($_FILES['picload']['name'])){//判断是否有上传文件
		            $upload = new \Think\Upload();// 实例化上传类    
		            $upload->maxSize   =     1048576 ;// 设置附件上传大小1MB
		            $upload->rootPath ='data/upload/';//设置根目录
		            $upload->savePath = 'launchactivity/'.$orgid.'/';//设置保存目录，相对根目录
		            $upload->autoSub = false;//不生成子目录
		            $upload->exts     = array('jpg', 'gif', 'png', 'bmp','jpeg');
		            $upload->saveName = array('uniqid','');
		           	$info=$upload->uploadOne($_FILES['picload']);
		            if(!$info){
		                $this->error($upload->getError());
		                }else{
		                	
		                    $Abspath='data/upload/'.$info['savepath'].$info['savename'];//获取图片绝对路径
		                    $relpath=$info['savepath'].$info['savename'];//相对路径
		                    $image = new \Think\Image();
		                    $image->open($Abspath);
		                    $image->thumb(500,700,\Think\Image::IMAGE_THUMB_FIXED)->save($Abspath);

		                    //session('abspath',$Abspath);
		            	}
	            }
	            $launch_actmodel->picture=I('post.picture');

	            if(!empty($_FILES['picload']['name'])){
	    			$oldpic=I('post.picture');
	                $oldpath='data/upload/'.$oldpic;
	                unlink($oldpath);//删除原始图片
	            	$launch_actmodel->picture=$relpath;
	            }
            	//dump(I('post.ORG_ID'));
            	$launch_actmodel->createtime=date('y-m-d H:i:s',time());
            	$status=$launch_actmodel->save();//保存修改
            	if($status!==false){
            		$id=I('post.id');
            		//$orgid=$_GET['orgid'];//大U方法传递
            		$this->success('修改成功！',U('ActivityAdmin/lookactivity',array('id'=>$id,'orgid'=>$orgid)));
            	}else{
            		$this->error('修改失败！');
            	}
			}

		}

	}
	public function delete(){/*删除新发布的活动*/
		$id=$_GET['id'];
		if(!empty($id)){
			$launch_actmodel=M('LaunchActivity');
			$picture=$launch_actmodel->where("id=$id")->getField('picture');

			$return=$launch_actmodel->delete($id);
			if($return===1){
				if(!empty($picture)){
					$Abspath='data/upload/'.$picture;
					unlink($Abspath);/*删除图片，清理空间*/
				}
				$this->success('删除成功！');
			}
		}
	}
	public function uploadpastact(){
		if(IS_POST){
				if(session('uploadpastact')==1){
					//避免多次重复提交
			 		session('uploadpastact',null);
			 		$relpath="";
			 		$orgid=$_GET['orgid'];
			 		if(empty($orgid)){
			 			$this->error('组织id传递失败！');
			 		}
			 		$activityshow_model=D('ActivityShow');
			 		if (!$activityshow_model->create()){ // 指定新增数据
						// 如果创建失败 表示验证没有通过 输出错误提示信息
						$newpic=I('post.picture');
		            	$newsiglepic=explode('+', $newpic);
						$count=count($newsiglepic);	
						for($temp=0;$temp<$count;$temp++){
							$cachepath='data/upload/activityshow/uploadcache/'.$newsiglepic[$temp];
							unlink($cachepath);
						}
						$this->error($activityshow_model->getError());
						//$this->error("asdfasfdas");
					}
					//dump('asdf');
					$allpic=I('post.picture');
			 		/*****************************************************************/
			 		/*处理封面问题，如果没有上传封面，使用组图中的第一张作为封面*/
		            if(!empty($_FILES['picload']['name'])){//判断是否有上传封面文件
		            $upload = new \Think\Upload();// 实例化上传类    
		            $upload->maxSize   =     1048576 ;// 设置附件上传大小
		            $upload->rootPath ='data/upload/';//设置根目录
		            $upload->savePath = 'activityshow/'.$orgid.'/';//设置保存目录，相对根目录
		            $upload->autoSub = false;//不生成子目录
		            $upload->exts     = array('jpg', 'gif', 'png', 'bmp','jpeg');
		            $upload->saveName = array('uniqid','');// 
		           	$info=$upload->uploadOne($_FILES['picload']);
		            if(!$info){
		                    $this->error($upload->getError());
		                }else{
		                	
		                    $Abspath='data/upload/'.$info['savepath'].$info['savename'];//获取图片绝对路径
		                    $relpath=$info['savepath'].$info['savename'];//相对路径
		                    $image = new \Think\Image();
		                    $image->open($Abspath);
		                    $image->thumb(500,700,\Think\Image::IMAGE_THUMB_FIXED)->save($Abspath);
		                    //session('abspath',$Abspath);
		            	}
		            }elseif(!empty($allpic)){
		            	/*使用组图中的第一张作为封面*/
		            	
		            	if(!empty($allpic)){
		            		$siglepics=explode('+', $allpic);
		            		$relpath='activityshow/'.$orgid.'/'.$siglepics[0];
		            		//$Abspath='data/upload/'.$relpath;
		            		//dump('asdf');
	            		}
		            } else{
		            	/*从编辑框中找出第一张图片作为封面*/
						//dump("just1234567in");
		            	$content=htmlspecialchars_decode(I('post.content'));
		            	$stripChar = 'activityshow.*jpg|activityshow.*jpeg|activityshow.*bmp|activityshow.*png';
				    	if(preg_match('/'.$stripChar.'/', $content)){
				    		//dump("1234567in");
				    		//$this->error('asdfasfd');
				    		$target="activityshow/".$orgid.'/';
							/*找到第一张图片的位置*/
							$first=stripos($content,$target);
							/*编辑器中插入了图片*/
							if($first!==false){
								/*第一张图片路径结束的位置*/
								$tail=stripos($content,'"',$first);
								/*截取图片有效路径*/
								$result=substr($content, $first,$tail-$first);
/*								if(stripos($reslut,".jpg")||stripos($reslut,".jpeg")||stripos($reslut,".bmp")
									||stripos($reslut,".png")||stripos($reslut,".gif")){}*/
								$relpath=$result;
								
								/*dump($result);
								dump($_POST['smeta']['thumb']);
								dump($_POST['smeta']);*/
							}
				    	}

		            }
		            /**********************************************************************/
		            //将图片从缓存区移动到保存区
		            $newpic=I('post.picture');
	            	$newsiglepic=explode('+', $newpic);
					$count=count($newsiglepic);	
					for($temp=0;$temp<$count;$temp++){
						$newpath='data/upload/activityshow/'.$orgid.'/'.$newsiglepic[$temp];
						//dump($Abspath);
						$cachepath='data/upload/activityshow/uploadcache/'.$newsiglepic[$temp];
						copy($cachepath,$newpath);
						unlink($cachepath);
					}/*在model里进行数据库操作*/
			        $reback=$activityshow_model->uploadpastact($relpath);
		            if($reback['status']==1){
		            	$this->success("发布成功！",U('ActivityAdmin/pastactivity',array('orgid'=>$orgid)));
		            }else{
		            /***********************************************************************/
		            	//处理写数据库失败后，删除上传文件等问题
		            	if(isset($Abspath)){
		            		unlink($Abspath);
		            	}
		            	$allpicture=I('post.picture');
			            $siglepic=explode('+',$allpicture);
						$count=count($siglepic);
						
						for($temp=0;$temp<$count;$temp++){
							$Abspath='data/upload/activityshow/'.$orgid.'/'.$siglepic[$temp];
							//dump($Abspath);
							unlink($Abspath);
						}
		            	//$this->ajaxReturn($reback);
		            	$this->error($reback);
		            }
		        //$this->error($Abspath);
		        }else{//避免重复提交页面的方法
		        	$orgid=$_GET['orgid'];
		        	if($reback['status']==1){
		            	$this->success("发布成功！",U('ActivityAdmin/pastactivity',array('orgid'=>$orgid)));
		            }else{
		            	$this->error("您的操作过于频繁，请您返回列表页查看是否发布成功！");
		            }
		        }
	        }else{
				session('uploadpastact',1);
				$orgid=$_GET['orgid'];
				//$orgid=2;/*需修改*/
				if(empty($orgid)){
					$this->error('组织id传递失败！');
				}
				//$uploadDir = __ROOT__.'/data/upload/activityshow/upload';
				//dump($uploadDir);
				$this->assign('orgid',$orgid);

				$this->display();
			}
	}
	public function pastactivity(){
			$orgid=$_GET['orgid'];
			if(empty($orgid)){
				$this->error('组织id传递失败！');
			}
			//$orgid=2;
			$activityshow_model=M('ActivityShow');
			$map['ORG_ID']=array('eq',$orgid);
	        $count=$activityshow_model->where($map)->count();
	        $page = $this->page($count, 9);
	        $result=$activityshow_model
	        ->where($map)
	    	->order("createtime ASC")
	        ->limit($page->firstRow.','.$page->listRows)
	        ->select();
	        //dump($result);
	        $this->assign('data',$result);
	        $this->assign("page",$page->show());
	        $this->assign('orgid',$orgid);
	        $this->display();
	}
	public function pastactivitydelete(){//删除往期活动展示内容
		$id=$_GET['id'];
		$orgid=$_GET['orgid'];
		if(empty($orgid)){
			$this->error('组织id传递失败！');
		}
		if(isset($id)){/**/
			/*dump($id);*/
			$activityshow_model=M('ActivityShow');
			$result=$activityshow_model->where("id=$id")->find();
			if(!empty($result)){
				if(!empty($result['picture'])){//删除组图
					$allpicture=$result['picture'];
					$siglepic=explode('+',$allpicture);
					$count=count($siglepic);
					
					for($temp=0;$temp<$count;$temp++){
						$Abspath='data/upload/activityshow/trueupload/'.$siglepic[$temp];
						//dump($Abspath);
						unlink($Abspath);
					}
				}
				if(!empty($result['cover_picture'])){//删除封面图片
					$cover_picture=$result['cover_picture'];
					$Abspath='data/upload/'.$cover_picture;
					unlink($Abspath);
				}

				$info=$activityshow_model->where("id=$id")->delete();
				if($info!==false){/*跳转没有效果*/
					//dump('asdf');
					$this->success("删除成功！",U('ActivityAdmin/pastactivity',array('orgid'=>$orgid)));
				}
			}else{
				$this->error('不存在该数据！');
			}

		}else{
			$this->error('参数传递失败！！');
		}
	}
/* 	function index(){
        
        $a=1;
		$b=3;
		$c=2;
		$e=5;
		$this->add($a,$b);
		
	}
	function add($aa,$bb,$cc=6,$gg=9){
		$dd=$aa+$cc;
		$this->error($dd);
	} */

	
}