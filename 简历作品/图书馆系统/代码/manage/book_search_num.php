<?php
$action = isset($_POST['action']) ? $_POST['action'] : '';
$data = isset($_POST['data']) ? $_POST['data'] : '';

include_once './mainClass.php';
$db = new database();
if ($action == 1) {
    $res = $db->get_books_num();
    $a['error'] = 0;
    $a['data'] = $res;
    echo json_encode($a);
    return;
}
if ($action == 2 && $data === '') {
    $a['error'] = 1;
    $a['errmsg'] = '未输入查询数据！';
    echo json_encode($a);
    return;
}

$res = $db->book_search_num($data);
$a['error'] = 0;
$a['data'] = $res;
echo json_encode($a);
return;