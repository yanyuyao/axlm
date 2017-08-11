<?php if ($this->_var['helps']): ?>
<div class="left-con">
  <div class="article-menu">
    <?php $_from = $this->_var['helps']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'help_cat');$this->_foreach['name'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['name']['total'] > 0):
    foreach ($_from AS $this->_var['key'] => $this->_var['help_cat']):
        $this->_foreach['name']['iteration']++;
?>
    <div class="article-menu-list <?php if ($this->_var['key'] == $this->_var['cat_id']): ?>curr<?php endif; ?> <?php if (($this->_foreach['name']['iteration'] == $this->_foreach['name']['total'])): ?>last<?php endif; ?>">
      <h4><b></b><?php echo $this->_var['help_cat']['cat_name']; ?></h4>
      <ul <?php if ($this->_var['key'] == $this->_var['cat_id']): ?>class="curr"<?php endif; ?>>
        <?php $_from = $this->_var['help_cat']['article']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');$this->_foreach['name1'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['name1']['total'] > 0):
    foreach ($_from AS $this->_var['item']):
        $this->_foreach['name1']['iteration']++;
?>
        <li class="<?php if (($this->_foreach['name1']['iteration'] <= 1)): ?>first<?php endif; ?> <?php if ($this->_var['item']['title'] == $this->_var['article']['title']): ?>curr<?php endif; ?>"><a href="help.php?id=<?php echo $this->_var['item']['article_id']; ?>" target="_self"><?php echo $this->_var['item']['short_title']; ?></a></li>
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
      </ul>
    </div>
    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
  </div>
</div>
<?php endif; ?>
