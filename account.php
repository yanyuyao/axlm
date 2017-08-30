<?php

/**
 * ECSHOP 会员中心
 * ============================================================================
 * * 版权所有 2005-2012 上海商派网络科技有限公司，并保留所有权利。
 * 网站地址: http://www.ecshop.com；
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和
 * 使用；不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
 * $Author: liubo $
 * $Id: user.php 17217 2011-01-19 06:29:08Z liubo $
 */
define('IN_ECS', true);

require (dirname(__FILE__) . '/includes/init.php');
if($is_show_wap){
$wap_url = "http://365axlm.cn/mobile/";
ecs_header("Location: $wap_url\n");
}
/* 载入语言文件 */
require_once (ROOT_PATH . 'languages/' . $_CFG['lang'] . '/user.php');

$user_id = $_SESSION['user_id'];
$action = isset($_REQUEST['act']) ? trim($_REQUEST['act']) : 'default';

$affiliate = unserialize($GLOBALS['_CFG']['affiliate']);
$smarty->assign('affiliate', $affiliate);

$fenxiao = unserialize($GLOBALS['_CFG']['fenxiao']);
$smarty->assign('fenxiao', $fenxiao);

$back_act = '';

// 不需要登录的操作或自己验证是否登录（如ajax处理）的act
/**
*	default : 默认首页
*   detaillog : 账户明细log
*
*
*
*
*/
$not_login_arr = array(
	'default', 'detaillog','show_expend_users','zhuanzhang'
);
/* 余额额支付密码_更改_END_www.cfweb2015.com */

/* 显示页面的action列表 */
$ui_arr = array(
	'default', 'detaillog','show_expend_users','zhuanzhang','shenqingshop'
); // 代码修改

/* 未登录处理 */
if(empty($_SESSION['user_id']) && $action != 're_validate_email' && $action != 'valid_email')
{
	if(! in_array($action, $not_login_arr))
	{
		if(in_array($action, $ui_arr))
		{
			/*
			 * 如果需要登录,并是显示页面的操作，记录当前操作，用于登录后跳转到相应操作
			 * if ($action == 'login')
			 * {
			 * if (isset($_REQUEST['back_act']))
			 * {
			 * $back_act = trim($_REQUEST['back_act']);
			 * }
			 * }
			 * else
			 * {}
			 */
			$query_string = $_SERVER['QUERY_STRING'];
			if(! empty($query_string))
			{
				if(strpos($query_string, 'findPwd.php') != false)
				{
					$query_string = 'index.php';
				}
				$back_act = 'user.php?' . strip_tags($query_string);
			}
			$action = 'login';
		}
		else
		{
			// 未登录提交数据。非正常途径提交数据！
			// die($_LANG['require_login']);
			show_message($_LANG['require_login'], array(
				'</br>登录', '</br>返回首页'
			), array(
				'user.php?act=login', $ecs->url()
			), 'error', false);
		}
	}
}
//echo $action;
/* 如果是显示页面，对页面进行相应赋值 */
if(in_array($action, $ui_arr))
{
	assign_template();
	$position = assign_ur_here(0, $_LANG['user_center']);
	$smarty->assign('page_title', $position['title']); // 页面标题
	$smarty->assign('ur_here', $position['ur_here']);
	$sql = "SELECT value FROM " . $ecs->table('shop_config') . " WHERE id = 419";
	$row = $db->getRow($sql);
	$car_off = $row['value'];
	$smarty->assign('car_off', $car_off);
	/* 是否显示积分兑换 */
	if(! empty($_CFG['points_rule']) && unserialize($_CFG['points_rule']))
	{
		$smarty->assign('show_transform_points', 1);
	}
	
	$smarty->assign('helps', get_shop_help()); // 网店帮助
	$smarty->assign('data_dir', DATA_DIR); // 数据目录
	$smarty->assign('action', $action);
	$smarty->assign('exec', $action);
	$smarty->assign('lang', $_LANG);
	$smarty->assign('is_account', 1);
}

/* 代码增加_Start By www.cfweb2015.com  用户中心获取会员信息*/

include_once (ROOT_PATH . 'includes/lib_clips.php');

/* 路由 */

$function_name = 'action_' . $action;

if(! function_exists($function_name))
{
	$function_name = "action_default";
}

//echo md5('123456');
call_user_func($function_name);
/* 路由 */

function action_rantest(){
    $uid =18;

    //测试父级array
    //$parent_array = array();
    //$parent_array = get_user_parent_array($uid,$parent_array);
    //var_dump($parent_array);
    
    //测试服务补贴
    //pc_set_fuwu_butie($uid);
    
    //测试见点补贴
    //pc_set_jiandian_butie($uid);
    
    //管理补贴
    //pc_set_guanli_butie($uid,"expends");
    //shengji_pv_account($uid); //pv更新后升级账户，只判断了积分，还没判断左右市场身份站位
    
    //推广补贴
    pc_set_tuiguang_butie($uid);
    
}
/* 代码增加_start By www.cfweb2015.com */
function action_default ()
{
	// 获取全局变量
	$_LANG = $GLOBALS['_LANG'];
	$smarty = $GLOBALS['smarty'];
	$db = $GLOBALS['db'];
	$ecs = $GLOBALS['ecs'];
	$user_id = $_SESSION['user_id'];
	
	$sql = "select * from ".$ecs->table('pc_user')." where uid = ".$user_id;
	//echo $sql;
	$pc_user = $db->getRow($sql);
	$smarty->assign('pc_user',$pc_user);
	
	$data = array();
	getAllUserListByUid($user_id,$data);

	
	$smarty->assign('userTotal', count($data));
	
	$smarty->assign('user_id', $_SESSION['user_id']);
	$smarty->assign('mydomain', $ecs->url());
	
	$smarty->display('user_account.dwt');
}
//明细记录
function action_detaillog()
{
	//pc_user_account_log
	// 获取全局变量
	$_LANG = $GLOBALS['_LANG'];
	$smarty = $GLOBALS['smarty'];
	$db = $GLOBALS['db'];
	$ecs = $GLOBALS['ecs'];
	$user_id = $_SESSION['user_id'];
	
	$sql = "select * from ".$ecs->table('pc_user_account_log')." where uid = ".$user_id;
	//echo $sql;
	$detaillog = $db->getAll($sql);
	
	
	$pc_config = $db->getAll("select * from ".$ecs->table('pc_config')." where sname in('account_xianjinbi','account_xiaofeibi','account_aixinbi','account_jifenbi','account_jifen')");
	$bi_config = array();
	if($pc_config){
		foreach($pc_config as $k=>$v){
			$bi_config[$v['sname']] = $v['svalue'];
		}
	}
	if($detaillog){
		foreach($detaillog as $k=>&$v){
			$v['type'] = $bi_config[$v['type']];
			$v['ctime'] = date("Y-m-d H:i:s",$v['ctime']);
		}
	}
	//var_dump($detaillog);
	$smarty->assign('detaillog',$detaillog);
	$smarty->assign('bi_config', $bi_config);
	$smarty->assign('user_id', $_SESSION['user_id']);
	
	$smarty->display('user_account.dwt');
}

//直推人数记录

function action_show_expend_users()
{
	//pc_user_account_log
	// 获取全局变量
	$_LANG = $GLOBALS['_LANG'];
	$smarty = $GLOBALS['smarty'];
	$db = $GLOBALS['db'];
	$ecs = $GLOBALS['ecs'];
	$user_id = $_SESSION['user_id'];
	
	$data = array();
	getAllUserListByUid($user_id,$data);

	//var_dump($data);
	$smarty->assign('user_id', $_SESSION['user_id']);
	$smarty->assign('userlist', $data);
	
	$smarty->display('user_account.dwt');
}
//转账现金币
function action_zhuanzhang(){
	
	// 获取全局变量
	$_LANG = $GLOBALS['_LANG'];
	$smarty = $GLOBALS['smarty'];
	$db = $GLOBALS['db'];
	$ecs = $GLOBALS['ecs'];
	$user_id = $_SESSION['user_id'];
	
	$xianjinbi = $db->getOne('select account_xianjinbi from '.$ecs->table('pc_user')." where uid = $user_id");
	$xianjinbi = intval($xianjinbi?$xianjinbi:0);
	//echo 'select pwd2 from '.$ecs->table('pc_user')." where uid = $user_id";
	$pwd2 = $db->getOne('select pwd2 from '.$ecs->table('pc_user')." where uid = $user_id");
	$curstep = isset($_REQUEST['step'])?$_REQUEST['step']:'';
	$touser = isset($_REQUEST['touser'])?$_REQUEST['touser']:0;
	$tousername = $db->getOne('select user_name from '.$ecs->table('users')." where user_id = $touser");
	$smarty->assign('tousername',$tousername);
	$step = "default";
	//检查密码
	if($curstep == 'checkpwd'){
		$pwd = isset($_REQUEST['pwd2'])?$_REQUEST['pwd2']:'';
		
		//echo "<br>";echo md5($pwd);echo "000<br>";echo $pwd2;
		
		if(md5($pwd) == $pwd2){
			//echo 'select user_name from '.$ecs->table('users')." where user_id = $touser";
			
			$step = "zhuanzhang";
		}else{
			$msg = "密码不匹配，请重新输入！";
			$smarty->assign("msg",$msg);
			$step = "default";
		}
	}elseif($curstep == 'zhuanzhang'){//执行转账操作
		$amount = intval(isset($_REQUEST['amount'])?$_REQUEST['amount']:0);
		if($xianjinbi < $amount && $amount){
			$msg = "转账金额不能超过您的现金币,并且转账金额不能为0";
			$smarty->assign("msg",$msg);
			$step = 'zhuanzhang';
		}else{
			zhangzhangLog('account_xianjinbi',$user_id,$touser,$amount);
			$step = 'success';
		}
		
	}else{
		$step = "default";
	}
	
	$smarty->assign('step',$step);
	$smarty->assign('user_id', $_SESSION['user_id']);
	$smarty->assign('touser', $touser);
	
	$smarty->display('user_account.dwt');
}

/*
* bizhong : 币种 account_xianjinbi, account_xiaofeibi, account_aixinbi,account_jifenbi, account_jifen,
* uid : 用户id
* touid ：转给uid
* amount : 金额
* 现在可以转账的只有现金币
*/
function zhangzhangLog($bizhong,$from_uid,$to_uid,$amount){
	
	$db = $GLOBALS['db'];
	$ecs = $GLOBALS['ecs'];
	$time = time();
	
	if($bizhong == "account_xianjinbi"){
		$sql = "insert into ".$ecs->table('pc_zhuanzhang_log')."(uid,from_uid,amount,type,ctime,utime)values('".$from_uid."','".$to_uid."','".$amount."','".$bizhong."','".$time."','".$time."')";
		$db->query($sql);
		
		//更改每个人的账号变化记录
		save_user_account_log($from_uid,$bizhong,"-",$amount);
		save_user_account_log($to_uid,$bizhong,"+",$amount);
		
	}
	
}
function save_user_account_log($uid,$type,$amount_type,$amount){
	
	$db = $GLOBALS['db'];
	$ecs = $GLOBALS['ecs'];
	
	$original_value = 0;
	$new_value = 0;
	$adminid = 0;
	$note = '转账';
	$ctime = time();
	
	$original_value = $db->getOne("select account_xianjinbi from ".$ecs->table('pc_user')." where uid = $uid");
	$original_value = intval($original_value);
	if($amount_type == "+"){
		$new_value = $original_value + intval($amount);
	}else{
		$new_value = $original_value - intval($amount);
	}
	$new_value = intval($new_value);
	
	$sql = "insert into ".$ecs->table('pc_user_account_log')."(uid,type,original_value,change_value,new_value,note,adminid,ctime)values('".$uid."','".$type."','".$original_value."','".$amount_type.$amount."','".$new_value."','".$note."','".$adminid."','".$ctime."')";
	$db->query($sql);
	
	$sql = "update ".$ecs->table('pc_user')." set $type = ".$new_value." where uid = $uid limit 1";
	$db->query($sql);
	
}		
//获得用户所以下线列表
function getAllUserListByUid($uid,&$data){
   
	$db = $GLOBALS['db'];
	$ecs = $GLOBALS['ecs'];

	$sql = "select uid , tuijianren_user_id, jiedianren_user_id, leftright, u.user_name,u.reg_time , from_unixtime(u.reg_time,'%Y-%m-%d %H-%i-%s') as reg_time_format from ".$ecs->table('pc_user')." pu left join ".$ecs->table('users')." u on pu.uid = u.user_id where jiedianren_user_id = ".$uid;
//	echo "<br>".$sql;
	$nextuser = $db->getAll($sql);
	
	if($nextuser){
		foreach($nextuser as $k=>$v){
                    $data[] = $v;
                    getAllUserListByUid($v['uid'],$data);
		}
	}else{
		return $data;
	}
	
	
}
// AJAX调用
function action_add_huan_goods ()
{
	$user = $GLOBALS['user'];
	$_CFG = $GLOBALS['_CFG'];
	$_LANG = $GLOBALS['_LANG'];
	$smarty = $GLOBALS['smarty'];
	$db = $GLOBALS['db'];
	$ecs = $GLOBALS['ecs'];
	$user_id = $_SESSION['user_id'];
	
	include_once ('includes/cls_json.php');
	include_once ('includes/lib_order.php');
	$json = new JSON();
	
	$result = array(
		'error' => 0, 'content' => ''
	);
	
	$_POST['goods'] = strip_tags(urldecode($_POST['goods']));
	$_POST['goods'] = json_str_iconv($_POST['goods']);
	$goods = $json->decode($_POST['goods']);
	$spec = $goods->spec;
	$goods_id = $goods->goods_id;
	$goods_name = $db->getOne("select goods_name from " . $ecs->table('goods') . " where goods_id='$goods_id' ");
	
	/* 如果商品有规格则取规格商品信息 配件除外 */
	$sql = "SELECT * FROM " . $GLOBALS['ecs']->table('products') . " WHERE goods_id = '$goods_id' LIMIT 0, 1";
	$prod = $GLOBALS['db']->getRow($sql);
	if(is_spec($spec) && ! empty($prod))
	{
		$product_info = get_products_info($goods_id, $spec);
	}
	$goods_attr = get_goods_attr_info($spec);
	
	$result['error'] = 1;
	$result['goods_name'] = $goods_name . "  ";
	$result['product_id'] = $product_info['product_id'];
	$result['product_id'] = $result['product_id'] == 'null' ? '0' : intval($result['product_id']);
	$result['content'] = addslashes($goods_attr);
	die($json->encode($result));
}


/* 代码增加_end By www.cfweb2015.com */
/* 代码增加2014-12-23 by www.cfweb2015.com _star */
function is_telephone ($phone)
{
	$chars = "/^13[0-9]{1}[0-9]{8}$|15[0-9]{1}[0-9]{8}$|18[0-9]{1}[0-9]{8}$/";
	if(preg_match($chars, $phone))
	{
		return true;
	}
}

function mc_random ($length, $char_str = 'abcdefghijklmnopqrstuvwxyz0123456789')
{
	$hash = '';
	$chars = $char_str;
	$max = strlen($chars);
	for($i = 0; $i < $length; $i ++)
	{
		$hash .= substr($chars, (rand(0, 1000) % $max), 1);
	}
	return $hash;
}

?>
