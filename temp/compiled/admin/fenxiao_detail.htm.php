<?php echo $this->fetch('pageheader.htm'); ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'../js/utils.js,listtable.js')); ?>

<form method="POST" action="" name="listForm">

<!-- start users list -->
<div class="list-div" id="listDiv">
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
  <tr>
  <tr>
    <td><?php echo $this->_var['info']['id']; ?></td>
    <td><?php echo $this->_var['info']['user_id']; ?></td>
    <td class="first-cell"><?php echo $this->_var['info']['user_name']; ?></td>
    <td class="first-cell"><?php echo $this->_var['info']['is_valid_user']; ?></td>
    <td class="first-cell"><?php echo $this->_var['info']['bonus_proportional']; ?></td>
    <td><?php echo $this->_var['info']['expend_user_amount']; ?></td>
    <td><?php echo $this->_var['info']['expend_code']; ?></td>
    <td><?php echo $this->_var['info']['user_money']; ?></td>
    <td><?php echo $this->_var['info']['expend_amount']; ?></td>
    <td><?php echo $this->_var['info']['bonus_amount']; ?></td>
  </tr>
</table>
<div class="form-div" style="margin-top:30px;">
直推会员<?php echo $this->_var['listtotal']; ?>
</div>
<table cellpadding="3" cellspacing="1">
  <tr>
    <th>UserID</th>
    <th>用户名</th>
    <th>状态</th>
  <tr>
 <?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'd');if (count($_from)):
    foreach ($_from AS $this->_var['d']):
?>
  <tr>
    <td><?php echo $this->_var['d']['user_id']; ?></td>
    <td><?php echo $this->_var['d']['user_name']; ?></td>
    <td><?php echo $this->_var['d']['is_valid_user']; ?></td>
  </tr>
  <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
</table>
</div>
</form>
<?php echo $this->fetch('pagefooter.htm'); ?>