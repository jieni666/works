<?php
include './mainClass.php';
$db = new database();

$id = $_POST['id'];
$user_name = $_POST['user_name'];
$nr = $_POST['nr'];
$time = date('Y-m-d H:i:s',time());

$res = $db->fankui(array($user_name, $time, $nr, $id));
$a['res'] = $res;
if ($res) {
    $a['error'] = 0;
    $a['errMsg'] = "反馈成功 ";
} else {
    $a['error'] = 1;
    $a['errMsg'] = "反馈失败";
}

echo json_encode($a);
