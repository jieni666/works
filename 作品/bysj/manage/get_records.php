<?php

$user_id = isset($_POST['account']) ? $_POST['account'] : 'null';
$curr = isset($_POST['curr']) ? $_POST['curr'] : '';
//$limit = isset($_POST['limit']) ? $_POST['limit'] : '';
$limit = $_COOKIE['main_num'];

$a['user_id'] = $user_id;
$offset = ($curr>1)?($curr-1)*$limit:$curr-1;

include __DIR__ . "./mainClass.php";
$db = new database();

$res = $db->get_records($user_id,$offset,$limit);
//$a['res'] = $res;
if($res){
    $a['flag'] = 1;
    $a['data'] = $res;
}else{
    $a['flag'] = 0;
    $a['errMsg'] = '数据查询失败！';
}
echo json_encode($a);