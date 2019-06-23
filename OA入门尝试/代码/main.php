<?php

class database{
    //定义一个私有属性,名称为conn,用于存储数据库连接
    private $conn;

    public function __construct()
    {
        $dsn = "mysql:host=localhost;dbname=login"; //创建驱动程序字符串
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

    //检查用户是否存在(普通&&高级)
    public function check_user_exist($tb,$com,$User_name)
    {
        $sth = $this->conn->prepare("SELECT count(1) FROM $tb  WHERE $com = ?");
        $sth->execute(array($User_name));
        return $sth->fetchColumn();
    }
    // 判断用户及密码是否命中
    public function should_login($type,$array)
    {
        $sth = $this->conn->prepare("SELECT * FROM $type WHERE `username` = ? AND `password` = ?");
        $sth->execute($array);
        return $sth->fetch(PDO::FETCH_ASSOC);
    }

    //添加用户
    public function add_user($array)
    {
        $sth = $this->conn->prepare("INSERT INTO user_login (`username`,password,admin_id ) VALUES (?,?,?)");
        $sth->execute($array);
        return $sth->rowCount();
    }
    //添加管理员
    public function add_admin_user($array)
    {
        $sth = $this->conn->prepare("INSERT INTO admin_login (`username`,password,email ) VALUES (?,?,?)");
        $sth->execute($array);
        return $sth->rowCount();
    }
    //得到用户信息
    public function get_user_information($id)
    {
        $sth = $this->conn->prepare("SELECT * FROM `user_login` where admin_id=?");
        $sth->execute(array($id));
        return $sth->fetchAll();
    }
    //得到管理员信息
    public function get_admin_information()
    {
        $sth = $this->conn->prepare("SELECT * FROM `admin_login`");
        $sth->execute(array());
        return $sth->fetchAll();
    }
    //删除用户
    public function delete_user($id)
    {
        $sth = $this->conn->prepare("DELETE FROM user_login WHERE id=?");
        $sth->execute(array($id));
        return $sth->rowCount();
    }
    //添加公告
    public function add_issue($array)
    {
        $sth = $this->conn->prepare("INSERT INTO issue (admin_id,`content`,`time` ) VALUES (?,?,?)");
        $sth->execute($array);
        return $sth->rowCount();
    }
    //查看公告
    public function look_issue($id)
    {
        $sth = $this->conn->prepare("SELECT * FROM issue WHERE admin_id=? ORDER BY id DESC");
        $sth->execute(array($id));
        return $sth->fetchAll();
    }
    //创建任务
    public function create_task($array)
    {
        $sth = $this->conn->prepare("INSERT INTO task (admin_id,people,`content`,`time` ) VALUES (?,?,?,?)");
        $sth->execute($array);
        return $sth->rowCount();
    }
    //得到任务数据
    public  function get_task_data($id){
        $sth = $this->conn->prepare("SELECT t.*,u.username FROM `task` t,user_login u WHERE t.admin_id = u.admin_id AND t.people =u.id and t.admin_id=? ORDER BY time DESC ");
        $sth->execute(array($id));
        return $sth->fetchAll();
    }
    //组员创建自己的任务
    public function user_create_task($array)
    {
        $sth = $this->conn->prepare("INSERT INTO user_task (user_id,`content`,`time` ) VALUES (?,?,?)");
        $sth->execute($array);
        return $sth->rowCount();
    }
    //组员查看自己的任务
    public function user_look_task($id)
    {
        $sth = $this->conn->prepare("SELECT * FROM user_task WHERE user_id=?  ORDER BY id DESC");
        $sth->execute(array($id));
        return $sth->fetchAll();
    }
    //用户修改信息
    public function change_information($type,$array)
    {
        $sth = $this->conn->prepare("UPDATE $type SET email=?,photo=?,nickname=?,sex=? WHERE id=?");
        $sth->execute($array);
        return $sth->rowCount();
    }
    //用户查看信息
    public function look_information($type,$id)
    {
        $sth = $this->conn->prepare("SELECT * FROM $type where id=?");
        $sth->execute(array($id));
        return $sth->fetch(PDO::FETCH_ASSOC);
    }
    //图片上传
    public function check_img_type($type) {
        $arry = [];
        if ($type == 'image/gif' || $type == 'image/jpeg' || $type == 'image/jpg' || $type == 'image/啤酒peg' || $type == 'image/png') {
            $arry['flag'] = 1;
        } else {
            $arry['flag'] = 0;
            $arry['Msg'] = '非法图片格式！';
        }
        return $arry;
    }

    /**
     * function : 遍历文件夹下的所有文件
     * return : 包含所有文件的数组
     * $dir : 文件夹路径
     */
    function my_dir($dir) {
        $files = array();
        if (@$handle = opendir($dir)) { //注意这里要加一个@，不然会有warning错误提示：）
            while (($file = readdir($handle)) !== false) {
                if ($file != ".." && $file != ".") { //排除根目录；
                    if (is_dir($dir . "/" . $file)) { //如果是子文件夹，就进行递归
                        $files[$file] = my_dir($dir . "/" . $file);
                    } else { //不然就将文件的名字存入数组；
                        $files[] = $file;
                    }
                }
            }
            closedir($handle);
            return $files;
        }
    }
    //更新头像名字
    public function update_info ($type,$array)
    {
        $sth = $this->conn->prepare("UPDATE $type SET photo=?,nickname=? WHERE id=?");
        $sth->execute($array);
        return $sth->rowCount();
    }
   //显示更新头像名字
    public function update_info_v($type,$id)
    {
        $sth = $this->conn->prepare("SELECT * FROM $type where id=?");
        $sth->execute(array($id));
        return $sth->fetch(PDO::FETCH_ASSOC);
    }
}
