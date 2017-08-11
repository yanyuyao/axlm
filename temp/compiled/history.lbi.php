<div class="browse-history">
	<div class="browse-history-tab clearfix">
    	<?php if ($this->_var['cainixihuan']): ?>
    	<span class="tab-span main-color">猜你喜欢</span>
		<?php endif; ?>
        <span class="tab-span">浏览历史</span>
        <div class="browse-history-line main-bg-color"></div>
        <div class="browse-history-other">
        	<?php if ($this->_var['cainixihuan']): ?>
        	<a href="javascript:;" class="history-recommend-change"><i class="icon"></i><em class="text">换一批</em></a>
            <?php endif; ?>
        	<a onclick="clear_history()" href="javascript:void(0);" class="clear_history <?php if ($this->_var['cainixihuan']): ?>none<?php endif; ?>"><i class="icon"></i><em class="text">清空</em></a>
        </div>
    </div>
    <div class="browse-history-con">
    	<div class="browse-history-inner">
        	<?php if ($this->_var['cainixihuan']): ?>
            <ul class="recommend-panel">
                <?php $_from = $this->_var['cainixihuan']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods_0_54110100_1496534985');if (count($_from)):
    foreach ($_from AS $this->_var['goods_0_54110100_1496534985']):
?>
                <li>
                    <div class="p-img"><a target="_blank" title="<?php echo $this->_var['goods_0_54110100_1496534985']['goods_name']; ?>" href="<?php echo $this->_var['goods_0_54110100_1496534985']['url']; ?>"><img alt="<?php echo $this->_var['goods_0_54110100_1496534985']['goods_name']; ?>" src="<?php echo $this->_var['goods_0_54110100_1496534985']['goods_thumb']; ?>"></a></div>
                    <div class="p-name"><a target="_blank" title="<?php echo $this->_var['goods_0_54110100_1496534985']['goods_name']; ?>" href="<?php echo $this->_var['goods_0_54110100_1496534985']['url']; ?>"><?php echo $this->_var['goods_0_54110100_1496534985']['goods_name']; ?></a></div>
                  	<div class="p-comm">
                    	<span class="p-price main-color"><?php echo $this->_var['goods_0_54110100_1496534985']['shop_price']; ?></span>
                        <a class="p-comm-num" target="_blank" href="<?php echo $this->_var['goods_0_54110100_1496534985']['url']; ?>">评论：<?php echo $this->_var['goods_0_54110100_1496534985']['evaluation']; ?></a>
                    </div>
                </li>
                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
            </ul>
            <?php endif; ?>
            <ul id="history_list" class="history-panel <?php if ($this->_var['cainixihuan']): ?>none<?php endif; ?>">
                <?php 
$k = array (
  'name' => 'history',
);
echo $this->_echash . $k['name'] . '|' . serialize($k) . $this->_echash;
?>
            </ul>
        </div>
    </div>
</div>

<script type="text/javascript">
function clear_history(){
	Ajax.call('user.php', 'act=clear_history',clear_history_Response, 'GET', 'TEXT',1,1);
}
function clear_history_Response(res){
	document.getElementById('history_list').innerHTML = '<?php echo $this->_var['lang']['no_history']; ?>';
}
if($('.browse-history-con li').length == 0){
	$('.browse-history').addClass('none');	
}
$('.browse-history .browse-history-tab .tab-span').mouseover(function(){
	$(this).addClass('main-color').siblings('.tab-span').removeClass('main-color');
	$('.browse-history-line').stop().animate({'left':$(this).position().left,'width':$(this).outerWidth()},500);
	$('.browse-history-other').find('a').eq($(this).index()).removeClass('none').siblings('a').addClass('none');
	$('.browse-history-inner ul').eq($(this).index()).removeClass('none').siblings('ul').addClass('none');
})
var history_num = 0;
var history_li = $('.browse-history .recommend-panel li');
var history_slide_w = history_li.outerWidth()*6;
var history_slide_num = Math.ceil(history_li.length/6);
$('.browse-history .history-recommend-change').click(function(){
	history_num++;
	if(history_num > (history_slide_num-1)){
		history_num = 0;	
	}
	$('.browse-history .recommend-panel').css({'left':-history_num*history_slide_w});
})
</script> 