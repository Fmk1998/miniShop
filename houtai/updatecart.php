<?php
/**
 * Created by PhpStorm.
 * User: lizer
 * Date: 2019/2/23
 * Time: 20:23
 */
session_start();

header("Content-Type: text/html;charset=utf-8");
$id=$_GET['id'];
$num=$_GET['num'];
$userid=$_SESSION['userid'];
require ("dbconfig.php");
$link=mysql_connect(host,user,pass);
mysql_select_db(dbname,$link);
$res=mysql_query("select * from userscart where userid='{$userid}' and id='{$id}'");
$row=mysql_fetch_assoc($res);
$oldnum=$row['num'];
$res=mysql_query("select * from goods where id='{$id}'");
$row=mysql_fetch_assoc($res);

$newnum=$oldnum+$num;
if($newnum<1)
{
    header('location:../mycart.php');
}else
if($newnum>$row['total'])
{

    echo "<script>alert('数量不能大于剩余总数！');history.go(-1)</script>";
}
else
{
    $_SESSION[$userid]['totalnum']+=$num;
    mysql_query("update userscart set num='{$newnum}' where id='{$id}' and userid='{$userid}'");
header('location:../mycart.php');

}
