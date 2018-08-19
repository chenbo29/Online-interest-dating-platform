<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<title><?php echo ($site_name); ?></title>
<meta name="keywords" content="<?php echo ($site_seo_keywords); ?>" />
<meta name="description" content="<?php echo ($site_seo_description); ?>">
<meta name="author" content="ThinkCMF">
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
	


<link href="/thinkcmfx/statics/diyUpload/css/webuploader.css" rel="stylesheet" type="text/css">
<link href="/thinkcmfx/statics/diyUpload/css/diyUpload.css" rel="stylesheet" type="text/css">


<style type="text/css">
#box
{
    margin-bottom: 10px;
    width: 540px;
    min-height: 270px;
    background: #DDDDDD;
}
.control-group{
  margin-top: 30px;
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

		<div class="container tc-main">
                <div class="row">
                <form class="form-horizontal J_ajaxForm" action="<?php echo u('Organization/updateorguser',array('id'=>$id,'stid'=>$stid));?>" method="post">
                    <div class="span6" >
	                    <div class="tabs">
                           <ul class="nav nav-tabs">
                               <li class="active"><a href="#one" data-toggle="tab"><i class="fa fa-list-alt"></i> 修改资料-这是您在这个组织的个人资料，与您在其他组织的个人资料无关</a></li>
                           </ul>
                           <div class="tab-content">
                               <div class="tab-pane active" id="one">

                                    <div class="control-group">
                                      <label class="control-label">昵称</label>
                                      <div class="controls">
                                        <input type="text" id="nicename" name="nicename"placeholder="点击右侧选框使用基础昵称" value="<?php echo ($nicename); ?>">
                                        <input type="hidden" id="basenicename"value="<?php echo ($user_nicename); ?>">
                                        <input type="checkbox" title="使用基础昵称"onclick="usebasenicename()">
                                      </div>
                                    </div>
                                    <div class="control-group">
                                      <label class="control-label">电话</label>
                                      <div class="controls">
                                        <input class="J_tel" type="text"style="" id="input-birthday"  name="tel" value="<?php echo ($tel); ?>"> *
                                        <div style="margin-top:8px">请您填写手机号码,以便方便的接收组织的活动通知。
                                        </div>
                                      </div>
                                    </div>
                                    <div class="control-group">
                                      <label class="control-label" for="input-signature">个性签名</label>
                                      <div class="controls">
                                        <textarea id="input-signature" placeholder="个性签名" name="signature"style="margin: 0px; width: 353px; height: 43px;"><?php echo ($signature); ?></textarea>
                                      </div>
                                    </div>
                                    <div class="control-group">
                                      <label class="control-label" for="input-signature">个人介绍</label>
                                      <div class="controls">
                                        <textarea id="input-signature" placeholder="个性签名" name="introduction"style="margin: 0px; width: 355px; height: 103px;"><?php echo ($introduction); ?></textarea>
                                      </div>
                                    </div>
 
                                  
                               </div>
                           </div>             
                       </div>
                    </div>
                  <div class="span6">
                    <div class="control-group">
                      <h3 style="">照片墙:</h3>
                      
                        <label >上传一组您专属的图片，让大家更好的认识你,这些图片会展示在风采展示模块。</label>
                        <label>注意，您本次上传的图片将会更新之前上传的图片。</label>
                    </div>
                    <div id="box">
                      <div id="upload"></div>
                     <input type="hidden" name="picture"id="picture"value="<?php echo ($picture); ?>"/>

                    </div>
                    <div class="control-group">
                      <div class="controls">
                        <button type="submit" class="btn btn-primary J_ajax_submit_btn">更新资料</button>
                      </div>
                    </div>
                  </div>
                    
                    <input type="hidden" name="id" id="" value="<?php echo ($id); ?>"/>
                    </form>
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
	<!-- /container -->
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

<script type="text/javascript" src="/thinkcmfx/statics/diyUpload/js/webuploader.html5only.min.js"></script>
<script type="text/javascript" src="/thinkcmfx/statics/diyUpload/js/diyUpload.js"></script>	
<script type="text/javascript">
var allname="";
var flag=1;
var path="data/upload/orguser";
$('#upload').diyUpload({
  // url:'/thinkcmfx/application/Common/Common/fileupload.php',
  url:"<?php echo U('Orguseruploadpic/index');?>",
  success:function( data ){
    if(flag==1){
      allname=data['_raw'];
      flag=0;
    }else{
      allname=allname+'+'+data['_raw'];
    }
    document.getElementById('picture').value=allname;

    console.info( allname );
  },
  error:function( err ) {
    console.info( err );  
  }
});
var fg=1;

var nicename=document.getElementById('nicename').value;
function usebasenicename(){
  var basenicename=document.getElementById('basenicename').value;
  
  if(fg==1){
    document.getElementById('nicename').value=basenicename;
    fg=0;
  }else{
    document.getElementById('nicename').value=nicename;
    fg=1;
  }
}
</script>
</body>
</html>