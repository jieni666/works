<?php
/**
 * Created by PhpStorm.
 * User: izy
 * Date: 2018/4/15
 * Time: 14:13
 */

include './mainClass.php';
$db = new database();

$user_id = isset($_POST['account'])? $_POST['account'] : '';
$action =  isset($_POST['action']) ? $_POST['action'] : '';
if ($action){
    $res = $db ->has_record($user_id);
    if(!$res){
        $a['flag'] = 0;
        $a['errMsg'] = '此用户没有借阅记录！';
        echo json_encode($a);
        return;
    }
}

$res = $db ->get_records_num($user_id);
if($res){
    $a['flag'] = 1;
    $a['data'] = $res;
}else{
    $a['flag'] = 0;
    $a['errMsg'] = '数据查询失败！';
}
echo json_encode($a);