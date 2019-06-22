<?php
include './manage/mainClass.php';
$db = new database();
$res_class = $db->get_tb_data("bookclass");
$res_publish = $db->get_tb_data("publish");
?>
<!doctype html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>书籍添加 | bolan</title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="./css/layui.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/global.css">
</head>
<style>
    .form-group {
        height: 40px;
        padding-left: 20px;
    }
    #myForm{
        padding:35px;
    }
</style>

<body>
    <!-- header start! -->
    <header>
        <span id="logo"><img src="./img/B_logo.png" alt="博览图书馆logo"></span>
        <div id="logout">
        <a href="manage/login-out.php"><i class="fa fa-sign-out fa-2x fr"></i></a>
    </div>
    </header>
    <!-- header end! -->
    <div class="content">
        <aside>
            <ul>
                <li><a href="admin.php"><i class="fa fa-dashboard fa-lg"></i>&nbsp;&nbsp;首页</a></li>
                <li><a href="./admin_borrow.php">图书借阅</a></li>
                <li><a href="admin_return.php">图书归还</a></li>
                <li><a href="./bookAdd.php" class="color">图书新增</a></li>
                <li><a href="./book_list.php">图书管理</a></li>
                <li><a href="Loaning_Record.php">借阅记录</a></li>
                <li><a href="./User_Management.php">用户管理</a></li>
            </ul>
        </aside>

        <div class="main">
            <h2 class="content-title">
                <strong>图书添加</strong>
            </h2>
            <div class="content-text">
                <form  id="myForm" class="form-horizontal layui-form"  lay-filter="select">
                    <div class="form-group">
                        <label class="sr-only" for="Name">图书名称</label>
                        <div class="input-group col-sm-5">
                            <div class="input-group-addon">图书名称</div>
                            <input type="text" class="form-control" id="Name" placeholder="eg:锋利的 jQuery(第二版)" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="Writer">作者</label>
                        <div class="input-group col-sm-5">
                            <div class="input-group-addon">作&emsp;&emsp;者</div>
                            <input type="text" class="form-control" id="Writer" placeholder="eg: 单东林、张晓菲、魏然" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="Number">图书数量</label>
                        <div class="input-group col-sm-5">
                            <div class="input-group-addon">图书数量</div>
                            <input type="text" class="form-control" id="Number" placeholder="eg: 12" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="Pages">图书页数</label>
                        <div class="input-group col-sm-5">
                            <div class="input-group-addon">图书页数</div>
                            <input type="text" class="form-control" id="pages" placeholder="eg: 255" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Type" class="sr-only col-sm-1 control-label">图书类型</label>
                        <div class="input-group col-sm-5">
                            <div class="input-group-addon">图书类型</div>
                            <select id="Type" name="modules" lay-verify="required" lay-search=""  required>
                                <option value="">请选择图书类别</option>
                                <?php foreach ($res_class as $ary) : ?>
                                    <option value="<?php echo $ary['id'] ?>"><?php echo $ary['class_book_name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="Publish">出版社</label>
                        <div class="input-group col-sm-5">
                            <div class="input-group-addon">出&nbsp;&nbsp;版&nbsp;社</div>
                            <select id="Publish" name="modules" lay-verify="required" lay-search=""  required>
                                <option value="">请选择出版社</option>
                                <?php foreach ($res_publish as $ary) : ?>
                                    <option value="<?php echo $ary['id'] ?>"><?php echo $ary['publish_name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="Price">图书价格</label>
                        <div class="input-group col-sm-5">
                            <div class="input-group-addon">图书价格</div>
                            <input type="text" class="form-control" id="Price" placeholder="eg: 25" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="submit" id="submit" class="btn  btn-primary col-sm-5 " value="提交">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="./script/jquery-3.2.1.min.js"></script>
    <script src="./script/bootstrap.min.js"></script>
    <script src="./script/layui/layui.all.js"></script>
    <script>
        $(function () {
            $('#submit').on('click',function () {
                let name = $('#Name').val().trim();
                let writer = $('#Writer').val().trim();
                let num = $('#Number').val().trim();
                let pages = $('#pages').val().trim();
                let type = $('#Type option:selected').val().trim();
                let publish = $('#Publish option:selected').val().trim();
                let price = $('#Price').val().trim();
                // type?'':alert('请选择图书类型！');
                // publish?'':alert('请选择图书出版社！');

                $.ajax({
                    url: './manage/book_add.php',
                    type: 'post',
                    dataType: 'json',
                    data:{
                        name: name,
                        writer: writer,
                        num: num,
                        pages: pages,
                        type:type,
                        publish:publish,
                        price:price
                    }
                })
                    .done(function (d) {
                        if (d.error) {
                            alert('书籍添加成功！');
                        } else {
                            alert(d.errMsg);
                        }
                    })
                    .fail(function () {

                    })
                    .always(function () {

                    })

                return false;
            })
        })
    </script>
</body>

</html>