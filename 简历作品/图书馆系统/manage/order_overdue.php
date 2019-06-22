<?php
include 'mainClass.php';
$db = new database();
$res1 = $db->get_order_overdue();
//$a['res'] = $res1;
$num=count($res1);
if (!$num){
    $a['flag'] = 1;
    echo  json_encode($a);
    return;
}
$res = $db->order_overdue();
if ($res < 0) {
    $a['flag']=0;
    $a['errMsg'] = '请注意，预定记录超期删除失败！';
    echo  json_encode($a);
    return;
}
foreach ($res1 as $ary){
    $res = $db->update_had_num('1',$ary['book_id']);
}
$a['flag'] = 1;
echo  json_encode($a);
