<?php
/**
 * Created by PhpStorm.
 * User: lizer
 * Date: 2019/3/17
 * Time: 16:41
 */header("Content-Type: text/html;charset=utf-8");
session_start();
$userid=$_SESSION['userid'];
@$id=$_POST['id'];

if(!$id)
{
  echo"<script>alert('请选择商品！');history.go(-1);</script> ";
}

require ("dbconfig.php");
$link=mysql_connect(host,user,pass);

mysql_select_db(dbname,$link);


if(@$_GET['id'])
{
    $res=mysql_query("select * from userscart where id='{$_GET['id']}' AND userid='{$userid}'",$link);
    $row=mysql_fetch_assoc($res);
    $_SESSION[$userid]['totalnum']-=$row['num'];
    mysql_query("delete from userscart where id='{$_GET['id']}' and userid='{$userid}'");
    header('location:../liulan.php');
}
elseif($id)
{
    $res=mysql_query("select * from userscart where id='{$_GET['id']}' AND userid='{$userid}'",$link);
    $row=mysql_fetch_assoc($res);
    foreach ($id as $idd)
    mysql_query("delete from userscart where userid='{$userid}' and id='{$idd}'");

    header('location:../liulan.php');
}
