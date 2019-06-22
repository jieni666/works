let toggle = true;
let content = $('#table_content');
let notes = $('#bookNotes');

function show_user(user_id, action) {
    get_user_data(user_id,action);
}

function get_user_data(user_id,action) {
    $.ajax({
        url: './manage/get_user_data.php',
        type: 'post',
        dataType: 'json',
        data: {
            user_id: user_id
        }
    })
        .done(function (d) {
            if (d.flag) {
                $('.book_search').css('height', '130px');
                $('.account').text(d.ary['id']);
                $('.name').text(d.ary['user_name']);
                $('.sex').text(d.ary['user_sex']);
                $('.num').text(d.num);
                if (toggle) {
                    $('#user_data').toggle('slow');
                    toggle = !toggle;
                }
                if (d.record_num) {
                    get_user_borrow_books(user_id, d.record_num,action)
                } else {
                    content.html('');
                    notes.html('用户无书籍预订信息！');
                }
            } else {
                alert(d.errMsg);
            }
        })
}

/**
 * 获取用户以借图书信息数据
 * @param user_id
 */
function get_user_borrow_books(user_id,sum,action) {
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
                    url: './manage/get_user_borrow_books.php',
                    type: 'post',
                    dataType: 'json',
                    data: {
                        curr: obj.curr,
                        limit: obj.limit,
                        action: action,
                        user_id: user_id
                    },
                    success: function (data) {
                        if (data['error'] == 1) {
                            alert(data['errMsg']);
                        } else if (data.data.length == 0) {
                            content.html('');
                            notes.html('未查询到借阅信息！')
                        } else {
                            notes.html('');
                            render_data(data.data,action);
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
}

/**
 * 图书信息数据渲染为表格
 * @param data <type> array   进行渲染的数据
 */
function render_data(data,action) {
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
    const book_thead1 =`<tr>
                        <th>图书编号</th>
                        <th>图书名称</th>
                        <th>分类</th>
                        <th>借阅时间</th>
                        <th>结束时间</th>
                        <th>状态</th>
                        <th>操作</th>
                    </tr>`;
    if (action) {
        thead.html(book_thead);
    }else{
        thead.html(book_thead1);
    }

    let text = new Array();
    for (let item in data) {
        let ary = data[item];
        if (action) {
            text.push(`<tr>
            <td class="book_id">${ary['id']}</td>
            <td>${ary['book_name'].slice(0, 15)}</td>
            <td>${ary['writer'].slice(0, 15)}</td>
            <td>${ary['st_time']}</td>
            <td>${ary['end_time']}</td>
            <td class="text-center">预订</td>
            <td class="text-center">
                <button class="btn btn-primary btn-xs control book_order" 
                        data-status="${ary['status'] ? ary['status'] : ''}" 
                        ${(ary['had_num'] == 0 && !ary['status']) ? 'disabled' : ''}">
                    借阅
                </button>
            </td>
        </tr>`)
        } else {
            text.push(`<tr>
                    <td class="book_id">${ary['id']}</td>
                    <td>${ary['book_name'].slice(0, 15)}</td>
                    <td>${ary['writer'].slice(0, 15)}</td>
                    <td>${ary['st_time']}</td>
                    <td class="end_time">${ary['end_time']}</td>
                    <td class="text-center">
                        ${ary['status'] == 3 ? '超期' : '借阅中' }
                    </td>
                    <td class="text-center">
                    <input type="hidden" class="record_id" value="${ary['rid']}">
                    <button class="btn btn-primary btn-xs control book_renew" >续借</button>
                    <button class="btn btn-primary btn-xs control book_return" >归还</button>
                    </td>
                </tr>`);
        }

        content.html(text.join(''));
    }
    content.html(text.join(''));
}
