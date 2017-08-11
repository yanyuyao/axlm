<?php
	$GLOBALS['smarty']->assign('categories', get_categories_tree(0)); // 分类树
?>
<div class="aside-con category">
	<h2 class="aside-tit">全部分类</h2>
	<?php $_from = $this->_var['categories']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'cat_0_37774800_1496534985');$this->_foreach['cat'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['cat']['total'] > 0):
    foreach ($_from AS $this->_var['cat_0_37774800_1496534985']):
        $this->_foreach['cat']['iteration']++;
?>
    <div class="item <?php if ($this->_var['cat_0_37774800_1496534985']['id'] == $this->_var['category']): ?>curr<?php endif; ?> <?php if (($this->_foreach['cat']['iteration'] == $this->_foreach['cat']['total'])): ?>last<?php endif; ?>">
      <h3 <?php if (($this->_foreach['cat']['iteration'] == $this->_foreach['cat']['total'])): ?>class="last"<?php endif; ?>><a href="<?php echo $this->_var['cat_0_37774800_1496534985']['url']; ?>"><?php echo htmlspecialchars($this->_var['cat_0_37774800_1496534985']['name']); ?></a><i></i></h3>
      <ul <?php if (($this->_foreach['cat']['iteration'] == $this->_foreach['cat']['total'])): ?>class="last"<?php endif; ?> style="<?php if ($this->_var['cat_0_37774800_1496534985']['id'] == $this->_var['category']): ?>display:block;<?php endif; ?>">
        <?php $_from = $this->_var['cat_0_37774800_1496534985']['cat_id']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'child_0_37809900_1496534985');if (count($_from)):
    foreach ($_from AS $this->_var['child_0_37809900_1496534985']):
?>
        <li <?php if (($this->_foreach['child']['iteration'] == $this->_foreach['child']['total'])): ?>class="last"<?php endif; ?>><a href="<?php echo $this->_var['child_0_37809900_1496534985']['url']; ?>"><?php echo htmlspecialchars($this->_var['child_0_37809900_1496534985']['name']); ?></a></li>
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
      </ul>
    </div>
    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?> 
</div>
<script type="text/javascript">
$(function(){
	if($('.category .item.curr').length == 0){
		$('.category .item').eq(0).addClass('curr').find('ul').show();
	}
	$('.category .item h3').click(function(){
		$(this).parents('.item').toggleClass('curr').find('ul').slideToggle();
		$(this).parents('.item').siblings('.item').removeClass('curr').find('ul').slideUp();
	})
})
</script>