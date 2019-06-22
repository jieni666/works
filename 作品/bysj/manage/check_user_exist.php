<?php
  session_start();
  include_once './mainClass.php';
  $db = new database();
  $account = isset($_POST['account'])?$_POST['account']:'';
  if($account===''){
    $a['error'] = 1;
    $a['flag'] = 1;
    $a['errMsg'] = '账号不能为空！';
    echo json_encode($a);
    return ;
  }
  //判断用户名是否存在
  $is_exist = $db ->check_user_exist($account);
  if($is_exist){
      $a['error'] = 0;
  }else{
    $a['error'] = 1;
    $a['errMsg'] = '此账号不存在！';
  }
  $a['flag'] = 0;
  echo json_encode($a);
    return ;