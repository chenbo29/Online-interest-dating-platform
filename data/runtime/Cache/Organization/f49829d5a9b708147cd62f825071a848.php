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


<style type="text/css">
.tab-content{overflow: visible;}

.uploaded_avatar_area{
	margin-top: 20px;
}
.uploaded_avatar_btns{
	margin-top: 20px;
}
.uploaded_avatar_area .uploaded_avatar_btns{display: none;}
.btn{position: relative;overflow: hidden;margin-right: 4px;display:inline-block; 
*display:inline;padding:4px 10px 4px;font-size:14px;line-height:18px; 
*line-height:20px;color:#fff; 
text-align:center;vertical-align:middle;cursor:pointer;background:#5bb75b; 
border:1px solid #cccccc;border-color:#e6e6e6 #e6e6e6 #bfbfbf; 
border-bottom-color:#b3b3b3;-webkit-border-radius:4px; 
-moz-border-radius:4px;border-radius:4px;} 
.btn input{position: absolute;top: 0; right: 0;margin: 0;border:solid transparent; 
opacity: 0;filter:alpha(opacity=0); cursor: pointer;} 

</style>
</head>
<body class="J_scroll_fixed">
	<div class="wrap J_check_wrap">
		<ul class="nav nav-tabs">
     		<li ><a href="<?php echo U('OrganizationAdmin/orgbasedata',array('orgid'=>$orgid));?>">组织资料</a></li>
     		<li class="active"><a href="<?php echo U('OrganizationAdmin/logo',array('orgid'=>$orgid));?>">更新logo</a></li>
		</ul>
        <div class="row">

            <div >
                   <div class="tabs">
                       <div class="tab-content">
                           <div class="tab-pane active" id="one">
                           		<?php if(empty($logo)): ?><img src="/thinkcmfx/data/upload/orglogo/default.jpg" class="headicon"/>
					            <?php else: ?>
					            	<img src="<?php echo sp_get_asset_upload_path($logo);?>" class="headicon"/><?php endif; ?>
					       <div>
					        <div class="btn"><span>上传图片</span>
                           		<input type="file" onchange="avatar_upload(this)" id="avatar_uploder"  name="file"/>
                           	</div>
                           </div>
                           		<div class="uploaded_avatar_area">
                           		
                           		<div class="uploaded_avatar_btns">
                           			<a class="btn btn-primary confirm_avatar_btn" onclick="update_avatar()">确定</a>
                           			<a class="btn" onclick="reloadPage()">取消</a>
                           		</div>
                           		</div>
                           </div>
                       </div>							
                   </div>
            </div>
            <div class="span6">
            	<span>图片最佳比例为9：3</span>
            	<span>组织logo是体现组织风采的第一展，</br>请挑选合适的图片作为logo。</span>
            </div>
        </div>
	</div>
	<!-- /container -->

	
<script type="text/javascript">
function update_avatar(){
	var area=$(".uploaded_avatar_area img").data("area");
	//alert(area['x']+" "+area['y']+" "+area['w']+" "+area['h']);
	$.post("<?php echo U('OrganizationAdmin/updatelogo',array('orgid'=>$orgid));?>",area,
			function(data){
		if(data.status==1){
			/*alert('asdf');
			reloadPage(window);*/
			location.reload(true);
		}
		
	},"json");
	
}
function reloadPage(){
	location.reload(true);
}
function avatar_upload(obj){
	var $fileinput=$(obj);
	/* $(obj)
	.show()
	.ajaxComplete(function(){
		$(this).hide();
	}); */
	Wind.css("jcrop");
	Wind.use("ajaxfileupload","jcrop","noty",function(){
		$.ajaxFileUpload({
			url:"<?php echo U('OrganizationAdmin/uploadlogo',array('orgid'=>$orgid));?>",
			secureuri:false,
			fileElementId:"avatar_uploder",
			dataType: 'json',
			data:{},
			success: function (data, status){
				if(data.status==1){
					$("#avatar_uploder").hide();
					var $uploaded_area=$(".uploaded_avatar_area");
					$uploaded_area.find("img").remove();
					var $img=$("<img/>").attr("src","/thinkcmfx/data/upload/orglogo/cache/"+data.data.file);
					$img.prependTo($uploaded_area);
					$(".uploaded_avatar_btns").show();
					$img.Jcrop({
						allowResize:true,
						bgOpacity:0.5,
				    	aspectRatio:9/5,
				    	setSelect: [ 0, 0, 100, 100 ],
				    	onSelect: function(c){
				    		$img.data("area",c);
				    	}
				    });
					
				}else{
					noty({text: data.info,
                		type:'error',
                		layout:'center'
                	});
				}
				
			},
			error: function (data, status, e){}
		});
	});
	
	
	
	return false;
}
</script>
</body>
</html>