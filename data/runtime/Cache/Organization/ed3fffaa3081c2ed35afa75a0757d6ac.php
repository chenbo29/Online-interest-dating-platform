<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<!-- Set render engine for 360 browser -->
	<meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- HTML5 shim for IE8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <![endif]-->

	<link href="/thinkcmfx/statics/simpleboot/themes/<?php echo C('SP_ADMIN_STYLE');?>/theme.min.css" rel="stylesheet">
    <link href="/thinkcmfx/statics/simpleboot/css/simplebootadmin.css" rel="stylesheet">
    <link href="/thinkcmfx/statics/js/artDialog/skins/default.css" rel="stylesheet" />
    <link href="/thinkcmfx/statics/simpleboot/font-awesome/4.2.0/css/font-awesome.min.css"  rel="stylesheet" type="text/css">
    <style>
		.length_3{width: 180px;}
		form .input-order{margin-bottom: 0px;padding:3px;width:40px;}
		.table-actions{margin-top: 5px; margin-bottom: 5px;padding:0px;}
		.table-list{margin-bottom: 0px;}
	</style>
	<!--[if IE 7]>
	<link rel="stylesheet" href="/thinkcmfx/statics/simpleboot/font-awesome/4.2.0/css/font-awesome-ie7.min.css">
	<![endif]-->
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
    <script src="/thinkcmfx/statics/simpleboot/bootstrap/js/bootstrap.min.js"></script>
<?php if(APP_DEBUG): ?><style>
		#think_page_trace_open{
			z-index:9999;
		}
	</style><?php endif; ?>
<!-- <script type="text/javascript" src="/thinkcmfx/statics/js/layer/layer.js"></script> -->
<style type="text/css">

</style>
</head>
<body class="J_scroll_fixed">
	<div class="wrap J_check_wrap">
		<ul class="nav nav-tabs">
     		<li ><a href="<?php echo U('OrganizationAdmin/orgbasedata',array('orgid'=>$orgid));?>">组织资料</a></li>
        <li class="active"><a href="<?php echo U('OrganizationAdmin/requirement',array('orgid'=>$orgid));?>">招募要求</a></li>
     		<li ><a href="<?php echo U('OrganizationAdmin/logo',array('orgid'=>$orgid));?>">更新logo</a></li>
		</ul>
    <form action="<?php echo U('OrganizationAdmin/requirement',array('orgid'=>$orgid));?>" method="post" class="form-horizontal J_ajaxForms" enctype="multipart/form-data">
      <div class="tab-pane active">

              <h3>招募要求：</h3><span>招募要求的显示会完全按照您在如下编辑框中书写的格式，所以请尽量以条目（如1.……。2.……。）的形式列出，确保美观。</span>
              <div id='content_tip'></div>
                    <script type="text/plain" id="content" name="requirements"><?php echo ($data['requirements']); ?></script>
                    <script type="text/javascript">
                    //编辑器路径定义
                    var editorURL = GV.DIMAUB;
                    </script>
                    <script type="text/javascript"  src="/thinkcmfx/statics/js/ueditor/ueditor.config.js"></script>
                    <script type="text/javascript"  src="/thinkcmfx/statics/js/ueditor/ueditor.all.min.js"></script>

                <input type="hidden" value="<?php echo ($data['id']); ?>"name="id">
         
              <div class="form-actions" style="background:#fff;">
                <input class="btn btn-primary btn_submit J_ajax_submit_btn"type="submit"value="更新招募要求">
             </div>   
          </div>
        
      </div>
    </form>
	</div>
<script type="text/javascript">
var editorOption = {

serverUrl: "<?php echo U('Asset/UeditorPastactivity/upload',array('orgid'=>$orgid));?>",
//这里可以选择自己需要的工具按钮名称,此处仅选择如下五个
toolbars: [['fullscreen',  'undo', 'redo', 
      '|', 'emotion','bold','spechars', 'forecolor', 'fontfamily', 'fontsize','paragraph', 'formatmatch','indent',
        'forecolor', 'justifyleft','justifyright','justifycenter', 'justifyjustify', 'autotypeset','charts', 
      '|','map', 
      'link','|','time','date','help',
      
]],
initialFrameWidth:1000,
initialFrameHeight:500,
};
editorcontent = new baidu.editor.ui.Editor(editorOption);
editorcontent.render( 'content' );
try{editorcontent.sync();}catch(err){};


</script>
</body>
</html>