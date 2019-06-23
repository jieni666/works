<?php
//声明变量
session_start();
$id=isset($_SESSION['id'])?$_SESSION['id']:'';
$admin_id=isset($_SESSION['admin'])?$_SESSION['admin']:'';

$type= $admin_id==1 ? 'admin_login' : 'user_login';

$nickname = isset($_POST['nickname'])?$_POST['nickname']:"";
$sex = isset($_POST['sex'])?$_POST['sex']:"";
$update_url = isset($_POST['update_url'])?$_POST['update_url']:"";
$add_url = isset($_POST['add_url'])?$_POST['add_url']:"";
$email = isset($_POST['email'])?$_POST['email']:"";

if($update_url){
    rename("$update_url",$add_url.'/headImg.jpg');
}
$photo = $add_url.'/headImg.jpg';


include "./main.php";
$db= new database();
$res=$db->change_information($type,array($email,$photo,$nickname,$sex,$id));
//echo $type;
//var_dump(array($email,$photo,$nickname,$sex,$id));
//exit;
if ($res>=0) {
    echo "<script>alert('修改成功！');location.href='./information.php';</script>";}
else{
    echo "<script>alert('修改失败！');history.go(-1);</script>";
}
