<?php
include './mainClass.php';
$db = new database();

$action = isset($_POST['action']) ?$_POST['action'] :  '';
$id = isset($_POST['id']) ?$_POST['id'] :  '';

$res = $db->del($action,$id);

//$a['res'] = $res;
if($res>=0){
    $a['error'] = 1;
}else{
    $a['error'] = 0;
    $a['errMsg'] = '数据删除失败！';
}
echo json_encode($a);