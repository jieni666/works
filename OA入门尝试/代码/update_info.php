<?php
//声明变量
session_start();
$id=isset($_SESSION['id'])?$_SESSION['id']:'';
$admin_id=isset($_SESSION['admin'])?$_SESSION['admin']:'';

$type= $admin_id==1 ? 'admin_login' : 'user_login';
$nickname = isset($_POST['nickname'])?$_POST['nickname']:"";
$update_url = isset($_POST['update_url'])?$_POST['update_url']:"";
$add_url = isset($_POST['add_url'])?$_POST['add_url']:"";
if($update_url){
    rename("$update_url",$add_url.'/headImg.jpg');
}
$photo = $add_url.'/headImg.jpg';
include "./main.php";
$db= new database();
$res=$db->update_info($type,array($photo,$nickname,$id));

if ($res>=0) {
    echo "<script>location.href='./';</script>";}
else{
    echo "<script>history.go(-1);</script>";
}
