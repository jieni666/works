<?php
//声明变量
session_start();
$username = isset($_POST['username'])?$_POST['username']:"";
$pw = isset($_POST['password'])?$_POST['password']:"";
$re_password = isset($_POST['re_password'])?$_POST['re_password']:"";
$admin_id=isset($_SESSION['id'])?$_SESSION['id']:"";
$user_email=isset($_POST['email'])?$_POST['email']:"";
$photo=isset($_POST['photo'])?$_POST['photo']:"";
if ($username=="" || $pw=="" || $re_password=="")
{
    echo "<script>alert('请输入用户名或密码！'); history.go(-1);</script>";
    return;
}
if($pw != $re_password) {
    echo "<script>alert('密码不一致！'); history.go(-1);</script>";
    return;
}
$pw=md5($pw);
include "./main.php";
$db= new database();
$ret4=$db->add_user(array($username,$pw,$admin_id));
if ($ret4) {
    echo "<script>alert('注册成功！');location.href='./login.html';</script>";}
else{
    echo "<script>alert('注册失败！');history.go(-1);</script>";
}



