<!doctype html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>借阅记录 | bolan</title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/layui.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="./css/search.css">
</head>
<style>

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

<!-- main start! -->
<div class="content">
    <aside>
        <ul>
            <li><a href="admin.php"><i class="fa fa-dashboard fa-lg"></i>&nbsp;&nbsp;首页</a></li>
            <li><a href="./admin_borrow.php">图书借阅</a></li>
            <li><a href="admin_return.php">图书归还</a></li>
            <li><a href="./bookAdd.php">图书新增</a></li>
            <li><a href="./book_list.php">图书管理</a></li>
            <li><a href="Loaning_Record.php" class="color">借阅记录</a></li>
            <li><a href="./User_Management.php">用户管理</a></li>
        </ul>
    </aside>
    <div class="main">
        <h2 class="content-title"><strong>借阅记录</strong></h2>
        <div class="content-text">
            <div class="search">
                <h5 id="search" class="cursor">查询</h5>
                <form onclick="return false" class="search_form">
                    <label for="account" class="control-label">用户帐号</label>
                    <div class="col-xs-5">
                        <input type="text" class="form-control" id="account" placeholder="请输入用户帐号">
                    </div>
                    <input type="submit" class="btn btn-primary" id="record_search" value="查询">
                </form>
            </div>
            <div class="show">
                <table class="table table-hover table-bordered">
                    <thead>
                    <tr>
                        <th>序号</th>
                        <th>图书ID</th>
                        <th width="20%">图书名称</th>
                        <th>读者ID</th>
                        <th width="20%">读者名字</th>
                        <th>借阅时间</th>
                        <th>状态</th>
                        <th>还书时间</th>
                    </tr>
                    </thead>
                    <tbody class="table-striped table_content">
                    </tbody>
                </table>
                <div id="page"></div>
            </div>
        </div>
    </div>
</div>
<script src="script/jquery-3.2.1.min.js"></script>
<script src="./script/bootstrap.min.js"></script>
<script src="./script/layui/layui.all.js"></script>
<script>
    $(function () {
        let action = 0;
        let account = null;
        let content = $('.table_content');
        let i = 1;
        post_ajax(action);
        $('#record_search').on('click', function () {
            i = 1;
            action = 1;
            account = $('#account').val();
            $.ajax({
                url: './manage/check_user_exist.php',
                type: 'post',
                dataType: 'json',
                data: {
                    account: account
                }
            })
                .done(function(d) {
                    if (d.error) {
                        alert(d.errMsg)
                    }else {
                        post_ajax(action)
                    }
                })
        })

        function post_ajax(action) {
            $.ajax({
                url: './manage/get_records_num.php',
                type: 'post',
                dataType: 'json',
                data: {
                    action: action,
                    account: account
                }
            })
                .done(function (e) {
                    if (e.flag == 0) {
                        alert(e.errMsg);
                        return;
                    }
                    let sum = e['data'];
                    layui.use('laypage', function () {
                        var laypage = layui.laypage;
                        laypage.render({
                            elem: 'page', //注意，这里的 page 是 ID，不用加 # 号
                            count: sum, //数据总数 从服务端得到
                            curr: location.hash.replace('#!page=', ''),
                            hash: 'page',
                            limit: 7,
                            jump: function (obj, first) {
                                $.ajax({
                                    url: './manage/get_records.php',
                                    type: 'post',
                                    dataType: 'json',
                                    data: {
                                        curr: obj.curr,
                                        limit: obj.limit,
                                        account: account ? account : 'null'
                                    },
                                    success: function (data) {
                                        if (data['error'] == 1) {
                                            alert(data['errMsg']);
                                        } else {
                                            render_data(data);
                                        }
                                    },
                                    error: function () {
                                        console.log('error');
                                    },
                                    complete: function () {
                                        console.log('complete');
                                    }
                                })
                            }
                        });
                    });
                })
                .fail(function () {
                    console.log('error');
                })
                .always(function () {
                    console.log('complete');
                });
        }

        /**
         * 图书信息数据渲染为表格
         * @param data <type> array   进行渲染的数据
         */
        function render_data(data) {
            let text = new Array();
            for (let item in data['data']) {
                let ary = data['data'][item];
                let note = (ary['status_num'] == 3) ? 'waring_color' : '';
                text.push(
                    `<tr>
                        <td>${i}</td>
                        <td>${ary['book_id']}</td>
                        <td title="${ary['book_name']}">${ary['book_name'].slice(0, 15)}</td>
                        <td>${ary['user_id']}</td>
                        <td>${ary['user_name']}</td>
                        <td>${ary['st_time']}</td>
                        <td class="${note} text-center">${ary['status']}</td>
                        <td>${ary['return_time'] ? ary['return_time'] : ''}</td>
                    </tr>`
                );
                content.html(text.join(''));
                i += 1;
            }
            content.html(text.join(''));
        }


    })
</script>
</body>
</html>
tent.html(text.join(''));
}


})
</script>
<
/body>
< /html>
