<?php
/**
 * Created by PhpStorm.
 * User: lim_zhou
 * Date: 2018/4/25
 * Time: 10:09
 */

include './mainClass.php';
$db = new database();

$id = isset($_POST['id']) ? $_POST['id']: '';
$name =isset($_POST['name']) ? $_POST['name']: '';
$pw = isset($_POST['pw']) ? $_POST['pw']: '';
$sex = isset($_POST['sex']) ? $_POST['sex']: '';
$tel = isset( $_POST['tel']) ? $_POST['tel']: '';
$type = isset($_POST['type']) ? $_POST['type']: '';
$a['s']=$id.'->'.$name.'->'.$pw.'->'.$sex.'->'.$tel.'->'.$type;
$res = $db->user_modify("$id","$name","$pw","$sex","$tel","$type");
if($res>=0){
    $a['error'] = 1;
}else{
    $a['error'] = 0;
    $a['errMsg'] = '数据修改失败！';
}
echo json_encode($a);