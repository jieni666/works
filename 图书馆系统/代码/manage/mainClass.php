<?php
/**
 * Created by PhpStorm.
 * User: IZY
 * Date: 2018/3/15
 * Time: 9:41
 */

class database
{
    //定义一个私有属性,名称为conn,用于存储数据库连接
    private $conn;

    //构造函数 NEW 对象时自动运行
    public function __construct()
    {
        $dsn = "mysql:host=localhost;dbname=lms"; //创建驱动程序字符串
        try {
            $this->conn = new PDO($dsn, 'root', '');
            $this->conn->query("set names utf8");
        } catch (PDOException $e) {
            exit("连接数据库错误:" . $e->getMessage());
        }
    }

    //析构函数  结束时自动运行
    public function __destruct()
    {
        $this->conn = null;
    }

    //检查用户是否存在
    public function check_user_exist($account)
    {
        $sth = $this->conn->prepare("SELECT COUNT(1) FROM reader WHERE `id` = ?");
        $sth->execute(array($account));
        return $sth->fetchColumn();
    }
    public function check_user_login()
    {
        if (isset($_SESSION['login'])) {
            return 1;
        } else {
            return 0;
        }
    }

    //添加用户
    public function add_user($array)
    {
        $sth = $this->conn->prepare("INSERT INTO reader (`id`,`user_name`,user_sex,user_pw,user_tel,user_type ) VALUES ( ?,?,?,?,?,?)");
        $sth->execute($array);
        return $sth->rowCount();
    }

    // 判断用户及密码是否命中
    public function should_login($array)
    {
        $sth = $this->conn->prepare("SELECT `id`,`user_name`,`user_type` FROM reader WHERE `id` = ? AND user_pw = ?");
        $sth->execute($array);
        return $sth->fetch(PDO::FETCH_ASSOC);
    }

    public function get_user_data($user_id)
    {
        $sth = $this->conn->prepare("SELECT r.id, r.user_name, r.user_sex, r.user_tel, u.type FROM reader r, user_type u WHERE r.id = ? AND u.id = r.user_type");
        $sth->execute(array($user_id));
        return $sth->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * function 检查图书是否已经存在
     * @param $array '包含图书名称，出版社，作者的数组'
     * @return '1 | 0'
     */
    public function check_book_exist($array)
    {
        $sth = $this->conn->prepare("SELECT 1 FROM books WHERE book_name = ? AND publish = ? AND writer = ? LIMIT 1");
        $sth->execute($array);
        return $sth->fetchColumn();
    }

    //得到数据库书籍总数（不重复书籍）
    public function get_books_num()
    {
        $sql = " SELECT
        COUNT(DISTINCT book_name) AS num
    FROM
        books b,
        bookclass bc,
        publish p
    WHERE
        b.book_classify = bc.id
    AND b.publish = p.id";
        $res = $this->conn->query($sql);
        return $res->fetchColumn();
    }

    //得到数据库书籍（不重复书籍）
    public function get_books($offset, $limit)
    {
        $sql = "SELECT
                b.id,b.book_name,b.number,b.writer,b.had_num,b.page,b.price,DATE_FORMAT(b.in_time,'%Y/%m/%d') as in_time,
                bc.class_book_name,
                p.publish_name
            FROM
                books b,
                bookclass bc,
                publish p
            WHERE
                b.book_classify = bc.id
            AND
                b.publish = p.id
                ORDER BY id
            limit $offset,$limit";
        // echo $sql;
        $res = $this->conn->query($sql);
       return $res->fetchAll(PDO::FETCH_ASSOC);
    }

    //得到查询书籍总数（不重复书籍）
    public function book_search_num($date)
    {
        $sql = "SELECT
                    COUNT(DISTINCT book_name) AS num
                    FROM
                        books b,
                        bookclass bc,
                        publish p
                    WHERE
                        b.book_classify = bc.id
                    AND b.publish = p.id
                    AND (
                        b.id LIKE '$date'
                        OR b.book_name LIKE '%$date%'
                        OR b.writer LIKE '%$date%' 
                    )";

        $res = $this->conn->query($sql);
        return $res->fetchColumn();
    }

    //得到书籍（不重复书籍）
    public function get_search_books($data, $offset, $limit)
    {
        $sql = "SELECT
                b.id,
                b.book_name,
                b.number,
                b.writer,
                b.had_num,
                b.price,
                b.page,
                DATE_FORMAT(b.in_time,'%Y/%m/%d') as in_time,
                bc.class_book_name,
                p.publish_name
            FROM
                books b,
                bookclass bc,
                publish p
            WHERE
                b.book_classify = bc.id
            AND b.publish = p.id
            AND (
                b.id LIKE '$data'
                OR b.book_name LIKE '%$data%'
                OR b.writer LIKE '%$data%'
            )
            GROUP BY book_name
            limit $offset,$limit";
        $res = $this->conn->query($sql);
        return $res->fetchAll(PDO::FETCH_ASSOC);
    }

    //获取某个数据表中所有数据
    public function get_tb_data($ary)
    {
        $sql = "SELECT * FROM $ary";
        $res = $this->conn->query($sql);
        return $res->fetchAll(PDO::FETCH_ASSOC);
    }

    //图书信息修改
    public function book_modify($name, $writer, $publish, $number, $price, $class, $page, $id)
    {
        $sql = "UPDATE books SET book_name ='$name',writer = '$writer',publish = COALESCE((SELECT id FROM publish WHERE publish_name = '$publish'), publish ),had_num = (had_num + $number - number),`number` = $number,price = $price,book_classify = COALESCE((SELECT id FROM bookclass WHERE class_book_name = '$class'),book_classify),page = $page WHERE id = $id";
        $res = $this->conn->query($sql);
        return $res->rowCount();
    }

    //删除
    public function del($action, $id)
    {
        $sth = $this->conn->prepare("DELETE FROM $action WHERE id = ?");
        $sth->execute(array($id));
        return $sth->rowCount();
    }

    //图书信息写入数据库
    public function book_add($array)
    {
        $sth = $this->conn->prepare("INSERT INTO books (book_name, writer,`number`,page,book_classify,publish,price,had_num,in_time ) VALUES (?,?,?,?,?,?,?,?,NOW())");
        $sth->execute($array);
        return $sth->rowCount();
    }

    public function has_book($id)
    {
        $sth = $this->conn->prepare("SELECT * FROM books WHERE `id` = ? and had_num>0");
        $sth->execute(array($id));
        return $sth->fetch(PDO::FETCH_ASSOC);
    }

    public function user_max_borrow_num($user_id)
    {
        $sth = $this->conn->prepare("SELECT max_num FROM reader r,user_type u WHERE r.id = ? AND r.user_type = u.id");
        $sth->execute(array($user_id));
        return $sth->fetchColumn();
    }

    public function user_has_beyond_books($user_id)
    {
        $sth = $this->conn->prepare("SELECT COUNT(id) FROM record WHERE `user_id` = ? AND STATUS != 2");
        $sth->execute(array($user_id));
        return $sth->fetchColumn();
    }

    public function user_has_this_book($id, $user_id)
    {
        $sth = $this->conn->prepare("SELECT * FROM record WHERE `book_id` = ? and `user_id` = ? and status !=2");
        $sth->execute(array($id, $user_id));
        return $sth->fetch(PDO::FETCH_ASSOC);
    }

    public function is_save_borrow($array)
    {
        $sth = $this->conn->prepare("INSERT INTO record (`book_id`,`user_id`,`st_time`,`end_time`,`status` ) VALUES ( ?,?,?,?,?)");
        $sth->execute($array);
        return $sth->rowCount();
    }


    public function update_had_num($num, $id)
    {
        $sth = $this->conn->prepare("UPDATE books SET had_num = had_num-? WHERE id = ?");
        $sth->execute(array($num, $id));
        return $sth->rowCount();
    }

    public function get_hot_books()
    {

    }

    public function get_hot_readers()
    {

    }

    /**
     * @function  获取用户在某一状态下的记录数量
     * @param $user_id '用户帐号'
     * @param $status '状态'  格式 （$1,$2）
     * @return num
     */
    public function get_user_record_num($user_id, $status)
    {
        $sql = "SELECT COUNT(b.id) FROM books AS b, record AS r WHERE r.user_id = ? AND r.`status` IN $status  AND r.book_id = b.id";
        $sth = $this->conn->prepare($sql);
        $sth->execute(array($user_id));
        return $sth->fetchColumn();
    }

    public function get_user_borrow_books($user_id, $status)
    {
        $sql = "SELECT
                    b.id,
                    b.book_name,
                    b.writer,
                    b.number,
                    b.had_num,
                    bs.class_book_name,
                    r.`status`,
                    r.st_time,
                    r.end_time,
                    r.id as rid
                FROM
                    books AS b,
                    record AS r,
                    bookclass AS bs
                WHERE
                    r.user_id = ?
                AND r.`status` IN $status
                AND r.book_id = b.id
                AND b.book_classify = bs.id";
        $sth = $this->conn->prepare($sql);
        $sth->execute(array($user_id));
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    public function has_record($user_id)
    {
        $sth = $this->conn->prepare("SELECT COUNT(id) FROM record WHERE user_id = ?");
        $sth->execute(array($user_id));
        return $sth->fetchColumn();
    }

    public function get_records_num($user_id)
    {
        $sth = $this->conn->prepare("SELECT COUNT(id) FROM record WHERE user_id = IFNULL((SELECT user_id FROM record WHERE user_id = ? LIMIT 1),user_id)");
        $sth->execute(array($user_id));
        return $sth->fetchColumn();
    }

    public function get_records($user_id, $offset, $limit)
    {
        $sql = "SELECT r.id, r.book_id, r.user_id, b.book_name, u.user_name, r.st_time, s.`status`, r.return_time,r.`status` as status_num FROM books b, reader u, record r, borrow_status s WHERE r.book_id = b.id AND r.user_id = u.id AND r.`status` = s.id AND u.id = IFNULL(( SELECT user_id FROM record WHERE user_id = $user_id  LIMIT 1 ), u.id ) ORDER BY `status_num` = 3 DESC,`status_num` desc  LIMIT $offset, $limit";
        $sth = $this->conn->query($sql);
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updata_record_status($st_time, $end_time, $user_id, $book_id)
    {
        $sql = "UPDATE record SET st_time = ?, end_time = ?, `status` = 1 WHERE user_id = ? AND book_id = ? AND `status` = 4";
        $sth = $this->conn->prepare($sql);
        $sth->execute(array("$st_time", "$end_time", $user_id, $book_id));
        return $sth->rowCount();
    }

    public function book_return($record_id, $return_time)
    {
        $sql = "UPDATE record SET `status` = 2 ,return_time = ? WHERE id = ?";
        $sth = $this->conn->prepare($sql);
        $sth->execute(array($return_time, $record_id));
        return $sth->rowCount();
    }

    public function get_user_num($data)
    {
        $sql = "SELECT COUNT(id) FROM reader WHERE id = IFNULL(?,id) OR `user_name` LIKE IFNULL(?,user_name)";
        $sth = $this->conn->prepare($sql);
        $sth->execute(array($data, "%$data%"));
        return $sth->fetchColumn();
    }

    public function get_users_data($data, $offset, $limit)
    {
        $sql = "SELECT
                    r.id,
                    r.user_name,
                    r.user_sex,
                    r.user_tel,
                    r.user_type,
                    u.type
                FROM
                    reader r,
                    user_type u
                WHERE
                    r.user_type = u.id
                AND (
                    r.id = IFNULL(?, r.id)
                    OR r.`user_name` LIKE IFNULL(?, r.user_name)
                )
                LIMIT $offset,$limit";
        $sth = $this->conn->prepare($sql);
        $sth->execute(array($data, "%$data%"));
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    public function user_modify($id, $name, $pw, $sex, $tel, $type)
    {
        $sql = "UPDATE reader SET user_name = ?, user_pw = IFNULL(?,user_pw), user_sex = ?, user_tel = ?, user_type = ? WHERE id = ?";
        $sth = $this->conn->prepare($sql);
        $sth->execute(array($name, ($pw ? $pw : null), $sex, $tel, $type, $id));
        return $sth->rowCount();
//        return $sth -> debugDumpParams();
    }

    public function owner_information($id)
    {
        $sth = $this->conn->prepare("SELECT r.*,u.type,u.max_num FROM reader r LEFT JOIN user_type u on r.user_type = u.id WHERE  r.id=$id");
        $sth -> execute();
        return $sth -> fetchAll(PDO::FETCH_ASSOC);
    }


    public function new_book()
    {
        $sth = $this->conn->prepare("SELECT * FROM `books` ORDER BY unix_timestamp(in_time) DESC");
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

//    public function own($id)
//    {
//        $sth = $this->conn->prepare("SELECT r.book_id,b.book_name,r.status,COUNT(r.status),COUNT(r.book_id) FROM record r LEFT JOIN books b on r.book_id=b.id WHERE r.user_id=$id");
//        $sth->execute();
//        return $sth->fetchAll(PDO::FETCH_ASSOC);
//    }

    public function own($id)
    {
        $sth = $this->conn->prepare("SELECT r.book_id,b.book_name,r.status FROM record r LEFT JOIN books b on r.book_id=b.id WHERE r.user_id=$id");
        $sth -> execute();
        return $sth -> fetchAll(PDO::FETCH_ASSOC);
    }

    public function own_num($id){
        $sth = $this->conn->prepare("SELECT COUNT(book_id) FROM record WHERE user_id=$id");
        $sth -> execute();
        return $sth -> fetchAll(PDO::FETCH_ASSOC);
    }


    public function top_reader($num)
    {
        $sth = $this->conn->prepare("SELECT r.user_id,b.user_name,COUNT(user_id) as reader_num FROM record r LEFT JOIN reader b on r.user_id=b.id GROUP BY user_id ORDER BY  COUNT(user_id) DESC LIMIT $num");
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
//        return $sth -> debugDumpParams();
    }

    public function top_book($num)
    {
        $sth = $this->conn->prepare("SELECT r.book_id,b.book_name,COUNT(book_id) as book_num FROM record r LEFT JOIN books b on r.book_id=b.id GROUP BY book_id ORDER BY  COUNT(book_id) DESC LIMIT $num");
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    public function fankui($array){
        $sth = $this->conn->prepare("INSERT INTO fankui (`username`,`time`,`fankuinr`,`userid`) VALUES ( ?,?,?,?)");
        $sth->execute($array);
        return $sth->rowCount();
    }

    public  function getMonthRecordNum(){
        $sql = "SELECT COUNT(id) FROM record WHERE DATE_FORMAT( st_time, '%Y%m' ) = DATE_FORMAT( CURDATE( ) , '%Y%m' )";
        $sth = $this->conn->query($sql);
        return $sth -> fetchColumn();
    }
    public  function getOverdueRecordNum(){
        $sql = "SELECT COUNT(id) FROM record WHERE `status`=3";
        $sth = $this->conn->query($sql);
        return $sth -> fetchColumn();
    }
    public function getReanerNum(){
        $sql = "SELECT COUNT(id) FROM reader";
        $sth = $this->conn->query($sql);
        return $sth -> fetchColumn();
    }

    public function getBookNum(){
        $sql = "SELECT COUNT(id) FROM books";
        $sth = $this->conn->query($sql);
        return $sth -> fetchColumn();
    }
    public function book_renew($end_time,$id){
        $sql = "UPDATE record SET end_time = ?,xu_jie = xu_jie +1 WHERE id = ?";
        $sth = $this->conn->prepare($sql);
        $sth -> execute(array($end_time,$id));
        return $sth -> rowCount();
    }

    public  function overdue(){
        $sql = "UPDATE record SET `status` = 3 WHERE end_time<NOW() AND `status`<>4";
        $sth = $this->conn->query($sql);
        return $sth -> rowCount();
    }
    public function  get_order_overdue(){
        $sql = "SELECT book_id FROM record WHERE `status` = 4 AND end_time < NOW() ";
        $sth = $this->conn->query($sql);
        return $sth -> fetchAll();
    }
    public function order_overdue(){
        $sql = "DELETE FROM record WHERE `status` = 4 AND end_time < NOW() ";
        $sth = $this->conn->query($sql);
        return $sth -> rowCount();
    }
}
