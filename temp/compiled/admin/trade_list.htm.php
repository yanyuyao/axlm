<!-- <?php if ($this->_var['full_page']): ?> -->
<?php echo $this->fetch('pageheader.htm'); ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'../js/utils.js,listtable.js')); ?>


<div class="list-div" id="listDiv" style="margin-bottom:30px;">
<a class='btn-red' href="?act=day">今日交易额</a>
<?php if ($this->_var['is_finished'] == '0'): ?><a class='btn-orange' href="?act=daytrade">执行今日返现</a><?php endif; ?>
</div>


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
    <th>交易号</th>
    <th>交易总额</th>
    <th>应返现总额</th>
    <th>返现比例</th>
    <th>实际返现总额</th>
	<!--
	<th>订单交易额</th> 
    <th>订单数</th> 
    <th>现金交易额</th> 
    <th>现金交易数</th> 
	-->
    <th>返现用户人数</th>
    <th>人均返现金额</th> 
    <th>开始时间</th>
    <th>结束时间</th>
    <th>操作</th>
  <tr>
  <?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'd');if (count($_from)):
    foreach ($_from AS $this->_var['d']):
?>
  <tr>
    <td><?php echo $this->_var['d']['id']; ?></td>
    <td><?php echo $this->_var['d']['trade_sn']; ?></td>
    <td><?php echo $this->_var['d']['trade_amount']; ?></td>
    <td><?php echo $this->_var['d']['trade_fanxian_amount']; ?></td>
    <td><?php echo $this->_var['d']['trade_fanxian_bili']; ?></td>
    <td><?php echo $this->_var['d']['trade_fanxian_shiji_amount']; ?></td>
	<!--
    <td><?php echo $this->_var['d']['order_amount']; ?></td>
    <td><?php echo $this->_var['d']['order_nums']; ?></td>
    <td><?php echo $this->_var['d']['cash_amount']; ?></td>
    <td><?php echo $this->_var['d']['cash_nums']; ?></td>
	-->
    <td><?php echo $this->_var['d']['user_nums']; ?></td>
    <td><?php echo $this->_var['d']['user_money']; ?></td>
    <td><?php echo $this->_var['d']['stime']; ?></td>
    <td><?php echo $this->_var['d']['etime']; ?></td>
	<td><a class="btn-blue" href="?act=detail&id=<?php echo $this->_var['d']['id']; ?>">查看</td>
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