<?php

include 'mainClass.php';
$db = new database();
$res = $db->overdue();
if ($res < 0) {
    $a['flag']=0;
    $a['errMsg'] = '请注意，超期处理失败！';
} else{
    $a['flag']=1;
}
echo json_encode($a);

