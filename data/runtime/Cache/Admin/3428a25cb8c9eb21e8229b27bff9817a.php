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
.col-auto { overflow: auto; _zoom: 1;_float: left;}
.col-right { float: right; width: 210px; overflow: hidden; margin-left: 6px; }
.table th, .table td {vertical-align: middle;}
<style type="text/css">
.col-auto { overflow: auto; _zoom: 1;_float: left;}
.col-right { float: right; width: 210px; overflow: hidden; margin-left: 6px; }
.table th, .table td {vertical-align: middle;}
.btn{position: relative;overflow: hidden;margin-right: 4px;display:inline-block; 
*display:inline;padding:4px 10px 4px;font-size:14px;line-height:18px; 
*line-height:20px;color:#fff; 
text-align:center;vertical-align:middle;cursor:pointer;background:#5bb75b; 
border:1px solid #cccccc;border-color:#e6e6e6 #e6e6e6 #bfbfbf; 
border-bottom-color:#b3b3b3;-webkit-border-radius:4px; 
-moz-border-radius:4px;border-radius:4px;} 
.btn input{position: absolute;top: 0; right: 0;margin: 0;border:solid transparent; 
opacity: 0;filter:alpha(opacity=0); cursor: pointer;} 
.progress{position:relative; margin-left:100px; margin-top:-24px;  
width:200px;padding: 1px; border-radius:3px; display:none} 
.bar {background-color: green; display:block; width:0%; height:20px;  
border-radius:3px; } 
.percent{position:absolute; height:20px; display:inline-block;  
top:3px; left:2%; color:#fff } 
.files{height:22px; line-height:22px; margin:10px 0} 
.delimg{margin-left:20px; color:#090; cursor:pointer} 
</style>
</head>
<body class="J_scroll_fixed">
<div class="wrap J_check_wrap">
  <form name="myform" id="myform" action="<?php echo U('slide/edit_post',array('orgid'=>$orgid));?>" method="post" class="form-horizontal J_ajaxForms" enctype="multipart/form-data">
  <div class="col-right">
    <div class="table_full">
      <table class="table table-bordered">
         <tr>
          <td><b>预览</b></td>
        </tr>
        <tr>
          <td>
          	<!--
          	<div  style="text-align: center;"><input type='hidden' name='slide_pic' id='thumb' value='<?php echo ($slide_pic); ?>'>
			<a href='javascript:void(0);' onclick="flashupload('thumb_images', '附件上传','thumb',thumb_images,'1,jpg|jpeg|gif|png|bmp,1,,,1','','','');return false;">
				<?php if(empty($slide_pic)): ?><img src="/thinkcmfx/statics/images/icon/upload-pic.png" id='thumb_preview' width='135' height='113' style='cursor:hand' />
				<?php else: ?>
					<img src="<?php echo sp_get_asset_upload_path($slide_pic);?>" id='thumb_preview' width='135' height='113' style='cursor:hand;height:113px;' /><?php endif; ?>
				
			</a>
            <input type="button"  class="btn" onclick="$('#thumb_preview').attr('src','/thinkcmfx/statics/images/icon/upload-pic.png');$('#thumb').val('');return false;" value="取消图片">
            </div>
        	-->
        	<input type="hidden" name="ORG_ID" value="<?php echo ($orgid); ?>"/>
        	<input type="hidden" name="slide_id" value="<?php echo ($slide_id); ?>"/>
        	<input type='hidden' name='slide_pic' id='slide_pic'value="<?php echo ($slide_pic); ?>">
        	<div id="imgPreview" >
        	<img src="<?php echo sp_get_asset_upload_path($slide_pic);?>" id='img_preview' />
        	</div>	
			</td>
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
              	<select name="slide_cid" class="normal_select">
                 <!-- <option value="0">默认分类</option>-->
                  <?php if(is_array($categorys)): foreach($categorys as $key=>$vo): $cid_selected=$slide_cid==$vo['cid']?"selected":""; ?>
                  	<option value="<?php echo ($vo["cid"]); ?>" <?php echo ($cid_selected); ?>><?php echo ($vo["cat_name"]); ?></option><?php endforeach; endif; ?>
                </select>
              </td>
            </tr>
            <tr>
              <th >上传图片</th>
              <td>
              <!--
              	<input type="text" style="width:400px;" name="slide_name" id="title" value="" style="color:" class="input input_hd J_title_color" placeholder="请输入幻灯片名称" onkeyup="strlen_verify(this, 'title_len', 160)" />
              	<span class="must_red">*</span>
              -->
				<div class="btn"> 
     			<span>添加图片</span> 		
   				<input id="fileupload" type="file" name="picload" onchange='PreviewImage(this)'>
				</div>
				<label style="float:right;margin-right:200px;margin-top:5px;font-size:16px">请上传高清图片，为了达到最佳显示效果，您的图片尺寸比例应该为5:2</label> 
            	</td>
            </tr>
            <tr>
              <th width="80">图片名称:</th>
              <td>
              	<input type="text" style="width:400px;" name="slide_name" id="title" value="<?php echo ($slide_name); ?>"  style="color:" class="input input_hd J_title_color" placeholder="请输入图片片名称" onkeyup="strlen_verify(this, 'title_len', 160)" />
              	<span class="must_red">*</span>
              </td>
            </tr>
            <!--
			<tr>
              <th width="80">幻灯片名称</th>
              <td>
              	<input type="text" style="width:400px;" name="slide_name" id="title" value="<?php echo ($slide_name); ?>" style="color:" class="input input_hd J_title_color" placeholder="请输入幻灯片名称" onkeyup="strlen_verify(this, 'title_len', 160)" />
              	<span class="must_red">*</span>
              	<input type="hidden" name="slide_id" value="<?php echo ($slide_id); ?>"/>
              </td>
            </tr>
                         <tr>
              <th width="80">链接地址：</th>
              <td>
              <input type='text' name='slide_url'  value='<?php echo ($slide_url); ?>' style='width:400px' class='input  input_hd J_title_color'>
              </td>
            </tr>
            <tr>
              <th width="80">描述</th>
              <td><input type='text' name='slide_des'  value='<?php echo ($slide_des); ?>' style='width:400px' class='input  input_hd J_title_color'></td>
            </tr>-->
             <tr>
              <th width="80">图片描述</th>
              <td>
              	<textarea name='slide_content' id='description' style='width:98%;height:200px;'><?php echo ($slide_content); ?></textarea>
              </td>
            </tr>
            
                        
        </tbody>
      </table>
    </div>
  </div>
  <div class="form-actions">
           <input class="btn btn-primary btn_submit J_ajax_submit_btn" id="subutton" type="submit" value="修改">
      		<a class="btn" href="<?php echo U('slide/index',array('orgid'=>$orgid));?>">返回</a>
      </div>
 </form>
</div>
<script type="text/javascript" src="/thinkcmfx/statics/js/common.js"></script>
<script type="text/javascript" src="/thinkcmfx/statics/js/content_addtop.js"></script>
<script type="text/javascript"> 

function PreviewImage(imgFile)
{
     var filextension=imgFile.value.substring(imgFile.value.lastIndexOf("."),imgFile.value.length);
     filextension=filextension.toLowerCase();
     if ((filextension!='.jpg')&&(filextension!='.gif')&&(filextension!='.jpeg')&&(filextension!='.png')&&(filextension!='.bmp'))
     {
         alert("对不起，系统仅支持标准格式的照片，请您调整格式后重新上传，谢谢 !");
         imgFile.focus();
     }
     else
     {
         var path;
         if(document.all)//IE
         {
             imgFile.select();
             path = document.selection.createRange().text;
             document.getElementById("imgPreview").innerHTML="";
             document.getElementById("imgPreview").style.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(enabled='true',sizingMethod='scale',src=\"" + path + "\")";//使用滤镜效果 
            //  alert(path);     
         }
         else//FF
         {
         	 document.getElementById("imgPreview").innerHTML="";
             path=window.URL.createObjectURL(imgFile.files[0]);// FF 7.0以上
             //path = imgFile.files[0].getAsDataURL();// FF 3.0
             document.getElementById("slide_pic").value=path;
             document.getElementById("imgPreview").innerHTML = "<img id='img_preview'  src='"+path+"'/>";
            	// alert(path); 
             //document.getElementById("img1").src = path;
         }
     }
}

$(function () {
	//setInterval(function(){public_lock_renewal();}, 10000);
	$(".J_ajax_close_btn").on('click', function (e) {
	    e.preventDefault();
	    Wind.use("artDialog", function () {
	        art.dialog({
	            id: "question",
	            icon: "question",
	            fixed: true,
	            lock: true,
	            background: "#CCCCCC",
	            opacity: 0,
	            content: "您确定需要关闭当前页面嘛？",
	            ok:function(){
					setCookie("refersh_time",1);
					window.close();
					return true;
				}
	        });
	    });
	});
	/////---------------------
	 Wind.use('validate', 'ajaxForm', 'artDialog', function () {
			//javascript
	        
	        var form = $('form.J_ajaxForms');
	        //ie处理placeholder提交问题
	        if ($.browser.msie) {
	            form.find('[placeholder]').each(function () {
	                var input = $(this);
	                if (input.val() == input.attr('placeholder')) {
	                    input.val('');
	                }
	            });
	        }
	        //表单验证开始
	        form.validate({
				//是否在获取焦点时验证
				onfocusout:false,
				//是否在敲击键盘时验证
				onkeyup:false,
				//当鼠标掉级时验证
				onclick: false,
	            //验证错误
	            showErrors: function (errorMap, errorArr) {
					//errorMap {'name':'错误信息'}
					//errorArr [{'message':'错误信息',element:({})}]
					try{
						$(errorArr[0].element).focus();
						art.dialog({
							id:'error',
							icon: 'error',
							lock: true,
							fixed: true,
							background:"#CCCCCC",
							opacity:0,
							content: errorArr[0].message,
							cancelVal: '确定',
							cancel: function(){
								$(errorArr[0].element).focus();
							}
						});
					}catch(err){
					}
	            },
	            //验证规则
	            rules: {'slide_name':{required:1}},
	            //验证未通过提示消息
	            messages: {'slide_name':{required:'请输入名称'}},
	            //给未通过验证的元素加效果,闪烁等
	            highlight: false,
	            //是否在获取焦点时验证
	            onfocusout: false,
	            //验证通过，提交表单
	            submitHandler: function (forms) {
	                $(forms).ajaxSubmit({
	                    url: form.attr('action'), //按钮上是否自定义提交地址(多按钮情况)
	                    dataType: 'json',
	                    beforeSubmit: function (arr, $form, options) {

						var btn = document.getElementById("subutton");
						
						btn.disabled = true;//上传过程中禁用提交按钮，避免多次提交
						btn.value="上传中……";
	                    },
	                    success: function (data, statusText, xhr, $form) {
	                        if(data.status){
								setCookie("refersh_time",1);
								//添加成功
								var btn = document.getElementById("subutton");
					
								btn.disabled = false;
								btn.value="修改成功";
								Wind.use("artDialog", function () {
								    art.dialog({
								        id: "succeed",
								        icon: "succeed",
								        fixed: true,
								        lock: true,
								        background: "#CCCCCC",
								        opacity: 0,
								        content: data.info,
										button:[
											{
												name: '继续编辑？',
												callback:function(){
													reloadPage(window);
													return true;
												},
												focus: true
											},{
												name: '返回列表',
												callback:function(){
													location.href="<?php echo U('slide/index',array('orgid'=>$orgid));?>";
													return true;
												}
											}
										]
								    });
								});
							}else{
								isalert(data.info);
							}
	                    }
	                });
	            }
	        });
	    });
	////-------------------------
});
</script>
</body>
</html>