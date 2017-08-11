<!-- <?php if ($this->_var['full_page']): ?> -->
<?php echo $this->fetch('pageheader.htm'); ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'../js/utils.js,listtable.js')); ?>

<div class="form-div">
<?php echo $this->_var['lang']['page_note']; ?><?php echo $this->_var['lang']['total_records']; ?><?php echo $this->_var['record_count']; ?><?php echo $this->_var['lang']['how_many_user']; ?>
</div>

<form method="POST" action="" name="listForm">

<!-- start users list -->
<div class="list-div" id="listDiv">
<!-- <?php endif; ?> -->
<!--分红列表部分-->
<table cellpadding="3" cellspacing="1">
  <tr>
    <th>ID</th>
    <th>收银员</th>
    <th>会员卡</th>
    <th>消费金额</th>
    <th>时间</th>
    <th>操作</th>
  <tr>
  <?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'd');if (count($_from)):
    foreach ($_from AS $this->_var['d']):
?>
  <tr>
    <td><?php echo $this->_var['d']['id']; ?></td>
    <td><?php echo $this->_var['d']['shouyinyuan']; ?></td>
    <td><?php echo $this->_var['d']['huiyuanka']; ?></td>
    <td><?php echo $this->_var['d']['money']; ?></td>
    <td><?php echo $this->_var['d']['ctime']; ?></td>
    <td>
		<?php if ($this->_var['d']['exec'] == 1): ?>
		<a href="trade_cash_list.php?act=del&id=<?php echo $this->_var['d']['id']; ?>">删除</a>
		<?php endif; ?>
	</td>
  </tr>
  <?php endforeach; else: ?>
  <tr><td class="no-records" colspan="10"><?php echo $this->_var['lang']['no_records']; ?></td></tr>
  <?php endif; unset($_from); ?><?php $this->pop_vars();; ?>
</table>
 <table cellpadding="4" cellspacing="0">
    <tr>
      <td align="right"><?php echo $this->fetch('page.htm'); ?></td>
    </tr>
  </table>
  <!-- <?php if ($this->_var['full_page']): ?> -->
</div>
</form>
<script type="Text/Javascript" language="JavaScript">
listTable.recordCount = <?php echo $this->_var['record_count']; ?>;
listTable.pageCount = <?php echo $this->_var['page_count']; ?>;

<?php $_from = $this->_var['filter']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
listTable.filter.<?php echo $this->_var['key']; ?> = '<?php echo $this->_var['item']; ?>';
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>

<!--  -->
onload = function()
{
  // 开始检查订单
  startCheckOrder();
}
<!--  -->
</script>
<?php echo $this->fetch('pagefooter.htm'); ?>
<!-- <?php endif; ?> -->