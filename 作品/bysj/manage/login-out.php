<?php
session_start();
session_destroy();
echo "<script>alert('登陆已注销！')</script>";
header('location:../index.php');
?>
