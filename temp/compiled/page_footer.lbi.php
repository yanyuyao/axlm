

	<div class="footer">
		<div class="footer-icons">
			<ul>
				<li><a href="#" class="g"></a></li>
				<li><a href="#" class="in"></a></li>
				<li><a href="#" class="twitter"></a></li>
				<li><a href="#" class="u-tube"></a></li>
				<li><a href="#" class="be"></a></li>
				<li><a href="#" class="facebook"></a></li>
			</ul>
		</div>
		<div class="container"> 
			<div class="footer-info">
				<div class="footer-info-left">
					<p><a href="javascript:;"><?php echo $this->_var['copyright']; ?></a> <a href="javascript:;"><?php echo $this->_var['shop_address']; ?> <?php echo $this->_var['shop_postcode']; ?></a></p>
				</div>
				<div class="footer-info-right">
                    
					<p class="nav_bottom">
						<ul>
						<?php if ($this->_var['navigator_list']['bottom']): ?>
						<?php $_from = $this->_var['navigator_list']['bottom']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'nav');$this->_foreach['nav_bottom_list'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['nav_bottom_list']['total'] > 0):
    foreach ($_from AS $this->_var['nav']):
        $this->_foreach['nav_bottom_list']['iteration']++;
?>
						<li>
						<a href="<?php echo $this->_var['nav']['url']; ?>" <?php if ($this->_var['nav']['opennew'] == 1): ?>target="_blank"<?php endif; ?>><?php echo $this->_var['nav']['name']; ?></a>
						<em <?php if (($this->_foreach['nav_bottom_list']['iteration'] == $this->_foreach['nav_bottom_list']['total'])): ?>style="display:none"<?php endif; ?>></em>
						</li>
						<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
						<?php endif; ?>
						</ul>
					</p>
				</div>
				<div class="clearfix"> </div>
				<p>
					 <a href="javascript:;" style="color:#fff;"><?php if ($this->_var['service_phone']): ?>
					  Tel: <?php echo $this->_var['service_phone']; ?>
					  <?php endif; ?></a>
					 <a href="javascript:;" style="color:#fff;"><?php if ($this->_var['service_email']): ?>
					  E-mail: <?php echo $this->_var['service_email']; ?>
					  <?php endif; ?></a>
				 </p>
				<p>
					  <?php if ($this->_var['stats_code']): ?>
					  <?php echo $this->_var['stats_code']; ?>
					  <?php endif; ?>
					  <?php $_from = $this->_var['qq']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'im');if (count($_from)):
    foreach ($_from AS $this->_var['im']):
?>
					  <?php if ($this->_var['im']): ?>
					  <a href="http://wpa.qq.com/msgrd?V=1&amp;uin=<?php echo $this->_var['im']; ?>&amp;Site=<?php echo $this->_var['shop_name']; ?>&amp;Menu=yes" target="_blank" style="color:#fff;"><img src="http://wpa.qq.com/pa?p=1:<?php echo $this->_var['im']; ?>:4" height="16" border="0" alt="QQ" style="color:#fff;"/> <?php echo $this->_var['im']; ?></a>
					  <?php endif; ?>
					  <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
					  <?php $_from = $this->_var['ww']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'im');if (count($_from)):
    foreach ($_from AS $this->_var['im']):
?>
					  <?php if ($this->_var['im']): ?>
					  <a href="http://amos1.taobao.com/msg.ww?v=2&uid=<?php echo urlencode($this->_var['im']); ?>&s=2" target="_blank" style="color:#fff;"><img src="http://amos1.taobao.com/online.ww?v=2&uid=<?php echo urlencode($this->_var['im']); ?>&s=2" width="16" height="16" border="0" style="color:#fff;" alt="淘宝旺旺" /><?php echo $this->_var['im']; ?></a>
					  <?php endif; ?>
					  <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
					  <?php $_from = $this->_var['ym']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'im');if (count($_from)):
    foreach ($_from AS $this->_var['im']):
?>
					  <?php if ($this->_var['im']): ?>
					  <a href="http://edit.yahoo.com/config/send_webmesg?.target=<?php echo $this->_var['im']; ?>n&.src=pg" target="_blank" style="color:#fff;"><img src="themes/axlmpc/images/yahoo.gif" width="18" height="17" border="0" alt="Yahoo Messenger"  style="color:#fff;" /> <?php echo $this->_var['im']; ?></a>
					  <?php endif; ?>
					  <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
					  <?php $_from = $this->_var['msn']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'im');if (count($_from)):
    foreach ($_from AS $this->_var['im']):
?>
					  <?php if ($this->_var['im']): ?>
					  <img src="themes/axlmpc/images/msn.gif" width="18" height="17" border="0" alt="MSN" /> <a href="msnim:chat?contact=<?php echo $this->_var['im']; ?>"><?php echo $this->_var['im']; ?></a>
					  <?php endif; ?>
					  <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
					  <?php $_from = $this->_var['skype']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'im');if (count($_from)):
    foreach ($_from AS $this->_var['im']):
?>
					  <?php if ($this->_var['im']): ?>
					  <img src="http://mystatus.skype.com/smallclassic/<?php echo urlencode($this->_var['im']); ?>" alt="Skype" width="18"/><a href="skype:<?php echo urlencode($this->_var['im']); ?>?call"><?php echo $this->_var['im']; ?></a>
					  <?php endif; ?>
					  <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
				</p>
		
			</div>
		</div>
	</div>


  
<img src="api/cron.php?t=" alt="" style="width:0px;height:0px;display:none;" />

<script type="text/javascript">
Ajax.call('api/okgoods.php', '', '', 'GET', 'JSON');
//预售
Ajax.call('pre_sale.php?act=check_order', '', '', 'GET', 'JSON');
</script>
<script type="text/javascript" src="themes/68ecshopcom_360buy/js/base.js" ></script>
