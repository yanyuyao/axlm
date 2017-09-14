<?php

function getTopCat($catid){
    $ecs = $GLOBALS['ecs'];
    $db = $GLOBALS['db'];
    $sql = "select cat_id,parent_id from ".$ecs->table('category')." where cat_id = $catid ";
//    echo "<br>".$sql."<br>";
    $catinfo = $db->getRow($sql);
    if($catinfo && $catinfo['parent_id']){
        return getTopCat($catinfo['parent_id']);
    }else{
        return $catinfo['cat_id'];
    }
}

function check_zhuanqu_product($oid){
    $ecs = $GLOBALS['ecs'];
    $db = $GLOBALS['db'];
    $sql = "select og.goods_id, og.goods_price,g.cat_id from ".$ecs->table('order_goods')." as og left join ".$ecs->table('goods')." as g on og.goods_id = g.goods_id  where order_id = $oid ";
//    echo "<br>".$sql."<br>";
    $order_goods = $db->getAll($sql);
//    echo mysql_error();
//    var_dump($order_goods);
    $goods_amount = 0;
    if($order_goods){
        foreach($order_goods as $k=>$v){
//            echo "<br>goods_id:".$v['goods_id']."--- cat_id:".$v['cat_id']."<br>";
            $topcat = getTopCat($v['cat_id']);
//            echo "[[[".$topcat."]]]";
            if($topcat == 367){//女性产品的大分类id
                $goods_amount += $v['goods_price'];
            }
        }
        
    }
    return $goods_amount;
}


//获得用户信息 pc_users表
function get_pc_user_allinfo($uid){
    $ecs = $GLOBALS['ecs'];
    $db = $GLOBALS['db'];
    $sql = "select * from ".$ecs->table('pc_user')." where uid = $uid";
//    $sql = "SELECT u.*,log.is_tuiguang,log.is_fuwu,log.is_jiandian, log.is_guanli FROM " . $ecs->table('pc_user')." u left join ".$ecs->table('pc_user_status_log')." log on u.uid = log.uid WHERE u.uid = '$uid' and u.status = 1 ";
//    pc_log($sql,'get_pc_user_allinfo');
    return $db->getRow($sql);
}

//先获得所有的接点人直线数组，每一层循环判断
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
//for 见点奖，区分左右区
function get_user_parent_leftright_array($uid,&$parent_array){
//    echo "<br>$uid<br>";
    $info = get_pc_user_allinfo($uid);
//    var_dump($info);
//    echo "<br>";
    //限制十层
    if(count($parent_array)>=10){ return $parent_array;}
    
    if(!$info['jiedianren_user_id']){ //没有接点人，就是到顶级了
       // $parent_array[] = $info['jiedianren_user_id']."---".$info['leftright'];
    }else{
        $parent_array[] = array(
                                "uid"=>$info['jiedianren_user_id'],
                                "leftright"=>$info['leftright'],
                                "level"=>$info['level']
                                );
        get_user_parent_leftright_array($info['jiedianren_user_id'], $parent_array);
    }
    return $parent_array;
}
//获得用户的，当前层，该类型的返利，是否拿到， 1：已返利，0：未返利
//$type = tuiguangbutie, fuwubutie, jiandianbutue,guanli
function pc_get_user_status_info($uid,$type,$ceng){
    $ecs = $GLOBALS['ecs'];
    $db = $GLOBALS['db'];
    $sql = "select id, user_id, ceng,jiangxiang,jiangxiang_status,ctime,source from ".$ecs->table('pc_user_status')." where user_id = $uid and jiangxiang = '$type' and ceng = '$ceng' ";
//    echo $sql;
    $user_status = $db->getRow($sql);
    //var_dump($user_status);
    if($user_status){
        return $user_status['jiangxiang_status'];
    }
    return 0;
}

//保存用户某类型返利某层状态
function pc_save_user_status_info($uid,$ceng,$jiangxiang,$source=''){
    $ecs = $GLOBALS['ecs'];
    $db = $GLOBALS['db'];
    $sql = "insert into ".$ecs->table('pc_user_status')."(user_id, ceng,jiangxiang,jiangxiang_status,ctime,source)values(".
                "'".$uid."',".
                "'".$ceng."',".
                "'".$jiangxiang."',".
                "'1',".
                "'".time()."','".$source."')";
//    echo $sql;
    return $db->query($sql);
}
//获得该uid下所有层的用户id
function getCengDataByUid($uid){
    $data = array();
    $ceng_data = getCengjiList($uid, 1, $data);
    return $ceng_data;
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

//获得某个用户左右区， 分别第几层的人数
function pc_get_user_ceng_leftright_user($uid,$ceng){
    //echo $uid;
    $ecs = $GLOBALS['ecs'];
    $db = $GLOBALS['db'];
    $leftuser = $db->getOne("select uid from ".$ecs->table('pc_user')." where jiedianren_user_id = $uid and leftright = 'left'");
    $rightuser = $db->getOne("select uid from ".$ecs->table('pc_user')." where jiedianren_user_id = $uid and leftright = 'right'");
    $left_arr = array();
    $right_arr = array();

    //获得左边右边第几层的人数
    if($leftuser){
        $leftceng = getCengDataByUid($leftuser);
        $leftceng_arr = isset($leftceng[$ceng])?$leftceng[$ceng]:array();
    }else{
        $leftceng_arr = array();
    }
    if($rightuser){
        $rightceng = getCengDataByUid($rightuser);
        $rightceng_arr = isset($rightceng[$ceng])?$rightceng[$ceng]:array();
    }else{
        $rightceng_arr = array();
    }
    return array("left"=>count($leftceng_arr), "right"=>count($rightceng_arr),"leftarr"=>$leftceng_arr,"rightarr"=>$rightceng_arr);
}



//计算服务返利
function save_fuwu_fanli($uid,$userinfo=array()){
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
		"'服务补贴',".
		"'0',".
		"'".time()."' ".
	")";
	$db->query($sql);
}
//}}} 服务补贴