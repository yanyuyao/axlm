<h4>火爆兑换</h4>
<ul id="JS_spot_goods">
  <?php $_from = $this->_var['hot_goods']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');$this->_foreach['goods'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['goods']['total'] > 0):
    foreach ($_from AS $this->_var['goods']):
        $this->_foreach['goods']['iteration']++;
?>
  <li <?php if (($this->_foreach['goods']['iteration'] <= 1)): ?>class="open"<?php endif; ?>>
    <div class="show"> <span class="index"><?php echo $this->_foreach['goods']['iteration']; ?></span> <a href='<?php echo $this->_var['goods']['url']; ?>' target="_blank" title="<?php echo htmlspecialchars($this->_var['goods']['name']); ?>"><?php echo $this->_var['goods']['name']; ?></a> <span class="price red">积分：<?php echo $this->_var['goods']['exchange_integral']; ?></span> </div>
    <div class="hide">
      <div class="title"> <span class="index"><?php echo $this->_foreach['goods']['iteration']; ?></span> <a href='<?php echo $this->_var['goods']['url']; ?>' target="_blank" title="<?php echo htmlspecialchars($this->_var['goods']['name']); ?>"><?php echo $this->_var['goods']['name']; ?></a> </div>
      <div class="detail"> <a href='<?php echo $this->_var['goods']['url']; ?>' target="_blank" title="<?php echo htmlspecialchars($this->_var['goods']['name']); ?>" class="img"> <img src="<?php echo $this->_var['goods']['thumb']; ?>" width="122" height="122" alt="<?php echo htmlspecialchars($this->_var['goods']['name']); ?>"> </a>
        <div class="number">
          <p class="p1"><strong>积分：<?php echo $this->_var['goods']['exchange_integral']; ?></strong></p>
          <p class="p2"><a href='<?php echo $this->_var['goods']['url']; ?>' target="_blank">立即兑换</a></p>
        </div>
      </div>
    </div>
  </li>
  <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
</ul>
