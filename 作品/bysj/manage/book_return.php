<?php
/**
 * Created by PhpStorm.
 * User: izy
 * Date: 2018/4/21
 * Time: 22:32
 */

ini_set('date.timezone','Asia/Shanghai');
include 'mainClass.php';
$db = new database();

$record_id = isset($_POST['rid']) ? $_POST['rid'] : '';
$return_time = date('Y-m-d H:i:s', time());
$book_id = isset($_POST['book_id']) ? $_POST['book_id'] : '';

if ($record_id == '') {
    $a['flag'] = 0;
    $a['errMsg'] = '借阅信息传输失败！';
    echo json_encode($a);
    return;
}

$res = $db->book_return("$record_id", "$return_time");
if ($res < 0) {
    $a['flag'] = 0;
    $a['errMsg'] = '书籍归还失败！';
    echo json_encode($a);
    return;
}

$res = $db->update_had_num('-1', "$book_id");
if ($res) {
    $a['flag'] = 1;
} else {
    $a['flag'] = 0;
    $a['errMsg'] = '书籍在库数量更新失败！';
}

echo json_encode($a);