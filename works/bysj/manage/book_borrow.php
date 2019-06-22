<?php
/**
 * Created by PhpStorm.
 * User: izy
 * Date: 2018/4/19
 * Time: 23:49
 * PHP vsrsion 7
 */

ini_set('date.timezone', 'Asia/Shanghai');
require './mainClass.php';
$db = new database();

$status = isset($_POST['status']) ? $_POST['status'] : '';
$user_id = isset($_POST['user_account']) ? $_POST['user_account'] : '';
$book_id = isset($_POST['book_id']) ? $_POST['book_id'] : '';
$start_time = time();
$end_time = date('Y-m-d H:i:s', $start_time + 60 * 60 * 24 * 30);
$start_time = date("Y-m-d H:i:s", $start_time);
if ($status) {
    $res = $db->updata_record_status(
        "$start_time",
        "$end_time",
        "$user_id",
        "$book_id"
    );
    if ($res) {
        $a['flag'] = 1;
    } else {
        $a['flag'] = 0;
        $a['errMsg'] = "借阅出错 ：数据无法更新！";
    }
    echo json_encode($a);
    return;
}

$res = $db->has_book($book_id);
if (!$res) {
    $a['flag'] = 0;
    $a['errMsg'] = "查无此书";
    echo json_encode($a);
    return;
}

$res = $db->user_max_borrow_num($user_id);
$max_num = $res;

$row1 = $db->user_has_beyond_books($user_id);
if ($row1 >= $max_num) {
    $a['error'] = 1;
    $a['errMsg'] = '您借书数量已达限制数量' . $max_num . '本，请归还书籍后再借！';
    echo json_encode($a);
    return;
}

$res = $db->is_save_borrow(array($book_id, $user_id, $start_time, $end_time, 1));
if (!$res) {
    $a['flag'] = 0;
    $a['errMsg'] = "借阅记录写入数据库失败！";
    echo json_encode($a);
    return;
}

$res = $db->update_had_num('1', "$book_id");
if (!$res) {
    $a['flag'] = 0;
    $a['errMsg'] = '图书在库数量更新失败！';
} else {
    $a['flag'] = 1;
}

echo json_encode($a);
