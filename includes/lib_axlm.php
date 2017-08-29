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
        //step 4: 服务
        
        //step 5: 见点
        
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

//服务补贴计算
function pc_set_fuwu_butie($uid){
    $ecs = $GLOBALS['ecs'];
    $db = $GLOBALS['db'];
    
    $cenginfo = getUserCentNum($uid);
    $cengNum = $cenginfo['cengNum'];
    $cengList = $cenginfo['cengList'];
    
    var_dump($cengNum);
    
    if($uid){
        $pcuserinfo = get_pc_user_allinfo($uid);
        //pc_log($pcuserinfo,"pc_set_fuwu_butie");
        $tuijianren_user_id = $pcuserinfo['tuijianren_user_id'];
        $jiedianren_user_id = $pcuserinfo['jiedianren_user_id'];
        
        $level = intval($pcuserinfo['level']);
        $is_fuwu = $pcuserinfo['is_fuwu'];
        $cengUser = $cengList[$cengNum];
        
        var_dump($cengUser);
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
                save_user_status_log($uid,"fuwu",'beyes');
            }else{
                //当前层没有碰过对,则说明，这层只有一个人或者还没有人
                //只有高级会员即以上才能参与服务补贴, 且没有参与过的，也只能返利给高级会员及之上，每层一次， 最先达成的碰， 碰完这层结束
                foreach($cengUser as $k=>$v){
                    //碰对的和自己不能是同一个人， 且两人必须同时达到高级及以上
                    if($v['uid'] != $uid && $v['level']>2 && $level>2){
                        //碰对
                        //情况1， 同一个接点人下的左右区碰
                        if($v['jiedianren_user_id'] == $jiedianren_user_id){
                            $jiedianren_info = get_pc_user_allinfo($jiedianren_user_id);
                            if($jiedianren_info && $jiedianren_info['level']>2){
                                
                            }
                        }
                    }
                }

            }
            
           
        }
    }
}

//value = yes,no,beyes
function save_user_status_log($uid,$field,$value){
    $ecs = $GLOBALS['ecs'];
    $db = $GLOBALS['db'];
    if($field == 'fuwu'){
            $usql = "update ".$ecs->table('pc_user_status_log')." set is_fuwu = '".$value."', fuwu_used_time = ".time()." where uid = $uid ";
    }elseif($field == 'tuiguang'){
            $usql = "update ".$ecs->table('pc_user_status_log')." set is_guanli = '".$value."', tuiguang_used_time = ".time()." where uid = $uid ";
    }elseif($field == 'jiandian'){
            $usql = "update ".$ecs->table('pc_user_status_log')." set is_jiandian = '".$value."', jiandian_used_time = ".time()." where uid = $uid ";
    }elseif($field == 'guanli'){
            $usql = "update ".$ecs->table('pc_user_status_log')." set is_guanli = '".$value."', guanli_used_time = ".time()." where uid = $uid ";
    }
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