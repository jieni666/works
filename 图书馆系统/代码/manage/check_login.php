<?php
session_start();
function check_login($type)
{
    $usertype = isset($_SESSION['userType']) ? $_SESSION['userType'] : '';
    if ($usertype) {
        if ($type == 1) {
            if ($usertype != 1) {
                echo "<script>alert('您没有权限访问此页面,请使用管理员账户登录！');location.href='login.html'</script>";
            }
        }
    } else {
        echo "<script>alert('您没有登录此网站，请登录！');location.href='login.html'</script>";
    }
}