<?php
define('IN_ECS', true);

/* 代码 */
require(dirname(__FILE__) . '/includes/init.php');


/*------------------------------------------------------ */
//-- 列表编辑 ?act=list_edit
/*------------------------------------------------------ */
if ($_REQUEST['act'] == 'default')
{
    $db = $GLOBALS['db'];
    $ecs = $GLOBALS['ecs'];
	/* 检查权限 */
    admin_priv('pc_user_account');
	$pcconfig = array();
	
	$sql = "select * from ".$ecs->table('pc_config')." where display = 1";
	$pcconfig = $db->getAll($sql);
	
	$uid = isset($_REQUEST['uid'])?$_REQUEST['uid']:14;
	$type = isset($_REQUEST['type'])?$_REQUEST['type']:'';
	
	$sql = "select pu.uid , tuijianren_user_id, jiedianren_user_id, leftright, level,role,identity, account_xianjinbi, account_xiaofeibi, account_jifenbi,account_jifen, u.user_name,u.reg_time , u.mobile_phone,from_unixtime(u.reg_time,'%Y-%m-%d %H-%i-%s') as reg_time_format from ".$ecs->table('pc_user')." pu left join ".$ecs->table('users')." u on pu.uid = u.user_id where pu.uid = ".$uid;
	//echo $sql;
	//echo $uid;
	$userinfo = $db->getRow($sql);
	//var_dump($userinfo);
	if($userinfo['tuijianren_user_id']){
		$userinfo['tuijianren_user_name'] = $db->getOne("select user_name from ".$ecs->table('users')." where user_id = ".$userinfo['tuijianren_user_id']);
	}else{
		$userinfo['tuijianren_user_name'] = "";
	}
	if($userinfo['jiedianren_user_id']){
		$userinfo['jiedianren_user_name'] = $db->getOne("select user_name from ".$ecs->table('users')." where user_id = ".$userinfo['jiedianren_user_id']);
	}else{
		$userinfo['jiedianren_user_name'] = "";
	}
	//var_dump($userinfo);
	//$role = $db->getAll("select id,role_name as name from ".$ecs->table('pc_user_role'));
	//$level = $db->getAll("select id,level_name as name from ".$ecs->table('pc_user_level'));
	//$identity = $db->getAll("select id,identity_name as name from ".$ecs->table('pc_user_identity'));
	
	$smarty->assign('pcconfig',$pcconfig);
	$smarty->assign('userinfo',$userinfo);
	$smarty->assign('type',$type);
	$smarty->assign('uid',$uid);
	//$smarty->assign('role',$role);
	//$smarty->assign('level',$level);
	//$smarty->assign('identity',$identity);
    $smarty->display('pc_user_account_money_change.htm');
}


/*------------------------------------------------------ */
//-- 提交   ?act=post
/*------------------------------------------------------ */
elseif ($_REQUEST['act'] == 'post')
{
    /* 检查权限 */
    admin_priv('pc_user_account');
	
	$uid = isset($_REQUEST['uid'])?$_REQUEST['uid']:0;
	$type = isset($_REQUEST['type'])?$_REQUEST['type']:0;
	if(!$uid){
		sys_msg($_LANG['save_fail'], 0);
	}
	
	if($type == 'xianjinbi'){
		
	}elseif($type == 'xiaofeibi'){
		
		
	}elseif($type == 'aixinbi'){


	}elseif($type == 'jifenbi'){
		
	
	}elseif($type == 'jifen'){

	}
	
		
	
	sys_msg('保存成功', 0);
}



?>