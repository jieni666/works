<?php
include './power_check.php';
$check=new check_type();
$check->check_user_power();

include "./main.php";
$get_information= new database();
$admin_id=isset($_SESSION['admin_id'])?$_SESSION['admin_id']:'';
$id=isset($_SESSION['id'])?$_SESSION['id']:'';
if ($admin_id){
    $res=$get_information->look_issue($admin_id);
}
else{
    $res=$get_information->look_issue($id);

}
if (!$admin_id){
    $res0=$get_information->update_info_v('admin_login',$id);
}else{
    $res0=$get_information->update_info_v('user_login',$id);
}

?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Amaze UI Admin index Examples</title>
    <meta name="description" content="这是一个 index 页面">
    <meta name="keywords" content="index">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <link rel="icon" type="image/png" href="assets/i/favicon.png">
    <link rel="apple-touch-icon-precomposed" href="assets/i/app-icon72x72@2x.png">
    <meta name="apple-mobile-web-app-title" content="Amaze UI"/>
    <link rel="stylesheet" href="assets/css/amazeui.min.css"/>
    <link rel="stylesheet" href="assets/css/admin.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <script src="assets/js/echarts.min.js"></script>
</head>

<body data-type="index">


<header class="am-topbar am-topbar-inverse admin-header">
    <div class="am-topbar-brand">
        <span>协同办公</span>
    </div>
    <div class="am-icon-list tpl-header-nav-hover-ico am-fl am-margin-right">

    </div>

    <button class="am-topbar-btn am-topbar-toggle am-btn am-btn-sm am-btn-success am-show-sm-only"
            data-am-collapse="{target: '#topbar-collapse'}">
        <span class="am-icon-bars"></span>
    </button>

    <div class="am-collapse am-topbar-collapse" id="topbar-collapse">

        <ul class="am-nav am-nav-pills am-topbar-nav am-topbar-right admin-header-list tpl-header-list">
            <li class="am-dropdown" data-am-dropdown data-am-dropdown-toggle>
                <a class="am-dropdown-toggle tpl-header-list-link" href="javascript:;">
                    <span class="tpl-header-list-user-nick" ><?= $res0['nickname'] ?></span>
                    <span class="tpl-header-list-user-ico">
                            <img src="<?= $res0['photo'].'?t='.rand(1,10000) ?>" >
                    </span>
                </a>
                <ul class="am-dropdown-content">
                    <li>
                        <a href="information.php">
                            <span class="am-icon-bell-o"></span> 资料</a>
                    </li>
                    <li>
                        <a href="logout.php">
                            <span class="am-icon-power-off"></span> 退出</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</header>
<div class="tpl-page-container tpl-page-header-fixed">


    <div class="tpl-left-nav tpl-left-nav-hover">

        <div class="tpl-left-nav-list">
            <ul class="tpl-left-nav-menu">
                <li class="tpl-left-nav-item">
                    <a href="people-index.php" class="nav-link active">
                        <i class="am-icon-home"></i>
                        <span>首页</span>
                    </a>
                </li>
                <li class="tpl-left-nav-item">
                    <a href="people-news.php" class="nav-link tpl-left-nav-link-list">
                        <i class="am-icon-newspaper-o"></i>
                        <span>公告</span>
                    </a>
                </li>
                <li class="tpl-left-nav-item">
                    <a href="javascript:;" class="nav-link tpl-left-nav-link-list">
                        <i class="am-icon-list-ul"></i>
                        <span>任务中心</span>
                        <i class="am-icon-angle-right tpl-left-nav-more-ico am-fr am-margin-right tpl-left-nav-more-ico-rotate"></i>
                    </a>
                    <ul class="tpl-left-nav-sub-menu" style="display: none;">
                        <li>
                            <a href="people-task.php">
                                <i class="am-icon-angle-right"></i>
                                <span>任务站</span>
                                <i class="tpl-left-nav-content-ico am-fr am-margin-right"></i>
                            </a>
                            <a href="myself-task.php">
                                <i class="am-icon-angle-right"></i>
                                <span>我的任务</span>
                                <i class="tpl-left-nav-content tpl-badge-success"></i>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="tpl-left-nav-item">
                    <a href="information.php" class="nav-link tpl-left-nav-link-list">
                        <i class="am-icon-user-secret"></i>
                        <span>我的信息</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="tpl-content-wrapper">

        <div class="row">
            <div class="am-u-md-12 am-u-sm-12 row-mb">
                <div class="tpl-portlet">
                    <div class="tpl-portlet-title">
                        <div class="tpl-caption font-green ">
                            <span>公告栏</span>
                        </div>

                    </div>

                    <div class="am-tabs tpl-index-tabs" data-am-tabs>
                        <div class="am-tabs-bd">
                            <div class="am-tab-panel am-fade am-in am-active" id="tab1">
                                <div id="wrapperA" class="wrapper">
                                    <div id="scroller" class="scroller">
                                        <table class="am-table  am-table-hover  am-table-striped am-text-nowrap am-scrollable-horizontal">
                                            <?php
                                            $i=1;
                                            foreach ($res as $arry){
                                                ?>
                                                <tr>
                                                    <td><?php echo $i ?></td>
                                                    <td><?php echo $arry['content'] ?></td>
                                                    <td><?php echo $arry['time'] ?></td>
                                                </tr>
                                                <?php
                                                $i++;
                                            }
                                            ?>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>


    </div>

</div>
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/amazeui.min.js"></script>
<script src="assets/js/iscroll.js"></script>
<script src="assets/js/app.js"></script>
</body>

</html>