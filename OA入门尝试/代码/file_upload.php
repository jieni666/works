<?php
session_start();

// $a['data']=$_FILES;
// echo json_encode($a);
// return;
//1.接收提交文件的用户
$id = isset($_SESSION['login']) ? $_SESSION['login'] : '';
$is_admin = $_SESSION['admin'];
$a['id']=$id;
if (!$id) {
    $a['flag'] = 0;
    $a['errMag'] = '参数获取失败 !';
    echo json_encode($a);
    return;
}
// $username=$_POST['username'];
// $fileintro=$_POST['fileintro'];

include './mainClass.php';
$db = new database();

//获取文件的大小
$file_size = $_FILES['file']['size'];
if ($file_size > 10 * 1024 * 1024) {
    $a['flag'] = 0;
    $a['errMag'] = '文件过大，不能上传大于10M的文件';
    echo json_encode($a);
    return;
}
$file_type = $_FILES['file']['type'];
$f_type = $db->check_img_type($file_type);
if (!$f_type['flag']) {
    $a['flag'] = 0;
    $a['errMsg'] = $f_type['Msg'];
    echo json_encode($a);
    return;
}

//判断是否上传成功（是否使用post方式上传）
if (is_uploaded_file($_FILES['file']['tmp_name'])) {
    //把文件转存到你希望的目录（不要使用copy函数）
    $uploaded_file = $_FILES['file']['tmp_name'];

    //我们给每个用户动态的创建一个文件夹

    $user_path = $is_admin==1 ? '../upload/A_'.$id : '../upload/U_'.$id;
    $a['a']=$user_path;
    //判断该用户文件夹是否已经有这个文件夹
    if (!file_exists($user_path)) {
        mkdir($user_path);
    }
    if (file_exists($user_path.'/'.$_FILES["file"]["name"])) {
        $a['flag'] = 0;
        $a['errMsg'] = '文件已经存在!';
        echo json_encode($a);
        return;
    }
    if(move_uploaded_file($_FILES["file"]["tmp_name"], $user_path.'/'.$_FILES["file"]["name"])){
        $a['flag'] = 1;
        $a['address'] = str_replace('../','',$user_path.'/'.$_FILES["file"]["name"]);
    }else{
        $a['flag'] = 0;
        $a['errMsg'] = '上传失败';
    }
} else {
    $a['flag'] = 0;
    $a['errMsg'] = '上传失败';
}
echo json_encode($a);
return;

?>  