<?php
/**
 * Created by PhpStorm.
 * User: mr.cheng
 * Date: 2018/6/26
 * Time: 17:27
 */

session_start();
header('Content-type:text/html;charset=utf-8');
if(isset($_SESSION['id']) && $_SESSION['id']!==''){
    session_unset();//free all session variable
    session_destroy();//销毁一个会话中的全部数据
//    setcookie(session_name(),'',time()-3600);//销毁与客户端的卡号
    echo "<script>alert('注销成功！');location.href='./login.html';</script>";
}else{
    echo "<script>alert('注销失败！');history.go(-1);</script>";
}