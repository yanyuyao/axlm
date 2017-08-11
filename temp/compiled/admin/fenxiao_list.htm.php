<!-- <?php if ($this->_var['full_page']): ?> -->
<!-- $Id: users_list.htm 15617 2009-02-18 05:18:00Z sunxiaodong $ -->
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
    <th>用户名</th>
    <th>是否符合推广条件</th>
    <th>分红等级</th> 
    <th>直推人数</th>
    <th>推广码</th>
    <th>资金</th>
    <th>佣金总金额</th>
    <th>分红总金额</th>
    <th>操作</th>
  <tr>
  <?php $_from = $this->_var['logdb']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'd');if (count($_from)):
    foreach ($_from AS $this->_var['d']):
?>
  <tr>
    <td><?php echo $this->_var['d']['id']; ?></td>
    <td><?php echo $this->_var['d']['user_id']; ?></td>
    <td class="first-cell"><?php echo $this->_var['d']['user_name']; ?></td>
    <td class="first-cell"><?php echo $this->_var['d']['is_valid_user']; ?></td>
    <td class="first-cell"><?php echo $this->_var['d']['bonus_proportional']; ?></td>
    <td><?php echo $this->_var['d']['expend_user_amount']; ?></td>
    <td><?php echo $this->_var['d']['expend_code']; ?></td>
    <td><?php echo $this->_var['d']['user_money']; ?></td>
    <td><?php echo $this->_var['d']['expend_amount']; ?></td>
    <td><?php echo $this->_var['d']['bonus_amount']; ?></td>
   
    <td align="center">
      <a href="fenxiao_list.php?act=detail&id=<?php echo $this->_var['d']['id']; ?>" title="<?php echo $this->_var['lang']['view_order']; ?>"><img src="images/icon_view.gif" border="0" height="16" width="16" /></a>
	  
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