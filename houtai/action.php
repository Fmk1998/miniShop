<?php
date_default_timezone_set('Asia/Shanghai');
header("content-type:text/html; charset=utf-8");
session_start();

$userid=$_SESSION['userid'];
require("dbconfig.php");
require("functions.php");

$link=mysql_connect(host,user,pass) or die ("数据库连接失败");
mysql_select_db(dbname,$link);

switch ($_GET["action"])
{
    case "add":
        $name=$_POST['name'];
        $type=$_POST['type'];
        $price=$_POST['price'];
        $total=$_POST['total'];
        $note=$_POST['note'];
        $addtime=time();
if ($name==""||$type==""||$price==""||$total=="")
{
    die ("<script>alert('请输入完整');history.go(-1);</script>");

}



        $upinfo=uploadfile("pic","./uploads/");
        if($upinfo['error']===false)
        {
            die ("图片信息上传失败:".$upinfo['info']);
        }else
            {
            $pic=$upinfo['info'];
            //echo "上传成功";
                image_png_size_add("../uploads/".$pic,"../uploads/_".$pic);
                mysql_query("insert into goods (name,type,price,total,pic,note,addtime) values ('$name','$type','$price','$total','$pic','$note','$addtime')");
            }


        if(mysql_insert_id($link)>0)
        {

           header('location:../liulan.php');
        }
        else{
            echo "上传失败";
        }
    break;
	
    case "del":
        $sql="delete from goods where id={$_GET['id']}";
        mysql_query($sql,$link);
        header("location:../liulan.php");
        if(mysql_affected_rows($link)>0)
        {
            @unlink("../uploads/".$_GET['picname']);
            @unlink("../uploads/_".$_GET['picname']);
        }
        break;
		
    case "update":
        $name=$_POST['name'];
        $type=$_POST['type'];
        $price=$_POST['price'];
        $total=$_POST['total'];
        $note=$_POST['note'];
        $id=$_POST['id'];
        $pic=$_POST['oldpic'];

        if ($name==""||$type==""||$price==""||$total=="")
        {
            die ("<script>alert('请输入完整');history.go(-1);</script>");

        }
        if($_FILES['pic']['error']!=4)
        {
            $upinfo=uploadfile("pic","./uploads/");
            if($upinfo['error']===false)
            {
                die ("图片信息上传失败:".$upinfo['info']);
            }else
            {
                $pic=$upinfo['info'];
                //echo "上传成功";
                image_png_size_add("../uploads/".$pic,"../uploads/_".$pic);
            }
        }

        $sql="update goods set name='{$name}',type='{$type}',price='{$price}',total='{$total}',note='{$note}',pic='{$pic}' where id={$id}";
        mysql_query($sql,$link);
        if(mysql_affected_rows($link)>0)
        {
            if($_FILES['pic']['error']!=4)
            {
            @unlink("./uploads/".$_POST['oldpic']);
            @unlink("./uploads/_".$_POST['oldpic']);
            }
            header("location:../liulan.php");
        }
        else
        {
            echo "修改失败";
        }

        break;


}

mysql_close($link);
?>