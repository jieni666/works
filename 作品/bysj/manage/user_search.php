<?php
/**
 * Created by PhpStorm.
 * User: izy
 * Date: 2018/4/22
 * Time: 15:28
 */

//$action = isset($_POST['action']) ? $_POST['action'] : '';
$data = isset($_POST['data']) ? $_POST['data'] : '';
$curr = isset($_POST['curr']) ? $_POST['curr'] : '';
//$limit = isset($_POST['limit']) ? $_POST['limit'] : '';

$limit = $_COOKIE['main_num'];

$offset = ($curr>1)?($curr-1)*$limit-1:$curr-1;

include __DIR__ . "/mainClass.php";
$db = new database();
$res = $db->get_users_data("$data","$offset","$limit");
$a['error'] = 0;
$a['data'] = $res;
echo json_encode($a);