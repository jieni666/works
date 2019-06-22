<?php
/**
 * Created by PhpStorm.
 * User: izy
 * Date: 2018/4/21
 * Time: 16:33
 */

include './mainClass.php';
$db = new database();

$user_id = isset($_POST['user_id']) ? $_POST['user_id'] : '';
$action = isset($_POST['action']) ? $_POST['action'] : '';
$status = $action ? '(4)' : "(1,3)";

$res = $db->get_user_borrow_books("$user_id","$status");
if($res>=0){
    $a['flag'] = 1;
    $a['data'] = $res;
}else{
    $a['flag'] = 0;
    $a['errMsg'] = '获取用户借阅书籍出错！';
}
echo  json_encode($a);
