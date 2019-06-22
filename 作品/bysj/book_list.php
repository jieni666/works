<?php
include 'manage/mainClass.php';
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
    <title>图书管理 | bolan</title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="./css/layui.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="./css/user_list.css">

    <style>
        .table_content {
            /*widows: 100%;*/
            height: 280px;
            po
        }

        #load {
            font-size: 25px;
            height: 300px;
            width: 100%;
            display: flex;
            justify-content: center;
            position: absolute;
            align-items: center;
        }

        .control {
            margin-left: 6px;
        }

        #myForm {
            margin-left: 70px;
        }

        #myForm .form-group {
            margin: 25px 0;
        }
        table {
                     table-layout: fixed;
                 }

        table td {
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
        }

        table th {
            text-align: center;
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
            <li><a href="./admin_return.php">图书归还</a></li>
            <li><a href="./bookAdd.php">图书新增</a></li>
            <li><a href="./book_list.php" class="color">图书管理</a></li>
            <li><a href="Loaning_Record.php">借阅记录</a></li>
            <li><a href="./User_Management.php">用户管理</a></li>
        </ul>
    </aside>

    <div class="main">
        <h2 class="content-title">
            <strong>图书管理</strong>
        </h2>
        <div class="content-text">
            <div class="book_search">
                <h5>查询</h5>
                <form onclick="return false">
                    <label for="input" class="control-label">图书名称</label>
                    <div class="col-xs-5">
                        <input type="text" class="form-control" id="input" placeholder="请输入书籍名称 / 编号 / 作者">
                    </div>
                    <input type="submit" class="btn btn-primary" id="book_search" value="查询">
                </form>
            </div>
            <div class="books_show">
                <table class="table table-hover table-bordered">
                    <thead>
                    <tr>
                        <th>图书编号</th>
                        <th width="20%">图书名称</th>
                        <th>分类</th>
                        <th  width="10%">作者</th>
                        <th>价格</th>
                        <th>总数量</th>
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

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-center" id="myModalLabel">图书信息修改</h4>
                </div>
                <div class="modal-body">
                    <form onclick="return false" id="myForm" class="form-horizontal layui-form" lay-filter="select">
                        <div class="form-group">
                            <label class="sr-only" for="Name">图书名称</label>
                            <div class="input-group col-sm-10">
                                <div class="input-group-addon">图书名称</div>
                                <input type="text" class="form-control" id="Name" placeholder="eg:锋利的 jQuery(第二版)">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="sr-only" for="Writer">作者</label>
                            <div class="input-group col-sm-10">
                                <div class="input-group-addon">作&emsp;&emsp;者</div>
                                <input type="text" class="form-control" id="Writer" placeholder="eg: 单东林、张晓菲、魏然">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="sr-only" for="Number">图书数量</label>
                            <div class="input-group col-sm-10">
                                <div class="input-group-addon">图书数量</div>
                                <input type="text" class="form-control" id="Number" placeholder="eg: 12">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="sr-only" for="Pages">图书页数</label>
                            <div class="input-group col-sm-10">
                                <div class="input-group-addon">图书页数</div>
                                <input type="text" class="form-control" id="pages" placeholder="eg: 255">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Type" class="sr-only col-sm-1 control-label">图书类型</label>
                            <div class="input-group col-sm-10">
                                <div class="input-group-addon">图书类型</div>
                                <select name="modules" id="Type" lay-verify="required" lay-search="">
                                    <option value="">请选择图书类别</option>
                                    <?php foreach ($res_class as $ary) : ?>
                                        <option value="<?php echo $ary['id'] ?>"><?php echo $ary['class_book_name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="sr-only" for="Publish">出版社</label>
                            <div class="input-group col-sm-10">
                                <div class="input-group-addon">出&nbsp;&nbsp;版&nbsp;社</div>
                                <select name="modules" id="Publish" lay-verify="required" lay-search="">
                                    <option value="">请选择出版社</option>
                                    <?php foreach ($res_publish as $ary) : ?>
                                        <option value="<?php echo $ary['id'] ?>"><?php echo $ary['publish_name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="sr-only" for="Price">图书价格</label>
                            <div class="input-group col-sm-10">
                                <div class="input-group-addon">图书价格</div>
                                <input type="text" class="form-control" id="Price" placeholder="eg: 25">
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
<script src="./script/jquery-3.2.1.min.js"></script>
<script src="./script/bootstrap.min.js"></script>
<script src="./script/layui/layui.all.js"></script>

<script>
    $(function () {

        let content = $('.table_content');
        let action; //设置标识符，判断是页面初始化（1）/图书查询（2）
        if (content.find('tr').length == 0) {
            action = 1;
            post_ajax(action);
        }
        $('#book_search').on('click', function () {
            window.location.hash = '!page=1';
            action = 2;
            post_ajax(action);
        });

        /**
         * 获取图书信息数据
         * @param action <type> number  1|2
         */
        function post_ajax(action) {
            $.ajax({
                url: './manage/book_search_num.php',
                type: 'post',
                dataType: 'json',
                data: {
                    action: action,
                    data: $('#input').val().trim()
                },
                beforeSend: function () {
                    content.html('<span id="load">loading…………</span>');
                }
            })
                .done(function (e) {
                    let sumNews = e['data'];
                    if(sumNews==0){
                        alert('您所查询的书籍不存在！');
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
                                    url: './manage/book_search.php',
                                    type: 'post',
                                    dataType: 'json',
                                    data: {
                                        curr: obj.curr,
                                        limit: obj.limit,
                                        action: action,
                                        data: $('#input').val().trim(),
                                        order:1
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
                        <td class="book_id">${ary['id']}</td>
                        <td class="book_name" title="${ary['book_name']}">${ary['book_name']}</td>
                        <td class="book_class" >${ary['class_book_name']}</td>
                        <td class="book_writer">${ary['writer'].slice(0, 15)}</td>
                        <td class="book_price">${ary['price']}</td>
                        <td class="book_number">${ary['number']}</td>
                        <td class="had_num">${ary['had_num']}</td>
                        <td> ${ary['in_time']}</td>
                        <td>
                            <input type="hidden" class="book_page" value="${ary['page']}">
                            <input type="hidden" class="book_pulish" value="${ary['publish_name']}">
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
            let num = parseInt(_this.find('.book_number').text());
            let type = _this.find('.book_class').text();
            let publish = _this.find('.book_pulish').val();

            $('#Name').val(_this.find('.book_name').text());
            $('#Writer').val(_this.find('.book_writer').text());
            $('#Number').val(num);
            $('#Price').val(_this.find('.book_price').text());
            $('#pages').val(_this.find('.book_page').val());
            $('#id').val(_this.find('.book_id').text());
            $('#Type').next().find('.layui-select-title').children('input').val(type);
            $('#Publish').next().find('.layui-select-title').children('input').val(publish);
            $('#Type option:selected').val('');
            $('#Publish option:selected').val('');


            $('#modal_submit').on('click', function () {
              $('#myModal').modal('hide');
                let name = $('#Name').val().trim();
                let writer = $('#Writer').val().trim();
                let md_num = parseInt($('#Number').val().trim());
                let price = $('#Price').val().trim();
                let pages = $('#pages').val().trim();
                let md_type = $('#Type option:selected').text().trim();
                let md_publish = $('#Publish option:selected').text().trim();
                $.ajax({
                    url: './manage/book_modify.php',
                    type: 'post',
                    dataType: 'json',
                    data: {
                        id: $('#id').val().trim(),
                        name: name,
                        writer: writer,
                        number: md_num,
                        price: price,
                        pages: pages,
                        type:  md_type ? md_type : type,
                        publish: md_publish ? md_publish : publish
                    }
                })
                    .done(function (d) {
                        if (d.error) {
                            let had_num = parseInt(_this.find('.had_num').text());
                            _this.find('.book_name').text(name);
                            _this.find('.book_writer').text(writer);
                            _this.find('.book_number').text(md_num);
                            _this.find('.book_price').text(price);
                            md_type ? _this.find('.book_class').text(md_type) : _this.find('.book_class').text(type);
                            _this.find('.had_num').text(had_num + md_num - num)
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
         *  图书删除
         */
        $(document).on('click', '.del', function () {
            let _this = $(this).parent().parent();
            let res = confirm('你确定删除此图书？');
            if (!res) {
                return false;
            }
            $.ajax({
                url: './manage/del.php',
                type: 'post',
                dataType: 'json',
                data: {
                    action: `books`,
                    id: _this.find('.book_id').text()
                }
            })
                .done(function (d) {
                    if (d.error) {
                        alert('删除成功');
                        _this. empty().remove();
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
