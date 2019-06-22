<?php
session_start();
include './manage/mainClass.php';
$db = new database();
$book_num = $db->getBookNum();
$user_num = $db->getReanerNum();
$overdue_num = $db->getOverdueRecordNum();
$month_record_num = $db->getMonthRecordNum();
?>
<!doctype html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>首页 | bolan</title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/main.css">
</head>
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
            <li><a href="admin.php" class="color"><i class="fa fa-dashboard fa-lg"></i>&nbsp;&nbsp;首页</a></li>
            <li><a href="./admin_borrow.php">图书借阅</a></li>
            <li><a href="admin_return.php">图书归还</a></li>
            <li><a href="./bookAdd.php">图书新增</a></li>
            <li><a href="./book_list.php">图书管理</a></li>
            <li><a href="Loaning_Record.php">借阅记录</a></li>
            <li><a href="./User_Management.php">用户管理</a></li>
        </ul>
    </aside>
    <div class="main">
        <h2 class="content-title"><strong>首页</strong></h2>
        <div class="content-text">
            <div class="welcome">
                <p><?php echo $_SESSION['username']; ?>,欢迎进入博览图书馆管理系统！</p>
            </div>
            <div class="statistics clearfix">
                <div class="box-title">
                    最新统计
                </div>
                <div class="box2">
                    <div class="data fl">
                        <p><?php echo $book_num; ?></p>
                        <p>书籍数量</p>
                    </div>
                    <div class="data fl">
                        <p><?php echo $overdue_num; ?></p>
                        <p>还书超期</p>
                    </div>
                    <div class="data fl">
                        <p><?php echo $user_num; ?></p>
                        <p>用户数量</p>
                    </div>

                    <div class="data fl">
                        <p><?php echo $month_record_num; ?></p>
                        <p>本月借阅</p>
                    </div>
                </div>

            </div>
            <div class="box box1 fl">
                <div class="box-title">
                    最佳读者
                </div>
                <table id="reader_rank" class="table table-hover table-bordered">
                    <thead>
                    <tr>
                        <th width="30%">排名</th>
                        <th width="30%">姓名</th>
                        <th>借书数量</th>
                    </tr>
                    </thead>
                    <?php
$limit_num = $_COOKIE['admin_num'];
$i = 1;
$res = $db->top_reader($limit_num);
?>
                    <tbody>
                    <?php foreach ($res as $item): ?>
                        <tr class="text-center">
                            <td><?php echo $i; ?></td>
                            <td><?php echo $item['user_name']; ?></td>
                            <td><?php echo $item['reader_num']; ?></td>
                        </tr>
                        <?php
$i++;
endforeach;
?>
                    </tbody>
                </table>
                <!--                <a href="User_Management.php" class="more fr">更多···</a>-->
            </div>
            <div class="box box1 fr">
                <div class="box-title">
                    最热书籍
                </div>
                <table id="book_rank" class="table table-hover table-bordered">
                    <thead>
                    <tr>
                        <th width="20%">排名</th>
                        <th width="40%">书名</th>
                        <th>被借次数</th>
                    </tr>
                    </thead>
                    <?php
$i = 1;
$res = $db->top_book($limit_num);
?>
                    <tbody>
                    <?php foreach ($res as $item): ?>
                        <tr class="text-center">
                            <td><?php echo $i; ?></td>
                            <td class="text-left "
                                title="<?php echo $item['book_name'] ?>"><?php echo $item['book_name'] ?></td>
                            <td><?php echo $item['book_num']; ?></td>
                        </tr>
                        <?php
$i++;
endforeach;
?>
                    </tbody>
                </table>
                <!--                <a href="Loaning_Record.php" class="more fr">更多···</a>-->
            </div>
        </div>
    </div>
</div>
<script src="script/jquery-3.2.1.min.js"></script>
<script src="script/get_td_num.js"></script>
<script>
    $(function () {
        $.ajax({
            url: './manage/overdue.php',
            type: 'post',
            dataType: 'json',
            data: {},
            success: function (d) {
                if (d.flag) {

                } else {
                    alert(data['errMsg']);
                }
            },
            error: function () {
                console.log('error');
            },
            complete: function () {
                console.log('complete');
            }
        })
        $.ajax({
            url: './manage/order_overdue.php',
            type: 'post',
            dataType: 'json',
            data: {},
            success: function (d) {
                if (d.flag) {
                } else {
                    alert(data['errMsg']);
                }
            },
            error: function () {
                console.log('error');
            },
            complete: function () {
                console.log('complete');
            }
        })
    })
</script>
</body>
</html>
