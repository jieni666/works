<?php
session_start();

include "./main.php";
$delete= new database();
//$id=isset($_SESSION['id'])?$_SESSION['id']:''
$id= isset($_GET['id']) ? $_GET['id'] : '';

/*print_r($id);
exit;*/
if ($id){
    $res1=$delete->delete_user($id);
    echo "<script>alert('删除成功！');location.href='./people-information.php';</script>";
}else{
    echo "<script>alert('删除失败！');history.go(-1);</script>";
}
