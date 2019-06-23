<?php
session_start();
$User_name = isset($_POST['username']) ? $_POST['username'] : '';
$pw = isset($_POST['password']) ? $_POST['password'] : '';
if($User_name == "" || $pw == "")
{
    echo "<script>alert('请输入用户名或密码！'); history.go(-1);</script>";
    return;
}
$pw=md5($pw);
include "./main.php";
$db= new database();
$ret2=$db->should_login('admin_login',array($User_name,$pw));
$ret3=$db->should_login('user_login',array($User_name,$pw));
if ($ret){
    $_SESSION['admin'] = 1;
    $_SESSION['id']=$ret2['id'];
    echo "<script>alert('登录成功！');location.href='./';</script>";
}elseif ($ret3){
    $_SESSION['admin'] = 0;
    $_SESSION['id']=$ret3['id'];
    echo "<script>alert('登录成功！');location.href='./';</script>";
} else{
    echo "<script>alert('用户名或密码不正确！');history.go(-1);</script>";
}
