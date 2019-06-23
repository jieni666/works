<?php
session_start();

include "./main.php";
$get_information= new database();
$id=isset($_SESSION['id'])?$_SESSION['id']:'';
$admin_id=isset($_SESSION['admin_id'])?$_SESSION['admin_id']:'';

if (!$admin_id){
    $res=$get_information->look_information('admin_login',$id);
}else{
    $res=$get_information->look_information('user_login',$id);
}

if (!$admin_id){
    $res0=$get_information->update_info_v('admin_login',$id);
}else{
    $res0=$get_information->update_info_v('user_login',$id);
}
?>
<!--<pre> --><?php //var_dump($res) ?><!--</pre-->
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
    <link rel="stylesheet" href="layui/css/layui.css"  media="all">
    <script src="assets/js/echarts.min.js"></script>
    <style>
        #head_img{
            width: 100px;
            height: 100px;
        }
    </style>
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
        <div class="row">
            <div class="am-u-md-12 am-u-sm-12 row-mb">
                <div class="tpl-portlet">
                    <div class="tpl-portlet-title">
                        <div class="tpl-caption font-green ">
                            <span>我的信息</span>
                        </div>
                    </div>
                    <div class="am-tabs tpl-index-tabs" data-am-tabs>
                        <ul class="am-nav am-nav-tabs">
                            <li>
                                <?php
                                if (!$admin_id){ ?>
                                <a href="index.php" id="return_index" >返回首页</a>
                                <?php } else { ?>
                                    <a href="people-index.php" id="return_index" >返回首页</a>
                                <?php } ?>
                            </li>
                        </ul>
                    <form class="am-form am-form-horizontal " method="post" action="change_information.php">
                      <div class="am-form-group">
                            <label for="" class="am-u-sm-2 am-form-label tpl-caption font-green">用户名</label>
                            <div class="am-u-sm-4 ">
                                    <input type="text" id="" disabled placeholder="" value="<?= $res['username'] ?>">
                            </div>
                        </div>

                        <div class="am-form-group">
                            <label for="doc-ipt-3" class="am-u-sm-2 am-form-label tpl-caption font-green">昵称</label>
                            <div class="am-u-sm-4 ">
                                    <input type="text" id="doc-ipt-3"  name="nickname" placeholder="你的昵称" value="<?= $res['nickname']==null ? '': $res['nickname'] ?>">
                            </div>
                        </div>
                        <div class="am-form-group">
                            <label for="doc-ipt-3" class="am-u-sm-2 am-form-label tpl-caption font-green">性别</label>
                            <label class="am-radio-inline ">
                                男<input type="radio" name="sex" value="男" <?= $res['sex']=='男' ? 'checked': '' ?>>
                            </label>
                            <label class="am-radio-inline am-u-sm-1">
                                女<input type="radio" name="sex" value="女" <?= $res['sex']=='女' ? 'checked': '' ?>>
                            </label>
                        </div>
                        <div class="am-form-group">
                            <label for="doc-ipt-3" class="am-u-sm-2 am-form-label tpl-caption font-green">头像</label>
                            <div class="am-u-sm-4 ">
                                    <img class="tpl-header-list-user-ico" id="head_img" src="<?= $res['photo'].'?t='.rand(1,10000) ?>">
                                <button type="button" class="layui-btn" id="avatarUpload">
                                    <i class="layui-icon">&#xe67c;</i>上传图片
                                </button>
                                <input type="hidden" name="update_url" id="update_url" value="">
                                <input type="hidden" name="add_url" id="add_url" value="<?php echo !$admin_id  ? 'upload/A_'.$id.'/head_img' :'upload/U_'.$id.'/head_img' ?>">
                            </div>
                        </div>
                        <div class="am-form-group">
                            <label for="doc-ipt-3" class="am-u-sm-2 am-form-label tpl-caption font-green">邮箱</label>
                            <div class="am-u-sm-4 ">
                                <input type="email" name="email" id="doc-ipt-3" placeholder="你的邮箱" value="<?= $res['email'] ?>">
                            </div>
                        </div>
                        <div class="am-form-group">
                            <div class="am-u-sm-10 am-u-sm-offset-2">
                                <button type="submit" class="am-btn am-btn-secondary">确认修改</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
</div>
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/amazeui.min.js"></script>
<script src="layui/layui.all.js"></script>
<script>
    $(function () {
        layui.use('upload', function(){
            let upload = layui.upload;

            let uploadInst = upload.render({
                elem: '#avatarUpload',
                url: 'img_upload.php',
                accept: 'image',
                acceptMime: 'image/*',
                done: function (res) {
                    console.log('done');
                    if (res.flag) {
                        // console.log(res.address);
                        $('#update_url').val(res.address);
                        $('#add_url').val(res.add);
                        $('#head_img').attr('src', res.address+"?t=" + Math.random());
                    } else {
                        layer.msg(res.errMsg, {
                            icon: 2
                        });
                    }
                },
                error: function () {
                    console.log('error')
                }
            });
        });

    })

</script>
</body>

</html>