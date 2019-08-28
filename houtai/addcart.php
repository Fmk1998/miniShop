<?php
session_start();
header("Content-Type: text/html;charset=utf-8");
if (!isset($_SESSION['userid']))
echo "<script>alert('请先登录！');window.location.href='../index.php';</script>";
else
{
$userid=$_SESSION['userid'];
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>商品信息管理</title>
    <link rel="stylesheet" href="../css/menu.css">
</head>
<body>
    <?php


    if($userid==null)
    {
        echo"<script>alert('请先登录！');history.go(-1);</script> ";
    }else {
        require("dbconfig.php");
        $link = mysql_connect(host, user, pass);

        mysql_select_db(dbname, $link);
        $res = mysql_query("select * from userscart where id='{$_GET['id']}' AND userid='{$userid}'", $link);
        if (!$row = mysql_fetch_assoc($res)) {
            $res = mysql_query("insert into userscart (userid,id,num) values('{$userid}','{$_GET['id']}',1)", $link);
            $_SESSION[$userid]['totalnum']++;
        } else {

            $num = $row['num'] + 1;
            $_SESSION[$userid]['totalnum']++;
            mysql_query("update userscart set num='{$num}' where id='{$_GET['id']}' and userid='{$userid}'");
        }

header('location:../index.php');
 }
   } ?>


