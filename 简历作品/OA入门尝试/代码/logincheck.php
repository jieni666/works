<?php
session_start();

$User_name = isset($_POST['admin_name']) ? $_POST['admin_name'] : '';
$pw = isset($_POST['pw']) ? $_POST['pw'] : '';
if($User_name == "" || $pw == "")
{
    echo "<script>alert('请输入用户名或密码！'); history.go(-1);</script>";
    return;
}
$pw=md5($pw);
include "./main.php";
$db= new database();

$ret=$db->should_login('admin_login',array($User_name,$pw));
$ret1=$db->should_login('user_login',array($User_name,$pw));
if ($ret){
    $_SESSION['admin'] = 1;
    $_SESSION['id']=$ret['id'];
    echo "<script>alert('登录成功！');location.href='./';</script>";
}elseif ($ret1){
    $_SESSION['admin'] = 0;
    $_SESSION['id']=$ret1['id'];
    $_SESSION['admin_id']=$ret1['admin_id'];
    echo "<script>alert('登录成功！');location.href='./people-index.php';</script>";
} else{
    echo "<script>alert('用户名或密码不正确！');history.go(-1);</script>";
}