<link rel="stylesheet" type="text/css" href="themes/68ecshopcom_360buy/css/68ecshop_common.css" />
<script language="javascript"> 
<!--
/*屏蔽所有的js错误*/
function killerrors() { 
return true; 
} 
window.onerror = killerrors; 
//-->
</script>
<script type="text/javascript" src="themes/68ecshopcom_360buy/js/page.js"></script>
<script type="text/javascript" src="themes/68ecshopcom_360buy/js/bubbleup.js"></script>
<?php echo $this->fetch('library/user_header.lbi'); ?>
<div class="header">
	<div class="w1210">
  		<div class="mall-logo"> <a href="./"><img src="themes/68ecshopcom_360buy/images/logo.gif?v=098" width="250" /></a> </div>
  		<div class="mall-logo-right"> <a href="#" target="_blank"></a> </div>
  		<div class="mall-search">
    <div id="search-tips" style="display:none;"></div>
    <form class="mallSearch-form" method="get" name="searchForm" id="searchForm" action="search.php" onSubmit="return checkSearchForm()">
      <input type='hidden' name='type' id="searchtype" value="<?php echo empty($_REQUEST['type']) ? '0' : $_REQUEST['type']; ?>">
      <div class="mallSearch-input">
        <ul class="search-type">
          <li <?php if ($_REQUEST['type'] == 0): ?>class="cur"<?php endif; ?> num="0">宝贝<i class="icon-down"></i></li>
         <!-- <li <?php if ($_REQUEST['type'] == 1): ?>class="cur"<?php endif; ?> num="1">店铺<i class="icon-down"></i></li>-->
        </ul>
        <div class="s-combobox">
          <div class="s-combobox-input-wrap">
            <input aria-haspopup="true" role="combobox" class="s-combobox-input" name="keywords" id="keyword" tabindex="9" accesskey="s" onkeyup="STip(this.value, event);" autocomplete="off"  value="<?php if ($this->_var['search_keywords']): ?><?php echo htmlspecialchars($this->_var['search_keywords']); ?><?php else: ?>请输入关键词<?php endif; ?>" onFocus="if(this.value=='请输入关键词'){this.value='';}else{this.value=this.value;}" onBlur="if(this.value=='')this.value='请输入关键词'" type="text">
          </div>
        </div>
        <input type="submit" value="搜索" class="button main-bg-color"  >
      </div>
    </form>
    <ul class="hot-query" >
      <?php $_from = $this->_var['searchkeywords']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'val');$this->_foreach['name'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['name']['total'] > 0):
    foreach ($_from AS $this->_var['val']):
        $this->_foreach['name']['iteration']++;
?>
      <li <?php if (($this->_foreach['name']['iteration'] <= 1)): ?>style="border-left: none;"<?php endif; ?>> <a href="search.php?keywords=<?php echo urlencode($this->_var['val']); ?>" title="<?php echo $this->_var['val']; ?>"><?php echo $this->_var['val']; ?></a> </li>
      <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
    </ul>
  </div>
  		<?php echo $this->fetch('library/user_header_right.lbi'); ?>
	</div>
</div>
<div class="all-nav all-nav-border">
  <div class="w1210">
      <div class="home-category fl"  onmouseover="_show_(this)" onmouseout="_hide_(this)"> 
        <a href="catalog.php" class="menu-event main-bg-color" title="查看全部商品分类">全部商品分类<i></i></a> 
        <div class="expand-menu all-cat main-bg-color"> 
        <?php $_from = get_categories_tree(0); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'cat');$this->_foreach['cat0'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['cat0']['total'] > 0):
    foreach ($_from AS $this->_var['cat']):
        $this->_foreach['cat0']['iteration']++;
?>
        <div class="list">
          <dl class="cat">
            <dt class="cat-name"> <a href="<?php echo $this->_var['cat']['url']; ?>" target="_blank" title="进入<?php echo $this->_var['cat']['name']; ?>频道"><?php echo $this->_var['cat']['name']; ?></a> </dt>
            <i>&gt;</i>
          </dl>
          <div class="categorys">
            <div class="item-left fl"> 
              
              <?php $_from = $this->_var['cat']['cat_id']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'childs');$this->_foreach['name'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['name']['total'] > 0):
    foreach ($_from AS $this->_var['childs']):
        $this->_foreach['name']['iteration']++;
?> 
              <?php $_from = get_child_tree_best($GLOBALS[smarty]->_var[childs][id]); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'child_best');$this->_foreach['child_best'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['child_best']['total'] > 0):
    foreach ($_from AS $this->_var['child_best']):
        $this->_foreach['child_best']['iteration']++;
?> 
              <?php if ($this->_var['child_best']['url']): ?>
             
              <div class="item-channels">
                <div class="channels"> <a href="<?php echo $this->_var['child_best']['url']; ?>" target="_blank" title="<?php echo htmlspecialchars($this->_var['child_best']['name']); ?>"><?php echo htmlspecialchars($this->_var['child_best']['name']); ?><i>&gt;</i></a> </div>
              </div>
              
              <?php endif; ?> 
              <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?> 
              <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
              <div class="subitems"> 
                <?php $_from = $this->_var['cat']['cat_id']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'child');$this->_foreach['namechild'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['namechild']['total'] > 0):
    foreach ($_from AS $this->_var['child']):
        $this->_foreach['namechild']['iteration']++;
?>
                <dl class="fore1">
                  <dt> <a href="<?php echo $this->_var['child']['url']; ?>" target="_blank" title="<?php echo htmlspecialchars($this->_var['child']['name']); ?>"><?php echo htmlspecialchars($this->_var['child']['name']); ?><i>&gt;</i></a> </dt>
                  <dd> 
                    <?php $_from = $this->_var['child']['cat_id']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'childer');$this->_foreach['childername'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['childername']['total'] > 0):
    foreach ($_from AS $this->_var['childer']):
        $this->_foreach['childername']['iteration']++;
?> 
                    <a href="<?php echo $this->_var['childer']['url']; ?>" target="_blank" title="<?php echo htmlspecialchars($this->_var['childer']['name']); ?>"><?php echo htmlspecialchars($this->_var['childer']['name']); ?></a> 
                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?> 
                  </dd>
                </dl>
                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?> 
              </div>
            </div>
            <div class="item-right fr">
              <div class="item-brands">
                <div class="brands-inner"> 
                  <?php $_from = get_brands1($GLOBALS[smarty]->_var[cat][id]); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'bchilder');$this->_foreach['bchilder'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['bchilder']['total'] > 0):
    foreach ($_from AS $this->_var['bchilder']):
        $this->_foreach['bchilder']['iteration']++;
?> 
                  <?php if ($this->_foreach['bchilder']['iteration'] < 9): ?> <a href="<?php echo $this->_var['bchilder']['url']; ?>" class="img-link" target="_blank" title="<?php echo htmlspecialchars($this->_var['bchilder']['brand_name']); ?>"> <img src="data/brandlogo/<?php echo $this->_var['bchilder']['brand_logo']; ?>" width="90" height="36" /> </a> <?php endif; ?> 
                  <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?> 
                </div>
              </div>
              <?php
                 $cat_info = get_cat_info_ex($GLOBALS['smarty']->_var['cat']['id']);
            
                $GLOBALS['smarty']->assign('index_image',get_advlist('导航菜单-分类ID'.$cat_info['cat_id'].'-促销专题', 2));
                  ?>
              <?php if ($this->_var['index_image']): ?>
              <div class="item-promotions"> <?php $_from = $this->_var['index_image']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'ad');$this->_foreach['index_image'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['index_image']['total'] > 0):
    foreach ($_from AS $this->_var['ad']):
        $this->_foreach['index_image']['iteration']++;
?> <a href="<?php echo $this->_var['ad']['url']; ?>" class="img-link" target="_blank"><img src="<?php echo $this->_var['ad']['image']; ?>"  width="182" /></a> <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?> </div>
              <?php endif; ?> 
            </div>
          </div>
        </div>
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?> 
      </div>
      </div>
      <div class="allnav fl" id="nav">
        <ul>
          <li><a class="nav" href="index.php" title="首页">首页</a></li>
          <?php $_from = $this->_var['navigator_list']['middle']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'nav');$this->_foreach['nav_middle_list'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['nav_middle_list']['total'] > 0):
    foreach ($_from AS $this->_var['nav']):
        $this->_foreach['nav_middle_list']['iteration']++;
?>
          <li><a class="nav <?php if ($this->_var['nav']['active'] == 1): ?>current<?php endif; ?>" href="<?php echo $this->_var['nav']['url']; ?>" title="<?php echo $this->_var['nav']['name']; ?>" <?php if ($this->_var['nav']['opennew'] == 1): ?>target="_blank" <?php endif; ?>><?php echo $this->_var['nav']['name']; ?></a></li>
          <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        </ul>
      </div>
  </div>
</div>
<script type="text/javascript">
//<![CDATA[

function checkSearchForm()
{
    if(document.getElementById('keyword').value)
    {
	var frm  = document.getElementById('searchForm');
	var type = parseInt(document.getElementById('searchtype').value);
	frm.action = type==0 ? 'search.php' : 'stores.php';
        return true;
    }
    else
    {
	alert("请输入关键词！");
        return false;
    }
}

function myValue1()
{
	document.getElementById('keyword').value = "请输入商品名称或编号...";
}

function myValue2()
{
	document.getElementById('keyword').value = "";
}

//]]>
$('.search-type li').click(function() {
    $(this).addClass('cur').siblings().removeClass('cur');
    $('#searchtype').val($(this).attr('num'));
});
$(function(){
	//图片放大效果
    $(".header-right img").bubbleup({scale:100});
	
	//头部搜索
	$('.search-type').hover(function(){
		$(this).css({"height":"auto","overflow":"visible"});
	},function(){
		$(this).css({"height":32,"overflow":"hidden"});
	});
	
});

function _show_(h, b) {
	if (!h) {
		return
	}
	if (b && b.source && b.target) {
		var d = (typeof b.source == "string") ? M.$("#" + b.source) : b.source;
		var e = (typeof b.target == "string") ? M.$("#" + b.target) : b.target;
		if (d && e && !e.isDone) {
			e.innerHTML = d.value;
			d.parentNode.removeChild(d);
			if (typeof b.callback == "function") {
				b.callback()
			}
			e.isDone = true
		}
	}
	M.addClass(h, "hover");
	if (b && b.isLazyLoad && h.isDone) {
		var g = h.find("img");
		for (var a = 0, c = g.length; a < c; a++) {
			var f = g[a].getAttribute("data-src_index_menu");
			if (f) {
				g[a].setAttribute("src", f);
				g[a].removeAttribute("data-src_index_menu")
			}
		}
		h.isDone = true
	}
}
function _hide_(a) {
	if (!a) {
		return
	}
	if (a.className.indexOf("hover") > -1) {
		M.removeClass(a, "hover")
	}
}
</script>
<script type="text/javascript" src="themes/68ecshopcom_360buy/js/nav.js"></script>
