<?php


//{{{ axlm
//购物激活账户      
function axlmpc($user_id,$order_id,$order_amount,$good_amount){
    $ecs = $GLOBALS['ecs'];
    $db = $GLOBALS['db'];
    $usql = "SELECT * FROM " . $ecs->table('pc_user')."WHERE uid = '$user_id'";
    $pcuserinfo = $db->getRow($usql);
    $tuijianren_user_id = $pcuserinfo['tuijianren_user_id'];
    $jiedianren_user_id = $pcuserinfo['jiedianren_user_id'];
    
    
    if($order_id){
        //step 1: 激活账户，设置pc_user.status = 1 ,  level=2,3,4
        $level_sql = "SELECT * FROM " . $ecs->table('pc_user_level')."";
        $level_list = $db->getAll($level_sql);
        $level = 0;
        if($level_list){
            foreach($level_list as $k=>$v){
                if($v['level_limit_note'] == $good_amount){
                    $level = $v['id'];
                }
            }
        }
        pc_set_user_status($user_id, $status, $level,'购物');
        //step 2: 设置金融账户变更
        
        //step 3: 推广
        //pc_set_fuwu_butie($user_id);
        //
        //step 4: 服务
        pc_set_fuwu_butie($user_id);
    
        //step 5: 见点
        pc_set_jiandian_butie($user_id);
        //step 6: 管理补贴
        
        //step 7: 联盟商家补贴
        
        //step 8: 服务中心补贴
        
        //step 9: 
    }
}

function pc_set_user_status($user_id, $status,$level,$note=''){
    $ecs = $GLOBALS['ecs'];
    $db = $GLOBALS['db'];
    if($level != 0){
        $sql = "update ".$ecs->table("pc_user")." set status = 1 and level = $level where uid = $user_id ";
        $db->query($sql);
        pc_save_user_change_log($user_id,'status',$status,$note,0);
        pc_save_user_change_log($user_id,'level',$level,'',0);
    }else{
        $sql = "update ".$ecs->table("pc_user")." set status = 1 where uid = $user_id ";
        $db->query($sql);
        pc_save_user_change_log($user_id,'status',$status,$note,0);
    }
    
}

//系统变化， adminid = 0
function pc_save_user_change_log($uid,$field_name,$new_value,$note,$adminid){
    $ecs = $GLOBALS['ecs'];
    $db = $GLOBALS['db'];
    
    $sql = "SELECT $field_name FROM " . $ecs->table('pc_user')."WHERE uid = '$uid'";
    $row = $db->getRow($sql);
    $original_value = 0;
    if($row){ $original_value = $row[$field_name];}
    
    $sql = "insert into ".$ecs->table('pc_user_change_log')."(uid,type,name,original_value,new_value,note,adminid,ctime)values(".
            "'".$uid."',".
            "'baseinfo',".
            "'".$field_name."',".
            "'".$original_value."',".
            "'".$new_value."',".
            "'".$note."',".
            "'".$adminid."',".
            "'".time()."'".
            ")";
    //echo "<br>$sql<br>";
    $db->query($sql);
    
}

function get_user_parent_tuijian_array($uid,&$parent_array){
    $info = get_pc_user_allinfo($uid);
    //var_dump($info);
    if(!$info['tuijianren_user_id']){
        
    }else{
        $parent_array[] = $info['tuijianren_user_id'];
        get_user_parent_tuijian_array($info['tuijianren_user_id'], $parent_array);
    }
    return $parent_array;
}

function get_user_parent_array($uid,&$parent_array){
    $info = get_pc_user_allinfo($uid);
    //var_dump($info);
    if(!$info['jiedianren_user_id']){
        
    }else{
        $parent_array[] = $info['jiedianren_user_id'];
        get_user_parent_array($info['jiedianren_user_id'], $parent_array);
    }
    return $parent_array;
}

function get_top_user_same_parent($cengNum,$uid1,$uid2){
     $uid1_info = get_pc_user_allinfo($uid1);
     $uid2_info = get_pc_user_allinfo($uid2);
     
     $uid1_p_arr = array();
     $uid2_p_arr = array();
     $uid1_p_arr = get_user_parent_array($uid1,$uid1_p_arr);
     $uid2_p_arr = get_user_parent_array($uid2,$uid2_p_arr);
//     var_dump($uid1_p_arr);
//     var_dump($uid2_p_arr);
    if($cengNum){
        
    }
    $same_parent = 0;
    if(count($uid1_p_arr)>count($uid2_p_arr)){
        if($uid1_p_arr){
            foreach($uid1_p_arr as $k=>$v){
                if($v == $uid2_p_arr[$k]){
                    $same_parent = $v;
                    break;
                }
            }
        }
    }else{
        if($uid2_p_arr){
            foreach($uid2_p_arr as $k=>$v){
                if($v == $uid1_p_arr[$k]){
                    $same_parent = $v;
                    break;
                }
            }
        }
    }
    
    return $same_parent;
}


//value = yes,no,beyes
function save_user_status_log($uid,$field,$value){
    $ecs = $GLOBALS['ecs'];
    $db = $GLOBALS['db'];
    
    $sql = "select * from ".$ecs->table('pc_user_status_log')." where uid = $uid ";
    $check = $db->getRow($sql);
    if($check){
        if($field == 'fuwu'){
                $usql = "update ".$ecs->table('pc_user_status_log')." set is_fuwu = '".$value."', fuwu_used_time = ".time()." where uid = $uid ";
        }elseif($field == 'tuiguang'){
                $usql = "update ".$ecs->table('pc_user_status_log')." set is_tuiguang = '".$value."', tuiguang_used_time = ".time()." where uid = $uid ";
        }elseif($field == 'jiandian'){
                $usql = "update ".$ecs->table('pc_user_status_log')." set is_jiandian = '".$value."', jiandian_used_time = ".time()." where uid = $uid ";
        }elseif($field == 'guanli'){
                $usql = "update ".$ecs->table('pc_user_status_log')." set is_guanli = '".$value."', guanli_used_time = ".time()." where uid = $uid ";
        }
    }else{
        if($field == 'fuwu'){
                $usql = "insert into ".$ecs->table('pc_user_status_log')."(uid,is_fuwu,fuwu_used_time)values('".$uid."','".$value."','".time()."') ";
        }elseif($field == 'tuiguang'){
                $usql = "insert into ".$ecs->table('pc_user_status_log')."(uid,is_tuiguang,tuiguang_used_time)values('".$uid."','".$value."','".time()."') ";
        }elseif($field == 'jiandian'){
                $usql = "insert into ".$ecs->table('pc_user_status_log')."(uid,is_jiandian,jiandian_used_time)values('".$uid."','".$value."','".time()."') ";
        }elseif($field == 'guanli'){
                $usql = "insert into ".$ecs->table('pc_user_status_log')."(uid,is_guanli,guanli_used_time)values('".$uid."','".$value."','".time()."') ";
        }
    }
    pc_log($usql,"save_user_status_log");
    return $db->query($usql);
}

function get_top_user($uid){
    $ecs = $GLOBALS['ecs'];
    $db = $GLOBALS['db'];
    
    $sql = "select jiedianren_user_id from ".$ecs->table('pc_user')." where uid = $uid ";
    $jiedian = $db->getRow($sql);
//    pc_log($sql,'get_top_user');
    if(!$jiedian){ return 0;}
    if($jiedian['jiedianren_user_id'] == 0){
        return $uid;
    }else{
        return get_top_user($jiedian['jiedianren_user_id']);
    }
}
function get_pc_user_allinfo($uid){
    $ecs = $GLOBALS['ecs'];
    $db = $GLOBALS['db'];
    
    $sql = "SELECT u.*,log.is_tuiguang,log.is_fuwu,log.is_jiandian, log.is_guanli FROM " . $ecs->table('pc_user')." u left join ".$ecs->table('pc_user_status_log')." log on u.uid = log.uid WHERE u.uid = '$uid' and u.status = 1 ";
//    pc_log($sql,'get_pc_user_allinfo');
    return $db->getRow($sql);
}

function getAllUserList($uid,&$data){
	$db = $GLOBALS['db'];
	$ecs = $GLOBALS['ecs'];

	//$sql = "select uid , tuijianren_user_id, jiedianren_user_id, leftright, u.user_name,u.reg_time , from_unixtime(u.reg_time,'%Y-%m-%d %H-%i-%s') as reg_time_format from ".$ecs->table('pc_user')." pu left join ".$ecs->table('users')." u on pu.uid = u.user_id where tuijianren_user_id = ".$uid;
	//echo "<br>".$sql;
         $sql = "SELECT u.*,log.is_tuiguang,log.is_fuwu,log.is_jiandian, log.is_guanli FROM " . $ecs->table('pc_user')." u left join ".$ecs->table('pc_user_status_log')." log on u.uid = log.uid WHERE u.tuijianren_user_id = '$uid' and u.status = 1 ";
        //echo $sql;
 
	$nextuser = $db->getAll($sql);
	
	if($nextuser){
		foreach($nextuser as $k=>$v){
                    $data[] = $v;
                    getAllUserList($v['uid'],$data);
		}
	}else{
		return $data;
	}
	
	
}
function getUserCentNum($uid){
    $data = array();
    $data = getCengData($uid);
//    $top_uid = get_top_user($uid);
//    $data = getCengjiList($top_uid,1,$data);
//    pc_log($data,'getUserCentNum');
    $cengNum = 0;
    foreach($data as $k=>$v){
        if($v){
            foreach($v as $kk=>$vv){
                if($vv['uid'] == $uid){
                    $cengNum = $k;
                }
            }
        }
    }
//    pc_log($cengNum,' Ceng Num');
    return array("cengNum"=>$cengNum,'cengList'=>$data);
}
//顶级userid ,uid的层
//
function getCengjiList($uid,$dengji, &$data){
    $db = $GLOBALS['db'];
    $ecs = $GLOBALS['ecs'];

    if($dengji == 1){
        $data = array();
        $data[1]=array($uid);
         getCengjiList($uid,$dengji+1,$data);
    }else{
        
        $sql = "select uid from ".$ecs->table('pc_user')." where jiedianren_user_id = $uid ";
//        pc_log($sql,"getCentjiList");
        $nextlist = $db->getAll($sql);
        if($nextlist){
            foreach($nextlist as $k=>$v){
                $data[$dengji][] = $v['uid'];
                getCengjiList($v['uid'],$dengji+1,$data);
            }
        }else{
            return;
        }
    }
    
    return $data;
}
//等级层的详细信息
function getCengData($uid){
    $top_uid = get_top_user($uid);
    $data = array();
    $ceng_data = getCengjiList($top_uid, 1, $data);
    $user_cent_all_info = array();
    if($ceng_data){
        foreach($ceng_data as $k=>&$v){
            if($v){
                foreach($v as $kk=>&$vv){
                    $vv = get_pc_user_allinfo($vv);
                }
            }
            
        }
    }
    return $ceng_data;
}
function pc_log($body,$title=''){
    $test = 1;
    if($test){
        echo "<br>===== {{{ $title ==========<br>";
        if(is_array($body)){
            var_dump($body);
        }else{
            echo "<br>$body<br>";
        }
        echo "<br>===== }}} ==========<br>";
    }
}


//}}}

//{{{ 服务补贴

//{{{服务补贴计算
function pc_set_fuwu_butie($uid){
    $ecs = $GLOBALS['ecs'];
    $db = $GLOBALS['db'];
    
    $cenginfo = getUserCentNum($uid);
    $cengNum = $cenginfo['cengNum'];
    $cengList = $cenginfo['cengList'];
    
//    echo "层数:".$cengNum;
    
    if($uid){
        $pcuserinfo = get_pc_user_allinfo($uid);
        //pc_log($pcuserinfo,"pc_set_fuwu_butie");
        $tuijianren_user_id = $pcuserinfo['tuijianren_user_id'];
        $jiedianren_user_id = $pcuserinfo['jiedianren_user_id'];
        
        $level = intval($pcuserinfo['level']);
        $is_fuwu = $pcuserinfo['is_fuwu'];
        $cengUser = $cengList[$cengNum];
        
//        var_dump($cengUser);
        if($cengUser){
            $is_fuwu_pengdui = false;
            foreach($cengUser as $k=>$v){
                //判断当前层是否碰过对
                if($v['is_fuwu'] == 'yes'){
                    $is_fuwu_pengdui = true;
                }
            }
            //已经碰对
            if($is_fuwu_pengdui){
                //save_user_status_log($uid,"fuwu",'beyes');
                return 1;
            }else{
                //当前层没有碰过对,则说明，这层只有一个人或者还没有人
                //只有高级会员即以上才能参与服务补贴, 且没有参与过的，也只能返利给高级会员及之上，每层一次， 最先达成的碰， 碰完这层结束
                foreach($cengUser as $k=>$v){
//                    echo $v['uid']."(".$v['level'].")--VS--".$uid."<br>";
                    //碰对的和自己不能是同一个人， 且两人必须同时达到高级及以上
                    if($v['uid'] != $uid && $v['level']>2 && $level>2){
                        //碰对
                        //情况1， 同一个接点人下的左右区碰
                        if($v['jiedianren_user_id'] == $jiedianren_user_id){
                            $jiedianren_info = get_pc_user_allinfo($jiedianren_user_id);
                            if($jiedianren_info && $jiedianren_info['level']>2){//返利用户必须是高级及以上
                                save_fuwu_fanli($jiedianren_user_id,$jiedianren_info);
                                save_user_status_log($v['uid'], "fuwu", 'yes');
                                save_user_status_log($uid, "fuwu", 'yes');
                            }
                        }else{ //不是同一个接点人
                         
                            $p_uid = get_top_user_same_parent($cengNum,$v['uid'],$uid);
                            $p_uid_info = get_pc_user_allinfo($p_uid);
//                            echo "<br>puid".$p_uid."<br>";
                            if($p_uid_info && $p_uid_info['level']>2){ //返利用户必须是高级及以上
                                save_fuwu_fanli($p_uid,$p_uid_info);
                                save_user_status_log($v['uid'], "fuwu", 'yes');
                                save_user_status_log($uid, "fuwu", 'yes');
                            }
                        }
                    }
                }

            }
            
        }
    }
}
//计算服务返利
function save_fuwu_fanli($uid,$userinfo){
	$db = $GLOBALS['db'];
        $ecs = $GLOBALS['ecs'];
        pc_log("",'save fuwu fanli');
        $config = $db->getRow("select svalue from ".$ecs->table('pc_config')." where sname = 'fuwu_ticheng'");
        $fuwu_ticheng = $config['svalue']?intval($config['svalue']):0;
        $change_value = $fuwu_ticheng;
        
	$original_value = intval($userinfo['account_xianjinbi']);
        $new_value = $original_value + $change_value;
        
        $sql = "update ".$ecs->table('pc_user')." set account_xianjinbi = ".$new_value." where uid = ".$uid;
	$db->query($sql);
        
	$sql = "insert into ".$ecs->table('pc_user_account_log')."(uid,type,original_value,change_value,new_value,note,adminid,ctime) values(".
		"'".$uid."',".
		"'account_xianjinbi',".
		"'".$original_value."',".
		"'".$change_value."',".
		"'".$new_value."',".
		"'购物',".
		"'0',".
		"'".time()."' ".
	")";
	$db->query($sql);
}
//}}} 服务补贴
//{{{见点补贴
function pc_set_jiandian_butie($uid){
    $db = $GLOBALS['db'];
    $ecs = $GLOBALS['ecs'];
    $checksql = "select uid,is_jiandian from ".$ecs->table('pc_user_status_log')." where uid = $uid ";
    //echo $checksql;
    $checksql = $db->getRow($checksql);
    if($checksql && $checksql['is_jiandian'] == 'yes'){
        return 1;
    }
   
    $parent_array = array();
    $parent_array = get_user_parent_array($uid,$parent_array);
    $pcuserinfo = get_pc_user_allinfo($uid);
     
    $jiandian_config = $db->getAll("select sname,svalue from ".$ecs->table('pc_config')." where sname in ('jiandian_limit_ceng','jiandian_left_danwei','jiandian_bili_left','jiandian_right_danwei','jiandian_bili_right')");
    $jiandain_config_array = array();
    if($jiandian_config){
       foreach($jiandian_config as $k=>$v){
           $jiandain_config_array[$v['sname']] = $v['svalue'];
       }
    }
    
    $parent_array = array_reverse($parent_array);
    $type = '';
    if(count($parent_array) == 1){
        return 1;
    }elseif(count($parent_array)>=2){
        $ceng2user = $parent_array[1];
        $ceng2userinfo = get_pc_user_allinfo($ceng2user);
        if($ceng2userinfo['leftright'] == 'left'){
            $type = 'left';
        }else{
            $type = 'right';
        }
    }
    
    $jiandian_bili_left = $jiandain_config_array['jiandian_bili_left'];
    $jiandian_bili_right = $jiandain_config_array['jiandian_bili_right'];
    
    $return_bili = "";
    if($type == 'left'){
        $return_bili = $jiandian_bili_left;
    }elseif($type == 'right'){
        $return_bili = $jiandian_bili_right;
    }
    
    if($return_bili){
        
        if($checksql){
            $sql = "update ".$ecs->table('pc_user_status_log')." set is_jiandian = 'yes', jiandian_used_time = '".time()."' where uid = $uid";
        }else{
            $sql = "insert into ".$ecs->table('pc_user_status_log')."(uid,is_jiandian, jiandian_used_time)values('".$uid."','yes','".time()."')";
        }
        $db->query($sql);
        foreach($parent_array as $k=>$u){
            $check_level_sql = "select level from ".$ecs->table('pc_user')." where uid = $u ";
            $u_level = $db->getRow($check_level_sql);
            if($u_level && $u_level['level']>2){
                save_jiandian_fanli($u,$type,$return_bili);
            }else{
                continue;
            }
            $check_level_sql = "";
        }
    }
}
function save_jiandian_fanli($uid,$type,$return_bili){
	$db = $GLOBALS['db'];
        $ecs = $GLOBALS['ecs'];
       
        $userinfo = get_pc_user_allinfo($uid);
        
        $change_value = intval($return_bili);
        if($type == "left"){
            $original_value = intval($userinfo['account_xiaofeibi']);
        }else{
            $original_value = intval($userinfo['account_xiaofeibi_zhuanqu']);
        }
        $new_value = $original_value + $change_value;
        if($type == "left"){
                $sql = "update ".$ecs->table('pc_user')." set account_xiaofeibi = ".$new_value." where uid = ".$uid;
                $db->query($sql);
                 pc_log($sql,'save jiandain fanli');
                $sql = "insert into ".$ecs->table('pc_user_account_log')."(uid,type,original_value,change_value,new_value,note,adminid,ctime) values(".
                        "'".$uid."',".
                        "'account_xiaofeibi',".
                        "'".$original_value."',".
                        "'".$change_value."',".
                        "'".$new_value."',".
                        "'购物',".
                        "'0',".
                        "'".time()."' ".
                ")";
                 pc_log($sql,'save jiandain fanli');
        }else{
                $sql = "update ".$ecs->table('pc_user')." set account_xiaofeibi_zhuanqu = ".$new_value." where uid = ".$uid;
                $db->query($sql);
                 pc_log($sql,'save jiandain fanli');
                $sql = "insert into ".$ecs->table('pc_user_account_log')."(uid,type,original_value,change_value,new_value,note,adminid,ctime) values(".
                        "'".$uid."',".
                        "'account_xiaofeibi_zhuanqu',".
                        "'".$original_value."',".
                        "'".$change_value."',".
                        "'".$new_value."',".
                        "'购物',".
                        "'0',".
                        "'".time()."' ".
                ")";
                 pc_log($sql,'save jiandain fanli');
        } 
	$db->query($sql);
}
//}}}见点补贴

//{{{ 管理补贴
//消费满6000，折合3000pv
//发展下线，1.3w,折合3000pv
function pc_set_guanli_butie($uid,$type){
    $db = $GLOBALS['db'];
    $ecs = $GLOBALS['ecs'];
    pc_log('','pc_set_guanli_butie');
    $userinfo = get_pc_user_allinfo($uid);
    $tuijian_parent_array = array();
    $tuijian_parent_array = get_user_parent_tuijian_array($uid);
    
    pc_log($tuijian_parent_array,'tuijian_paretn_array');
    
    
    
    //给直推线上的人返积分
    if($tuijian_parent_array){
        $sql = "select uid, role,level from ".$ecs->table('pc_user')." where uid in (".implode(",",$tuijian_parent_array).")";
        $ulist = $db->getAll($sql);
        if($ulist){
            foreach($ulist as $k=>$v){
                echo "<br>".$v['uid']."-----".$v['role']."------".$v['level']."<br>";
                $level = $v['level'];
                if($level > 2){ //只给高级会员返
                    //echo "9999";
                    if($type == "goods"){
                        $pv = 3000;
                        save_pv_fanli($v['uid'], $pv, '购物返积分');
                    }elseif($type == 'expends'){
                        $pv = 3000;
                        save_pv_fanli($v['uid'], $pv, '发展下线返积分');
                    }
                }
            }
        }
    }
    
}

function save_pv_fanli($uid,$pv,$note){
        $db = $GLOBALS['db'];
        $ecs = $GLOBALS['ecs'];
       
        $userinfo = get_pc_user_allinfo($uid);
        
        $change_value = intval($pv);
        $original_value = intval($userinfo['account_jifen']);
        
        $new_value = $original_value + $change_value;
        
        $sql = "update ".$ecs->table('pc_user')." set account_jifen = ".$new_value." where uid = ".$uid;
        $db->query($sql);
        pc_log($sql,'save pv fanli');
        $sql = "insert into ".$ecs->table('pc_user_account_log')."(uid,type,original_value,change_value,new_value,note,adminid,ctime) values(".
                "'".$uid."',".
                "'account_jifen',".
                "'".$original_value."',".
                "'".$change_value."',".
                "'".$new_value."',".
                "'".$note."',".
                "'0',".
                "'".time()."' ".
        ")";

	$db->query($sql);
}
//}}}