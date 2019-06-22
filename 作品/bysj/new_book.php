
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="./css/reset.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="alternate" href="">
    <style>
        body{
            background-color:#fbf5f5 ;
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
        .box{
            border: 1px solid #dadada;
            border-radius: 7px;
            padding: 7px 0;
        }
        .aside_nav .na {
            position: relative;
            width: 70%;
            margin: auto;
        }
        .aside_nav .na span {
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
        .aside_nav .na li:hover span{
            background: radial-gradient(circle farthest-corner, darkorange, coral);
            box-shadow: 0px 0px 2px #000;
        }
        .aside_nav .na li:hover{
            background: linear-gradient(180deg, white, gainsboro);
        }
        .aside_nav .na li {
            list-style-type: none;
            width: 80%;
            padding: 3px 0 3px 4px;
            margin: 6px 0 6px 33px;
            border: 1px #dadada solid;
            border-radius: 3px;
            background: linear-gradient(180deg, gainsboro, white);
            position: relative;
        }
        .aside_nav .na li a{
            text-decoration: none;
            color: #333;
        }
        .friend_links{
            background-color: #0ac1e1;
            width: 98%;
            margin-top: 10px;
            border-radius: 6px;
            box-shadow: 0px 0px 2px #000;
            padding: 5px 0 10px 6px;
        }
        .friend_links li{
            float: left;
            padding:2px 7px 1px 7px;
        }
        .friend_links li a{
            text-decoration: none;
            color: #d7effa;
        }
        .friend_links li a:hover{
            color: #1b6d85;
        }
        .font{
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
            height: 380px;
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
            padding:4px 0 0 7px;
            color: #1b6d85;
            background-color: #6ad4e6;
        }
        .own{
            /* border: 1px solid black;*/
            float: left;
            margin-left: 1%;
            width: 48.3%;
            height:350px;
        }
        .xi{
            border-right: 1px dashed #dadada;
            padding-top:20px ;
            padding-left: 3%;
        }
        .w{
            width: 70%;
        }
        .na>li>a{
            display: block;
            width: 100%;
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
                <ul class="na">
                    <li><span></span><a href="index.php">首页</a></li>
                    <li><span></span><a href="login.html">登录</a></li>
                    <li><span></span><a href="reg.html">注册</a></li>
                    <li><span></span><a href="own.php">个人信息</a></li>
                    <li><span></span><a href="borrow.php">图书检索与借书</a></li>
                    <li id="action"><span></span><a href="new_book.php">新书推荐</a></li>
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
                    <p>新书推荐</p>
                </div>
                <div class="main">
                    <div class="books_show">
                        <table class="table table-hover table-bordered" style="margin-top: 15px;">
                            <thead>
                            <tr>
                                <th>图书编号</th>
                                <th>图书名称</th>
                                <th>作者</th>
                                <th>上架时间</th>
                            </tr>
                            </thead>
                            <tbody class="table-striped table_content">
                            <?php
                            include './manage/mainClass.php';
                            $db = new database();
                            $res = $db->new_book();
                            ?>
                            <?php
                                for($i=0;$i<8;$i++){?> <tr>

                                <td>
                                    <?php
                                    echo @$res[$i]['id'];
                                    ?>
                                </td> <td>
                                    <?php
                                    echo @$res[$i]['book_name'];
?>  </td>
                                <td>
                                    <?php
                                    echo @$res[$i]['writer'];
                                    ?>  </td>
                                <td>
                                    <?php
                                    echo @$res[$i]['in_time'];
                                    ?>  </td>
                                <?php
                                    }
                                    ?>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <footer>
        <p style="text-align: center ;color: whitesmoke;padding-top: 15px;" >电话2008-2658    邮箱：1035569251@qq.com</p>
        <p style="text-align: center; color: whitesmoke">地址：成都市高新区成都职业技术学院</p>

    </footer>
</div>
</body>

</html>
