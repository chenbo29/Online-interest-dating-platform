<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
<title>jquery带登录注册幻灯片代码 - 站长素材</title>
<meta charset="utf-8">
<link href="/thinkcmfx/tpl/test/Public/css/stcss/home.css?v=2" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/thinkcmfx/tpl/test/Public/js/stjs/jquery-1.7.2.js"></script>
</head>

<body>

<div class="wrap">
	<div class="banner-show" id="js_ban_content">
		<div class="cell bns-01">
			<div class="con">
			</div>
		</div>
		<div class="cell bns-02" style="display:none;">
			<div class="con">
				<a href="http://sc.chinaz.com" target="_blank" class="banner-link">
				<i>圈子</i></a> </div>
		</div>
		<div class="cell bns-03" style="display:none;">
			<div class="con">
				<a href="http://sc.chinaz.com" target="_blank" class="banner-link">
				<i>企业云</i></a> </div>
		</div>
	</div>
	<div class="banner-control" id="js_ban_button_box">
		<a href="javascript:;" class="left">左</a>
		<a href="javascript:;" class="right">右</a> </div>
	<script type="text/javascript">

                ;(function(){
                    
                    var defaultInd = 0;
                    var list = $('#js_ban_content').children();
                    var count = 0;
                    var change = function(newInd, callback){
                        if(count) return;
                        count = 2;
                        $(list[defaultInd]).fadeOut(400, function(){
                            count--;
                            if(count <= 0){
                                if(start.timer) window.clearTimeout(start.timer);
                                callback && callback();
                            }
                        });
                        $(list[newInd]).fadeIn(400, function(){
                            defaultInd = newInd;
                            count--;
                            if(count <= 0){
                                if(start.timer) window.clearTimeout(start.timer);
                                callback && callback();
                            }
                        });
                    }
                    
                    var next = function(callback){
                        var newInd = defaultInd + 1;
                        if(newInd >= list.length){
                            newInd = 0;
                        }
                        change(newInd, callback);
                    }
                    
                    var start = function(){
                        if(start.timer) window.clearTimeout(start.timer);
                        start.timer = window.setTimeout(function(){
                            next(function(){
                                start();
                            });
                        }, 8000);
                    }
                    
                    start();
                    
                    $('#js_ban_button_box').on('click', 'a', function(){
                        var btn = $(this);
                        if(btn.hasClass('right')){
                            //next
                            next(function(){
                                start();
                            });
                        }
                        else{
                            //prev
                            var newInd = defaultInd - 1;
                            if(newInd < 0){
                                newInd = list.length - 1;
                            }
                            change(newInd, function(){
                                start();
                            });
                        }
                        return false;
                    });
                    
                })();
            </script>
	<div class="container">
		<div class="register-box">
			<div class="reg-slogan">
				用户登录
            </div>
			<div class="reg-form" id="js-form-mobile">
				<br>
				<br>
				<div class="cell">
				<form class="form-horizontal J_ajaxForms" action="<?php echo U('user/login/dologin');?>" method="post">
					
					<input type="text" name="username" id="js-mobile_ipt" class="text" maxlength="11" placeholder="请输入用户名或者邮箱" />
				</div>
				<div class="cell">
					<input type="password" name="password" id="js-mobile_pwd_ipt" class="text" placeholder="请输入密码"/>
					<input type="text" name="passwd" id="js-mobile_pwd_ipt_txt" class="text" maxlength="20" style="display:none;" />
				</div>
			
				<div class="cell vcode">
					<input type="text" id="input_verify" name="verify"  class="span3" placeholder="请输入验证码">
							<?php echo sp_verifycode_img('length=4&font_size=15&width=120&height=35&charset=1234567890');?> </div>
				<div class="bottom">
					<button id="js-mobile_btn" href="javascript:;" class="button btn-green" type="submit">
					登录</button></div>
				<div class="bottom">
					<button id="js-mobile_btn" href="javascript:;" class="button btn-blue">
					注册</button></div>
				</form>
			</div>
		</div>
        
	</div>
</div>
<div class="footer">
	<div class="con">
		<div class="copy-right">
			<div class="cell">
				<div style="text-align:center;margin:50px 0; font:normal 14px/24px 'MicroSoft YaHei';">
					<p>留作社团推荐图片</p>
					<p><a href="http://baidu.com/" target="_blank">留作社团推荐图片</a></p>
				</div>
			</div>
		</div>
	</div>
</div>

</body>

</html>