<!-- <?php if ($this->_var['full_page']): ?> -->
<?php echo $this->fetch('pageheader.htm'); ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'../js/utils.js,listtable.js')); ?>


<div class="list-div" id="listDiv" style="margin-bottom:30px;">
<!-- <?php if ($this->_var['list']): ?>-->
<table>
	<tr>
		<th><?php echo $this->_var['title_id']; ?></th>
		<th><?php echo $this->_var['title_money']; ?></th>
	</tr>
	<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'd');if (count($_from)):
    foreach ($_from AS $this->_var['d']):
?>
	<tr>
		<td><?php echo $this->_var['d']['id']; ?></td>
		<td><?php echo $this->_var['d']['money']; ?></td>
	</tr>
  <?php endforeach; else: ?>
  <tr><td class="no-records" colspan="10"><?php echo $this->_var['lang']['no_records']; ?></td></tr>
  <?php endif; unset($_from); ?><?php $this->pop_vars();; ?>
</table>
<div style="margin-top:10px;padding:10px;background:#eee;"><?php echo $this->_var['tongji']; ?></div>
<!-- <?php else: ?> -->
目前没有交易记录
<!-- <?php endif; ?>-->
</div>

<?php echo $this->fetch('pagefooter.htm'); ?>
<!-- <?php endif; ?> -->