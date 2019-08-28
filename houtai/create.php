<?php
$con = mysql_connect("localhost","root","root");
if (!$con)
{
    die('Could not connect: ' . mysql_error());
}

if (!mysql_select_db("shopdb",$con))
{
    mysql_query("CREATE DATABASE shopdb",$con);
    mysql_select_db("shopdb",$con);
    $sql="create table goods (
    id int(10) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name varchar(64) NOT NULL,
    type int(10) unsigned NOT NULL,
    price double(8,2) unsigned NOT NULL,
    total int(10) unsigned NOT NULL,
    pic varchar(32) NOT NULL,
    note text,
    addtime int(10) unsigned NOT NULL
    )";
    mysql_query($sql,$con);



    $sql="create table userscart(
    userid varchar(15) NOT NULL,
    id int(10) unsigned NOT NULL,
    num int(10) unsigned NOT NULL
    )";
    mysql_query($sql,$con);



    $sql="create table users(
    userid int(10) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
    username int(14) unsigned not null ,
    password varchar (20) not null
    )";
    mysql_query($sql,$con);

}



mysql_close($con);
?>