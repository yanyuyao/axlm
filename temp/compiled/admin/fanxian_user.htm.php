<?php if ($this->_var['full_page']): ?>
<?php echo $this->fetch('pageheader.htm'); ?> <?php echo $this->smarty_insert_scripts(array('files'=>'../js/utils.js,listtable.js,placeholder.js')); ?>
<!--
<div class="form-div">
	<form action="javascript:searchUser()" name="searchForm">
		<img src="images/icon_search.gif" width="26" height="22" border="0" alt="SEARCH" />
		<span style="position:relative"><input type="text" name="keyword" placeholder="手机号/用户名/邮箱" /></span>
		<input type="submit" class="button" value="<?php echo $this->_var['lang']['button_search']; ?>" />
	</form>
</div>
-->
<form method="POST" action="" name="listForm" onsubmit="return confirm_bath()">
	<div class="list-div" id="listDiv">
		<?php endif; ?>
		<table cellpadding="3" cellspacing="1">
			<tr>
				<th>
					<input onclick='listTable.selectAll(this, "checkboxes")' type="checkbox">
					<a href="javascript:listTable.sort('user_id'); "><?php echo $this->_var['lang']['record_id']; ?></a>
					<?php echo $this->_var['sort_user_id']; ?>
				</th>
				<th>
					<a href="javascript:listTable.sort('user_name'); ">会员名</a>
					<?php echo $this->_var['sort_user_name']; ?>
				</th>
				<th><a href="javascript:listTable.sort('user_money'); ">消费金额</a></th>
				<th><a href="javascript:listTable.sort('user_back_money'); ">返现金额</a></th>
				<th>状态</th>
				<th>管理员</th>
				<th>
					<a href="javascript:listTable.sort('reg_time'); ">注册时间</a>
					<?php echo $this->_var['sort_reg_time']; ?>
				</th>
				<th><?php echo $this->_var['lang']['handler']; ?></th>
			<tr><?php $_from = $this->_var['user_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'user');if (count($_from)):
    foreach ($_from AS $this->_var['user']):
?>
			<tr>
				<td>
					<input type="checkbox" name="checkboxes[]" value="<?php echo $this->_var['user']['user_id']; ?>" notice="<?php if ($this->_var['user']['user_money'] != 0): ?>1<?php else: ?>0<?php endif; ?>" />
					<?php echo $this->_var['user']['user_id']; ?>
				</td>
				<td class="first-cell">
					<span style="margin-bottom: 2px; line-height: 14px; display: block;"><?php echo htmlspecialchars($this->_var['user']['user_name']); ?></span>
				</td>
				<td><?php echo $this->_var['user']['consume']; ?></td>
				<td><?php echo $this->_var['user']['back_point']; ?></td>
				<td align="center"><?php if ($this->_var['user']['is_back_point'] == '1'): ?>可返现<?php else: ?>不可返现<?php endif; ?></td>
				<td align="center"><?php if ($this->_var['user']['is_disabled_point'] == '1'): ?>管理员禁用<?php else: ?><?php endif; ?></td>
				<td align="center"><?php echo $this->_var['user']['reg_time']; ?></td>
				<td align="center">
					<a href="order.php?act=list&user_id=<?php echo $this->_var['user']['user_id']; ?>" title="<?php echo $this->_var['lang']['view_order']; ?>">
						<img src="images/icon_view.gif" border="0" height="16" width="16" />
					</a>
					<?php if ($this->_var['user']['is_disabled_point'] == '1'): ?>
					<a href="javascript:confirm_redirect('确定要设置该用户为返现用户吗？', 'fanxian_user.php?act=abled&id=<?php echo $this->_var['user']['user_id']; ?>')" title="设置返现">
						<img src="images/icon_priv.gif" border="0" height="16" width="16" />
					</a>
					<?php else: ?>
					<a href="javascript:confirm_redirect('确定要禁用返现用户吗？', 'fanxian_user.php?act=disabled&id=<?php echo $this->_var['user']['user_id']; ?>')" title="不再返现">
						<img src="images/icon_drop.gif" border="0" height="16" width="16" />
					</a>
					<?php endif; ?>
					
				</td>
			</tr>
			<?php endforeach; else: ?>
			<tr>
				<td class="no-records" colspan="11"><?php echo $this->_var['lang']['no_records']; ?></td>
			</tr>
			<?php endif; unset($_from); ?><?php $this->pop_vars();; ?>
			<tr>
				<td align="right" nowrap="true" colspan="11"><?php echo $this->fetch('page.htm'); ?></td>
			</tr>
		</table>
		<?php if ($this->_var['full_page']): ?>
	</div>
	<!-- end users list -->
</form>
<script type="text/javascript" language="JavaScript">
<!--
listTable.recordCount = <?php echo $this->_var['record_count']; ?>;
listTable.pageCount = <?php echo $this->_var['page_count']; ?>;

<?php $_from = $this->_var['filter']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
listTable.filter.<?php echo $this->_var['key']; ?> = '<?php echo $this->_var['item']; ?>';
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>


onload = function()
{
    document.forms['searchForm'].elements['keyword'].focus();
    // 开始检查订单
    startCheckOrder();
}

/**
 * 搜索用户
 */
function searchUser()
{
    //listTable.filter['keywords'] = Utils.trim(document.forms['searchForm'].elements['keyword'].value);
    //listTable.filter['rank'] = document.forms['searchForm'].elements['user_rank'].value;
    //listTable.filter['pay_points_gt'] = Utils.trim(document.forms['searchForm'].elements['pay_points_gt'].value);
    //listTable.filter['pay_points_lt'] = Utils.trim(document.forms['searchForm'].elements['pay_points_lt'].value);
    //listTable.filter['page'] = 1;
    listTable.loadList();
}

function confirm_bath()
{
  userItems = document.getElementsByName('checkboxes[]');

  cfm = '<?php echo $this->_var['lang']['list_remove_confirm']; ?>';

  for (i=0; userItems[i]; i++)
  {
    if (userItems[i].checked && userItems[i].notice == 1)
    {
      cfm = '<?php echo $this->_var['lang']['list_still_accounts']; ?>' + '<?php echo $this->_var['lang']['list_remove_confirm']; ?>';
      break;
    }
  }

  return confirm(cfm);
}
//-->
</script>
 <?php echo $this->fetch('pagefooter.htm'); ?> <?php endif; ?>