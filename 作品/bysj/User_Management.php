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
    <title>用户管理 | bolan</title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/layui.css">
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="./css/search.css">
</head>
<style>
    #myForm {
        margin-left: 70px;
    }

    #myForm .form-group {
        margin: 25px 0;
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

<!-- main start! -->
<div class="content">
    <aside>
        <ul>
            <li><a href="admin.php"><i class="fa fa-dashboard fa-lg"></i>&nbsp;&nbsp;首页</a></li>
            <li><a href="./admin_borrow.php">图书借阅</a></li>
            <li><a href="admin_return.php">图书归还</a></li>
            <li><a href="./bookAdd.php">图书新增</a></li>
            <li><a href="./book_list.php">图书管理</a></li>
            <li><a href="Loaning_Record.php">借阅记录</a></li>
            <li><a href="./User_Management.php" class="color">用户管理</a></li>
        </ul>
    </aside>

    <div class="main">
        <h2 class="content-title"><strong>用户管理</strong></h2>
        <div class="content-text">
            <div class="search">
                <h5 id="search" class="cursor">查询</h5>
                <form onclick="return false" class="search_form">
                    <label for="account" class="control-label">用户帐号</label>
                    <div class="col-xs-5">
                        <input type="text" class="form-control" id="data" placeholder="请输入用户帐号">
                    </div>
                    <input type="submit" class="btn btn-primary" id="user_search" value="查询">
                </form>
            </div>
            <div class="show">
                <table class="table table-hover table-bordered">
                    <thead>
                    <tr>
                        <th>账号</th>
                        <th>姓名</th>
                        <th>性别</th>
                        <th>联系电话</th>
                        <th>身份类别</th>
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

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-center" id="myModalLabel">用户信息修改</h4>
                </div>
                <div class="modal-body">
                    <form onclick="return false" id="myForm" class="form-horizontal layui-form" lay-filter="select">
                        <div class="form-group">
                            <label class="sr-only" for="Name">用户名称</label>
                            <div class="input-group col-sm-10">
                                <div class="input-group-addon">用户名称:</div>
                                <input type="text" class="form-control" id="Name" placeholder="eg:许">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="sr-only" for="pw">密码</label>
                            <div class="input-group col-sm-10">
                                <div class="input-group-addon">密&emsp;&emsp;码:</div>
                                <input type="text" class="form-control" id="pw" placeholder="不填写为不修改">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="sr-only" for="sex">性&emsp;&emsp;别:</label>
                            <div class="input-group col-sm-10">
                                <div class="input-group-addon">性&emsp;&emsp;别:</div>
                                <select name="modules" id="sex">
                                    <option value="">请选择（不选不修改）</option>
                                    <option value="男">男</option>
                                    <option value="女">女</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="sr-only" for="Pages">联系电话</label>
                            <div class="input-group col-sm-10">
                                <div class="input-group-addon">联系电话</div>
                                <input type="number" id="tel" class="form-control" placeholder="不填写为不修改">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Type" class="sr-only col-sm-1 control-label">图书类型</label>
                            <div class="input-group col-sm-10">
                                <div class="input-group-addon">读者类型</div>
                                <select name="modules" id="Type" >
                                    <option value="">请选择（不选不修改）</option>
                                    <option value="1">管理员</option>
                                    <option value="2">学生</option>
                                    <option value="3">教师</option>
                                    <option value="4">职工</option>
                                </select>
                            </div>
                        </div>
                        <input type="hidden" id="id" value="">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    <button type="button" id="modal_submit" class="btn btn-primary">保存</button>
                </div>
            </div>
        </div>
    </div>

</div>
<script src="script/jquery-3.2.1.min.js"></script>
<script src="./script/bootstrap.min.js"></script>
<script src="./script/layui/layui.all.js"></script>
<script src="script/md5.js"></script>

<script>
    $(function () {
        let content = $('.table_content');
        let action; //设置标识符，判断是页面初始化（1）/图书查询（2）
        if (content.find('tr').length == 0) {
            post_ajax();
        }
        $('#user_search').on('click', function () {
            window.location.hash = '!page=1';
            action = 2;
            post_ajax();
        });

        /**
         * 获取图书信息数据
         * @param action <type> number  1|2
         */
        function post_ajax(action) {
            var data = $('#data').val() ? $('#data').val().trim() : '';
            $.ajax({
                url: './manage/user_search_num.php',
                type: 'post',
                dataType: 'json',
                data: {
                    data: data
                },
                beforeSend: function () {
                    content.html('<span id="load">loading…………</span>');
                }
            })
                .done(function (e) {
                    let sumNews = e['data'];
                    if(sumNews==0){
                        alert('您所查询的用户不存在！');
                    }
                    layui.use('laypage', function () {
                        var laypage = layui.laypage;
                        laypage.render({
                            elem: 'page', //注意，这里的 page 是 ID，不用加 # 号
                            count: sumNews, //数据总数 从服务端得到
                            curr: location.hash.replace('#!page=', ''),
                            hash: 'page',
                            limit: 7,
                            jump: function (obj, first) {
                                $.ajax({
                                    url: './manage/user_search.php',
                                    type: 'post',
                                    dataType: 'json',
                                    data: {
                                        curr: obj.curr,
                                        limit: obj.limit,
                                        data: data
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
                text.push(
                    `<tr>
                        <td class="account">${ary['id']}</td>
                        <td class="user_name" title="${ary['user_name']}">${ary['user_name'].slice(0, 15)}</td>
                        <td class="sex" >${ary['user_sex']}</td>
                        <td class="tel">${ary['user_tel']}</td>
                        <td class="type" data-type="${ary['user_type']}">${ary['type']}</td>
                        <td>
                            <button type="button" class="btn btn-warning btn-xs control modify" data-toggle="modal" data-target="#myModal" >修改</button>
                            <button class="btn btn-danger btn-xs control del">删除</button>
                        </td>
                    </tr>`
                );
                content.html(text.join(''));
            }
            content.html(text.join(''));
        }

        /**
         *  图书修改
         */
        $(document).on('click', '.modify', function () {
            let _this = $(this).parent().parent();
            let sex = _this.find('.sex').text();
            let type = _this.find('.type').attr('data-type');
            let tel = _this.find('.tel').text();
            $('#id').val(_this.find('.account').text());
            $('#Name').val(_this.find('.user_name').text());
            $('#tel').val(tel);

            $('#modal_submit').on('click', function () {
                $('#myModal').modal('hide');
                let account = $('#account').val();
                let name = $('#Name').val();
                let tel =  $('#tel').val() ? $('#tel').val() : tel;
                let pw = $('#pw').val() ? $('#pw').val() : '';
                let md_sex = $('#sex option:selected').val() ? $('#sex option:selected').val() : sex;
                let md_type = $('#Type option:selected').val() ? $('#Type option:selected').val():type;
                let md_type_text = $('#Type option:selected').text() ? $('#Type option:selected').text():type;
                $.ajax({
                    url: './manage/user_modify.php',
                    type: 'post',
                    dataType: 'json',
                    data: {
                        id: $('#id').val(),
                        name: name,
                        pw: hex_md5(pw),
                        sex: md_sex,
                        tel: tel,
                        type:  md_type ,
                    }
                })
                    .done(function (d) {
                        if (d.error) {
                            _this.find('.user_name').text(name);
                            _this.find('.sex').text(md_sex);
                            _this.find('.tel').text(tel);
                            _this.find('.type').text(md_type_text);
                            alert('修改成功');
                        } else {
                            alert(d.errMsg);
                        }
                    })
                    .fail(function (jqXHR, textStatus, errorThrown) {
                        console.log('error');
                    })
                    .always(function () {
                        console.log('complete');
                    });

            })

        });

        /**
         *  用户删除
         */
        $(document).on('click', '.del', function () {
            let _this = $(this).parent().parent();
            let res = confirm('你确定删除此用户？');
            if (!res) {
                return false;
            }
            $.ajax({
                url: './manage/del.php',
                type: 'post',
                dataType: 'json',
                data: {
                    action: `reader`,
                    id: _this.find('.account').text()
                }
            })
                .done(function (d) {
                    if (d.error) {
                        alert('删除成功');
                        _this.empty().remove();
                    } else {
                        alert(d.errMsg);
                    }
                })
                .fail(function (jqXHR, textStatus, errorThrown) {
                    console.log('error');
                })
                .always(function () {
                    console.log('complete');
                });
        });
    })
</script>
</body>
</html>
  