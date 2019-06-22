<?php

session_start();
class check_type{
    function check_admin_power()
    {
        if(isset($_SESSION['id']) && $_SESSION['id']!==''&& isset($_SESSION['admin']) && $_SESSION['admin']==1){

        }else{
            echo "<script>alert('你没有权限访问此页面！');location.href='login.html';</script>";
        }
    }
    function check_user_power(){
        if(isset($_SESSION['id']) && $_SESSION['id']!==''){

        }else{
            echo "<script>alert('你没有权限访问此页面！');location.href='login.html';</script>";
        }
    }
}
