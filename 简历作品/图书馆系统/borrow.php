<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="./css/reset.css">
    <link rel="alternate" href="">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/font-awesome.min.css">
  <!--  <link rel="stylesheet" href="css/global.css">
  <!--  <link rel="stylesheet" href="./css/user_list.css">-->
    <link rel="stylesheet" href="./css/layui.css">
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
            height: 420px;
            border: 1px solid #dadada;
            border-radius: 7px;
            margin: 10px 0;
        }
        .table{
            margin-top: 10px;
        }
        .input1{
            margin-top: 5px;
        }
        .na>li>a{
            display: block;
            width: 100%;
        }
        .g-right .title {
            height: 30px;
            border-radius: 3px;
            padding:4px 0 0 7px;
            color: #1b6d85;
            background-color: #6ad4e6;
        }
        .table_content>tr>td{
            overflow:hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            -o-text-overflow: ellipsis;(opera浏览器类型)
        -moz-text-overflow: ellipsis;(firefox浏览器类型)
            /*  display: block;
              overflow: hidden;
              white-space: nowrap;
              text-overflow: ellipsis;*/
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
        .jiansuo{
            margin: 15px 0;
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
                    <li id="action"><span></span><a href="borrow.php">图书检索与借书</a></li>
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
                    <p>图书检索与借书</p>
                </div>
                <div class="main">
                    <div class="content-text">
                        <div class="book_search input1">
                            <form onclick="return false">
                                <div class="jiansuo">
<!--                                <label for="input" class="control-label" >图书名称</label>-->
                                <div class="col-xs-5 ">
                                    <input type="text" class="form-control" id="input" placeholder="请输入书籍名称 / 编号 / 作者">
                                </div>
                                <input type="submit" class="btn btn-primary " id="book_search" value="查询">
                                </div>
                            </form>
                        </div>
                        <div class="books_show">
                            <table class="table table-hover table-bordered">
                                <thead>
                                <tr>
                                    <th>图书编号</th>
                                    <th width="20%">图书名称</th>
                                    <th width="15%">分类</th>
                                    <th width="15%">作者</th>
                                    <th>价格</th>
                                    <th>在馆数量</th>
                                    <th>上架时间</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody class="table-striped table_content">
                                </tbody>
                            </table>
                            <div id="page"></div>
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
<script src="./script/jquery-3.2.1.min.js"></script>
<script src="./script/layui/layui.all.js"></script>
<script>
    $(function() {
        let content = $('.table_content');
        let action;
        if (content.find('tr').length == 0) {
            action = 1;
            post_ajax(action);
        }
        $('#book_search').on('click', function() {
            window.location.hash = '!page=1';
            action = 2;
            post_ajax(action);
        });

        function post_ajax(action) {
            $.ajax({
                url: './manage/book_search_num.php',
                type: 'post',
                dataType: 'json',
                data: {
                    action: action,
                    data: $('#input').val().trim()
                },
                beforeSend: function() {
                    content.html('<span id="load">loading…………</span>');
                }
            })
                .done(function(e) {
                    let sumNews = e['data'];
                    layui.use('laypage', function() {
                        var laypage = layui.laypage;
                        laypage.render({
                            elem: 'page', //注意，这里的 page 是 ID，不用加 # 号
                            count: sumNews, //数据总数 从服务端得到
                            curr: location.hash.replace('#!page=', ''),
                            hash: 'page',
                            limit: 5,
                            jump: function(obj, first) {
                                $.ajax({
                                    url: './manage/book_search.php',
                                    type: 'post',
                                    dataType: 'json',
                                    data: {
                                        curr: obj.curr,
                                        limit: obj.limit,
                                        action: action,
                                        data: $('#input').val().trim(),
                                    },
                                    beforeSend: function() {
                                        content.html(
                                            '<span id="load">loading…………</span>'
                                        );
                                    },
                                    success: function(data) {
                                        if (data['error'] == 1) {
                                            alert(data['errMsg']);
                                        } else {
                                            render_data(data);
                                        }
                                    },
                                    error: function() {
                                        console.log('error');
                                    },
                                    complete: function() {
                                        console.log('complete');
                                    }
                                })
                            }
                        });
                    });
                })
                .fail(function() {
                    console.log('error');
                })
                .always(function() {
                    console.log('complete');
                });
        }
        function render_data(data) {
            console.table(data);
            var text = new Array();
            for (let item in data['data']) {
                text.push(
                    '<tr>' +
                    '<td>' + data['data'][item]['id'] + '</td>' +
                    '<td title=' + data['data'][item]['book_name'] + '>' + data['data'][item]['book_name'].slice(0, 15) + '</td>' +
                    '<td>' + data['data'][item]['class_book_name'] + '</td>' +
                    '<td title=' + data['data'][item]['writer'] +'>' + data['data'][item]['writer'].slice(0, 15) + '</td>' +
                    '<td>' + data['data'][item]['price'] + '</td>' +
                    '<td>' + data['data'][item]['had_num'] + '</td>' +
                    '<td>' + data['data'][item]['in_time'] + '</td>' +
                    '<td>' +
                    '<button class="btn btn-primary btn-xs" data-had_mun='+  data["data"][item]["had_num"]  +' id='+  data["data"][item]["id"]  +'>借书</button>' +
                    '</td>' +
                    '</tr>'
                );
                content.html(text.join(''));
            }
            content.html(text.join(''));
        }
        $(document).on('click','.btn-xs',function () {
            var this_1=$(this).parent().parent();
            var id = $(this).attr("id");
            var hadnum =$(this).attr("data-had_mun");
            borrow(id,hadnum,this_1)
        })
function borrow(id,hadnum,this_1) {
    $.ajax({
        url:'./manage/borrow_data.php',
        type:'POST',
        data:{
            id:id,
            hadnum:hadnum
        },
        dataType:"json",
        success:function (d) {
                if(d.error==0){
                    alert('预定书籍成功！');
                    var this_hadnum=this_1.children("td").eq(5);
                    var hadnum=this_hadnum.text()-1;
                    this_hadnum.text(hadnum);
                }
                else {
                    alert(d.errMsg);
                }
        }

})
    }

    })
</script>
</body>
</html>
