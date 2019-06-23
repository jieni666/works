<?php
session_start();

// $a['data']=$_FILES;
// echo json_encode($a);
// return;
//1.接收提交文件的用户
$id = isset($_SESSION['id']) ? $_SESSION['id'] : '';
$is_admin = $_SESSION['admin'];
$a['id']=$id;
if (!$id) {
    $a['flag'] = 0;
    $a['errMag'] = '参数获取失败 !';
    echo json_encode($a);
    return;
}

//获取文件的大小
$file_size = $_FILES['file']['size'];
if ($file_size > 10 * 1024 * 1024) {
    $a['flag'] = 0;
    $a['errMag'] = '文件过大，不能上传大于10M的文件';
    echo json_encode($a);
    return;
}

include './main.php';
$db = new database();
//我们给每个用户动态的创建一个头像文件夹
$user_path = $is_admin==1 ? 'upload/A_'.$id.'/head_img': 'upload/U_'.$id.'/head_img';
//$a['a']=$user_path;
//判断该用户文件夹是否已经有这个文件夹
if (!file_exists($user_path)) {
    mkdir($user_path,0777,true);
}

$head_imgs = $db->my_dir($user_path);

$a['img_lists']=$head_imgs;
$type=strrchr($_FILES["file"]["name"], '.');
$new_name = 'temp'.$type;

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

    if (file_exists($user_path.'/'.$_FILES["file"]["name"])) {
        $a['flag'] = 0;
        $a['errMsg'] = '文件已经存在!';
        echo json_encode($a);
        return;
    }
    if(move_uploaded_file($_FILES["file"]["tmp_name"], $user_path.'/'.$new_name)){
//        rename($user_path.'/'.$new_name,$user_path.'/test.jpg');
        $a['flag'] = 1;
        $a['address'] = $user_path.'/'.$new_name;
        $a['add'] = $user_path;
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