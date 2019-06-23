<?php
//声明变量
session_start();
$id = isset($_SESSION['id'])?$_SESSION['id']:"";
$content = isset($_POST['content'])?$_POST['content']:"";
$time = time();
$time =date("Y-m-d H:i:s",$time);
if ($content=="" )
{
    echo "<script>alert('内容不能为空！'); history.go(-1);</script>";
    return;
}

include "./main.php";
$db= new database();

$res=$db->user_create_task(array($id,$content,$time));

if ($res) {
    echo "<script>alert('发布成功！');location.href='./myself-task.php';</script>";}
else{
    echo "<script>alert('发布失败！');history.go(-1);</script>";
}
