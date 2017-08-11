<?php if ($this->_var['user_info']): ?>
<a class="sn-login main-color" href="user.php" target="_top"><?php echo $this->_var['user_info']['username']; ?></a><em><?php echo $this->_var['lang']['welcome_return']; ?>！</em>
<a class="sn-register" href="user.php?act=logout" target="_top"><?php echo $this->_var['lang']['user_logout']; ?></a> 
<?php else: ?> 
<em><?php echo $this->_var['lang']['welcome']; ?>!</em>
<a class="sn-login main-color" href="user.php" target="_top">请登录</a>
<a class="sn-register" href="register.php" target="_top">免费注册</a> 
<a class="sn-register" href="mobile/login.php" target="_top">微信登陆</a>
<?php endif; ?>