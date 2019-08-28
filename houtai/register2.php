<?php
header("Content-Type: text/html;charset=utf-8");
session_start();
$action=$_GET['action'];
include 'dbconfig.php';

switch ($action)
{
    case 'login':
        $username=$_POST['username'];
        $password=$_POST['password'];
        if($username==''||$password=='')
        {
            echo "<script>alert('请输入完整！');history.go(-1);</script>    ";
        }
        else {
            $link = mysql_connect('localhost', 'root', 'root');
            mysql_select_db(dbname) or die ('数据库连接失败');

            $sql = "select * from users where username='$username'";
            $res = mysql_query($sql, $link);
            if (mysql_num_rows($res)==0) {
                echo "<script>alert('用户名不存在！');history.go(-1);</script>    ";
            } else {
                $row = mysql_fetch_assoc($res);
                if ($password != $row['password']) {
                    echo "<script>alert('密码错误！');history.go(-1);</script>    ";
                } else {

                    $_SESSION['userid'] = "_".$row['userid'];
                    if($_POST['rem']==1)
                    {
                        setcookie('username',$username);
                        setcookie('password',$password);
                    }
                    header('location:../liulan.php');
                }
            }
        }
            break;
    case 'register':
        $username=$_POST['username'];
        $password=$_POST['password'];
        $repassword=$_POST['repassword'];
        if($username==''||$password==''||$repassword=='')
        {
            echo "<script>alert('请输入完整！');history.go(-1);</script>    ";
        }
        elseif($password!=$repassword)
        {
            echo "<script>alert('两次密码不一致！');history.go(-1);</script>    ";
        }else
        {
            $link = mysql_connect('localhost', 'root', 'root');
            mysql_select_db(dbname) or die ('数据库连接失败');
            $sql = "select * from users where username='$username'";
            $res = mysql_query($sql, $link);
            if(mysql_num_rows($res))
            {
                echo "<script>alert('用户名已存在！');history.go(-1);</script>    ";
            }else {
                $sql = "insert into users (username,password) values ('$username','$password')";
                $res = mysql_query($sql, $link);
                if (empty($res)) {
                    echo "<script>alert('注册失败！');history.go(-1);</script>    ";
                } else {
                    header('location:../index.php');
                }
            }
        }




}
