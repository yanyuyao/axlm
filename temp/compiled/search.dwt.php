<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<base href="http://www.365axlm.cn/" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="Keywords" content="<?php echo $this->_var['keywords']; ?>" />
<meta name="Description" content="<?php echo $this->_var['description']; ?>" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />

<title><?php echo $this->_var['page_title']; ?></title>



<link rel="shortcut icon" href="favicon.ico" />
<link rel="icon" href="animated_favicon.gif" type="image/gif" />
<link rel="stylesheet" type="text/css" href="themes/68ecshopcom_360buy/css/category.css" />
<script type="text/javascript" src="themes/68ecshopcom_360buy/js/jquery-1.9.1.min.js" ></script>
<script type="text/javascript" src="themes/68ecshopcom_360buy/js/jquery-lazyload.js" ></script>
<?php echo $this->smarty_insert_scripts(array('files'=>'jquery.json.js,transport.js')); ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'utils.js,common.js,global.js')); ?>
</head>
<body>
<?php echo $this->fetch('library/page_header.lbi'); ?>
<div class="blank"></div>
<div class="w1210">
	<?php echo $this->fetch('library/ur_here.lbi'); ?> 
    <div class="content-wrap category-wrap clearfix">
    	
    	<div class="aside">
        	<span class="slide-aside"></span>
            <div class="aside-inner">
            	<?php echo $this->fetch('library/category_tree.lbi'); ?>
                <?php echo $this->fetch('library/top10.lbi'); ?>
            </div>
        </div>
        
        
        <div class="main">
        	<?php if (isset ( $this->_var['goods_list'] )): ?>
            <div id="filter">
            	<div class="fore1">
                	<dl class="order">
                        <dd class="first <?php if ($this->_var['pager']['search']['sort'] == 'goods_id'): ?>curr<?php endif; ?>">
                        	<a href="search.php?<?php $_from = $this->_var['pager']['search']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?><?php if ($this->_var['key'] != "sort" && $this->_var['key'] != "order"): ?><?php echo $this->_var['key']; ?>=<?php echo $this->_var['item']; ?>&<?php endif; ?><?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>page=<?php echo $this->_var['pager']['page']; ?>&sort=goods_id&order=<?php if ($this->_var['pager']['search']['order'] == 'DESC'): ?>ASC<?php else: ?>DESC<?php endif; ?>#list">上架<b class="icon-order-<?php if ($this->_var['pager']['search']['sort'] == 'goods_id'): ?><?php echo $this->_var['pager']['search']['order']; ?><?php else: ?>DESC<?php endif; ?>ending"></b></a></dd>
                        <dd class="<?php if ($this->_var['pager']['search']['sort'] == 'shop_price'): ?>curr<?php endif; ?>">
                        	<a href="search.php?<?php $_from = $this->_var['pager']['search']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?><?php if ($this->_var['key'] != "sort" && $this->_var['key'] != "order"): ?><?php echo $this->_var['key']; ?>=<?php echo $this->_var['item']; ?>&<?php endif; ?><?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>page=<?php echo $this->_var['pager']['page']; ?>&sort=shop_price&order=<?php if ($this->_var['pager']['search']['order'] == 'DESC'): ?>ASC<?php else: ?>DESC<?php endif; ?>#list">价格<b class="icon-order-<?php if ($this->_var['pager']['search']['sort'] == 'shop_price'): ?><?php echo $this->_var['pager']['search']['order']; ?><?php else: ?>DESC<?php endif; ?>ending"></b></a>
                        </dd>
            			<dd  class="<?php if ($this->_var['pager']['search']['sort'] == 'last_update'): ?>curr<?php endif; ?>">
                        	<a href="search.php?<?php $_from = $this->_var['pager']['search']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?><?php if ($this->_var['key'] != "sort" && $this->_var['key'] != "order"): ?><?php echo $this->_var['key']; ?>=<?php echo $this->_var['item']; ?>&<?php endif; ?><?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>page=<?php echo $this->_var['pager']['page']; ?>&sort=last_update&order=<?php if ($this->_var['pager']['search']['order'] == 'DESC'): ?>ASC<?php else: ?>DESC<?php endif; ?>#list">更新<b class="icon-order-<?php if ($this->_var['pager']['search']['sort'] == 'last_update'): ?><?php echo $this->_var['pager']['search']['order']; ?><?php else: ?>DESC<?php endif; ?>ending"></b></a> 
                        </dd>
            			<dd  class="<?php if ($this->_var['pager']['search']['sort'] == 'click_count'): ?>curr<?php endif; ?>">
                        	<a href="search.php?<?php $_from = $this->_var['pager']['search']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?><?php if ($this->_var['key'] != "sort" && $this->_var['key'] != "order"): ?><?php echo $this->_var['key']; ?>=<?php echo $this->_var['item']; ?>&<?php endif; ?><?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>page=<?php echo $this->_var['pager']['page']; ?>&sort=click_count&order=<?php if ($this->_var['pager']['search']['order'] == 'DESC'): ?>ASC<?php else: ?>DESC<?php endif; ?>#list">人气<b class="icon-order-<?php if ($this->_var['pager']['search']['sort'] == 'click_count'): ?><?php echo $this->_var['pager']['search']['order']; ?><?php else: ?>DESC<?php endif; ?>ending"></b></a>
                        </dd>
                    </dl>
                    <div class="pagin"> 
                        <?php if ($this->_var['pager']['page_prev']): ?> 
                        <a href="<?php echo $this->_var['pager']['page_prev']; ?>" class="prev"><span class="icon prev-btn"></span></a> 
                        <?php else: ?> 
                        <a class="prev"><span class="icon prev-disabled"></span></a> 
                        <?php endif; ?> 
                        <span class="text"><font class="main-color"><?php echo $this->_var['pager']['page']; ?></font>/<?php echo $this->_var['pager']['page_count']; ?></span> 
                        <?php if ($this->_var['pager']['page_next']): ?> 
                        <a href="<?php echo $this->_var['pager']['page_next']; ?>" class="next"><span class="icon next-btn"></span></a> 
                        <?php else: ?> 
                        <a class="next"><span class="icon next-disabled"></span></a> 
                        <?php endif; ?> 
					</div>
                    <div class="total">共<span class="main-color"><?php echo $this->_var['pager']['record_count']; ?></span>个商品</div>
                </div>
            </div>
            <?php if ($this->_var['goods_list']): ?>
            <form action="compare.php" method="post" name="compareForm" id="compareForm" onsubmit="return compareGoods(this);">
                
                <?php if ($this->_var['beizhuxinxi_www_68ecshop_com']): ?>
                <div style="width:100%;height:50px;margin:10px 0;overflow:hidden;text-align:center;"> <?php echo $this->_var['beizhuxinxi_www_68ecshop_com']; ?> </div>
                <?php endif; ?>
                
                <ul class="list-grid clearfix">
                	<?php $_from = $this->_var['goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');$this->_foreach['name'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['name']['total'] > 0):
    foreach ($_from AS $this->_var['goods']):
        $this->_foreach['name']['iteration']++;
?> 
                    <?php if ($this->_var['goods']['goods_id']): ?>
                    <li id="li_<?php echo $this->_var['goods']['goods_id']; ?>" class="item<?php if ($this->_foreach['name']['iteration'] % 4 == 0): ?> last<?php endif; ?>">
                      <div class="item-con"> 
                        <div class="item-tag-box">
                          <?php if ($this->_var['goods']['is_hot'] == 1): ?><div class="item-tag"><span>爆款</span><i></i></div><?php elseif ($this->_var['goods']['is_best'] == 1): ?><div class="item-tag"><span>精品</span><i></i></div><?php elseif ($this->_var['goods']['is_new'] == 1): ?><div class="item-tag"><span>新品</span><i></i></div><?php endif; ?>
                        </div>
                        <div class="item-pic">
                        	<a href="<?php echo $this->_var['goods']['url']; ?>" title="<?php echo htmlspecialchars($this->_var['goods']['name']); ?>" target="_blank">
                            	<img data-original="<?php echo $this->_var['goods']['goods_thumb']; ?>" src="themes/68ecshopcom_360buy/images/loading.gif" title="<?php echo htmlspecialchars($this->_var['goods']['name']); ?>" class="pic_img_<?php echo $this->_var['goods']['goods_id']; ?>">
                            </a>
                        </div>
                        <?php if ($this->_var['goods']['goods_number'] == 0): ?><a href="<?php echo $this->_var['goods']['url']; ?>" target="_blank" class="shop-over"></a><?php endif; ?>
                        <div class="item-info">
                        	<div class="item-price">
                                <em class="sale-price main-color" title="本店价：<?php if ($this->_var['goods']['promote_price'] != ""): ?><?php echo $this->_var['goods']['promote_price']; ?><?php else: ?><?php echo $this->_var['goods']['shop_price']; ?><?php endif; ?>"><?php if ($this->_var['goods']['promote_price'] != ""): ?><?php echo $this->_var['goods']['promote_price']; ?><?php else: ?><?php echo $this->_var['goods']['shop_price']; ?><?php endif; ?></em>
                                <em class="sale-count">已售<?php echo $this->_var['goods']['count']; ?>件</em>
                            </div>
                          	<div class="item-name">
                            	<a href="<?php echo $this->_var['goods']['url']; ?>" target="_blank" title="<?php echo htmlspecialchars($this->_var['goods']['goods_name']); ?>"><?php echo $this->_var['goods']['goods_name_www_68ecshop_com']; ?></a>
                            </div>
                            <div class="item-operate">
                                <a class="operate-btn compare-btn" data-goods="<?php echo $this->_var['goods']['goods_id']; ?>" data-type="<?php echo $this->_var['goods']['type']; ?>" onclick="Compare.add(<?php echo $this->_var['goods']['goods_id']; ?>,'<?php echo htmlspecialchars($this->_var['goods']['goods_name']); ?>','<?php echo $this->_var['goods']['type']; ?>', '<?php echo $this->_var['goods']['goods_thumb']; ?>', '<?php if ($_SESSION['user_name']): ?><?php if ($this->_var['goods']['is_promote'] && $this->_var['goods']['gmt_end_time']): ?><?php echo $this->_var['goods']['promote_price']; ?><?php else: ?><?php echo $this->_var['goods']['shop_price_formated']; ?> <?php endif; ?><?php else: ?><?php echo $this->_var['goods']['market_price']; ?><?php endif; ?>')"><i></i>对比</a>
                                <a id="collect_<?php echo $this->_var['goods']['goods_id']; ?>" href="javascript:collect(<?php echo $this->_var['goods']['goods_id']; ?>); re_collect(<?php echo $this->_var['goods']['goods_id']; ?>)" class="operate-btn collet-btn <?php if ($this->_var['goods']['is_collet'] == 1): ?>curr<?php endif; ?>"><i></i>收藏</a>
                                <a href="<?php echo $this->_var['goods']['url']; ?>#os_pinglun" target="_blank" class="operate-btn comment-btn"><i></i><?php echo $this->_var['goods']['comment_count']; ?></a> 
                                <?php if ($this->_var['goods']['goods_number'] == 0): ?>
                                <a href="javascript:tell_me(<?php echo $this->_var['goods']['goods_id']; ?>);" class="add-cart tell-me" title="到货通知"></a>
                                <?php else: ?>
                                <a href="javascript:addToCart(<?php echo $this->_var['goods']['goods_id']; ?>);" class="add-cart" title="加入购物车"></a>
                                <?php endif; ?>
                            </div>
                        </div>
                      </div>
                    </li>
                    <?php endif; ?> 
                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                </ul>
            </form>
            <?php echo $this->fetch('library/pages.lbi'); ?> 
            <script type="text/javascript">
			<?php $_from = $this->_var['lang']['compare_js']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
			var <?php echo $this->_var['key']; ?> = "<?php echo $this->_var['item']; ?>";
			<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
	
									<?php $_from = $this->_var['lang']['compare_js']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
			<?php if ($this->_var['key'] != 'button_compare'): ?>
			var <?php echo $this->_var['key']; ?> = "<?php echo $this->_var['item']; ?>";
			<?php else: ?>
			var button_compare = '';
			<?php endif; ?>
			<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
	
	
			var compare_no_goods = "<?php echo $this->_var['lang']['compare_no_goods']; ?>";
			window.onload = function()
			{
			  Compare.init();
			  fixpng();
			}
			var btn_buy = "<?php echo $this->_var['lang']['btn_buy']; ?>";
			var is_cancel = "<?php echo $this->_var['lang']['is_cancel']; ?>";
			var select_spe = "<?php echo $this->_var['lang']['select_spe']; ?>";
			</script>
            <?php else: ?>
            <div class="tip-box">
              <i class="tip-icon"></i>
              <div class="tip-text"><?php echo $this->_var['lang']['no_search_result']; ?></div>
            </div>
            <?php endif; ?>
            <?php endif; ?>
        </div>
        
    </div>
    <?php echo $this->fetch('library/history.lbi'); ?>
</div>
<div class="blank"></div>
<?php echo $this->fetch('library/arrive_notice.lbi'); ?>

<script type="text/javascript" src="<?php echo $this->_var['option']['static_path']; ?>js/compare.js"></script>
<script type="text/javascript" src="<?php echo $this->_var['option']['static_path']; ?>js/json2.js"></script>
<script>
$(document).ready(function(e) {
	Compare.init();
	
});
</script>
<div id="compareBox">
  <div class="menu">
    <ul>
      <li class="current" data-value='compare'>对比栏</li>
      <li data-value='history'>最近浏览</li>
    </ul>
    <a class="hide-compare" href="javascript:;" title="隐藏"></a>
    <div style="clear:both"></div>
  </div>
  <div id="compareList"></div>
  <div id="historyList" style="display:none;">
  	<span id="sc-prev" class="sc-prev scroll-btn"></span><span id="sc-next" class="sc-next scroll-btn"></span>
    <div class="scroll_wrap"><?php 
$k = array (
  'name' => 'history_list',
);
echo $this->_echash . $k['name'] . '|' . serialize($k) . $this->_echash;
?></div>
  </div>
</div>

<script>
re_collect();

function re_collect(id){
  goods_id = (typeof(id) == "undefined" ? 0 : id);
  Ajax.call('user.php?act=re_collect', 'id=' + goods_id, re_collectResponse, 'GET', 'JSON');
}

function re_collectResponse(result){
  if (result.goods_id > 0){
    document.getElementById("collect_" + result.goods_id).className = (result.is_collect == 1 ? "operate-btn collet-btn curr" : "operate-btn collet-btn");
  }else{
    $("a[id^='collect_']").className = "operate-btn collet-btn";
    for(i = 0; i < result.is_collect.length; i++){
      document.getElementById("collect_" + result.is_collect[i]).className = "operate-btn collet-btn curr";
    }
  }
}

var skuIds = [];
$('ul.list-h li[sku]').each(function(i){
    skuIds.push($(this).attr('sku'));
})

$("img").lazyload({
    effect       : "fadeIn",
	 skip_invisible : true,
	 failure_limit : 20
});

$(function(){
	<?php if (! $_SESSION['user_id'] > 0): ?>
	$('.item-operate .collet-btn').click(function(){
		$('.pop-login,.pop-mask').show();	
	})
	<?php endif; ?>
	var scroll_height = $('#filter').offset().top;
	$(window).scroll(function(){
		var this_scrollTop = $(this).scrollTop();
		if(this_scrollTop > scroll_height){
			$('#filter').addClass('filter-fixed').css({'left':($(window).width()-$('.filter-fixed').outerWidth())/2});
		}else{
			$('#filter').removeClass('filter-fixed').css('left','');	
		}
	})	
})
</script>
<?php echo $this->fetch('library/right_sidebar.lbi'); ?>
<div class="site-footer">
    <div class="footer-related">
  		<?php echo $this->fetch('library/help.lbi'); ?>
  		<?php echo $this->fetch('library/page_footer.lbi'); ?>
  </div>
</div>
<script type="text/javascript" src="themes/68ecshopcom_360buy/js/compare.js"></script> 
</body>
</html>
