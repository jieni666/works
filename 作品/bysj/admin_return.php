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
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>图书归还 | bolan</title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
    <link rel="stylesheet" href="./css/layui.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/reset.css">


    <style>

        .content-text {
            margin: 20px;
            width: 96%;
        }

        .book_search {
            border: 1px solid #bbbbbb;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .book_search h5 {
            height: 35px;
            line-height: 35px;
            padding-left: 15px;
            background: rgb(226, 226, 226);
            border-bottom: 1px solid #bbbbbb;
        }

        .book_search form {
            height: 60px;
            display: flex;
            align-items: center;
        }

        .book_search label {
            margin: 0 20px;
        }

        .books_show {
            border-radius: 5px;
            overflow: hidden;
        }
        .color_red{
            color: red;
        }
    </style>
</head>

<body>
<header>
    <span id="logo"><img src="./img/B_logo.png" alt="博览图书馆logo"></span>
    <div id="logout">
        <a href="manage/login-out.php"><i class="fa fa-sign-out fa-2x fr"></i></a>
    </div>
</header>

<div class="content">
    <aside>
        <ul>
            <li><a href="admin.php"><i class="fa fa-dashboard fa-lg"></i>&nbsp;&nbsp;首页</a></li>
            <li><a href="./admin_borrow.php">图书借阅</a></li>
            <li><a href="admin_return.php" class="color">图书归还</a></li>
            <li><a href="./bookAdd.php">图书新增</a></li>
            <li><a href="./book_list.php">图书管理</a></li>
            <li><a href="Loaning_Record.php">借阅记录</a></li>
            <li><a href="./User_Management.php">用户管理</a></li>
        </ul>
    </aside>

    <div class="main">
        <h2 class="content-title">
            <strong>图书归还</strong>
        </h2>
        <div class="content-text">
            <div class="book_search">
                <h5>查询</h5>
                <form onclick="return false" class="form user_search">
                    <label for="input_user" class="control-label">用户账号</label>
                    <div class="col-xs-6">
                        <input type="text" class="form-control" id="input_user" placeholder="请输入用户账号">
                    </div>
                    <input type="submit" class="btn btn-primary" id="user_search" value="查询">
                </form>
                <div id="user_data">
                    <p class="col-sm-3">账户：<span class="account"></span></p>
                    <p class="col-sm-3">用户名：<span class="name"></span></p>
                    <p class="col-sm-3">性别：<span class="sex"></span></p>
                    <p class="col-sm-3">可借数量：<span class="num"></span></p>
                </div>
            </div>
            <div class="books_show">
                <table class="table table-hover table-bordered">
                    <thead id="thead">

                    </thead>
                    <tbody id="table_content" class="table-striped">
                    </tbody>
                </table>
                <p id="bookNotes" class="text-center"></p>
                <div id="page"></div>
            </div>
        </div>
    </div>


</div>
<script src="./script/jquery-3.2.1.min.js"></script>
<script src="./script/layui/layui.all.js"></script>
<script src="./script/get_user_data.js"></script>
<script>
    $(function () {
        function addDate(date,days){
            let d=new Date(date);
            d.setDate(d.getDate()+days);
            let m=d.getMonth()+1;
            let D=d.getDate();
            let H = d.getHours();
            let i = d.getMinutes();
            let s = d.getSeconds();
            H = H.toString().length<2 ? `0${H}`:H;
            i = i.toString().length<2 ? `0${i}`:i;
            s = s.toString().length<2 ? `0${s}`:s;
            D = D.toString().length<2 ? `0${D}`:D;
            m = m.toString().length<2 ? `0${m}`:m;
            return `${d.getFullYear()}-${m}-${D} ${H}:${i}:${s}`;
        }
        let content = $('#table_content');
        let notes = $('#bookNotes');
        $('#user_data').toggle();
        $('#user_search').on('click',function () {
            let user_id = $('#input_user').val();
            show_user(user_id,0);
        });
        //书籍归还
        content.on('click','.book_return',function () {
            let user_id = $('.account').text();
            let _this = $(this).parent().parent();
            $.ajax({
                url: './manage/book_return.php',
                type: 'post',
                dataType: 'json',
                data: {
                    user_id: user_id,
                    book_id:  _this.find('.book_id').text(),
                    rid: _this.find('.record_id').val()
                },
                success: function (d) {
                    if(d.flag){
                        alert('归还成功！');
                        _this.empty().remove();
                    }else {
                        alert(d.errMsg);
                    }
                },
                error: function () {
                    console.log('error!');
                },
                complete: function () {
                    console.log('complete!');
                }
            })
        })

        //书籍续借

        content.on('click','.book_renew',function () {
            let _this = $(this).parent().parent();
            let end_time = _this.find('.end_time');
            $.ajax({
                url: './manage/book_renew.php',
                type: 'post',
                dataType: 'json',
                data: {
                    rid: _this.find('.record_id').val(),
                    end_time: end_time.text()
                },
                success: function (d) {
                    console.log('success!');
                    if(d.flag){
                        alert('续借成功！');
                        end_time.text(addDate(end_time.text(),15))
                    }else {
                        alert(d.errMsg);
                    }
                },
                error: function () {
                    console.log('error!');
                },
                complete: function () {
                    console.log('complete!');
                }
            })
        })
    })
</script>
</body>
</html>>