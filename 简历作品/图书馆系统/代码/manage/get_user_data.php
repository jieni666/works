<?php
/**
 * Created by PhpStorm.
 * User: izy
 * Date: 2018/4/13
 * Time: 8:58
 */

include './mainClass.php';
$db = new database();

$user_id =isset($_POST['user_id']) ? $_POST['user_id'] : '';
$action = isset($_POST['action']) ? $_POST['action'] : '';
$status = $action ? '(4)' : "(1,3)";

if(!$user_id){
    $a['flag'] = 0;
    $a['errMsg'] = '请输入用户账号！';
    echo json_encode($a);
    return;
}

//判断用户名是否存在
$is_exist = $db ->check_user_exist($user_id);
if(!$is_exist){
    $a['flag'] = 0;
    $a['errMsg'] = '此账号不存在！';
    echo json_encode($a);
    return;
}

$res= $db->user_max_borrow_num($user_id);
$max_num = $res;

$borrow_num = $db->user_has_beyond_books($user_id);
$num =  $max_num -$borrow_num;
$a['num'] = $num;
$res = $db->get_user_data($user_id);
if(!$res){
    $a['flag'] = 0;
    $a['errMsg'] = '获取用户数据出错！';
    echo json_encode($a);
    return;
}
$a['ary'] = $res;

$res = $db->get_user_record_num("$user_id","$status");
if($res>=0){
    $a['flag'] = 1;
    $a['record_num'] = $res;
}else{
    $a['flag'] = 0;
    $a['errMsg'] = '查询借阅记录出错！';
}

echo  json_encode($a);