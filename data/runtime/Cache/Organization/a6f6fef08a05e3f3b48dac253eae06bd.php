<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<title><?php echo ($site_name); ?></title>
<meta name="keywords" content="<?php echo ($site_seo_keywords); ?>" />
<meta name="description" content="<?php echo ($site_seo_description); ?>">
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
	
<link rel="stylesheet" type="text/css" href="/thinkcmfx/statics/3DGallery/css/style.css" />
<script type="text/javascript" src="/thinkcmfx/statics/js/jquery.js"></script>
<script type="text/javascript" src="/thinkcmfx/statics/3DGallery/js/modernizr.custom.53451.js"></script>
<style>
.control-label{

	font-weight: bold;
	font-size:15px;
	float: left;
	width: 160px;
}
.controls{
	font-weight: bold;
	font-size:11px;
	width:500px;
}
.control-group{
	margin:10px;
}
.content{
	margin-left:10px;
}
.span3{
	margin-top:30px;
}
.myPic
{
  width: 250px;
  height: 250px;
}
</style>
</head>
<body class="body-white" id="top">
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

    <div class="tab-pane active" style="margin-top:30px"id="one">
       		<div class="span2"style="margin-left:300px">
             <?php if(empty($avatar)): ?><img src="/thinkcmfx/tpl/test//Public/images/headicon_128.png"/>
              <?php else: ?>
               <img src="<?php echo sp_get_user_avatar_url($avatar);?>"/><?php endif; ?> 
          </div>
                <input type="hidden" value="<?php echo ($data['id']); ?>">							
          <div class="span6"> 
              <div class="control-group">
                <label class="control-label" for="">用户名:</label>
                <div class="controls">
                  <?php echo ($data['user_login']); ?>
                </div>
              </div>                               			
         			<div class="control-group">
         				<label class="control-label" for="">昵称:</label>
         				<div class="controls">
         					<?php echo ((isset($data['nicename']) && ($data['nicename'] !== ""))?($data['nicename']):'未填写'); ?>
         				</div>
         			</div>

         			<div class="control-group">
         				<label class="control-label" >性别:</label>
         				<div class="controls">
         					<?php echo ((isset($data['sex']) && ($data['sex'] !== ""))?($data['sex']):'未填写'); ?>
         				</div>
         			</div>

         			<div class="control-group">
         				<label class="control-label" >生日:</label>
         				<div class="controls">
         					<?php echo ((isset($data['birthday']) && ($data['birthday'] !== ""))?($data['birthday']):'未填写'); ?>
         				</div>
         			</div>

         			<div class="control-group">
         				<label class="control-label" >个性签名:</label>
         				<div class="controls">
         					<?php echo ((isset($data['signature']) && ($data['signature'] !== ""))?($data['signature']):'未填写'); ?> 人
         				</div>
         			</div>

         			<div class="control-group">
         				<label class="control-label" >简介:</label>
         				<div class="controls">
         					<?php echo ((isset($data['introduction']) && ($data['introduction'] !== ""))?($data['introduction']):'未填写'); ?>
         				</div>
         			</div>

<!--                 <div class="control-group">
                <div class="controls">
                  <a href="<?php echo U('ActivityAdmin/currentactivity',array('orgid'=>$orgid));?>" type="button" class="btn">返回</a><label><?php echo ($orgid); echo ($data['picture']); ?></label>
                </div>
              </div> -->
          </div>

   	</div>

    <div style="margin-top:300px;">
      <h1 class="text-center">风采展示</h1>
        <section id="dg-container" class="dg-container">
        <div class="dg-wrapper">
          <?php  foreach ($picture as $value) { ?>
            
            <a href="#"><img src="/thinkcmfx/data/upload/orguser/<?php echo ($orgid); ?>/<?php echo ($value); ?>" >
            </a>            
          <?php } ?>
        </div>
        <nav> 
          <span class="dg-prev">&lt;</span>
          <span class="dg-next">&gt;</span>
        </nav>
      </section>
    </div>
	<!-- /container -->

<script type="text/javascript" src="/thinkcmfx/statics/3DGallery/js/jquery.gallery.js"></script>
<script type="text/javascript">
  $(function() {
    $('#dg-container').gallery();
  });
</script/>
</body>
</html>