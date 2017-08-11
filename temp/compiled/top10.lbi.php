<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php if ($this->_var['top_goods']): ?>
<div class="aside-con">
	<h2 class="aside-tit">销量排行榜</h2>
    <ul class="aside-list">
		<?php $_from = $this->_var['top_goods']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');$this->_foreach['top_goods'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['top_goods']['total'] > 0):
    foreach ($_from AS $this->_var['goods']):
        $this->_foreach['top_goods']['iteration']++;
?>
		<li>
        	<div class="p-img">
            	<a target="_blank" title="<?php echo htmlspecialchars($this->_var['goods']['name']); ?>" href="<?php echo $this->_var['goods']['url']; ?>"><img alt="<?php echo htmlspecialchars($this->_var['goods']['goods_name']); ?>" data-original="<?php echo $this->_var['goods']['thumb']; ?>" src="themes/68ecshopcom_360buy/images/loading.gif" /></a> 
            </div>
            <div class="p-name">
                <a target="_blank" title="<?php echo htmlspecialchars($this->_var['goods']['name']); ?>" href="<?php echo $this->_var['goods']['url']; ?>"><?php echo $this->_var['goods']['goods_name']; ?></a>
            </div>
            <div class="p-price">
                <span class="sale-price main-color"><?php echo $this->_var['goods']['price']; ?></span>
                <span class="sale-num">销量: <?php echo $this->_var['goods']['count']; ?></span>
            </div>
      </li>
      <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
	</ul>
</div>
<?php endif; ?>