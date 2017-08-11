<?php if ($this->_var['full_page']): ?>
<?php echo $this->fetch('pageheader.htm'); ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'../js/utils.js,listtable.js')); ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'validator.js')); ?>
<div class="affiliate-div">
<form method="post" action="fenxiao_setting.php" style="height:30px;line-height:30px; ">
    <input type="radio" name="on" value="1" <?php if ($this->_var['config']['on'] == 1): ?> checked="true" <?php endif; ?> onClick="javascript:actDiv('separate','');actDiv('btnon','none');" >开启
    <input type="radio" name="on" value="0" <?php if (! $this->_var['config']['on'] || $this->_var['config']['on'] == 0): ?> checked="true" <?php endif; ?> onClick="javascript:actDiv('separate','none');actDiv('btnon','');" style="vertical-align:none">关闭
    <input type="hidden" name="act" value="on" />
    <input type="submit" value="<?php echo $this->_var['lang']['button_submit']; ?>" class="button" id="btnon"/>
</form>
</div>
<div id="separate">
    <form method="post" action="fenxiao_setting.php?act=save">
	<div class="list-div" id="listDiv">
	 <style>
                .list-div input.small-text {
                        width:50px;
                }
            </style>
	<table cellspacing='1' cellpadding='3'>
		<tr>
                        <th>等级</th>
			<!--<th name="levels" ReadOnly="true" width="10%">直推人数(至少)</th>-->
			<th name="levels" ReadOnly="true" width="10%">消费金额</th>
			<th Type="TextBox">一级佣金比例</th>
			<th Type="TextBox">二级佣金比例</th>
			<th Type="TextBox">三级佣金比例</th>
			<!--<th>操作</th>-->
		</tr>
           
			
			 <tr align="center">
                    <td>0</td>
                    <!--<td><input type="text" class="small-text" name="sbs0_share_people_num" value="<?php echo $this->_var['config']['dataitem']['zhitui_leve0']['sbs0_share_people_num']; ?>" readonly /></td>-->
                    <td><input type="text" class="small-text" name="sbs0_shop_amount" value="<?php echo $this->_var['config']['dataitem']['zhitui_leve0']['sbs0_shop_amount']; ?>" readonly /></td>
                    <td><input type="text" class="small-text" name="sbs0_leve1" value="<?php echo $this->_var['config']['dataitem']['zhitui_leve0']['sbs0_leve1']; ?>"/>元</td>
                    <td><input type="text" class="small-text" name="sbs0_leve2" value="<?php echo $this->_var['config']['dataitem']['zhitui_leve0']['sbs0_leve2']; ?>"/>元</td>
                    <td><input type="text" class="small-text" name="sbs0_leve3" value="<?php echo $this->_var['config']['dataitem']['zhitui_leve0']['sbs0_leve3']; ?>"/>元</td>
                    
            </tr>
            <tr align="center">
                    <td>1</td>
                    <!--<td><input type="text" class="small-text" name="sbs1_share_people_num" value="<?php echo $this->_var['config']['dataitem']['zhitui_leve1']['sbs1_share_people_num']; ?>" readonly /></td>-->
                    <td><input type="text" class="small-text" name="sbs1_shop_amount" value="<?php echo $this->_var['config']['dataitem']['zhitui_leve1']['sbs1_shop_amount']; ?>" readonly /></td>
                    <td><input type="text" class="small-text" name="sbs1_leve1" value="<?php echo $this->_var['config']['dataitem']['zhitui_leve1']['sbs1_leve1']; ?>"/>元</td>
                    <td><input type="text" class="small-text" name="sbs1_leve2" value="<?php echo $this->_var['config']['dataitem']['zhitui_leve1']['sbs1_leve2']; ?>"/>元</td>
                    <td><input type="text" class="small-text" name="sbs1_leve3" value="<?php echo $this->_var['config']['dataitem']['zhitui_leve1']['sbs1_leve3']; ?>"/>元</td>
                    
            </tr>
			<!--
			<tr align="left">
				<td colspan=6>
					最低提现金额 ：<input type="text" class="small-text" name="tixian_limit" value="<?php echo $this->_var['config']['tixian_limit']; ?>"/>
				</td>
			</tr>	
			<tr align="left">	
				<td colspan=6>
					提现手续费 ：<input type="text" class="small-text" name="tixian_shouxufei" value="<?php echo $this->_var['config']['tixian_shouxufei']; ?>"/>%
				</td>
			</tr>
			
			<tr align="left">
				<td colspan=6>
					分佣基数 ：<input type="text" class="small-text" name="leve_basenums" value="100"/>% 
					<p>每笔交易的百分比作为分佣基数,100%代表按照交易额分佣</p>
				</td>
			</tr>
			<tr align="left">
				<td colspan=6>
					分红基数 ：<input type="text" class="small-text" name="leve_fenhongnums" value="100"/>% 
					<p>分红基数为总交易额</p>
				</td>
			</tr>
			-->
	</table>
	</div>
         <input type="submit" value="<?php echo $this->_var['lang']['button_submit']; ?>" class="button" id="btnon"/>
    </form>    
</div>
<script type="Text/Javascript" language="JavaScript">
<!--
<?php if (! $this->_var['config']['on'] || $this->_var['config']['on'] == 0): ?>
actDiv('separate','none');
<?php else: ?>
actDiv('btnon','none');
<?php endif; ?>
<?php if ($this->_var['config']['config']['separate_by'] == 1): ?>
actDiv('listDiv','none');
<?php endif; ?>

var all_null = '<?php echo $this->_var['lang']['all_null']; ?>';

onload = function()
{
  // 开始检查订单
  startCheckOrder();
  cleanWhitespace(document.getElementById("listDiv"));
  if (document.getElementById("listDiv").childNodes[0].rows.length<6)
  {
    listTable.addRow(check);
  }
  
}
function check(frm)
{
  if (frm['level_point'].value == "" && frm['level_money'].value == "")
  {
     frm['level_point'].focus();
     alert(all_null);
     return false;  
  }
  
  return true;
}
function actDiv(divname, flag)
{
    document.getElementById(divname).style.display = flag;
}

//-->
</script>
<?php echo $this->fetch('pagefooter.htm'); ?>
<?php endif; ?>