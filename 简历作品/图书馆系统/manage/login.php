<?php
session_start();
include_once './mainClass.php';
$db = new database();

$account = isset($_POST['account']) ? $_POST['account'] : '';
$pw = isset($_POST['password']) ? $_POST['password'] : '';
if ($account === '' or $pw === '') {
    $a['error'] = 1;
    $a['errMsg'] = '用户名（密码）不能为空';
    echo json_encode($a);
    return;
}
//判断用户是否存在
$is_exist = $db->check_user_exist($account);
if (!$is_exist) {
    $a['error'] = 1;
    $a['errMsg'] = '此用户不存在！';
    echo json_encode($a);
    return;
}
//判断用户及密码是否命中
$should_login = $db->should_login(array($account, $pw));
if ($should_login) {
    $_SESSION['login'] = $should_login['id'];
    $_SESSION['username']=$should_login['user_name'];
    $_SESSION['userType']=$should_login['user_type'];
    $a['error'] = 0;
    $a['type'] = $should_login['user_type'];
} else {
    $a['error'] = 1;
    $a['errMsg'] = '密码输入错误，请重新输入！';
}
echo json_encode($a);
return;
