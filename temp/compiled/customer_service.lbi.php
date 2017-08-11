
<div class="customer-service customer-service-online">
    <a target="_self" href="<?php if ($_SESSION['user_id'] > 0): ?>javascript:chat_online();<?php else: ?>javascript:;<?php endif; ?>" alt="点击这里给我发消息" title="点击这里给我发消息"><span class="icon-online"></span>在线客服</a>
</div>
<?php $_from = $this->_var['customer']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'customer_0_57304200_1496534985');$this->_foreach['customer'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['customer']['total'] > 0):
    foreach ($_from AS $this->_var['customer_0_57304200_1496534985']):
        $this->_foreach['customer']['iteration']++;
?>
<?php if ($this->_var['customer_0_57304200_1496534985']['cus_type'] == 0): ?>
<div class="customer-service">
    <a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $this->_var['customer_0_57304200_1496534985']['cus_no']; ?>&site=qq&menu=yes" alt="点击这里给我发消息" title="点击这里给我发消息"><span class="icon-qq"></span><?php echo $this->_var['customer_0_57304200_1496534985']['cus_name']; ?></a>
</div>
<?php else: ?>
<div class="customer-service">
    <a target="_blank" href="http://amos1.taobao.com/msg.ww?v=2&uid=<?php echo $this->_var['customer_0_57304200_1496534985']['cus_no']; ?>&s=2" alt="点击这里给我发消息" title="点击这里给我发消息"><span class="icon-ww"></span><?php echo $this->_var['customer_0_57304200_1496534985']['cus_name']; ?></a>
</div>
<?php endif; ?>
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
