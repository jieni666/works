<?php
//声明变量
session_start();
$username = isset($_POST['username'])?$_POST['username']:"";
$pw = isset($_POST['password'])?$_POST['password']:"";
$re_password = isset($_POST['re_password'])?$_POST['re_password']:"";
$user_email=isset($_POST['useremail'])?$_POST['useremail']:"";
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
$ret2=$db->add_admin_user(array($username,$pw,$user_email));

if ($ret2) {
    echo "<script>alert('注册成功！');location.href='./login.html';</script>";}
else{
    echo "<script>alert('注册失败！');history.go(-1);</script>";
}
