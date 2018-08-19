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
span{
	margin:10px;
}
.control-label{

  font-weight: bold;
  font-size:20px;
  width: 100px;
}
.controls{
  font-weight: bold;
  font-size:19px;
  width:400px;
  margin-top: 5px;
}
.controls font{
  font-size:15px;
  font-weight:normal;
  clear:both;
}
.control-group orgdata{
  margin-bottom:1px;
}
.content{
  margin-left:1px;
}

textarea{
  width: 500px;
  height: 84px;
}
</style>
</head>
<body class="J_scroll_fixed">
	<div class="wrap J_check_wrap">
		<ul class="nav nav-tabs">
     		<li class="active"><a href="<?php echo U('OrganizationAdmin/orgbasedata',array('orgid'=>$orgid));?>">组织资料</a></li>
        <li ><a href="<?php echo U('OrganizationAdmin/requirement',array('orgid'=>$orgid));?>">招募要求</a></li>
     		<li ><a href="<?php echo U('OrganizationAdmin/logo',array('orgid'=>$orgid));?>">更新logo</a></li>
		</ul>
    <form action="<?php echo U('OrganizationAdmin/orgbasedata',array('orgid'=>$orgid));?>" method="post" class="form-horizontal J_ajaxForms" enctype="multipart/form-data">
      <div class="tab-pane active">
            <div class="span3">
              <h3>组织logo</h3>
             <?php if(empty($data['logo'])): ?><img src="/thinkcmfx/data/upload/orglogo/default.jpg" />
              <?php else: ?>
               <img src="<?php echo sp_get_asset_upload_path($data['logo']);?>"/><?php endif; ?> 
              <h3>宣传标语：</h3>
              <textarea name="slogan" style="width:200px;height:50px;"><?php echo ($data['slogan']); ?> </textarea>


            </div>
                <input type="hidden" value="<?php echo ($data['id']); ?>"name="id">
          <div class="span6"> 
              <div class="control-group orgdata">
                <label class="control-label">组织名称:</label>
                <div class="controls"> <?php echo ($data['name']); ?> </div>
              </div>                                        
              <div class="control-group orgdata">
                  <label class="control-label" for="">创建时间:</label>
                  <div class="controls"> <?php echo (date("Y-m-d H:i:s",$data['create_time'])); ?> </div>                       
              </div>
               <div class="control-group orgdata">
                  <label class="control-label" >所在地:</label>
                  <div class="controls">  <?php echo ($city); ?></div>                                       
              </div>
              <div class="control-group orgdata">
                  <label class="control-label" >创建人:</label>
                  <div class="controls"><?php echo ($creator); ?></div>                               
              </div>
              <div class="control-group orgdata">
                  <label class="control-label" >当前人数</label>
                  <div class="controls"><?php echo ($count); ?></div>                       
              </div>

              <div class="control-group orgdata">
                <div >
                  <label class="control-label" style="margin-bottom:10px">组织简介:</label>
                </div>
                <div class="controls font">
                  <textarea name="introduction"><?php echo ((isset($data['introduction']) && ($data['introduction'] !== ""))?($data['introduction']):'未填写'); ?></textarea>
                </div>
              </div>
              <div class="control-group orgdata">
                  <label class="control-label" >审核问题:</label>
                  <div class="controls font"> 
                    <textarea name="issue"><?php echo ((isset($data['issue']) && ($data['issue'] !== ""))?($data['issue']):'未填写'); ?> </textarea></div> 
              </div> 

              <div class="form-actions" style="background:#fff;">
                <input class="btn btn-primary btn_submit J_ajax_submit_btn"type="submit"value="更新资料">
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
initialFrameWidth:600,
};
editorcontent = new baidu.editor.ui.Editor(editorOption);
editorcontent.render( 'content' );
try{editorcontent.sync();}catch(err){};


</script>
</body>
</html>