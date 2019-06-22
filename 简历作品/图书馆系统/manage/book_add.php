<?php
require './mainClass.php';
$db = new database();

$name = isset($_POST['name']) ? $_POST['name'] : '';
$writer = isset($_POST['writer']) ? $_POST['writer'] : '';
$num = isset($_POST['num']) ? $_POST['num'] : '';
$pages = isset($_POST['pages']) ? $_POST['pages'] : '';
$type = isset($_POST['type']) ? $_POST['type'] : '';
$publish = isset($_POST['publish']) ? $_POST['publish'] : '';
$price = isset($_POST['price']) ? $_POST['price'] : '';

$ary = array(
    '图书名称' => $name,
    '作者' => $writer,
    '图书数量' => $num,
    '图书页数' => $pages,
    '图书类型' => $type,
    '出版社' => $publish,
    '图书价格' => $price
);
$Msg = '';
foreach ($ary as $key => $value) {
    $value ? null : $Msg .= $key . '.';
}
if ($Msg) {
    $a['error'] = 0;
    $a['errMsg'] = $Msg . '未填写';
    echo json_encode($a);
    return;
}

$res = $db->check_book_exist(array($name, $publish, $writer));
if ($res) {
    $a['error'] = 0;
    $a['errMsg'] = '图书已经存在！';
    echo json_encode($a);
    return;
}

$res = $db->book_add(
    array(
    $name,
    $writer,
    $num,
    $pages,
    $type,
    $publish,
    $price,
    $num)
);

if ($res >= 0) {
    $a['error'] = 1;
} else {
    $a['error'] = 0;
    $a['errMsg'] = '图书添加失败！';
}

echo json_encode($a);
