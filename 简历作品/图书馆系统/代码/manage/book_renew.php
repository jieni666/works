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
$end_time = isset($_POST['end_time']) ? $_POST['end_time'] : '';
if ($record_id == '' || $end_time=='') {
    $a['flag'] = 0;
    $a['errMsg'] = '借阅信息传输失败！';
    echo json_encode($a);
    return;
}
$end_time = date('Y-m-d H:i:s',strtotime($end_time)+60*60*24*15);
$res = $db-> book_renew("$end_time","$record_id");
if ($res < 0) {
    $a['flag'] = 0;
    $a['errMsg'] = '书籍归还失败！';
} else {
    $a['flag'] = 1;
}

echo json_encode($a);