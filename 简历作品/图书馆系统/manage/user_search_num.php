<?php
/**
 * Created by PhpStorm.
 * User: izy
 * Date: 2018/4/22
 * Time: 15:17
 */

$action = isset($_POST['action']) ? $_POST['action'] : '';
$data = isset($_POST['data']) ? $_POST['data'] : 'null';

include 'mainClass.php';
$db = new database();

$res = $db->get_user_num("$data");
$a['error'] = 0;
$a['data'] = $res;
echo json_encode($a);
return;