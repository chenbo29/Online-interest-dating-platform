<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <title><?php echo ($name); ?> <?php echo ($seo_title); ?> <?php echo ($site_name); ?></title>
    <meta name="keywords" content="<?php echo ($seo_keywords); ?>" />
    <meta name="description" content="<?php echo ($seo_description); ?>">
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
	
    <link href="/thinkcmfx/tpl/test/Portal/css/bootstrap.min.css" rel="stylesheet">

    <!--[if lt IE 9]>
    <script src="/thinkcmfx/tpl/test/Portal/js/html5shiv.js"></script>
    <script src="/thinkcmfx/tpl/test/Portal/js/respond.min.js"></script>
    <![endif]-->

    <style type="text/css">
html {
    background-color: #CCC
}
body {
    width: 80.9%;
    background-color: #FFF;
    margin: 0 auto
}
.wrap {
    margin-top: 10px;
}
/*.col-md-8{border-left:2px solid #600;}*/
/*.top {
    border-left: 2px solid #0CC;
}*/
.main-img {
    margin: 0 auto;
}
.main-list {
    margin-top: 20px
}
.row-fluid {
    margin-top: 10px
}
.main {
    margin-top: 20px;
    border-top: 3px solid #0CC;
}
.main li a {
    background-color: #F60;
    color: #fff;
}
.carousel-indicators
{
    margin-left:-5%;
}
.item 
{
    width: 1440px;
    height: 1440px;
    text-align:center;
}
.item img
{
    margin:0 auto;
    line-height: 1440px;
}
.tab-content {
     overflow: hidden; 
}
</style>
</head>

<body>
    <!-- 顶部导航 -->
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
    <!--活动展示主体开始-->
    <div class="wrap">
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="col-md-12">
                    <ul class="unstyled">
                        <li>
                            <h2>
                                <div class=" text-success glyphicon glyphicon-flag">&nbsp;活动主题——<?php echo ($article['theme']); ?></div>
                            </h2>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row-fluid">
                <div class="col-md-12 top">
                    <div class="main-list">
                        <ul class="unstyled list-inline">
                            <li>
                                <div class=" text-primary glyphicon glyphicon-star">
                                    &nbsp;活动类型：&nbsp;
                                    <small><?php echo ($article['type']); ?></small>
                                </div>
                            </li>
                            <li>&nbsp</li>
                            <li>
                                <div class=" text-primary glyphicon glyphicon-time">
                                    &nbsp;活动时间：&nbsp;
                                    <small>
                                        <?php echo (date("Y.m.d",strtotime($article['begin_time']))); ?>~<?php echo (date("Y.m.d",strtotime($article['over_time']))); ?>
                                    </small>
                                </div>
                            </li>
                            <li>&nbsp</li>
                            <li>
                                <div class=" text-primary glyphicon glyphicon-map-marker">
                                    &nbsp;活动地点：
                                    <small><?php echo ($article['addr']); ?></small>
                                </div>
                            </li>
                            <li>&nbsp</li>
                            <li>
                                <div class=" text-primary glyphicon glyphicon-user">
                                    &nbsp;参与人数：
                                    <small><?php echo ($article['people']); ?></small>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row-fluid">
                <div class="col-md-12">
                    <div class="main">
                        <div class="tabbable tabs-below" id="tabs">
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="#panel-1" data-toggle="tab">
                                        <div class="glyphicon glyphicon-list-alt">活动图片</div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#panel-2" data-toggle="tab">
                                        <div class="glyphicon glyphicon-picture">内容介绍</div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#panel-3" data-toggle="tab">
                                        <div class="glyphicon glyphicon-facetime-video">活动视频</div>
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content">

                                <div class="tab-pane active" id="panel-1">
                                        <div style="height:20px;"></div>
                                    <div id="ad-carousel" class="carousel slide" data-ride="carousel">
                                        <ol class="carousel-indicators">
                                            <li data-target="#ad-carousel" data-slide-to="0" class="active"></li>
                                            <li data-target="#ad-carousel" data-slide-to="1"></li>
                                            <li data-target="#ad-carousel" data-slide-to="2"></li>
                                            <li data-target="#ad-carousel" data-slide-to="3"></li>
                                            <li data-target="#ad-carousel" data-slide-to="4"></li>
                                        </ol>
                                        <div class="carousel-inner">
                                            <?php  if(count($picSrc)==0){ ?>

                                             <div class="item">
                                                 <p>没有照片！</p>
                                             </div>
                                            <?php  } else{ ?>
                                            <div class="item active">
                                                <img src="/thinkcmfx/data/upload/activityshow/<?php echo ($_GET['stid']); ?>/<?php echo ($picSrc[0]); ?>">
                                            </div>
                                           <?php  for ($i=1; $i < count($picSrc); $i++) { ?>
                                            <div class="item">
                                             <!-- <img src="<?php echo ($picSrc[$i]); ?>"> -->
                                              <img src="/thinkcmfx/data/upload/activityshow/<?php echo ($_GET['stid']); ?>/<?php echo ($picSrc[$i]); ?>">
                                          </div>
                                          <?php  } } ?>
                                          
                    </div>
                    <a class="left carousel-control" href="#ad-carousel" data-slide="prev">
                        <span
            class="glyphicon glyphicon-chevron-left"></span>
                    </a>
                    <a class="right carousel-control" href="#ad-carousel" data-slide="next">
                        <span
            class="glyphicon glyphicon-chevron-right"></span>
                    </a>
                </div>
            </div>

            <div class="tab-pane " id="panel-2">
               <div style="height:20px;"></div>
                <p> 
                  <?php echo ($article['content']); ?>
                </p>
            </div>

            <div class="tab-pane" id="panel-3">
               <div style="height:20px;"></div>
                <div class="video">
                   <video src="<?php echo ($article['video']); ?>"></video>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
</div>

<!--活动展示主体结束-->
<!-- 评论开始 -->
<div class="container-fluid"><?php echo Comments("activity_show",$article['id']);?></div>
<!-- 评论结束 -->
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

<!-- JavaScript -->
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

<script src="/thinkcmfx/tpl/test/Portal/js/jquery-1.11.1.min.js"></script>
<script src="/thinkcmfx/tpl/test/Portal/js/bootstrap.min.js"></script>
<script>
    $(function () {
        $('#ad-carousel').carousel();
        $('#menu-nav .navbar-collapse a').click(function (e) {
            var href = $(this).attr('href');
            var tabId = $(this).attr('data-tab');
            if ('#' !== href) {
                e.preventDefault();
                $(document).scrollTop($(href).offset().top - 70);
                if (tabId) {
                    $('#feature-tab a[href=#' + tabId + ']').tab('show');
                }
            }
        });
    });

</script>
<script type="text/javascript" src="http://player.youku.com/jsapi">
player = new YKU.Player('youkuplayer',{
styleid: '0',
client_id: '4998e5a698ba0b01',
vid: 'XMTMyOTEzODkwOA'
});
</script>
<!---->

</body>
</html>