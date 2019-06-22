<?php

include './mainClass.php';
$db = new database();

$id = isset($_POST['id']) ?$_POST['id'] :  '';
$name = isset($_POST['name']) ?$_POST['name'] :  '';
$writer = isset($_POST['writer']) ?$_POST['writer'] :  '';
$number = isset($_POST['number']) ?$_POST['number'] :  '';
$price = isset($_POST['price']) ?$_POST['price'] :  '';
$page = isset($_POST['pages']) ?$_POST['pages'] :  '';
$type = isset($_POST['type']) ?$_POST['type'] :  '';
$publish = isset($_POST['publish']) ?$_POST['publish'] :  '';

$res = $db->book_modify($name,$writer,$publish,$number,$price,$type,$page,$id);

if($res>=0){
    $a['error'] = 1;
}else{
    $a['error'] = 0;
    $a['errMsg'] = '数据修改失败！';
}
echo json_encode($a);