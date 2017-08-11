<!-- <?php if ($this->_var['full_page']): ?> -->
<?php echo $this->fetch('pageheader.htm'); ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'../js/utils.js,listtable.js')); ?>


<div class="list-div" id="listDiv" style="margin-bottom:30px;">
<!-- <?php if ($this->_var['info']['trade_amount']): ?>-->
<table>
	<tr>
		<th style="padding-right:10px;text-align:right;">交易号</th>
		<td><?php echo $this->_var['info']['trade_sn']; ?></td>
	</tr>
	<tr>
		<th style="padding-right:10px;text-align:right;">统计时间</th>
		<td><?php echo $this->_var['info']['stime']; ?> - <?php echo $this->_var['info']['etime']; ?></td>
	</tr>
	<tr>
		<th style="padding-right:10px;text-align:right;">总交易额</th>
		<td><b style="color:red;"><?php echo $this->_var['info']['trade_amount']; ?></b></td>
	</tr>
	<tr>
		<th style="padding-right:10px;text-align:right;">在线订单交易额</th>
		<td><b><?php echo $this->_var['info']['order_amount']; ?></b> <span style="color:grey;">订单数：(<?php echo $this->_var['info']['order_nums']; ?>)</span><a href="?act=detail&t=order&id=<?php echo $this->_var['info']['id']; ?>&trade_sn=<?php echo $this->_var['info']['trade_sn']; ?>" style="margin-left:20px;color:orange;">查看统计订单</a></td>
	</tr>
	<tr>
		<th style="padding-right:10px;text-align:right;">线下交易额</th>
		<td><b><?php echo $this->_var['info']['cash_amount']; ?></b> <span style="color:grey;">线下交易数：(<?php echo $this->_var['info']['cash_nums']; ?>)</span><a href="?act=detail&t=cash&id=<?php echo $this->_var['info']['id']; ?>&trade_sn=<?php echo $this->_var['info']['trade_sn']; ?>" style="margin-left:20px;color:orange;">查看线下交易</a></td>
	</tr>
	<tr>
		<th style="padding-right:10px;text-align:right;">返现总金额</th>
		<td><b><?php echo $this->_var['info']['trade_fanxian_amount']; ?></b> <span style="color:grey;">返现比例：(<?php echo $this->_var['info']['trade_fanxian_bili']; ?>)</span></td>
	</tr>
	<tr>
		<th style="padding-right:10px;text-align:right;">实际返现总金额</th>
		<td><b style="color:red;"><?php echo $this->_var['info']['trade_fanxian_shiji_amount']; ?></b></td>
	</tr>
	<tr>
		<th style="padding-right:10px;text-align:right;">返现用户金额/人均</th>
		<td><b><?php echo $this->_var['info']['user_money']; ?></b> <span style="color:grey;">符合返现用户：(<?php echo $this->_var['info']['user_nums']; ?> 人) </span><a href="?act=detail&t=users&id=<?php echo $this->_var['info']['id']; ?>&trade_sn=<?php echo $this->_var['info']['trade_sn']; ?>" style="margin-left:20px;color:orange;">查看返现用户</a></td>
	</tr>
	
</table>
<!-- <?php else: ?> -->
目前没有现金交易
<!-- <?php endif; ?>-->
</div>

<?php echo $this->fetch('pagefooter.htm'); ?>
<!-- <?php endif; ?> -->