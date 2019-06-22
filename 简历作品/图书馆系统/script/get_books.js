/**
 * 获取图书信息数据
 * @param action <type> number  1|2
 */

function show_books(action) {
    post_ajax(action);
}

function post_ajax(action) {
    $.ajax({
        url: './manage/book_search_num.php',
        type: 'post',
        dataType: 'json',
        data: {
            action: action,
            data: $('#input_book').val().trim()
        }
    })
        .done(function (e) {
            let sumNews = e['data'];
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
                                data: $('#input_book').val().trim()
                            },
                            success: function (data) {
                                if (data['error'] == 1) {
                                    alert(data['errMsg']);
                                } else if(data.data.length==0){
                                    content.html('');
                                    notes.html('未查询到书籍信息！')
                                }else {
                                    notes.html('');
                                    render_data(data.data);
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
    const thead = $('#thead');
    const book_thead =`<tr>
                        <th>图书编号</th>
                        <th>图书名称</th>
                        <th>分类</th>
                        <th>作者</th>
                        <th>总数量</th>
                        <th>在馆数量</th>
                        <th>操作</th>
                    </tr>`;
    thead.html(book_thead);

    let text = new Array();
    for (let item in data) {
        let ary = data[item];
        text.push(
            '<tr>' +
            '<td class="book_id">' + ary['id'] + '</td>' +
            '<td class="book_name" title=' + ary['book_name'] + '>' + ary['book_name'].slice(0, 15) + '</td>' +
            '<td class="book_class" >' + ary['class_book_name'] + '</td>' +
            '<td class="book_writer">' + ary['writer'].slice(0, 15) + '</td>' +
            '<td class="book_number  text-right">' + ary['number'] + '</td>' +
            '<td class="had_num  text-right">' + ary['had_num'] + '</td>'
        );
        let btn = '';
        if (ary['had_num'] == 0 && !ary['status']) {
            btn = '<button class="btn btn-default btn-xs control book_order" disabled="disabled" >借阅</button>';
        }
        else {
            btn = `<button class="btn btn-primary btn-xs control book_order" data-status="${ary['status']?ary['status']:''}" >借阅</button>`;
        }
        text.push(
            '<td class="text-center">' +
            btn +
            '</td>' +
            '</tr>'
        );

        content.html(text.join(''));
    }
    content.html(text.join(''));
}
