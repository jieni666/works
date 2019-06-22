<?php
session_start();
include_once './mainClass.php';
$db = new database();
$login=$db->check_user_login();
if($login==0){
    $a['error'] = 1;
    $a['errMsg'] = "您没有登陆不能预定书";
    echo json_encode($a);
    return;
}
$id = isset($_POST['id']) ? $_POST['id'] : '';
$had_num = isset($_POST['hadnum']) ? $_POST['hadnum'] : '';
$user_id = $_SESSION['login'];
$status = 4;
$st_time = time();
$ed_time = time() + 60*60*24*2; 

$result = $db->has_book($id);
if (!$result) {
    $a['error'] = 1;
    $a['errMsg'] = "查无此书";
    echo json_encode($a);
    return;
}
$res= $db->user_max_borrow_num($user_id);
$max_num = $res;

$row1 = $db->user_has_beyond_books($user_id);
if ($row1 >= $max_num ) {
        $a['error'] = 1;
        $a['errMsg'] = '您借书数量已达限制数量'.$max_num.'本，请归还书籍后再借！';
        echo json_encode($a);
        return;
}
    $result1 = $db->user_has_this_book($id, $user_id);
    if ($result1) {
        $a['error'] = 1;
        $a['errMsg'] = "您已预定过此书！！";
        echo json_encode($a);
        return;
    }
    $result2 = $db->is_save_borrow(array($id, $user_id, date("Y-m-d", $st_time), date("Y-m-d", $ed_time), $status));
    if (!$result2) {
        $a['error'] = 1;
        $a['errMsg'] = "仓库数量减1有错";
        echo json_encode($a);
        return;
    }
    $r = $db->update_had_num('1', "$id");
    $a['error'] = 0;
    $a['errMsg'] = $r;
    echo json_encode($a);
    return;
