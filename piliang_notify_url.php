<?php
/* *
 * ���ܣ�֧�����������첽֪ͨҳ��
 * �汾��3.3
 * ���ڣ�2012-07-23
 * ˵����
 * ���´���ֻ��Ϊ�˷����̻����Զ��ṩ���������룬�̻����Ը����Լ���վ����Ҫ�����ռ����ĵ���д,����һ��Ҫʹ�øô��롣
 * �ô������ѧϰ���о�֧�����ӿ�ʹ�ã�ֻ���ṩһ���ο���


 *************************ҳ�湦��˵��*************************
 * ������ҳ���ļ�ʱ�������ĸ�ҳ���ļ������κ�HTML���뼰�ո�
 * ��ҳ�治���ڱ������Բ��ԣ��뵽�������������ԡ���ȷ���ⲿ���Է��ʸ�ҳ�档
 * ��ҳ����Թ�����ʹ��д�ı�����logResult���ú����ѱ�Ĭ�Ϲرգ���alipay_notify_class.php�еĺ���verifyNotify
 * ���û���յ���ҳ�淵�ص� success ��Ϣ��֧��������24Сʱ�ڰ�һ����ʱ������ط�֪ͨ
 */
define('IN_ECS', true); 
require(dirname(__FILE__) . '/includes/init.php');

require_once(ROOT_PATH."/admin/zhifubao/alipay.config.php");
require_once(ROOT_PATH."/admin/zhifubao/lib/alipay_notify.class.php");
	
$fp = fopen("zhifubao.txt", "a+");
fwrite($fp, "\r\n\r\n\r\n");
fwrite($fp, "\r\n========".Date("Y-m-d H:i:s",time())."=========\r\n");
//����ó�֪ͨ��֤���
$alipayNotify = new AlipayNotify($alipay_config);
$verify_result = $alipayNotify->verifyNotify();

fwrite($fp, json_encode($verify_result));
fwrite($fp, "\r\n=================\r\n");
fwrite($fp, json_encode($_POST));
fwrite($fp, "\r\n=================\r\n");

if($verify_result) {//��֤�ɹ�
	fwrite($fp, "\r\n=======success===[".$_POST['batch_no']."]=======\r\n");
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//������������̻���ҵ���߼������
	$batch_no = $_POST['batch_no'];
	
	//�������������ҵ���߼�����д�������´�������ο�������
	
    //��ȡ֧������֪ͨ���ز������ɲο������ĵ��з������첽֪ͨ�����б�
	
	//��������������ת�˳ɹ�����ϸ��Ϣ
	
	$success_details = $_POST['success_details'];
	
	//��������������ת��ʧ�ܵ���ϸ��Ϣ
	$fail_details = $_POST['fail_details'];
	$fail_array = array();
	$fail_error_msg = array();
	if($fail_details){
		$fail_arr = explode("|",$fail_details);
		foreach($fail_arr as $k=>$v){
			$v_arr = explode("^",$v);
			$fail_array[] = intval($v_arr[0]);
			$fail_error_msg[intval($v_arr[0])] = $v_arr[5];
		}
	}
	$fail_array = array_filter($fail_array);
	fwrite($fp, "\r\n==[[[".json_encode($fail_array)."]]]");
	$sql = "update ".$GLOBALS['ecs']->table('alipy_pay')." set return_status = 'success' , return_success_detail = '".$success_details."', return_fail_detail = '".$fail_details."' where picihao = '".$batch_no."' limit 1";
	$GLOBALS['db']->query($sql);
	fwrite($fp, "\r\n==[[[$sql]]]\r\n");
	$list_sql = "select user_account_id, ua.amount, ua.user_id from ".$GLOBALS['ecs']->table('alipy_pay_tixian')." pt "
			." LEFT JOIN ".$GLOBALS['ecs']->table('user_account')." ua ON pt.user_account_id = ua.id "
			." where pt.picihao = '".$batch_no."' ";
	fwrite($fp, "\r\n==[[[$list_sql]]]\r\n");
	$list = $GLOBALS['db']->getAll($list_sql);
	if($list){
		foreach($list as $k=>$v){
			if(in_array($v['user_account_id'],$fail_array)){
				$sql = "update ".$GLOBALS['ecs']->table('user_account')." set is_paid = 0,alipay_exec_time= ".time().", alipay_return='fail',alipay_error_msg = '".$fail_error_msg[$v['user_account_id']]."'  where id = ".$v['user_account_id']." limit 1";
			}else{
				//���»�Ա�������
				log_account_change($v['user_id'], $v['amount'], 0, 0, 0, '��������,���κ�'.$batch_no, 5);
				$sql = "update ".$GLOBALS['ecs']->table('user_account')." set is_paid = 1,alipay_exec_time= ".time().", alipay_return='success'  where id = ".$v['user_account_id']." limit 1";
			}
			fwrite($fp, "\r\n==[[[$sql]]]");
			$GLOBALS['db']->query($sql);
		}
	}
	
	//�ж��Ƿ����̻���վ���Ѿ����������֪ͨ���صĴ���
		//���û������������ôִ���̻���ҵ�����
		//���������������ô��ִ���̻���ҵ�����
        
	echo "success";		//�벻Ҫ�޸Ļ�ɾ��

	//�����ã�д�ı�������¼������������Ƿ�����
	//logResult("����д����Ҫ���ԵĴ������ֵ�����������еĽ����¼");

	//�������������ҵ���߼�����д�������ϴ�������ο�������
	
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}
else {
    //��֤ʧ��
   fwrite($fp, "\r\n========fail=====".$_POST['batch_no']."====\r\n");
	$sql = "update ".$GLOBALS['ecs']->table('alipy_pay')." set return_status = 'fail' where picihao = '".$batch_no."' limit 1";
	$GLOBALS['db']->query($sql);
	
	$list_sql = "select user_account_id, ua.amount, ua.user_id from ".$GLOBALS['ecs']->table('alipy_pay_tixian')." pt "
			." LEFT JOIN ".$GLOBALS['ecs']->table('user_account')." ua ON pt.user_account_id = ua.id "
			." where pt.picihao = '".$batch_no."' ";
	fwrite($fp, "\r\n==[[[$list_sql]]]\r\n");
	$list = $GLOBALS['db']->getAll($list_sql);
	//$sql = "update ".$GLOBALS['ecs']->table('user_account')." set is_paid = 0,alipay_exec_time= ".time().", alipay_return='fail'  where id = ".$v['user_account_id']." limit 1";
	foreach($list as $k=>$v){
			
				$sql = "update ".$GLOBALS['ecs']->table('user_account')." set is_paid = 1,alipay_exec_time= ".time().", alipay_return='fail'  where id = ".$v['user_account_id']." limit 1";
			
			fwrite($fp, "\r\n==[[[$sql]]]");
			$GLOBALS['db']->query($sql);
		}
	fwrite($fp, "\r\n==[[[$sql]]]");
	$GLOBALS['db']->query($sql);
	
	echo "fail";
	
    //�����ã�д�ı�������¼������������Ƿ�����
    //logResult("����д����Ҫ���ԵĴ������ֵ�����������еĽ����¼");
}
fclose($fp);
?>