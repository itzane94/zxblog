$(document).ready(function() {
	$(".btn-submit").click(function(){
		login();
	});
	$('#form_login').keydown(function(event){
        if (event.keyCode == 13) {
            $('.btn-submit').click();
        }
    });
});
function login(){
	if($('#admin_name').val() == ''){
        layer.msg('账号不能为空');
        $('#admin_name').focus();
        return false;
    }
    if($('#admin_password').val() == ''){
        layer.msg('密码不能为空');
        $('#admin_password').focus();
        return false;
    }

    if($('#captcha').val() == ''){
        layer.msg('验证码不能为空');
        $('#captcha').focus();
        return false;
    }
    $.post(loginHandleUrl,{'name':$('#admin_name').val(), 'password':$('#admin_password').val(),'captcha': $('#captcha').val(),'_token':_token},function(data){
    	if(data.status != 200){
            verifyimage();
            if(data.name){
                layer.msg('用户名不正确');
                return;
            }else if(data.password){
                layer.msg('密码不正确');
                return;
            }else if(data.captcha){
                layer.msg('验证码不正确');
                return;
            }else{
            	layer.msg('用户名或密码错误');
            	return;
			}
		}
    	else{
			setTimeout(function(){
				$('.input-username,dot-left').addClass('animated fadeOutRight')
			    $('.input-password-box,dot-right').addClass('animated fadeOutLeft')
			    $('.btn-submit').addClass('animated fadeOutUp')
			    setTimeout(function () {
			        $('.avatar').addClass('avatar-top');
			        $('.submit').hide();
			        $('.submit2').html('<div class="progress"><div class="progress-bar progress-bar-success" aria-valuetransitiongoal="100"></div></div>');
			        layer.msg('登录成功');
			        $('.progress .progress-bar').progressbar({done : function() {
			            location.href = homeUrl;
			        }}); 
			    },300);
			},300)
			
		}
	},'json')

    
	
}