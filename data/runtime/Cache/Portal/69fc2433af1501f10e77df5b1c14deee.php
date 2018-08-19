<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<title><?php echo ($post_title); ?> <?php echo ($site_name); ?></title>
	<meta name="keywords" content="<?php echo ($post_keywords); ?>" />
	<meta name="description" content="<?php echo ($post_excerpt); ?>">
		<?php  function _sp_helloworld(){ echo "hello ThinkCMF!"; } function _sp_helloworld2(){ echo "hello ThinkCMF2!"; } function _sp_helloworld3(){ echo "hello ThinkCMF3!"; } ?>
	<?php $portal_index_lastnews=2; $portal_hot_articles="1,2"; $portal_last_post="1,2"; $tmpl=sp_get_theme_path(); $default_home_slides=array( array( "slide_name"=>"ThinkCMFX1.6.0发布啦！", "slide_pic"=>$tmpl."Public/images/demo/1.jpg", "slide_url"=>"", ), array( "slide_name"=>"ThinkCMFX1.6.0发布啦！", "slide_pic"=>$tmpl."Public/images/demo/2.jpg", "slide_url"=>"", ), array( "slide_name"=>"ThinkCMFX1.6.0发布啦！", "slide_pic"=>$tmpl."Public/images/demo/3.jpg", "slide_url"=>"", ), ); ?>
	<meta name="author" content="ThinkCMF">
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    
    <!-- Set render engine for 360 browser -->
    <meta name="renderer" content="webkit">

   	<!-- No Baidu Siteapp-->
    <meta http-equiv="Cache-Control" content="no-siteapp"/>

    <!-- HTML5 shim for IE8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <![endif]-->
	<link rel="icon" href="/thinkcmfx/tpl/test/Public/images/favicon.ico" type="image/x-icon">
	<link rel="shortcut icon" href="/thinkcmfx/tpl/test/Public/images/favicon.ico" type="image/x-icon">
	
    <link href="/thinkcmfx/tpl/test/Public/simpleboot/themes/cmf/theme.min.css" rel="stylesheet">
    <link href="/thinkcmfx/tpl/test/Public/simpleboot/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
    <link href="/thinkcmfx/tpl/test/Public/simpleboot/font-awesome/4.2.0/css/font-awesome.min.css"  rel="stylesheet" type="text/css">
	<!--[if IE 7]>
	<link rel="stylesheet" href="/thinkcmfx/tpl/test/Public/simpleboot/font-awesome/4.2.0/css/font-awesome-ie7.min.css">
	<![endif]-->
	<link href="/thinkcmfx/tpl/test/Public/css/style.css" rel="stylesheet">
	<style>
		/*html{filter:progid:DXImageTransform.Microsoft.BasicImage(grayscale=1);-webkit-filter: grayscale(1);}*/
		#backtotop{position: fixed;bottom: 50px;right:20px;display: none;cursor: pointer;font-size: 50px;z-index: 9999;}
		#backtotop:hover{color:#333}
		#main-menu-user li.user{display: none}
	</style>
	
	<link rel="stylesheet" type="text/css" href="/thinkcmfx/tpl/test/Public/css/stcss/hdggdetail.css"></head>
	<script type="text/javascript">
//全局变量
var GV = {
    DIMAUB: "/thinkcmfx/",
    JS_ROOT: "statics/js/",
    TOKEN: ""
};
</script>
<style>
.control-label{

	font-weight: bold;
	font-size:25px;
	float: left;
	
}
.controls{
	font-weight: bold;
	font-size:23px;
	width:500px;
}
.control-group{
	margin:30px;
}
.content{
	margin-left:16px;
}
.span3{
	margin-top:30px;
}
</style>
<body>
	<?php echo hook('body_start');?>
<style type="text/css">
#orgname{

margin-left: 10px;
font-size: 15px;
color: #1AD4D1;
}

#applytojoin{
	float: right;
	margin-top: 30px;
	margin-left: 10px;
}
marquee{
	margin-top: 30px;
	margin-left: 30px;
	font-size: 18px;
}
</style>
<div class="navbar navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container">
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>
			<!-- 不是该组织用户才显示 -->
			<?php $userid=sp_get_current_userid(); $orgdata=sp_get_org_data($_GET['stid']); ?>
			<?php if(!sp_in_current_org($userid,$_GET['stid'])): ?><div id="applytojoin">
				<a  href="#"data-toggle="modal" data-target="#exampleModal" data-whatever="">申请加入</a>
				</div>
				<?php else: endif; ?>
			<!-- 改为大U方法才识别当前模块 -->
			<a class="pull-left"href="<?php echo U('Index/index',array('stid'=>$_GET['stid']));?>">
			<!-- <a class="pull-left"href="/thinkcmfx/index.php/Index/index/stid/<?php echo ($_GET['stid']); ?>"> -->
			<!-- <a class="brand" href="/thinkcmfx/"> -->
				<img style="width:130px;"src="<?php echo U('Organization/Orgdata/logo',array('stid'=>$_GET['stid']));?>"/>
			</a>
			<div class="pull-right">
				
			</div>
			<div class="nav-collapse collapse" id="main-menu">
			<ul class="nav">
				<li >
				<a id="orgname"href="<?php echo U('Index/index',array('stid'=>$_GET['stid']));?>">
				<?php echo ($orgdata['name']); ?></a>
				</li>
				<li >
					<marquee Width=600 ScrollAmount=4 Direction=left><?php echo ($orgdata['slogan']); ?>简介：<?php echo ((isset($orgdata['introduction']) && ($orgdata['introduction'] !== ""))?($orgdata['introduction']):"暂无"); ?></marquee>
				</li>
			</ul>
			
			<ul class="nav pull-right" id="main-menu-user">
				<li class="dropdown user login">
					<a class="dropdown-toggle user" data-toggle="dropdown" href="#">
						<img src="/thinkcmfx/tpl/test//Public/images/headicon.png" class="headicon"/>
						<span class="user-nicename"></span> <b class="caret"></b>
					</a>
					<ul class="dropdown-menu pull-right">
						<li>
							<a href="<?php echo u('user/center/index');?>"> <i class="fa fa-user"></i>
								个人中心
							</a>
						</li>
						<!-- 是该组织管理员，则显示后台管理 -->
					<?php if(sp_is_org_admin($userid,$_GET['stid'])): ?><li id="isorgadmin" >
							<a href="<?php echo u('Admin/index/index',array('orgid'=>$_GET['stid']));?>"><i class="fa fa-cogs"></i>管理组织
							</a>
						</li>
						<?php else: endif; ?>		


						<li>
							<a href="<?php echo u('user/index/logout');?>">
								<i class="fa fa-sign-out"></i>
								&nbsp;退出
							</a>
						</li>
					</ul>
				</li>

				<li class="dropdown user offline">
					<a class="dropdown-toggle user" data-toggle="dropdown" href="#">
						<img src="/thinkcmfx/tpl/test//Public/images/headicon.png" class="headicon"/>
						登录
						<b class="caret"></b>
					</a>
					<ul class="dropdown-menu pull-right">
						<li>
							<a href="<?php echo U('api/oauth/login',array('type'=> 'sina'));?>">
								<i class="fa fa-weibo"></i>
								&nbsp;微博登录
							</a>
						</li>
						<li>
							<a href="<?php echo U('api/oauth/login',array('type'=> 'qq'));?>">
								<i class="fa fa-qq"></i>
								&nbsp;QQ登录
							</a>
						</li>
						<li>
							<a href="<?php echo u('user/login/index');?>">
								<i class="fa fa-sign-in"></i>
								&nbsp;登录
							</a>
						</li>
						<li class="divider"></li>
						<li>
							<a href="<?php echo u('user/register/index');?>">
								<i class="fa fa-user"></i>
								&nbsp;注册
							</a>
						</li>
					</ul>
				</li>
			</ul>
<!-- 			<div class="pull-right">
				<form method="post" class="form-inline" action="<?php echo U('portal/search/index');?>" style="margin:18px 0;">
					<input type="text" class="" placeholder="站内搜索" name="keyword" value="<?php echo I('get.keyword');?>"/>
					<input type="submit" class="btn btn-info" value="Go" style="margin:0"/>
				</form>
			</div> -->
		</div>
	</div>
</div>

</div>
	<div class="container tc-main">
		<div class="row">
				<div class="tc-box first-box article-box">
					<div id="article_content">
						<!-- 内容开始 -->
						<div class="content">
							<div class="tabs">
								<ul class="nav nav-pills" style="border-bottom:solid #428bca;">
									<li class="active">
										<a href="<?php echo U('Portal/List/hdggList',array('stid'=>$_GET['stid']));?>" style="margin-bottom:0px;">活动公告</a>
									</li>
								</ul>
								<div class="tab-content">
									<div class="tab-pane active" id="one">
										<div class="span5">
											<!-- <img alt="" src="‪‪‪‪<?php echo U('user/public/avatar',array('id'=>$vo['id']));?>"> -->
											<img src="<?php echo sp_get_asset_upload_path($picture);?>" style="width:500px;height:700px;" />
										</div>
										<input type="hidden" value="<?php echo ($data['id']); ?>">
										<div class="span3">
											<div class="control-group">
												<label class="control-label"> <i class="icon-bookmark"></i>
													活动主题:
												</label>
												<div class="controls"><?php echo ((isset($theme) && ($theme !== ""))?($theme):'未填写'); ?></div>
											</div>

											<div class="control-group">
												<label class="control-label" > <i class="icon-time"></i>
													活动时间:
												</label>
												<div class="controls"><?php echo ((isset($begin_time) && ($begin_time !== ""))?($begin_time):'未填写'); ?></div>
											</div>

											<div class="control-group">
												<label class="control-label" >
													<i class="fa fa-location-arrow"></i>
													活动地点:
												</label>
												<div class="controls"><?php echo ((isset($addr) && ($addr !== ""))?($addr):'未填写'); ?></div>
											</div>

											<div class="control-group">
												<label class="control-label" >
													<i class="fa fa-users"></i>
													参加人数上限:
												</label>
												<div class="controls"><?php echo ((isset($require) && ($require !== ""))?($require):'未填写'); ?> 人</div>
											</div>

											<div class="control-group">
												<label class="control-label" >
													<i class="icon-minus-sign"></i>
													报名截止时间:
												</label>
												<div class="controls"><?php echo ((isset($deadline) && ($deadline !== ""))?($deadline):'未填写'); ?></div>
											</div>

										<div class="control-group">
											<div class="controls">
											<form class="J_ajaxForm" action="<?php echo leuu('article/hdggDetail',array('stid'=>$_GET['stid'],'id'=>$_GET['id']));?>" method="post">
												<button class="btn btn-success J_ajax_submit_btn">我要报名</button>
											</form>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="control-group joined">
								<ul class="list-unstyled tc-photos margin-bottom-30">
									<?php if(is_array($joinedList)): foreach($joinedList as $key=>$vo): ?><li>
										<a href="/ThinkCMFX/index.php/user/index/index/id/<?php echo ($vo['user_id']); ?>">
										<img alt="<?php echo ($vo['nicename']); ?>" src="<?php echo sp_get_user_avatar_url($vo['avatar']);?>" data-bd-imgshare-binded="1"></a>
									</li><?php endforeach; endif; ?>

								</ul>

							</div>

							<div class="control-group">
								<div>
								<ul class="nav nav-pills" style="border-bottom:solid #428bca;">
									<li class="active">
										<a href="<?php echo leuu('');?>" style="margin-bottom:0px;">活动内容</a>
									</li>
								</ul>
								</div>
								<div class=""style="font-size:15px;font-weight:normal;clear:both"><?php echo ((isset($content) && ($content !== ""))?($content):'未填写'); ?></div>
							</div>
					</div>
				</div>
				<!-- 内容结束 -->
			</div>
			<?php echo Comments("launch_activity",$id);?>
		</div>
	</div>
	<html>
<head>
<style type="text/css">
.myhook{

}
</style>
<br><br><br>
<!-- Footer
      ================================================== -->



    </head>
    <body>
      <hr>
<?php echo hook('footer');?>

<div class="myhook">
  
</div>
      <div id="footer">
        <div class="links">
        <?php $links=sp_getlinks(); ?>
        <?php if(is_array($links)): foreach($links as $key=>$vo): ?><a href="<?php echo ($vo["link_url"]); ?>" target="<?php echo ($vo["link_target"]); ?>"><?php echo ($vo["link_name"]); ?></a><?php endforeach; endif; ?>
        </div>
        <p>
        Made by <a href="http://www.thinkcmf.com">ThinkCMF</a>
        Code licensed under the <a href="http://www.apache.org/licenses/LICENSE-2.0" rel="nofollow" target="_blank">Apache License v2.0</a>.<br/>
        Based on <a href="http://getbootstrap.com/2.3.2/" target="_blank">Bootstrap</a>.  Icons from <a href="http://fortawesome.github.com/Font-Awesome/" target="_blank">Font Awesome</a>
        </p>
      </div>
      <div id="backtotop"><i class="fa fa-arrow-circle-up"></i></div>
      <?php echo ($site_tongji); ?>

</body>
</html>

</div>

	<script type="text/javascript">
//全局变量
var GV = {
    DIMAUB: "/thinkcmfx/",
    JS_ROOT: "statics/js/",
    TOKEN: ""
};
</script>

<script src="/thinkcmfx/statics/js/jquery.js"></script>
<script src="/thinkcmfx/statics/js/wind.js"></script>
<script src="/thinkcmfx/tpl/test/Public/simpleboot/bootstrap/js/bootstrap.min.js"></script>
<script src="/thinkcmfx/tpl/test/Public/js/stjs/enroll.js"></script>

<script>
	$(function(){
		$('body').on('touchstart.dropdown', '.dropdown-menu', function (e) { e.stopPropagation(); });
		
		$("#main-menu li.dropdown").hover(function(){
			$(this).addClass("open");
		},function(){
			$(this).removeClass("open");
		});
		
		$.post("<?php echo U('user/index/is_login');?>",{},function(data){
			if(data.status==1){
				if(data.user.avatar){
					$("#main-menu-user .headicon").attr("src",data.user.avatar.indexOf("http")==0?data.user.avatar:"/thinkcmfx/data/upload/avatar/"+data.user.avatar);
				}
				
				$("#main-menu-user .user-nicename").text(data.user.user_nicename!=""?data.user.user_nicename:data.user.user_login);
				$("#main-menu-user li.user.login").show();
				
			}
			if(data.status==0){
				$("#main-menu-user li.user.offline").show();
			}
			
		});	
		;(function($){
			$.fn.totop=function(opt){
				var scrolling=false;
				return this.each(function(){
					var $this=$(this);
					$(window).scroll(function(){
						if(!scrolling){
							var sd=$(window).scrollTop();
							if(sd>100){
								$this.fadeIn();
							}else{
								$this.fadeOut();
							}
						}
					});
					
					$this.click(function(){
						scrolling=true;
						$('html, body').animate({
							scrollTop : 0
						}, 500,function(){
							scrolling=false;
							$this.fadeOut();
						});
					});
				});
			};
		})(jQuery); 
		
		$("#backtotop").totop();
		
		
	});
	</script>

	
</body>
</html>