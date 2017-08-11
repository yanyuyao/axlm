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
<!--用户列表部分-->
<table cellpadding="3" cellspacing="1">
  <tr>
    <th>ID</th>
    <th>UserID</th>
    <th>分佣比例</th>
    <th>分佣金额</th>
    <th>订单</th>
    <th>订单金额</th>
    <th>下单人</th>
    <th>状态</th> 
    <th>时间</th> 
    <!--<th>操作</th>-->
  <tr>
  <?php $_from = $this->_var['logdb']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'd');if (count($_from)):
    foreach ($_from AS $this->_var['d']):
?>
  <tr>
    <td><?php echo $this->_var['d']['id']; ?></td>
    <td><?php echo $this->_var['d']['expend_user_id']; ?></td>
    <td><?php echo $this->_var['d']['expend_bili']; ?></td>
    <td><?php echo $this->_var['d']['expend_amount']; ?></td>
    <td><?php echo $this->_var['d']['order_id']; ?><?php echo $this->_var['d']['order_sn']; ?></td>
    <td><?php echo $this->_var['d']['order_amount']; ?></td>
    <td><?php echo $this->_var['d']['user_id']; ?></td>
    <td><?php echo $this->_var['d']['status_format']; ?></td>
    <td><?php echo $this->_var['d']['ctime']; ?></td>
	<!-- <?php if ($this->_var['d']['status'] == '0'): ?>-->
	<!--
    <td align="center">
      <a href="fenxiao_list.php?act=push_expend_user&id=<?php echo $this->_var['d']['id']; ?>" title="<?php echo $this->_var['lang']['edit']; ?>" class="btn-orange">确定</a>
      <a href="javascript:confirm_redirect('取消此分佣?', 'fenxiao_list.php?act=cancel_expend_user&id=<?php echo $this->_var['d']['id']; ?>')" title="取消分佣" class="btn-red">取消</a>
    </td>
	-->
	<!-- <?php endif; ?>--> 
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