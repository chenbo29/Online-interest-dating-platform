<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<title><?php echo ($site_seo_title); ?> <?php echo ($site_name); ?></title>
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
	
	<link href="/thinkcmfx/tpl/test/Public/css/slippry/slippry.css" rel="stylesheet">
	<link href="/thinkcmfx/statics/CoverScroll/css/coverscroll.css" rel="stylesheet">
	<link href="/thinkcmfx/tpl/test/Public/css/stcss/index.css" rel="stylesheet">

	<style>
.caption-wraper{position: absolute;left:50%;bottom:2em;}
.caption-wraper .caption{
position: relative;left:-50%;
background-color: rgba(0, 0, 0, 0.54);
padding: 0.4em 1em;
color:#fff;
-webkit-border-radius: 1.2em;
-moz-border-radius: 1.2em;
-ms-border-radius: 1.2em;
-o-border-radius: 1.2em;
border-radius: 1.2em;
}

@media (max-width: 767px){
	.sy-box{margin: 12px -20px 0 -20px;}
	.caption-wraper{left:0;bottom: 0.4em;}
	.caption-wraper .caption{
	left: 0;
	padding: 0.2em 0.4em;
	font-size: 0.92em;
	-webkit-border-radius: 0;
	-moz-border-radius: 0;
	-ms-border-radius: 0;
	-o-border-radius: 0;
	border-radius: 0;}
}

.usershow
{
	width: 100%;
	background: url(/thinkcmfx/tpl/test/Public/images/stimages/sectionBg.jpg) repeat;
}
.hdgg
{
	width: 100%;
	background: url(/thinkcmfx/tpl/test/Public/images/stimages/sectionBg.jpg) repeat;

}
.zygx{
	width: 100%;
	background: url(/thinkcmfx/tpl/test/Public/images/stimages/sectionBg.jpg) repeat;

}
</style>
</head>
<body class="body-white">

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

	<?php $home_slides=sp_getslide("portal_index",$_GET['stid']); $video=sp_getslidevideo("portal_index",$_GET['stid']); $home_slides=empty($home_slides)?$default_home_slides:$home_slides; ?>

	<!-- 轮播图开始 -->

	<!-- 轮播图结束 -->

	<!-- slider begin -->

	<ul id="homeslider" class="unstyled">
		<?php $flag=1; ?>
		<?php if(is_array($home_slides)): foreach($home_slides as $key=>$vo): ?><li>
				<div class="caption-wraper" >
					<div class="caption">
						<?php if(($video != null) AND ($flag == 1)): ?><p style="text-align:center;">
								<!-- <?php echo ($video); ?> -->
							</p>
							<video id="media"class="edui-upload-video  vjs-default-skin video-js" controls="" preload="none" width="800" height="35" src="<?php echo sp_get_asset_upload_path($video);?>" data-setup="{}">
								<source src="<?php echo sp_get_asset_upload_path($video);?>" type="rmvb"/>
							</video>
							<?php else: ?>
							<div class="piccontent"><?php echo ($vo["slide_content"]); ?></div><?php endif; ?>

					</div>
				</div>
				<a href="<?php echo ($vo["slide_url"]); ?>">
					<img src="<?php echo sp_get_asset_upload_path($vo['slide_pic']);?>" alt=""></a>
			</li>
			<?php $flag=0; endforeach; endif; ?>

	</ul>

	<!--  end-->

	<div class="">
		<!-- 公告开始 -->
		<div class="hdgg">
			<div class="row">
				<div class="span4">
					<div class="thumbnail" style="height: 350px;width:270px;">
						<div class="gg-pic">
							<!-- <a href="/thinkcmfx/index.php/list/hdggList/stid/<?php echo ($_GET['stid']); ?>" title="活动公告" target="_blank">
							-->
							<!-- 必须大U方法 -->
							<a href="<?php echo U('Portal/List/hdggList',array('stid'=> $_GET['stid']));?>" title="活动公告" target="_blank">
								<img class="lazy" src="/thinkcmfx/tpl/test/Public/images/hdgg.jpg" width="270" height="150"  alt="Headroom.js"></a>
						</div>

						<div class="caption gg" >
							<h3>
								<a href="<?php echo U('Portal/List/hdggList',array('stid'=> $_GET['stid']));?>" title="活动公告" target="_blank"> <i class="fa fa-flag"></i>
									&nbsp;最新活动
								</a>
							</h3>
							<div >
								<?php if(empty($latestHdgg)): ?><h3>近期暂无活动</h3>
									<?php else: ?>
									<h3>
										<a style="color:#000;"title="<?php echo ($latestHdgg['content']); ?>"href="<?php echo U('Portal/Article/hdggDetail',array('stid'=> $_GET['stid'],'id'=>$latestHdgg['id']));?>" target="_blank"><?php echo (msubstr($latestHdgg['theme'],0,8)); ?>
										</a>
									</h3><?php endif; ?>
							</div>
							<?php if(empty($latestHdgg)): else: ?>
								<div class="hdgginfo"> <i class="fa fa-paper-plane"></i>
									发起人by:
									<span style="float:right;"><?php echo ($latestHdgg['nicename']); ?></span>
								</div>
								<div class="hdgginfo">
									<i class="fa fa-user" ></i>
									人数要求:
									<span style="float:right;"><?php echo ((isset($latestHdgg['require']) && ($latestHdgg['require'] !== ""))?($latestHdgg['require']):"待定"); ?>人</span>
								</div>
								<div class="hdgginfo">
									<i class="fa fa-group"></i>
									已报人数:
									<span style="float:right;"><?php echo ($latestHdgg['joined']); ?>人</span>
								</div>
								<div class="hdgginfo">
									<i class="icon-time"></i>
									活动时间:
									<span style="float:right;"><?php echo (msubstr($latestHdgg['begin_time'],2,14,'utf-8',false)); ?></span>
								</div>
								<!-- 							<div class="hdgginfo">
								<i class="icon-warning-sign"></i>
								报名截止时间:
								<span style="float:right;"><?php echo (msubstr($latestHdgg['deadline'],2,14,'utf-8',false)); ?></span>
							</div>
							--><?php endif; ?>
					</div>
				</div>
			</div>
			<div class="span6">
				<h2>
					<i class="fa fa-envelope-o"></i>
					一般公告
					<a href="<?php echo U('list/ybggList',array('stid'=> $_GET['stid']));?>" class="more">
						更多
						<i class="fa fa-angle-right fa-lg"></i>
						<i class="fa fa-angle-right fa-lg"></i>
					</a>
				</h2>
				<ul>
					<?php if(is_array($ybggList)): foreach($ybggList as $key=>$vo): ?><li>
							<a href="<?php echo leuu('article/ybggDetail',array('stid'=> $_GET['stid'],'id'=>$vo['id']));?>">
								<h4>
									<i class="fa fa-paper-plane"></i>
									&nbsp;&nbsp;<?php echo (msubstr($vo['title'],0,35,'utf-8')); ?>
									<span class="rq"><?php echo (date("Y-m-d",strtotime($vo['time']))); ?></span>
								</h4>
							</a>
						</li><?php endforeach; endif; ?>
				</ul>
			</div>
		</div>
	</div>
	<!-- 公告结束 -->
	<div class="wqhd">
		<div class="row" id="lastest-active">
			<h2>
				<i class="fa fa-tags"></i>
				往期活动精选
				<a href="<?php echo U('list/actShowList',array('stid'=> $_GET['stid']));?>" class="more">
			更多
					<i class="fa fa-angle-right fa-lg"></i>
					<i class="fa fa-angle-right fa-lg"></i>
				</a>
			</h2>
			<!-- 最近一次活动展示 -->

			<div class="span3" >
				<div class="thumbnail" style="height: 368px;">
					<?php if(empty($latestHdgg)): ?><span style="color:red;font-size:20px;">暂未上传任何活动</span>
						<hr>
						<span style="font-size:15px;">
							对于组织做过的活动，
							<hr>
							管理员可以将这些精
							<hr>
							彩的活动通过后台上
							<hr>
							传后，就可以展示到这
							<hr>里。</span>
						<?php else: ?>
						<div class="cover-pic">
							<a href="<?php echo leuu('article/actShowDetail',array('stid'=> $_GET['stid'],'id'=>$first['id']));?>" title="<?php echo ($first['theme']); ?>" target="_blank">
								<img style="height:300px;width:270px"class="lazy" src="<?php echo sp_get_asset_upload_path($first['cover_picture']);?>"   alt="<?php echo ($vo['theme']); ?>"></a>
						</div>
						<div class="caption">
							<div class="titleposition">
								<a href="<?php echo leuu('article/actShowDetail',array('stid'=> $_GET['stid'],'id'=>$first['id']));?>" title="<?php echo ($first['theme']); ?>" target="_blank">
									<span class="activityshowhead"><?php echo (msubstr($first['theme'],0,20,'utf-8',false)); ?></span>
								</a>
							</div>
						</br>
						<div style="height:30px">
							<p><?php echo (msubstr($vo['conent'],0,25)); ?></p>
						</div>
						<div class="time">
							<span class="icon-time"></span>
							<?php echo (date("Y.m.d",strtotime($first['begin_time']))); ?>~<?php echo (date("Y.m.d",strtotime($first['over_time']))); ?>
							<span class="pull-right">
								<span class="icon-user" title="参与人数"></span>
								<?php echo ($first['people']); ?>
							</span>
						</div>

						<div class="apply">
							<a href="/thinkcmfx/index.php/Portal/Index/index/stid/<?php echo ($first['org_id']); ?>" target="_blank">
								<img class="face" src="<?php echo sp_get_asset_upload_path($first['logo']);?>" alt="<?php echo ($vo['name']); ?>" >
								<span class="name" title="<?php echo ($vo['name']); ?>"><?php echo ($first['name']); ?></span>
							</a>
						</div>
					</div><?php endif; ?>
			</div>
		</div>
		<!-- 最近一次活动展示结束 -->

		<!-- 历史活动展示开始-->
		<div class="old-act">
			<div id="demo">
				<div id="indemo">
					<div id="demo2">
						<ul id="S_LIST">
							<?php if(is_array($actShowList)): foreach($actShowList as $key=>$vo): ?><li>
									<div class="span3" >
										<div class="thumbnail" style="height: 368px;">
											<div class="cover-pic">
												<a href="<?php echo leuu('article/actShowDetail',array('stid'=> $_GET['stid'],'id'=>$vo['id']));?>" title="<?php echo ($vo['theme']); ?>" target="_blank">
													<img style="height:300px"class="lazy" src="<?php echo sp_get_asset_upload_path($vo['cover_picture']);?>" width="320" alt="<?php echo ($vo['theme']); ?>"></a>
											</div>
											<div class="caption">
												<div class="titleposition">
													<a href="<?php echo leuu('article/actShowDetail',array('stid'=> $_GET['stid'],'id'=>$vo['id']));?>" title="<?php echo ($vo['theme']); ?>" target="_blank">
														<span class="activityshowhead"><?php echo (msubstr($vo['theme'],0,20,'utf-8',false)); ?></span>
													</a>
												</div>
												<p><?php echo (msubstr($vo['content'],0,25)); ?></p>
												<div class="time">
													<span class="icon-time"></span>
													<?php echo (date("Y.m.d",strtotime($vo['begin_time']))); ?>~<?php echo (date("Y.m.d",strtotime($vo['over_time']))); ?>
													<span class="pull-right">
														<span class="icon-user" title="参与人数"></span>
														<?php echo ($vo['people']); ?>
													</span>
												</div>
												<div class="apply">
													<a href="/thinkcmfx/index.php/Portal/Index/index/stid/<?php echo ($vo['org_id']); ?>" target="_blank">
														<img class="face" src="<?php echo sp_get_asset_upload_path($vo['logo']);?>" alt="<?php echo ($vo['name']); ?>" title="活动行">
														<span class="name" title="<?php echo ($vo['name']); ?>"><?php echo ($vo['name']); ?></span>
													</a>
												</div>
											</div>
										</div>
									</div>
								</li><?php endforeach; endif; ?>
						</ul>
					</div>
					<div id="demo1">
						<ul id="S_LIST">
							<?php if(is_array($actShowList)): foreach($actShowList as $key=>$vo): ?><li>
									<div class="span3" >
										<div class="thumbnail" style="height: 368px;">
											<div class="cover-pic">
												<a href="<?php echo leuu('article/actShowDetail',array('stid'=> $_GET['stid'],'id'=>$vo['id']));?>" title="<?php echo ($vo['theme']); ?>" target="_blank">
													<img style="height:300px"class="lazy" src="<?php echo sp_get_asset_upload_path($vo['cover_picture']);?>" width="320" alt="<?php echo ($vo['theme']); ?>"></a>
											</div>
											<div class="caption">
												<div class="titleposition"style="margin-top:34%;">

													<a href="<?php echo leuu('article/actShowDetail',array('stid'=> $_GET['stid'],'id'=>$vo['id']));?>" title="<?php echo ($vo['theme']); ?>" target="_blank">
														<span class="activityshowhead"><?php echo (msubstr($vo['theme'],0,20,'utf-8',false)); ?></span>
													</a>
												</div>

												<div>
													<p><?php echo (msubstr($vo['content'],0,25)); ?></p>
												</div>
												<div class="time">
													<span class="icon-time"></span>
													<?php echo (date("Y.m.d",strtotime($vo['begin_time']))); ?>~<?php echo (date("Y.m.d",strtotime($vo['over_time']))); ?>
													<span class="pull-right">
														<span class="icon-user" title="参与人数"></span>
														<?php echo ($vo['people']); ?>
													</span>
												</div>
												<div class="apply">
													<a href="/thinkcmfx/index.php/Portal/Index/index/stid/<?php echo ($vo['org_id']); ?>" target="_blank">
														<img class="face" src="<?php echo sp_get_asset_upload_path($vo['logo']);?>" alt="<?php echo ($vo['name']); ?>" title="活动行">
														<span class="name" title="<?php echo ($vo['name']); ?>"><?php echo ($vo['name']); ?></span>
													</a>
												</div>
											</div>
										</div>
									</div>
								</li><?php endforeach; endif; ?>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- 资源共享开始 -->
<?php $zy_navs=_sp_get_menu_datas("5"); ?>
<div class="zygx">
	<div class="row">
		<h2>
			<i class="fa fa-link"></i>
			资源共享
			<!-- 		<a href="empty" class="more">
			更多
			<i class="fa fa-angle-right fa-lg"></i>
			<i class="fa fa-angle-right fa-lg"></i>
		</a>
		-->
	</h2>
	<div class="src-left">
		<ul>
			<?php if(is_array($zy_navs)): foreach($zy_navs as $key=>$v): ?><li>
					<a href="<?php echo ($v["href"]); ?>/stid/<?php echo ($_GET['stid']); ?>" target="_blank" title="炙爱" class="img">
						<img src="<?php echo ($v["icon"]); ?>"  width="230" height="150" alt="炙爱"></a>
					<p class="srcName">
						<a href="<?php echo ($v["href"]); ?>/stid/<?php echo ($_GET['stid']); ?>" target="_blank"><?php echo ($v["label"]); ?></a>
					</p>
					<p class="time"></p>
					<a href="<?php echo ($v["href"]); ?>/stid/<?php echo ($_GET['stid']); ?>" target="_blank" class="play" style="display: none;">
						<img src="http://image.kuwo.cn/www2014/play.png"></a>
				</li><?php endforeach; endif; ?>
		</ul>
	</div>
	<div class="src-right">
		<h2>
			<i class="fa fa-download"></i>
			置顶分享
		</h2>
		<ul>
			<?php if(is_array($shareList)): foreach($shareList as $key=>$v): ?><li>
					<a href="<?php echo leuu('article/index',array('id'=>$v['tid'],'stid'=>$_GET['stid']));?>"><?php echo ($v['post_title']); ?></a>
					<h4><?php echo (msubstr($v['post_excerpt'],0,100)); ?></h4>
				</li><?php endforeach; endif; ?>

		</ul>

	</div>
</div>
</div>
<!-- 资源共享结束 -->

<!-- 贴吧讨论区开始 -->
<div class="tieba">
<div class="row">
	<div class="accordion-group">
		<div class="accordion-heading">
			<h2 class="accordion-toggle">
				<a href="<?php echo U('list/tiebaList',array('stid'=> $_GET['stid']));?>">
					<i class="fa  fa-fire"></i>
					贴吧讨论区
				</a>

				<a href="<?php echo U('list/tiebaList',array('stid'=> $_GET['stid']));?>" class="more">
					更多
					<i class="fa fa-angle-right fa-lg"></i>
					<i class="fa fa-angle-right fa-lg"></i>
				</a>
			</h2>
		</div>
		<div id="collapse0" class="accordion-body in collapse" style="height: auto;">
			<div class="accordion-inner">
				<?php if(is_array($tiebaList)): foreach($tiebaList as $key=>$vo): ?><div class="list-boxes">
						<h2 class="pull-left">
							<a href="<?php echo leuu('article/tieziDetail',array('stid'=> $_GET['stid'],'id'=>$vo['id']));?>" target="_blank"><?php echo ($vo["post_title"]); ?>
							</a>
						</h2>
						<div class="pull-right">
							<a href="/user/index/index/id/1217.html" target="_blank"><?php echo ($vo["user_login"]); ?></a>
							<span>
								<i class="fa fa-eye"></i>
								:<?php echo ($vo["post_hits"]); ?>
							</span>
							<a href="<?php echo leuu('article/tieziDetail#comments',array('stid'=> $_GET['stid'],'id'=>$vo['id']));?>" target="_blank">
								<i class="fa fa-comment"></i>
								:
								<span><?php echo ($vo["comment_count"]); ?></span>
							</a>
							<span class=" time">
								<?php echo date("Y年m月d h:i", strtotime($vo['post_date'])); ?></span>
						</div>
					</div><?php endforeach; endif; ?>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
</div>
</div>
<!-- 贴吧讨论区结束 -->
<!-- 成员风采展示开始 -->
<div class="usershow">
<div class="row">
	<h2>
		<i class="fa fa-group"></i>
		成员风采
		<?php if(sp_in_current_org($userid,$_GET['stid'])): ?><a  href="<?php echo U('Organization/Organization/updateorguser',array('stid'=> $_GET['stid']));?>" target="_Blank" class="updateMyinfo">更新我的风采
			</a>
			<?php else: endif; ?>
		<a href="<?php echo U('Organization/Organization/allorguser',array('stid'=> $_GET['stid']));?>" target="_Blank" class="more">
			更多
			<i class="fa fa-angle-right fa-lg"></i>
			<i class="fa fa-angle-right fa-lg"></i>
		</a>
	</h2>
	<!-- <a  href="<?php echo U('Organization/Organization/allorguser',array('stid'=>$_GET['stid']));?>"target="_Blank">全部</a>
-->
<div id="container">
	<?php if(is_array($orguser)): foreach($orguser as $key=>$vo): if((empty($vo['avatar']))AND ($vo['public'] == 1)): ?><div class="item">
				<img src="<?php echo sp_get_user_avatar_url("null.jpg");?>" title="成员:<?php echo ((isset($vo['nicename']) && ($vo['nicename'] !== ""))?($vo['nicename']):$vo['user_login']); ?>"/>
				<div class="similarity">
					<a href="<?php echo U('Organization/Organization/detailorguser',array('id'=> $vo['id'],'stid'=>$_GET['stid']));?>"target="_Blank"title="点击查看详细信息" >详
					</a>
				</div>
				<div class="itemTitle">成员:<?php echo ((isset($vo['nicename']) && ($vo['nicename'] !== ""))?($vo['nicename']):$vo['user_login']); ?></div>
			</div>
			<?php elseif((empty($vo['avatar'])) AND ($vo['public'] == 0)): ?>
			<div class="item">
				<img src="<?php echo sp_get_user_avatar_url("private.jpg");?>" title="成员:<?php echo ((isset($vo['nicename']) && ($vo['nicename'] !== ""))?($vo['nicename']):$vo['user_login']); ?>"/>
				<div class="similarity">密</div>
				<div class="itemTitle">成员:<?php echo ((isset($vo['nicename']) && ($vo['nicename'] !== ""))?($vo['nicename']):$vo['user_login']); ?></div>
			</div>
			<?php elseif($vo['public'] == 1): ?>
			<div class="item">
				<img src="<?php echo sp_get_user_avatar_url($vo['avatar']);?>" title="成员:<?php echo ((isset($vo['nicename']) && ($vo['nicename'] !== ""))?($vo['nicename']):$vo['user_login']); ?>"/>
				<div class="similarity">
					<a href="<?php echo U('Organization/Organization/detailorguser',array('id'=> $vo['id'],'stid'=>$_GET['stid']));?>"target="_Blank" title="点击查看详细信息">详
					</a>
				</div>
				<div class="itemTitle">成员:<?php echo ((isset($vo['nicename']) && ($vo['nicename'] !== ""))?($vo['nicename']):$vo['user_login']); ?></div>

			</div>
			<?php else: ?>
			<div class="item">
				<img src="<?php echo sp_get_user_avatar_url("private.jpg");?>" title="成员:<?php echo ((isset($vo['nicename']) && ($vo['nicename'] !== ""))?($vo['nicename']):$vo['user_login']); ?>"/>
				<div class="similarity">密</div>
				<div class="itemTitle">成员:<?php echo ((isset($vo['nicename']) && ($vo['nicename'] !== ""))?($vo['nicename']):$vo['user_login']); ?></div>
			</div><?php endif; endforeach; endif; ?>
	<div style="margin-top:5px">
		<?php $userid=sp_get_current_userid(); ?>

		<!-- 		<a onClick="$('#container').coverscroll('prev')" href="javascript:;">上一个</a>
	&nbsp;&nbsp;
	<a onClick="$('#container2').coverscroll('next')" href="javascript:;">下一个</a>
	&nbsp;&nbsp; -->
</div>
</div>
</div>
</div>
<!-- 风采展示结束 -->

<!-- 招募要求 -->
<div class="zmyq">
<div class="row">
<h2>
<i class="fa fa-flag"></i>
招募要求
</h2>
<div class="zmyq-content">
	<?php echo ($orgdata['requirements']); ?>
</div>
</div>
</div>
<!-- 招募要求结束 -->
<!-- 留言板开始 -->
<div class="row message">
<h2 >
<i class="fa fa-comment"></i>
留言板
</h2>
<h4></h4>
<div  class="guestbooktable">
<table class="table table-hover "style="background:#F8F8F1;">
<thead>
	<tr>
		<th width="300">留言内容：</th>
		<th width="90">留言时间：</th>
	</tr>
</thead>
<tbody>
	<?php if(is_array($guestmsgs)): foreach($guestmsgs as $key=>$vo): ?><tr>
			<td><?php echo (msubstr($vo["msg"],0,30)); ?></td>
			<td><?php echo (msubstr($vo["createtime"],2,14,'utf-8',false)); ?></td>
		</tr><?php endforeach; endif; ?>
</tbody>
</table>
<div class="pagination"><?php echo ($Page); ?></div>
</div>
<div>
<form class="J_ajaxForm" role="form" method="post" action="<?php echo u('api/guestbook/addmsg');?>">
<!-- 保留$orgid接口 -->
<input type="hidden" class="span3"name="ORG_ID"value="<?php echo ($orgid); ?>">
<label>内容</label>
<textarea  placeholder="Write you message here..." name="msg" style="float: left; margin: 0px 0px 10px; width: 546px; height: 265px;resize: none;"></textarea>
<div  class="msg">
	<label>验证码</label>
	<br>
	<input type="text" class="span3" style=""placeholder="please enter the code"  name="verify" autocomplete="off">
	<br>
	<br>
	<?php echo sp_verifycode_img('length=4&font_size=20&width=238&height=34&font_color=&background=','style="cursor: pointer;vertical-align: top;" title="点击获取"');?>
	<br>
	<div class="controls">
		<br>
		<label class="radio inline"style="float:left">
			<input type="radio" name="public" value="1" checked>公开</label>
		<label class="radio inline" style="float:left">
			<input type="radio" value="0"name="public">不公开</label>
	</div>
	<br>
	<h5>公开后，您的留言将会显示在左侧，否则只有管理员能看到这条留言。</h5>
	<br>
	<button type="submit" class="btn btn-primary J_ajax_submit_btn">发送留言</button>
</div>
</form>
</div>
</div>
<!-- 留言板结束 -->

<div class="row">
<a href="<?php echo U('User/St/timeline',array('stid'=>$_GET['stid']));?>" class="btn btn-info">时间轴</a>
</div>
<div class="row">
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

<!-- 模组框 申请加入模块-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
	<h4 class="modal-title" id="exampleModalLabel">在申请前，您需要回答以下问题：</h4>
</div>
<div class="modal-body">
	<form id="rform"action="<?php echo U('organization/organization/doapply',array('orgid'=> $_GET['stid']));?>" method="post">
		<div class="form-group">
			<label for="message-text" class="control-label">Question: <?php echo ($orgdata["issue"]); ?></label>
			<textarea class="form-control" style="width:500px" id="message-text"></textarea>
			<p><?php echo ($info["name"]); ?>将获取您的个人资料，如果您不同意，请勿提交申请，点击退出！</p>
			<p id="error" style="color:red;font-size:20px"></p>
			<p id="success"style="color:blue"></p>
		</div>
	</form>
</div>
<div class="modal-footer">
	<button type="button" class="btn btn-default" data-dismiss="modal">退出</button>
	<button type="button" id="registerorg" class="btn btn-primary">提交申请</button>
</div>
</div>
</div>
</div>
<!-- 模组框 申请加入模块结束-->

</div>

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
<script src="/thinkcmfx/statics/js/frontend.js"></script>

<script>
	$(function(){
		$('body').on('touchstart.dropdown', '.dropdown-menu', function (e) { e.stopPropagation(); });
		
		$("#main-menu li.dropdown").hover(function(){
			$(this).addClass("open");
		},function(){
			$(this).removeClass("open");
		});
		
		$.post("<?php echo U('user/index/is_login',array('orgid'=>$_GET['stid']));?>",{},function(data){
			if(data.status==1){
				if(data.user.avatar){
					$("#main-menu-user .headicon").attr("src",data.user.avatar.indexOf("http")==0?data.user.avatar:"/thinkcmfx/data/upload/avatar/"+data.user.avatar);
				}
/*				if(data.isadmin==1){
					//alert("asdf");
					//$("#main-menu-user li.user.offline").show();
					$("#isorgadmin").show();
				}*/
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

<script src="/thinkcmfx/statics/CoverScroll/scripts/jquery.coverscroll.min.js"></script>
<script src="/thinkcmfx/tpl/test/Public/js/slippry.min.js"></script>
<script src="/thinkcmfx/tpl/test/Public/js/stjs/index.js"></script>

<script>
/*申请加入模组框*/
$('#registerorg').click(function(){
  var $reason=$('#message-text').val();
  var $action=$('#rform').attr('action');
  /*alert("sadfas");*/
  //console.log($action);
  $.post($action,{whyjoin:$reason},function(data){
    //console.log(data);
    //alert(data['uname']);
    //$('#notice').html(data.info);
    $('#error').html('');
    $('#success').html('');
    if(data.statu==0)
       $('#error').html(data.info);
    if(data.statu==1)
       $('#success').html(data.info);
    });
  })

/*风采展示模块特效*/
$('#container').coverscroll({items:'.item', 
	minfactor:20, 
	scalethreshold:0, 
	staticbelowthreshold:true, 
	distribution:1.5,
	selectedclass: false,
	 bendamount:2
});

$(function() {

  $('#exampleModal').on('show.bs.modal', function (e) {
  // do something...
  $('#error').html('');
  $('#success').html('');
	})

	//var flag=true;
	var demo1 = $("#homeslider").slippry({
		transition: 'fade',
		useCSS: true,
		captions: false,
		speed: 1000,
		pause: 2000,
/*		auto: true,
		preload: 'visible'*/
		//adaptiveHeight: true;
		//adaptiveWidth: true;
		//kenZoom: 140,
	});
		/*为播放添加监听事件，防止播放时幻灯片滚动*/
	Media = document.getElementById("media"); 

	Media.addEventListener("play",function(){
	 console.log("播放");
	 //document.getElementById("idif").value="true";
	 Media.height=500;
	 Media.width=800;
	 //demo1.goToPrevSlide();
	 demo1.stopAuto();
	 //demo1.destroySlider();
	 //return false;
	 //flag=false;
	 //demo1 = $("#demo1").slippry();
	 //demo1.auto=false;
	},false);


	Media.addEventListener("pause",function(){
	 console.log("暂停");
	 Media.height=40;
	 Media.width=800;
	 demo1.startAuto();
	 //flag=true;
	},false);

});

</script>
<?php echo hook('footer_end');?>
</body>
</html>