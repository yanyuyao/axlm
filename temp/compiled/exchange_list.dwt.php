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
<link rel="stylesheet" type="text/css" href="themes/68ecshopcom_360buy/css/exchange.css" />
<script type="text/javascript" src="themes/68ecshopcom_360buy/js/jquery-1.9.1.min.js" ></script>
<?php echo $this->smarty_insert_scripts(array('files'=>'jquery.json.js,transport.js')); ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'common.js')); ?>
</head>
<body>
<?php echo $this->fetch('library/page_header.lbi'); ?>
<div class="margin-w1210 clearfix">
  	<?php echo $this->fetch('library/ur_here.lbi'); ?>
    <div id="JS_slider" class="act-slider fl">
      <div class="stage">
        <table id="JS_slide_stage" cellpadding="0" spellcheck="0" border="0">
          <tbody>
            <tr>
              <td> <?php $this->assign('ads_id','44'); ?><?php $this->assign('ads_num','1'); ?><?php echo $this->fetch('library/ad_position.lbi'); ?> </td>
              <td> <?php $this->assign('ads_id','45'); ?><?php $this->assign('ads_num','1'); ?><?php echo $this->fetch('library/ad_position.lbi'); ?> </td>
              <td> <?php $this->assign('ads_id','46'); ?><?php $this->assign('ads_num','1'); ?><?php echo $this->fetch('library/ad_position.lbi'); ?> </td>
              <td> <?php $this->assign('ads_id','47'); ?><?php $this->assign('ads_num','1'); ?><?php echo $this->fetch('library/ad_position.lbi'); ?> </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div id="JS_slide_nav" class="nav"> 
      	<a href="javascript:;" class="current"></a> 
        <a href="javascript:;" class=""></a> 
        <a href="javascript:;" class=""></a> 
        <a href="javascript:;" class=""></a> 
      </div>
    </div>
    <div class="spot-goods fr">
    	<?php echo $this->fetch('library/exchange_hot.lbi'); ?>
    </div>
  <div class="blank"></div>
  <div class="act-banner"> 
   <?php $this->assign('ads_id','49'); ?><?php $this->assign('ads_num','1'); ?><?php echo $this->fetch('library/ad_position.lbi'); ?>  
  </div>
  <?php if (isset ( $this->_var['goods_list'] )): ?>
  <div class="blank"></div>
  <?php echo $this->fetch('library/exchange_list.lbi'); ?> 
  <?php endif; ?> 
  <script type="text/javascript">
window.PAGESTR = '/activity-page-1-show_type-0-sort-total_sold_yes_count-order-desc.html';
// 焦点图
$(function(){
    var slider = $('#JS_slider'),
    sliderWidth = 910,
    stage = $('#JS_slide_stage'),
    list = stage.find('img'),
    len = list.length,
    nav = $('#JS_slide_nav a'),
    pTimer,
    index = 0;

    function move(index) {
        var distance = 0 - index * sliderWidth;
        stage.stop(true, false).animate({'margin-left':distance+'px'}, 300);
        nav.removeClass('current').eq(index).addClass('current');
	
        // 图片加载
        var img = list.eq(index)
		var src = new src; 
        img.attr('src',  src );
		
    }

    function auto() {
        move(index);
        index++;
        if ( index == len  ) {
            index = 0
        }
    }
    pTimer = setInterval(function(){
        auto();
    }, 3000);

    slider.hover(function(){
        clearInterval(pTimer);
    }, function(){
        pTimer = setInterval(function(){
            auto();
        }, 5000);
    });

    nav.mouseenter(function(){                                                                      
        index = nav.index(this);
        move(index);
    });
});

// 现货特价
$(function(){
    var item = $('#JS_spot_goods li');
    item.hover(function(){
        item.removeClass('open')
        $(this).addClass('open');
        var img = $(this).find('img'),
        src = img.attr('data-lazy');

        img.attr('src', src);
    });
});
</script>
  <div class="blank"></div>
</div>
<?php echo $this->fetch('library/right_sidebar.lbi'); ?>
<div class="site-footer">
    <div class="footer-related">
  		<?php echo $this->fetch('library/help.lbi'); ?>
  		<?php echo $this->fetch('library/page_footer.lbi'); ?>
  </div>
</div>
</body>
</html>
