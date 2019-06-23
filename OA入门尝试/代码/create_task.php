<?php
//声明变量
session_start();
//php时区设置
date_default_timezone_set('Asia/Chongqing');

$id = isset($_SESSION['id'])?$_SESSION['id']:"";
$content = isset($_POST['content'])?$_POST['content']:"";
$people=isset($_POST['peo'])?$_POST['peo']:"";
$time = time();
$time =date("Y-m-d H:i:s",$time);

if ($content=="" )
{
    echo "<script>alert('内容不能为空！'); history.go(-1);</script>";
    return;
}

include "./main.php";
$db= new database();

$res=$db->create_task(array($id,$people,$content,$time));

if ($res) {
    echo "<script>alert('创建成功！');location.href='./task.php';</script>";}
else{
    echo "<script>alert('创建失败！');history.go(-1);</script>";
}