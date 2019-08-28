<?php
session_start();
header("Content-Type: text/html;charset=utf-8");
if (!isset($_SESSION['userid']))
    echo "<script>alert('请先登录！');window.location.href='../index.php';</script>";
else {
    $userid = $_SESSION['userid'];
    require("dbconfig.php");
    $link = mysql_connect(host, user, pass);
    mysql_select_db(dbname, $link);
//$res=mysql_query("select * from userscart where userid='{$userid}'");
//else
    if ($_GET['id']) {
        $res = mysql_query("select * from userscart where id='{$_GET['id']}' AND userid='{$userid}'", $link);
        $row = mysql_fetch_assoc($res);
        $_SESSION[$userid]['totalnum'] -= $row['num'];
        mysql_query("delete from userscart where id='{$_GET['id']}' and userid='{$userid}'");
        header('location:../liulan.php');
    } else {
        mysql_query("delete from userscart where userid='{$userid}'");
        header('location:../liulan.php');
    }
}