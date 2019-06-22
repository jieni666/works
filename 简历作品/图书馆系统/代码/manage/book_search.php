<?php

$action = isset($_POST['action']) ? $_POST['action'] : '';
$data = isset($_POST['data']) ? $_POST['data'] : '';
$curr = isset($_POST['curr']) ? $_POST['curr'] : '';
$order = isset($_POST['order']) ? $_POST['order'] : '';

// $limit = isset($_POST['limit']) ? $_POST['limit'] : '';
$limit =$order ? $_COOKIE['main_num'] : $_POST['limit'] ;
$a['dat1'] = $order;

$offset = ($curr>1)?($curr-1)*$limit-1:$curr-1;

include __DIR__ . "/mainClass.php";
$db = new database();

if ($action == 1) {
    $res = $db->get_books($offset,$limit);
}else{
  $res = $db->get_search_books($data,$offset,$limit);
}
$a['error'] = 0;
    $a['data'] = $res;
    echo json_encode($a);
    return;
