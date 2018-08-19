<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>组织发展历史时间轴</title>
<script type="text/javascript" src="/thinkcmfx/tpl/test/Public/js/stjs/jquery-1.7.2.js"></script>
<script type="text/javascript" src="/thinkcmfx/tpl/test/Public/js/stjs/jquery.mousewheel.js"></script>
<script type="text/javascript" src="/thinkcmfx/tpl/test/Public/js/stjs/jquery.easing.js"></script>
<script type="text/javascript" src="/thinkcmfx/tpl/test/Public/js/stjs/history.js"></script>
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
	
<link rel="stylesheet" type="text/css" href="/thinkcmfx/tpl/test/Public/css/stcss/history.css">
<script>
	$(function  () {
		var c=new Date().getFullYear().toString();
		$(".timeblock").attr("thisyear",c);
		var a=c.split(""),b=["numf","nums","numt","numfo"];
		for(i=0;4>i;i++)
		$("."+b[i]+"").stop(!0,!1).animate({backgroundPosition:"0px "+-24*a[i]},{duration:200});
	})
</script>
</head>
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
				<img style="width:130px;"src="<?php echo sp_get_asset_upload_path($orgdata['logo']);?>"/>
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
							<a href="<?php echo u('Admin/Public/dologin',array('orgid'=>$_GET['stid']));?>"><i class="fa fa-cogs"></i>管理组织
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
<div id="arrow" >
	<ul>
		<li class="arrowup"></li>
		<li class="arrowdown"></li>
	</ul>
</div>

<div id="history">

	<div class="title">
		<h2>我们的成长史</h2>
		<div id="circle">
			<div class="cmsk"></div>
			<div class="circlecontent">
				<div thisyear="" class="timeblock">
					<span class="numf"></span>
					<span class="nums"></span>
					<span class="numt"></span>
					<span class="numfo"></span>
					<div class="clear"></div>
				</div>
				<div class="timeyear">YEAR</div>
			</div>
			<a href="#" class="clock"></a>
		</div>
	</div>
	
	<div id="content">
		<ul class="list">

		<?php if(is_array($timelineList)): foreach($timelineList as $key=>$vo): ?><li>
				<div class="liwrap">
						<div class="lileft">
							<div class="date">
								<span class="year"><?php echo (date("Y",strtotime($vo['time']))); ?></span>
								<span class="md"><?php echo (date("md",strtotime($vo['time']))); ?></span>
							</div>
						</div>
						
						<div class="point"><b></b></div>
						
						<div class="liright">
							<div class="histt"><a href="#"><?php echo (msubstr($vo['title'],0,50,"utf-8")); ?></a></div>
							<div class="hisct"><?php echo (msubstr($vo['content'],0,100,"utf-8",true)); ?></div>
						</div>
					</div>
				</li><?php endforeach; endif; ?>

		</ul>
	</div>
	
</div>
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