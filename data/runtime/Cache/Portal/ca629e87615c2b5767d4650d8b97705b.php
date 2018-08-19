<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<title><?php echo ($name); ?> <?php echo ($seo_title); ?> <?php echo ($site_name); ?></title>
	<meta name="keywords" content="<?php echo ($seo_keywords); ?>" />
	<meta name="description" content="<?php echo ($seo_description); ?>">
	<link rel="stylesheet" type="text/css" href="/thinkcmfx/tpl/test/Public/css/stcss/tieba.css">
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
	
</head>

<body style="background:#fff">
	<?php echo hook('body_start');?>
<style type="text/css">
#orgname{
display: inline-block;
margin-left: 20px;
font-size: 35px;
color: #1AD4D1;
}
.pull-right{
font-size:20px;
font-family: "华文行楷";
}

.user-nicename{
font-size: 25px;
}
#applytojoin{
	float: right;
	margin-top: 30px;
	margin-left: 10px;
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
			<?php $userid=sp_get_current_userid(); ?>
			<?php if(!sp_in_current_org($userid,$_GET['stid'])): ?><div id="applytojoin">
				<a  href="#"data-toggle="modal" data-target="#exampleModal" data-whatever="">申请加入</a>
				</div>
				<?php else: endif; ?>
			<!-- 改为大U方法才识别当前模块 -->
			<a class="pull-left"href="<?php echo U('Index/index',array('stid'=>$_GET['stid']));?>">
			<!-- <a class="pull-left"href="/thinkcmfx/index.php/Index/index/stid/<?php echo ($_GET['stid']); ?>"> -->
			<!-- <a class="brand" href="/thinkcmfx/"> -->
				<img style="width:132px;"src="<?php echo U('Organization/Orgdata/logo',array('stid'=>$_GET['stid']));?>"/>
			</a>
			<div class="nav-collapse collapse" id="main-menu">
				<!--  /*<?php
 $effected_id=""; $filetpl="<a href='\$href' target='\$target'>\$label</a>
			"; $foldertpl="
			<a href='\$href' target='\$target' class='dropdown-toggle' data-toggle='dropdown'>
				\$label <b class='caret'></b>
			</a>
			"; $ul_class="dropdown-menu" ; $li_class="" ; $style="nav"; $showlevel=6; $dropdown='dropdown'; echo sp_get_menu("main",$effected_id,$filetpl,$foldertpl,$ul_class,$li_class,$style,$showlevel,$dropdown); ?>*/ -->
			<ul class="nav">
				<li >
				<a id="orgname"href="<?php echo U('Index/index',array('stid'=>$_GET['stid']));?>">
				<?php echo sp_get_org_name($_GET['stid']);?></a>
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
			<div class="pull-right">
				<form method="post" class="form-inline" action="<?php echo U('portal/search/index');?>" style="margin:18px 0;">
					<input type="text" class="" placeholder="站内搜索" name="keyword" value="<?php echo I('get.keyword');?>"/>
					<input type="submit" class="btn btn-info" value="Go" style="margin:0"/>
				</form>
			</div>
		</div>
	</div>
</div>

</div>
	<div class="container tc-main">
		<div class="span12">
			<ul class="nav nav-tabs">
				<li class="active">
					<a href=""> <i class="fa fa-plus"></i>
						我要发帖
					</a>
				</li>
			</ul>
			<!-- 帖子 -->
			<div class="tiezi">
				<form class="form-horizontal J_ajaxForm" action="<?php echo U('User/UserPost/add_post',array('stid'=>$_GET['stid']));?>" method="post">
					<div class="control-group">
						<label class="control-label" for="input-title">标题</label>
						<div class="controls">
							<input type="text" id="input-title" placeholder="标题" name="title"></div>
					</div>
					<div class="control-group">
						<label class="control-label" for="input-title">描述</label>
						<!-- 正文 -->
						<div class="controls">
							<div id="description" class="edui-default" style="width: 100%;">

								<script type="text/plain" id="content" name="post_content"></script>
								<script type="text/javascript">
				                //编辑器路径定义
				                // var editorURL = GV.DIMAUB;
				              
		                		</script>
								<script type="text/javascript"  src="/thinkcmfx/statics/js/ueditor/ueditor.config.js"></script>
								<script type="text/javascript"  src="/thinkcmfx/statics/js/ueditor/ueditor.all.min.js"></script>

							</div>
						</div>
						<!-- 正文结束 -->
					</div>
					<input type="hidden"  value="" >
					<div class="control-group">
						<div class="controls">
							<button type="submit" class="btn btn-primary J_ajax_submit_btn" data-wait="1500">发布</button>
							<a href="<?php echo U('list/tiebaList',array('stid'=>$_GET['stid']));?>" class="btn btn-info">返回列表页</a>
						</div>
					</div>
				</form>
			</div>
			<!-- 帖子 -->
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

</body>
<script type="text/javascript">
//全局变量
var GV = {
    DIMAUB: "/thinkcmfx/",
    JS_ROOT: "statics/js/",
    TOKEN: ""
};
</script>
<!-- Le javascript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
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



<script>
	 //编辑器
	            editorcontent = new baidu.editor.ui.Editor({initialFrameHeight:260,initialFrameWidth:850,
	            	toolbars: [['fullscreen',  'undo', 'redo', 
					      '|', 'emotion','bold','spechars', 'forecolor', 'fontfamily', 'fontsize','paragraph', 'formatmatch','indent',
					        'forecolor', 'justifyleft','justifyright','justifycenter', 'justifyjustify', 'autotypeset','charts', 'time','date',
					 
					]]
	            });
	            editorcontent.render( 'content' );
	            try{editorcontent.sync();}catch(err){};
	            //增加编辑器验证规则
	            jQuery.validator.addMethod('editorcontent',function(){
	                try{editorcontent.sync();}catch(err){};
	                return editorcontent.hasContents();
	            });
</script>