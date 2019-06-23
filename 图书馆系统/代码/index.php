<?php
session_start();
include './manage/mainClass.php';
$db = new database();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="./css/reset.css">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="alternate" href="">
    <style>
        body {
            font-size: 14px;
            background-color: #fbf5f5;
        }

        .clean_fix {
            *zoom: 1;
        }

        .clean_fix:after {
            content: '';
            display: table;
            clear: both;
        }

        .wrap {
            background-color: white;
            width: 100%;
            max-width: 1024px;
            height: 100%;
            margin: auto;
        }

        h1 {
            -webkit-margin-before: 0;
            -webkit-margin-after: 0;
            margin: 0;
            width: 100%;
            height: 210px;
            background-image: url("./img/logo.jpg");
            background-repeat: no-repeat;
        }

        h1 span {
            display: none;
        }

        .aside_nav {
            width: 24%;
            float: left;
            margin: 10px 0;
        }

        .box {
            border: 1px solid #dadada;
            border-radius: 7px;
            padding: 7px 0;
        }

        .aside_nav .nav {
            position: relative;
            width: 70%;
            margin: auto;
        }

        .aside_nav .nav span {
            display: block;
            width: 29px;
            height: 22.8px;
            border-radius: 3px;
            position: absolute;
            background-color: #008cba;
            background: radial-gradient(circle farthest-corner, #008cba, #0099c3);
            box-shadow: 0px 0px 2px #000;
            left: -33px;
            top: 0;
        }

        .aside_nav .nav li:hover span {
            background: radial-gradient(circle farthest-corner, darkorange, coral);
            box-shadow: 0px 0px 2px #000;
        }

        .aside_nav .nav li:hover {
            background: linear-gradient(180deg, white, gainsboro);
        }


        .aside_nav .nav li {
            list-style-type: none;
            width: 80%;
            padding: 3px 0 3px 4px;
            margin: 6px 0 6px 33px;
            border: 1px #dadada solid;
            border-radius: 3px;
            background: linear-gradient(180deg, gainsboro, white);
            position: relative;
        }

        .aside_nav .nav li a {
            text-decoration: none;
            color: #333;
        }

        .friend_links {
            background-color: #0ac1e1;
            width: 98%;
            margin-top: 10px;
            border-radius: 6px;
            box-shadow: 0px 0px 2px #000;
            padding: 5px 0 10px 6px;
        }

        .friend_links li {
            float: left;
            padding: 2px 7px 1px 7px;
        }

        .friend_links li a {
            text-decoration: none;
            color: #d7effa;
        }

        .friend_links li a:hover {
            color: #1b6d85;
        }

        .font {
            color: white;
        }

        .g-right {
            float: right;
            margin-left: 1%;
            width: 74%;
        }

        .g-right > div {
            float: left;
            width: 100%;
            /* height: 150px;*/
            border: 1px solid #dadada;
            border-radius: 7px;
            margin: 10px 0;
        }

        .g-right .books_Ranklist {
            width: 49%;
        }

        .g-right .readere_Ranklist {
            float: right;
            width: 49%;
        }

        .g-right .title {
            height: 30px;
            border-radius: 3px;
            padding: 4px 0 0 7px;
            color: #1b6d85;
            background-color: #6ad4e6;
        }

        .nav > li > a {
            display: block;
            width: 100%;
            padding:0;
        }

        .jiejian {
            padding-top: 10px;
            padding-bottom: 10px;
            padding-left: 5px;
            padding-right: 5px;
        }

        footer {
            height: 70px;
            background: linear-gradient(180deg, #039bdc, #04c5ee);
        }

        #action span {
            background: radial-gradient(circle farthest-corner, darkorange, coral);
            box-shadow: 0px 0px 2px #000;
        }
        #action{
            background: linear-gradient(180deg, white, gainsboro);
        }
        table{
            table-layout: fixed;
        }
        table td{
            overflow:hidden;
            white-space:nowrap;
            text-overflow:ellipsis;
        }
        table th{
            text-align: center;
        }
        #book_rank td,#reader_rank td{
            padding: 4px;
        }

    </style>
</head>
<body>
<div class="wrap clean_fix">
    <header>
        <h1><span>欢迎进入博览图书馆官网</span></h1>
    </header>
    <div class="main clean_fix">
        <section class="aside_nav clean_fix">
            <div class="box">
                <ul class="nav">
                    <li id="action"><span></span><a href="index.php">首页</a></li>
                    <li><span></span><a href="login.html">登录</a></li>
                    <li><span></span><a href="reg.html">注册</a></li>
                    <li><span></span><a href="own.php">个人信息</a></li>
                    <li><span></span><a href="borrow.php">图书检索与借书</a></li>
                    <li><span></span><a href="new_book.php">新书推荐</a></li>
                    <li><span></span><a href="fankui.php">问题反馈</a></li>
                </ul>
            </div>
            <ul class="friend_links clean_fix">
                <p class="font">友情链接:</p>
                <li><a href="#">北京大学图书馆</a></li>
                <li><a href="#">清华大学图书馆</a></li>
                <li><a href="#">中国国家图书馆</a></li>
                <li><a href="#">南京大学图书馆</a></li>
                <li><a href="#">复旦大学图书馆</a></li>
                <li><a href="#">北京大学图书馆</a></li>
                <li><a href="#">清华大学图书馆</a></li>
                <li><a href="#">中国国家图书馆</a></li>
                <li><a href="#">南京大学图书馆</a></li>
                <li><a href="#">复旦大学图书馆</a></li>
            </ul>
        </section>
        <section class="g-right clean_fix">
            <div class="library_Terse">
                <div class="title">
                    <p>图书馆信息介绍</p>
                </div>
                <div class="main ">
                    <p class="jiejian">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;博览图书馆以其历史悠久、藏书丰富、建筑宏伟、环境幽雅而闻名于世。图书馆源于上个世纪末湖广总督张之洞创办的湖北自强学堂图书室，
                        1917 年正式建馆， 1928 年定名为国立博览图书馆。 1935 年启用坐落在东湖之滨、狮子山顶的老图书馆大楼。 1985 年在校园中心又建成了一座新图书馆。 2000 年 8
                        月，博览与武汉水利电力大学、武汉测绘科技大学、湖北医科大学合并， 四校图书馆也相应合并为新的博览图书馆。 全校现有馆舍面积图书馆为 41925平米，资料室为 16601 平米，总面积达到
                        58526平米。 目前，博览图书馆正在拟扩建 3.5
                        万平方米的新图书馆，新馆竣工后，图书馆的服务功能将进一步得到提高。博览图书馆老馆及其周围的建筑群，被列入第五批全国重点文物保护单位，这在国内图书馆界绝无仅有。</p>
                </div>
            </div>
            <div class="books_Ranklist">
                <div class="title">
                    热门图书排行
                </div>
                <div class="main">
                    <table id="book_rank"  class="table table-hover ">
                        <thead>
                        <tr>
                            <th width="20%">排名</th>
                            <th  width="40%">书名</th>
                            <th>被借次数</th>
                        </tr>
                        </thead>
                        <?php
                        $i=1;
                        $res = $db->top_book(6);
                        ?>
                        <tbody>
                        <?php foreach ($res as $item): ?>
                            <tr class="text-center">
                                <td><?php echo $i; ?></td>
                                <td class="text-left " title="<?php echo $item['book_name'] ?>"><?php echo $item['book_name'] ?></td>
                                <td><?php echo $item['book_num']; ?></td>
                            </tr>
                            <?php
                            $i++;
                        endforeach;
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="readere_Ranklist">
                <div class="title">
                    读者排行
                </div>
                <table id="reader_rank"  class="table table-hover ">
                    <thead>
                    <tr>
                        <th width="30%">排名</th>
                        <th width="30%">姓名</th>
                        <th>借书数量</th>
                    </tr>
                    </thead>
                    <?php
                    $i=1;
                    $res = $db->top_reader(6);
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
            </div>
        </section>
    </div>
    <footer>
        <p style="text-align: center ;color: whitesmoke;padding-top: 15px;">电话2008-2658 邮箱：1035569251@qq.com</p>
        <p style="text-align: center; color: whitesmoke">地址：成都市高新区成都职业技术学院</p>
    </footer>
</div>
<script src="script/get_td_num.js"></script>
</body>
</html>
