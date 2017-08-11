<!-- $Id: ads_list.htm 14216 2008-03-10 02:27:21Z testyang $ -->
<?php if ($this->_var['full_page']): ?>
<?php echo $this->fetch('pageheader.htm'); ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'../js/utils.js,listtable.js')); ?>

<div class="form-div">
  <form action="javascript:search_ad()" name="searchForm">
    <img src="images/icon_search.gif" width="26" height="22" border="0" alt="SEARCH" />
   
    关键字<input type="text" name="keyword" size="15" placeholder="请输入商户名" />
    <input type="submit" value="<?php echo $this->_var['lang']['button_search']; ?>" class="button" />
  </form>
</div>
<script language="JavaScript">
    function search_ad()
    {
		
        listTable.filter['keyword'] = Utils.trim(document.forms['searchForm'].elements['keyword'].value);
        listTable.filter['page'] = 1;
        
        listTable.loadList();
    }

</script>

<form method="post" action="" name="listForm">
<!-- start ads list -->
<div class="list-div" id="listDiv">
<?php endif; ?>

<table cellpadding="3" cellspacing="1">
  <tr>
    <th>ID</th>
    <th>缩略图</th>
    <th>商户名</th>
    <th>联系人</th>
    <th>联系方式</th>
    <th>行业</th>
    <th>地址</th>
    <th>推荐到首页</th>
    <th>排序</th>
    <th>添加时间</th>
    <th>状态</th>
    <th><?php echo $this->_var['lang']['handler']; ?></th>
  </tr>
  <?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'list_0_40342900_1494385124');if (count($_from)):
    foreach ($_from AS $this->_var['list_0_40342900_1494385124']):
?>
  <tr>
   <td class="first-cell"><?php echo $this->_var['list_0_40342900_1494385124']['id']; ?></td>
    <td align="center">
		<div style="margin:4px; position:relative" onmousemove="open_af('<?php echo $this->_var['list_0_40342900_1494385124']['thumb']; ?>', 'block')" onmouseout="open_af('<?php echo $this->_var['list_0_40342900_1494385124']['thumb']; ?>', 'none')">
		<img src="../data/shopsimgs/<?php echo $this->_var['list_0_40342900_1494385124']['thumb']; ?>" width="50px" style="cursor:pointer"/>
		<div id="open_af_<?php echo $this->_var['list_0_40342900_1494385124']['thumb']; ?>" style="display:none; position:absolute;left:70px;top:-2px; float:left; z-index:1000; border:#E5E5E5 solid 2px">
		<img src="../data/shopsimgs/<?php echo $this->_var['list_0_40342900_1494385124']['thumb']; ?>" />
		</div>
		</div>
		<script language="javascript">
		function open_af(m_id, m_t)
		{
			document.getElementById("open_af_" + m_id).style.display = m_t;
		}
		</script>
    </td>
	
    <td class="first-cell"><?php echo $this->_var['list_0_40342900_1494385124']['name']; ?></td>
    <td align="left"><?php echo $this->_var['list_0_40342900_1494385124']['username']; ?></td>
    <td align="left"><span><?php echo $this->_var['list_0_40342900_1494385124']['phone']; ?></span></td>
    <td align="center"><span><?php echo $this->_var['list_0_40342900_1494385124']['hangye']; ?></span></td>
    <td align="center"><span><?php echo $this->_var['list_0_40342900_1494385124']['address']; ?></span></td>
    <td align="right"><span><?php if ($this->_var['list_0_40342900_1494385124']['is_home'] == '1'): ?>是<?php else: ?>否<?php endif; ?></span></td>
    <td align="right"><span><?php echo $this->_var['list_0_40342900_1494385124']['sort']; ?></span></td>
    <td align="right"><span><?php echo $this->_var['list_0_40342900_1494385124']['ctime']; ?></span></td>
    <td align="right"><span><?php if ($this->_var['list_0_40342900_1494385124']['status'] == 1): ?>已开启<?php elseif ($this->_var['list_0_40342900_1494385124']['status'] == 2): ?>已禁用<?php endif; ?></span></td>
    <td align="right">
		 <a href="shops.php?act=edit&id=<?php echo $this->_var['list_0_40342900_1494385124']['id']; ?>" title="编辑" class="btn-blue">编辑</a>
		  <?php if ($this->_var['list_0_40342900_1494385124']['status'] == 2): ?>
		  <a href="shops.php?act=execstatus&status=1&id=<?php echo $this->_var['list_0_40342900_1494385124']['id']; ?>" title="启用" class="btn-blue">启用</a>
		  <?php elseif ($this->_var['list_0_40342900_1494385124']['status'] == 1): ?>
		  <a href="shops.php?act=execstatus&status=2&id=<?php echo $this->_var['list_0_40342900_1494385124']['id']; ?>" title="禁用" class="btn-blue">禁用</a>
		  <?php endif; ?>
      <a href="shops.php?act=remove&id=<?php echo $this->_var['list_0_40342900_1494385124']['id']; ?>" title="删除" class="btn-blue">删除</a>
    </td>
  </tr>
  <?php endforeach; else: ?>
    <tr><td class="no-records" colspan="10"><?php echo $this->_var['lang']['no_ads']; ?></td></tr>
  <?php endif; unset($_from); ?><?php $this->pop_vars();; ?>
  <tr>
    <td align="right" nowrap="true" colspan="10"><?php echo $this->fetch('page.htm'); ?></td>
  </tr>
</table>

<?php if ($this->_var['full_page']): ?>
</div>
<!-- end ad_position list -->
</form>

<script type="text/javascript" language="JavaScript">
  listTable.recordCount = <?php echo $this->_var['record_count']; ?>;
  listTable.pageCount = <?php echo $this->_var['page_count']; ?>;

  <?php $_from = $this->_var['filter']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
  listTable.filter.<?php echo $this->_var['key']; ?> = '<?php echo $this->_var['item']; ?>';
  <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
  
  onload = function()
  {
    // 开始检查订单
    startCheckOrder();
  }
  
</script>
<?php echo $this->fetch('pagefooter.htm'); ?>
<?php endif; ?>
