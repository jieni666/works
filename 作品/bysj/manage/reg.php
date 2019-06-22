<?php
$account = isset($_POST['account']) ? $_POST['account'] : '';
$username = isset($_POST['username']) ? $_POST['username'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';
$r_password = isset($_POST['r_password']) ? $_POST['r_password'] : '';
$sex = isset($_POST['sex']) ? $_POST['sex'] : '';
$tel = isset($_POST['tel']) ? $_POST['tel'] : '';
$userType = isset($_POST['userType']) ? $_POST['userType'] : '';

$array_post = [
    '账号'   => $account,
    '姓名'   => $username,
    '密码'   => $password,
    '确认密码' => $r_password,
    '性别'   => $sex,
    '联系电话' => $tel,
    '用户类型' => $userType
];
$array_msg = [];
foreach ($array_post as $key => $value) {
    !$value ? array_push($array_msg, $key) : '';
}

include_once './mainClass.php';
$db = new database();

$is_exist = $db->check_user_exist($account);
if ($is_exist) {
    $a['error'] = 1;
    $a['errMsg'] = '此账号已被注册！';
    echo json_encode($a);
    return;
}

if ($array_msg) {
    $str         = implode(" , ", $array_msg) . "必须填写";
    $a['error']  = 1;
    $a['errMsg'] = $str;
    echo json_encode($a);
    return;
} 
if ($password !== $r_password) {
    $str         = '密码和确认密码不相符';
    $a['error']  = 1;
    $a['errMsg'] = $str;
    echo json_encode($a);
    return;
}

$is_reg = $db -> add_user(array($account,$username,$sex,$password,$tel,$userType));
 if($is_reg){
     $a['error']  = 0;
 }else{
     $a['error'] = 1;
     $a['errMsg'] = '数据写入数据库失败！';
 }
echo json_encode($a);
return;