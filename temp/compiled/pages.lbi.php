<form name="selectPageForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
  <?php if ($this->_var['pager']['styleid'] == 0): ?>
  <div class="page">
    <div class="page-wrap fr">
    	<div class="page-num fl">
        	<a class="num prev"  href="<?php echo $this->_var['pager']['page_prev']; ?>">
            	<i class="icon"></i>
                <i>上一页</i>
            </a>
        	<a class="num next" href="<?php echo $this->_var['pager']['page_next']; ?>">
                <i>下一页</i>
            	<i class="icon"></i>
            </a> 
        </div>
    	
		<?php $_from = $this->_var['pager']['search']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item_0_53670000_1496534985');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item_0_53670000_1496534985']):
?> 
		<?php if ($this->_var['key'] == 'keywords'): ?>
		<input type="hidden" name="<?php echo $this->_var['key']; ?>" value="<?php echo urldecode($this->_var['item_0_53670000_1496534985']); ?>" />
		<?php else: ?>
		<input type="hidden" name="<?php echo $this->_var['key']; ?>" value="<?php echo $this->_var['item_0_53670000_1496534985']; ?>" />
		<?php endif; ?> 
		<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
		<select name="page" id="page" onchange="selectPage(this)">
        <?php echo $this->html_options(array('options'=>$this->_var['pager']['array'],'selected'=>$this->_var['pager']['page'])); ?>
		</select>
    </div>
  </div>
  <?php else: ?>
  <?php if ($this->_var['pager']['page_count'] != 1): ?>
  <div class="page">
    <div class="page-wrap fr"> 
    	<div class="page-num fl">
        	<?php if ($this->_var['pager']['page_prev']): ?>
			<a class="num prev" href="<?php echo $this->_var['pager']['page_prev']; ?>">
            	<i class="icon"></i>
                <i>上一页</i>
            </a>
            <?php else: ?>
            <span class="num prev disabled">
            	<i class="icon"></i>
                <i>上一页</i>
            </span>
            <?php endif; ?>
			<?php if ($this->_var['pager']['page_count'] != 1): ?> 
			<?php $_from = $this->_var['pager']['page_number']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item_0_53710500_1496534985');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item_0_53710500_1496534985']):
?> 
			<?php if ($this->_var['pager']['page'] == $this->_var['key']): ?> 
			<span class="num curr"><?php echo $this->_var['key']; ?></span> 
			<?php else: ?> 
			<a class="num" href="<?php echo $this->_var['item_0_53710500_1496534985']; ?>"><?php echo $this->_var['key']; ?></a> 
			<?php endif; ?> 
			<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?> 
			<?php endif; ?> 
            <?php if ($this->_var['pager']['page_next']): ?>
			<a class="num next" href="<?php echo $this->_var['pager']['page_next']; ?>">
                <i>下一页</i>
            	<i class="icon"></i>
            </a>
            <?php else: ?>
            <span class="num next disabled">
                <i>下一页</i>
            	<i class="icon"></i>
            </span>
            <?php endif; ?>
        </div>
      
      <div class="total">共 <?php echo $this->_var['pager']['page_count']; ?> 页<?php if ($this->_var['pager']['page_kbd']): ?> ，<?php endif; ?></div>
      <?php if ($this->_var['pager']['page_kbd']): ?> 
      <div class="form fl"> 
      <span class="text">到第</span>
      <?php $_from = $this->_var['pager']['search']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item_0_53736100_1496534985');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item_0_53736100_1496534985']):
?> 
      <?php if ($this->_var['key'] == 'keywords'): ?>
      <input type="hidden" name="<?php echo $this->_var['key']; ?>" value="<?php echo urldecode($this->_var['item_0_53736100_1496534985']); ?>" />
      <?php else: ?>
      <input type="hidden" name="<?php echo $this->_var['key']; ?>" value="<?php echo $this->_var['item_0_53736100_1496534985']; ?>" />
      <?php endif; ?> 
      <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?> 
      <kbd style="float:left;">
      <input type="text" name="page" onkeydown="if(event.keyCode==13)selectPage(this)" size="3" class="input"/>
      </kbd>
      <span class="text">页</span>
      </div> 
      <?php endif; ?> 
    </div>
  </div>
  <?php endif; ?>
  <?php endif; ?>
</form>
<script type="Text/Javascript" language="JavaScript">
<!--

function selectPage(sel){
  sel.form.submit();
}

//-->
</script> 