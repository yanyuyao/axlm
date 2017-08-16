<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<base href="http://www.axlm-dev.com/" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="Keywords" content="<?php echo $this->_var['keywords']; ?>" />
<meta name="Description" content="<?php echo $this->_var['description']; ?>" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />

<title><?php echo $this->_var['page_title']; ?></title>



<link rel="shortcut icon" href="favicon.ico" />
<link rel="icon" href="animated_favicon.gif" type="image/gif" />
<link rel="stylesheet" type="text/css" href="themes/68ecshopcom_360buy/css/68ecshop_common.css" />
<link type="text/css" rel="stylesheet" href="themes/68ecshopcom_360buy/css/passport.css?v=de"/>
<script type="text/javascript" src="themes/68ecshopcom_360buy/js/jquery-1.9.1.min.js" ></script>
<script type="text/javascript" src="themes/68ecshopcom_360buy/js/jquery_email.js"></script>
<script type="text/javascript" src="themes/68ecshopcom_360buy/js/placeholder.js" ></script>
<?php echo $this->smarty_insert_scripts(array('files'=>'jquery.json.js,transport.js')); ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'common.js,user.js')); ?>
<link type="text/css" rel="stylesheet" href="themes/axlmpc/axlm/css/short.css" />
</head>
<body onclick="ecshop68_onclick();">
<script>
function erweima1(obj, sType) { var oDiv = document.getElementById(obj); if (sType == 'show') {oDiv.style.display = 'block';} if (sType == 'hide') {oDiv.style.display = 'none';} }
</script>
<?php echo $this->fetch('library/page_header_short.lbi'); ?>
<div class="w"> 
   
  <?php if ($this->_var['action'] == 'login'): ?>
  <div class="login-wrap" id="entry">
  	<div class="login-banner" style="background:url('themes/axlmpc/axlm/images/banner-bg.jpg');">
    	<div class="w990 position-relative">
        	
            <div class="login-form">
            <form name="formLogin" action="user.php?XDEBUG_SESSION_START=ECLIPSE_DBGP" method="post" onSubmit="return user_login(1)">
              <div class="login-tit">用户登录<a class="regist-link main-color" href="register.php">立即注册 <i>&gt;</i></a></div>
              <div class="form">
                <div class="msg-wrap">
                    <div class="msg-error">
                        <i class="msg-icon"></i><span id="msg-error-text" class="msg-error-text"></span>
                    </div>
                </div>
                <div class="item item-name">
                	<i class="icon"></i>
                  	<input type="text" id="username" name="username" class="text" tabindex="1" placeholder="手机号/用户名/邮箱"/>
                </div>
                <div class="item item-password">
                	<i class="icon"></i>
                	<input type="password" id="password" name="password" class="text" tabindex="2" placeholder="密码"/>
                </div>
                <?php if ($this->_var['enabled_captcha']): ?>
                <div class="item item-authcode clearfix" id="o-authcode">
                	<div class="item-detail fl">
                    	<i class="icon"></i>
                        <input type="text" id="authcode" name="captcha" class="text text-1" tabindex="3"/>
                    </div>
                    <label class="img fl"> <img src="captcha.php?is_login=1&<?php echo $this->_var['rand']; ?>" alt="captcha" style="vertical-align: middle;cursor: pointer;" onClick="this.src='captcha.php?is_login=1&'+Math.random()" /> </label>
                </div>
                <?php endif; ?>
                <div class="safety" id="autoentry">
                    <label for="remember" class="mar-b"><input type="checkbox" value="1" name="remember" id="remember" class="checkbox"/><?php echo $this->_var['lang']['remember']; ?></label>
                    <a class="forget_password fr" href="findPwd.php">忘记密码？</a>
                </div>
                <div class="login-btn">
                  <input type="hidden" name="act" value="act_login" />
                  <input type="hidden" name="back_act" value="<?php echo $this->_var['back_act']; ?>" />
                  <input type="submit" name="submit" class="btn-img btn-entry" id="loginsubmit" value="立即登录" />
                </div>
				<!--
                <div class="item-coagent">
                    <a href="user.php?act=oath&type=weixin"><i class="weixin"></i>微信</a>
                    <a href="user.php?act=oath&type=qq"><i class="qq"></i>QQ</a>
                    <a href="user.php?act=oath&type=weibo"><i class="sina"></i>新浪</a>
                    <a href="user.php?act=oath&type=alipay" class="last"><i class="alipay"></i>支付宝</a>
                </div>
				-->
              </div>
            </form>
        </div>
        </div>
    </div>
  </div>
  <?php endif; ?> 
   


</div>

<div class="site-footer">
    <div class="footer-related">
                <?php echo $this->fetch('library/page_footer.lbi'); ?>
  </div>
</div>
</body>
<script type="text/javascript">
var process_request = "<?php echo $this->_var['lang']['process_request']; ?>";
<?php $_from = $this->_var['lang']['passport_js']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
var <?php echo $this->_var['key']; ?> = "<?php echo $this->_var['item']; ?>";
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
var username_exist = "<?php echo $this->_var['lang']['username_exist']; ?>";

$(".mcon").height($(".uc_box").height());
</script>
</html>
