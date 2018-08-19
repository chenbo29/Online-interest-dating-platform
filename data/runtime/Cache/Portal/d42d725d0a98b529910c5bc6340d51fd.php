<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<title><?php echo ($name); ?> <?php echo ($seo_title); ?> <?php echo ($site_name); ?></title>
<meta name="keywords" content="<?php echo ($seo_keywords); ?>" />
<meta name="description" content="<?php echo ($seo_description); ?>">
<link rel="stylesheet" type="text/css" href="/thinkcmfx/tpl/test/Public/css/stcss/resource.css">
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
	
<style type="text/css">

.col-auto { overflow: auto; _zoom: 1;_float: left;}
.col-right { float: right; width: 210px; overflow: hidden; margin-left: 6px; }
.table th, .table td {vertical-align: middle;}
.picList li{margin-bottom: 5px;}

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
  <form class="J_ajaxForm"name="myform" id="myform" action="<?php echo u('UploadShare/share_post',array('orgid'=>$stid));?>" method="post"  enctype="multipart/form-data">
  <div class="col-right">
    <div class="table_full">
      <table class="table table-bordered">
        <tr>
          <td><h3>注意</h3></td>
        </tr>
        <tr>
          <td>您可以在内容编辑框中插入一段视频，由于空间的限制，您最好先将视频上传到第三方视频网站，然后使用<img src="/thinkcmfx/statics/images/icon/movie.png">引用您要上传的视频flash网址即可。</td>
        </tr>
        <tr>
          <td><b>发布时间</b></td>
        </tr>
        <tr>
          <td><input type="text" name="post[post_modified]" id="updatetime" value="<?php echo date('Y-m-d H:i:s',time());?>" size="21" class="input length_3 J_datetime" style="width: 160px;"></td>
        </tr>

      </table>
    </div>
  </div>
  <div class="col-auto">
    <div class="table_full">
      <table class="table table-bordered">
            <tr>
              <th width="80">栏目</th>
              <td>
				<select  style="max-height: 100px;" name="term">
					<?php echo ($taxonomys); ?>
				</select>

              </td>
            </tr>
            <tr>
              <th width="80">标题 </th>
              <td>
              	<input type="text" style="width:400px;" name="post[post_title]" id="title"  required value="" style="color:" class="input input_hd J_title_color" placeholder="请输入标题" onkeyup="strlen_verify(this, 'title_len', 160)" />
              	<span class="must_red">*</span>
              </td>
            </tr>
            <tr>
              <th width="80">关键词</th>
              <td><input type='text' name='post[post_keywords]' id='keywords' value='' style='width:400px'   class='input' placeholder='请输入关键字'> 多关键词之间用空格或者英文逗号隔开</td>
            </tr>
            <tr>
              <th width="80">资源来源</th>
              <td><input type='text' name='post[post_source]' id='source' value='' style='width:400px'   class='input' placeholder='请输入资源来源'></td>
            </tr>
            <tr>
              <th width="80">上传说明：</th>
              <td><lable>请使用下方图标菜单进行上传，文档和压缩文件使用<img src="/thinkcmfx/statics/images/icon/fujian.png">上传，图片使用<img src="/thinkcmfx/statics/images/icon/photos.png">或<img src="/thinkcmfx/statics/images/icon/photo.png">上传，视频使用<img src="/thinkcmfx/statics/images/icon/movie.png">可以插入视频网址或上传在下方编辑框中，您可以对上传的文件进行详细的描述。</lable></td>
            </tr>
            <tr>
              <th width="80">上传内容</th>
              <td><div id='content_tip'></div>
              <script type="text/plain" id="content" name="post[post_content]"></script>
                <script type="text/javascript">
                //编辑器路径定义
                var editorURL = GV.DIMAUB;
                </script>
                <script type="text/javascript"  src="/thinkcmfx/statics/js/ueditor/ueditor.config.js"></script>
                <script type="text/javascript"  src="/thinkcmfx/statics/js/ueditor/ueditor.all.min.js"></script>

				</td>
            </tr>
            <tr>
              <th width="70">是否公开:</th>
              <td>
                <div class="controls">
                  <label class="radio inline"style="float:left">
                    <input type="radio" name="permission" value="1" checked>公开
                  </label>
                  <label class="radio inline" style="float:left">
                    <input type="radio" value="0"name="permission">不公开
                  </label>
                  <p style= "margin-left:180px;font-size:15px">公开后，不是您组织的成员也可以看到这个资源。
                  </p>
                </div>

              </td>
            </tr>            
        </tbody>
      </table>
    </div>
  </div>
  <input type="hidden"id="orgid"value="<?php echo ($orgid); ?>">
  <div class="form-actions">
        <button class="btn btn-primary J_ajax_submit_btn"type="submit">上传</button>
        <a class="btn" href="<?php echo U('list/index',array('id'=>$typeid,'stid'=>$stid));?>">返回</a>
  </div>
 </form>

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


<script type="text/javascript">

$(function () {

       var editorOption = {

   	serverUrl: "<?php echo U('Asset/UeditorShare/upload',array('orgid'=>$stid));?>",
        //这里可以选择自己需要的工具按钮名称,此处仅选择如下五个
    toolbars: [['fullscreen',  'undo', 'redo', '|','snapscreen','emotion','fontsize', 'forecolor','backcolor', 'insertorderedlist', 'insertunorderedlist', 'selectall', 'cleardoc', '|','link', 'simpleupload', 'insertimage',  /*'scrawl',*/ 'insertvideo', 'music', 'attachment', /*'gmap',*/ /*'webapp',*/ 
		]],
        //focus时自动清空初始化时的内容
        //autoClearinitialContent: true,
         //关闭elementPath
         //elementPathEnabled: false
    };
    editorcontent = new baidu.editor.ui.Editor(editorOption);
    editorcontent.render( 'content' );
    try{editorcontent.sync();}catch(err){};
/*	            editorcontent.addListener('afterUpfile',function(t,arg){
    	//alert('adf');
    	console.log('选区发生不改变');
    });
     editorcontent.addListener( 'selectionchange', function( editorcontent ) {

			});*/
	

    //增加编辑器验证规则
    jQuery.validator.addMethod('editorcontent',function(){
        try{editorcontent.sync();}catch(err){};
        return editorcontent.hasContents();
    });

});
</script>
</body>
</html>